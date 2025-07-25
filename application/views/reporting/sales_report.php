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
@media print {
  body { font-family: Arial, sans-serif; }
  .no-print { display: none; }
  .content-wrapper { margin: 0; padding: 0; }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
  .items-table { margin-left: 20px; font-size: 11px; margin-top: 10px; }
  .print-header { text-align: center; margin-bottom: 20px; }
  .print-footer { text-align: center; margin-top: 20px; font-size: 10px; }
}
.dt-buttons { margin-bottom: 10px; }
.dt-button { margin-right: 5px; }
.items-table-container { display: none; }
@media print {
  .items-table-container { display: block; }
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

        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Sales Report</h3>
            <div class="box-tools pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                  Quick Filters <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="?date_from=<?php echo date('Y-m-d'); ?>&date_to=<?php echo date('Y-m-d'); ?>">Today</a></li>
                  <li><a href="?date_from=<?php echo date('Y-m-d', strtotime('-7 days')); ?>&date_to=<?php echo date('Y-m-d'); ?>">Last 7 Days</a></li>
                  <li><a href="?date_from=<?php echo date('Y-m-01'); ?>&date_to=<?php echo date('Y-m-t'); ?>">This Month</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <form method="get" class="form-inline">
                  <div class="form-group">
                    <label for="date_from">From:</label>
                    <input type="date" class="form-control input-sm" id="date_from" name="date_from" value="<?php echo isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="date_to">To:</label>
                    <input type="date" class="form-control input-sm" id="date_to" name="date_to" value="<?php echo isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="warehouse">Warehouse:</label>
                    <select class="form-control input-sm" id="warehouse" name="warehouse">
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
                  <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control input-sm" id="status" name="status">
                      <option value="">All</option>
                      <option value="1" <?php echo (isset($filters['status']) && $filters['status'] == '1' ? 'selected' : ''); ?>>Unpaid</option>
                      <option value="2" <?php echo (isset($filters['status']) && $filters['status'] == '2' ? 'selected' : ''); ?>>Paid</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                  <a href="<?php echo base_url('Controller_Reports/sales_report'); ?>" class="btn btn-default btn-sm">Reset</a>
                </form>
              </div>
            </div>

            <hr>

            <div class="row">
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
                    <span class="info-box-number"><?php echo isset($aggregates['avg_order_value']) ? number_format($aggregates['avg_order_value'], 2) : '0.00'; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-percent"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Conversion Rate</span>
                    <span class="info-box-number"><?php echo isset($aggregates['conversion_rate']) ? number_format($aggregates['conversion_rate'], 2) . '%' : 'N/A'; ?></span>
                  </div>
                </div>
              </div>
            </div>

            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Total Items</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                  <th class="no-print">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($report)): ?>
                  <?php foreach ($report as $row): ?>
                    <tr>
                      <td><?php echo isset($row['order_id']) ? htmlspecialchars($row['order_id']) : '-'; ?></td>
                      <td><?php echo isset($row['date']) ? date('Y-m-d H:i', strtotime($row['date'])) : '-'; ?></td>
                      <td><?php echo isset($row['customer']) ? htmlspecialchars($row['customer']) : '-'; ?></td>
                      <td><?php echo isset($row['total_items']) ? number_format($row['total_items'], 0) : 0; ?></td>
                      <td><?php echo isset($row['total']) ? number_format($row['total'], 2) : '0.00'; ?></td>
                      <td>
                        <span class="label label-<?php echo (isset($row['status']) && $row['status'] == '2' ? 'success' : 'danger'); ?>">
                          <?php echo (isset($row['status']) && $row['status'] == '2' ? 'Paid' : 'Unpaid'); ?>
                        </span>
                      </td>
                      <td class="no-print">
                        <button class="btn btn-xs btn-info view-items" 
                                data-orderid="<?php echo isset($row['order_id']) ? htmlspecialchars($row['order_id']) : ''; ?>"
                                data-items='<?php echo isset($row['items']) ? htmlspecialchars(json_encode($row['items']), ENT_QUOTES, 'UTF-8') : '[]'; ?>'>
                          <i class="fa fa-eye"></i> View Items
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="7" class="text-center">No sales data found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>

            <!-- Items tables for printing -->
            <?php if (!empty($report)): ?>
              <?php foreach ($report as $row): ?>
                <div class="items-table-container" data-orderid="<?php echo isset($row['order_id']) ? htmlspecialchars($row['order_id']) : ''; ?>">
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
                      <?php else: ?>
                        <tr><td colspan="4">No items found for this order</td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal -->
