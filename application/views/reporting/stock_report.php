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
                                        <span class="info-box-text">Total Value</span>
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
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Value</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($report)): ?>
                                    <?php foreach ($report as $row): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['warehouse_name']); ?></td>
                                            <td><?php echo number_format($row['quantity']); ?> <?php echo htmlspecialchars($row['unit']); ?></td>
                                            <td><?php echo number_format($row['price'], 2); ?></td>
                                            <td><?php echo number_format($row['quantity'] * $row['price'], 2); ?></td>
                                            <td>
                                                <?php if ($row['quantity'] == 0): ?>
                                                    <span class="label label-danger">Out of Stock</span>
                                                <?php elseif ($row['quantity'] < 100): ?> <!-- You can adjust this threshold -->
                                                    <span class="label label-warning">Low Stock</span>
                                                <?php else: ?>
                                                    <span class="label label-success">In Stock</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="8" class="text-center">No stock data found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

<script type="text/javascript">
$(document).ready(function() {
    // Destroy existing DataTable if it exists
    if ($.fn.DataTable.isDataTable('#reportTable')) {
        $('#reportTable').DataTable().destroy();
    }
    
    // Initialize DataTable
    $('#reportTable').DataTable({
        dom: 'Bfrtip',
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
        pageLength: 25,
        responsive: true
    });
});
</script>
