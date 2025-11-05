<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Stock Levels
      <small>View and Monitor Stock</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stock</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>

        <?php if($is_admin): ?>
        <div class="form-group">
            <label for="store_filter">Filter by Store:</label>
            <select class="form-control" id="store_filter" name="store_id">
                <option value="">All Stores</option>
                <?php foreach($stores as $store): ?>
                    <option value="<?php echo $store['id']; ?>">
                        <?php echo htmlspecialchars($store['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Current Stock Levels</h3>
          </div>
          <div class="box-body">
            <table id="stockTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Current Stock</th>
                  <th>Unit</th>
                  <th>Price</th>
                  <?php if($is_admin): ?>
                    <th>Store</th>
                  <?php endif; ?>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Replace the existing CSS imports with these -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap.min.css"/>

<!-- Replace the existing script imports with these -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var stockTable = $('#stockTable').DataTable({
        "processing": true,
        "serverSide": false,
        "pageLength": 25, // Items per page
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], // Page length options
        "ajax": {
            "url": "<?php echo base_url('Controller_Products/fetchStockData'); ?>",
            "type": "POST",
            "data": function(d) {
                d.store_id = $('#store_filter').val();
            },
            "dataSrc": function(json) {
                if (json.error) {
                    console.error('Data error:', json.error);
                    $('#messages').html(`
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            ${json.message || 'Failed to load stock data'}
                        </div>
                    `);
                    return [];
                }
                return json.data || [];
            }
        },
        "columns": [
            { "data": "name" },
            { 
                "data": "current_stock",
                "className": "text-right"
            },
            { "data": "unit" },
            { 
                "data": "price",
                "className": "text-right",
                "render": function(data) {
                    return 'TZS ' + parseFloat(data).toFixed(2);
                }
            },
            <?php if($is_admin): ?>
            { "data": "store_name" },
            <?php endif; ?>
            {
                "data": "current_stock",
                "className": "text-center",
                "render": function(data) {
                    var stock = parseInt(data);
                    if (stock <= 10) {
                        return '<span class="label label-danger">Low Stock (' + stock + ')</span>';
                    } else if (stock <= 20) {
                        return '<span class="label label-warning">Medium (' + stock + ')</span>';
                    }
                    return '<span class="label label-success">Good (' + stock + ')</span>';
                }
            }
        ],
        "order": [[1, 'asc']],
        "dom": "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "buttons": [
            {
                extend: 'copy',
                text: '<i class="fa fa-copy"></i> Copy',
                className: 'btn btn-default btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                text: '<i class="fa fa-file-text-o"></i> CSV',
                className: 'btn btn-default btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-default btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                className: 'btn btn-default btn-sm',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(doc) {
                    // Add title to PDF
                    doc.content.splice(0, 0, {
                        text: 'Stock Levels Report',
                        style: 'title',
                        alignment: 'center',
                        margin: [0, 0, 0, 12]
                    });
                    
                    // Add current date
                    doc.content.splice(1, 0, {
                        text: 'Generated on: ' + new Date().toLocaleDateString(),
                        style: 'subheader',
                        alignment: 'right',
                        margin: [0, 0, 0, 12]
                    });
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                className: 'btn btn-default btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i> Columns',
                className: 'btn btn-default btn-sm'
            }
        ],

        // Add footer callback for totals
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();

            // Total stock calculation
            var totalStock = api
                .column(1, { search: 'applied' })
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0);

            // Add total to footer
            $(api.column(1).footer()).html('Total: ' + totalStock);
        }
    });

    // Add table footer for totals
    $('#stockTable').append('<tfoot><tr>' + 
        '<th>Total</th>' +
        '<th></th>' + // Will be populated by footerCallback
        '<th></th>' +
        '<th></th>' +
        <?php if($is_admin): ?>
        '<th></th>' +
        <?php endif; ?>
        '<th></th>' +
        '</tr></tfoot>'
    );

    $('#store_filter').on('change', function() {
        stockTable.ajax.reload(null, false);
    });

    // Add debug logging
    stockTable.on('xhr', function() {
        var json = stockTable.ajax.json();
        console.log('Data loaded:', json);
    });

    // Add responsive handling
    $(window).resize(function() {
        stockTable.columns.adjust().draw();
    });
});
</script>

<!-- Add custom styles -->
<style>
.dt-buttons .btn {
    margin-right: 5px;
}
.dataTables_wrapper .row {
    margin-bottom: 10px;
}
.dataTables_paginate .pagination {
    margin: 0;
}
</style>