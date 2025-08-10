<?php
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery Note #<?php echo $order_data['bill_no']; ?></title>
</head>
<body>
    <div class="header">
        <h1>DELIVERY NOTE</h1>
        <div class="company-info">
            <h2><?php echo $company_info['company_name']; ?></h2>
            <p><?php echo $company_info['address']; ?></p>
            <p>Tel: <?php echo $company_info['phone']; ?></p>
        </div>
    </div>

    <div class="delivery-info">
        <div class="deliver-to">
            <h3>Deliver To:</h3>
            <p>Customer: <?php echo $order_data['customer_name']; ?></p>
            <p>Phone: <?php echo $order_data['customer_phone']; ?></p>
            <p>Date: <?php echo date('d/m/Y', strtotime($order_data['date_time'])); ?></p>
        </div>
        <div class="note-info">
            <p>Delivery Note #: <?php echo $order_data['bill_no']; ?></p>
            <p>Order Reference: <?php echo $order_data['bill_no']; ?></p>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Description</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders_items as $k => $v): ?>
            <tr>
                <td><?php echo $k+1; ?></td>
                <td><?php echo $v['product_name']; ?></td>
                <td><?php echo $v['qty']; ?></td>
                <td><?php echo $v['unit']; ?></td>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Delivered By: _________________</p>
            <p>Date: _________________</p>
        </div>
        <div class="signature-box">
            <p>Received By: _________________</p>
            <p>Date: _________________</p>