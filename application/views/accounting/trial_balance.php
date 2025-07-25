<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style>
@media print {
    body { font-family: Arial, sans-serif; }
    .no-print { display: none; }
    .content-wrapper { margin: 0; padding: 0; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
    .print-header { text-align: center; margin-bottom: 20px; }
    .print-footer { text-align: center; margin-top: 20px; font-size: 10px; }
    .box-header, .breadcrumb, .btn { display: none; }
    .table-bordered>thead>tr>th, 
    .table-bordered>tbody>tr>td { border: 1px solid #000 !important; }
}
.dt-buttons { margin-bottom: 10px; }
.dt-button { margin-right: 5px; }
.box-tools form { margin-bottom: 0; }
.text-right { text-align: right !important; }
.table>tfoot>tr>th { font-weight: bold; }
.bg-gray { background-color: #f9f9f9; }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trial Balance
            <small>Financial Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('accounting') ?>">Accounting</a></li>
            <li class="active">Trial Balance</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($this->session->userdata('user_permission')): ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Trial Balance Report</h3>
                        <div class="box-tools">
                            <form method="get" class="form-inline">
                                <div class="form-group">
                                    <label>From: </label>
                                    <input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date) ?>" class="form-control input-sm">
                                </div>
                                <div class="form-group" style="margin-left: 10px;">
                                    <label>To: </label>
                                    <input type="date" name="end_date" value="<?php echo htmlspecialchars($end_date) ?>" class="form-control input-sm">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 10px;">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="<?php echo base_url('accounting/trial_balance') ?>" class="btn btn-default btn-sm">
                                    <i class="fa fa-refresh"></i> Reset
                                </a>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <?php if (empty($trial_balance['accounts'])): ?>
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> No transactions found for the selected period.
                            </div>
                        <?php else: ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">Account Code</th>
                                        <th style="width: 25%">Account Name</th>
                                        <th style="width: 15%">Category</th>
                                        <th style="width: 10%">Normal Balance</th>
                                        <th style="width: 13%" class="text-right">Total Debit</th>
                                        <th style="width: 13%" class="text-right">Total Credit</th>
                                        <th style="width: 14%" class="text-right">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($trial_balance['accounts'] as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['account_code']) ?></td>
                                        <td><?php echo htmlspecialchars($row['account_name']) ?></td>
                                        <td><?php echo htmlspecialchars($row['category']) ?></td>
                                        <td><?php echo htmlspecialchars($row['normal_balance']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['total_debit'] ?? 0, 2) ?></td>
                                        <td class="text-right"><?php echo number_format($row['total_credit'] ?? 0, 2) ?></td>
                                        <td class="text-right"><?php echo number_format($row['balance'] ?? 0, 2) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray">
                                        <th colspan="4" class="text-right">Totals</th>
                                        <th class="text-right"><?php echo number_format($trial_balance['totals']['total_debit'] ?? 0, 2) ?></th>
                                        <th class="text-right"><?php echo number_format($trial_balance['totals']['total_credit'] ?? 0, 2) ?></th>
                                        <th class="text-right"></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="text-center text-muted" style="margin-top: 20px;">
                                <strong><i class="fa fa-calendar"></i> Period:</strong> 
                                <?php echo htmlspecialchars($display_start_date) ?> to <?php echo htmlspecialchars($display_end_date) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-body -->

                    <?php if (!empty($trial_balance['accounts'])): ?>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button onclick="window.print();" class="btn btn-default">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <a href="<?php echo base_url('accounting/export_trial_balance?' . http_build_query(['start_date' => $start_date, 'end_date' => $end_date])) ?>" 
                               class="btn btn-success">
                                <i class="fa fa-file-excel-o"></i> Export to Excel
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <?php endif; ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
    // Menu Activation
    $("#accountingMainMenu").addClass('active');
    $("#trialBalanceSubMenu").addClass('active');
    
    // Initialize DataTable
    var table = $('.table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fa fa-copy"></i> Copy',
                className: 'btn btn-default btn-sm',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-success btn-sm',
                title: 'Trial Balance - <?php echo date("Y-m-d"); ?>',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                className: 'btn btn-default btn-sm',
                title: '',
                exportOptions: {
                    columns: ':not(:last-child)'
                },
                customize: function(win) {
                    $(win.document.body).prepend(
                        '<div class="print-header">' +
                        '<h3>Company Name</h3>' +
                        '<h4>Trial Balance</h4>' +
                        '<h5>Period: <?php echo $display_start_date; ?> to <?php echo $display_end_date; ?></h5>' +
                        '</div>'
                    );
                    
                    // Styling
                    $(win.document.body).css('font-size', '10pt');
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
        pageLength: 50,
        order: [[0, 'asc']],
        responsive: true,
        searching: true,
        paging: true,
        info: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        }
    });

    // Print button in box-footer
    $('#printBtn').on('click', function() {
        $('.buttons-print').click();
    });

    // Excel export in box-footer
    $('#exportBtn').on('click', function() {
        $('.buttons-excel').click();
    });
});
</script>
