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
    }

    public function index()
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Manage Orders';
        $this->render_template('orders/index', $this->data);        
    }

    public function fetchOrdersData()
    {
        log_message('debug', 'fetchOrdersData called');
        log_message('debug', 'Is AJAX request: ' . ($this->input->is_ajax_request() ? 'yes' : 'no'));

        if (!$this->input->is_ajax_request()) {
            log_message('error', 'Non-AJAX request to fetchOrdersData');
            exit('No direct script access allowed');
        }

        try {
            $orders = $this->model_orders->getOrdersData();
            // Log the raw data fetched from the database
            log_message('debug', 'Raw database data from getOrdersData: ' . json_encode($orders, JSON_PRETTY_PRINT));

            $data = array('data' => array());
            if ($orders && is_array($orders)) {
                log_message('debug', 'Processing ' . count($orders) . ' orders for DataTable');
                foreach ($orders as $order) {
                    // Add detailed logging for each order's product quantity
                    log_message('debug', 'Order ID: ' . $order['id'] . ', Total Products: ' . $order['total_products']);
                    
                    if (!isset($order['id'])) {
                        log_message('error', 'Order missing ID: ' . json_encode($order));
                        continue;
                    }

                    $row = array(
                        'id' => $order['id'],
                        'bill_no' => $order['bill_no'] ?? 'N/A',
                        'customer_name' => $order['customer_name'] ?? 'N/A',
                        'customer_phone' => $order['customer_phone'] ?? 'N/A',
                        'date_time' => $order['date_time'] ? date('Y-m-d H:i:s', strtotime($order['date_time'])) : 'N/A',
                        'total_products' => intval($order['total_products'] ?? 0),
                        'total_amount' => floatval($order['total_amount'] ?? 0),
                        'clerk_name' => $order['clerk_name'] ?? 'Unknown'
                    );
                    $data['data'][] = $row;
                }
                log_message('debug', 'Processed data for DataTable: ' . json_encode($data, JSON_PRETTY_PRINT));
            } else {
                log_message('debug', 'No orders found or error in getOrdersData()');
            }
            
            header('Content-Type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            log_message('error', 'Error in fetchOrdersData: ' . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['data' => [], 'error' => 'Server error: ' . $e->getMessage()]);
        }
        exit;
    }

    public function create()
    {
        log_message('debug', 'Entered create() method');
        log_message('debug', 'User permissions: ' . json_encode($this->permission));
        
        if (!in_array('createOrder', $this->permission)) {
            log_message('debug', 'User does not have createOrder permission');
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('customer_name', 'Client name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            log_message('debug', 'Form validation passed');
            
            // Generate bill_no
            $bill_no = 'BILPR-' . strtoupper(substr(md5(uniqid()), 0, 4));
            
            // Prepare order data
            $order_data = array(
                'bill_no' => $bill_no,
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phone' => $this->input->post('customer_phone'),
                'gross_amount' => floatval($this->input->post('gross_amount_value')),
                'service_charge_rate' => floatval($this->input->post('service_charge_rate') ?? 0),
                'service_charge' => floatval($this->input->post('service_charge_value') ?? 0),
                'vat_charge_rate' => floatval($this->input->post('vat_charge_rate') ?? 0),
                'vat_charge' => floatval($this->input->post('vat_charge_value') ?? 0),
                'discount' => floatval($this->input->post('discount') ?? 0),
                'net_amount' => floatval($this->input->post('net_amount_value')),
                'paid_status' => intval($this->input->post('paid_status')),
                'user_id' => intval($this->session->userdata('id'))
            );

            $this->db->trans_start(); // Start transaction

            // Insert order
            $this->db->insert('orders', $order_data);
            $order_id = $this->db->insert_id();

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

            // Insert order items
            if (!empty($order_items)) {
                $this->db->insert_batch('orders_item', $order_items);
            }

            $this->db->trans_complete(); // Complete transaction

            if ($this->input->is_ajax_request()) {
                if ($this->db->trans_status() === FALSE) {
                    log_message('error', 'Order creation failed: ' . $this->db->error()['message']);
                    echo json_encode([
                        'success' => false,
                        'error' => 'Error occurred while creating the order!'
                    ]);
                } else {
                    log_message('debug', 'Order created successfully. Order ID: ' . $order_id);
                    echo json_encode([
                        'success' => true,
                        'redirect' => base_url('Controller_Orders/index')
                    ]);
                }
                return;
            } else {
                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata('error', 'Error occurred while creating the order');
                    redirect('Controller_Orders/create', 'refresh');
                } else {
                    $this->session->set_flashdata('success', 'Successfully created order');
                    redirect('Controller_Orders/index', 'refresh');
                }
            }
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
        
        if ($this->form_validation->run() == TRUE) {            
            $paid_status = $this->input->post('paid_status');
            if ($paid_status !== null) {
                $_POST['paid_status'] = $paid_status;
            }

            $update = $this->model_orders->update($id);
            
            if ($update['success']) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('Controller_Orders/update/'.$id, 'refresh');
            } else {
                $this->session->set_flashdata('errors', $update['error'] ?: 'Error occurred while updating the order!');
                redirect('Controller_Orders/update/'.$id, 'refresh');
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
                    <p><strong>Status:</strong> <span class="status status-'.($order_data['paid_status'] == 1 ? 'paid">Paid' : 'unpaid">Unpaid').'</span></p>
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

        $html .= '
                        <tr>
                            <td><strong>Total:</strong></td>
                            <td class="text-right"><strong>'.$company_info['currency'].' '.number_format(floatval($total), 2).'</strong></td>
                        </tr>
                    </table>
                </div>

                <div class="footer">
                    <p>Thank you for your support!</p>
                    <p>This is a computer generated invoice and does not require signature.</p>
                </div>
            </div>

            <script>
                window.print();
            </script>
        </body>
        </html>';

        echo $html;
    }

    public function mockCreateOrder()
    {
        $form_data = $this->input->post();
        log_message('debug', 'Received form data: ' . json_encode($form_data));

        // Generate bill_no
        $bill_no = 'BILPR-' . strtoupper(substr(md5(uniqid()), 0, 4));

        // Main order SQL
        $order_sql = sprintf(
            "INSERT INTO orders (bill_no, customer_name, customer_address, customer_phone, 
            gross_amount, service_charge_rate, service_charge, vat_charge_rate, vat_charge, 
            discount, net_amount, paid_status, user_id) 
            VALUES ('%s', %s, %s, %s, %.2f, %.2f, %.2f, %.2f, %.2f, %.2f, %.2f, %d, %d);",
            $bill_no,
            $this->db->escape($form_data['customer_name']),
            $this->db->escape($form_data['customer_address']),
            $this->db->escape($form_data['customer_phone']),
            floatval($form_data['gross_amount_value']),
            floatval($form_data['service_charge_rate'] ?? 0),
            floatval($form_data['service_charge_value'] ?? 0),
            floatval($form_data['vat_charge_rate'] ?? 0),
            floatval($form_data['vat_charge_value'] ?? 0),
            floatval($form_data['discount'] ?? 0),
            floatval($form_data['net_amount_value']),
            intval($form_data['paid_status']),
            intval($this->session->userdata('id'))
        );

        // Order items SQL
        $items_sql = [];
        if (!empty($form_data['product'])) {
            foreach ($form_data['product'] as $key => $product_id) {
                $items_sql[] = sprintf(
                    "INSERT INTO orders_item (order_id, product_id, qty, rate, amount) 
                    VALUES (LAST_INSERT_ID(), %d, %d, %.2f, %.2f);",
                    intval($product_id),
                    intval($form_data['qty'][$key]),
                    floatval($form_data['rate'][$key]),
                    floatval($form_data['amount_value'][$key])
                );
            }
        }

        // Log queries
        log_message('debug', 'Mock Order SQL: ' . $order_sql);
        foreach ($items_sql as $sql) {
            log_message('debug', 'Mock Order Item SQL: ' . $sql);
        }

        // Return all SQL statements
        echo json_encode([
            'mock_sql' => $order_sql . "\n\n" . implode("\n", $items_sql),
            'bill_no' => $bill_no
        ]);
    }

    public function edit($id)
    {
        if (!$id) {
            redirect('Controller_Orders');
        }

        $this->data['page_title'] = 'Edit Order';
        
        // Get order data with proper structure
        $order_data = $this->model_orders->getOrdersData($id);
        if (!$order_data) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('Controller_Orders');
        }

        // Structure the data correctly
        $this->data['order_data'] = array(
            'order' => $order_data,
            'order_item' => $this->model_orders->getOrdersItemData($id)
        );

        // Get other required data
        $this->data['products'] = $this->model_products->getActiveProductData();
        $company = $this->model_company->getCompanyData(1);
        $this->data['company_data'] = $company;
        $this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0);
        $this->data['is_service_enabled'] = ($company['service_charge_value'] > 0);

        $this->render_template('orders/edit', $this->data);
    }
}
?>