<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Orders extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        
        // Load required models
        $this->load->model([
            'model_orders',
            'model_products',
            'model_company',
            'model_users',
            'model_stores'
        ]);

        // Ensure store assignment
        $this->ensureStoreAssignment();
    }

    private function ensureStoreAssignment()
    {
        if (!$this->session->userdata('store_id')) {
            $user_id = $this->session->userdata('id');
            $group_id = $this->session->userdata('group_id');
            
            // Skip for admin users
            if ($group_id == 1) {
                return;
            }

            if ($user_id) {
                $user = $this->model_users->getUserData($user_id);
                if ($user && $user['store_id']) {
                    // Set store info in session
                    $store = $this->model_stores->getStoresData($user['store_id']);
                    if ($store) {
                        $this->session->set_userdata([
                            'store_id' => $user['store_id'],
                            'store_name' => $store['name']
                        ]);
                        
                        log_message('debug', sprintf(
                            'Store assignment set - ID: %s, Name: %s',
                            $user['store_id'],
                            $store['name']
                        ));
                    }
                } else {
                    log_message('error', 'User has no store assignment: ' . $user_id);
                    redirect('dashboard', 'refresh');
                }
            }
        }
    }

    public function index()
    {
        if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $group_id = $this->session->userdata('group_id');
        $store_id = $this->session->userdata('store_id');
        
        $this->data['is_privileged'] = in_array($group_id, [1, 2]); // Admin or Manager
        $this->data['store_id'] = $store_id;
        $this->data['store_name'] = $this->session->userdata('store_name');
        
        log_message('debug', sprintf(
            'Index loaded - Store: %s, Is Privileged: %s',
            $store_id,
            $this->data['is_privileged'] ? 'Yes' : 'No'
        ));
        
        $this->render_template('orders/index', $this->data);
    }

    public function fetchOrdersData()
    {
        if(!in_array('viewOrder', $this->permission)) {
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode(['error' => 'Access Denied']));
            return;
        }

        try {
            $data = $this->model_orders->fetchOrdersData();
            
            if (empty($data['data'])) {
                log_message('debug', 'No orders found for current user');
            } else {
                log_message('debug', sprintf(
                    'Found %d orders for user',
                    count($data['data'])
                ));
            }

            $this->output->set_content_type('application/json')
                         ->set_output(json_encode(['data' => $data['data']]));
                         
        } catch (Exception $e) {
            log_message('error', 'Error fetching orders: ' . $e->getMessage());
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode([
                             'error' => 'Error fetching orders',
                             'data' => []
                         ]));
        }
    }

    public function create()
    {
        // if POST -> handle AJAX submission
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->model('model_orders');

            // get all POST, XSS cleaned
            $post = $this->input->post(NULL, TRUE);
            log_message('debug', 'Controller_Orders::create POST: ' . json_encode($post));

            // normalize numeric totals
            $post['gross_amount_value'] = isset($post['gross_amount_value']) ? $post['gross_amount_value'] : ($post['gross_amount'] ?? 0);
            $post['net_amount_value']   = isset($post['net_amount_value']) ? $post['net_amount_value'] : ($post['net_amount'] ?? 0);
            $post['service_charge_value'] = isset($post['service_charge_value']) ? $post['service_charge_value'] : ($post['service_charge'] ?? 0);
            $post['vat_charge_value'] = isset($post['vat_charge_value']) ? $post['vat_charge_value'] : ($post['vat_charge'] ?? 0);

            $post['paid_status'] = isset($post['paid_status']) ? intval($post['paid_status']) : 1;
            $net = floatval($post['net_amount_value'] ?? 0);

            // enforce amount_paid rules
            if ($post['paid_status'] === 2) { // Paid
                $post['amount_paid'] = $net;
            } elseif ($post['paid_status'] === 3) { // Partially
                $post['amount_paid'] = isset($post['amount_paid']) ? floatval($post['amount_paid']) : 0;
                if ($post['amount_paid'] > $net) $post['amount_paid'] = $net;
            } else {
                $post['amount_paid'] = 0;
            }

            // pass sanitized payload to model
            $result = $this->model_orders->create($post);

            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($result));
        }

        // GET -> render form
        // Ensure models loaded
        $this->load->model('model_orders');
        $this->load->model('model_company');

        // Get store and products with stock/price
        $store_id = $this->session->userdata('store_id');
        $products = $this->model_orders->getProductsWithStock($store_id);

        // Normalise exactly what the view expects
        $prepared = [];
        foreach ($products as $p) {
            $prepared[] = [
                'id'            => isset($p['id']) ? (int)$p['id'] : 0,
                'name'          => $p['name'] ?? '',
                'price'         => isset($p['price']) ? floatval($p['price']) : 0.00,
                'current_stock' => isset($p['current_stock']) ? intval($p['current_stock']) : 0,
                'unit'          => $p['unit'] ?? ''
            ];
        }

        log_message('debug', 'Prepared products for create view: ' . json_encode($prepared));

        $this->data['products'] = $prepared;
        $this->data['store_data'] = [
            'store_id' => $store_id,
            'store_name' => $this->session->userdata('store_name')
        ];

        // Company flags required by the view
        $company = $this->model_company->getCompanyData(1);
        $this->data['company_data'] = $company ?: [];
        $this->data['is_vat_enabled'] = (isset($company['vat_charge_value']) && floatval($company['vat_charge_value']) > 0);
        $this->data['is_service_enabled'] = (isset($company['service_charge_value']) && floatval($company['service_charge_value']) > 0);

        // Render create view
        $this->render_template('orders/create', $this->data);
    }

     

    public function getProductValueById()
    {
        $product_id = (int)$this->input->post('product_id');
        $store_id = $this->input->post('store_id') ?: $this->session->userdata('store_id');

        $this->load->model('model_orders');

        if (!$product_id) {
            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => false, 'error' => 'Missing product_id']));
        }

        // Try to get from getProductsWithStock
        $products = $this->model_orders->getProductsWithStock($store_id);
        foreach ($products as $p) {
            if (isset($p['id']) && intval($p['id']) === $product_id) {
                $resp = [
                    'success' => true,
                    'data' => [
                        'price' => isset($p['price']) ? floatval($p['price']) : 0,
                        'current_stock' => isset($p['current_stock']) ? intval($p['current_stock']) : 0
                    ]
                ];
                return $this->output
                            ->set_content_type('application/json')
                            ->set_output(json_encode($resp));
            }
        }

        // Fallback: read direct product row + compute stock via helpers
        $prod = $this->db->select('id, price, store_id')->from('products')->where('id', $product_id)->get()->row_array();
        if (!$prod) {
            return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => false, 'error' => 'Product not found']));
        }

        $price = isset($prod['price']) ? floatval($prod['price']) : 0;
        $purchased = $this->model_orders->getTotalPurchased($product_id, $store_id);
        $ordered = $this->model_orders->getTotalOrdered($product_id, $store_id);
        $stock = max(0, intval($purchased) - intval($ordered));

        $resp = [
            'success' => true,
            'data' => [
                'price' => $price,
                'current_stock' => $stock
            ]
            ];

        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($resp));
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
                    <td class="text-right"><strong>'.$company_info['currency'].' '.number_format(floatval($total), 2).'</strong></td>
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

    public function getAvailableProducts()
    {
        $store_id = $this->session->userdata('store_id');
        $products = $this->model_orders->getProductsWithStock($store_id);

        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id'    => $product['id'],
                'name'  => $product['name'],
                'qty'   => $product['current_stock'], // <-- use current_stock here!
                'price' => $product['price'],
            ];
        }
        echo json_encode(['results' => $results]);
    }

    public function debugStock()
    {
        // only for dev - remove or protect later
        $store_id = $this->session->userdata('store_id') ?: $this->input->get('store_id');
        $this->load->model('model_orders');
        $products = $this->model_orders->getProductsWithStock($store_id);
        header('Content-Type: application/json');
        echo json_encode($products, JSON_PRETTY_PRINT);
        exit;
    }
}
?>