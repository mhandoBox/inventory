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
        );

        // Data
        $report = $this->Model_reporting->getSalesReport($filters);
        // For each sale, fetch its items and convert status
        if (!empty($report) && is_array($report)) {
            foreach ($report as &$sale) {
                if (isset($sale['order_id'])) {
                    $sale['items'] = $this->Model_reporting->getSaleItems($sale['order_id']);
                } else {
                    $sale['items'] = array();
                }
                // Convert status to Paid/Unpaid
                if (isset($sale['status'])) {
                    $sale['status'] = ($sale['status'] == 1) ? 'Unpaid' : 'Paid';
                }
            }
            unset($sale);
        }
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
            echo '<html><head><title>' . ucfirst($type) . ' Report</title></head><body>';
            echo '<h2>' . ucfirst($type) . ' Report</h2>';
            echo '<table border="1" cellpadding="5" cellspacing="0">';
            if (!empty($data) && is_array($data)) {
                echo '<tr>';
                foreach (array_keys(reset($data)) as $col) {
                    echo '<th>' . htmlspecialchars($col) . '</th>';
                }
                echo '</tr>';
                foreach ($data as $row) {
                    echo '<tr>';
                    foreach ($row as $cell) {
                        echo '<td>' . htmlspecialchars($cell) . '</td>';
                    }
                    echo '</tr>';
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
