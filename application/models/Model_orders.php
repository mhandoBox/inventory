<?php
class Model_orders extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* Get orders data with optional filters */
    public function getOrdersData($id = null, $filters = null)
    {
        $this->db->select('*');
        $this->db->from('orders');

        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->row_array();
        }

        if ($filters && is_array($filters)) {
            if (!empty($filters['date_from'])) {
                $this->db->where('date_time >=', strtotime($filters['date_from']));
            }
            if (!empty($filters['date_to'])) {
                $this->db->where('date_time <=', strtotime($filters['date_to'] . ' 23:59:59'));
            }
            if (!empty($filters['customer_name'])) {
                $this->db->where('customer_name', $filters['customer_name']);
            }
            if (!empty($filters['warehouse']) && $this->db->field_exists('warehouse', 'orders')) {
                $this->db->where('warehouse', $filters['warehouse']);
            }
            if (!empty($filters['bill_no'])) {
                $this->db->like('bill_no', $filters['bill_no']);
            }
            if ($filters['paid_status'] !== '' && in_array($filters['paid_status'], ['0', '1'])) {
                $this->db->where('paid_status', $filters['paid_status']);
            }
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* Get distinct customers for filter dropdown */
    public function getDistinctCustomers()
    {
        $this->db->select('customer_name');
        $this->db->distinct();
        $this->db->from('orders');
        $this->db->where('customer_name IS NOT NULL');
        $this->db->order_by('customer_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* Get distinct warehouses for filter dropdown */
    public function getDistinctWarehouses()
    {
        if ($this->db->field_exists('warehouse', 'orders')) {
            $this->db->select('warehouse');
            $this->db->distinct();
            $this->db->from('orders');
            $this->db->where('warehouse IS NOT NULL');
            $this->db->order_by('warehouse', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        return [];
    }

    /* Get order items by order ID */
    public function getOrdersItemData($order_id = null)
    {
        if (!$order_id) {
            return false;
        }

        $sql = "SELECT * FROM orders_item WHERE order_id = ?";
        $query = $this->db->query($sql, array($order_id));
        return $query->result_array();
    }

    /* Create a new order */
    public function create()
    {
        $user_id = $this->session->userdata('id');
        $bill_no = 'BILPR-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $data = array(
            'bill_no' => $bill_no,
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_phone' => $this->input->post('customer_phone'),
            'date_time' => strtotime(date('Y-m-d h:i:s a')),
            'gross_amount' => $this->input->post('gross_amount_value'),
            'service_charge_rate' => $this->input->post('service_charge_rate'),
            'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value') : 0,
            'vat_charge_rate' => $this->input->post('vat_charge_rate'),
            'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
            'net_amount' => $this->input->post('net_amount_value'),
            'discount' => $this->input->post('discount'),
            'paid_status' => $this->input->post('paid_status') == 2 ? 1 : $this->input->post('paid_status'),
            'user_id' => $user_id
        );

        $insert = $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();

        $this->load->model('model_products');

        $count_product = count($this->input->post('product'));
        for ($x = 0; $x < $count_product; $x++) {
            $items = array(
                'order_id' => $order_id,
                'product_id' => $this->input->post('product')[$x],
                'qty' => $this->input->post('qty')[$x],
                'rate' => $this->input->post('rate_value')[$x],
                'amount' => $this->input->post('amount_value')[$x],
            );

            $this->db->insert('orders_item', $items);

            // Decrease stock from the product
            $product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
            $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

            $update_product = array('qty' => $qty);
            $this->model_products->update($update_product, $this->input->post('product')[$x]);
        }

        return ($order_id) ? $order_id : false;
    }

    /* Count items in an order */
    public function countOrderItem($order_id)
    {
        if ($order_id) {
            $sql = "SELECT * FROM orders_item WHERE order_id = ?";
            $query = $this->db->query($sql, array($order_id));
            return $query->num_rows();
        }
    }

    /* Update an existing order */
    public function update($id)
    {
        if ($id) {
            $user_id = $this->session->userdata('id');
            $data = array(
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phone' => $this->input->post('customer_phone'),
                'gross_amount' => $this->input->post('gross_amount_value'),
                'service_charge_rate' => $this->input->post('service_charge_rate'),
                'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value') : 0,
                'vat_charge_rate' => $this->input->post('vat_charge_rate'),
                'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
                'net_amount' => $this->input->post('net_amount_value'),
                'discount' => $this->input->post('discount'),
                'paid_status' => $this->input->post('paid_status'),
                'user_id' => $user_id
            );

            $this->db->where('id', $id);
            $update = $this->db->update('orders', $data);

            // Restore and update product quantities
            $this->load->model('model_products');
            $get_order_item = $this->getOrdersItemData($id);
            foreach ($get_order_item as $k => $v) {
                $product_id = $v['product_id'];
                $qty = $v['qty'];
                $product_data = $this->model_products->getProductData($product_id);
                $update_qty = $qty + $product_data['qty'];
                $update_product_data = array('qty' => $update_qty);
                $this->model_products->update($update_product_data, $product_id);
            }

            // Remove existing order items
            $this->db->where('order_id', $id);
            $this->db->delete('orders_item');

            // Insert updated order items
            $count_product = count($this->input->post('product'));
            for ($x = 0; $x < $count_product; $x++) {
                $items = array(
                    'order_id' => $id,
                    'product_id' => $this->input->post('product')[$x],
                    'qty' => $this->input->post('qty')[$x],
                    'rate' => $this->input->post('rate_value')[$x],
                    'amount' => $this->input->post('amount_value')[$x],
                );
                $this->db->insert('orders_item', $items);

                // Decrease stock from the product
                $product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
                $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];
                $update_product = array('qty' => $qty);
                $this->model_products->update($update_product, $this->input->post('product')[$x]);
            }

            return true;
        }
        return false;
    }

    /* Remove an order */
    public function remove($id)
    {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('orders');

            $this->db->where('order_id', $id);
            $delete_item = $this->db->delete('orders_item');
            return ($delete == true && $delete_item) ? true : false;
        }
        return false;
    }

    /* Count total paid orders */
    public function countTotalPaidOrders()
    {
        $sql = "SELECT * FROM orders WHERE paid_status = ?";
        $query = $this->db->query($sql, array(1));
        return $query->num_rows();
    }
}