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
            // Get user's store and role info
            $store_id = $this->session->userdata('store_id');
            $group_id = $this->session->userdata('group_id');
            $is_privileged = in_array($group_id, [1, 2]); // Admin (1) or Manager (2)

            log_message('debug', sprintf(
                'User Info - Store ID: %s, Group ID: %s, Is Privileged: %s',
                $store_id, 
                $group_id, 
                $is_privileged ? 'Yes' : 'No'
            ));

            if ($id) {
                // Single order query with store restriction
                $sql = "SELECT o.*,
                        COALESCE(s.name, 'N/A') as store_name,
                        COALESCE(u.username, 'Unknown') as clerk_name
                        FROM orders o
                        LEFT JOIN stores s ON o.store_id = s.id
                        LEFT JOIN users u ON o.user_id = u.id
                        WHERE o.id = ?";

                // Add store restriction for non-privileged users
                if (!$is_privileged) {
                    $sql .= " AND o.store_id = " . $this->db->escape($store_id);
                }

                $query = $this->db->query($sql, array($id));
                log_message('debug', 'Single order query: ' . $this->db->last_query());
                return ($query && $query->num_rows() > 0) ? $this->formatOrderRow($query->row_array()) : null;
            }

            // Query for all orders with store restriction
            $sql = "SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN stores s ON o.store_id = s.id
                    LEFT JOIN users u ON o.user_id = u.id";

            // Add store restriction for non-privileged users
            if (!$is_privileged) {
                $sql .= " WHERE o.store_id = " . $this->db->escape($store_id);
            }

            $sql .= " ORDER BY o.id DESC";

            $query = $this->db->query($sql);
            log_message('debug', 'All orders query: ' . $this->db->last_query());

            if (!$query || $query->num_rows() == 0) {
                log_message('debug', 'No orders found for store_id: ' . $store_id);
                return [];
            }

            $results = $query->result_array();
            log_message('debug', sprintf(
                'Found %d orders for store_id %s',
                count($results),
                $store_id
            ));

            return array_map([$this, 'formatOrderRow'], $results);

        } catch (Exception $e) {
            log_message('error', 'Error in getOrdersData: ' . $e->getMessage());
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

    /**
     * Create an order and its items from POST data or provided array.
     * Accepts optional $input array (sanitized) from controller.
     * Returns ['success'=>bool,'order_id'=>int|null,'error'=>string|null,'bill_no'=>string|null]
     */
    public function create($input = null)
    {
        try {
            $data = is_array($input) ? $input : $this->input->post(NULL, TRUE);

            // arrays
            $products = isset($data['product']) && is_array($data['product']) ? $data['product'] : [];
            $qtys     = isset($data['qty']) && is_array($data['qty']) ? $data['qty'] : [];
            $rates    = isset($data['rate']) && is_array($data['rate']) ? $data['rate'] : [];
            $amounts  = isset($data['amount_value']) && is_array($data['amount_value']) ? $data['amount_value'] : (isset($data['amount']) && is_array($data['amount']) ? $data['amount'] : []);

            // header fields
            $customer_name       = $data['customer_name'] ?? '';
            $customer_address    = $data['customer_address'] ?? '';
            $customer_phone      = $data['customer_phone'] ?? '';
            $store_id            = $data['store_id'] ?? $this->session->userdata('store_id') ?? 0;
            $gross_amount        = isset($data['gross_amount_value']) ? floatval($data['gross_amount_value']) : floatval($data['gross_amount'] ?? 0);
            $service_charge_rate = isset($data['service_charge_rate']) ? $data['service_charge_rate'] : ($data['service_charge_rate'] ?? 0);
            $service_charge      = isset($data['service_charge_value']) ? floatval($data['service_charge_value']) : floatval($data['service_charge'] ?? 0);
            $vat_charge_rate     = isset($data['vat_charge_rate']) ? $data['vat_charge_rate'] : ($data['vat_charge_rate'] ?? 0);
            $vat_charge          = isset($data['vat_charge_value']) ? floatval($data['vat_charge_value']) : floatval($data['vat_charge'] ?? 0);
            $net_amount          = isset($data['net_amount_value']) ? floatval($data['net_amount_value']) : floatval($data['net_amount'] ?? 0);
            $discount            = isset($data['discount']) ? floatval($data['discount']) : 0;

            $paid_status = isset($data['paid_status']) ? intval($data['paid_status']) : 1;
            $amount_paid = isset($data['amount_paid']) ? floatval($data['amount_paid']) : 0.00;

            // safety enforce
            if ($paid_status === 2) $amount_paid = $net_amount;
            elseif ($paid_status !== 3) $amount_paid = 0.00;

            if (empty($products)) {
                return ['success' => false, 'error' => 'No products provided', 'order_id' => null];
            }

            $this->db->trans_begin();

            $orderData = [
                'bill_no' => '', // update after insert
                'customer_name' => $customer_name,
                'customer_address' => $customer_address,
                'customer_phone' => $customer_phone,
                'date_time' => date('Y-m-d H:i:s'),
                'gross_amount' => $gross_amount,
                'service_charge_rate' => $service_charge_rate,
                'service_charge' => $service_charge,
                'vat_charge_rate' => $vat_charge_rate,
                'vat_charge' => $vat_charge,
                'net_amount' => $net_amount,
                'discount' => $discount,
                'paid_status' => $paid_status,
                'user_id' => $this->session->userdata('id') ?? 0,
                'store_id' => $store_id,
                'amount_paid' => number_format($amount_paid, 2, '.', '')
            ];

            $this->db->insert('orders', $orderData);
            $order_id = $this->db->insert_id();

            // items
            foreach ($products as $i => $pid) {
                $p = intval($pid);
                $q = isset($qtys[$i]) ? intval($qtys[$i]) : 0;
                $r = isset($rates[$i]) ? floatval($rates[$i]) : 0.00;
                $a = isset($amounts[$i]) ? floatval($amounts[$i]) : ($q * $r);

                $item = [
                    'order_id'   => $order_id,
                    'product_id' => $p,
                    'qty'        => $q,
                    'rate'       => $r,
                    'amount'     => $a
                ];
                $this->db->insert('orders_item', $item);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return ['success' => false, 'error' => 'Database error while saving order', 'order_id' => null];
            }

            $this->db->trans_commit();

            // generate bill and update
            $bill_no = 'INV-' . date('Ymd') . '-' . str_pad($order_id, 6, '0', STR_PAD_LEFT);
            if ($this->db->field_exists('bill_no', 'orders')) {
                $this->db->where('id', $order_id)->update('orders', ['bill_no' => $bill_no]);
            }

            return ['success' => true, 'order_id' => $order_id, 'bill_no' => $bill_no];
        } catch (Exception $e) {
            log_message('error', 'Model_orders::create error: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Exception: ' . $e->getMessage(), 'order_id' => null];
        }
    }

    /**
     * Get total purchased quantity for a product in a specific store
     * @param int $product_id Product ID
     * @param int|null $store_id Store ID
     * @return int Total purchased quantity
     */
    public function getTotalPurchased($product_id, $store_id = null)
    {
        try {
            if ($store_id === null) {
                $store_id = $this->session->userdata('store_id');
            }

            $sql = "SELECT COALESCE(SUM(qty), 0) as total_purchased 
                    FROM purchases 
                    WHERE product_id = ? AND store_id = ?";
            $query = $this->db->query($sql, [$product_id, $store_id]);
            $result = $query->row_array();
            log_message('debug', "getTotalPurchased - Product ID: $product_id, Store ID: $store_id, Total: " . ($result['total_purchased'] ?? 0));
            return intval($result['total_purchased'] ?? 0);
        } catch (Exception $e) {
            log_message('error', 'Error in getTotalPurchased: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get total ordered (sold) quantity for a product in a specific store
     * @param int $product_id Product ID
     * @param int|null $store_id Store ID
     * @return int Total ordered quantity
     */
    public function getTotalOrdered($product_id, $store_id = null)
    {
        try {
            if ($store_id === null) {
                $store_id = $this->session->userdata('store_id');
            }

            $sql = "SELECT COALESCE(SUM(oi.qty), 0) as total_ordered 
                    FROM orders_item oi 
                    JOIN orders o ON oi.order_id = o.id 
                    WHERE oi.product_id = ? AND o.store_id = ?";
            $query = $this->db->query($sql, [$product_id, $store_id]);
            $result = $query->row_array();
            log_message('debug', "getTotalOrdered - Product ID: $product_id, Store ID: $store_id, Total: " . ($result['total_ordered'] ?? 0));
            return intval($result['total_ordered'] ?? 0);
        } catch (Exception $e) {
            log_message('error', 'Error in getTotalOrdered: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get products with their current stock for a specific store
     * @param int|null $store_id Store ID
     * @return array Array of products with stock information
     */
    public function getProductsWithStock($store_id = null)
    {
        try {
            if ($store_id === null) {
                $store_id = $this->session->userdata('store_id');
            }

            if (empty($store_id)) {
                log_message('error', 'getProductsWithStock: no store_id provided');
                return [];
            }

            $sql = "
                SELECT 
                    pr.id,
                    pr.name,
                    COALESCE(pr.price, 0) AS price,
                    COALESCE((
                        SELECT SUM(pu.qty) FROM purchases pu
                        WHERE pu.product_id = pr.id AND pu.store_id = ?
                    ), 0) AS total_purchased,
                    COALESCE((
                        SELECT SUM(oi.qty) FROM orders_item oi
                        JOIN orders o ON oi.order_id = o.id
                        WHERE oi.product_id = pr.id AND o.store_id = ?
                    ), 0) AS total_ordered
                FROM products pr
                WHERE pr.store_id = ?
                ORDER BY pr.name ASC
            ";

            $query = $this->db->query($sql, [$store_id, $store_id, $store_id]);
            $rows = $query->result_array();

            foreach ($rows as &$r) {
                $r['total_purchased'] = intval($r['total_purchased']);
                $r['total_ordered'] = intval($r['total_ordered']);
                $r['current_stock'] = max(0, $r['total_purchased'] - $r['total_ordered']);
                $r['price'] = floatval($r['price']);
                log_message('debug', "getProductsWithStock - ID: {$r['id']}, purchased: {$r['total_purchased']}, ordered: {$r['total_ordered']}, stock: {$r['current_stock']}");
            }

            return $rows;
        } catch (Exception $e) {
            log_message('error', 'Error in getProductsWithStock: ' . $e->getMessage());
            return [];
        }
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

    // Add store filtering to other relevant methods
    public function countOrderData() 
    {
        $store_id = $this->session->userdata('store_id');
        $group_id = $this->session->userdata('group_id');
        $is_privileged = in_array($group_id, [1, 2]); // 1: admin, 2: manager

        if($is_privileged) {
            $sql = "SELECT COUNT(*) as count FROM orders";
            $query = $this->db->query($sql);
        } else {
            $sql = "SELECT COUNT(*) as count FROM orders WHERE store_id = ?";
            $query = $this->db->query($sql, array($store_id));
        }

        return $query->row()->count;
    }

    public function fetchOrdersData()
    {
        try {
            // Get user's store and role info
            $store_id = $this->session->userdata('store_id');
            $group_id = $this->session->userdata('group_id');
            $is_privileged = in_array($group_id, [1, 2]); // Admin (1) or Manager (2)

            log_message('debug', sprintf(
                'fetchOrdersData - Store ID: %s, Group ID: %s, Is Privileged: %s',
                $store_id,
                $group_id,
                $is_privileged ? 'Yes' : 'No'
            ));

            // Build base query
            $sql = "SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN stores s ON o.store_id = s.id
                    LEFT JOIN users u ON o.user_id = u.id";

            // Add store restriction for non-privileged users
            if (!$is_privileged && $store_id) {
                $sql .= " WHERE o.store_id = " . $this->db->escape($store_id);
                log_message('debug', 'Adding store restriction for store_id: ' . $store_id);
            }

            $sql .= " ORDER BY o.id DESC";

            log_message('debug', 'Executing query: ' . $sql);
            
            $query = $this->db->query($sql);
            
            if (!$query) {
                log_message('error', 'Query failed: ' . $this->db->error()['message']);
                return ['data' => []];
            }

            $results = $query->result_array();
            log_message('debug', sprintf('Query returned %d results', count($results)));

            return ['data' => $results];

        } catch (Exception $e) {
            log_message('error', 'Error in fetchOrdersData: ' . $e->getMessage());
            return ['data' => []];
        }
    }

    public function getStoreStock($store_id, $product_id = null) 
    {
        try {
            $sql = "SELECT 
                    p.product_id,
                    pr.name as product_name,
                    pr.unit,
                    COALESCE(SUM(p.qty), 0) as total_purchased,
                    COALESCE(
                        (SELECT SUM(oi.qty)
                         FROM orders o
                         JOIN orders_item oi ON o.id = oi.order_id
                         WHERE o.store_id = p.store_id 
                         AND oi.product_id = p.product_id
                        ), 0
                    ) as total_sold,
                    (COALESCE(SUM(p.qty), 0) - COALESCE(
                        (SELECT SUM(oi.qty)
                         FROM orders o
                         JOIN orders_item oi ON o.id = oi.order_id
                         WHERE o.store_id = p.store_id 
                         AND oi.product_id = p.product_id
                        ), 0
                    )) as current_stock
                FROM purchases p
                JOIN products pr ON p.product_id = pr.id
                WHERE p.store_id = ?";

            if ($product_id) {
                $sql .= " AND p.product_id = ?";
            }

            $sql .= " GROUP BY p.product_id, pr.name, pr.unit";

            $query = $this->db->query($sql, $product_id ? [$store_id, $product_id] : [$store_id]);
            
            return $product_id ? $query->row_array() : $query->result_array();

        } catch (Exception $e) {
            log_message('error', 'Error in getStoreStock: ' . $e->getMessage());
            return null;
        }
    } 

    /**
     * Return order items for a given order id
     * @param int $order_id
     * @return array
     */
    public function getOrdersItemData($order_id)
    {
        if (empty($order_id)) {
            return [];
        }

        $sql = "
            SELECT 
                oi.*,
                p.name AS product_name,
                p.unit AS product_unit
            FROM orders_item oi
            LEFT JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
            ORDER BY oi.id ASC
        ";
        $query = $this->db->query($sql, [$order_id]);
        return $query->result_array();
    }
}
?>