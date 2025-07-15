<!-- reporting/general_report.php -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      General Business Metrics
      <small>High-Level Business Overview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
      <li class="active">General</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">General Business Metrics</h3>
          </div>
          <div class="box-body">
            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Total Revenue</th>
                  <th>Total Stock Cost</th>
                  <th>Gross Profit</th>
                  <th>Inventory Turnover Rate</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo isset($general['total_revenue']) ? number_format($general['total_revenue'], 2) : '0.00'; ?></td>
                  <td><?php echo isset($general['total_cost']) ? number_format($general['total_cost'], 2) : '0.00'; ?></td>
                  <td><?php echo isset($general['gross_profit']) ? number_format($general['gross_profit'], 2) : '0.00'; ?></td>
                  <td><?php echo isset($general['turnover_rate']) ? number_format($general['turnover_rate'], 2) : '0.00'; ?></td>
                </tr>
              </tbody>
            </table>
                      <script type="text/javascript">
                      $j(document).ready(function() {
                        $j('#reportTable').DataTable({
                          dom: 'Bfrtip',
                          buttons: ['copy', 'csv', 'excel', 'print'],
                          order: [],
                          pageLength: 10,
                          lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                          pagingType: 'simple_numbers'
                        });
                      });
                      </script>
            <hr>
            <div class="alert alert-info">
              <strong>Note:</strong> This report combines sales and stock data for a high-level business overview.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>