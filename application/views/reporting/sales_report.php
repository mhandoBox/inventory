<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Report
            <small>Sales Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
            <li class="active">Sales</li>
        </ol>
    </section>

    <style>
    .dataTables_wrapper { margin-top: 20px; }
    table.dataTable thead th { 
        background-color: #f4f4f4;
        font-weight: bold;
        text-align: center;
    }
    .text-right { text-align: right !important; }
    .btn-info { 
        margin: 2px;
        padding: 3px 8px;
    }
    .table-striped > tbody > tr:nth-child(odd) > td {
        background-color: #f9f9f9;
    }
    .table-bordered {
        border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border-bottom: 2px solid #ddd;
    }
    .modal-header {
        background-color: #f4f4f4;
        border-bottom: 1px solid #ddd;
    }
    .no-print { display: none; }
    .btn-group .btn.active { 
        background-color: #337ab7; 
        color: white; 
    }
    </style>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                    </div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                    </div>
                <?php endif; ?>

                <!-- Sales Summary Box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sales Summary</h3>
                        <div class="box-tools">
                            <form method="get" class="form-inline" id="filterForm" style="display: inline-block; margin-right: 10px;">
                                <input type="hidden" name="period" id="period_input" value="<?php echo isset($_GET['period']) ? htmlspecialchars($_GET['period']) : 'last_30_days'; ?>">
                                <input type="hidden" name="status" id="status_input" value="<?php echo isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '1,2'; ?>">
                                <div class="input-group input-group-sm" style="width: 150px; margin-right: 10px;">
                                    <input type="date" name="date_from" class="form-control" value="<?php echo isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : date('Y-m-d', strtotime('-30 days')); ?>">
                                </div>
                                <div class="input-group input-group-sm" style="width: 150px; margin-right: 10px;">
                                    <input type="date" name="date_to" class="form-control" value="<?php echo isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group" style="margin-right: 10px;">
                                    <label for="warehouse">Warehouse:</label>
                                    <select class="form-control input-sm" id="warehouse" name="warehouse">
                                        <option value="">All Warehouses</option>
                                        <?php 
                                        // Ensure $warehouses is properly populated from controller
                                        if (!empty($warehouses) && is_array($warehouses)): 
                                            foreach ($warehouses as $w): 
                                        ?>
                                            <option value="<?php echo htmlspecialchars($w['id']); ?>" 
                                                <?php echo (isset($_GET['warehouse']) && $_GET['warehouse'] == $w['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($w['name']); ?>
                                            </option>
                                        <?php 
                                            endforeach; 
                                        endif; 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-right: 10px;">
                                    <label for="status">Status:</label>
                                    <select class="form-control input-sm" id="status" name="status">
                                        <option value="">All Statuses</option>
                                        <option value="1,2" <?php echo (isset($_GET['status']) && $_GET['status'] == '1,2') ? 'selected' : ''; ?>>Paid/Partial</option>
                                        <option value="0" <?php echo (isset($_GET['status']) && $_GET['status'] == '0') ? 'selected' : ''; ?>>Unpaid</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                <a href="<?php echo base_url('Controller_Reports/sales_report'); ?>?period=last_30_days&status=1,2" class="btn btn-default btn-sm">Reset</a>
                            </form>
                        </div>
                    </div>

                    <!-- Metrics Cards -->
                    <div class="row" style="margin: 20px 0;">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Revenue</span>
                                    <span class="info-box-number"><?php echo isset($aggregates['total_revenue']) ? number_format($aggregates['total_revenue'], 2) : '0.00'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Orders</span>
                                    <span class="info-box-number"><?php echo isset($aggregates['total_orders']) ? number_format($aggregates['total_orders']) : '0'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-calculator"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Avg. Order Value</span>
                                    <span class="info-box-number"><?php echo isset($aggregates['avg_order_value']) && $aggregates['total_orders'] > 0 ? number_format($aggregates['avg_order_value'], 2) : '0.00'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-percent"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Payment Ratio</span>
                                    <span class="info-box-number"><?php echo isset($aggregates['payment_ratio']) ? number_format($aggregates['payment_ratio'], 2) . '%' : '0.00%'; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <div class="box-tools pull-right" style="margin-bottom: 15px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm quick-filter <?php echo (isset($_GET['period']) && $_GET['period'] === 'today') ? 'active' : ''; ?>" data-period="today">Today</button>
                                <button type="button" class="btn btn-default btn-sm quick-filter <?php echo isset($_GET['period']) && $_GET['period'] === 'this_week' ? 'active' : ''; ?>" data-period="this_week">This Week</button>
                                <button type="button" class="btn btn-default btn-sm quick-filter <?php echo isset($_GET['period']) && $_GET['period'] === 'this_month' ? 'active' : ''; ?>" data-period="this_month">This Month</button>
                                <button type="button" class="btn btn-default btn-sm quick-filter <?php echo isset($_GET['period']) && $_GET['period'] === 'this_quarter' ? 'active' : ''; ?>" data-period="this_quarter">This Quarter</button>
                                <button type="button" class="btn btn-default btn-sm quick-filter <?php echo (!isset($_GET['period']) || $_GET['period'] === 'last_30_days') ? 'active' : ''; ?>" data-period="last_30_days">Last 30 Days</button>
                            </div>
                        </div>

                        <!-- Unified Sales Table -->
                        <h4>Product Sales </h4>
                        <?php
                        // Build a single-product aggregation from $report (server-side)
                        $product_totals = [];
                        if (!empty($report) && is_array($report)) {
                            foreach ($report as $r) {
                                $pname = trim($r['product_name'] ?? ($r['name'] ?? 'Unknown'));
                                $qty = (int)($r['quantity'] ?? $r['qty'] ?? 0);
                                $amt = (float)preg_replace('/[^\d\.\-]/', '', ($r['amount'] ?? 0));
                                // accumulate
                                if (!isset($product_totals[$pname])) {
                                    $product_totals[$pname] = ['quantity' => 0, 'total' => 0.0];
                                }
                                $product_totals[$pname]['quantity'] += $qty;
                                $product_totals[$pname]['total'] += $amt;
                            }
                        }
                        // overall totals
                        $overall_qty = array_sum(array_column($product_totals, 'quantity'));
                        $overall_total = array_sum(array_column($product_totals, 'total'));
                        ?>

                        <div style="margin-bottom:8px; font-weight:600;">
                            Overall Total Sales: <span id="overallTotal"><?php echo number_format($overall_total, 2); ?></span>
                        </div>

                        <table class="table table-bordered table-striped" id="productSalesTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Product</th>
                                    <th class="text-right">Total Qty</th>
                                    <th class="text-right">Avg. Price</th>
                                    <th class="text-right">Total Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_totals)): ?>
                                    <?php $i = 0; foreach ($product_totals as $pname => $vals): $i++; 
                                        $avg_price = $vals['quantity'] > 0 ? ($vals['total'] / $vals['quantity']) : 0;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($pname); ?></td>
                                            <td class="text-right"><?php echo number_format($vals['quantity']); ?></td>
                                            <td class="text-right"><?php echo number_format($avg_price, 2); ?></td>
                                            <td class="text-right amount-cell"><?php echo number_format($vals['total'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No sales data available. Try resetting filters.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">TOTAL</th>
                                    <th class="text-right"><?php echo number_format($overall_qty); ?></th>
                                    <th></th>
                                    <th class="text-right" id="tfoot-overall-total"><?php echo number_format($overall_total, 2); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        <script type="text/javascript">
                        (function($){
                            $(function(){
                                if (typeof $.fn.DataTable === 'undefined') return;
                                if (!$.fn.DataTable.isDataTable('#productSalesTable')) {
                                    $('#productSalesTable').DataTable({
                                        paging: false,
                                        info: true,
                                        searching: true,
                                        dom: 'Bfrtip',
                                        buttons: [
                                            { extend: 'copy', footer: true },
                                            { extend: 'csv', footer: true },
                                            { extend: 'excel', footer: true },
                                            { extend: 'pdf', footer: true },
                                            { extend: 'print', footer: true }
                                        ],
                                        order: [[4, 'desc']],
                                        columnDefs: [{ targets: 0, orderable: false }]
                                    });
                                }
                                // ensure overall display matches footer
                                var footerTotal = $('#tfoot-overall-total').text();
                                $('#overallTotal').text(footerTotal);
                            });
                        })(jQuery);
                        </script>
                    </div>
                </div>

                <!-- Items Tables for Printing -->
                <?php if (!empty($report)): ?>
                    <?php foreach ($report as $row): ?>
                        <div class="items-table-container no-print" data-orderid="<?php echo isset($row['order_id']) ? htmlspecialchars($row['order_id']) : ''; ?>">
                            <table class="table table-bordered items-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($row['items'])): ?>
                                        <?php foreach ($row['items'] as $item): ?>
                                            <tr>
                                                <td><?php echo isset($item['name']) ? htmlspecialchars($item['name']) : 'N/A'; ?></td>
                                                <td><?php echo isset($item['quantity']) ? number_format($item['quantity'], 2) : '0.00'; ?></td>
                                                <td><?php echo isset($item['unit_price']) ? number_format($item['unit_price'], 2) : '0.00'; ?></td>
                                                <td><?php echo isset($item['total']) ? number_format($item['total'], 2) : '0.00'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Order Details Modal -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="orderDetailsModalLabel">Order Details - #<span id="modalOrderId"></span></h4>
                    </div>
                    <div class="modal-body" id="orderDetailsBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Core JS Files -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            // Ensure DataTables is loaded
            if (typeof $.fn.DataTable === 'undefined') {
                console.error('DataTables plugin not loaded');
                return;
            }

            try {
                // Initialize DataTable with minimal configuration
                var salesTable = $('#salesTable').DataTable({
                    processing: true,
                    paging: false,
                    info: true,
                    searching: true,
                    dom: 'Bfrtip',
                    buttons: [
                        { extend: 'copy', footer: true },
                        { extend: 'csv', footer: true },
                        { extend: 'excel', footer: true },
                        { extend: 'pdf', footer: true },
                        { extend: 'print', footer: true }
                    ],
                    order: [[5, 'desc']],
                    columnDefs: [
                        { 
                            targets: 0,
                            orderable: false,
                            searchable: false
                        }
                    ],
                    language: {
                        emptyTable: "No sales data available. Try resetting filters.",
                        zeroRecords: "No matching records found",
                        info: "_START_ to _END_ of _TOTAL_ entries",
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                );

                // Log successful initialization
                console.log('Sales table initialized successfully');

            } catch (error) {
                console.error('DataTable initialization failed:', error);
                // Provide visual feedback to user
                $('#salesTable_wrapper').prepend(
                    '<div class="alert alert-warning">'+
                    'Table initialization failed. Please try refreshing the page.'+
                    '</div>'
                );
            }
        });
        </script>

        <?php if (!empty($debug_sales_json)): ?>
<script>
    try {
        console.log('DEBUG: all sales rows', <?php echo $debug_sales_json; ?>);
    } catch (e) {
        console.error('Failed to output sales debug to console', e);
    }
</script>
<?php endif; ?>
    </section>

    <!-- Product Sales summary moved here so filters (server-side) update it on submit -->
    <?php
    $product_totals = [];
    if (!empty($report) && is_array($report)) {
        foreach ($report as $r) {
            $pname = trim($r['product_name'] ?? ($r['name'] ?? 'Unknown'));
            $qty = (int)($r['quantity'] ?? $r['qty'] ?? 0);
            $amt = (float)preg_replace('/[^\d\.\-]/', '', ($r['amount'] ?? 0));
            if (!isset($product_totals[$pname])) {
                $product_totals[$pname] = ['quantity' => 0, 'total' => 0.0];
            }
            $product_totals[$pname]['quantity'] += $qty;
            $product_totals[$pname]['total'] += $amt;
        }
    }
    $overall_qty = array_sum(array_column($product_totals, 'quantity'));
    $overall_total = array_sum(array_column($product_totals, 'total'));
    ?>

</div>