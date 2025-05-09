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
                'user_name' => $user_name, // Only the name
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
            $order_id = $this->model_orders->create();
            
            if ($order_id) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('Controller_Orders/update/'.$order_id, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Controller_Orders/create/', 'refresh');
            }
        } else {
            // False case - load view with data
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
            $update = $this->model_orders->update($id);
            
            if ($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('Controller_Orders/update/'.$id, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Controller_Orders/update/'.$id, 'refresh');
            }
        } else {
            // False case - load view with data
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
     * Generates printable invoice
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

            // Fetch the user who created the order
            $user = $this->model_users->getUserData($order_data['user_id']);
            $user_fullname = 'Clerk';
            if ($user) {
                $user_fullname = trim($user['firstname'] . ' ' . $user['lastname']);
                if (empty($user_fullname)) {
                    $user_fullname = $user['username'];
                }
            }

            $order_date = isset($order_data['date_time']) ? date('F d, Y', $order_data['date_time']) : date('F d, Y');
            $paid_status = (isset($order_data['paid_status']) && $order_data['paid_status'] == 1) ? "Not Paid" : "Paid";
            $company_name = isset($company_info['company_name']) ? $company_info['company_name'] : 'Company Name';
            $bill_no = isset($order_data['bill_no']) ? $order_data['bill_no'] : '';
            $customer_name = isset($order_data['customer_name']) ? $order_data['customer_name'] : '';
            $customer_address = isset($order_data['customer_address']) ? $order_data['customer_address'] : '';
            $customer_phone = isset($order_data['customer_phone']) ? $order_data['customer_phone'] : '';
            $customer_email = isset($order_data['customer_email']) ? $order_data['customer_email'] : '';
            $gross_amount = isset($order_data['gross_amount']) ? $order_data['gross_amount'] : 0;
            $service_charge = isset($order_data['service_charge']) ? $order_data['service_charge'] : 0;
            $service_charge_rate = isset($order_data['service_charge_rate']) ? $order_data['service_charge_rate'] : 0;
            $vat_charge = isset($order_data['vat_charge']) ? $order_data['vat_charge'] : 0;
            $vat_charge_rate = isset($order_data['vat_charge_rate']) ? $order_data['vat_charge_rate'] : 0;
            $discount = isset($order_data['discount']) ? $order_data['discount'] : 0;
            $net_amount = isset($order_data['net_amount']) ? $order_data['net_amount'] : 0;
            $terms_condition = isset($company_info['terms_condition']) ? $company_info['terms_condition'] : 'Payment is due within 15 days. Please make payment by the due date to avoid late fees.';

            $html = '<!DOCTYPE html>
            <html>
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <title>Invoice</title>
              <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
              <style>
                body {
                  font-family: "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
                  line-height: 1.6;
                  color: #222;
                  max-width: 900px;
                  margin: 0 auto;
                  padding: 20px;
                  background: #f7f7f7;
                }
                .invoice-wrapper {
                  background: #fff;
                  border-radius: 10px;
                  padding: 28px 28px 18px 28px;
                  box-shadow: 0 4px 16px rgba(44, 62, 80, 0.08);
                  margin-bottom: 10px;
                  border: 1.5px solid #bbb;
                  position: relative;
                  overflow: hidden;
                }
                .invoice-header-combined {
                  display: flex;
                  justify-content: space-between;
                  align-items: flex-end;
                  margin-bottom: 10px;
                  padding-bottom: 18px;
                  border-bottom: 2px solid #bbb;
                  background: linear-gradient(90deg, #2196f3 0%, #4caf50 100%);
                  color: #fff;
                  border-radius: 12px 12px 0 0;
                  box-shadow: 0 2px 12px rgba(33,150,243,0.10);
                }
                .invoice-header-combined .company-name {
                  font-size: 28px;
                  font-weight: bold;
                  letter-spacing: 2px;
                  text-transform: uppercase;
                  text-shadow: 1px 2px 8px rgba(33,150,243,0.18);
                }
                .invoice-header-combined .invoice-meta {
                  text-align: right;
                  font-size: 17px;
                  font-weight: 500;
                }
                .invoice-header-combined .invoice-meta .invoice-number {
                  font-weight: bold;
                  color: #2196f3;
                  background: #fff;
                  padding: 2px 12px;
                  border-radius: 8px;
                  margin-left: 5px;
                  box-shadow: 0 1px 4px rgba(33,150,243,0.10);
                }
                .invoice-from-to {
                  display: flex;
                  justify-content: space-between;
                  margin-bottom: 14px;
                  gap: 12px;
                }
                .invoice-from, .invoice-to {
                  width: 48%;
                  padding: 12px;
                  border-radius: 7px;
                  background: #fafafa;
                  border: 1px solid #ddd;
                  box-shadow: 0 1px 4px rgba(33,33,33,0.03);
                }
                .invoice-from h3, .invoice-to h3 {
                  border-bottom: 1px solid #bbb;
                  padding-bottom: 4px;
                  margin-bottom: 8px;
                  color: #444;
                  font-size: 16px;
                  letter-spacing: 1px;
                }
                .divider {
                  border-top: 1.5px dashed #bbb;
                  margin: 12px 0;
                }
                table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-bottom: 18px;
                  background: #fff;
                  border-radius: 7px;
                  overflow: hidden;
                  box-shadow: 0 1px 4px rgba(33,33,33,0.02);
                }
                table th {
                  text-align: left;
                  padding: 10px 8px;
                  background: #ededed;
                  color: #222;
                  border: none;
                  font-size: 14px;
                  letter-spacing: 1px;
                }
                table td {
                  padding: 9px 8px;
                  border-bottom: 1px solid #e0e0e0;
                  font-size: 14px;
                }
                table tr:nth-child(even) {
                  background-color: #f8f8f8;
                }
                table tr:hover {
                  background-color: #f1f1f1;
                }
                .text-right {
                  text-align: right;
                }
                .payment-container {
                  display: flex;
                  justify-content: space-between;
                  margin-bottom: 18px;
                  gap: 12px;
                }
                .payment-Status {
                  width: 48%;
                  padding: 10px;
                  background: #f9fbe7;
                  border-radius: 7px;
                  border: 1px solid #dce775;
                  box-shadow: 0 1px 4px rgba(205,220,57,0.04);
                  text-align: center;
                }
                .payment-Status h3 {
                  color: #888;
                  margin-bottom: 8px;
                  font-size: 15px;
                }
                .payment-summary {
                  width: 48%;
                  padding: 10px;
                  background: #f3e5f5;
                  border-radius: 7px;
                  border: 1px solid #ce93d8;
                  box-shadow: 0 1px 4px rgba(142,36,170,0.03);
                }
                .payment-summary table {
                  width: 100%;
                }
                .payment-summary td {
                  padding: 6px 4px;
                  font-size: 14px;
                }
                .payment-summary tr:last-child td {
                  font-weight: bold;
                  border-top: 1.5px solid #bbb;
                  font-size: 1em;
                  color: #333;
                }
                .terms {
                  clear: both;
                  margin-top: 16px;
                  padding: 10px;
                  background: #fafafa;
                  border-radius: 6px;
                  border-left: 3px solid #bbb;
                }
                .terms h3 {
                  color: #888;
                  margin-bottom: 6px;
                }
                .signature {
                  text-align: center;
                  margin-top: 28px;
                  padding-top: 12px;
                  border-top: 1.5px dashed #bbb;
                  font-size: 15px;
                  color: #333;
                }
                .invoice-number {
                  font-weight: bold;
                  color: #222;
                  background: #e0e0e0;
                  padding: 2px 10px;
                  border-radius: 6px;
                  margin-left: 5px;
                }
                .status-badge {
                  display: inline-block;
                  padding: 5px 14px;
                  border-radius: 14px;
                  font-weight: bold;
                  font-size: 0.95em;
                  letter-spacing: 1px;
                  box-shadow: 0 1px 4px rgba(76,175,80,0.04);
                }
                .status-paid {
                  background: #e0f2f1;
                  color: #388e3c;
                  border: 1px solid #388e3c;
                }
                .status-unpaid {
                  background: #ffebee;
                  color: #c62828;
                  border: 1px solid #c62828;
                }
              </style>
            </head>
            <body onload="window.print();">
            
            <div class="invoice-wrapper">
              <div class="invoice-header-combined">
                <div class="company-name">'.$company_name.'</div>
                <div class="invoice-meta">
                  <div><strong>Invoice No:</strong> <span class="invoice-number">'.$bill_no.'</span></div>
                  <div><strong>Date:</strong> '.$order_date.'</div>
                </div>
              </div>

              <div class="invoice-from-to">
                <div class="invoice-to">
                  <h3>Invoice To:</h3>
                  <strong>'.$customer_name.'</strong><br>';
            
            if (!empty($customer_address)) {
                $html .= $customer_address.'<br>';
            }
            
            $html .= 'Phone: '.$customer_phone.'<br>';
            
            if (!empty($customer_email)) {
                $html .= 'Email: '.$customer_email;
            }
            
            $html .= '
                </div>
                <div class="invoice-from">
                  <h3>Invoice From:</h3>
                  <strong>'.$company_name.'</strong><br>'; // Print user full name here

            if (!empty($company_info['address'])) {
                $html .= $company_info['address'].'<br>';
            }
            
            if (!empty($company_info['phone'])) {
                $html .= 'Phone: '.$company_info['phone'].'<br>';
            }
            
            if (!empty($company_info['email'])) {
                $html .= 'Email: '.$company_info['email'];
            }
            
            $html .= '
                </div>
              </div>

              <div class="divider"></div>

              <table>
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
                // Try to use product_name from the order item if available (e.g., from a join)
                if (isset($v['product_name']) && !empty($v['product_name'])) {
                    $product_name = $v['product_name'];
                } else {
                    // Fallback: fetch from products table
                    $product_data = $this->model_products->getProductData($v['product_id']);
                    $product_name = ($product_data && !empty($product_data['name'])) ? $product_data['name'] : '[Unknown Product]';
                }
                $rate = isset($v['rate']) ? $v['rate'] : 0;
                $qty = isset($v['qty']) ? $v['qty'] : 0;
                $amount = isset($v['amount']) ? $v['amount'] : 0;
                
                $html .= '
    <tr>
      <td>'.str_pad($counter, 2, '0', STR_PAD_LEFT).'</td>
      <td>
        <strong>'.$product_name.'</strong><br>
      </td>
      <td>TZS     '.number_format($rate, 2).'</td>
      <td>'.$qty.'</td>
      <td class="text-right">TZS     '.number_format($amount, 2).'</td>
    </tr>';
                $counter++;
            }

            $html .= '
                </tbody>
              </table>

              <div class="payment-container">
                <div class="payment-Status">
                  <h3>Payment Details</h3>
                  <p><span class="status-badge '.($paid_status == "unpaid" ? "status-unpaid" : "status-paid").'">'.$paid_status.'</span></p>
                </div>

                <div class="payment-summary">
                  <table>
                    <tr>
                      <td>Subtotal:</td>
                      <td class="text-right">TZS     '.number_format($gross_amount, 2).'</td>
                    </tr>';

            if ($discount > 0) {
                $html .= '
                    <tr>
                      <td>Discount:</td>
                      <td class="text-right">TZS     '.number_format($discount, 2).'</td>
                    </tr>';
            }

            if ($vat_charge > 0) {
                $html .= '
                    <tr>
                      <td>Tax ('.number_format($vat_charge_rate, 0).'%):</td>
                      <td class="text-right">TZS     '.number_format($vat_charge, 2).'</td>
                    </tr>';
            }

            $html .= '
                    <tr>
                      <td><strong>Total Amount:</strong></td>
                      <td class="text-right"><strong>TZS     '.number_format($net_amount, 2).'</strong></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="divider"></div>

              <div class="signature">
                <p>Authorized Signature</p>
                <p>_________________________</p>
                <p style="margin-top:10px;"><strong>Clerk:</strong> '.$user_fullname.'</p> <!-- Clerk name here -->
              </div>

            </div>

            </body>
            </html>';

            echo $html;
        }
    }
}