<div class="modal fade no-print" id="saleDetailsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Order Details - #<span id="modalOrderId"></span></h4>
      </div>
      <div class="modal-body" id="saleDetailsBody"></div>
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
    console.log('Script execution started');
    
    if (typeof $.fn.DataTable === 'undefined') {
        console.error('DataTables is not loaded!');
        return;
    }

  // Validate table structure
  var thCount = $('#reportTable thead th').length;
  var tdCount = $('#reportTable tbody tr:first-child td').length;
  console.log('Table structure: ' + thCount + ' headers, ' + tdCount + ' columns in first row');

  if (thCount !== tdCount) {
    console.error('Table structure mismatch: headers (' + thCount + ') do not match columns (' + tdCount + ')');
  }

  try {
    // Initialize DataTable
    var table = $('#reportTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'copy',
          text: 'Copy',
          className: 'dt-button',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'csv',
          text: 'CSV',
          title: 'Sales_Report_<?php echo date('Y-m-d'); ?>',
          className: 'dt-button',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          title: 'Sales_Report_<?php echo date('Y-m-d'); ?>',
          className: 'dt-button',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'print',
          text: 'Print',
          title: '',
          className: 'dt-button',
          exportOptions: {
            columns: ':not(:last-child)'
          },
          customize: function(win) {
            console.log('Print button customization called');
            $(win.document.body).prepend(
              '<div class="print-header">' +
              '<h1>Sales Report</h1>' +
              '<p>Generated on: <?php echo date('Y-m-d H:i:s'); ?> EAT</p>' +
              '<p>Period: <?php echo isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : 'N/A'; ?> to ' +
              '<?php echo isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : 'N/A'; ?></p>' +
              '</div>'
            );
            $(win.document.body).append(
              '<div class="print-footer">Generated by System - Page 1 of 1</div>'
            );
            $(win.document.body).find('#reportTable').addClass('compact').css({
              'font-size': '12px',
              'border-collapse': 'collapse',
              'width': '100%'
            });
            $j(win.document.body).find('#reportTable th, #reportTable td').css({
              'border': '1px solid #000',
              'padding': '8px'
            });
            // Append items tables after each row
            $j('#reportTable tbody tr').each(function() {
              var orderId = $j(this).find('.view-items').data('orderid');
              if (orderId) {
                var itemsTable = $j('.items-table-container[data-orderid="' + orderId + '"]').clone();
                itemsTable.css('display', 'block');
                $j(this).after('<tr><td colspan="6">' + itemsTable.prop('outerHTML') + '</td></tr>');
              }
            });
          }
        }
      ],
      order: [[1, 'desc']],
      pageLength: 10,
      lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      pagingType: 'full_numbers',
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search...",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        infoEmpty: "Showing 0 to 0 of 0 entries",
        infoFiltered: "(filtered from _MAX_ total entries)",
        paginate: {
          first: "First",
          last: "Last",
          next: "Next",
          previous: "Previous"
        }
      },
      initComplete: function() {
        console.log('DataTable initialized successfully');
      }
    });
  } catch (e) {
    console.error('DataTable initialization failed:', e);
  }

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
    
    if (items && Array.isArray(items) && items.length > 0) {
      items.forEach(function(item) {
        html += '<tr>';
        html += '<td>' + (item.name ? $('<div/>').text(item.name).html() : 'N/A') + '</td>';
        html += '<td>' + (item.quantity ? parseFloat(item.quantity).toFixed(2) : '0.00') + '</td>';
        html += '<td>' + (item.unit_price ? parseFloat(item.unit_price).toFixed(2) : '0.00') + '</td>';
        html += '<td>' + (item.total ? parseFloat(item.total).toFixed(2) : '0.00') + '</td>';
        html += '</tr>';
      });
    } else {
      html += '<tr><td colspan="4" class="text-center">No items found for this order</td></tr>';
    }
    
    html += '</tbody></table></div>';
    $('#saleDetailsBody').html(html);
    $('#saleDetailsModal').modal('show');
  });
});
</script>