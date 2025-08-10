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
                                    <select class="form-control input-sm" id="warehouse" name="warehouse" onchange="this.form.submit()">
                                        <option value="">All Warehouses</option>
                                        <?php if (!empty($warehouses)): ?>
                                            <?php foreach ($warehouses as $warehouse): ?>
                                                <option value="<?php echo htmlspecialchars($warehouse['id']); ?>" <?php echo (isset($filters['warehouse']) && $filters['warehouse'] == $warehouse['id'] ? 'selected' : ''); ?>>
                                                    <?php echo htmlspecialchars($warehouse['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-right: 10px;">
                                    <label for="status">Status:</label>
                                    <select class="form-control input-sm" id="status" name="status" onchange="this.form.submit()">
                                        <option value="">All Statuses</option>
                                        <option value="1,2" <?php echo (isset($filters['status']) && $filters['status'] == '1,2' ? 'selected' : ''); ?>>Paid/Partial</option>
                                        <option value="0" <?php echo (isset($filters['status']) && $filters['status'] == '0' ? 'selected' : ''); ?>>Unpaid</option>
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
                        <h4>Sales Data</h4>
                        <table class="table table-bordered table-striped" id="salesTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <?php if (!empty($product_summary)): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $data_source = !empty($product_summary) ? $product_summary : $report;
                                $grouped_data = []; // Initialize grouped_data as an empty array
                                if (!empty($data_source)):
                                    // Group and sum data by product name and date
                                    foreach ($data_source as $item) {
                                        $is_product_summary = !empty($product_summary) && isset($item['total_quantity']);
                                        $key = $item['product_name'] . '|' . date('Y-m-d', strtotime($is_product_summary ? $item['latest_date'] : $item['date_time']));
                                        if (!isset($grouped_data[$key])) {
                                            $grouped_data[$key] = [
                                                'product_name' => $item['product_name'],
                                                'quantity' => 0,
                                                'price' => $is_product_summary ? $item['avg_price'] : $item['price'],
                                                'total' => 0,
                                                'date' => $is_product_summary ? date('Y-m-d', strtotime($item['latest_date'])) : date('Y-m-d', strtotime($item['date_time']))
                                            ];
                                        }
                                        $grouped_data[$key]['quantity'] += $is_product_summary ? $item['total_quantity'] : $item['quantity'];
                                        $grouped_data[$key]['total'] += $is_product_summary ? $item['total_amount'] : $item['amount'];
                                    }
                                    $index = 0;
                                    foreach ($grouped_data as $item):
                                        $index++;
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $index; ?></td>
                                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                        <td class="text-right"><?php echo number_format($item['quantity'], 0); ?></td>
                                        <td class="text-right"><?php echo number_format($item['price'], 2); ?></td>
                                        <td class="text-right"><?php echo number_format($item['total'], 2); ?></td>
                                        <td><?php echo $item['date']; ?></td>
                                        <?php if (!empty($product_summary)): ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-xs view-orders" 
                                                        data-product-id="<?php echo $item['product_id']; ?>"
                                                        data-product-name="<?php echo htmlspecialchars($item['product_name']); ?>">
                                                    View
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php 
                                    endforeach;
                                else: 
                                ?>
                                    <tr>
                                        <td colspan="<?php echo !empty($product_summary) ? '7' : '6'; ?>" class="text-center">
                                            No sales data available. Try resetting filters.
                                        </td>
                                    </tr>
                                <?php 
                                endif; 
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th class="text-right"><?php 
                                        $total_quantity = !empty($grouped_data) ? array_sum(array_column($grouped_data, 'quantity')) : 0;
                                        echo number_format($total_quantity, 0); 
                                    ?></th>
                                    <th></th>
                                    <th class="text-right"><?php 
                                        $total_revenue = !empty($grouped_data) ? array_sum(array_column($grouped_data, 'total')) : 0;
                                        echo number_format($total_revenue, 2); 
                                    ?></th>
                                    <th colspan="<?php echo !empty($product_summary) ? '1' : '0'; ?>"></th>
                                </tr>
                            </tfoot>
                        </table>
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

        <!-- Metrics Modal -->
        <div class="modal fade" id="metricsModal" tabindex="-1" role="dialog" aria-labelledby="metricsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="metricsModalLabel">Sale Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Order ID:</th>
                                        <td id="modal-order-id"></td>
                                    </tr>
                                    <th>Product:</th>
                                    <td id="modal-product-name"></td>
                                    </tr>
                                    <th>Date:</th>
                                    <td id="modal-date"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Quantity:</th>
                                        <td id="modal-quantity"></td>
                                    </tr>
                                    <tr>
                                        <th>Rate:</th>
                                        <td id="modal-rate"></td>
                                    </tr>
                                    <tr>
                                        <th>Amount:</th>
                                        <td id="modal-amount"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            console.log('Script execution started');

            if (typeof $.fn.DataTable === 'undefined') {
                console.error('DataTables is not loaded!');
                return;
            }

            // Handle quick filters with auto-submit and page reload
            $('.quick-filter').click(function(e) {
                e.preventDefault();
                var period = $(this).data('period');
                var today = moment();
                
                // Update active state
                $('.quick-filter').removeClass('active');
                $(this).addClass('active');

                // Set the period in the hidden input
                $('#period_input').val(period);

                // Set status to Paid/Partial by default
                $('#status_input').val('1,2');

                // Set date range based on period
                switch(period) {
                    case 'today':
                        $('input[name="date_from"]').val(today.format('YYYY-MM-DD'));
                        $('input[name="date_to"]').val(today.format('YYYY-MM-DD'));
                        break;
                    case 'this_week':
                        $('input[name="date_from"]').val(today.startOf('week').format('YYYY-MM-DD'));
                        $('input[name="date_to"]').val(today.endOf('week').format('YYYY-MM-DD'));
                        break;
                    case 'this_month':
                        $('input[name="date_from"]').val(today.startOf('month').format('YYYY-MM-DD'));
                        $('input[name="date_to"]').val(today.endOf('month').format('YYYY-MM-DD'));
                        break;
                    case 'this_quarter':
                        $('input[name="date_from"]').val(today.startOf('quarter').format('YYYY-MM-DD'));
                        $('input[name="date_to"]').val(today.endOf('quarter').format('YYYY-MM-DD'));
                        break;
                    case 'last_30_days':
                        $('input[name="date_from"]').val(today.subtract(30, 'days').format('YYYY-MM-DD'));
                        $('input[name="date_to"]').val(today.add(30, 'days').format('YYYY-MM-DD'));
                        break;
                    default:
                        $('input[name="date_from"]').val('');
                        $('input[name="date_to"]').val('');
                        break;
                }

                // Reload the page with new filters
                $('#filterForm').submit();
            });

            // Get the current period and warehouse from URL
            var currentPeriod = new URLSearchParams(window.location.search).get('period') || 'last_30_days';
            var currentWarehouse = new URLSearchParams(window.location.search).get('warehouse') || '';

            // Set active state for quick filter buttons on page load
            $('.quick-filter').removeClass('active');
            $('.quick-filter[data-period="' + currentPeriod + '"]').addClass('active');

            console.log('Current Warehouse from URL: ' + currentWarehouse);

            // Initialize DataTable for Sales Data without pagination
            try {
                var salesTable = $('#salesTable').DataTable({
                    "fnPreDrawCallback": function(settings) {
                        if ($('#salesTable tbody tr').length === 1 && $('#salesTable tbody tr td').hasClass('text-center')) {
                            console.log('No sales data available in table');
                        }
                    },
                    "columnDefs": [{
                        "targets": 0,
                        "orderable": false,
                        "searchable": false
                    }],
                    "lengthMenu": [[-1], ["All"]],
                    "pageLength": -1,
                    "paging": false,
                    dom: 'Bfrtip',
                    buttons: [
                        { extend: 'copy', text: 'Copy', className: 'dt-button', exportOptions: { columns: ':not(:last-child)' } },
                        { extend: 'csv', text: 'CSV', title: 'Sales_Report_<?php echo date('Y-m-d'); ?>', className: 'dt-button', exportOptions: { columns: ':not(:last-child)' } },
                        { extend: 'excel', text: 'Excel', title: 'Sales_Report_<?php echo date('Y-m-d'); ?>', className: 'dt-button', exportOptions: { columns: ':not(:last-child)' } },
                        {
                            extend: 'pdf',
                            text: 'PDF',
                            title: 'Sales_Report_<?php echo date('Y-m-d'); ?>',
                            className: 'dt-button',
                            exportOptions: { columns: ':not(:last-child)' },
                            customize: function(doc) {
                                doc.content.splice(0, 0, {
                                    text: [
                                        { text: 'Sales Report\n', style: 'header' },
                                        { text: 'Generated on: <?php echo date('Y-m-d H:i:s'); ?> EAT\n', style: 'subheader' },
                                        { text: 'Period: <?php echo isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : 'N/A'; ?> to <?php echo isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : 'N/A'; ?>\n', style: 'subheader' },
                                        { text: 'Warehouse: <?php echo isset($filters['warehouse']) && $filters['warehouse'] ? htmlspecialchars($warehouses[$filters['warehouse']]['name'] ?? 'Unknown') : 'All Warehouses'; ?>\n', style: 'subheader' }
                                    ],
                                    margin: [0, 0, 0, 12]
                                });
                                doc.styles = { header: { fontSize: 18, bold: true }, subheader: { fontSize: 12, bold: false } };
                                doc.footer = function(currentPage, pageCount) {
                                    return { text: 'Generated by System - Page ' + currentPage + ' of ' + pageCount, alignment: 'center', margin: [0, 0, 0, 10] };
                                };
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            title: '',
                            className: 'dt-button',
                            exportOptions: { columns: ':not(:last-child)' },
                            customize: function(win) {
                                $(win.document.body).prepend(
                                    '<div class="print-header">' +
                                    '<h1>Sales Report</h1>' +
                                    '<p>Generated on: <?php echo date('Y-m-d H:i:s'); ?> EAT</p>' +
                                    '<p>Period: <?php echo isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : 'N/A'; ?> to ' +
                                    '<?php echo isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : 'N/A'; ?></p>' +
                                    '<p>Warehouse: <?php echo isset($filters['warehouse']) && $filters['warehouse'] ? htmlspecialchars($warehouses[$filters['warehouse']]['name'] ?? 'Unknown') : 'All Warehouses'; ?></p>' +
                                    '</div>'
                                );
                                $(win.document.body).append(
                                    '<div class="print-footer">Generated by System - Page 1 of 1</div>'
                                );
                                $(win.document.body).find('#salesTable').addClass('compact').css({
                                    'font-size': '12px',
                                    'border-collapse': 'collapse',
                                    'width': '100%'
                                });
                                $(win.document.body).find('#salesTable th, #salesTable td').css({
                                    'border': '1px solid #000',
                                    'padding': '8px'
                                });
                            }
                        }
                    ],
                    order: [[5, 'desc']],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search...",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "Showing 0 to 0 of 0 entries",
                        infoFiltered: "(filtered from _MAX_ total entries)"
                    },
                    initComplete: function() {
                        console.log('Sales DataTable initialized');
                        console.log('Warehouse filter value: <?php echo isset($_GET['warehouse']) ? htmlspecialchars($_GET['warehouse']) : 'Not set'; ?>');
                    }
                });
            } catch(e) {
                console.error('DataTable initialization failed:', e);
            }

            // Handle View Orders button click
            $('.view-orders').on('click', function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var orderDetails = <?php echo json_encode($order_details ?? []); ?>;
                var productOrders = orderDetails[productId] || [];
                
                var html = '';
                productOrders.forEach(function(order) {
                    html += '<tr>' +
                        '<td>' + order.order_id + '</td>' +
                        '<td class="text-right">' + parseInt(order.qty).toLocaleString() + '</td>' +
                        '<td>' + (order.customer_name || 'Walk-in Customer') + '</td>' +
                        '<td>' + (order.email || '-') + '</td>' +
                        '<td>' + (order.phone || '-') + '</td>' +
                        '</tr>';
                });

                if (html === '') {
                    html = '<tr><td colspan="5" class="text-center">No orders found for this product</td></tr>';
                }

                $('#orderDetailsModal .modal-title').text('Orders for ' + productName);
                $('#orderDetailsBody').html(html);
                $('#orderDetailsModal').modal('show');
            });

            // Show sale details modal
            $(document).on('click', '.view-items', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('View Items button clicked');
                
                var orderId = $(this).data('orderid');
                var items;
                try {
                    items = $(this).data('items') || [];
                    if (typeof items === 'string') {
                        items = JSON.parse(items);
                    }
                } catch (err) {
                    console.error('Error parsing data-items for order_id ' + orderId + ': ', err);
                    items = [];
                }
                
                console.log('Order ID:', orderId, 'Items:', items);
                
                $('#modalOrderId').text(orderId || 'N/A');
                
                var html = '<div class="table-responsive"><table class="table table-bordered">';
                html += '<thead><tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead><tbody>';
                
                if (Array.isArray(items) && items.length > 0) {
                    items.forEach(function(item) {
                        html += '<tr>';
                        html += '<td>' + (item.name ? $('<div/>').text(item.name).html() : 'N/A') + '</td>';
                        html += '<td>' + (item.quantity ? parseFloat(item.quantity).toFixed(2) : '0.00') + '</td>';
                        html += '<td>' + (item.unit_price ? parseFloat(item.unit_price).toFixed(2) : '0.00') + '</td>';
                        html += '<td>' + (item.total ? parseFloat(item.total).toFixed(2) : '0.00') + '</td>';
                        html += '</tr>';
                    });
                } else {
                    html += '<tr><td colspan="4" class="text-center">No items found</td></tr>';
                }
                
                html += '</tbody></table></div>';
                $('#saleDetailsBody').html(html);
                $('#saleDetailsModal').modal('show');
            });

            // Handle View Order button click
            $('.view-order').on('click', function() {
                var button = $(this);
                $('#modal-order-id').text(button.data('order-id'));
                $('#modal-qty').text(button.data('qty'));
                $('#modal-customer').text(button.data('customer'));
                $('#orderModal').modal('show');
            });

            // Handle View Metrics button click
            $('.view-metrics').on('click', function() {
                var button = $(this);
                $('#modal-order-id').text(button.data('order-id'));
                $('#modal-product-name').text(button.data('product-name'));
                $('#modal-quantity').text(button.data('quantity'));
                $('#modal-rate').text(button.data('rate'));
                $('#modal-amount').text(button.data('amount'));
                $('#modal-date').text(button.data('date'));
                $('#metricsModal').modal('show');
            });

            // Product details modal
            $(document).on('click', '.view-details', function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var sales = <?php echo json_encode($report); ?>;
                
                var productSales = sales.filter(function(sale) {
                    return sale.product_id === productId;
                });

                var modalContent = '<div class="table-responsive"><table class="table table-bordered table-striped">' +
                    '<thead><tr>' +
                    '<th>Date</th>' +
                    '<th>Order ID</th>' +
                    '<th>Quantity</th>' +
                    '<th>Price</th>' +
                    '<th>Amount</th>' +
                    '</tr></thead><tbody>';

                productSales.forEach(function(sale) {
                    modalContent += '<tr>' +
                        '<td>' + moment(sale.date_time).format('YYYY-MM-DD') + '</td>' +
                        '<td>' + sale.order_id + '</td>' +
                        '<td class="text-right">' + parseFloat(sale.quantity).toFixed(2) + '</td>' +
                        '<td class="text-right">' + parseFloat(sale.price).toFixed(2) + '</td>' +
                        '<td class="text-right">' + parseFloat(sale.amount).toFixed(2) + '</td>' +
                        '</tr>';
                });

                modalContent += '</tbody></table></div>';

                $('#productDetailsModal .modal-title').text('Sales Details - ' + productName);
                $('#productDetailsModal .modal-body').html(modalContent);
                $('#productDetailsModal').modal('show');
            });
        });
        </script>
    </section>
</div>