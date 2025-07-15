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

    /* 
     * Redirects to the manage order page
     */
    public function index()
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Manage Orders';
        $this->render_template('orders/index', $this->data);        
    }

    /*
     * Fetches the orders data from the orders table 
     * Called from the datatable ajax function
     */
    public function fetchOrdersData()
    {
        $result = array('data' => array());
        $data = $this->model_orders->getOrdersData();

        foreach ($data as $key => $value) {
            $count_total_item = $this->model_orders->countOrderItem($value['id']);
            $date = date('d-m-Y', $value['date_time']);
            $time = date('h:i a', $value['date_time']);
            $date_time = $date . ' ' . $time;

            // Generate action buttons
            $buttons = '';

            if (in_array('viewOrder', $this->permission)) {
                $buttons .= '<a target="__blank" href="'.base_url('Controller_Orders/printDiv/'.$value['id']).'" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>';
                $buttons .= ' <a href="'.base_url('Controller_Orders/printThermal/'.$value['id']).'" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Thermal</a>';
            }

            if (in_array('updateOrder', $this->permission)) {
                $buttons .= ' <a href="'.base_url('Controller_Orders/update/'.$value['id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>';
            }

            if (in_array('deleteOrder', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $paid_status = ($value['paid_status'] == 1) 
                ? '<span class="label label-success">Paid</span>' 
                : '<span class="label label-warning">Not Paid</span>';

            // Fetch the user who created the order
            $user = $this->model_users->getUserData($value['user_id']);
            $user_name = $user ? $user['username'] : 'Unknown';

            $result['data'][$key] = array(
                'bill_no' => $value['bill_no'],
                'customer_name' => $value['customer_name'],
                'customer_phone' => $value['customer_phone'],
                'date_time' => $date_time,
                'product_qty' => $count_total_item,
                'amount' => 'TZS     '.number_format($value['net_amount'], 2),
                'user_name' => $user_name,
                'actions' => $buttons
            );
        }

        echo json_encode($result);
    }

    /*
     * Creates a new order
     */
    public function create()
    {
        if (!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Add Order';
        $this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {            
            $paid_status = $this->input->post('paid_status');
            if ($paid_status == 2) {
                $paid_status = 1;
                $_POST['paid_status'] = 1;
            }

            $order_id = $this->model_orders->create();
            
            if ($order_id) {
                $this->model_activity_log->log($this->session->userdata('id'), 'Created Order', 'Order ID: '.$order_id);
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('Controller_Orders/update/'.$order_id, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Controller_Orders/create/', 'refresh');
            }
        } else {
            $company = $this->model_company->getCompanyData(1);
            $this->data['company_data'] = $company;
            $this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
            $this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
            $this->data['products'] = $this->model_products->getActiveProductData();          
            $this->render_template('orders/create', $this->data);
        }    
    }

    /*
     * Gets product value by ID (AJAX)
     */
    public function getProductValueById()
    {
        $product_id = $this->input->post('product_id');
        if ($product_id) {
            $product_data = $this->model_products->getProductData($product_id);
            echo json_encode($product_data);
        }
    }

    /*
     * Gets all active products (AJAX)
     */
    public function getTableProductRow()
    {
        $products = $this->model_products->getActiveProductData();
        echo json_encode($products);
    }

    /*
     * Updates an existing order
     */
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
        
        if ($this->form_validation->run() == TRUE) {            
            $paid_status = $this->input->post('paid_status');
            if ($paid_status !== null) {
                $_POST['paid_status'] = $paid_status;
            }

            $update = $this->model_orders->update($id);
            
            if ($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('Controller_Orders/update/'.$id, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Controller_Orders/update/'.$id, 'refresh');
            }
        } else {
            $company = $this->model_company->getCompanyData(1);
            $this->data['company_data'] = $company;
            $this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
            $this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

            $result = array();
            $orders_data = $this->model_orders->getOrdersData($id);
            $result['order'] = $orders_data;
            
            $orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);
            foreach ($orders_item as $k => $v) {
                $result['order_item'][] = $v;
            }

            $this->data['order_data'] = $result;
            $this->data['products'] = $this->model_products->getActiveProductData();          
            $this->render_template('orders/edit', $this->data);
        }
    }

    /*
     * Removes an order
     */
    public function remove()
    {
        if (!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $order_id = $this->input->post('order_id');
        $response = array();

        if ($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
    }

    /*
     * Generates printable invoice matching the design in Capture.PNG
     */
    public function printDiv($id)
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        if ($id) {
            $order_data = $this->model_orders->getOrdersData($id);
            $orders_items = $this->model_orders->getOrdersItemData($id);
            $company_info = $this->model_company->getCompanyData(1);

            $user = $this->model_users->getUserData($order_data['user_id']);
            $user_fullname = 'Clerk';
            if ($user) {
                $user_fullname = trim($user['firstname'] . ' ' . $user['lastname']);
                if (empty($user_fullname)) {
                    $user_fullname = $user['username'];
                }
            }

            $order_date = isset($order_data['date_time']) ? date('F d, Y', $order_data['date_time']) : date('F d, Y');
            $paid_status = (isset($order_data['paid_status']) && $order_data['paid_status'] == 1) ? "Paid" : "Not Paid";
            $company_name = isset($company_info['company_name']) ? $company_info['company_name'] : 'Company Name';
            $bill_no = isset($order_data['bill_no']) ? $order_data['bill_no'] : '';
            $customer_name = isset($order_data['customer_name']) ? $order_data['customer_name'] : '';
            $customer_address = isset($order_data['customer_address']) ? $order_data['customer_address'] : '';
            $customer_phone = isset($order_data['customer_phone']) ? $order_data['customer_phone'] : '';
            $gross_amount = isset($order_data['gross_amount']) ? $order_data['gross_amount'] : 0;
            $vat_charge = isset($order_data['vat_charge']) ? $order_data['vat_charge'] : 0;
            $vat_charge_rate = isset($order_data['vat_charge_rate']) ? $order_data['vat_charge_rate'] : 0;
            $discount = isset($order_data['discount']) ? $order_data['discount'] : 0;
            $net_amount = isset($order_data['net_amount']) ? $order_data['net_amount'] : 0;

            $html = '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Invoice</title>
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.5;
                        color: #000;
                        max-width: 800px;
                        margin: 0 auto;
                        padding: 20px;
                        background: #fff;
                    }
                    .invoice-header {
                        text-align: center;
                        margin-bottom: 20px;
                        border-bottom: 1px solid #000;
                        padding-bottom: 10px;
                    }
                    .company-name {
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 5px;
                    }
                    .invoice-meta {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 20px;
                    }
                    .invoice-number, .invoice-date {
                        font-weight: bold;
                    }
                    .divider {
                        border-top: 1px solid #000;
                        margin: 15px 0;
                    }
                    .invoice-section {
                        margin-bottom: 15px;
                    }
                    .section-title {
                        font-weight: bold;
                        font-size: 18px;
                        margin-bottom: 10px;
                    }
                    .customer-info, .company-info {
                        margin-bottom: 10px;
                    }
                    .items-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 15px 0;
                    }
                    .items-table th {
                        text-align: left;
                        padding: 8px 5px;
                        border-bottom: 1px solid #000;
                    }
                    .items-table td {
                        padding: 8px 5px;
                        border-bottom: 1px solid #ddd;
                    }
                    .text-right {
                        text-align: right;
                    }
                    .summary-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
                    .summary-table td {
                        padding: 5px;
                    }
                    .summary-table .total-row {
                        font-weight: bold;
                        border-top: 1px solid #000;
                    }
                    .payment-status {
                        margin: 15px 0;
                        font-weight: bold;
                    }
                    .signature {
                        margin-top: 30px;
                        text-align: right;
                    }
                    @media print {
                        body {
                            padding: 0;
                        }
                        .no-print {
                            display: none;
                        }
                    }
                </style>
            </head>
            <body onload="window.print();">
                <div class="invoice-header">
                    <div class="company-name">'.strtoupper($company_name).'</div>
                </div>

                <div class="invoice-meta">
                    <div class="invoice-number">Invoice No: '.$bill_no.'</div>
                    <div class="invoice-date">Date: '.$order_date.'</div>
                </div>

                <div class="divider"></div>

                <div class="invoice-section">
                    <div class="section-title">Invoice To:</div>
                    <div class="customer-info">
                        <strong>'.$customer_name.'</strong><br>';
            
            if (!empty($customer_address)) {
                $html .= $customer_address.'<br>';
            }
            
            if (!empty($customer_phone)) {
                $html .= $customer_phone;
            }
            
            $html .= '
                    </div>
                </div>

                <div class="invoice-section">
                    <div class="section-title">Income From:</div>
                    <div class="company-info">
                        <strong>'.$company_name.'</strong><br>';
            
            if (!empty($company_info['address'])) {
                $html .= $company_info['address'].'<br>';
            }
            
            if (!empty($company_info['phone'])) {
                $html .= $company_info['phone'];
            }
            
            $html .= '
                    </div>
                </div>

                <div class="divider"></div>

                <div class="invoice-section">
                    <div class="section-title">Items & Services</div>
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>PRODUCT</th>
                                <th>PRICE</th>
                                <th>QTY.</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>';
            
            $counter = 1;
            foreach ($orders_items as $k => $v) {
                $product_data = $this->model_products->getProductData($v['product_id']);
                $product_name = ($product_data && !empty($product_data['name'])) ? $product_data['name'] : '[Unknown Product]';
                $rate = isset($v['rate']) ? $v['rate'] : 0;
                $qty = isset($v['qty']) ? $v['qty'] : 0;
                $amount = isset($v['amount']) ? $v['amount'] : 0;
                
                $html .= '
                            <tr>
                                <td>'.str_pad($counter, 2, '0', STR_PAD_LEFT).'</td>
                                <td>'.$product_name.'</td>
                                <td>TZS '.number_format($rate, 2).'</td>
                                <td>'.$qty.'</td>
                                <td class="text-right">TZS '.number_format($amount, 2).'</td>
                            </tr>';
                $counter++;
            }
            
            $html .= '
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>

                <div class="payment-status">
                    <strong>'.$paid_status.'</strong><br>
                    Payment completed successfully
                </div>

                <div class="invoice-section">
                    <div class="section-title">Summary</div>
                    <table class="summary-table">
                        <tr>
                            <td>Subtotal:</td>
                            <td class="text-right">TZS '.number_format($gross_amount, 2).'</td>
                        </tr>';
            
            if ($discount > 0) {
                $html .= '
                        <tr>
                            <td>Discount:</td>
                            <td class="text-right">-TZS '.number_format($discount, 2).'</td>
                        </tr>';
            }
            
            if ($vat_charge > 0) {
                $html .= '
                        <tr>
                            <td>Tax ('.number_format($vat_charge_rate, 0).'%):</td>
                            <td class="text-right">TZS '.number_format($vat_charge, 2).'</td>
                        </tr>';
            }
            
            $html .= '
                        <tr class="total-row">
                            <td><strong>Total Amount:</strong></td>
                            <td class="text-right"><strong>TZS '.number_format($net_amount, 2).'</strong></td>
                        </tr>
                    </table>
                </div>

                <div class="signature">
                    <div>Authorized Signature</div>
                    <div style="margin-top: 40px;">_________________________</div>
                    <div>Clerk<br>'.$user_fullname.'</div>
                </div>

                <div class="no-print" style="margin-top: 20px; text-align: center;">
                    <button onclick="window.print()" style="padding: 10px 20px; background: #4CAF50; color: white; border: none; cursor: pointer;">Print Invoice</button>
                </div>
            </body>
            </html>';

            echo $html;
        }
    }

    /*
     * Generates thermal printer-friendly receipt for Incotex 777M via COM3
     */
    public function printThermal($id)
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        if ($id) {
            $order_data = $this->model_orders->getOrdersData($id);
            $orders_items = $this->model_orders->getOrdersItemData($id);
            $company_info = $this->model_company->getCompanyData(1);

            $user = $this->model_users->getUserData($order_data['user_id']);
            $user_fullname = 'Clerk';
            if ($user) {
                $user_fullname = trim($user['firstname'] . ' ' . $user['lastname']);
                if (empty($user_fullname)) {
                    $user_fullname = $user['username'];
                }
            }

            $order_date = isset($order_data['date_time']) ? date('d-m-Y H:i', $order_data['date_time']) : date('d-m-Y H:i');
            $paid_status = (isset($order_data['paid_status']) && $order_data['paid_status'] == 1) ? "Paid" : "Not Paid";
            $company_name = isset($company_info['company_name']) ? $company_info['company_name'] : 'Company Name';
            $bill_no = isset($order_data['bill_no']) ? $order_data['bill_no'] : '';
            $customer_name = isset($order_data['customer_name']) ? $order_data['customer_name'] : '';
            $gross_amount = isset($order_data['gross_amount']) ? $order_data['gross_amount'] : 0;
            $vat_charge = isset($order_data['vat_charge']) ? $order_data['vat_charge'] : 0;
            $vat_charge_rate = isset($order_data['vat_charge_rate']) ? $order_data['vat_charge_rate'] : 0;
            $discount = isset($order_data['discount']) ? $order_data['discount'] : 0;
            $net_amount = isset($order_data['net_amount']) ? $order_data['net_amount'] : 0;

            // ESC/POS commands
            $ESC = "\x1B";
            $GS = "\x1D";
            $LF = "\n";
            $initialize = $ESC . "@";
            $center_align = $ESC . "a1";
            $left_align = $ESC . "a0";
            $bold_on = $ESC . "E1";
            $bold_off = $ESC . "E0";
            $cut_paper = $GS . "V1";
            $set_code_page = $ESC . "t" . chr(0);

            // Build receipt content
            $receipt = $initialize . $set_code_page;
            $receipt .= $center_align;
            $receipt .= $bold_on . strtoupper(substr($company_name, 0, 30)) . $bold_off . $LF;
            $receipt .= "Receipt #" . substr($bill_no, 0, 20) . $LF;
            $receipt .= "Date: " . $order_date . $LF;
            $receipt .= "Customer: " . substr($customer_name, 0, 15) . $LF;
            $receipt .= "Clerk: " . substr($user_fullname, 0, 15) . $LF;
            $receipt .= str_repeat("-", 32) . $LF;
            $receipt .= $left_align;

            // Item header (adjusted for 58mm, ~32 characters)
            $receipt .= sprintf("%-15s %4s %6s %6s\n", "Item", "Qty", "Price", "Total");

            // Items
            foreach ($orders_items as $k => $v) {
                if (isset($v['product_name']) && !empty($v['product_name'])) {
                    $product_name = substr($v['product_name'], 0, 15);
                } else {
                    $product_data = $this->model_products->getProductData($v['product_id']);
                    $product_name = ($product_data && !empty($product_data['name'])) ? substr($product_data['name'], 0, 15) : '[Unknown]';
                }
                $rate = isset($v['rate']) ? $v['rate'] : 0;
                $qty = isset($v['qty']) ? $v['qty'] : 0;
                $amount = isset($v['amount']) ? $v['amount'] : 0;

                $receipt .= sprintf("%-15s %4d %6.2f %6.2f\n", $product_name, $qty, $rate, $amount);
            }

            $receipt .= str_repeat("-", 32) . $LF;
            $receipt .= sprintf("%-15s %16.2f\n", "Subtotal:", $gross_amount);
            if ($discount > 0) {
                $receipt .= sprintf("%-15s %16.2f\n", "Discount:", $discount);
            }
            if ($vat_charge > 0) {
                $receipt .= sprintf("%-15s %16.2f\n", "Tax (" . number_format($vat_charge_rate, 0) . "%):", $vat_charge);
            }
            $receipt .= $bold_on . sprintf("%-15s %16.2f\n", "Total:", $net_amount) . $bold_off;
            $receipt .= sprintf("%-15s %16s\n", "Status:", $paid_status);
            $receipt .= str_repeat("-", 32) . $LF;
            $receipt .= $center_align . "Thank you for your business!" . $LF . $LF;
            $receipt .= $cut_paper;

            // Log receipt data for debugging
            $log_file = FCPATH . 'application/logs/receipt_' . date('Ymd_His') . '.txt';
            file_put_contents($log_file, bin2hex($receipt) . "\n\n" . $receipt);

            // Open COM3 port
            $port = "COM3";
            try {
                system("mode $port BAUD=9600 PARITY=n DATA=8 STOP=1 to=off dtr=off rts=off");
                
                $fp = fopen($port, 'w');
                if ($fp === false) {
                    throw new Exception("Failed to open COM3 port. Ensure the printer is connected, powered on, and the port is not in use.");
                }

                if (fwrite($fp, $receipt) === false) {
                    throw new Exception("Failed to write to COM3 port. Check printer connection or port settings.");
                }

                fclose($fp);

                $this->session->set_flashdata('success', 'Receipt sent to printer on COM3. Check log at ' . $log_file);
                redirect('Controller_Orders', 'refresh');
            } catch (Exception $e) {
                $this->session->set_flashdata('errors', 'Error printing receipt: ' . $e->getMessage());
                redirect('Controller_Orders', 'refresh');
            }
        }
    }
}