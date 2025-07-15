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
    }

    // Dashboard landing page for reports
    public function index()
    {
        if (!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->data['tab'] = 'orders';
        $this->render_template('reporting/index', $this->data);
    }

    // Orders (Sales) Report
    public function sales_report()
    {
        if (!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        // Filters
        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'customer' => $this->input->get('customer'),
            'status' => $this->input->get('status')
        );

        // Data
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
            redirect('dashboard', 'refresh');
        }

        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'product' => $this->input->get('product'),
        );

        $report = $this->Model_reporting->getPurchaseReport($filters);
        $summary = $this->Model_reporting->getStockMovementSummary($filters);
        $products = $this->Model_reporting->getProductList();

        $this->data['report'] = $report;
        $this->data['summary'] = $summary;
        $this->data['filters'] = $filters;
        $this->data['products'] = $products;
        $this->data['tab'] = 'purchases';

        $this->render_template('reporting/purchase_report', $this->data);
    }

    // General (Profit/Turnover) Report
    public function general_report()
    {
        if (!in_array('viewReport', $this->permission)) {
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
                $data = $this->Model_reporting->getPurchaseReport($filters);
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
                fputcsv($out, array_keys(reset($data)));
                foreach ($data as $row) {
                    fputcsv($out, $row);
                }
            }
            fclose($out);
            exit;
        } elseif ($format == 'excel') {
            // Simple Excel export (CSV with .xls extension)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            $out = fopen('php://output', 'w');
            if (!empty($data) && is_array($data)) {
                fputcsv($out, array_keys(reset($data)));
                foreach ($data as $row) {
                    fputcsv($out, $row);
                }
            }
            fclose($out);
            exit;
        } elseif ($format == 'pdf') {
            // PDF export (requires dompdf or similar library)
            // For now, output HTML for print-to-PDF
            echo '<html><head><title>' . ucfirst($type) . ' Report</title>';
            echo '<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #000; padding: 8px; } .items-table { margin-left: 20px; font-size: 90%; }</style>';
            echo '</head><body>';
            echo '<h2>' . ucfirst($type) . ' Report</h2>';
            echo '<p>Generated on: ' . date('Y-m-d H:i:s') . '</p>';
            if ($type == 'sales') {
                echo '<p>Period: ' . (isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : 'N/A') . ' to ' . 
                     (isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : 'N/A') . '</p>';
            }
            echo '<table>';
            if (!empty($data) && is_array($data)) {
                echo '<tr>';
                foreach (array_keys(reset($data)) as $col) {
                    if ($col !== 'items') { // Exclude items column for main table
                        echo '<th>' . htmlspecialchars($col) . '</th>';
                    }
                }
                echo '</tr>';
                foreach ($data as $row) {
                    echo '<tr>';
                    foreach ($row as $key => $cell) {
                        if ($key !== 'items') {
                            echo '<td>' . htmlspecialchars($cell) . '</td>';
                        }
                    }
                    echo '</tr>';
                    // Add items table for sales report
                    if ($type == 'sales' && !empty($row['items'])) {
                        echo '<tr><td colspan="' . (count(array_keys($row)) - 1) . '">';
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

    // (Optional) AJAX endpoint for chart data
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
            default:
                $data = array();
        }
        echo json_encode($data);
    }
}
?>