<!-- reporting/general_report.php -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>

<div class="content-wrapper">
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

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">General Business Metrics</h3>
            <div class="box-tools pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                  Quick Filters <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="?date_from=<?= date('Y-m-d') ?>&date_to=<?= date('Y-m-d') ?>">Today</a></li>
                  <li><a href="?date_from=<?= date('Y-m-d', strtotime('-7 days')) ?>&date_to=<?= date('Y-m-d') ?>">Last 7 Days</a></li>
                  <li><a href="?date_from=<?= date('Y-m-01') ?>&date_to=<?= date('Y-m-t') ?>">This Month</a></li>
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
                    <input type="date" class="form-control input-sm" id="date_from" name="date_from" value="<?= $filters['date_from'] ?? '' ?>">
                  </div>
                  <div class="form-group">
                    <label for="date_to">To:</label>
                    <input type="date" class="form-control input-sm" id="date_to" name="date_to" value="<?= $filters['date_to'] ?? '' ?>">
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                  <a href="<?= base_url('Controller_Reports/general_report') ?>" class="btn btn-default btn-sm">Reset</a>
                </form>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="fa fa-money"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number"><?= number_format($general['total_revenue'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <?= isset($general['revenue_change']) ? ($general['revenue_change'] >= 0 ? '+' : '') . number_format($general['revenue_change'], 2) . '% vs previous period' : '' ?>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-red">
                  <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Cost</span>
                    <span class="info-box-number"><?= number_format($general['total_cost'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <?= isset($general['cost_change']) ? ($general['cost_change'] >= 0 ? '+' : '') . number_format($general['cost_change'], 2) . '% vs previous period' : '' ?>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-blue">
                  <span class="info-box-icon"><i class="fa fa-line-chart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Gross Profit</span>
                    <span class="info-box-number"><?= number_format($general['gross_profit'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <?= isset($general['profit_change']) ? ($general['profit_change'] >= 0 ? '+' : '') . number_format($general['profit_change'], 2) . '% vs previous period' : '' ?>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-yellow">
                  <span class="info-box-icon"><i class="fa fa-refresh"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Turnover Rate</span>
                    <span class="info-box-number"><?= number_format($general['turnover_rate'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <?= isset($general['turnover_change']) ? ($general['turnover_change'] >= 0 ? '+' : '') . number_format($general['turnover_change'], 2) . '% vs previous period' : '' ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Metric</th>
                  <th>Value</th>
                  <th>% of Revenue</th>
                  <th>Trend</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Total Revenue</td>
                  <td><?= number_format($general['total_revenue'] ?? 0, 2) ?></td>
                  <td>100%</td>
                  <td><!-- Sparkline would go here --></td>
                </tr>
                <tr>
                  <td>Total Cost</td>
                  <td><?= number_format($general['total_cost'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['total_cost'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><!-- Sparkline would go here --></td>
                </tr>
                <tr>
                  <td>Gross Profit</td>
                  <td><?= number_format($general['gross_profit'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['gross_profit'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><!-- Sparkline would go here --></td>
                </tr>
                <tr>
                  <td>Profit Margin</td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['gross_profit'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td>N/A</td>
                  <td><!-- Sparkline would go here --></td>
                </tr>
                <tr>
                  <td>Inventory Turnover Rate</td>
                  <td><?= number_format($general['turnover_rate'] ?? 0, 2) ?></td>
                  <td>N/A</td>
                  <td><!-- Sparkline would go here --></td>
                </tr>
              </tbody>
            </table>

            <div class="row">
              <div class="col-md-6">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Revenue vs Cost</h3>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="revenueCostChart" style="height: 250px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Profit Trend</h3>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="profitTrendChart" style="height: 250px;"></canvas>
                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script type="text/javascript">
$j(document).ready(function() {
  // Initialize DataTable
  $j('#reportTable').DataTable({
    dom: 'Blfrtip',
    buttons: [
      'copy', 
      {
        extend: 'csv',
        title: 'General_Report_<?= date('Y-m-d') ?>'
      },
      {
        extend: 'excel',
        title: 'General_Report_<?= date('Y-m-d') ?>'
      },
      {
        extend: 'print',
        title: 'General Report - <?= date('Y-m-d') ?>',
        customize: function (win) {
          $(win.document.body).find('h1').css('text-align','center');
          $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
        }
      }
    ],
    order: [],
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

  // Revenue vs Cost Chart
  var revenueCostCtx = document.getElementById('revenueCostChart').getContext('2d');
  var revenueCostChart = new Chart(revenueCostCtx, {
    type: 'bar',
    data: {
      labels: ['Revenue', 'Cost', 'Profit'],
      datasets: [{
        label: 'Amount',
        data: [
          <?= $general['total_revenue'] ?? 0 ?>,
          <?= $general['total_cost'] ?? 0 ?>,
          <?= $general['gross_profit'] ?? 0 ?>
        ],
        backgroundColor: [
          'rgba(75, 192, 192, 0.6)',
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)'
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  // Profit Trend Chart (example with dummy data)
  var profitTrendCtx = document.getElementById('profitTrendChart').getContext('2d');
  var profitTrendChart = new Chart(profitTrendCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Profit Trend',
        data: [12000, 19000, 15000, 20000, 18000, 22000],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 2,
        fill: true
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
});
</script>