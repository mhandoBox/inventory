<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Income Statement
            <small>Profit & Loss</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_accounting') ?>">Accounting</a></li>
            <li class="active">Income Statement</li>
        </ol>
    </section>

    <section class="content">
        <!-- Date Filter -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Filter Options</h3>
                    </div>
                    <div class="box-body">
                        <form method="get" class="form-inline">
                            <div class="form-group">
                                <label>Period: </label>
                                <select name="period" class="form-control input-sm ml-2" onchange="toggleCustomDates(this.value)">
                                    <option value="custom" <?php echo ($period == 'custom') ? 'selected' : ''; ?>>Custom</option>
                                    <option value="this_month" <?php echo ($period == 'this_month') ? 'selected' : ''; ?>>This Month</option>
                                    <option value="last_month" <?php echo ($period == 'last_month') ? 'selected' : ''; ?>>Last Month</option>
                                    <option value="this_quarter" <?php echo ($period == 'this_quarter') ? 'selected' : ''; ?>>This Quarter</option>
                                    <option value="this_year" <?php echo ($period == 'this_year') ? 'selected' : ''; ?>>This Year</option>
                                    <option value="last_year" <?php echo ($period == 'last_year') ? 'selected' : ''; ?>>Last Year</option>
                                </select>
                            </div>
                            <div id="custom_dates" class="form-group ml-2" <?php echo ($period != 'custom') ? 'style="display:none;"' : ''; ?>>
                                <input type="date" name="start_date" class="form-control input-sm" value="<?php echo $start_date; ?>">
                                <span class="mx-2">to</span>
                                <input type="date" name="end_date" class="form-control input-sm" value="<?php echo $end_date; ?>">
                            </div>
                            <div class="form-group ml-2">
                                <label>Comparison: </label>
                                <select name="comparison" class="form-control input-sm ml-2">
                                    <option value="none" <?php echo ($comparison == 'none') ? 'selected' : ''; ?>>None</option>
                                    <option value="previous_period" <?php echo ($comparison == 'previous_period') ? 'selected' : ''; ?>>Previous Period</option>
                                    <option value="previous_year" <?php echo ($comparison == 'previous_year') ? 'selected' : ''; ?>>Previous Year</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Apply Filter</button>
                            <a href="<?php echo base_url('Controller_accounting/income_statement'); ?>" class="btn btn-default btn-sm ml-2">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Income Statement -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Income Statement</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" onclick="printReport()"><i class="fa fa-print"></i></button>
                            <button type="button" class="btn btn-box-tool" onclick="exportExcel()"><i class="fa fa-file-excel-o"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="incomeStatementTable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="text-right">Current Period</th>
                                        <?php if ($comparison != 'none'): ?>
                                        <th class="text-right">Comparative Period</th>
                                        <th class="text-right">Variance</th>
                                        <th class="text-right">% Change</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Revenue Section -->
                                    <tr class="bg-gray">
                                        <th colspan="<?php echo ($comparison != 'none') ? '5' : '2'; ?>">Revenue</th>
                                    </tr>
                                    <?php foreach ($income_statement['revenue_detail'] as $revenue): ?>
                                    <tr>
                                        <td><?php echo $revenue->account_name; ?></td>
                                        <td class="text-right"><?php echo number_format($revenue->current_amount, 2); ?></td>
                                        <?php if ($comparison != 'none'): ?>
                                        <td class="text-right"><?php echo number_format($revenue->comparative_amount, 2); ?></td>
                                        <td class="text-right"><?php echo number_format($revenue->variance, 2); ?></td>
                                        <td class="text-right <?php echo ($revenue->percent_change >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo number_format($revenue->percent_change, 1); ?>%
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                    <!-- Total Revenue -->
                                    <tr class="bg-info">
                                        <th>Total Revenue</th>
                                        <th class="text-right"><?php echo number_format($income_statement['total_revenue'], 2); ?></th>
                                        <?php if ($comparison != 'none'): ?>
                                        <th class="text-right"><?php echo number_format($income_statement['comparative_revenue'], 2); ?></th>
                                        <th class="text-right"><?php echo number_format($income_statement['revenue_variance'], 2); ?></th>
                                        <th class="text-right <?php echo ($income_statement['revenue_percent_change'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo number_format($income_statement['revenue_percent_change'], 1); ?>%
                                        </th>
                                        <?php endif; ?>
                                    </tr>

                                    <!-- Cost of Sales Section -->
                                    <tr class="bg-gray">
                                        <th colspan="<?php echo ($comparison != 'none') ? '5' : '2'; ?>">Less: Cost of Sales</th>
                                    </tr>
                                    <?php foreach ($income_statement['cos_detail'] as $cos): ?>
                                    <tr>
                                        <td><?php echo $cos->account_name; ?></td>
                                        <td class="text-right"><?php echo number_format($cos->current_amount, 2); ?></td>
                                        <?php if ($comparison != 'none'): ?>
                                        <td class="text-right"><?php echo number_format($cos->comparative_amount, 2); ?></td>
                                        <td class="text-right"><?php echo number_format($cos->variance, 2); ?></td>
                                        <td class="text-right <?php echo ($cos->percent_change <= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo number_format($cos->percent_change, 1); ?>%
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>

                                    <!-- Gross Profit -->
                                    <tr class="bg-success">
                                        <th>Gross Profit</th>
                                        <th class="text-right"><?php echo number_format($income_statement['gross_profit'], 2); ?></th>
                                        <?php if ($comparison != 'none'): ?>
                                        <th class="text-right"><?php echo number_format($income_statement['comparative_gross_profit'], 2); ?></th>
                                        <th class="text-right"><?php echo number_format($income_statement['gross_profit_variance'], 2); ?></th>
                                        <th class="text-right <?php echo ($income_statement['gross_profit_percent_change'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo number_format($income_statement['gross_profit_percent_change'], 1); ?>%
                                        </th>
                                        <?php endif; ?>
                                    </tr>

                                    <!-- Operating Expenses -->
                                    <tr class="bg-gray">
                                        <th colspan="<?php echo ($comparison != 'none') ? '5' : '2'; ?>">Less: Operating Expenses</th>
                                    </tr>
                                    <?php foreach ($income_statement['expense_detail'] as $expense): ?>
                                    <tr>
                                        <td><?php echo $expense->account_name; ?></td>
                                        <td class="text-right"><?php echo number_format($expense->current_amount, 2); ?></td>
                                        <?php if ($comparison != 'none'): ?>
                                        <td class="text-right"><?php echo number_format($expense->comparative_amount, 2); ?></td>
                                        <td class="text-right"><?php echo number_format($expense->variance, 2); ?></td>
                                        <td class="text-right <?php echo ($expense->percent_change <= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo number_format($expense->percent_change, 1); ?>%
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>

                                    <!-- Net Income -->
                                    <tr class="bg-primary">
                                        <th>Net Income</th>
                                        <th class="text-right"><?php echo number_format($income_statement['net_profit'], 2); ?></th>
                                        <?php if ($comparison != 'none'): ?>
                                        <th class="text-right"><?php echo number_format($income_statement['comparative_net_profit'], 2); ?></th>
                                        <th class="text-right"><?php echo number_format($income_statement['net_profit_variance'], 2); ?></th>
                                        <th class="text-right <?php echo ($income_statement['net_profit_percent_change'] >= 0) ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo number_format($income_statement['net_profit_percent_change'], 1); ?>%
                                        </th>
                                        <?php endif; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Financial Ratios -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Financial Ratios</h3>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Gross Profit Margin</th>
                                                <td class="text-right">
                                                    <?php echo number_format($income_statement['gross_profit_margin'], 1); ?>%
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Operating Expense Ratio</th>
                                                <td class="text-right">
                                                    <?php echo number_format($income_statement['operating_expense_ratio'], 1); ?>%
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Net Profit Margin</th>
                                                <td class="text-right">
                                                    <?php echo number_format($income_statement['net_profit_margin'], 1); ?>%
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Performance Indicators</h3>
                                    </div>
                                    <div class="box-body">
                                        <canvas id="performanceChart" height="200"></canvas>
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

