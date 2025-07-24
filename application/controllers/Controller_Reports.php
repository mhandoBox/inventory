<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Reports extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Advanced Reports';
        $this->load->model('Model_reporting');
        $this->load->model('model_users');
        $this->load->model('model_products');
        $this->load->model('model_company');
        log_message('debug', 'Controller_Reports initialized');
    }

    // Dashboard landing page for reports
    public function index()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to reports');
            redirect('dashboard', 'refresh');
        }
        $this->data['tab'] = 'orders';
        $this->render_template('reporting/index', $this->data);
    }

    // Sales Report
    public function sales_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to sales reports');
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'customer' => $this->input->get('customer'),
            'status' => $this->input->get('status')
        );

        $report = $this->Model_reporting->getSalesReport($filters);
        $aggregates = $this->Model_reporting->getSalesAggregates($filters);
        $customers = $this->Model_reporting->getCustomerList();

        $this->data['report'] = $report;
        $this->data['aggregates'] = $aggregates;
        $this->data['filters'] = $filters;
        $this->data['customers'] = $customers;
        $this->data['tab'] = 'orders';

        $this->render_template('reporting/sales_report', $this->data);
    }

    // Purchases/Stock Additions Report
    public function purchase_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to purchase reports');
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'product' => $this->input->get('product'),
        );

        $report = $this->Model_reporting->getPurchaseReport($filters);
        $products = $this->Model_reporting->getProductList();

        $this->data['report'] = $report['report'];
        $this->data['summary'] = $report['summary'];
        $this->data['filters'] = $filters;
        $this->data['products'] = $report['products'];
        $this->data['tab'] = 'purchases';

        $this->render_template('reporting/purchase_report', $this->data);
    }

    // Expense Report
    public function expense_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to expense reports');
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'category' => $this->input->get('category')
        );

        $report = $this->Model_reporting->getExpenseReport($filters);
        $aggregates = $this->Model_reporting->getExpenseAggregates($filters);

        $this->data['report'] = $report;
        $this->data['aggregates'] = $aggregates;
        $this->data['filters'] = $filters;
        $this->data['tab'] = 'expenses';

        $this->render_template('reporting/expense_report', $this->data);
    }

    // General (Profit/Turnover) Report
    public function general_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to general reports');
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
        );

        $general = $this->Model_reporting->getGeneralReport($filters);
        $this->data['general'] = $general;
        $this->data['filters'] = $filters;
        $this->data['tab'] = 'general';

        $this->render_template('reporting/general_report', $this->data);
    }

    // Export functionality (CSV, Excel, PDF)
    public function export($type = 'sales', $format = 'csv')
    {
        if (!in_array('viewReport', $this->permission)) {
            show_error('Unauthorized', 403);
        }

        $filters = $this->input->get();
        $filename = $type . '_report_' . date('Ymd_His');

        switch ($type) {
            case 'sales':
                $data = $this->Model_reporting->getSalesReport($filters);
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

    // AJAX endpoint for chart data
    public function chart_data($type = 'sales')
    {
        if (!in_array('viewReport', $this->permission)) {
            show_error('Unauthorized', 403);
        }
        $filters = $this->input->get();
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
                $data = array();
        }
        echo json_encode($data);
    }
}
?>