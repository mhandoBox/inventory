<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Products extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Ensure product model is available under both property names used in the file
        if (file_exists(APPPATH . 'models/Model_products.php')) {
            $this->load->model('Model_products', 'Model_products');
            $this->load->model('Model_products', 'model_products');
        } elseif (file_exists(APPPATH . 'models/model_products.php')) {
            $this->load->model('model_products', 'Model_products');
            $this->load->model('model_products', 'model_products');
        } else {
            log_message('error', 'Products model not found. Expected Model_products.php or model_products.php');
            $this->Model_products = $this->model_products = null;
        }

        // Load purchases model if available (alias as both common property names)
        if (file_exists(APPPATH . 'models/Model_purchases.php')) {
            $this->load->model('Model_purchases', 'Model_purchases');
            $this->load->model('Model_purchases', 'model_purchases');
        } elseif (file_exists(APPPATH . 'models/model_purchases.php')) {
            $this->load->model('model_purchases', 'Model_purchases');
            $this->load->model('model_purchases', 'model_purchases');
        } else {
            log_message('error', 'Purchases model not found. Expected Model_purchases.php or model_purchases.php');
            $this->Model_purchases = $this->model_purchases = null;
        }

        $this->not_logged_in();
        $this->data['page_title'] = 'Products';
        $this->load->model('model_brands');
        $this->load->model('model_category');
        $this->load->model('model_stores');
        $this->load->model('model_attributes');
    }

    public function index()
    {
        // do not redirect users away — pass an access flag instead
        $access_denied = !in_array('viewProduct', $this->permission);
        $this->data['access_denied'] = $access_denied;

        // Provide safe defaults so views don't throw notices
        $this->data['products'] = $this->data['products'] ?? [];
        $this->data['stores'] = $this->data['stores'] ?? $this->db->get('stores')->result_array();
        $this->data['categories'] = $this->data['categories'] ?? $this->db->get('categories')->result_array();

        // ensure sidebar knows what to highlight
        $this->data['user_permission'] = $this->permission;
        $this->data['page'] = 'products';
        $this->data['tab'] = 'products';

        // If access is denied: render page (so header/footer/styles load) but don't fetch sensitive data
        if ($access_denied) {
            // optionally set empty report/data for the view
            $this->data['products'] = [];
            $this->render_template('products/index', $this->data);
            return;
        }

        // permitted: fetch data and render as usual
        $this->data['products'] = $this->Model_products->getAll(); // adjust to your model method
        $this->render_template('products/index', $this->data);
    }

    // Example: product view/edit page (replace your existing method body)
    public function view($id = null)
    {
        $access_denied = !in_array('viewProduct', $this->permission);
        $this->data['access_denied'] = $access_denied;

        $this->data['user_permission'] = $this->permission;
        $this->data['page'] = 'products';
        $this->data['tab'] = 'products';

        if ($access_denied) {
            // Provide minimal data so the view renders without errors
            $this->data['product'] = null;
            $this->render_template('products/view', $this->data);
            return;
        }

        if ($id === null) {
            show_404();
            return;
        }

        $this->data['product'] = $this->Model_products->getById($id);
        if (!$this->data['product']) show_404();

        $this->render_template('products/view', $this->data);
    }

    // Ensure AJAX endpoints still enforce permission, e.g. fetchProductsData:
    public function fetchProductsData()
    {
        if (!in_array('viewProduct', $this->permission)) {
            $this->output
                 ->set_status_header(403)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['data'=>[], 'error'=>'Access denied']));
            return;
        }

        // normal AJAX data work here...
    }

    private function prepareAttributeData()
    {
        $attribute_data = $this->model_attributes->getActiveAttributeData();
        $attributes_final_data = array();
        foreach ($attribute_data as $k => $v) {
            $attributes_final_data[$k]['attribute_data'] = $v;
            $value = $this->model_attributes->getAttributeValueData($v['id']);
            $attributes_final_data[$k]['attribute_value'] = $value;
        }
        return $attributes_final_data;
    }

    public function fetchProductData()
    {
        if (!in_array('viewProduct', $this->permission)) {
            echo json_encode(['error' => true, 'message' => 'Permission denied']);
            return;
        }

        $result = ['data' => []];

        $sql = "
            SELECT 
                pr.*,
                b.name AS brand_name,
                s.name AS store_name,
                COALESCE((
                    SELECT SUM(pu.qty) FROM purchases pu
                    WHERE pu.product_id = pr.id
                    -- optional store filter if purchases are per-store:
                    AND pu.store_id = pr.store_id
                ), 0) AS total_purchased,
                COALESCE((
                    SELECT SUM(oi.qty) FROM orders_item oi
                    JOIN orders o ON oi.order_id = o.id
                    WHERE oi.product_id = pr.id
                    -- optional store filter if orders are per-store:
                    AND o.store_id = pr.store_id
                ), 0) AS total_sold
            FROM products pr
            LEFT JOIN brands b ON b.id = pr.brand_id
            LEFT JOIN stores s ON s.id = pr.store_id
            ORDER BY pr.id DESC
        ";

        $data = $this->db->query($sql)->result_array();

        foreach ($data as $key => $value) {
            $stock = max(0, intval($value['total_purchased']) - intval($value['total_sold']));
            $stock_status = $stock <= 10 ? '<span class="label label-danger">Low ('.$stock.')</span>' : $stock;
            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $buttons = '';
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= '<button class="btn btn-warning btn-sm edit-product" data-id="'.$value['id'].'" data-toggle="modal" data-target="#editProductModal"><i class="fa fa-pencil"></i> Edit</button>';
            }
            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm delete-product" data-id="'.$value['id'].'"><i class="fa fa-trash"></i> Delete</button>';
            }

            $result['data'][$key] = [
                'name' => $value['name'],
                'price' => 'TZS '.number_format($value['price'], 2),
                'unit_status' => $value['unit'],
                'warehouse' => $value['store_name'] ?? '',
                'stock' => $stock_status,
                'availability' => $availability,
                'actions' => $buttons,
                'id' => $value['id']
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function fetchPurchasesData()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        try {
            $group_id = $this->session->userdata('group_id');
            $store_id = $this->session->userdata('store_id');
            
            // Get filter values
            $store_filter = $this->input->post('store_id');
            
            if ($group_id == 1 || $group_id == 2) {
                $store_id = !empty($store_filter) ? $store_filter : null;
            } // For clerks, keep session $store_id

            // Get purchases based on user role
            $purchases = $this->model_products->getPurchasesData($store_id, $group_id);

            $response = array(
                'data' => $purchases,
                'recordsTotal' => count($purchases),
                'recordsFiltered' => count($purchases)
            );

        } catch (Exception $e) {
            $response = array(
                'error' => $e->getMessage(),
                'data' => array()
            );
            log_message('error', 'Error fetching purchases: ' . $e->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    private function calculateCurrentStock($product_id, $store_id)
    {
        // Get total purchased
        $purchased = $this->model_products->getTotalPurchased($product_id, $store_id);
        
        // Get total sold
        $sold = $this->model_products->getTotalSold($product_id, $store_id);
        
        return $purchased - $sold;
    }

    public function getPurchaseData($purchase_id)
    {
        if (!in_array('updateProduct', $this->permission)) {
            $response = array(
                'success' => false,
                'message' => 'Permission denied'
            );
            echo json_encode($response);
            return;
        }

        $this->db->select('purchases.*, products.store_id');
        $this->db->from('purchases');
        $this->db->join('products', 'products.id = purchases.product_id', 'left');
        $this->db->where('purchases.id', $purchase_id);
        $query = $this->db->get();
        $purchase_data = $query->row_array();

        if ($purchase_data) {
            $response = array(
                'success' => true,
                'data' => array(
                    'id' => $purchase_data['id'],
                    'product_id' => $purchase_data['product_id'],
                    'qty' => $purchase_data['qty'],
                    'unit' => $purchase_data['unit'],
                    'supplier' => $purchase_data['supplier'],
                    'supplier_no' => $purchase_data['supplier_no'],
                    'price' => number_format($purchase_data['price'], 2),
                    'total_amount' => number_format($purchase_data['total_amount'], 2),
                    'amount_paid' => number_format($purchase_data['amount_paid'], 2),
                    'status' => $purchase_data['status'],
                    'purchase_date' => $purchase_data['purchase_date'],
                    'store_id' => $purchase_data['store_id']
                )
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Purchase not found'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function create() 
    {
        if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        // If AJAX POST, validate and create product, return JSON
        if ($this->input->is_ajax_request() && $this->input->method() === 'post') {
            $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('store', 'Store', 'trim|required|numeric');
            $this->form_validation->set_rules('availability', 'Availability', 'trim|required|in_list[1,2]');

            header('Content-Type: application/json');

            if ($this->form_validation->run() == TRUE) {
                // Map posted fields to model create() expected keys
                $data = [
                    'name' => $this->input->post('product_name'),
                    'price' => $this->input->post('price'), 
                    'unit' => $this->input->post('unit') ? $this->input->post('unit') : 'pcs',
                    'description' => $this->input->post('description') ?: '',
                    'attribute_value_id' => $this->input->post('attributes_value_id') ? json_encode($this->input->post('attributes_value_id')) : NULL,
                    'brand_id' => $this->input->post('brands') ? (int)$this->input->post('brands')[0] : NULL,
                    'category_id' => is_array($this->input->post('category')) ? (int)$this->input->post('category')[0] : (int)$this->input->post('category'),
                    'store_id' => (int)$this->input->post('store'),
                    'availability' => (int)$this->input->post('availability')
                ];

                // Handle image upload if present
                if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0) {
                    $upload_result = $this->upload_image();
                    if (is_string($upload_result) && strpos($upload_result, 'assets/images/product_image') === false) {
                        echo json_encode(['success' => false, 'message' => 'Image upload failed: ' . $upload_result]);
                        return;
                    }
                    $data['image'] = $upload_result;
                }

                $insert_id = $this->model_products->create($data);
                if ($insert_id) {
                    echo json_encode(['success' => true, 'message' => 'Product created', 'id' => $insert_id]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to create product']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => validation_errors()]);
            }
            return;
        }

        // GET - render the form
        $this->data['page_title'] = 'Add Purchase';
        $this->data['products'] = $this->model_products->getActiveProductData();

        if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2) {
            $this->load->model('model_stores');
            $this->data['stores'] = $this->model_stores->getActiveStores();
        }

        $this->render_template('products/purchases', $this->data);
    }

    public function upload_image()
    {
        if ($_FILES['product_image']['size'] == 0) {
            return NULL;
        }

        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] = uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('product_image')) {
            $error = $this->upload->display_errors('', '');
            return $error;
        } else {
            $data = $this->upload->data();
            $path = $config['upload_path'] . '/' . $data['file_name'];
            return $path;
        }
    }

    public function update($product_id = null)
    {
        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$product_id) {
            $product_id = $this->input->post('product_id');
            if (!$product_id) {
                redirect('dashboard', 'refresh');
            }
        }

        $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('unit', 'Unit of Measurement', 'trim|required');
        $this->form_validation->set_rules('store', 'Store', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('category', 'Category', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('availability', 'Availability', 'trim|required|in_list[0,1]');
        $this->form_validation->set_rules('brand', 'Brand', 'trim|numeric');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'name' => $this->input->post('product_name'),
                'price' => $this->input->post('price'),
                'unit' => $this->input->post('unit'),
                'description' => $this->input->post('description') ?: '',
                'attribute_value_id' => $this->input->post('attributes_value_id') ? json_encode($this->input->post('attributes_value_id')) : NULL,
                'brand_id' => $this->input->post('brand') ? (int)$this->input->post('brand') : NULL,
                'category_id' => (int)$this->input->post('category'),
                'store_id' => (int)$this->input->post('store'),
                'availability' => (int)$this->input->post('availability')
            );

            if ($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                if (is_string($upload_image) && strpos($upload_image, 'assets/images/product_image') === false) {
                    $this->session->set_flashdata('error', 'Image upload failed: ' . $upload_image);
                    redirect('Controller_Products/', 'refresh');
                }
                $data['image'] = $upload_image;
            }

            $update = $this->model_products->update($data, $product_id);
            $sql_query = $this->db->last_query();

            if ($update) {
                $this->session->set_flashdata('success', 'Successfully updated product ID ' . $product_id);
                redirect('Controller_Products/', 'refresh');
            } else {
                $db_error = $this->db->error();
                $error_message = isset($db_error['message']) ? $db_error['message'] : 'Unknown database error';
                $this->session->set_flashdata('error', 'Failed to update product: ' . $error_message);
                redirect('Controller_Products/', 'refresh');
            }
        } else {
            $this->data['attributes'] = $this->prepareAttributeData();
            $this->data['brands'] = $this->model_brands->getActiveBrands();
            $this->data['category'] = $this->model_category->getActiveCategory();
            $this->data['stores'] = $this->model_stores->getActiveStore();
            $this->data['product_data'] = $this->model_products->getProductData($product_id);
            $this->session->set_flashdata('error', 'Form validation failed: ' . validation_errors());
            $this->render_template('products/index', $this->data);
        }
    }

    public function remove()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if ($product_id) {
            $delete = $this->model_products->remove($product_id);
            $sql_query = $this->db->last_query();

            if ($delete) {
                $this->db->insert('activity_log', [
                    'user_id' => $this->session->userdata('id') ?? 1,
                    'activity' => 'Deleted Product',
                    'details' => "Product ID: $product_id",
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $db_error = $this->db->error();
                $error_message = isset($db_error['message']) ? $db_error['message'] : 'Unknown database error';
                $response['success'] = false;
                $response['messages'] = "Failed to delete product: " . $error_message;
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "No product ID provided";
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function purchases()
    {
        if (!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        // Get user's store and role info
        $store_id = $this->session->userdata('store_id');
        $is_admin = ($this->session->userdata('group_id') == 1);

        // Get active products with stock levels
        $this->data['products'] = array_map(function($product) use ($store_id) {
            $product['current_stock'] = $this->model_products->getAvailableStock(
                $product['id'], 
                $store_id
            );
            return $product;
        }, $this->model_products->getActiveProductData());

        // Get stores list for admin users
        if ($is_admin) {
            $this->load->model('model_stores');
            $this->data['stores'] = $this->model_stores->getStoresData();
        }

        // Add debug information
        log_message('debug', sprintf(
            'Purchases view loaded - Store ID: %s, Is Admin: %s, Products Count: %d',
            $store_id,
            $is_admin ? 'Yes' : 'No',
            count($this->data['products'])
        ));

        $this->data['is_admin'] = $is_admin;
        $this->data['store_id'] = $store_id;
        $this->render_template('products/purchases', $this->data);
    }

    public function addStock()
    {
        // only allow via controller (prevent direct view access)
        if ($this->input->method(true) === 'POST') {
            $payload = $this->input->post();

            // basic server-side validation
            if (empty($payload['product_id']) || empty($payload['qty'])) {
                if ($this->input->is_ajax_request()) {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'error' => 'Product and quantity are required']));
                } else {
                    $this->session->set_flashdata('error', 'Product and quantity are required');
                    redirect('Controller_Products/purchases', 'refresh');
                }
                return;
            }

            // prepare data
            $insert_data = [
                'product_id'   => (int)$payload['product_id'],
                'supplier'     => $payload['supplier'] ?? '',
                'supplier_no'  => $payload['supplier_no'] ?? '',
                'price'        => isset($payload['price']) ? (float)$payload['price'] : 0,
                'unit'         => $payload['unit'] ?? '',
                'qty'          => (float)$payload['qty'],
                'total_amount' => isset($payload['total_amount']) ? (float)$payload['total_amount'] : ((float)$payload['price'] * (float)$payload['qty']),
                'status'       => $payload['status'] ?? 'Unpaid',
                'amount_paid'  => isset($payload['amount_paid']) ? (float)$payload['amount_paid'] : 0,
                'purchase_date'=> $payload['purchase_date'] ?? date('Y-m-d H:i:s'),
                'store_id'     => isset($payload['store_id']) ? $payload['store_id'] : $this->session->userdata('store_id'),
                'created_by'   => $payload['created_by'] ?? $this->session->userdata('id') ?? 0
            ];

            // insert via model if available, otherwise fallback to direct DB insert
            $insert_id = false;
            if (!empty($this->model_purchases) && method_exists($this->model_purchases, 'create')) {
                $insert_id = $this->model_purchases->create($insert_data);
            } elseif (!empty($this->model_products)) {
                if (method_exists($this->model_products, 'createPurchase')) {
                    $insert_id = $this->model_products->createPurchase($insert_data);
                } elseif (method_exists($this->model_products, 'create_purchase')) {
                    $insert_id = $this->model_products->create_purchase($insert_data);
                } elseif (method_exists($this->model_products, 'addPurchase')) {
                    $insert_id = $this->model_products->addPurchase($insert_data);
                } elseif (method_exists($this->model_products, 'add_purchase')) {
                    $insert_id = $this->model_products->add_purchase($insert_data);
                }
            }

            if ($insert_id === false) {
                // fallback DB insert
                $this->db->insert('purchases', $insert_data);
                $insert_id = $this->db->insert_id() ?: false;
            }

            if ($insert_id) {
                if ($this->input->is_ajax_request()) {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true, 'id' => $insert_id]));
                } else {
                    $this->session->set_flashdata('success', 'Purchase added successfully');
                    redirect('Controller_Products/purchases', 'refresh');
                }
            } else {
                if ($this->input->is_ajax_request()) {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'error' => 'DB insert failed']));
                } else {
                    $this->session->set_flashdata('error', 'Failed to add purchase');
                    redirect('Controller_Products/purchases', 'refresh');
                }
            }
            return;
        }

        // Non-POST requests: show purchases page (do not expose view file directly)
        redirect('Controller_Products/purchases', 'refresh');
    }

    public function purchases_data()
    {
        $draw  = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $search = $this->input->post('search')['value'] ?? '';

        $date_from = $this->input->post('date_from') ?: null;
        $date_to   = $this->input->post('date_to') ?: null;
        $warehouse = $this->input->post('warehouse') ?: null;
        $status    = $this->input->post('status') ?: null;

        try {
            // try to use a model if available
            if (file_exists(APPPATH.'models/Model_purchases.php')) {
                $this->load->model('Model_purchases');
                if (method_exists($this->Model_purchases, 'getPurchases')) {
                    $result = $this->Model_purchases->getPurchases($start, $length, [
                        'date_from'=>$date_from,'date_to'=>$date_to,
                        'warehouse'=>$warehouse,'status'=>$status,'search'=>$search
                    ]);
                    $data = $result['data'] ?? [];
                    $recordsTotal = $result['recordsTotal'] ?? 0;
                    $recordsFiltered = $result['recordsFiltered'] ?? $recordsTotal;
                } else {
                    throw new Exception('Model_purchases::getPurchases not found');
                }
            } else {
                // fallback: direct DB query (adjust table/columns if different)
                $this->db->start_cache();
                $this->db->from('purchases p');
                $this->db->select('p.id, p.reference_no, p.date, p.supplier_id, p.total, p.status, p.store_id');
                $this->db->join('suppliers s','s.id = p.supplier_id','left');

                if ($date_from) $this->db->where('DATE(p.date) >=', $date_from);
                if ($date_to)   $this->db->where('DATE(p.date) <=', $date_to);
                if ($warehouse) $this->db->where('p.store_id', $warehouse);
                if ($status)    $this->db->where('p.status', $status);
                if ($search) {
                    $this->db->group_start()
                             ->like('p.reference_no', $search)
                             ->or_like('s.name', $search)
                             ->group_end();
                }

                // total before limit
                $recordsTotal = $this->db->count_all_results('', FALSE);

                if ($length > 0) $this->db->limit($length, $start);
                $this->db->order_by('p.date', 'desc');
                $query = $this->db->get();
                $this->db->stop_cache();
                $this->db->flush_cache();

                if ($query === FALSE) throw new Exception('DB error: '.json_encode($this->db->error()));
                $data = $query->result_array();
                $recordsFiltered = $recordsTotal;
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => intval($recordsTotal),
                'recordsFiltered' => intval($recordsFiltered),
                'data' => $data
            ];

            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
        } catch (Exception $e) {
            log_message('error', 'purchases_data error: '.$e->getMessage());
            return $this->output
                        ->set_status_header(500)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'draw'=>$draw,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>[],
                            'error'=>$e->getMessage()
                        ]));
        }
    }
}
?>