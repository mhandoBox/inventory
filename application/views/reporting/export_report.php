<?php
require_once 'header.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';
$format = isset($_GET['format']) ? $_GET['format'] : '';
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';

require_once 'application/models/Model_reporting.php';
$controller = new Model_reporting();

$data = [];
$filename = '';
$headers = [];

if ($type === 'purchase') {
    $data = $controller->getPurchaseReport(0, 1000000, $date_from, $date_to);
    $filename = 'purchase_report_' . date('Ymd') . '.' . $format;
    $headers = ['Date', 'Product', 'Quantity', 'Unit Cost', 'Total Cost'];
} elseif ($type === 'sales') {
    $data = $controller->getSalesReport(0, 1000000, $date_from, $date_to);
    $filename = 'sales_report_' . date('Ymd') . '.' . $format;
    $headers = ['Date', 'Product', 'Quantity', 'Unit Price', 'Total Revenue'];
}

if ($format === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    $output = fopen('php://output', 'w');
    fputcsv($output, $headers);
    foreach ($data as $row) {
        fputcsv($output, [
            $row['date'],
            $row['product_name'],
            $row['quantity'],
            $type === 'purchase' ? $row['unit_cost'] : $row['unit_price'],
            $type === 'purchase' ? $row['total_cost'] : $row['total_revenue']
        ]);
    }
    fclose($output);
} elseif ($format === 'excel') {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    echo "Excel export requires PhpSpreadsheet library.";
} elseif ($format === 'pdf') {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    echo "PDF export requires TCPDF library.";
}

exit;
?>