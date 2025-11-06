<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Stock Report
            <small>Stock Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
            <li class="active">Stock</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- Keep existing filter form -->
                    <div class="box-header with-border">
                        <form id="stockFilters" class="form-inline">
                            <div class="form-group"><label>Date from</label>
                                <input type="date" id="date_from" class="form-control" name="date_from" value="<?php echo htmlspecialchars($filters['date_from'] ?? ''); ?>">
                            </div>
                            <div class="form-group" style="margin-left:8px;"><label>Date to</label>
                                <input type="date" id="date_to" class="form-control" name="date_to" value="<?php echo htmlspecialchars($filters['date_to'] ?? ''); ?>">
                            </div>
                            <div class="form-group" style="margin-left:8px;">
                                <label>Category</label>
                                <select id="categoryFilter" class="form-control" name="category">
                                    <option value="">All</option>
                                    <?php if(!empty($categories)): foreach($categories as $c): ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:8px;">
                                <label>Warehouse</label>
                                <select id="warehouseFilter" class="form-control" name="warehouse">
                                    <option value="">All</option>
                                    <?php if(!empty($warehouses)): foreach($warehouses as $w): ?>
                                        <option value="<?php echo $w['id']; ?>"><?php echo htmlspecialchars($w['name']); ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left:8px;">
                                <label>Status</label>
                                <select id="stockStatus" class="form-control" name="stock_status">
                                    <option value="">All</option>
                                    <option value="in_stock">In Stock (>10)</option>
                                    <option value="low_stock">Low (1-10)</option>
                                    <option value="out_of_stock">Out of Stock (0)</option>
                                </select>
                            </div>

                            <button id="applyFilters" type="button" class="btn btn-primary" style="margin-left:10px;">Apply</button>
                            <button id="clearFilters" type="button" class="btn btn-default" style="margin-left:6px;">Clear</button>
                        </form>
                    </div>

                    <div class="box-body">
                        <!-- Metrics Cards similar to sales report -->
                        <div class="row" style="margin: 20px 0;">
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Purchase Value</span>
                                        <span class="info-box-number" id="totalPurchaseValue">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Sales Value</span>
                                        <span class="info-box-number" id="totalSalesValue">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-archive"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Current Stock Value</span>
                                        <span class="info-box-number" id="totalStockValue">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-warning"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Low Stock Items</span>
                                        <span class="info-box-number" id="lowStockCount">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Table -->
                        <table id="stockTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-right">Opening Qty</th>
                                    <th class="text-right">Purchased (Qty)</th>
                                    <th class="text-right">Purchased Value</th>
                                    <th class="text-right">Sold (Qty)</th>
                                    <th class="text-right">Sold Value</th>
                                    <th class="text-right">Closing Qty</th>
                                    <th class="text-right">Current Value</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>TOTAL</th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.info-box {
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.2);
}
.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}
.info-box-text {
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-transform: uppercase;
}
.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
    margin-top: 10px;
}
.bg-green { background-color: #00a65a !important; color: #fff !important; }
.bg-blue { background-color: #0073b7 !important; color: #fff !important; }
.bg-yellow { background-color: #f39c12 !important; color: #fff !important; }
.bg-red { background-color: #dd4b39 !important; color: #fff !important; }
</style>

<script>
$(function(){
    var table = $('#stockTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        dom: "<'row'<'col-sm-6'l><'col-sm-6 text-right'B>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        ajax: {
            url: '<?php echo site_url("Controller_Reports/stock_report_data"); ?>',
            type: 'POST',
            data: function(d) {
                return $.extend({}, d, {
                    date_from: $('#date_from').val(),
                    date_to: $('#date_to').val(),
                    category: $('#categoryFilter').val(),
                    warehouse: $('#warehouseFilter').val(),
                    stock_status: $('#stockStatus').val()
                });
            },
            dataSrc: function(json) {
                if (json) {
                    $('#totalPurchaseValue').text(numberFormat(json.totalPurchaseValue || 0));
                    $('#totalSalesValue').text(numberFormat(json.totalSalesValue || 0));
                    $('#totalStockValue').text(numberFormat(json.totalStockValue || 0));
                    $('#lowStockCount').text(json.lowStockCount || 0);
                }
                return json.data || [];
            },
            error: function(xhr, error, thrown) {
                console.error('Stock AJAX error:', error, thrown, xhr.responseText);
                // show friendly message in table body
                $('#stockTable tbody').html('<tr><td colspan="8" class="text-center">Error loading data. Check server logs.</td></tr>');
            }
        },
        columns: [
            { data: 'name' },
            { data: 'opening_qty', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'purchased_in_range', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'purchased_value_in_range', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'sold_in_range', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'sold_value_in_range', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'closing_qty', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'current_value', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2, '') }
        ],
        order: [[7, 'desc']],
        lengthMenu: [[10,25,50,100,-1],[10,25,50,100,'All']],
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                footer: true,
                exportOptions: { columns: ':visible' },
                messageTop: function() {
                    return buildExportHeader();
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                footer: true,
                exportOptions: { columns: ':visible' },
                messageTop: function() { return buildExportHeader(); }
            },
            {
                extend: 'excel',
                text: 'Excel',
                footer: true,
                exportOptions: { columns: ':visible' },
                messageTop: function() { return buildExportHeader(); }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                footer: true,
                exportOptions: { columns: ':visible' },
                messageTop: function() { return buildExportHeader(); },
                customize: function (doc) {
                    // small PDF tweaks (optional)
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 11;
                }
            },
            {
                extend: 'print',
                text: 'Print',
                footer: true,
                exportOptions: { columns: ':visible' },
                messageTop: function() { return buildExportHeader(); }
            }
        ],
        drawCallback: function(settings) {
            // update footer totals for current page
            var api = this.api();
            var cols = [1,2,3,4,5,6,7];
            cols.forEach(function(idx){
                var total = api.column(idx, {page:'current'}).data().reduce(function(a,b){
                    return a + (parseFloat(b) || 0);
                }, 0);
                $(api.column(idx).footer()).html(numberFormat(total));
            });
        }
    });

    function buildExportHeader() {
        var lines = [];
        var wh = $('#warehouseFilter option:selected').text() || 'All Warehouses';
        var df = $('#date_from').val() || '';
        var dt = $('#date_to').val() || '';
        lines.push('Warehouse: ' + wh);
        lines.push('Date Range: ' + (df ? df : '-') + ' to ' + (dt ? dt : '-'));
        lines.push('Total Purchase Value: ' + $('#totalPurchaseValue').text());
        lines.push('Total Sales Value: ' + $('#totalSalesValue').text());
        lines.push('Current Stock Value: ' + $('#totalStockValue').text());
        return lines.join('\n');
    }

    function numberFormat(number) {
        return parseFloat(number || 0).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2});
    }

    $('#applyFilters').on('click', function(){ table.ajax.reload(); });
    $('#clearFilters').on('click', function(){
        $('#date_from,#date_to,#categoryFilter,#warehouseFilter,#stockStatus').val('');
        table.ajax.reload();
    });
});
</script>