<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stock Report
            <small>Inventory Status Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
            <li class="active">Stock</li>
        </ol>
    </section>

    <!-- Main content -->
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

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Stock Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <select class="form-control input-sm" id="category" name="category">
                                            <option value="">All Categories</option>
                                            <?php if (!empty($categories)): ?>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo htmlspecialchars($category['id']); ?>" 
                                                            <?php echo (isset($filters['category']) && $filters['category'] == $category['id'] ? 'selected' : ''); ?>>
                                                        <?php echo htmlspecialchars($category['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="warehouse">Warehouse:</label>
                                        <select class="form-control input-sm" id="warehouse" name="warehouse">
                                            <option value="">All Warehouses</option>
                                            <?php if (!empty($warehouses)): ?>
                                                <?php foreach ($warehouses as $warehouse): ?>
                                                    <option value="<?php echo htmlspecialchars($warehouse['id']); ?>"
                                                            <?php echo (isset($filters['warehouse']) && $filters['warehouse'] == $warehouse['id'] ? 'selected' : ''); ?>>
                                                        <?php echo htmlspecialchars($warehouse['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_status">Stock Status:</label>
                                        <select class="form-control input-sm" id="stock_status" name="stock_status">
                                            <option value="">All</option>
                                            <option value="in_stock" <?php echo (isset($filters['stock_status']) && $filters['stock_status'] == 'in_stock' ? 'selected' : ''); ?>>In Stock</option>
                                            <option value="low_stock" <?php echo (isset($filters['stock_status']) && $filters['stock_status'] == 'low_stock' ? 'selected' : ''); ?>>Low Stock</option>
                                            <option value="out_of_stock" <?php echo (isset($filters['stock_status']) && $filters['stock_status'] == 'out_of_stock' ? 'selected' : ''); ?>>Out of Stock</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="limit">Records per page:</label>
                                        <select class="form-control input-sm" id="limit" name="limit">
                                            <option value="10" <?php echo (isset($filters['limit']) && $filters['limit'] == 10 ? 'selected' : ''); ?>>10</option>
                                            <option value="25" <?php echo (isset($filters['limit']) && $filters['limit'] == 25 ? 'selected' : ''); ?>>25</option>
                                            <option value="50" <?php echo (isset($filters['limit']) && $filters['limit'] == 50 ? 'selected' : ''); ?>>50</option>
                                            <option value="100" <?php echo (isset($filters['limit']) && $filters['limit'] == 100 ? 'selected' : ''); ?>>100</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="<?php echo base_url('Controller_Reports/stock_report'); ?>" class="btn btn-default btn-sm">Reset</a>
                                </form>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Items</span>
                                        <span class="info-box-number"><?php echo isset($aggregates['total_items']) ? number_format($aggregates['total_items']) : '0'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Value (TZS)</span>
                                        <span class="info-box-number"><?php echo isset($aggregates['total_value']) ? number_format($aggregates['total_value'], 2) : '0.00'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-warning"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Low Stock Items</span>
                                        <span class="info-box-number"><?php echo isset($aggregates['low_stock_items']) ? number_format($aggregates['low_stock_items']) : '0'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-times-circle"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Out of Stock</span>
                                        <span class="info-box-number"><?php echo isset($aggregates['out_of_stock_items']) ? number_format($aggregates['out_of_stock_items']) : '0'; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="reportTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Warehouse</th>
                                    <th>Stock Level</th>
                                    <th>Total Purchased</th>
                                    <th>Sales</th>
                                    <th>Purchase Value (TZS)</th>
                                    <th>Current Value (TZS)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($report['data'])): ?>
                                    <?php foreach ($report['data'] as $row): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['name'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['category_name'] ?? 'Uncategorized'); ?></td>
                                            <td><?php echo htmlspecialchars($row['warehouse_name'] ?? 'Unassigned'); ?></td>
                                            <td>
                                                <?php echo number_format($row['quantity'] ?? 0); ?> 
                                                <?php echo htmlspecialchars($row['unit'] ?? 'units'); ?>
                                            </td>
                                            <td><?php echo number_format($row['total_purchased'] ?? 0); ?></td>
                                            <td><?php echo number_format($row['total_sold'] ?? 0); ?></td>
                                            <td><?php echo number_format($row['total_purchase_value'] ?? 0, 2); ?></td>
                                            <td><?php echo number_format(max(($row['quantity'] ?? 0), 0) * ($row['price'] ?? 0), 2); ?></td>
                                            <td>
                                                <?php if (($row['quantity'] ?? 0) <= 0): ?>
                                                    <span class="label label-danger">Out of Stock</span>
                                                <?php elseif (($row['quantity'] ?? 0) <= 10): ?>
                                                    <span class="label label-warning">Low Stock</span>
                                                <?php else: ?>
                                                    <span class="label label-success">In Stock</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="10" class="text-center">No stock data found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Totals:</th>
                                    <th><?php echo number_format(array_sum(array_column($report['data'] ?? [], 'quantity'))); ?></th>
                                    <th><?php echo number_format(array_sum(array_column($report['data'] ?? [], 'total_purchased'))); ?></th>
                                    <th><?php echo number_format(array_sum(array_column($report['data'] ?? [], 'total_sold'))); ?></th>
                                    <th><?php echo number_format(array_sum(array_column($report['data'] ?? [], 'total_purchase_value')), 2); ?></th>
                                    <th><?php echo number_format(array_sum(array_map(function($row) { 
                                        return ($row['quantity'] ?? 0) * ($row['price'] ?? 0); 
                                    }, $report['data'] ?? [])), 2); ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Pagination Controls -->
                        <?php if (!empty($report['total_items']) && $report['total_items'] > 0): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        <?php
                                        $total_items = $report['total_items'];
                                        $limit = isset($filters['limit']) ? $filters['limit'] : ($report['limit'] ?? 10);
                                        $offset = isset($filters['offset']) ? $filters['offset'] : ($report['offset'] ?? 0);
                                        $total_pages = ceil($total_items / $limit);
                                        $current_page = floor($offset / $limit) + 1;

                                        // Build URL with existing filters
                                        $base_url = base_url('Controller_Reports/stock_report');
                                        $query_params = array_filter($filters, function($key) {
                                            return in_array($key, ['category', 'warehouse', 'stock_status', 'limit']);
                                        }, ARRAY_FILTER_USE_KEY);
                                        $query_string = http_build_query($query_params);
                                        ?>
                                        <ul class="pagination">
                                            <!-- Previous Button -->
                                            <li class="paginate_button previous <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                                                <a href="<?php echo $current_page > 1 ? $base_url . '?' . $query_string . '&offset=' . (($current_page - 2) * $limit) : '#'; ?>">Previous</a>
                                            </li>
                                            <!-- Page Numbers -->
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="paginate_button <?php echo $i == $current_page ? 'active' : ''; ?>">
                                                    <a href="<?php echo $base_url . '?' . $query_string . '&offset=' . (($i - 1) * $limit); ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <!-- Next Button -->
                                            <li class="paginate_button next <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                                                <a href="<?php echo $current_page < $total_pages ? $base_url . '?' . $query_string . '&offset=' . ($current_page * $limit) : '#'; ?>">Next</a>
                                            </li>
                                        </ul>
                                        <div class="dataTables_info">
                                            Showing <?php echo ($offset + 1); ?> to <?php echo min($offset + $limit, $total_items); ?> of <?php echo $total_items; ?> entries
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"/>

<!-- Core JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    // Destroy existing DataTable if it exists
    if ($.fn.DataTable.isDataTable('#reportTable')) {
        $('#reportTable').DataTable().destroy();
    }

    // Initialize DataTable with custom pagination
    var table = $('#reportTable').DataTable({
        dom: 'Bfrtip',
        data: <?php echo json_encode($report['data'] ?? []); ?>,
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'category_name' },
            { data: 'warehouse_name' },
            { data: 'quantity' },
            { data: 'total_purchased' },
            { data: 'total_sold' },
            { 
                data: 'total_purchase_value',
                render: function(data) {
                    return parseFloat(data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                }
            },
            { 
                data: null,
                render: function(data) {
                    return (parseFloat(data.quantity || 0) * parseFloat(data.price || 0)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                }
            },
            {
                data: 'quantity',
                render: function(data) {
                    if (data <= 0) {
                        return '<span class="label label-danger">Out of Stock</span>';
                    } else if (data <= 10) {
                        return '<span class="label label-warning">Low Stock</span>';
                    } else {
                        return '<span class="label label-success">In Stock</span>';
                    }
                }
            }
        ],
        pageLength: <?php echo isset($filters['limit']) ? $filters['limit'] : ($report['limit'] ?? 10); ?>,
        displayStart: <?php echo $report['offset'] ?? 0; ?>,
        ordering: true,
        searching: true,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(win) {
                    $(win.document.body).prepend(
                        '<div style="text-align: center; margin-bottom: 20px;">' +
                        '<h1>Stock Report</h1>' +
                        '<p>Generated on: <?php echo date('Y-m-d H:i:s'); ?></p>' +
                        '</div>'
                    );
                }
            }
        ],
        order: [[1, 'asc']],
        responsive: true,
        paging: true,
        pagingType: 'full_numbers',
        language: {
            paginate: {
                first: '«',
                previous: '‹',
                next: '›',
                last: '»'
            },
            lengthMenu: '_MENU_ records per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ entries'
        },
        drawCallback: function(settings) {
            var api = this.api();
            var pageInfo = api.page.info();
            
            // Calculate totals
            var totalQuantity = api.column(4, {page: 'current'}).data().reduce(function(a, b) {
                return parseFloat(a || 0) + parseFloat(b || 0);
            }, 0);
            
            var totalPurchased = api.column(5, {page: 'current'}).data().reduce(function(a, b) {
                return parseFloat(a || 0) + parseFloat(b || 0);
            }, 0);
            
            var totalSold = api.column(6, {page: 'current'}).data().reduce(function(a, b) {
                return parseFloat(a || 0) + parseFloat(b || 0);
            }, 0);
            
            var totalPurchaseValue = api.column(7, {page: 'current'}).data().reduce(function(a, b) {
                return parseFloat(a || 0) + parseFloat(b || 0);
            }, 0);
            
            var totalCurrentValue = api.column(8, {page: 'current'}).data().reduce(function(a, b) {
                return parseFloat(a || 0) + parseFloat(b || 0);
            }, 0);
            
            // Update footer
            $(api.column(4).footer()).html(totalQuantity.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $(api.column(5).footer()).html(totalPurchased.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $(api.column(6).footer()).html(totalSold.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $(api.column(7).footer()).html(totalPurchaseValue.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $(api.column(8).footer()).html(totalCurrentValue.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            
            // Only hide pagination if there is no data
            $('.dataTables_paginate').toggle(pageInfo.recordsTotal > 0);
            $('.dataTables_length').toggle(pageInfo.recordsTotal > 0);
            $('.dataTables_info').toggle(pageInfo.recordsTotal > 0);
        },
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();
            
            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ? 
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ? i : 0;
            };
        }
    });

    // Sync DataTable page length with form select
    $('#limit').on('change', function() {
        var limit = $(this).val();
        var url = '<?php echo base_url('Controller_Reports/stock_report'); ?>';
        var params = <?php echo json_encode(array_filter($filters, function($key) { return $key !== 'limit' && $key !== 'offset'; }, ARRAY_FILTER_USE_KEY)); ?>;
        params.limit = limit;
        params.offset = 0; // Reset to first page
        window.location.href = url + '?' + $.param(params);
    });
});
</script>