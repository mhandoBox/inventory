<!-- reporting/expense_report.php -->
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
}
.dt-buttons { margin-bottom: 10px; }
.dt-button { margin-right: 5px; }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Expense Report <small>Expense Activity Overview</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports'); ?>">Reports</a></li>
      <li class="active">Expenses</li>
    </ol>
  </section>

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
            <h3 class="box-title">Expense Report</h3>
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
                    <label for="category">Category:</label>
                    <select class="form-control input-sm" id="category" name="category">
                      <option value="">All Categories</option>
                      <option value="Office Supplies" <?php echo (isset($filters['category']) && $filters['category'] == 'Office Supplies' ? 'selected' : ''); ?>>Office Supplies</option>
                      <option value="Travel" <?php echo (isset($filters['category']) && $filters['category'] == 'Travel' ? 'selected' : ''); ?>>Travel</option>
                      <option value="Utilities" <?php echo (isset($filters['category']) && $filters['category'] == 'Utilities' ? 'selected' : ''); ?>>Utilities</option>
                      <option value="Rent" <?php echo (isset($filters['category']) && $filters['category'] == 'Rent' ? 'selected' : ''); ?>>Rent</option>
                      <option value="Salaries" <?php echo (isset($filters['category']) && $filters['category'] == 'Salaries' ? 'selected' : ''); ?>>Salaries</option>
                      <option value="Other" <?php echo (isset($filters['category']) && $filters['category'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                  <a href="<?php echo base_url('Controller_Reports/expense_report'); ?>" class="btn btn-default btn-sm">Reset</a>
                </form>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Expenses</span>
                    <span class="info-box-number"><?php echo isset($aggregates['total_expenses']) ? number_format($aggregates['total_expenses'], 2) : '0.00'; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-blue"><i class="fa fa-list"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Transactions</span>
                    <span class="info-box-number"><?php echo isset($aggregates['total_transactions']) ? number_format($aggregates['total_transactions']) : '0'; ?></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-calculator"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Avg. Expense Value</span>
                    <span class="info-box-number"><?php echo isset($aggregates['avg_expense_value']) ? number_format($aggregates['avg_expense_value'], 2) : '0.00'; ?></span>
                  </div>
                </div>
              </div>
            </div>

            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Recorded By</th>
                  <th class="no-print">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($report)): ?>
                  <?php foreach ($report as $row): ?>
                    <tr>
                      <td><?php echo isset($row['expense_date']) ? date('Y-m-d', strtotime($row['expense_date'])) : '-'; ?></td>
                      <td><?php echo isset($row['amount']) ? number_format($row['amount'], 2) : '0.00'; ?></td>
                      <td><?php echo isset($row['description']) ? htmlspecialchars($row['description']) : '-'; ?></td>
                      <td><?php echo isset($row['category']) ? htmlspecialchars($row['category']) : '-'; ?></td>
                      <td><?php echo isset($row['user_name']) ? htmlspecialchars($row['user_name']) : '-'; ?></td>
                      <td class="no-print">
                        <?php if (in_array('viewExpense', $this->permission)): ?>
                          <button class="btn btn-xs btn-info" onclick="viewFunc(<?php echo htmlspecialchars($row['id']); ?>)" data-toggle="modal" data-target="#viewModal">
                            <i class="fa fa-eye"></i> View
                          </button>
                        <?php endif; ?>
                        <?php if (in_array('updateExpense', $this->permission)): ?>
                          <button class="btn btn-xs btn-default" onclick="editFunc(<?php echo htmlspecialchars($row['id']); ?>)" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-edit"></i> Edit
                          </button>
                        <?php endif; ?>
                        <?php if (in_array('deleteExpense', $this->permission)): ?>
                          <button class="btn btn-xs btn-danger" onclick="removeFunc(<?php echo htmlspecialchars($row['id']); ?>)" data-toggle="modal" data-target="#removeModal">
                            <i class="fa fa-trash"></i> Delete
                          </button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="6" class="text-center">No expense data found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- View expense modal -->
<div class="modal fade no-print" id="viewModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">View Expense</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th>Date</th>
            <td id="view_expense_date"></td>
          </tr>
          <tr>
            <th>Amount</th>
            <td id="view_amount"></td>
          </tr>
          <tr>
            <th>Description</th>
            <td id="view_description"></td>
          </tr>
          <tr>
            <th>Category</th>
            <td id="view_category"></td>
          </tr>
          <tr>
            <th>Recorded By</th>
            <td id="view_user_name"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit expense modal -->
<?php if (in_array('updateExpense', $this->permission)): ?>
<div class="modal fade no-print" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Expense</h4>
      </div>
      <form role="form" action="<?php echo base_url('Controller_Expenses/update') ?>" method="post" id="editForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_expense_date">Date</label>
            <input type="date" class="form-control" id="edit_expense_date" name="expense_date" required>
          </div>
          <div class="form-group">
            <label for="edit_amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="edit_amount" name="amount" required>
          </div>
          <div class="form-group">
            <label for="edit_description">Description</label>
            <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
          </div>
          <div class="form-group">
            <label for="edit_category">Category</label>
            <select class="form-control" id="edit_category" name="category" required>
              <option value="">Select Category</option>
              <option value="Office Supplies">Office Supplies</option>
              <option value="Travel">Travel</option>
              <option value="Utilities">Utilities</option>
              <option value="Rent">Rent</option>
              <option value="Salaries">Salaries</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="edit_user_id">Recorded By</label>
            <input type="text" class="form-control" id="edit_user_id" name="user_id" readonly>
            <input type="hidden" id="edit_user_id_hidden" name="user_id_hidden">
            <input type="hidden" id="edit_expense_id" name="expense_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Expense</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Remove expense modal -->
<?php if (in_array('deleteExpense', $this->permission)): ?>
<div class="modal fade no-print" id="removeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Remove Expense</h4>
      </div>
      <form role="form" action="<?php echo base_url('Controller_Expenses/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script type="text/javascript">
$j(document).ready(function() {
  console.log('Script execution started');
  console.log('jQuery version:', $j.fn.jquery);
  console.log('jQuery UI loaded:', typeof $j.ui !== 'undefined');
  console.log('Bootstrap loaded:', typeof $j.fn.modal !== 'undefined');
  console.log('DataTables loaded:', typeof $j.fn.DataTable !== 'undefined');
  console.log('DataTable initialization started');

  // Validate table structure
  var thCount = $j('#reportTable thead th').length;
  var tdCount = $j('#reportTable tbody tr:first-child td').length;
  console.log('Table structure: ' + thCount + ' headers, ' + tdCount + ' columns in first row');

  if (thCount !== tdCount) {
    console.error('Table structure mismatch: headers (' + thCount + ') do not match columns (' + tdCount + ')');
  }

  try {
    // Initialize DataTable
    var table = $j('#reportTable').DataTable({
      dom: 'Bflrtip',
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
          title: 'Expense_Report_<?php echo date('Y-m-d'); ?>',
          className: 'dt-button',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          title: 'Expense_Report_<?php echo date('Y-m-d'); ?>',
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
            $j(win.document.body).prepend(
              '<div class="print-header">' +
              '<h1>Expense Report</h1>' +
              '<p>Generated on: <?php echo date('Y-m-d H:i:s'); ?> EAT</p>' +
              '<p>Period: <?php echo isset($filters['date_from']) ? htmlspecialchars($filters['date_from']) : 'N/A'; ?> to ' +
              '<?php echo isset($filters['date_to']) ? htmlspecialchars($filters['date_to']) : 'N/A'; ?></p>' +
              '</div>'
            );
            $j(win.document.body).append(
              '<div class="print-footer">Generated by System - Page 1 of 1</div>'
            );
            $j(win.document.body).find('#reportTable').addClass('compact').css({
              'font-size': '12px',
              'border-collapse': 'collapse',
              'width': '100%'
            });
            $j(win.document.body).find('#reportTable th, #reportTable td').css({
              'border': '1px solid #000',
              'padding': '8px'
            });
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
      },
      initComplete: function() {
        console.log('DataTable initialized successfully');
      }
    });
  } catch (e) {
    console.error('DataTable initialization failed:', e);
  }

  // View function
  function viewFunc(id) {
    if (id) {
      $j.ajax({
        url: '<?php echo base_url('Controller_Expenses/view/'); ?>' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.success === true) {
            $j('#view_expense_date').text(response.data.expense_date);
            $j('#view_amount').text(response.data.amount);
            $j('#view_description').text(response.data.description);
            $j('#view_category').text(response.data.category);
            $j('#view_user_name').text(response.data.user_name);
            $j('#viewModal').modal('show');
          } else {
            $j(".content").prepend('<div class="alert alert-error alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
            $j('#viewModal').modal('hide');
          }
        }
      });
    }
  }

  // Edit function
  function editFunc(id) {
    if (id) {
      $j.ajax({
        url: '<?php echo base_url('Controller_Expenses/edit/'); ?>' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.success === true) {
            $j('#edit_expense_date').val(response.data.expense_date);
            $j('#edit_amount').val(response.data.amount);
            $j('#edit_description').val(response.data.description);
            $j('#edit_category').val(response.data.category);
            $j('#edit_user_id').val(response.data.user_name);
            $j('#edit_user_id_hidden').val(response.data.user_id);
            $j('#edit_expense_id').val(response.data.id);
            $j('#editModal').modal('show');
          } else {
            $j(".content").prepend('<div class="alert alert-error alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
            $j('#editModal').modal('hide');
          }
        }
      });
    }
  }

  // Remove function
  function removeFunc(id) {
    if (id) {
      $j("#removeForm").on('submit', function() {
        var form = $j(this);
        $j.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: { expense_id: id },
          dataType: 'json',
          success: function(response) {
            if (response.success === true) {
              $j(".content").prepend('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
              $j("#removeModal").modal('hide');
              window.location.reload(); // Refresh to update table
            } else {
              $j(".content").prepend('<div class="alert alert-error alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+.Language: php
response.messages+
              '</div>');
            }
          }
        });
        return false;
      });
      $j('#removeModal').modal('show');
    }
  }
});
</script>