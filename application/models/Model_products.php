<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_products extends CI_Model {
    protected $last_db_error = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getProductData($id = null)
    {
        if ($id) {
            $sql = "SELECT p.*, 
                    COALESCE(
                        (SELECT SUM(pur.qty) 
                         FROM purchases pur 
                         WHERE pur.product_id = p.id 
                         AND pur.store_id = ?
                        ), 0
                    ) - 
                    COALESCE(
                        (SELECT SUM(oi
                         FROM orders o
                         JOIN orders_item oi ON o.id = oi.order_id
                         WHERE oi.product_id = p.id 
                         AND o.store_id = ?
                        ), 0
                    ) as current_stock
                    FROM products p 
                    WHERE p.id = ?";
            
            $store_id = $this->session->userdata('store_id');
            $query = $this->db->query($sql, array($store_id, $store_id, $id));
            
            log_message('debug', 'getProductData Query: ' . $this->db->last_query());
            if ($query === FALSE) {
                log_message('error', 'getProductData Error: ' . $this->db->error()['message']);
                return null;
            }
            return $query->row_array();
        }

        // Get
        $store_id = $this->session->userdata('store_id');
        $is_admin = ($this->session->userdata('group_id') == 1);

        $sql = "SELECT p.*, 
                COALESCE(
                    (SELECT SUM(pur.qty) 
                     FROM purchases pur 
                     WHERE pur.product_id = p.id 
                     AND pur.store_id = ?
                    ), 0
                ) - 
                COALESCE(
                    (SELECT SUM(oi.qty)
                     FROM orders o
                     JOIN orders_item oi ON o.id = oi.order_id
                     WHERE oi.product_id = p.id 
                     AND o.store_id = ?
                    ), 0
                ) as current_stock
                FROM products p
                WHERE p.availability = 1 " . 
                (!$is_admin ? "AND (p.store_id = ? OR p.store_id IS NULL) " : "") .
                "ORDER BY p.id DESC";

        $params = array($store_id, $store_id);
        if (!$is_admin) {
            $params[] = $store_id;
        }

        $query = $this->db->query($sql, $params);
        log_message('debug', 'getProductData Query: ' . $this->db->last_query());
        
        if ($query === FALSE) {
            log_message('error', 'getProductData Error: ' . $this->db->error()['message']);
            return array();
        }
        return $query->result_array();
    }

    public function getActiveProductData()
    {
        $this->db->select('id, name, price, unit');
        $this->db->from('products');
        $this->db->where('availability', 1);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function create($data)
    {
        if (!$data) {
            return false;
        }

        // Ensure required fields are present
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['unit']) || 
            !isset($data['category_id']) || !isset($data['store_id']) || !isset($data['availability'])) {
            return false;
        }

        // Define valid columns based on table schema
        $valid_columns = [
            'name' => $data['name'],
            'price' => $data['price'],
            'unit' => $data['unit'],
            'description' => isset($data['description']) ? $data['description'] : '',
            'attribute_value_id' => isset($data['attribute_value_id']) ? $data['attribute_value_id'] : NULL,
            'brand_id' => isset($data['brand_id']) && $data['brand_id'] > 0 ? $data['brand_id'] : NULL,
            'category_id' => $data['category_id'],
            'store_id' => $data['store_id'],
            'availability' => $data['availability'],
            'image' => isset($data['image']) ? $data['image'] : NULL
        ];

        $this->db->trans_start();
        $insert = $this->db->insert('products', $valid_columns);
        $product_id = $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return $product_id;
    }

    public function update($data, $id)
    {
        if (!$data || !$id) {
            return false;
        }

        // Ensure required fields are present
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['unit']) || 
            !isset($data['category_id']) || !isset($data['store_id']) || !isset($data['availability'])) {
            return false;
        }

        // Define valid columns based on table schema
        $valid_columns = [
            'name' => $data['name'],
            'price' => $data['price'],
            'unit' => $data['unit'],
            'description' => isset($data['description']) ? $data['description'] : '',
            'attribute_value_id' => isset($data['attribute_value_id']) ? $data['attribute_value_id'] : NULL,
            'brand_id' => isset($data['brand_id']) && $data['brand_id'] > 0 ? $data['brand_id'] : NULL,
            'category_id' => $data['category_id'],
            'store_id' => $data['store_id'],
            'availability' => $data['availability'],
            'image' => isset($data['image']) ? $data['image'] : NULL
        ];

        $this->db->trans_start();
        $this->db->where('id', $id);
        $update = $this->db->update('products', $valid_columns);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function remove($id)
    {
        if (!$id) {
            return false;
        }

        $this->db->trans_start();
        $this->db->where('id', $id);
        $delete = $this->db->delete('products');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function countTotalProducts()
    {
        $sql = "SELECT * FROM products";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function countTotalBrands()
    {
        $sql = "SELECT * FROM brands";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function countTotalCategory()
    {
        $sql = "SELECT * FROM categories";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function countTotalAttributes()
    {
        $sql = "SELECT * FROM attributes";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * Get purchases data with store filtering
     * @param int|null $store_id Store ID for filtering
     * @param bool $is_admin Whether user is admin
     * @return array Array of purchase records
     */
    public function getPurchasesData($store_id = null, $group_id = null)
    {
        try {
            $this->db->select('
                purchases.*, 
                products.name as product_name, 
                products.unit,
                stores.name as store_name,
                users.username as created_by_name'
            );
            $this->db->from('purchases');
            $this->db->join('products', 'products.id = purchases.product_id');
            $this->db->join('stores', 'stores.id = purchases.store_id');
            $this->db->join('users', 'users.id = purchases.user_id', 'left');

            // Apply store filter based on user role
            if ($group_id != 1 && $group_id != 2) {
                // For clerk, show only their store's purchases
                $this->db->where('purchases.store_id', $store_id);
            }
            // For admin/manager, no store filter unless specifically requested
            elseif ($store_id) {
                $this->db->where('purchases.store_id', $store_id);
            }

            $this->db->order_by('purchases.purchase_date', 'desc');
            $query = $this->db->get();

            if (!$query) {
                throw new Exception($this->db->error()['message']);
            }

            log_message('debug', 'getPurchasesData SQL: ' . $this->db->last_query());
            return $query->result_array();

        } catch (Exception $e) {
            log_message('error', 'getPurchasesData error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getTotalPurchased($product_id, $store_id)
    {
        $this->db->select_sum('qty');
        $this->db->where('product_id', $product_id);
        $this->db->where('store_id', $store_id);
        $query = $this->db->get('purchases');
        return (int)($query->row()->qty ?? 0);
    }

    public function getTotalSold($product_id, $store_id)
    {
        $this->db->select_sum('orders_item.qty');
        $this->db->from('orders_item');
        $this->db->join('orders', 'orders.id = orders_item.order_id');
        $this->db->where('orders_item.product_id', $product_id);
        $this->db->where('orders.store_id', $store_id);
        $query = $this->db->get();
        return (int)($query->row()->qty ?? 0);
    }

    public function getAvailableStock($product_id, $store_id)
    {
        $purchased = $this->getTotalPurchased($product_id, $store_id);
        $sold = $this->getTotalSold($product_id, $store_id);
        $stock = $purchased - $sold;
        
        log_message('debug', sprintf(
            'Stock calculation for product %d in store %d: Purchased=%d, Sold=%d, Available=%d',
            $product_id, $store_id, $purchased, $sold, max(0, $stock)
        ));
        
        return max(0, $stock);
    }

    public function getStockLevels($store_id = null)
    {
        try {
            $this->db->select('
                products.id,
                products.name,
                products.price,
                products.unit,
                stores.name as store_name,
                COALESCE(
                    (SELECT SUM(p.qty)
                     FROM purchases p
                     WHERE p.product_id = products.id
                     AND p.store_id = ' . ($store_id ? 'stores.id' : 'p.store_id') . '
                    ), 0
                ) as total_purchased,
                COALESCE(
                    (SELECT SUM(oi.qty)
                     FROM orders o
                     JOIN orders_item oi ON o.id = oi.order_id
                     WHERE oi.product_id = products.id
                     AND o.store_id = ' . ($store_id ? 'stores.id' : 'o.store_id') . '
                    ), 0
                ) as total_sold
            ');
            
            $this->db->from('products');
            $this->db->join('stores', 'stores.id = products.store_id', 'left');
            
            if ($store_id) {
                $this->db->where('stores.id', $store_id);
            }

            $query = $this->db->get();
            
            if (!$query) {
                throw new Exception($this->db->error()['message']);
            }

            $results = $query->result_array();

            // Calculate current stock and format data
            foreach ($results as &$row) {
                $row['current_stock'] = max(0, 
                    intval($row['total_purchased']) - intval($row['total_sold'])
                );
                // Remove calculation fields from output
                unset($row['total_purchased'], $row['total_sold']);
            }

            return $results;

        } catch (Exception $e) {
            log_message('error', 'getStockLevels error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createPurchase($data)
    {
        try {
            // If $data is a single purchase, wrap in array
            $purchases = isset($data[0]) && is_array($data[0]) ? $data : [$data];
            $insert_ids = [];
            $this->db->trans_start();
            foreach ($purchases as $purchase) {
                $required_fields = ['product_id', 'qty', 'price'];
                foreach ($required_fields as $field) {
                    if (!isset($purchase[$field]) || $purchase[$field] === '') {
                        throw new Exception("Missing required field: {$field}");
                    }
                }
                $insert = [
                    'product_id'    => $purchase['product_id'],
                    'supplier'      => $purchase['supplier'] ?? '',
                    'supplier_no'   => $purchase['supplier_no'] ?? '',
                    'price'         => (float)($purchase['price'] ?? 0),
                    'unit'          => $purchase['unit'] ?? '',
                    'qty'           => (float)($purchase['qty'] ?? 0),
                    'total_amount'  => isset($purchase['total_amount']) ? (float)$purchase['total_amount'] : ((float)($purchase['price'] ?? 0) * (float)($purchase['qty'] ?? 0)),
                    'status'        => $purchase['status'] ?? 'Unpaid',
                    'amount_paid'   => isset($purchase['amount_paid']) ? (float)$purchase['amount_paid'] : 0,
                    'purchase_date' => $purchase['purchase_date'] ?? date('Y-m-d H:i:s'),
                    'store_id'      => $purchase['store_id'] ?? $this->session->userdata('store_id') ?? NULL,
                    'user_id'       => $purchase['user_id'] ?? $this->session->userdata('id') ?? NULL
                ];
                $this->db->insert('purchases', $insert);
                $error = $this->db->error();
                if (!empty($error['code'])) {
                    $this->last_db_error = $error;
                    log_message('error', 'createPurchase DB error: ' . json_encode($error) . ' -- data: ' . json_encode($insert));
                    continue;
                }
                $insert_ids[] = $this->db->insert_id();
            }
            $this->db->trans_complete();
            return $insert_ids;
        } catch (Exception $e) {
            log_message('error', 'Create Purchase Error: ' . $e->getMessage());
            return false;
        }
    }

    // allow controller to fetch the last DB error
    public function getLastDbError()
    {
        return $this->last_db_error;
    }

    public function deletePurchase($id)
    {
        try {
            $this->db->trans_start();
            
            // Check if purchase exists
            $purchase = $this->db->get_where('purchases', ['id' => $id])->row();
            if (!$purchase) {
                throw new Exception('Purchase not found');
            }

            // Delete the purchase
            $this->db->where('id', $id);
            $delete = $this->db->delete('purchases');
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            return true;

        } catch (Exception $e) {
            log_message('error', 'Delete Purchase Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getAll($params = [])
    {
        // If a newer method exists, delegate to it for compatibility
        if (method_exists($this, 'getProducts')) {
            return $this->getProducts($params);
        }
        // Fallback: simple product list
        $this->db->reset_query();
        $this->db->select('*')->from('products');
        if (isset($params['active'])) {
            $this->db->where('active', $params['active']);
        }
        if (!empty($params['order_by'])) {
            $this->db->order_by($params['order_by']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
