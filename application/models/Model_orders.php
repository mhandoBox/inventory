<?php 
class Model_orders extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get orders data for single order or all orders
     * @param int|null $id Order ID (optional)
     * @return array|null Returns order data array or null on error
     */
    public function getOrdersData($id = null) 
    {
        try {
            if ($id) {
                // Query for single order
                $sql = "SELECT o.*,
                        COALESCE(s.name, 'N/A') as store_name,
                        COALESCE(u.username, 'Unknown') as clerk_name,
                        o.gross_amount,
                        o.net_amount,
                        o.paid_status,
                        o.amount_paid,
                        o.service_charge,
                        o.vat_charge,
                        o.discount
                        FROM orders o
                        LEFT JOIN users u ON u.id = o.user_id
                        LEFT JOIN stores s ON o.store_id = s.id
                        WHERE o.id = ?";

                $query = $this->db->query($sql, array($id));
                log_message('debug', 'Single order query: ' . $this->db->last_query());
                return ($query) ? $this->formatOrderRow($query->row_array()) : null;
            }

            // Query for all orders
            $sql = "SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name,
                    CASE 
                        WHEN o.paid_status = 1 THEN 'Not Paid'
                        WHEN o.paid_status = 2 THEN 'Paid'
                        WHEN o.paid_status = 3 THEN 'Partially Paid'
                        ELSE 'Not Paid'
                    END as payment_status
                    FROM orders o
                    LEFT JOIN users u ON u.id = o.user_id
                    LEFT JOIN stores s ON o.store_id = s.id
                    ORDER BY o.id DESC";

            $query = $this->db->query($sql);
            log_message('debug', 'All orders query: ' . $this->db->last_query());

            if (!$query) {
                log_message('error', 'Query failed: ' . $this->db->error()['message']);
                return [];
            }

            $results = $query->result_array();
            
            // Debug log the raw results
            log_message('debug', 'Raw results: ' . json_encode($results));

            return array_map(function($order) {
                return [
                    'id' => intval($order['id']),
                    'bill_no' => $order['bill_no'],
                    'customer_name' => $order['customer_name'],
                    'customer_phone' => $order['customer_phone'],
                    'date_time' => $order['date_time'],
                    'store_name' => $order['store_name'],
                    'paid_status' => intval($order['paid_status']), // Keep original status value
                    'payment_status' => $order['payment_status'], // Add formatted status
                    'net_amount' => floatval($order['net_amount']),
                    'clerk_name' => $order['clerk_name']
                ];
            }, $results);

        } catch (Exception $e) {
            log_message('error', 'Error in getOrdersData: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return [];
        }
    }

    /**
     * Format order row with consistent structure and default values
     * @param array $order Raw order data
     * @return array Formatted order data
     */
    private function formatOrderRow($order)
    {
        if (!$order) return null;

        // Set default values for all possible fields
        $defaults = array(
            'id' => 0,
            'bill_no' => 'N/A',
            'customer_name' => 'N/A',
            'customer_phone' => 'N/A',
            'customer_address' => '',
            'date_time' => null,
            'store_name' => 'N/A',
            'paid_status' => 1, // Default to Not Paid (1)
            'amount_paid' => 0,
            'gross_amount' => 0,
            'net_amount' => 0,
            'service_charge' => 0,
            'vat_charge' => 0,
            'discount' => 0,
            'clerk_name' => 'Unknown'
        );

        // Merge defaults with actual order data
        $order = array_merge($defaults, array_filter($order, function($value) {
            return $value !== null && $value !== '';
        }));

        return array(
            'id' => intval($order['id']),
            'bill_no' => $order['bill_no'],
            'customer_name' => $order['customer_name'],
            'customer_phone' => $order['customer_phone'],
            'customer_address' => $order['customer_address'],
            'date_time' => $order['date_time'] ? 
                date('Y-m-d H:i:s', strtotime($order['date_time'])) : 'N/A',
            'store_name' => $order['store_name'],
            'paid_status' => intval($order['paid_status']),
            'amount_paid' => floatval($order['amount_paid']),
            'gross_amount' => floatval($order['gross_amount']),
            'net_amount' => floatval($order['net_amount']),
            'service_charge' => floatval($order['service_charge']),
            'vat_charge' => floatval($order['vat_charge']),
            'discount' => floatval($order['discount']),
            'clerk_name' => $order['clerk_name']
        );
    }

    private function getPaymentStatusText($status, $amountPaid)
    {
        switch(intval($status)) {
            case 2: // Paid
                return 'PAID';
            case 3: // Partially Paid
                return $amountPaid > 0 ? 
                    sprintf('PARTIALLY PAID (%.2f)', floatval($amountPaid)) : 
                    'NOT PAID';
            case 1: // Not Paid
            default:
                return 'NOT PAID';
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
        
        // Get POST data with defaults to prevent undefined index errors
        $post_data = array(
            'gross_amount' => $this->input->post('gross_amount_value') ?? 0,
            'service_charge_rate' => $this->input->post('service_charge_rate') ?? 0,
            'service_charge' => $this->input->post('service_charge_value') ?? 0,
            'vat_charge_rate' => $this->input->post('vat_charge_rate') ?? 0,
            'vat_charge' => $this->input->post('vat_charge_value') ?? 0,
            'discount' => $this->input->post('discount') ?? 0,
            'net_amount' => $this->input->post('net_amount_value') ?? 0,
            'customer_name' => $this->input->post('customer_name') ?? '',
            'customer_address' => $this->input->post('customer_address') ?? '',
            'customer_phone' => $this->input->post('customer_phone') ?? '',
            'paid_status' => $this->input->post('paid_status') ?? 2,
            'amount_paid' => $this->input->post('amount_paid') ?? 0
        );

        log_message('debug', 'POST data with defaults: ' . json_encode($post_data));

        $user_id = $this->session->userdata('id');
        $bill_no = 'BILPR-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $store_id = $this->session->userdata('store_id');

        if (empty($store_id)) {
            log_message('error', 'No store_id found in session');
            return array('success' => false, 'error' => 'No store assigned to user');
        }

        $order_data = array(
            'bill_no' => $bill_no,
            'date_time' => date('Y-m-d H:i:s'),
            'gross_amount' => $post_data['gross_amount'],
            'service_charge_rate' => $post_data['service_charge_rate'],
            'service_charge' => $post_data['service_charge'],
            'vat_charge_rate' => $post_data['vat_charge_rate'],
            'vat_charge' => $post_data['vat_charge'],
            'discount' => $post_data['discount'],
            'net_amount' => $post_data['net_amount'],
            'customer_name' => $post_data['customer_name'],
            'customer_address' => $post_data['customer_address'],
            'customer_phone' => $post_data['customer_phone'],
            'user_id' => $user_id,
            'store_id' => $store_id,
            'paid_status' => $post_data['paid_status'],
            'amount_paid' => $post_data['amount_paid']
        );

        // Debug log before inserting
        log_message('debug', 'Order data to insert: ' . json_encode($order_data));

        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        $product = $this->input->post('product');
        $qty = $this->input->post('qty');
        $rate = $this->input->post('rate_value');
        $amount = $this->input->post('amount_value');

        $order_item = array();
        $error = '';
        for ($x = 0; $x < count($product); $x++) {
            // Fetch total purchased and ordered for stock calculation
            $total_purchased = $this->getTotalPurchased($product[$x]);
            $total_ordered = $this->getTotalOrdered($product[$x]);
            $stock = max(0, $total_purchased - $total_ordered);
            log_message('debug', 'Create Order - Product ID: ' . $product[$x] . ', Total Purchased: ' . $total_purchased . ', Total Ordered: ' . $total_ordered . ', Stock: ' . $stock . ', Requested Qty: ' . $qty[$x]);

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

    /**
     * Helper method to get total purchased for a product
     */
    private function getTotalPurchased($product_id)
    {
        $sql = "SELECT SUM(qty) as total FROM purchases_item WHERE product_id = ?";
        $query = $this->db->query($sql, array($product_id));
        return $query->row()->total ?? 0;
    }

    /**
     * Helper method to get total ordered for a product
     */
    private function getTotalOrdered($product_id)
    {
        $sql = "SELECT SUM(qty) as total FROM orders_item WHERE product_id = ?";
        $query = $this->db->query($sql, array($product_id));
        return $query->row()->total ?? 0;
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
            // Get POST data with defaults
            $post_data = array(
                'gross_amount' => $this->input->post('gross_amount_value') ?? 0,
                'service_charge_rate' => $this->input->post('service_charge_rate') ?? 0,
                'service_charge' => $this->input->post('service_charge_value') ?? 0,
                'vat_charge_rate' => $this->input->post('vat_charge_rate') ?? 0,
                'vat_charge' => $this->input->post('vat_charge_value') ?? 0,
                'discount' => $this->input->post('discount') ?? 0,
                'net_amount' => $this->input->post('net_amount_value') ?? 0,
                'customer_name' => $this->input->post('customer_name') ?? '',
                'customer_address' => $this->input->post('customer_address') ?? '',
                'customer_phone' => $this->input->post('customer_phone') ?? '',
                'paid_status' => $this->input->post('paid_status') ?? 2,
                'amount_paid' => $this->input->post('amount_paid') ?? 0
            );

            $user_id = $this->session->userdata('id');

            $order_data = array(
                'gross_amount' => $post_data['gross_amount'],
                'service_charge_rate' => $post_data['service_charge_rate'],
                'service_charge' => $post_data['service_charge'],
                'vat_charge_rate' => $post_data['vat_charge_rate'],
                'vat_charge' => $post_data['vat_charge'],
                'discount' => $post_data['discount'],
                'net_amount' => $post_data['net_amount'],
                'customer_name' => $post_data['customer_name'],
                'customer_address' => $post_data['customer_address'],
                'customer_phone' => $post_data['customer_phone'],
                'user_id' => $user_id,
                'paid_status' => $post_data['paid_status'],
                'amount_paid' => $post_data['amount_paid']
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
                // Fetch total purchased and ordered for stock calculation
                $total_purchased = $this->getTotalPurchased($product[$x]);
                $total_ordered = $this->getTotalOrdered($product[$x]) - $this->getPreviousQty($id, $product[$x]); // Adjust for current order
                $stock = max(0, $total_purchased - $total_ordered);
                log_message('debug', 'Update Order - Product ID: ' . $product[$x] . ', Total Purchased: ' . $total_purchased . ', Total Ordered: ' . $total_ordered . ', Stock: ' . $stock . ', Requested Qty: ' . $qty[$x]);

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

    /**
     * Helper method to get previous qty for a product in an order
     */
    private function getPreviousQty($order_id, $product_id)
    {
        $sql = "SELECT qty FROM orders_item WHERE order_id = ? AND product_id = ?";
        $query = $this->db->query($sql, array($order_id, $product_id));
        return $query->row()->qty ?? 0;
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