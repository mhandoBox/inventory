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
              <!-- Sales Metrics -->
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="fa fa-money"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Sales Revenue</span>
                    <span class="info-box-number"><?= number_format($general['total_revenue'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      Orders: <?= number_format($general['total_orders'] ?? 0) ?>
                    </span>
                  </div>
                </div>
              </div>
              
              <!-- Purchase Metrics -->
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-red">
                  <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Purchases</span>
                    <span class="info-box-number"><?= number_format($general['total_purchases'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      Items: <?= number_format($general['total_items_purchased'] ?? 0) ?>
                    </span>
                  </div>
                </div>
              </div>
              
              <!-- Expense Metrics -->
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-yellow">
                  <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Expenses</span>
                    <span class="info-box-number"><?= number_format($general['total_expenses'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <?= number_format($general['expense_ratio'] ?? 0, 2) ?>% of Revenue
                    </span>
                  </div>
                </div>
              </div>
              
              <!-- Net Profit Metrics -->
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-blue">
                  <span class="info-box-icon"><i class="fa fa-line-chart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Net Profit</span>
                    <span class="info-box-number"><?= number_format($general['net_profit'] ?? 0, 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      Margin: <?= number_format($general['profit_margin'] ?? 0, 2) ?>%
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
                <!-- Sales Metrics -->
                <tr>
                  <td>Total Sales Revenue</td>
                  <td><?= number_format($general['total_revenue'] ?? 0, 2) ?></td>
                  <td>100%</td>
                  <td><?= number_format($general['sales_growth'] ?? 0, 2) ?>%</td>
                </tr>
                <tr>
                  <td>Number of Sales Orders</td>
                  <td><?= number_format($general['total_orders'] ?? 0) ?></td>
                  <td>N/A</td>
                  <td><?= number_format($general['orders_growth'] ?? 0, 2) ?>%</td>
                </tr>
                
                <!-- Purchase Metrics -->
                <tr>
                  <td>Total Purchases</td>
                  <td><?= number_format($general['total_purchases'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['total_purchases'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><?= number_format($general['purchases_growth'] ?? 0, 2) ?>%</td>
                </tr>
                <tr>
                  <td>Items Purchased</td>
                  <td><?= number_format($general['total_items_purchased'] ?? 0) ?></td>
                  <td>N/A</td>
                  <td><?= number_format($general['items_growth'] ?? 0, 2) ?>%</td>
                </tr>
                
                <!-- Expense Metrics -->
                <tr>
                  <td>Total Expenses</td>
                  <td><?= number_format($general['total_expenses'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['total_expenses'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><?= number_format($general['expenses_growth'] ?? 0, 2) ?>%</td>
                </tr>
                <tr>
                  <td>Operating Expenses</td>
                  <td><?= number_format($general['operating_expenses'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['operating_expenses'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><?= number_format($general['opex_growth'] ?? 0, 2) ?>%</td>
                </tr>
                
                <!-- Profitability Metrics -->
                <tr>
                  <td>Gross Profit</td>
                  <td><?= number_format($general['gross_profit'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['gross_profit'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><?= number_format($general['gross_profit_growth'] ?? 0, 2) ?>%</td>
                </tr>
                <tr>
                  <td>Net Profit</td>
                  <td><?= number_format($general['net_profit'] ?? 0, 2) ?></td>
                  <td><?= $general['total_revenue'] > 0 ? number_format(($general['net_profit'] / $general['total_revenue']) * 100, 2) . '%' : '0%' ?></td>
                  <td><?= number_format($general['net_profit_growth'] ?? 0, 2) ?>%</td>
                </tr>
                
                <!-- Inventory Metrics -->
                <tr>
                  <td>Inventory Value</td>
                  <td><?= number_format($general['inventory_value'] ?? 0, 2) ?></td>
                  <td>N/A</td>
                  <td><?= number_format($general['inventory_growth'] ?? 0, 2) ?>%</td>
                </tr>
                <tr>
                  <td>Inventory Turnover Rate</td>
                  <td><?= number_format($general['turnover_rate'] ?? 0, 2) ?></td>
                  <td>N/A</td>
                  <td><?= number_format($general['turnover_change'] ?? 0, 2) ?>%</td>
                </tr>
              </tbody>
            </table>

            <div class="row">
              <!-- Financial Overview Chart -->
              <div class="col-md-6">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Financial Overview</h3>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="financialOverviewChart" style="height: 250px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Monthly Trends Chart -->
              <div class="col-md-6">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Monthly Trends</h3>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="monthlyTrendsChart" style="height: 250px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Additional Charts Row -->
            <div class="row">
              <!-- Expense Breakdown Chart -->
              <div class="col-md-6">
                <div class="box box-warning">
                  <div class="box-header with-border">
                    <h3 class="box-title">Expense Breakdown</h3>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="expenseBreakdownChart" style="height: 250px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Inventory Analysis Chart -->
              <div class="col-md-6">
                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Inventory Analysis</h3>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="inventoryAnalysisChart" style="height: 250px;"></canvas>
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
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
<!-- JVectorMap CSS -->
<link rel="stylesheet" href="https://unpkg.com/jvectormap@2.0.4/jquery-jvectormap.css" type="text/css" media="screen"/>
<!-- Required Scripts -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://unpkg.com/jvectormap@2.0.4/jquery-jvectormap.min.js"></script>
<script src="https://unpkg.com/jvectormap@2.0.4/jquery-jvectormap-world-mill.js"></script>
<script src="<?php echo base_url('assets/js/vector-map-init.js'); ?>"></script>
<script type="text/javascript">
$j(document).ready(function() {
  // Wait for DataTables to load
  setTimeout(function() {
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

  // Financial Overview Chart
  var financialCtx = document.getElementById('financialOverviewChart').getContext('2d');
  var financialOverviewChart = new Chart(financialCtx, {
    type: 'bar',
    data: {
      labels: ['Sales', 'Purchases', 'Expenses', 'Net Profit'],
      datasets: [{
        label: 'Current Period',
        data: [
          <?= $general['total_revenue'] ?? 0 ?>,
          <?= $general['total_purchases'] ?? 0 ?>,
          <?= $general['total_expenses'] ?? 0 ?>,
          <?= $general['net_profit'] ?? 0 ?>
        ],
        backgroundColor: [
          'rgba(75, 192, 192, 0.6)',
          'rgba(255, 99, 132, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(54, 162, 235, 0.6)'
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value, index, values) {
              if (value >= 1000000) {
                return 'TZS ' + (value / 1000000).toFixed(1) + 'M';
              } else if (value >= 1000) {
                return 'TZS ' + (value / 1000).toFixed(1) + 'K';
              }
              return 'TZS ' + value;
            }
          }
        }]
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var label = data.datasets[tooltipItem.datasetIndex].label || '';
            if (label) {
              label += ': ';
            }
            var value = tooltipItem.yLabel;
            if (value >= 1000000) {
              label += 'TZS ' + (value / 1000000).toFixed(2) + 'M';
            } else if (value >= 1000) {
              label += 'TZS ' + (value / 1000).toFixed(2) + 'K';
            } else {
              label += 'TZS ' + value.toFixed(2);
            }
            return label;
          }
        }
      }
    }
  });

  // Monthly Trends Chart
  var trendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
  var monthlyTrendsChart = new Chart(trendsCtx, {
    type: 'line',
    data: {
      labels: <?= json_encode($general['months'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) ?>,
      datasets: [{
        label: 'Sales',
        data: <?= json_encode($general['monthly_sales'] ?? []) ?>,
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.1)',
        fill: true,
        lineTension: 0.4
      },
      {
        label: 'Expenses',
        data: <?= json_encode($general['monthly_expenses'] ?? []) ?>,
        borderColor: 'rgba(255, 99, 132, 1)',
        backgroundColor: 'rgba(255, 99, 132, 0.1)',
        fill: true,
        lineTension: 0.4
      },
      {
        label: 'Profit',
        data: <?= json_encode($general['monthly_profit'] ?? []) ?>,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.1)',
        fill: true,
        lineTension: 0.4
      }]
    },
    options: {
      responsive: true,
      animation: {
        duration: 1000,
        easing: 'easeInOutQuart'
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value, index, values) {
              if (value >= 1000000) {
                return 'TZS ' + (value / 1000000).toFixed(1) + 'M';
              } else if (value >= 1000) {
                return 'TZS ' + (value / 1000).toFixed(1) + 'K';
              }
              return 'TZS ' + value;
            }
          }
        }],
        xAxes: [{
          gridLines: {
            display: false
          }
        }]
      },
      tooltips: {
        intersect: false,
        mode: 'index',
        callbacks: {
          label: function(tooltipItem, data) {
            var label = data.datasets[tooltipItem.datasetIndex].label || '';
            if (label) {
              label += ': ';
            }
            var value = tooltipItem.yLabel;
            if (value >= 1000000) {
              label += 'TZS ' + (value / 1000000).toFixed(2) + 'M';
            } else if (value >= 1000) {
              label += 'TZS ' + (value / 1000).toFixed(2) + 'K';
            } else {
              label += 'TZS ' + value.toFixed(2);
            }
            return label;
          }
        }
      }
    }
  });

  // Expense Breakdown Chart
  var expenseCtx = document.getElementById('expenseBreakdownChart').getContext('2d');
  var expenseBreakdownChart = new Chart(expenseCtx, {
    type: 'pie',
    data: {
      labels: <?= json_encode($general['expense_categories'] ?? ['Operating', 'Purchases', 'Other']) ?>,
      datasets: [{
        data: <?= json_encode($general['expense_amounts'] ?? []) ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)'
        ]
      }]
    },
    options: {
      responsive: true
    }
  });

  // Inventory Analysis Chart
  var inventoryCtx = document.getElementById('inventoryAnalysisChart').getContext('2d');
  var inventoryAnalysisChart = new Chart(inventoryCtx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($general['inventory_categories'] ?? ['Raw Materials', 'Work in Progress', 'Finished Goods']) ?>,
      datasets: [{
        label: 'Value',
        data: <?= json_encode($general['inventory_values'] ?? []) ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.6)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      },
      {
        label: 'Turnover Rate',
        data: <?= json_encode($general['inventory_turnover_rates'] ?? []) ?>,
        backgroundColor: 'rgba(255, 206, 86, 0.6)',
        borderColor: 'rgba(255, 206, 86, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
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