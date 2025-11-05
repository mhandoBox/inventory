<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Reports extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Advanced Reports';
        
        // Load required models (load with aliases and keep original-style property for compatibility)
        $this->load->model('Model_reporting', 'model_reporting');
        // also keep the old-style property name used elsewhere
        $this->Model_reporting = $this->model_reporting;
        $this->load->model('model_users');
        $this->load->model('Model_products');
        $this->load->model('model_company');
        $this->load->model('Model_warehouse', 'model_warehouse'); // Add alias as second parameter

        // expose permissions to views that expect $user_permission / similar
        $this->data['user_permission'] = $this->permission;
        $this->data['permission'] = $this->permission;
        
        log_message('debug', 'Controller_Reports initialized');
    }

    public function index()
    {
        // Accept either legacy 'viewReports' or current 'viewReport' to avoid redirect issues
        if (!in_array('viewReport', $this->permission) && !in_array('viewReports', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to reports');
            redirect('dashboard', 'refresh');
        }
        $this->data['tab'] = 'orders';
        $this->render_template('reporting/index', $this->data);
    }

    public function sales_report()
    {
        // prepare filters (keep same defaults you used)
        $this->data['filters'] = [
            'date_from' => $this->input->get('date_from') ?? date('Y-m-d', strtotime('-30 days')),
            'date_to'   => $this->input->get('date_to')   ?? date('Y-m-d'),
            'warehouse' => $this->input->get('warehouse'),
            'status'    => $this->input->get('status') // Remove default '1,2'
        ];

        // Load warehouses for dropdown
        $this->load->model('Model_stores');
        $this->data['warehouses'] = $this->Model_stores->getActiveStores();

        // Fetch sales rows (try both possible model property names)
        $sales_data = array();
        try {
            if (isset($this->model_reporting) && method_exists($this->model_reporting, 'getSalesReport')) {
                $sales_data = $this->model_reporting->getSalesReport($this->data['filters'] ?? array());
            } elseif (isset($this->Model_reporting) && method_exists($this->Model_reporting, 'getSalesReport')) {
                $sales_data = $this->Model_reporting->getSalesReport($this->data['filters'] ?? array());
            }
        } catch (Throwable $e) {
            log_message('error', 'sales_report model error: ' . $e->getMessage());
            $sales_data = array();
        }

        // Ensure view variables are set
        $this->data['report'] = is_array($sales_data) ? $sales_data : array();
        // Always provide a safe JSON payload for console logging in the view
        $this->data['debug_sales_json'] = json_encode($this->data['report'], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);

        // Debug log for server-side confirmation
        log_message('debug', 'Controller_Reports::sales_report rows fetched: ' . count($this->data['report']));

        // Render using controller data (important)
        $this->render_template('reporting/sales_report', $this->data);
    }

    public function stock_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to stock reports');
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'category' => $this->input->get('category'),
            'warehouse' => $this->input->get('warehouse'),
            'stock_status' => $this->input->get('stock_status'),
            'limit' => $this->input->get('limit') ? (int)$this->input->get('limit') : 10,
            'offset' => $this->input->get('offset') ? (int)$this->input->get('offset') : 0
        );

        $this->load->model('Model_category');
        $this->load->model('Model_stores');
        
        $this->data['categories'] = $this->Model_category->getActiveCategories();
        $this->data['warehouses'] = $this->Model_stores->getActiveStores();
        
        log_message('debug', '=== Stock Report Debug ===');
        log_message('debug', 'Filters being applied: ' . json_encode($filters));
        
        try {
            $limit = isset($filters['limit']) ? (int)$filters['limit'] : 10;
            $offset = isset($filters['offset']) ? (int)$filters['offset'] : 0;
            
            log_message('debug', 'Calling getStockReport with params: ' . json_encode([
                'limit' => $limit,
                'offset' => $offset,
                'filters' => $filters
            ]));
            
            $report_data = $this->Model_reporting->getStockReport($limit, $offset, $filters);
            $aggregates = $this->Model_reporting->getStockAggregates($filters);
            
        } catch (Exception $e) {
            log_message('error', 'Error in stock_report: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Error generating stock report. Please try again.');
            $report_data = ['data' => [], 'total_items' => 0, 'limit' => $limit, 'offset' => $offset];
            $aggregates = [
                'total_items' => 0,
                'total_value' => 0,
                'total_purchase_value' => 0,
                'low_stock_items' => 0,
                'out_of_stock_items' => 0
            ];
        }
        
        log_message('debug', 'Report data retrieved: ' . json_encode([
            'has_data' => !empty($report_data['data']),
            'record_count' => count($report_data['data'] ?? []),
            'total_items' => $report_data['total_items'] ?? 0,
            'aggregates' => $aggregates
        ]));
        
        if (isset($report_data['data']) && is_array($report_data['data'])) {
            foreach ($report_data['data'] as $key => $row) {
                $report_data['data'][$key] = array_merge([
                    'id' => '',
                    'name' => '',
                    'price' => '0.00',
                    'unit' => '',
                    'quantity' => 0,
                    'total_purchased' => 0,
                    'total_sold' => 0,
                    'category_name' => '',
                    'warehouse_name' => '',
                    'total_purchase_value' => 0,
                    'store_id' => ''
                ], $row);
            }
        } else {
            $report_data['data'] = [];
        }
        
        $this->data['report'] = $report_data;
        $this->data['aggregates'] = $aggregates;
        $this->data['filters'] = $filters;
        $this->data['tab'] = 'stock';
        
        log_message('debug', 'Data being sent to view: ' . json_encode([
            'stock_count' => count($report_data['data']),
            'aggregate_keys' => array_keys($aggregates ?? [])
        ]));
        
        $this->render_template('reporting/stock_report', $this->data);
    }

    public function general_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to general reports');
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'date_from' => $this->input->get('date_from') ?: $this->Model_reporting->getEarliestOrderDate(),
            'date_to' => $this->input->get('date_to') ?: date('Y-m-d'),
            'warehouse' => $this->input->get('warehouse') ?: ''
        );

        try {
            $general = $this->Model_reporting->getGeneralReport($filters);
        } catch (Exception $e) {
            log_message('error', 'Error in general_report: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Error generating general report. Please try again.');
            $general = [
                'sales' => ['total_orders' => 0, 'total_amount' => 0],
                'purchases' => ['total_purchases' => 0, 'total_amount' => 0],
                'expenses' => ['total_expenses' => 0, 'total_amount' => 0],
                'products' => ['total_products' => 0],
                'profit' => 0
            ];
        }

        $this->data['general'] = $general;
        $this->data['filters'] = $filters;
        $this->data['tab'] = 'general';

        $this->render_template('reporting/general_report', $this->data);
    }

    public function export($type = 'sales', $format = 'csv')
    {
        if (!in_array('viewReport', $this->permission)) {
            show_error('Unauthorized', 403);
        }

        $filters = $this->input->get();
        $filename = $type . '_report_' . date('Ymd_His');

        try {
            switch ($type) {
                case 'sales':
                    $data = $this->Model_reporting->getSalesReport($filters)['individual_sales'];
                    break;
                case 'purchases':
                    $data = $this->Model_reporting->getPurchaseReport($filters)['report'];
                    break;
                case 'expenses':
                    $data = $this->Model_reporting->getExpenseReport($filters);
                    break;
                case 'general':
                    $data = $this->Model_reporting->getGeneralReport($filters);
                    break;
                default:
                    show_error('Invalid report type', 400);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in export (' . $type . '): ' . $e->getMessage());
            show_error('Error generating export', 500);
        }

        if ($format == 'csv') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
            $out = fopen('php://output', 'w');
            if (!empty($data) && is_array($data)) {
                $keys = array_keys(reset($data));
                if ($type === 'sales') {
                    $keys = array_filter($keys, function($key) { return $key !== 'items'; });
                }
                fputcsv($out, $keys);
                foreach ($data as $row) {
                    $row_data = array();
                    foreach ($keys as $key) {
                        $row_data[] = isset($row[$key]) ? $row[$key] : '';
                    }
                    fputcsv($out, $row_data);
                }
            }
            fclose($out);
            exit;
        } elseif ($format == 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            $out = fopen('php://output', 'w');
            if (!empty($data) && is_array($data)) {
                $keys = array_keys(reset($data));
                if ($type === 'sales') {
                    $keys = array_filter($keys, function($key) { return $key !== 'items'; });
                }
                fputcsv($out, $keys);
                foreach ($data as $row) {
                    $row_data = array();
                    foreach ($keys as $key) {
                        $row_data[] = isset($row[$key]) ? $row[$key] : '';
                    }
                    fputcsv($out, $row_data);
                }
            }
            fclose($out);
            exit;
        } elseif ($format == 'pdf') {
            echo '<html><head><title>' . ucfirst($type) . ' Report</title>';
            echo '<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #000; padding: 8px; } .items-table { margin-left: 20px; font-size: 90%; }</style>';
            echo '</head><body>';
            echo '<h2>' . ucfirst($type) . ' Report</h2>';
            echo '<p>Generated on: ' . date('Y-m-d H:i:s') . '</p>';
            if ($type == 'sales' || $type == 'expenses') {
                echo '<p>Period: ' . (isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : 'N/A') . ' to ' . 
                     (isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : 'N/A') . '</p>';
            }
            echo '<table>';
            if (!empty($data) && is_array($data)) {
                $keys = array_keys(reset($data));
                if ($type === 'sales') {
                    $keys = array_filter($keys, function($key) { return $key !== 'items'; });
                }
                echo '<tr>';
                foreach ($keys as $col) {
                    echo '<th>' . htmlspecialchars($col) . '</th>';
                }
                echo '</tr>';
                foreach ($data as $row) {
                    echo '<tr>';
                    foreach ($keys as $key) {
                        echo '<td>' . htmlspecialchars($row[$key] ?? '') . '</td>';
                    }
                    echo '</tr>';
                    if ($type == 'sales' && !empty($row['items'])) {
                        echo '<tr><td colspan="' . count($keys) . '">';
                        echo '<table class="items-table">';
                        echo '<tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr>';
                        foreach ($row['items'] as $item) {
                            echo '<tr>';
                            echo '<td>' . (isset($item['name']) ? htmlspecialchars($item['name']) : 'N/A') . '</td>';
                            echo '<td>' . (isset($item['quantity']) ? number_format($item['quantity'], 2) : '0.00') . '</td>';
                            echo '<td>' . (isset($item['unit_price']) ? number_format($item['unit_price'], 2) : '0.00') . '</td>';
                            echo '<td>' . (isset($item['total']) ? number_format($item['total'], 2) : '0.00') . '</td>';
                            echo '</tr>';
                        }
                        echo '</table></td></tr>';
                    }
                }
            }
            echo '</table></body></html>';
            exit;
        } else {
            show_error('Invalid export format', 400);
        }
    }

    public function chart_data($type = 'sales')
    {
        if (!in_array('viewReport', $this->permission)) {
            show_error('Unauthorized', 403);
        }
        $filters = $this->input->get();
        try {
            switch ($type) {
                case 'sales':
                    $data = $this->Model_reporting->getSalesChartData($filters);
                    break;
                case 'purchases':
                    $data = $this->Model_reporting->getPurchaseChartData($filters);
                    break;
                case 'expenses':
                    $data = $this->Model_reporting->getExpenseChartData($filters);
                    break;
                default:
                    $data = [];
            }
        } catch (Exception $e) {
            log_message('error', 'Error in chart_data (' . $type . '): ' . $e->getMessage());
            $data = [];
        }
        echo json_encode($data);
    }

    public function purchase_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to purchase reports');
            redirect('dashboard', 'refresh');
        }

        // Set default filters
        $filters = array(
            'date_from' => $this->input->get('date_from') ?: date('Y-m-d', strtotime('-30 days')),
            'date_to' => $this->input->get('date_to') ?: date('Y-m-d'),
            'product' => $this->input->get('product') ?: '',
            'status' => $this->input->get('status') ?: '',
            'period' => $this->input->get('period') ?: 'last_30_days'
        );

        // Update date range based on period if selected
        if (!empty($filters['period'])) {
            switch($filters['period']) {
                case 'today':
                    $filters['date_from'] = date('Y-m-d');
                    $filters['date_to'] = date('Y-m-d');
                    break;
                case 'this_week':
                    $filters['date_from'] = date('Y-m-d', strtotime('monday this week'));
                    $filters['date_to'] = date('Y-m-d', strtotime('sunday this week'));
                    break;
                case 'this_month':
                    $filters['date_from'] = date('Y-m-01');
                    $filters['date_to'] = date('Y-m-t');
                    break;
                case 'last_30_days':
                    $filters['date_from'] = date('Y-m-d', strtotime('-30 days'));
                    $filters['date_to'] = date('Y-m-d');
                    break;
            }
        }

        // Debug log the filters
        log_message('debug', 'Purchase report filters: ' . json_encode($filters));

        try {
            // Direct debug output
            echo "<!-- Debug Output Start -->\n";
            echo "<pre style='display:none'>\n";
            echo "Filters: " . print_r($filters, true) . "\n";
            
            // Check database connection
            $db_connected = $this->db->initialize();
            echo "Database connected: " . ($db_connected ? 'Yes' : 'No') . "\n";
            
            // Check table structure
            $fields = $this->db->list_fields('purchases');
            echo "Table fields: " . print_r($fields, true) . "\n";
            
            // Get record count
            $this->db->select('COUNT(*) as count');
            $this->db->from('purchases');
            $total_count = $this->db->get()->row()->count;
            echo "Total records: " . $total_count . "\n";
            
            // Get sample data
            if ($total_count > 0) {
                $this->db->limit(1);
                $sample = $this->db->get('purchases')->row_array();
                echo "Sample record: " . print_r($sample, true) . "\n";
            }
            
            // Get report data
            $report = $this->Model_reporting->getPurchaseReport($filters);
            echo "Report data: " . print_r($report, true) . "\n";
            
            // Log to file
            $log_file = APPPATH . 'logs/purchase_report_' . date('Y-m-d') . '.log';
            file_put_contents($log_file, print_r([
                'time' => date('Y-m-d H:i:s'),
                'filters' => $filters,
                'record_count' => $total_count,
                'sample' => $sample ?? null,
                'report' => $report
            ], true), FILE_APPEND);
            
            echo "</pre>\n";
            echo "<!-- Debug Output End -->\n";
            
            // Debug database connection
            log_message('debug', '=== Purchase Report Debug Start ===');
            log_message('debug', 'Database connected: ' . ($this->db->conn_id ? 'Yes' : 'No'));

            // Check purchases table structure
            $fields = $this->db->list_fields('purchases');
            log_message('debug', 'Purchases table fields: ' . json_encode($fields));

            // Get total records
            $this->db->select('COUNT(*) as count');
            $this->db->from('purchases');
            $total_purchases = $this->db->get()->row()->count;
            log_message('debug', 'Total purchases in database: ' . $total_purchases);

            // Get sample record
            if ($total_purchases > 0) {
                $this->db->limit(1);
                $sample = $this->db->get('purchases')->row_array();
                log_message('debug', 'Sample purchase record: ' . json_encode($sample));
            }
            
            // Get date range stats
            $this->db->select('MIN(purchase_date) as earliest, MAX(purchase_date) as latest');
            $this->db->from('purchases');
            $date_range = $this->db->get()->row_array();
            log_message('debug', 'Purchase date range: ' . json_encode($date_range));

            // Debug filters
            log_message('debug', 'Applied filters: ' . json_encode($filters));

            // Enable query logging
            $this->db->save_queries = TRUE;

            // Get report data
            $report = $this->Model_reporting->getPurchaseReport($filters);
            
            // Log the executed query
            log_message('debug', 'Last executed query: ' . $this->db->last_query());
            
            // Debug report data structure
            log_message('debug', 'Report structure: ' . json_encode([
                'has_data' => !empty($report['report']),
                'record_count' => count($report['report'] ?? []),
                'first_record' => !empty($report['report']) ? reset($report['report']) : null,
                'summary' => $report['summary'] ?? []
            ]));

            // Debug products data
            $products = $this->Model_products->getActiveProductData();
            log_message('debug', 'Active products count: ' . count($products));

            // Prepare view data
            $this->data['report'] = $report['report'] ?? [];
            $this->data['summary'] = $report['summary'] ?? [
                'total_purchases' => 0,
                'total_amount' => 0,
                'total_paid' => 0,
                'pending_amount' => 0
            ];
            $this->data['filters'] = $filters;
            $this->data['products'] = $products;
            $this->data['page_title'] = 'Purchase Report';
            $this->data['tab'] = 'purchases';

            // Debug view data
            log_message('debug', 'View data structure: ' . json_encode([
                'report_count' => count($this->data['report']),
                'has_summary' => !empty($this->data['summary']),
                'product_count' => count($this->data['products']),
                'applied_filters' => $this->data['filters']
            ]));

            log_message('debug', '=== Purchase Report Debug End ===');

            // Render the view
            $this->render_template('reporting/purchase_report', $this->data);

        } catch (Exception $e) {
            log_message('error', 'Error in purchase_report: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            $this->session->set_flashdata('error', 'Error generating purchase report');
            redirect('dashboard');
        }
    }

    /**
     * Format phone number for display
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber($phone) 
    {
        // Remove any non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Format based on length
        $length = strlen($phone);
        if ($length == 10) {
            // Format as: (XXX) XXX-XXXX
            return sprintf("(%s) %s-%s",
                substr($phone, 0, 3),
                substr($phone, 3, 3),
                substr($phone, 6)
            );
        } elseif ($length == 11 && substr($phone, 0, 1) == '1') {
            // Format as: +1 (XXX) XXX-XXXX
            return sprintf("+1 (%s) %s-%s",
                substr($phone, 1, 3),
                substr($phone, 4, 3),
                substr($phone, 7)
            );
        }
        
        // Return original if not standard format
        return $phone;
    }

    // AJAX endpoint used by DataTable
    public function stock_report_data()
    {
        // ensure model available
        $this->load->model('Model_reporting', 'model_reporting');

        // deny if no permission
        if (!in_array('viewReport', $this->permission)) {
            $this->output
                 ->set_status_header(403)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['data'=>[], 'error'=>'Access denied']));
            return;
        }

        // accept POST or GET
        $date_from    = $this->input->post('date_from') ?? $this->input->get('date_from');
        $date_to      = $this->input->post('date_to')   ?? $this->input->get('date_to');
        $category     = $this->input->post('category')  ?? $this->input->get('category');
        $warehouse    = $this->input->post('warehouse') ?? $this->input->get('warehouse');
        $stock_status = $this->input->post('stock_status') ?? $this->input->get('stock_status');

        $limit  = $this->input->post('limit')  ?? $this->input->get('limit');
        $offset = $this->input->post('offset') ?? $this->input->get('offset');
        $limit  = is_numeric($limit) ? (int)$limit : 0;
        $offset = is_numeric($offset) ? (int)$offset : 0;

        $filters = [
            'date_from'    => $date_from,
            'date_to'      => $date_to,
            'category'     => $category,
            'warehouse'    => $warehouse,
            'stock_status' => $stock_status
        ];

        try {
            $report = $this->model_reporting->getStockReport($limit, $offset, $filters);

            // normalize to DataTables-friendly structure
            if (!is_array($report) || !isset($report['data'])) {
                $report = ['data' => is_array($report) ? $report : [], 'total_items' => 0, 'limit' => $limit, 'offset' => $offset];
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($report));
        } catch (Throwable $e) {
            log_message('error', 'stock_report_data exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            $this->output
                 ->set_status_header(500)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['data'=>[], 'error' => 'Server error. Check logs.']));
        }
    }

    // AJAX endpoint for Sales report used by DataTables
    public function sales_report_data()
    {
        // load reporting model if available
        if (!isset($this->model_reporting)) {
            $this->load->model('Model_reporting', 'model_reporting');
        }

        // permission -- return 403 JSON if not allowed
        if (!in_array('viewReport', $this->permission)) {
            $this->output
                 ->set_status_header(403)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['data' => [], 'error' => 'Access denied']));
            return;
        }

        // accept POST or GET
        $date_from = $this->input->post('date_from') ?? $this->input->get('date_from');
        $date_to   = $this->input->post('date_to')   ?? $this->input->get('date_to');
        $warehouse = $this->input->post('warehouse') ?? $this->input->get('warehouse');
        $status    = $this->input->post('status') ?? $this->input->get('status');

        $filters = [
            'date_from' => $date_from,
            'date_to'   => $date_to,
            'warehouse' => $warehouse,
            'status'    => $status
        ];

        try {
            // If model provides a method to get sales report, use it.
            if (!empty($this->model_reporting) && method_exists($this->model_reporting, 'getSalesReport')) {
                $report = $this->model_reporting->getSalesReport(0, 0, $filters);
                // ensure standard shape
                if (is_array($report) && isset($report['data'])) {
                    $this->output->set_content_type('application/json')->set_output(json_encode($report));
                    return;
                }
            }

            // Fallback: return empty dataset (prevents 404 / DataTables ajax error)
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['data' => [], 'total_items' => 0, 'limit' => 0, 'offset' => 0]));
        } catch (Throwable $e) {
            log_message('error', 'sales_report_data exception: ' . $e->getMessage());
            $this->output
                 ->set_status_header(500)
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['data' => [], 'error' => 'Server error']));
        }
    }
}