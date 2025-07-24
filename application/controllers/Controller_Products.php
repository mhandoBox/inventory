<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Products extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Products';
        $this->load->model('model_products');
        $this->load->model('model_brands');
        $this->load->model('model_category');
        $this->load->model('model_stores');
        $this->load->model('model_attributes');
    }

    public function index()
    {
        if (!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['attributes'] = $this->prepareAttributeData();
        $this->data['brands'] = $this->model_brands->getActiveBrands();
        $this->data['category'] = $this->model_category->getActiveCategory();
        $this->data['stores'] = $this->model_stores->getActiveStore();

        $this->render_template('products/index', $this->data);
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
            $response = array(
                'error' => true,
                'message' => 'Permission denied'
            );
            echo json_encode($response);
            return;
        }

        $result = array('data' => array());

        $this->db->select('products.*, brands.name as brand_name, stores.name as store_name, COALESCE(SUM(purchases.qty), 0) - COALESCE(SUM(orders_item.qty), 0) as total_stock');
        $this->db->from('products');
        $this->db->join('brands', 'brands.id = products.brand_id', 'left');
        $this->db->join('stores', 'stores.id = products.store_id', 'left');
        $this->db->join('purchases', 'purchases.product_id = products.id', 'left');
        $this->db->join('orders_item', 'orders_item.product_id = products.id', 'left');
        $this->db->group_by('products.id');
        $this->db->order_by('products.id', 'DESC');
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            $stock = max(0, $value['total_stock']);
            $stock_status = $stock <= 10 ? '<span class="label label-danger">Low ('.$stock.')</span>' : $stock;

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $buttons = '';
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= '<button class="btn btn-warning btn-sm edit-product" data-id="'.$value['id'].'" data-toggle="modal" data-target="#editProductModal"><i class="fa fa-pencil"></i> Edit</button>';
            }
            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm delete-product" data-id="'.$value['id'].'"><i class="fa fa-trash"></i> Delete</button>';
            }

            $result['data'][$key] = array(
                'name' => $value['name'],
                'price' => 'TZS '.number_format($value['price'], 2),
                'unit_status' => $value['unit'],
                'warehouse' => $value['store_name'] ? $value['store_name'] : '',
                'stock' => $stock_status,
                'availability' => $availability,
                'actions' => $buttons,
                'id' => $value['id']
            );
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function fetchPurchasesData()
    {
        if (!in_array('viewProduct', $this->permission)) {
            $response = array(
                'error' => true,
                'message' => 'Permission denied'
            );
            echo json_encode($response);
            return;
        }

        $result = array('data' => array());

        $data = $this->model_products->getPurchasesData();

        foreach ($data as $key => $value) {
            $buttons = '';
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= '<button class="btn btn-warning btn-sm edit-purchase" data-id="'.$value['id'].'" data-toggle="modal" data-target="#editStockModal"><i class="fa fa-pencil"></i> Edit</button>';
            }
            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm delete-purchase" data-id="'.$value['id'].'"><i class="fa fa-trash"></i> Delete</button>';
            }

            $result['data'][$key] = array(
                'id' => $value['id'],
                'product_name' => $value['product_name'] ?? 'Unknown Product',
                'qty' => $value['qty'],
                'unit' => $value['unit'],
                'supplier' => $value['supplier'],
                'price' => number_format($value['price'], 2),
                'total_amount' => number_format($value['total_amount'], 2),
                'amount_paid' => number_format($value['amount_paid'], 2),
                'status' => $value['status'],
                'purchase_date' => $value['purchase_date'],
                'stock' => $value['stock'],
                'actions' => $buttons
            );
        }

        header('Content-Type: application/json');
        echo json_encode($result);
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
        if (!in_array('createProduct', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Permission denied']);
            return;
        }

        $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('unit', 'Unit of Measurement', 'trim|required');
        $this->form_validation->set_rules('store', 'Store', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('category', 'Category', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('availability', 'Availability', 'trim|required|in_list[0,1]');
        $this->form_validation->set_rules('brand', 'Brand', 'trim|numeric');

        if ($this->form_validation->run() == TRUE) {
            $upload_image = $this->upload_image();

            if (is_string($upload_image) && strpos($upload_image, 'assets/images/product_image') === false) {
                echo json_encode(['success' => false, 'messages' => 'Image upload failed: ' . $upload_image]);
                return;
            }

            $data = [
                'name' => $this->input->post('product_name'),
                'price' => $this->input->post('price'),
                'unit' => $this->input->post('unit'),
                'description' => $this->input->post('description') ?: '',
                'attribute_value_id' => $this->input->post('attributes_value_id') ? json_encode($this->input->post('attributes_value_id')) : NULL,
                'brand_id' => $this->input->post('brand') ? (int)$this->input->post('brand') : NULL,
                'category_id' => (int)$this->input->post('category'),
                'store_id' => (int)$this->input->post('store'),
                'availability' => (int)$this->input->post('availability'),
                'image' => is_string($upload_image) ? $upload_image : NULL
            ];

            $create = $this->model_products->create($data);
            $sql_query = $this->db->last_query();

            if ($create) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Product created successfully',
                    'sql_query' => $sql_query
                ]);
            } else {
                $db_error = $this->db->error();
                $error_message = isset($db_error['message']) ? $db_error['message'] : 'Unknown database error';
                echo json_encode([
                    'success' => false,
                    'messages' => 'Failed to create product: ' . $error_message,
                    'sql_query' => $sql_query
                ]);
            }
        } else {
            echo json_encode(['success' => false, 'messages' => validation_errors()]);
        }
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

        $this->data['purchases'] = $this->model_products->getPurchasesData();
        $this->data['products'] = $this->model_products->getActiveProductData();
        $this->render_template('products/purchases', $this->data);
    }

    public function addStock()
    {
        if (!in_array('createProduct', $this->permission)) {
            $response = array(
                'success' => false,
                'messages' => 'Permission denied'
            );
            echo json_encode($response);
            return;
        }

        $this->form_validation->set_rules('product_id', 'Product', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Paid,Unpaid,Partial]');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
        if ($this->input->post('status') === 'Partial') {
            $this->form_validation->set_rules('amount_paid', 'Amount Paid', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to['.$this->input->post('total_amount').']');
        }

        if ($this->form_validation->run() == TRUE) {
            $product_id   = $this->input->post('product_id');
            $qty          = $this->input->post('qty');
            $supplier     = $this->input->post('supplier');
            $price        = $this->input->post('price');
            $status       = $this->input->post('status');
            $unit         = $this->input->post('unit');
            $total_amount = $this->input->post('total_amount');
            $purchase_date= $this->input->post('purchase_date');
            $user_id      = $this->session->userdata('id') ?? 1;
            $amount_paid  = ($status === 'Paid') ? $total_amount : ($status === 'Partial' ? $this->input->post('amount_paid') : 0);

            // Fetch store_id from products table
            $product = $this->model_products->getProductData($product_id);
            $store_id = $product['store_id'] ?? NULL;

            // Validate total_amount matches price * qty
            if (abs($price * $qty - $total_amount) > 0.01) {
                $response = array(
                    'success' => false,
                    'messages' => 'Total amount does not match price × quantity'
                );
                echo json_encode($response);
                return;
            }

            $purchase_data = [
                'product_id'   => $product_id,
                'supplier'     => $supplier,
                'qty'          => $qty,
                'unit'         => $unit,
                'price'        => $price,
                'total_amount' => $total_amount,
                'status'       => $status,
                'purchase_date' => $purchase_date,
                'user_id'      => $user_id,
                'amount_paid'  => $amount_paid,
                'store_id'     => $store_id
            ];

            $this->db->trans_start();
            $insert = $this->db->insert('purchases', $purchase_data);
            $sql_query = $this->db->last_query();
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $db_error = $this->db->error();
                $error_message = isset($db_error['message']) ? $db_error['message'] : 'Unknown database error';
                $response = array(
                    'success' => false,
                    'messages' => 'Failed to add purchase: ' . $error_message,
                    'sql_query' => $sql_query
                );
            } else {
                $response = array(
                    'success' => true,
                    'messages' => 'Purchase added successfully',
                    'sql_query' => $sql_query
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'success' => false,
                'messages' => validation_errors()
            );
            echo json_encode($response);
        }
    }

    public function updatePurchase()
    {
        if (!in_array('updateProduct', $this->permission)) {
            $response = array(
                'success' => false,
                'messages' => 'Permission denied'
            );
            echo json_encode($response);
            return;
        }

        $this->form_validation->set_rules('purchase_id', 'Purchase ID', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('product_id', 'Product', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Paid,Unpaid,Partial]');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
        if ($this->input->post('status') === 'Partial') {
            $this->form_validation->set_rules('amount_paid', 'Amount Paid', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to['.$this->input->post('total_amount').']');
        }

        if ($this->form_validation->run() == TRUE) {
            $purchase_id  = $this->input->post('purchase_id');
            $product_id   = $this->input->post('product_id');
            $qty          = $this->input->post('qty');
            $supplier     = $this->input->post('supplier');
            $price        = $this->input->post('price');
            $status       = $this->input->post('status');
            $unit         = $this->input->post('unit');
            $total_amount = $this->input->post('total_amount');
            $purchase_date= $this->input->post('purchase_date');
            $user_id      = $this->session->userdata('id') ?? 1;
            $amount_paid  = ($status === 'Paid') ? $total_amount : ($status === 'Partial' ? $this->input->post('amount_paid') : 0);

            // Fetch store_id from products table
            $product = $this->model_products->getProductData($product_id);
            $store_id = $product['store_id'] ?? NULL;

            // Validate total_amount matches price * qty
            if (abs($price * $qty - $total_amount) > 0.01) {
                $response = array(
                    'success' => false,
                    'messages' => 'Total amount does not match price × quantity'
                );
                echo json_encode($response);
                return;
            }

            $purchase_data = [
                'product_id'   => $product_id,
                'supplier'     => $supplier,
                'qty'          => $qty,
                'unit'         => $unit,
                'price'        => $price,
                'total_amount' => $total_amount,
                'status'       => $status,
                'purchase_date' => $purchase_date,
                'user_id'      => $user_id,
                'amount_paid'  => $amount_paid,
                'store_id'     => $store_id
            ];

            $this->db->trans_start();
            $this->db->where('id', $purchase_id);
            $update = $this->db->update('purchases', $purchase_data);
            $sql_query = $this->db->last_query();
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $db_error = $this->db->error();
                $error_message = isset($db_error['message']) ? $db_error['message'] : 'Unknown database error';
                $response = array(
                    'success' => false,
                    'messages' => 'Failed to update purchase: ' . $error_message,
                    'sql_query' => $sql_query
                );
            } else {
                $response = array(
                    'success' => true,
                    'messages' => 'Purchase updated successfully',
                    'sql_query' => $sql_query
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'success' => false,
                'messages' => validation_errors()
            );
            echo json_encode($response);
        }
    }

    public function removePurchase()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            $response = array(
                'success' => false,
                'messages' => 'Permission denied'
            );
            echo json_encode($response);
            return;
        }

        $purchase_id = $this->input->post('purchase_id');

        if (!$purchase_id) {
            $response = array(
                'success' => false,
                'messages' => 'No purchase ID provided'
            );
            echo json_encode($response);
            return;
        }

        $this->db->trans_start();
        $this->db->where('id', $purchase_id);
        $delete = $this->db->delete('purchases');
        $sql_query = $this->db->last_query();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $db_error = $this->db->error();
            $error_message = isset($db_error['message']) ? $db_error['message'] : 'Unknown database error';
            $response = array(
                'success' => false,
                'messages' => 'Failed to delete purchase: ' . $error_message,
                'sql_query' => $sql_query
            );
        } else {
            $this->db->insert('activity_log', [
                'user_id' => $this->session->userdata('id') ?? 1,
                'activity' => 'Deleted Purchase',
                'details' => "Purchase ID: $purchase_id",
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $response = array(
                'success' => true,
                'messages' => 'Purchase deleted successfully',
                'sql_query' => $sql_query
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}