<?php 
class Model_orders extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOrdersData($id = null) 
    {
        try {
            if ($id) {
                $sql = "SELECT o.*, 
                        COALESCE((SELECT SUM(oi.qty) FROM orders_item oi WHERE oi.order_id = o.id), 0) as total_products,
                        u.username as clerk_name
                        FROM orders o
                        LEFT JOIN users u ON u.id = o.user_id
                        WHERE o.id = ?";
                $query = $this->db->query($sql, array($id));
                log_message('debug', 'Single order query: ' . $this->db->last_query());
                if ($query === FALSE) {
                    log_message('error', 'Single order query failed: ' . $this->db->error()['message']);
                    return null;
                }
                $result = $query->row_array();
                log_message('debug', 'Single order result: ' . json_encode($result));
                return $result;
            }

            $sql = "SELECT o.*, 
                    COALESCE(SUM(oi.qty), 0) as total_products,
                    COALESCE(SUM(oi.amount), 0) as total_amount,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN orders_item oi ON o.id = oi.order_id
                    LEFT JOIN users u ON u.id = o.user_id
                    GROUP BY o.id, o.bill_no, o.customer_name, o.customer_phone, 
                             o.date_time, o.gross_amount, o.service_charge_rate, 
                             o.service_charge, o.vat_charge_rate, o.vat_charge, 
                             o.discount, o.net_amount, o.paid_status, o.user_id,
                             u.username
                    ORDER BY o.id DESC";
            $query = $this->db->query($sql);
            log_message('debug', 'All orders query: ' . $this->db->last_query());
            if ($query === FALSE) {
                log_message('error', 'All orders query failed: ' . $this->db->error()['message']);
                return [];
            }
            $result = $query->result_array();
            log_message('debug', 'Number of orders found: ' . count($result));
            log_message('debug', 'Orders result: ' . json_encode($result));
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Exception in getOrdersData: ' . $e->getMessage());
            return [];
        }
    }

    public function countOrderItem($order_id) 
    {
        if ($order_id) {
            $sql = "SELECT SUM(qty) as count_qty FROM orders_item WHERE order_id = ? AND order_id > 0";
            $query = $this->db->query($sql, array($order_id));
            log_message('debug', 'countOrderItem Query: ' . $this->db->last_query());
            return $query->row_array()['count_qty'];
        }
        return 0;
    }

    public function create() 
    {
        log_message('debug', 'Entered Model_orders::create()');
        log_message('debug', 'POST data: ' . json_encode($this->input->post()));

        $user_id = $this->session->userdata('id');
        $bill_no = 'ORD-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4)) . date('Ymd');
        
        $total_purchased = array();
        foreach ($this->input->post('product') as $product_id) {
            $sql = "SELECT COALESCE(SUM(qty), 0) as qty FROM purchases WHERE product_id = ?";
            $query = $this->db->query($sql, array($product_id));
            log_message('debug', 'create Purchase Query for Product ID ' . $product_id . ': ' . $this->db->last_query());
            $total_purchased[$product_id] = $query->row()->qty ? (int)$query->row()->qty : 0;
        }

        $total_ordered = array();
        foreach ($this->input->post('product') as $product_id) {
            $sql = "SELECT COALESCE(SUM(qty), 0) as qty FROM orders_item WHERE product_id = ? AND order_id > 0";
            $query = $this->db->query($sql, array($product_id));
            log_message('debug', 'create Order Item Query for Product ID ' . $product_id . ': ' . $this->db->last_query());
            $total_ordered[$product_id] = $query->row()->qty ? (int)$query->row()->qty : 0;
        }

        $order_data = array(
            'bill_no' => $bill_no,
            'date_time' => date('Y-m-d H:i:s'),
            'gross_amount' => $this->input->post('gross_amount_value'),
            'service_charge_rate' => $this->input->post('service_charge_rate'),
            'service_charge' => $this->input->post('service_charge_value'),
            'vat_charge_rate' => $this->input->post('vat_charge_rate'),
            'vat_charge' => $this->input->post('vat_charge_value'),
            'discount' => $this->input->post('discount'),
            'net_amount' => $this->input->post('net_amount_value'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_phone' => $this->input->post('customer_phone'),
            'user_id' => $user_id,
            'paid_status' => $this->input->post('paid_status'),
            'amount_paid' => $this->input->post('amount_paid')
        );

        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        $product = $this->input->post('product');
        $qty = $this->input->post('qty');
        $rate = $this->input->post('rate_value');
        $amount = $this->input->post('amount_value');

        $order_item = array();
        $error = '';
        for ($x = 0; $x < count($product); $x++) {
            $stock = max(0, $total_purchased[$product[$x]] - $total_ordered[$product[$x]]);
            log_message('debug', 'Create Order - Product ID: ' . $product[$x] . ', Total Purchased: ' . $total_purchased[$product[$x]] . ', Total Ordered: ' . $total_ordered[$product[$x]] . ', Stock: ' . $stock . ', Requested Qty: ' . $qty[$x]);

            if ($qty[$x] > $stock) {
                $error .= "Quantity exceeds available stock ($stock) for product ID " . $product[$x] . ". ";
            } else {
                $order_item[] = array(
                    'order_id' => $order_id,
                    'product_id' => $product[$x],
                    'qty' => $qty[$x],
                    'rate' => $rate[$x],
                    'amount' => $amount[$x]
                );
            }
        }

        if ($error) {
            $this->db->where('id', $order_id);
            $this->db->delete('orders');
            log_message('debug', 'Order creation error: ' . $error);
            return array('success' => false, 'error' => $error);
        }

        if (!empty($order_item)) {
            $this->db->insert_batch('orders_item', $order_item);
        }

        log_message('debug', 'Order creation success, order_id: ' . $order_id);
        return array('success' => true, 'order_id' => $order_id);
    }

    public function getOrdersItemData($order_id) 
    {
        if ($order_id) {
            $sql = "SELECT orders_item.*, products.name as product_name 
                    FROM orders_item 
                    LEFT JOIN products ON products.id = orders_item.product_id 
                    WHERE orders_item.order_id = ? AND orders_item.order_id > 0";
            $query = $this->db->query($sql, array($order_id));
            log_message('debug', 'getOrdersItemData Query: ' . $this->db->last_query());
            return $query->result_array();
        }
        return array();
    }

    public function update($id) 
    {
        if ($id) {
            $user_id = $this->session->userdata('id');

            $total_purchased = array();
            foreach ($this->input->post('product') as $product_id) {
                $sql = "SELECT COALESCE(SUM(qty), 0) as qty FROM purchases WHERE product_id = ?";
                $query = $this->db->query($sql, array($product_id));
                log_message('debug', 'update Purchase Query for Product ID ' . $product_id . ': ' . $this->db->last_query());
                $total_purchased[$product_id] = $query->row()->qty ? (int)$query->row()->qty : 0;
            }

            $total_ordered = array();
            foreach ($this->input->post('product') as $product_id) {
                $sql = "SELECT COALESCE(SUM(qty), 0) as qty FROM orders_item WHERE product_id = ? AND order_id > 0 AND order_id != ?";
                $query = $this->db->query($sql, array($product_id, $id));
                log_message('debug', 'update Order Item Query for Product ID ' . $product_id . ': ' . $this->db->last_query());
                $total_ordered[$product_id] = $query->row()->qty ? (int)$query->row()->qty : 0;
            }

            $order_data = array(
                'gross_amount' => $this->input->post('gross_amount_value'),
                'service_charge_rate' => $this->input->post('service_charge_rate'),
                'service_charge' => $this->input->post('service_charge_value'),
                'vat_charge_rate' => $this->input->post('vat_charge_rate'),
                'vat_charge' => $this->input->post('vat_charge_value'),
                'discount' => $this->input->post('discount'),
                'net_amount' => $this->input->post('net_amount_value'),
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phone' => $this->input->post('customer_phone'),
                'user_id' => $user_id,
                'paid_status' => $this->input->post('paid_status'),
                'amount_paid' => $this->input->post('amount_paid')
            );

            $this->db->where('id', $id);
            $this->db->update('orders', $order_data);

            $this->db->where('order_id', $id);
            $this->db->delete('orders_item');

            $product = $this->input->post('product');
            $qty = $this->input->post('qty');
            $rate = $this->input->post('rate_value');
            $amount = $this->input->post('amount_value');

            $order_item = array();
            $error = '';
            for ($x = 0; $x < count($product); $x++) {
                $stock = max(0, $total_purchased[$product[$x]] - $total_ordered[$product[$x]]);
                log_message('debug', 'Update Order - Product ID: ' . $product[$x] . ', Total Purchased: ' . $total_purchased[$product[$x]] . ', Total Ordered: ' . $total_ordered[$product[$x]] . ', Stock: ' . $stock . ', Requested Qty: ' . $qty[$x]);

                if ($qty[$x] > $stock) {
                    $error .= "Quantity exceeds available stock ($stock) for product ID " . $product[$x] . ". ";
                } else {
                    $order_item[] = array(
                        'order_id' => $id,
                        'product_id' => $product[$x],
                        'qty' => $qty[$x],
                        'rate' => $rate[$x],
                        'amount' => $amount[$x]
                    );
                }
            }

            if ($error) {
                return array('success' => false, 'error' => $error);
            }

            if (!empty($order_item)) {
                $this->db->insert_batch('orders_item', $order_item);
            }

            return array('success' => true, 'error' => null);
        }
        return array('success' => false, 'error' => 'Invalid order ID');
    }

    public function remove($order_id)
    {
        if ($order_id) {
            $this->db->trans_start(); // Start transaction

            $this->db->where('order_id', $order_id);
            $this->db->delete('orders_item');

            $this->db->where('id', $order_id);
            $this->db->delete('orders');

            $this->db->trans_complete(); // Complete transaction

            return true;
        }
        return false;
    }

    public function countTotalPaidOrders()
    {
        $sql = "SELECT COUNT(*) as total FROM orders WHERE paid_status = 1";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }
}
?>