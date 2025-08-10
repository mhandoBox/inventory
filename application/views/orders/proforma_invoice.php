<?php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proforma Invoice #<?php echo isset($order_data['bill_no']) ? $order_data['bill_no'] : ''; ?></title>
    <style>
        @page {
            margin: 0;
            size: A4;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20mm;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-info {
            margin-bottom: 30px;
        }
        .customer-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .bill-to, .invoice-info {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            width: 40%;
            margin-left: auto;
        }
        .terms {
            margin-top: 40px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PROFORMA INVOICE</h1>
        <div class="company-info">
            <h2><?php echo isset($company_info['company_name']) ? $company_info['company_name'] : ''; ?></h2>
            <p><?php echo isset($company_info['address']) ? $company_info['address'] : ''; ?></p>
            <p>Tel: <?php echo isset($company_info['phone']) ? $company_info['phone'] : ''; ?></p>
            <p>TIN: <?php echo isset($company_info['tin']) ? $company_info['tin'] : ''; ?></p>
        </div>
    </div>

    <div class="customer-info">
        <div class="bill-to">
            <h3>Bill To:</h3>
            <p>Customer: <?php echo $order_data['customer_name']; ?></p>
            <p>Phone: <?php echo $order_data['customer_phone']; ?></p>
            <p>Address: <?php echo $order_data['customer_address']; ?></p>
        </div>
        <div class="invoice-info">
            <p>Proforma #: <?php echo $order_data['bill_no']; ?></p>
            <p>Date: <?php echo date('d/m/Y', strtotime($order_data['date_time'])); ?></p>
            <p>Valid Until: <?php echo date('d/m/Y', strtotime('+30 days', strtotime($order_data['date_time']))); ?></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th class="text-right">Rate</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders_items as $k => $item): ?>
            <tr>
                <td><?php echo $k + 1; ?></td>
                <td><?php echo $item['product_name']; ?></td>
                <td><?php echo $item['qty']; ?></td>
                <td class="text-right"><?php echo number_format($item['rate'], 2); ?></td>
                <td class="text-right"><?php echo number_format($item['amount'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Subtotal:</td>
                <td class="text-right"><?php echo number_format($order_data['gross_amount'], 2); ?></td>
            </tr>
            <?php if ($order_data['service_charge'] > 0): ?>
            <tr>
                <td colspan="4" class="text-right">Service Charge (<?php echo $order_data['service_charge_rate']; ?>%):</td>
                <td class="text-right"><?php echo number_format($order_data['service_charge'], 2); ?></td>
            </tr>
            <?php endif; ?>
            <?php if ($order_data['vat_charge'] > 0): ?>
            <tr>
                <td colspan="4" class="text-right">VAT (<?php echo $order_data['vat_charge_rate']; ?>%):</td>
                <td class="text-right"><?php echo number_format($order_data['vat_charge'], 2); ?></td>
            </tr>
            <?php endif; ?>
            <?php if ($order_data['discount'] > 0): ?>
            <tr>
                <td colspan="4" class="text-right">Discount:</td>
                <td class="text-right"><?php echo number_format($order_data['discount'], 2); ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
                <td class="text-right"><strong><?php echo number_format($order_data['net_amount'], 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="terms">
        <h3>Terms and Conditions:</h3>
        <ol>
            <li>This is a proforma invoice and not a tax invoice.</li>
            <li>Prices quoted are valid for 30 days from the date of this proforma.</li>
            <li>Payment terms: 50% advance payment required to confirm order.</li>
            <li>Delivery timeline: 7-14 working days after payment confirmation.</li>
            <li>Prices are inclusive of all taxes unless stated otherwise.</li>
        </ol>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <p><?php echo $company_info['message']; ?></p>
        <p>This is a computer generated document.</p>
    </div>

    <script>
        window.onload = function() {
            try {
                window.print();
                window.onafterprint = function() {
                    window.close();
                };
            } catch (e) {
                console.error('Print error:', e);
                alert('Error printing. Please try again.');
            }
        };
    </script>
</body>
</html>