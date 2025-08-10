<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Orders extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Orders';

        // Load models
        $this->load->model('model_orders');
        $this->load->model('model_products');
        $this->load->model('model_company');
        $this->load->model('model_users');
        $this->load->model('model_activity_log');
        $this->load->model('model_stores');

        // Ensure store_id is set in session
        if (!$this->session->userdata('store_id')) {
            $user_id = $this->session->userdata('id');
            if ($user_id) {
                $this->db->select('store_id');
                $this->db->from('users');
                $this->db->where('id', $user_id);
                $query = $this->db->get();
                $user = $query->row();
                if ($user && $user->store_id) {
                    $this->session->set_userdata('store_id', $user->store_id);
                    
                    // Also get store name
                    $store = $this->model_stores->getStoresData($user->store_id);
                    if ($store) {
                        $this->session->set_userdata('store_name', $store['name']);
                    }
                }
            }
        }
        
        // Debug log for store information
        log_message('debug', 'Store ID in session: ' . $this->session->userdata('store_id'));
        log_message('debug', 'Store Name in session: ' . $this->session->userdata('store_name'));
    }

    public function index()
    {
        if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Orders';
        $this->data['svg_logo'] = file_get_contents(FCPATH . 'JEMAU-loading-animation-xl.svg');

        $this->render_template('orders/index', $this->data);
    }

    public function fetchOrdersData()
    {
        try {
            $orders = $this->model_orders->getOrdersData();
            
            // Debug log the orders data
            log_message('debug', 'Orders data: ' . json_encode($orders));
            
            $data = ['data' => $orders];
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
            
        } catch (Exception $e) {
            log_message('error', 'Error in fetchOrdersData: ' . $e->getMessage());
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'data' => [], 
                    'error' => 'Server error: ' . $e->getMessage()
                ]));
        }
    }

    public function create()
    {
        log_message('debug', 'Entered create() method');
        log_message('debug', 'User permissions: ' . json_encode($this->permission));
        
        // Log all form data received
        log_message('debug', '=== START FORM DATA ===');
        log_message('debug', 'POST Data: ' . json_encode($this->input->post(), JSON_PRETTY_PRINT));
        log_message('debug', 'Raw POST Data: ' . file_get_contents('php://input'));
        log_message('debug', '=== END FORM DATA ===');
        
        if (!in_array('createOrder', $this->permission)) {
            log_message('debug', 'User does not have createOrder permission');
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('customer_name', 'Client name', 'trim|required');
        $this->form_validation->set_rules('store_id', 'Store', 'trim|required|numeric');
        $this->form_validation->set_rules('store_id', 'Store', 'trim|required|integer');

        if ($this->form_validation->run() == TRUE) {
            // Clean and format numeric values
            $gross_amount = str_replace(',', '', $this->input->post('gross_amount_value'));
            $gross_amount = ($gross_amount !== null && $gross_amount !== '') ? 
                            number_format(floatval($gross_amount), 2, '.', '') : 
                            '0.00';

            // Update the amount_paid calculation
            $paid_status = intval($this->input->post('paid_status'));
            $net_amount = floatval(str_replace(',', '', $this->input->post('net_amount_value')));
            $amount_paid = 0;

            switch ($paid_status) {
                case 2: // Paid
                    $amount_paid = $net_amount;
                    break;
                case 3: // Partially Paid
                    $amount_paid = floatval(str_replace(',', '', $this->input->post('amount_paid')));
                    $net_amount = floatval(str_replace(',', '', $this->input->post('net_amount_value')));

                    // Debug logging
                    log_message('debug', '=== Partial Payment Debug ===');
                    log_message('debug', 'Raw amount_paid: ' . $this->input->post('amount_paid'));
                    log_message('debug', 'Raw net_amount: ' . $this->input->post('net_amount_value'));
                    log_message('debug', 'Cleaned amount_paid: ' . $amount_paid);
                    log_message('debug', 'Cleaned net_amount: ' . $net_amount);
                    log_message('debug', 'Comparison result: ' . ($amount_paid >= $net_amount ? 'true' : 'false'));
                    log_message('debug', '========================');

                    if ($amount_paid <= 0) {
                        if ($this->input->is_ajax_request()) {
                            echo json_encode([
                                'success' => false,
                                'error' => 'Amount paid must be greater than zero'
                            ]);
                            return;
                        }
                        $this->session->set_flashdata('error', 'Amount paid must be greater than zero');
                        redirect('Controller_Orders/create', 'refresh');
                    }

                    // Fix comparison by using strict float comparison
                    if (bccomp($amount_paid, $net_amount, 2) >= 0) {
                        if ($this->input->is_ajax_request()) {
                            echo json_encode([
                                'success' => false,
                                'error' => 'Partial payment cannot be greater than or equal to total amount'
                            ]);
                            return;
                        }
                        $this->session->set_flashdata('error', 'Partial payment cannot be greater than or equal to total amount');
                        redirect('Controller_Orders/create', 'refresh');
                    }
                    break;
                default: // Not Paid (1)
                    $amount_paid = 0;
                    break;
            }

            // Update the order data array with cleaned numeric values
            $order_data = array(
                'bill_no' => 'BILPR-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4)),
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address') ?? '',
                'customer_phone' => $this->input->post('customer_phone') ?? '',
                'date_time' => date('Y-m-d H:i:s'),
                'gross_amount' => $gross_amount,
                'service_charge_rate' => floatval(str_replace(',', '', $this->input->post('service_charge_rate') ?? '0')),
                'service_charge' => floatval(str_replace(',', '', $this->input->post('service_charge_value') ?? '0')),
                'vat_charge_rate' => floatval(str_replace(',', '', $this->input->post('vat_charge_rate') ?? '0')),
                'vat_charge' => floatval(str_replace(',', '', $this->input->post('vat_charge_value') ?? '0')),
                'net_amount' => number_format($net_amount, 2, '.', ''),
                'discount' => floatval(str_replace(',', '', $this->input->post('discount') ?? '0')),
                'paid_status' => $paid_status,
                'amount_paid' => number_format($amount_paid, 2, '.', ''),
                'user_id' => $this->session->userdata('id'),
                'store_id' => $this->session->userdata('store_id')
            );

            // Debug logging
            log_message('debug', 'Order data after cleaning:');
            log_message('debug', json_encode($order_data));

            $this->db->trans_start();
            
            // Enable query logging
            $this->db->db_debug = TRUE;
            $this->db->save_queries = TRUE;

            // Insert order data
            $create_order = $this->db->insert('orders', $order_data);
            $order_id = $this->db->insert_id();

            // Get the order insert query
            $order_query = $this->db->last_query();

            // Prepare order items
            $products = $this->input->post('product');
            $qtys = $this->input->post('qty');
            $rates = $this->input->post('rate');
            $amounts = $this->input->post('amount_value');

            $order_items = array();
            foreach ($products as $key => $product_id) {
                $order_items[] = array(
                    'order_id' => $order_id,
                    'product_id' => intval($product_id),
                    'qty' => intval($qtys[$key]),
                    'rate' => floatval($rates[$key]),
                    'amount' => floatval($amounts[$key])
                );
            }

            // Insert order items and collect queries
            $item_queries = [];
            if (!empty($order_items)) {
                $this->db->insert_batch('orders_item', $order_items);
                $item_queries[] = $this->db->last_query();
            }

            $this->db->trans_complete();

            // If this is an AJAX request
            if ($this->input->is_ajax_request()) {
                if ($this->db->trans_status() === TRUE) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Order created successfully',
                        'order_id' => $order_id,
                        'debug' => [
                            'sql' => [
                                'order' => $order_query,
                                'items' => $item_queries
                            ]
                        ]
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'error' => 'Database error',
                        'debug' => [
                            'sql' => [
                                'order' => $order_query,
                                'items' => $item_queries,
                                'error' => $this->db->error()
                            ]
                        ]
                    ]);
                }
                return;
            }

            // Success response
            if ($this->db->trans_status() === TRUE) {
                // Get all executed queries
                $queries = $this->db->queries;
                
                if ($this->input->is_ajax_request()) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Order created successfully',
                        'order_id' => $order_id,
                        'debug' => [
                            'sql' => $queries // Add queries to response
                        ]
                    ]);
                    return;
                }
            } else {
                if ($this->input->is_ajax_request()) {
                    echo json_encode([
                        'success' => false,
                        'error' => 'Database error',
                        'debug' => [
                            'sql' => $this->db->queries // Add queries even on error
                        ]
                    ]);
                    return;
                }
            }

            $this->session->set_flashdata('success', 'Order created successfully');
            redirect('Controller_Orders/index', 'refresh');
        } else {
            // Validation failed
            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'success' => false,
                    'error' => validation_errors()
                ]);
                return;
            }
            $this->data['page_title'] = 'Add Order';
            $this->load_form_data();
        }    
    }

    private function load_form_data()
    {
        $company = $this->model_company->getCompanyData(1);
        $this->data['company_data'] = $company;
        $this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        $this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
        
        // Get user's store information
        $user_id = $this->session->userdata('id');
        $this->db->select('s.id as store_id, s.name as store_name');
        $this->db->from('users u');
        $this->db->join('stores s', 'u.store_id = s.id');
        $this->db->where('u.id', $user_id);
        $query = $this->db->get();
        $store_data = $query->row_array();
        
        log_message('debug', 'Store Query: ' . $this->db->last_query());
        log_message('debug', 'Store Data: ' . print_r($store_data, true));
        
        $this->data['store_data'] = $store_data;

        // Fetch products with calculated stock
        $this->db->select('p.id, p.name, p.price, 
            COALESCE(SUM(pur.qty), 0) as total_purchased,
            COALESCE((SELECT SUM(oi.qty) FROM orders_item oi WHERE oi.product_id = p.id AND oi.order_id > 0), 0) as total_ordered');
        $this->db->from('products p'); 
        $this->db->where('p.availability', 1);
        $this->db->join('purchases pur', 'pur.product_id = p.id', 'left');
        $this->db->group_by('p.id, p.name, p.price');
        $query = $this->db->get();
        
        log_message('debug', 'load_form_data Query: ' . $this->db->last_query());
        if ($query === FALSE) {
            log_message('error', 'load_form_data Database Error: ' . $this->db->error()['message']);
            // Fallback to basic product data
            $products_with_stock = array();
            $products = $this->model_products->getActiveProductData();
            foreach ($products as $product) {
                // Calculate stock for fallback
                $this->db->select_sum('qty', 'total_purchased');
                $this->db->where('product_id', $product['id']);
                $purchase_query = $this->db->get('purchases');
                $total_purchased = $purchase_query->row()->total_purchased ? (int)$purchase_query->row()->total_purchased : 0;

                $this->db->select_sum('qty', 'total_ordered');
                $this->db->where('product_id', $product['id']);
                $this->db->where('order_id >', 0);
                $order_item_query = $this->db->get('orders_item');
                $total_ordered = $order_item_query->row()->total_ordered ? (int)$order_item_query->row()->total_ordered : 0;

                $stock = max(0, $total_purchased - $total_ordered);
                log_message('debug', 'load_form_data Fallback - Product ID: ' . $product['id'] . ', Name: ' . $product['name'] . ', Total Purchased: ' . $total_purchased . ', Total Ordered: ' . $total_ordered . ', Stock: ' . $stock);

                if ($stock > 0 && $product['price'] > 0) {
                    $products_with_stock[] = array(
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'qty' => $stock
                    );
                }
            }
        } else {
            $products_with_stock = array();
            foreach ($query->result_array() as $product) {
                $stock = max(0, (int)$product['total_purchased'] - (int)$product['total_ordered']);
                log_message('debug', 'load_form_data - Product ID: ' . $product['id'] . ', Name: ' . $product['name'] . ', Total Purchased: ' . $product['total_purchased'] . ', Total Ordered: ' . $product['total_ordered'] . ', Stock: ' . $stock);
                if ($stock > 0 && $product['price'] > 0) {
                    $products_with_stock[] = array(
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'qty' => $stock
                    );
                }
            }
        }

        log_message('debug', 'load_form_data Products with stock: ' . json_encode($products_with_stock));
        $this->data['products'] = $products_with_stock;
        
        $this->render_template('orders/create', $this->data);
    }

    public function getProductValueById()
    {
        $product_id = $this->input->post('product_id');
        log_message('debug', 'Received product_id: ' . var_export($product_id, true));

        if (!$product_id || !is_numeric($product_id)) {
            log_message('error', 'getProductValueById - Invalid product ID: ' . var_export($product_id, true));
            echo json_encode(array('error' => 'Invalid product ID'));
            return;
        }

        $product_data = $this->model_products->getProductData($product_id);
        if (!$product_data || $product_data['availability'] != 1) {
            log_message('error', 'getProductValueById - Product not found or unavailable: ' . $product_id);
            echo json_encode(array('error' => 'Product not found or unavailable'));
            return;
        }

        $this->db->select_sum('qty', 'total_purchased');
        $this->db->where('product_id', $product_id);
        $purchase_query = $this->db->get('purchases');
        log_message('debug', 'getProductValueById Purchase Query: ' . $this->db->last_query());
        if ($purchase_query === FALSE) {
            log_message('error', 'getProductValueById Purchase Error: ' . $this->db->error()['message']);
            echo json_encode(array('error' => 'Database error: Unable to fetch purchase data'));
            return;
        }
        $total_purchased = $purchase_query->row()->total_purchased ? (int)$purchase_query->row()->total_purchased : 0;

        $this->db->select_sum('qty', 'total_ordered');
        $this->db->where('product_id', $product_id);
        $this->db->where('order_id >', 0);
        $order_item_query = $this->db->get('orders_item');
        log_message('debug', 'getProductValueById Order Item Query: ' . $this->db->last_query());
        if ($order_item_query === FALSE) {
            log_message('error', 'getProductValueById Order Item Error: ' . $this->db->error()['message']);
            echo json_encode(array('error' => 'Database error: Unable to fetch order item data'));
            return;
        }
        $total_ordered = $order_item_query->row()->total_ordered ? (int)$order_item_query->row()->total_ordered : 0;

        $stock = max(0, $total_purchased - $total_ordered);
        log_message('debug', 'getProductValueById - Product ID: ' . $product_id . ', Total Purchased: ' . $total_purchased . ', Total Ordered: ' . $total_ordered . ', Stock: ' . $stock);

        $response = array(
            'id' => $product_data['id'],
            'name' => $product_data['name'],
            'price' => $product_data['price'],
            'qty' => $stock
        );
        echo json_encode($response);
    }

    public function getTableProductRow()
    {
        $products = $this->model_products->getActiveProductData();
        $products_with_stock = array();
        
        foreach ($products as $product) {
            $this->db->select_sum('qty', 'total_purchased');
            $this->db->where('product_id', $product['id']);
            $purchase_query = $this->db->get('purchases');
            log_message('debug', 'getTableProductRow Purchase Query: ' . $this->db->last_query());
            if ($purchase_query === FALSE) {
                log_message('error', 'getTableProductRow Purchase Error: ' . $this->db->error()['message']);
            }
            $total_purchased = $purchase_query->row()->total_purchased ? (int)$purchase_query->row()->total_purchased : 0;

            $this->db->select_sum('qty', 'total_ordered');
            $this->db->where('product_id', $product['id']);
            $this->db->where('order_id >', 0);
            $order_item_query = $this->db->get('orders_item');
            log_message('debug', 'getTableProductRow Order Item Query: ' . $this->db->last_query());
            if ($order_item_query === FALSE) {
                log_message('error', 'getTableProductRow Order Item Error: ' . $this->db->error()['message']);
            }
            $total_ordered = $order_item_query->row()->total_ordered ? (int)$order_item_query->row()->total_ordered : 0;

            $stock = max(0, $total_purchased - $total_ordered);
            log_message('debug', 'getTableProductRow - Product ID: ' . $product['id'] . ', Name: ' . $product['name'] . ', Total Purchased: ' . $total_purchased . ', Total Ordered: ' . $total_ordered . ', Stock: ' . $stock);

            if ($stock > 0 && $product['price'] > 0) {
                $products_with_stock[] = array(
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'qty' => $stock
                );
            }
        }

        log_message('debug', 'getTableProductRow response: ' . json_encode($products_with_stock));
        echo json_encode($products_with_stock);
    }

    public function update($id)
    {
        if (!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$id) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Update Order';
        $this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'trim|required|numeric|greater_than[0]', [
            'required' => 'Quantity is required for all products.',
            'numeric' => 'Quantity must be a number.',
            'greater_than' => 'Quantity must be greater than 0.'
        ]);
        $this->form_validation->set_rules('customer_name', 'Client name', 'trim|required');
        
        $this->form_validation->set_rules('paid_status', 'Paid Status', 'required|in_list[1,2,3]');
        if ($this->input->post('paid_status') == 3) {
            $this->form_validation->set_rules('amount_paid', 'Amount Paid', 'required|numeric|greater_than[0]|less_than['.$this->input->post('net_amount_value').']');
        }

        if ($this->form_validation->run() == TRUE) {            
            $paid_status = $this->input->post('paid_status');
            if ($paid_status !== null) {
                $_POST['paid_status'] = $paid_status;
            }

            // Update order data
            $order_data = array(
                'bill_no' => $this->input->post('bill_no'),
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phone' => $this->input->post('customer_phone'),
                'gross_amount' => floatval($this->input->post('gross_amount')),
                'service_charge_rate' => floatval($this->input->post('service_charge_rate') ?? 0),
                'service_charge' => floatval($this->input->post('service_charge_value') ?? 0),
                'vat_charge_rate' => floatval($this->input->post('vat_charge_rate') ?? 0),
                'vat_charge' => floatval($this->input->post('vat_charge_value') ?? 0),
                'discount' => floatval($this->input->post('discount') ?? 0),
                'net_amount' => floatval($this->input->post('net_amount')),
                'paid_status' => $this->input->post('paid_status'),
                'amount_paid' => ($this->input->post('paid_status') == 2) ? 
                                $this->input->post('net_amount') :
                                ($this->input->post('paid_status') == 3 ? 
                                 $this->input->post('amount_paid') : 0)
            );

            // Debug logging
            log_message('debug', 'Updating order with data: ' . json_encode($order_data));
            
            $this->db->trans_start(); // Start transaction

            // Update order
            $this->db->where('id', $id);
            $this->db->update('orders', $order_data);
            log_message('debug', 'Order Update Query: ' . $this->db->last_query());

            // Delete existing order items
            $this->db->where('order_id', $id);
            $this->db->delete('orders_item');

            // Prepare order items
            $products = $this->input->post('product');
            $qtys = $this->input->post('qty');
            $rates = $this->input->post('rate');
            $amounts = $this->input->post('amount_value');

            $order_items = array();
            foreach ($products as $key => $product_id) {
                $order_items[] = array(
                    'order_id' => $id,
                    'product_id' => intval($product_id),
                    'qty' => intval($qtys[$key]),
                    'rate' => floatval($rates[$key]),
                    'amount' => floatval($amounts[$key])
                );
            }

            // Insert new order items and log the query
            if (!empty($order_items)) {
                log_message('debug', 'Order items to be inserted: ' . json_encode($order_items));
                $this->db->insert_batch('orders_item', $order_items);
                log_message('debug', 'Order Items Insert Query: ' . $this->db->last_query());
            }

            $this->db->trans_complete(); // Complete transaction

            if ($this->input->is_ajax_request()) {
                if ($this->db->trans_status() === FALSE) {
                    log_message('error', 'Order update failed: ' . $this->db->error()['message']);
                    echo json_encode([
                        'success' => false,
                        'error' => 'Error occurred while updating the order!'
                    ]);
                } else {
                    log_message('debug', 'Order updated successfully. Order ID: ' . $id);
                    echo json_encode([
                        'success' => true,
                        'redirect' => base_url('Controller_Orders/index')
                    ]);
                }
                return;
            } else {
                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata('error', 'Error occurred while updating the order');
                    redirect('Controller_Orders/update/'.$id, 'refresh');
                } else {
                    $this->session->set_flashdata('success', 'Successfully updated order');
                    redirect('Controller_Orders/index', 'refresh');
                }
            }
        } else {
            $company = $this->model_company->getCompanyData(1);
            $this->data['company_data'] = $company;
            $this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
            $this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

            $result = array();
            $orders_data = $this->model_orders->getOrdersData($id);
            if ($orders_data) {
                $result['order'] = $orders_data;
                
                $orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);
                if (is_array($orders_item)) {
                    foreach ($orders_item as $k => $v) {
                        $result['order_item'][] = $v;
                    }
                } else {
                    $result['order_item'] = array();
                }
            } else {
                $this->session->set_flashdata('errors', 'Order data not found!');
                redirect('Controller_Orders/', 'refresh');
            }

            $this->data['order_data'] = $result;
            $this->data['products'] = $this->model_products->getActiveProductData();
            $this->render_template('orders/update', $this->data);
        }
    }

    public function remove()
    {
        if (!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $order_id = $this->input->post('id');
        $response = array('success' => false, 'messages' => '');

        if ($order_id) {
            // Check if order exists
            $order = $this->model_orders->getOrdersData($order_id);
            if (!$order) {
                $response['messages'] = "Order not found!";
            } else {
                $this->db->trans_start(); // Start transaction

                // Delete order items
                $this->db->where('order_id', $order_id);
                $this->db->delete('orders_item');

                // Delete order
                $this->db->where('id', $order_id);
                $this->db->delete('orders');

                $this->db->trans_complete(); // Complete transaction

                if ($this->db->trans_status() === FALSE) {
                    $response['messages'] = "Error in the database while removing the order";
                } else {
                    $response['success'] = true;
                    $response['messages'] = "Order removed successfully";
                }
            }
        } else {
            $response['messages'] = "Refresh the page again!!";
        }

        echo json_encode($response); 
    }

    public function printDiv($id)
    {
        // If not AJAX request or direct access, redirect to orders page
        if (!$this->input->is_ajax_request()) {
            redirect('Controller_Orders');
            return;
        }

        // Validate order ID
        if (!$id || !is_numeric($id)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid order ID']);
            return;
        }

        // Get order data
        $order_data = $this->model_orders->getOrdersData($id);
        if (!$order_data) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Order not found']);
            return;
        }

        // Set content type for HTML response
        header('Content-Type: text/html; charset=utf-8');

        $orders_items = $this->model_orders->getOrdersItemData($id);
        $company_info = $this->model_company->getCompanyData(1);

        $order_date = new DateTime($order_data['date_time']);
        $formatted_date = $order_date->format('Y-m-d');
        $formatted_time = $order_date->format('h:i A');

        // Calculate subtotals
        $subtotal = floatval($order_data['gross_amount']);
        $vat = floatval($order_data['vat_charge']);
        $service = floatval($order_data['service_charge']);
        $discount = floatval($order_data['discount']);
        $total = floatval($order_data['net_amount']);

        // Clean HTML template
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Invoice #'.$order_data['bill_no'].'</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    color: #333;
                }
                .invoice-container {
                    max-width: 800px;
                    margin: 0 auto;
                    background: #fff;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .header {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                    padding-bottom: 20px;
                    border-bottom: 1px solid #eee;
                }
                .company-info {
                    text-align: right;
                }
                .invoice-title {
                    font-size: 24px;
                    font-weight: bold;
                    color: #3a7bd5;
                    margin-bottom: 10px;
                }
                .invoice-details {
                    margin-bottom: 20px;
                }
                .customer-info {
                    margin-bottom: 20px;
                    padding: 15px;
                    background: #f9f9f9;
                    border-radius: 5px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                table th {
                    background: #3a7bd5;
                    color: white;
                    padding: 10px;
                    text-align: left;
                }
                table td {
                    padding: 10px;
                    border-bottom: 1px solid #eee;
                }
                .text-right {
                    text-align: right;
                }
                .totals {
                    margin-left: auto;
                    width: 300px;
                }
                .totals table {
                    width: 100%;
                }
                .totals td {
                    padding: 8px;
                }
                .totals tr:last-child td {
                    font-weight: bold;
                    border-top: 1px solid #333;
                }
                .footer {
                    margin-top: 30px;
                    padding-top: 20px;
                    border-top: 1px solid #eee;
                    font-size: 12px;
                    color: #777;
                }
                .status {
                    display: inline-block;
                    padding: 5px 10px;
                    border-radius: 3px;
                    font-weight: bold;
                }
                .status-paid {
                    background: #4CAF50;
                    color: white;
                }
                .status-unpaid {
                    background: #F44336;
                    color: white;
                }
                .payment-status {
                    padding: 5px 10px;
                    border-radius: 4px;
                    font-weight: bold;
                }
                .payment-status.paid {
                    color: #00a65a;
                    border: 2px solid #00a65a;
                }
                .payment-status.partially {
                    color: #f39c12;
                    border: 2px solid #f39c12;
                }
                .payment-status.unpaid {
                    color: #dd4b39;
                    border: 2px solid #dd4b39;
                }
                .partial-payment-details {
                    margin-top: 10px;
                    padding: 10px;
                    background-color: #f9f9f9;
                    border-left: 3px solid #f39c12;
                }
                @media print {
                    body {
                        padding: 0;
                    }
                    .invoice-container {
                        box-shadow: none;
                    }
                }
            </style>
        </head>
        <body>
            <div class="invoice-container">
                <div class="header">
                    <div>
                        <div class="invoice-title">INVOICE</div>
                        <div class="invoice-details">
                            <strong>Invoice #:</strong> '.$order_data['bill_no'].'<br>
                            <strong>Date:</strong> '.$formatted_date.'<br>
                            <strong>Time:</strong> '.$formatted_time.'
                        </div>
                    </div>
                    <div class="company-info">
                        <h2>'.$company_info['company_name'].'</h2>
                        <p>'.$company_info['address'].'</p>
                        <p>Phone: '.$company_info['phone'].'</p>
                        <p>TIN: '.$company_info['tin'].'</p>
                    </div>
                </div>

                <div class="customer-info">
                    <h3>Bill To:</h3>
                    <p><strong>Name:</strong> '.$order_data['customer_name'].'</p>
                    <p><strong>Address:</strong> '.$order_data['customer_address'].'</p>
                    <p><strong>Phone:</strong> '.$order_data['customer_phone'].'</p>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price ('.$company_info['currency'].')</th>
                            <th>Qty</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($orders_items as $item) {
            $html .= '
                        <tr>
                            <td>'.$item['product_name'].'</td>
                            <td>'.number_format(floatval($item['rate']), 2).'</td>
                            <td>'.$item['qty'].'</td>
                            <td class="text-right">'.number_format(floatval($item['amount']), 2).'</td>
                        </tr>';
        }

        $html .= '
                    </tbody>
                </table>

                <div class="totals">
                    <table>
                        <tr>
                            <td>Subtotal:</td>
                            <td class="text-right">'.$company_info['currency'].' '.number_format(floatval($subtotal), 2).'</td>
                        </tr>';

        if ($vat > 0) {
            $html .= '
                        <tr>
                            <td>VAT ('.$order_data['vat_charge_rate'].'%):</td>
                            <td class="text-right">'.$company_info['currency'].' '.number_format(floatval($vat), 2).'</td>
                        </tr>';
        }

        if ($service > 0) {
            $html .= '
                        <tr>
                            <td>Service Charge ('.$order_data['service_charge_rate'].'%):</td>
                            <td class="text-right">'.$company_info['currency'].' '.number_format(floatval($service), 2).'</td>
                        </tr>';
        }

        if ($discount > 0) {
            $html .= '
                        <tr>
                            <td>Discount:</td>
                            <td class="text-right">-'.$company_info['currency'].' '.number_format(floatval($discount), 2).'</td>
                        </tr>';
        }

        // Add payment status section before the final total
        if ($order_data['paid_status'] == 3) { // Partially Paid
            $html .= '
                        <tr>
                            <td>Total Amount:</td>
                            <td class="text-right">'.$company_info['currency'].' '.number_format($order_data['net_amount'], 2).'</td>
                        </tr>
                        <tr>
                            <td>Amount Paid:</td>
                            <td class="text-right">'.$company_info['currency'].' '.number_format($order_data['amount_paid'], 2).'</td>
                        </tr>
                        <tr>
                            <td><strong>Balance Due:</strong></td>
                            <td class="text-right"><strong>'.$company_info['currency'].' '.number_format($order_data['net_amount'] - $order_data['amount_paid'], 2).'</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center" style="padding-top: 20px;">
                                <strong>Payment Status: </strong>
                                <span style="color: #f39c12;">PARTIALLY PAID</span>
                            </td>
                        </tr>';
        } else {
            $html .= '
                        <tr>
                            <td><strong>Total Amount:</strong></td>
                            <td class="text-right"><strong>'.$company_info['currency'].' '.number_format(floatval($total), 2).'</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center" style="padding-top: 20px;">
                                <strong>Payment Status: </strong>'.
                                ($order_data['paid_status'] == 1 ? 
                                    '<span style="color: #00a65a;">PAID</span>' : 
                                    '<span style="color: #dd4b39;">NOT PAID</span>').
                            '</td>
                        </tr>';
        }

        $html .= '
                </div>

                <div class="footer" style="margin-top: 30px; text-align: center; padding: 20px; border-top: 1px solid #eee;">
                    <p style="margin: 5px 0;">Thank you for your support!</p>
                    <p style="margin: 5px 0;">This is a computer generated invoice and does not require signature.</p>
                </div>
            </div>

            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() {
                        window.close();
                    };
                };
            </script>
        </body>
        </html>';

        echo $html;
    }

    public function mockCreateOrder()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('dashboard', 'refresh');
            return;
        }

        $form_data = $this->input->post();
        
        // Generate bill_no
        $bill_no = 'BILPR-' . strtoupper(substr(md5(uniqid()), 0, 4));
        
        // Get the store_id and current timestamp
        $store_id = intval($form_data['store_id']);
        $current_datetime = $form_data['date_time'] ?? date('Y-m-d H:i:s');

        // Format the main order SQL query
        $order_sql = sprintf(
            "-- Main Order Insert Query\nINSERT INTO orders (\n" .
            "    bill_no, customer_name, customer_address, customer_phone,\n" .
            "    gross_amount, service_charge_rate, service_charge,\n" .
            "    vat_charge_rate, vat_charge, discount,\n" .
            "    net_amount, paid_status, user_id, store_id, date_time\n" .
            ") VALUES (\n" .
            "    '%s',  -- bill_no\n" .
            "    %s,    -- customer_name\n" .
            "    %s,    -- customer_address\n" .
            "    %s,    -- customer_phone\n" .
            "    %.2f,  -- gross_amount\n" .
            "    %.2f,  -- service_charge_rate\n" .
            "    %.2f,  -- service_charge\n" .
            "    %.2f,  -- vat_charge_rate\n" .
            "    %.2f,  -- vat_charge\n" .
            "    %.2f,  -- discount\n" .
            "    %.2f,  -- net_amount\n" .
            "    %d,    -- paid_status\n" .
            "    %d,    -- user_id\n" .
            "    %d,    -- store_id\n" .
            "    '%s'   -- date_time\n" .
            ");",
            $bill_no,
            $this->db->escape($form_data['customer_name']),
            $this->db->escape($form_data['customer_address'] ?? ''),
            $this->db->escape($form_data['customer_phone'] ?? ''),
            floatval($form_data['gross_amount_value']),
            floatval($form_data['service_charge_rate'] ?? 0),
            floatval($form_data['service_charge_value'] ?? 0),
            floatval($form_data['vat_charge_rate'] ?? 0),
            floatval($form_data['vat_charge_value'] ?? 0),
            floatval($form_data['discount'] ?? 0),
            floatval($form_data['net_amount_value']),
            intval($form_data['paid_status']),
            intval($this->session->userdata('id')),
            $store_id,
            $current_datetime
        );

        // Format the order items SQL queries
        $items_sql = [];
        if (!empty($form_data['product'])) {
            foreach ($form_data['product'] as $key => $product_id) {
                $items_sql[] = sprintf(
                    "-- Order Item Insert Query for Product ID: %d\n" .
                    "INSERT INTO orders_item (\n" .
                    "    order_id, product_id, qty, rate, amount\n" .
                    ") VALUES (\n" .
                    "    LAST_INSERT_ID(),  -- order_id (from previous insert)\n" .
                    "    %d,    -- product_id\n" .
                    "    %d,    -- qty\n" .
                    "    %.2f,  -- rate\n" .
                    "    %.2f   -- amount\n" .
                    ");",
                    intval($product_id),
                    intval($product_id),
                    intval($form_data['qty'][$key]),
                    floatval($form_data['rate'][$key]),
                    floatval($form_data['amount_value'][$key])
                );
            }
        }

        // Combine all SQL with START TRANSACTION and COMMIT
        $full_sql = "-- Start Transaction\nSTART TRANSACTION;\n\n" . 
                   $order_sql . "\n\n" .
                   implode("\n\n", $items_sql) . "\n\n" .
                   "-- Commit Transaction\nCOMMIT;";

        // Return the formatted SQL
        echo json_encode([
            'mock_sql' => $full_sql,
            'bill_no' => $bill_no
        ]);
    }

    public function edit($id) 
    {
        if (!$id) {
            redirect('Controller_Orders');
        }

        $this->data['page_title'] = 'Edit Order';
        
        // Get order data
        $order = $this->model_orders->getOrdersData($id);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('Controller_Orders');
        }

        // Structure order data with default values
        $this->data['order_data'] = array(
            'order' => array(
                'id' => $order['id'],
                'bill_no' => $order['bill_no'],
                'customer_name' => $order['customer_name'],
                'customer_address' => $order['customer_address'] ?? '',
                'customer_phone' => $order['customer_phone'],
                'date_time' => $order['date_time'],
                'gross_amount' => $order['gross_amount'],
                'service_charge_rate' => $order['service_charge_rate'] ?? 0,
                'service_charge' => $order['service_charge'] ?? 0,
                'vat_charge_rate' => $order['vat_charge_rate'] ?? 0,
                'vat_charge' => $order['vat_charge'] ?? 0,
                'net_amount' => $order['net_amount'],
                'discount' => $order['discount'] ?? 0,
                'paid_status' => $order['paid_status'] ?? 1,
                'amount_paid' => $order['amount_paid'] ?? 0
            )
        );

        // Get order items
        $this->data['order_data']['order_item'] = $this->model_orders->getOrdersItemData($id);

        // Get company data with default values
        $company = $this->model_company->getCompanyData(1);
        $this->data['company_data'] = array(
            'company_name' => $company['company_name'] ?? '',
            'service_charge_value' => $company['service_charge_value'] ?? 0,
            'vat_charge_value' => $company['vat_charge_value'] ?? 0,
            'address' => $company['address'] ?? '',
            'phone' => $company['phone'] ?? '',
            'tin' => $company['tin'] ?? ''
        );

        $this->data['is_vat_enabled'] = ($this->data['company_data']['vat_charge_value'] > 0);
        $this->data['is_service_enabled'] = ($this->data['company_data']['service_charge_value'] > 0);
        
        // Get active products
        $this->data['products'] = $this->model_products->getActiveProductData();

        $this->render_template('orders/edit', $this->data);
    }

    public function printInvoice($id) 
    {
        if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if($id) {
            $order_data = $this->model_orders->getOrdersData($id);
            $orders_items = $this->model_orders->getOrdersItemData($id);
            $company_info = $this->model_company->getCompanyData(1);

            $order_date = date('d/m/Y', strtotime($order_data['date_time']));
            
            // Get correct payment status
            $paid_status = '';
            if ($order_data['paid_status'] == 2) {
                $paid_status = 'PAID';
                $status_color = '#00a65a';
            } elseif ($order_data['paid_status'] == 3) {
                $paid_status = 'PARTIALLY PAID';
                $status_color = '#f39c12';
            } else {
                $paid_status = 'NOT PAID';
                $status_color = '#dd4b39';
            }

            // Start HTML template
            $html = '<!-- Previous HTML code remains the same until status display -->';

            // Update the payment status display in details section
            $html .= '<div class="invoice-details">
                <p><strong>Invoice #:</strong> '.$order_data['bill_no'].'</p>
                <p><strong>Date:</strong> '.$order_date.'</p>
                <p><strong>Payment Status:</strong> <span style="color: '.$status_color.'; font-weight: bold;">'.$paid_status.'</span></p>
            </div>';

            // Rest of the HTML until payment totals
            $html .= '<!-- Previous HTML code remains the same until payment totals -->';

            // Update payment totals section based on status
            if ($order_data['paid_status'] == 3) {
                $html .= '<tr>
                    <td>Total Amount:</td>
                    <td class="text-right">'.$company_info['currency'].' '.number_format($order_data['net_amount'], 2).'</td>
                </tr>
                <tr>
                    <td>Amount Paid:</td>
                    <td class="text-right">'.$company_info['currency'].' '.number_format($order_data['amount_paid'], 2).'</td>
                </tr>
                <tr>
                    <td><strong>Balance Due:</strong></td>
                    <td class="text-right"><strong>'.$company_info['currency'].' '.number_format($order_data['net_amount'] - $order_data['amount_paid'], 2).'</strong></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center" style="padding-top: 20px;">
                        <strong>Payment Status: </strong>
                        <span style="color: #f39c12;">PARTIALLY PAID</span>
                    </td>
                </tr>';
            } else {
                $html .= '<tr>
                    <td><strong>Total Amount:</strong></td>
                    <td class="text-right"><strong>'.$company_info['currency'].' '.number_format(floatval($order_data['net_amount']), 2).'</strong></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center" style="padding-top: 20px;">
                        <strong>Payment Status: </strong>
                        <span style="color: '.$status_color.';">'.$paid_status.'</span>
                    </td>
                </tr>';
            }

            // Rest of the HTML remains the same
            $html .= '<!-- Rest of the HTML template -->';

            echo $html;
        }
    }

    public function thermalPrint($id) 
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$id) {
            show_404();
            return;
        }

        try {
            $order_data = $this->model_orders->getOrdersData($id);
            $orders_items = $this->model_orders->getOrdersItemData($id);
            $company_info = $this->model_company->getCompanyData(1);

            // Verify data exists
            if (!$order_data || !$orders_items || !$company_info) {
                throw new Exception('Required data not found');
            }

            // Format data for view
            $data = array(
                'order_data' => $order_data,
                'orders_items' => $orders_items,
                'company_info' => $company_info
            );

            // Load view with data
            $this->load->view('orders/thermal_receipt', $data);

        } catch (Exception $e) {
            log_message('error', 'Thermal Print Error: ' . $e->getMessage());
            echo '<div class="alert alert-danger">Error generating receipt. Please try again.</div>';
        }
    }

    public function printProforma($id)
    {
        try {
            // Check permissions
            if (!in_array('viewOrder', $this->permission)) {
                throw new Exception('Permission denied');
            }

            // Validate ID
            if (!$id || !is_numeric($id)) {
                throw new Exception('Invalid order ID');
            }

            // Get required data with validation
            $order_data = $this->model_orders->getOrdersData($id);
            if (!$order_data) {
                throw new Exception('Order not found');
            }

            $orders_items = $this->model_orders->getOrdersItemData($id);
            if (!$orders_items) {
                throw new Exception('Order items not found');
            }

            $company_info = $this->model_company->getCompanyData(1);
            if (!$company_info) {
                throw new Exception('Company information not found');
            }

            // Validate required fields
            $required_fields = [
                'order_data' => ['bill_no', 'customer_name', 'customer_phone', 'customer_address', 'date_time'],
                'company_info' => ['company_name', 'address', 'phone', 'tin']
            ];

            foreach ($required_fields['order_data'] as $field) {
                if (!isset($order_data[$field])) {
                    throw new Exception("Missing order field: {$field}");
                }
            }

            foreach ($required_fields['company_info'] as $field) {
                if (!isset($company_info[$field])) {
                    throw new Exception("Missing company field: {$field}");
                }
            }

            // Set timezone
            date_default_timezone_set('Africa/Nairobi');

            // Prepare data for view
            $data = array(
                'order_data' => $order_data,
                'orders_items' => $orders_items,
                'company_info' => $company_info
            );

            // Load view
            $html = $this->load->view('orders/proforma_invoice', $data, true);
            
            // Output the HTML
            echo $html;

        } catch (Exception $e) {
            // Log error
            log_message('error', 'Proforma Invoice Error: ' . $e->getMessage());
            
            // Return error response
            $error_html = '
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    .alert { 
                        padding: 15px; 
                        margin: 20px; 
                        border: 1px solid #f5c6cb; 
                        border-radius: 4px; 
                        color: #721c24; 
                        background-color: #f8d7da; 
                    }
                </style>
            </head>
            <body>
                <div class="alert">
                    Error generating proforma invoice: ' . htmlspecialchars($e->getMessage()) . '
                    <br><br>
                    Please try again or contact support if the issue persists.
                </div>
                <script>
                    // Close window after 5 seconds
                    setTimeout(function() {
                        window.close();
                    }, 5000);
                </script>
            </body>
            </html>';
            
            echo $error_html;
        }
    }

    public function printDeliveryNote($id)
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$id) {
            show_404();
        }

        $order_data = $this->model_orders->getOrdersData($id);
        $orders_items = $this->model_orders->getOrdersItemData($id);
        $company_info = $this->model_company->getCompanyData(1);

        $html = $this->load->view('orders/delivery_note', [
            'order_data' => $order_data,
            'orders_items' => $orders_items,
            'company_info' => $company_info
        ], true);

        echo $html;
    }

    private function getPaymentStatusLabel($status) 
    {
        $status = intval($status);
        switch($status) {
            case 1:
                return [
                    'label' => 'NOT PAID',
                    'color' => '#dd4b39',
                    'class' => 'status-unpaid'
                ];
            case 2:
                return [
                    'label' => 'PAID',
                    'color' => '#00a65a',
                    'class' => 'status-paid'
                ];
            case 3:
                return [
                    'label' => 'PARTIALLY PAID',
                    'color' => '#f39c12',
                    'class' => 'status-partial'
                ];
            default:
                return [
                    'label' => 'NOT PAID',
                    'color' => '#dd4b39',
                    'class' => 'status-unpaid'
                ];
        }
    }
}
?>