<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header"><h1>Stock Report</h1></section>
    <section class="content">
        <div class="box box-primary">
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
                <div class="row" style="margin-bottom:15px;">
                    <div class="col-md-3">
                        <div class="info-box">
                            <div class="info-box-content">
                                <span class="info-box-text">Total Purchase Value</span>
                                <span class="info-box-number" id="totalPurchaseValue">0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <div class="info-box-content">
                                <span class="info-box-text">Total Sales Value</span>
                                <span class="info-box-number" id="totalSalesValue">0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <div class="info-box-content">
                                <span class="info-box-text">Current Stock Value</span>
                                <span class="info-box-number" id="totalStockValue">0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

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
                </table>
            </div>

        </div>
    </section>
</div>

<script>
$(function(){
    var table = $('#stockTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '<?php echo site_url("Controller_Reports/stock_report_data"); ?>',
            type: 'POST',
            data: function(d){
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
                d.category = $('#categoryFilter').val();
                d.warehouse = $('#warehouseFilter').val();
                d.stock_status = $('#stockStatus').val();
            },
            dataSrc: function(json){ return json && json.data ? json.data : []; }
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
        pageLength: 25,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                footer: true,
                title: 'Stock Report',
                messageTop: function() {
                    return [
                        'Warehouse: ' + $('#warehouseFilter option:selected').text(),
                        'Date Range: ' + $('#date_from').val() + ' to ' + $('#date_to').val(),
                        'Category: ' + $('#categoryFilter option:selected').text(),
                        'Total Purchase Value: ' + $('#totalPurchaseValue').text(),
                        'Total Sales Value: ' + $('#totalSalesValue').text(),
                        'Current Stock Value: ' + $('#totalStockValue').text()
                    ].join('\n');
                }
            },
            {
                extend: 'csv',
                footer: true,
                title: 'Stock Report',
                messageTop: function() {
                    return [
                        'Warehouse: ' + $('#warehouseFilter option:selected').text(),
                        'Date Range: ' + $('#date_from').val() + ' to ' + $('#date_to').val(),
                        'Category: ' + $('#categoryFilter option:selected').text(),
                        'Total Purchase Value: ' + $('#totalPurchaseValue').text(),
                        'Total Sales Value: ' + $('#totalSalesValue').text(),
                        'Current Stock Value: ' + $('#totalStockValue').text()
                    ].join('\n');
                }
            },
            {
                extend: 'excel',
                footer: true,
                title: 'Stock Report',
                messageTop: function() {
                    return [
                        'Warehouse: ' + $('#warehouseFilter option:selected').text(),
                        'Date Range: ' + $('#date_from').val() + ' to ' + $('#date_to').val(),
                        'Category: ' + $('#categoryFilter option:selected').text(),
                        'Total Purchase Value: ' + $('#totalPurchaseValue').text(),
                        'Total Sales Value: ' + $('#totalSalesValue').text(),
                        'Current Stock Value: ' + $('#totalStockValue').text()
                    ].join('\n');
                }
            },
            {
                extend: 'pdf',
                footer: true,
                title: 'Stock Report',
                messageTop: function() {
                    return [
                        'Warehouse: ' + $('#warehouseFilter option:selected').text(),
                        'Date Range: ' + $('#date_from').val() + ' to ' + $('#date_to').val(),
                        'Category: ' + $('#categoryFilter option:selected').text(),
                        'Total Purchase Value: ' + $('#totalPurchaseValue').text(),
                        'Total Sales Value: ' + $('#totalSalesValue').text(),
                        'Current Stock Value: ' + $('#totalStockValue').text()
                    ].join('\n');
                }
            },
            {
                extend: 'print',
                footer: true,
                title: 'Stock Report',
                messageTop: function() {
                    return [
                        'Warehouse: ' + $('#warehouseFilter option:selected').text(),
                        'Date Range: ' + $('#date_from').val() + ' to ' + $('#date_to').val(),
                        'Category: ' + $('#categoryFilter option:selected').text(),
                        'Total Purchase Value: ' + $('#totalPurchaseValue').text(),
                        'Total Sales Value: ' + $('#totalSalesValue').text(),
                        'Current Stock Value: ' + $('#totalStockValue').text()
                    ].join('\n');
                }
            }
        ]
    });

    // Update total values when data is loaded
    table.on('xhr', function(e, settings, json) {
        if (json) {
            if (json.totalPurchaseValue) {
                $('#totalPurchaseValue').text(numberFormat(json.totalPurchaseValue, 2));
            }
            if (json.totalSalesValue) {
                $('#totalSalesValue').text(numberFormat(json.totalSalesValue, 2));
            }
            if (json.totalStockValue) {
                $('#totalStockValue').text(numberFormat(json.totalStockValue, 2));
            }
        }
    });

    // Helper function for number formatting
    function numberFormat(number, decimals) {
        return parseFloat(number).toLocaleString('en-US', {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });
    }

    $('#applyFilters').on('click', function(){ table.ajax.reload(); });
    $('#clearFilters').on('click', function(){
        $('#date_from,#date_to,#categoryFilter,#warehouseFilter,#stockStatus').val('');
        table.ajax.reload();
    });
});
</script>

<style>
.info-box {
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    padding: 15px;
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
    margin-top: 5px;
}
</style>