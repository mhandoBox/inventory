```php
<!-- reporting/purchase_report.php -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Purchase/Stock Additions Report
      <small>Stock Activity Overview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
      <li class="active">Purchases</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Purchase/Stock Additions Report</h3>
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
                    <label for="product">Product:</label>
                    <select class="form-control input-sm" id="product" name="product">
                      <option value="">All Products</option>
                      <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                          <option value="<?php echo htmlspecialchars($product['id']); ?>" <?php echo (isset($filters['product']) && $filters['product'] == $product['id'] ? 'selected' : ''); ?>>
                            <?php echo htmlspecialchars($product['name']); ?>
                          </option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                  <a href="<?php echo base_url('Controller_Reports/purchase_report'); ?>" class="btn btn-default btn-sm">Reset</a>
                </form>
              </div>
            </div>

            <hr>

            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Unit Cost</th>
                  <th>Total Cost</th>
                  <th>Source</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($report)): ?>
                  <?php foreach ($report as $row): ?>
                    <tr>
                      <td><?php echo isset($row['date']) ? date('Y-m-d H:i', strtotime($row['date'])) : '-'; ?></td>
                      <td><?php echo isset($row['product']) ? htmlspecialchars($row['product']) : '-'; ?></td>
                      <td><?php echo isset($row['quantity']) ? number_format($row['quantity']) : '0'; ?></td>
                      <td><?php echo isset($row['unit_cost']) ? number_format($row['unit_cost'], 2) : '0.00'; ?></td>
                      <td><?php echo isset($row['total_cost']) ? number_format($row['total_cost'], 2) : '0.00'; ?></td>
                      <td><?php echo isset($row['source']) ? htmlspecialchars($row['source']) : '-'; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="6" class="text-center">No purchase/stock data found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>

            <hr>

            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-blue"><i class="fa fa-cubes"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Opening Stock</span>
                    <span class="info-box-number"><?php echo isset($summary['opening']) ? number_format($summary['opening']) : '0'; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-plus-circle"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Additions</span>
                    <span class="info-box-number"><?php echo isset($summary['additions']) ? number_format($summary['additions']) : '0'; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-minus-circle"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Reductions</span>
                    <span class="info-box-number"><?php echo isset($summary['reductions']) ? number_format($summary['reductions']) : '0'; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-cube"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Closing Stock</span>
                    <span class="info-box-number"><?php echo isset($summary['closing']) ? number_format($summary['closing']) : '0'; ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript">
$j(document).ready(function() {
  $j('#reportTable').DataTable({
    dom: 'Blfrtip',
    buttons: [
      'copy', 
      {
        extend: 'csv',
        title: 'Purchase_Report_<?php echo date('Y-m-d'); ?>'
      },
      {
        extend: 'excel',
        title: 'Purchase_Report_<?php echo date('Y-m-d'); ?>'
      },
      {
        extend: 'print',
        title: 'Purchase Report - <?php echo date('Y-m-d'); ?>',
        customize: function (win) {
          $(win.document.body).find('h1').css('text-align', 'center');
          $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
        }
      }
    ],
    order: [[0, 'desc']],
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
});
</script>
```