<script type="text/javascript">
$(document).ready(function() {
    // Initialize DataTable
    $('#incomeStatementTable').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Income Statement - <?php echo date('Y-m-d', strtotime($end_date)); ?>',
                className: 'hidden'
            },
            {
                extend: 'print',
                title: 'Income Statement',
                className: 'hidden',
                customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<div class="text-center"><h3>Company Name</h3>' +
                            '<h4>Income Statement</h4>' +
                            '<h5>For the period <?php echo date('F d, Y', strtotime($start_date)); ?> to <?php echo date('F d, Y', strtotime($end_date)); ?></h5></div>'
                        );
                }
            }
        ]
    });

    // Performance Chart
    var ctx = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($income_statement['monthly_labels']); ?>,
            datasets: [{
                label: 'Revenue',
                data: <?php echo json_encode($income_statement['monthly_revenue']); ?>,
                borderColor: 'rgba(60, 141, 188, 1)',
                fill: false
            },
            {
                label: 'Expenses',
                data: <?php echo json_encode($income_statement['monthly_expenses']); ?>,
                borderColor: 'rgba(210, 214, 222, 1)',
                fill: false
            },
            {
                label: 'Net Income',
                data: <?php echo json_encode($income_statement['monthly_profit']); ?>,
                borderColor: 'rgba(0, 166, 90, 1)',
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return formatMoney(value);
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return data.datasets[tooltipItem.datasetIndex].label + ': ' + formatMoney(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
});

function toggleCustomDates(value) {
    if (value === 'custom') {
        $('#custom_dates').show();
    } else {
        $('#custom_dates').hide();
    }
}

function printReport() {
    $('.buttons-print').click();
}

function exportExcel() {
    $('.buttons-excel').click();
}

function formatMoney(amount) {
    return 'TZS ' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}
</script>

<style>
.mt-4 {
    margin-top: 20px;
}
.ml-2 {
    margin-left: 10px;
}
.mx-2 {
    margin: 0 10px;
}
.hidden {
    display: none;
}
.text-success {
    color: #00a65a;
}
.text-danger {
    color: #dd4b39;
}
</style>