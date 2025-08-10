<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_products extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getProductData($id = null)
    {
        if ($id) {
            $sql = "SELECT id, name, price, availability FROM products WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            log_message('debug', 'getProductData Query: ' . $this->db->last_query());
            if ($query === FALSE) {
                log_message('error', 'getProductData Error: ' . $this->db->error()['message']);
                return null;
            }
            return $query->row_array();
        }

        $sql = "SELECT * FROM products WHERE availability = 1 ORDER BY id DESC";
        $query = $this->db->query($sql);
        log_message('debug', 'getProductData Query: ' . $this->db->last_query());
        if ($query === FALSE) {
            log_message('error', 'getProductData Error: ' . $this->db->error()['message']);
            return array();
        }
        return $query->result_array();
    }

    public function getActiveProductData()
    {
        $sql = "SELECT id, name, price FROM products WHERE availability = 1 ORDER BY id DESC";
        $query = $this->db->query($sql);
        log_message('debug', 'getActiveProductData Query: ' . $this->db->last_query());
        if ($query === FALSE) {
            log_message('error', 'getActiveProductData Error: ' . $this->db->error()['message']);
            return array();
        }
        return $query->result_array();
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

    public function getPurchasesData()
    {
        $this->db->select('purchases.*, products.name as product_name, purchases.supplier_no, COALESCE(SUM(purchases.qty), 0) - COALESCE(SUM(orders_item.qty), 0) as stock');
        $this->db->from('purchases');
        $this->db->join('products', 'products.id = purchases.product_id', 'left');
        $this->db->join('orders_item', 'orders_item.product_id = purchases.product_id', 'left');
        $this->db->group_by('purchases.id');
        $this->db->order_by('purchases.purchase_date', 'DESC');
        $query = $this->db->get();

        log_message('debug', 'getPurchasesData Query: ' . $this->db->last_query());
        if ($query === FALSE) {
            log_message('error', 'getPurchasesData Error: ' . $this->db->error()['message']);
            return array(); // Return empty array instead of failing
        }

        $result = $query->result_array();

        // Ensure stock is non-negative
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['stock'] = max(0, $result[$i]['stock']);
        }

        return $result;
    }

    public function getTotalPurchasedQuantity($product_id)
    {
        $this->db->select_sum('qty');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('purchases');
        $result = $query->row_array();
        return $result['qty'] ? (int)$result['qty'] : 0;
    }

    public function getAvailableStock($product_id)
    {
        $this->load->model('model_orders');
        $purchased = $this->getTotalPurchasedQuantity($product_id);
        $ordered = $this->model_orders->getTotalOrderedQuantity($product_id);
        $stock = $purchased - $ordered;
        log_message('debug', 'getAvailableStock(product_id: ' . $product_id . '): Purchased=' . $purchased . ', Ordered=' . $ordered . ', Stock=' . $stock);
        return $stock >= 0 ? $stock : 0;
    }
}