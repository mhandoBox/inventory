```php
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Sales Report <small>Sales Activity Overview</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports'); ?>">Reports</a></li>
      <li class="active">Sales</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo $this->session->flashdata('error'); ?>
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
                    <input type="date" class="form-control input-sm" id="date_from" name="date_from" value="<?php echo isset($filters['date_from']) ? $filters['date_from'] : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="date_to">To:</label>
                    <input type="date" class="form-control input-sm" id="date_to" name="date_to" value="<?php echo isset($filters['date_to']) ? $filters['date_to'] : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="customer">Customer:</label>
                    <select class="form-control input-sm" id="customer" name="customer">
                      <option value="">All Customers</option>
                      <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer['id']; ?>" <?php echo (isset($filters['customer']) && $filters['customer'] == $customer['id'] ? 'selected' : ''); ?>>
                          <?php echo $customer['name']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control input-sm" id="status" name="status">
                      <option value="">All</option>
                      <option value="1" <?php echo (isset($filters['status']) && $filters['status'] == '1' ? 'selected' : ''); ?>>Unpaid</option>
                      <option value="0" <?php echo (isset($filters['status']) && $filters['status'] == '0' ? 'selected' : ''); ?>>Paid</option>
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
                    <span class="info-box-number"><?php echo isset($aggregates['total_items']) ? number_format($aggregates['total_items']) : '0'; ?></span>
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
                    <span class="info-box-number"><?php echo isset($aggregates['conversion_rate']) ? number_format($aggregates['conversion_rate'], 2).'%' : 'N/A'; ?></span>
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
                  <th>Items</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($report)): ?>
                  <?php foreach ($report as $row): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                      <td><?php echo date('Y-m-d H:i', strtotime($row['date'])); ?></td>
                      <td><?php echo htmlspecialchars($row['customer']); ?></td>
                      <td><?php echo count($row['items'] ?? []); ?></td>
                      <td><?php echo number_format($row['total'], 2); ?></td>
                      <td>
                        <span class="label label-<?php echo ($row['status'] == 'Paid' ? 'success' : 'danger'); ?>">
                          <?php echo ucfirst($row['status']); ?>
                        </span>
                      </td>
                      <td>
                        <button class="btn btn-xs btn-info view-items" 
                          data-orderid="<?php echo htmlspecialchars($row['order_id']); ?>"
                          data-items='<?php echo htmlspecialchars(json_encode($row['items'] ?? []), ENT_QUOTES, 'UTF-8'); ?>'>
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal -->
<div class="modal fade" id="saleDetailsModal" tabindex="-1" role="dialog">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript">
$j(document).ready(function() {
  // Initialize DataTable
  var table = $j('#reportTable').DataTable({
    dom: 'Blfrtip',
    buttons: [
      'copy', 
      {
        extend: 'csv',
        title: 'Sales_Report_<?php echo date('Y-m-d'); ?>',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'excel',
        title: 'Sales_Report_<?php echo date('Y-m-d'); ?>',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'print',
        title: 'Sales Report - <?php echo date('Y-m-d'); ?>',
        exportOptions: {
          columns: ':not(:last-child)'
        },
        customize: function (win) {
          $(win.document.body).find('h1').css('text-align','center');
          $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
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
    }
  });

  // Show sale details modal
  $j(document).on('click', '.view-items', function() {
    var orderId = $j(this).data('orderid');
    var items = $j(this).data('items');
    
    $j('#modalOrderId').text(orderId);
    
    var html = '<div class="table-responsive"><table class="table table-bordered">';
    html += '<thead><tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead><tbody>';
    
    if (items && items.length > 0) {
      items.forEach(function(item) {
        html += '<tr>';
        html += '<td>' + (item.name || '') + '</td>';
        html += '<td>' + (item.quantity || 0) + '</td>';
        html += '<td>' + parseFloat(item.unit_price || 0).toFixed(2) + '</td>';
        html += '<td>' + parseFloat(item.total || 0).toFixed(2) + '</td>';
        html += '</tr>';
      });
    } else {
      html += '<tr><td colspan="4" class="text-center">No item data available</td></tr>';
    }
    
    html += '</tbody></table></div>';
    $j('#saleDetailsBody').html(html);
    $j('#saleDetailsModal').modal('show');
  });
});
</script>
```