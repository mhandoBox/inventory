<?php

class Dashboard extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Dashboard';
        
        $this->load->model('model_products');
        $this->load->model('model_orders');
        $this->load->model('model_users');
        $this->load->model('model_stores');
    }

    /* 
    * It only redirects to the manage category page
    * It passes the total product, total paid orders, total users, and total stores information
    into the frontend.
    */
    public function index()
    {
        // Products
        if (method_exists($this->model_products, 'countTotalProducts')) {
            $this->data['total_products'] = (int) $this->model_products->countTotalProducts();
        } else {
            $this->data['total_products'] = (int) $this->fallbackCount('products');
        }

        // Paid orders - updated to check for both 'paid' and 'Paid' status
        if (method_exists($this->model_orders, 'countTotalPaidOrders')) {
            $this->data['total_paid_orders'] = (int) $this->model_orders->countTotalPaidOrders();
        } else {
            // Use OR condition for multiple possible paid statuses
            $this->db->reset_query();
            $this->db->from('orders');
            $this->db->group_start()
                     ->where('payment_status', 'paid')
                     ->or_where('payment_status', 'Paid')
                     ->or_where('payment_status', 'completed')
                     ->or_where('payment_status', 'Completed')
                     ->group_end();
            $this->data['total_paid_orders'] = (int) $this->db->count_all_results();
        }

        // Users
        if (method_exists($this->model_users, 'countTotalUsers')) {
            $this->data['total_users'] = (int) $this->model_users->countTotalUsers();
        } else {
            $this->data['total_users'] = (int) $this->fallbackCount('users');
        }

        // Stores
        if (method_exists($this->model_stores, 'countTotalStores')) {
            $this->data['total_stores'] = (int) $this->model_stores->countTotalStores();
        } else {
            $this->data['total_stores'] = (int) $this->fallbackCount('stores');
        }

        // Get total order amounts by payment status
        $this->db->select('paid_status, SUM(net_amount) as total');
        $this->db->from('orders');
        $this->db->group_by('paid_status');
        $query = $this->db->get();
        
        // Initialize payment totals
        $payment_data = array(
            'paid' => 0,
            'partial' => 0,
            'unpaid' => 0
        );

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // Update status mapping:
                // 1 = unpaid
                // 2 = paid      // This was being interpreted as partial
                // 3 = partial
                switch ($row->paid_status) {
                    case 2:
                        $payment_data['paid'] = $row->total;
                        break;
                    case 3:
                        $payment_data['partial'] = $row->total;
                        break;
                    case 1:
                    default:
                        $payment_data['unpaid'] = $row->total;
                        break;
                }
            }
        }

        // Pass payment data to view
        $this->data['total_paid_orders'] = $payment_data['paid'];
        $this->data['total_partial_paid'] = $payment_data['partial'];
        $this->data['total_unpaid_orders'] = $payment_data['unpaid'];

        // Log unexpected zero totals for debugging
        foreach (['total_products','total_paid_orders','total_users','total_stores'] as $k) {
            if (!isset($this->data[$k]) || $this->data[$k] === 0) {
                log_message('error', "Dashboard: {$k} is zero or missing. Value: " . var_export($this->data[$k] ?? null, true));
            }
        }

        $this->render_template('dashboard', $this->data);
    }

    /**
     * Simple fallback counter using active database connection.
     * $conds can be associative array of where conditions.
     */
    private function fallbackCount($table, $conds = [])
    {
        $table = $this->db->escape_str($table);
        $this->db->reset_query();
        $this->db->from($table);
        if (!empty($conds) && is_array($conds)) {
            foreach ($conds as $col => $val) {
                $this->db->where($col, $val);
            }
        }
        $count = 0;
        try {
            $count = (int) $this->db->count_all_results();
        } catch (Exception $e) {
            log_message('error', "Dashboard fallbackCount DB error for table {$table}: " . $e->getMessage());
            $count = 0;
        }
        return $count;
    }
}