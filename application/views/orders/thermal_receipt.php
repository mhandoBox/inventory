<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #<?php echo $order_data['bill_no']; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <style>
        @page {
            margin: 0;
            /* Standard thermal paper width - 58mm */
            width: 58mm;
        }
        @media print {
            * {
                margin: 0;
                padding: 0;
                /* Thermal printer safe font */
                font-family: 'Courier', monospace;
                font-size: 8pt;
                line-height: 1.1;
            }
            body {
                width: 58mm; /* Standard thermal paper width */
            }
            
            .receipt {
                width: 48mm; /* Account for margins */
                padding: 0 5mm;
            }
            
            .header-columns {
                display: flex;
                justify-content: space-between;
                margin-bottom: 2mm;
            }
            
            .header-left, .header-right {
                width: 48%;
            }
            
            .header-right {
                text-align: right;
            }
            
            .company-header {
                text-align: center;
                margin-bottom: 2mm;
            }
            
            .company-name {
                font-size: 10pt;
                font-weight: bold;
                margin-bottom: 1mm;
            }
            
            .company-info {
                font-size: 8pt;
                line-height: 1.2;
                margin-bottom: 1mm;
            }
            
            .barcode-container {
                text-align: center;
                margin: 2mm 0;
                padding: 1mm 0;
                border-top: 1px dotted #000;
                border-bottom: 1px dotted #000;
            }
            
            .barcode-container svg {
                max-width: 40mm;
                height: 10mm;
            }
            
            .receipt-no {
                text-align: center;
                font-size: 9pt;
                font-weight: bold;
                margin: 1mm 0;
            }
            
            .barcode-number {
                text-align: center;
                font-size: 7pt;
                margin-top: 1mm;
            }
            
            .receipt-header {
                text-align: center;
                margin-bottom: 2mm;
            }
            
            .receipt-header .company-name {
                font-size: 10pt;
                font-weight: bold;
            }
            
            .receipt-info {
                font-size: 8pt;
                margin: 1mm 0;
                display: flex;
                justify-content: space-between;
            }
            
            .receipt-info .left-col,
            .receipt-info .right-col {
                width: 48%;
            }
            
            .receipt-item {
                margin: 0.5mm 0;
                display: flex;
                justify-content: space-between;
            }
            
            .item-name {
                width: 24mm; /* Narrower for thermal paper */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .item-details {
                width: 24mm;
                text-align: right;
            }
            
            .divider {
                border-top: 1px dotted #000;
                margin: 1mm 0;
            }
            
            .totals {
                margin: 1mm 0;
                font-size: 8pt;
            }
            
            .totals div {
                display: flex;
                justify-content: space-between;
                margin: 0.5mm 0;
            }
            
            .footer {
                text-align: center;
                margin-top: 2mm;
                font-size: 7pt;
            }
            
            .bold { font-weight: bold; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <!-- Company Header -->
        <div class="company-header">
            <div class="company-name"><?php echo $company_info['company_name']; ?></div>
            <div class="company-info">
                <?php echo $company_info['address']; ?><br>
                Tel: <?php echo $company_info['phone']; ?><br>
                TIN: <?php echo $company_info['tin']; ?>
            </div>
        </div>
<div class="divider"></div>
        <!-- Receipt Info -->
        <div class="receipt-info">
            <div class="left-col">
                
                Customer: <?php echo $order_data['customer_name']; ?>
                Served By: <?php echo $order_data['clerk_name']; ?>
            </div>
            <div class="right-col">
                Receipt: <?php echo $order_data['bill_no']; ?><br>
                <?php 
                    $date = new DateTime($order_data['date_time']);
                    echo $date->format('d/m/y H:i'); 
                ?><br>
                
            </div>
        </div>

        <div class="divider"></div>

        <?php foreach ($orders_items as $item): ?>
        <div class="receipt-item">
            <span class="item-name"><?php echo $item['product_name']; ?></span>
            <span class="item-details">
                <?php echo $item['qty']; ?>x<?php echo number_format($item['rate'], 2); ?>
                <?php echo number_format($item['amount'], 2); ?>
            </span>
        </div>
        <?php endforeach; ?>

        <div class="divider"></div>

        <div class="totals">
            <div><span>Subtotal:</span><span><?php echo number_format($order_data['gross_amount'], 2); ?></span></div>
            <?php if ($order_data['service_charge'] > 0): ?>
            <div><span>Svc(<?php echo $order_data['service_charge_rate']; ?>%):</span><span><?php echo number_format($order_data['service_charge'], 2); ?></span></div>
            <?php endif; ?>
            <?php if ($order_data['vat_charge'] > 0): ?>
            <div><span>VAT(<?php echo $order_data['vat_charge_rate']; ?>%):</span><span><?php echo number_format($order_data['vat_charge'], 2); ?></span></div>
            <?php endif; ?>
            <?php if ($order_data['discount'] > 0): ?>
            <div><span>Disc:</span><span>-<?php echo number_format($order_data['discount'], 2); ?></span></div>
            <?php endif; ?>
            <div class="bold"><span>Total:</span><span><?php echo number_format($order_data['net_amount'], 2); ?></span></div>
            <?php if ($order_data['paid_status'] == 3): ?>
            <div><span>Paid:</span><span><?php echo number_format($order_data['amount_paid'], 2); ?></span></div>
            <div class="bold"><span>Balance:</span><span><?php echo number_format($order_data['net_amount'] - $order_data['amount_paid'], 2); ?></span></div>
            <?php endif; ?>
        </div>

        <div class="divider"></div>

        <div class="footer">
            <div><?php echo $company_info['message']; ?></div>
            <div>Thank you!</div>
            <div><?php 
                $now = new DateTime('now', new DateTimeZone('Africa/Nairobi'));
                echo $now->format('d/m/y H:i'); 
            ?></div>
        </div>

        <!-- Barcode -->
        <div class="barcode-container">
            <svg id="barcode"></svg>
        </div>
    </div>

    <script>
        function detectPrinter() {
            if (typeof Android !== 'undefined' && Android.getPrinter) {
                // Android POS printer available
                return 'android';
            } else if (typeof window.webkit !== 'undefined' && window.webkit.messageHandlers) {
                // iOS device
                return 'ios';
            } else {
                // Regular web browser
                return 'web';
            }
        }

        function printReceipt() {
            var printerType = detectPrinter();
            
            // Generate barcode first
            JsBarcode("#barcode", "<?php echo $order_data['bill_no']; ?>", {
                format: "CODE128",
                width: 1.5,
                height: 30,
                displayValue: false,
                margin: 0,
                background: "#ffffff"
            });
            
            switch(printerType) {
                case 'android':
                    // Get receipt content
                    var receiptContent = document.querySelector('.receipt').innerHTML;
                    // Call Android bridge
                    Android.printReceipt(receiptContent);
                    break;
                    
                case 'ios':
                    // iOS handling if needed
                    window.webkit.messageHandlers.printReceipt.postMessage(receiptContent);
                    break;
                    
                default:
                    // Regular browser printing
                    try {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        };
                    } catch (e) {
                        console.error('Print error:', e);
                        window.opener && window.opener.postMessage('print_error', '*');
                        alert('Error printing receipt. Please try again.');
                    }
                    break;
            }
        }

        window.onload = function() {
            printReceipt();
        };
    </script>
</body>
</html>