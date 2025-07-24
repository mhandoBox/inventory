<?php
// Assuming PHP opening tag and necessary PHP logic is already present
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Expenses
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Expenses</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createExpense', $user_permission)): ?>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Expense</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Recorded By</th>
                  <?php if(in_array('updateExpense', $user_permission) || in_array('viewExpense', $user_permission) || in_array('deleteExpense', $user_permission)): ?>
                    <th>Actions</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('createExpense', $user_permission)): ?>
<!-- Add expense modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Add Expense</h4>
      </div>
      <form role="form" action="<?php echo base_url('Controller_Expenses/create') ?>" method="post" id="addForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="add_expense_date">Date</label>
            <input type="date" class="form-control" id="add_expense_date" name="expense_date" required>
          </div>
          <div class="form-group">
            <label for="add_amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="add_amount" name="amount" required>
          </div>
          <div class="form-group">
            <label for="add_description">Description</label>
            <textarea class="form-control" id="add_description" name="description" rows="4" required></textarea>
          </div>
          <div class="form-group">
            <label for="add_category">Category</label>
            <select class="form-control" id="add_category" name="category" required>
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
            <label for="add_user_id">Recorded By</label>
            <input type="text" class="form-control" id="add_user_id" name="user_id" value="<?php echo htmlspecialchars($this->session->userdata('username')); ?>" readonly>
            <input type="hidden" id="add_user_id_hidden" name="user_id_hidden" value="<?php echo htmlspecialchars($this->session->userdata('id')); ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Expense</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('viewExpense', $user_permission)): ?>
<!-- View expense modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewModal">
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
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateExpense', $user_permission)): ?>
<!-- Edit expense modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
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
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteExpense', $user_permission)): ?>
<!-- Remove expense modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
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
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$j(document).ready(function() {
  $j("#mainExpensesNav").addClass('active');
  $j("#manageExpensesNav").addClass('active');

  // Initialize the datatable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'Controller_Expenses/fetchExpensesData',
    'order': [],
    'columns': [
      { 'data': 'expense_date' },
      { 'data': 'amount' },
      { 'data': 'description' },
      { 'data': 'category' },
      { 'data': 'user_name' },
      { 'data': 'actions', 'orderable': false }
    ]
  });

  // Reset add form when modal is closed
  $j('#addModal').on('hidden.bs.modal', function() {
    $j('#addForm')[0].reset();
    $j('#add_user_id').val("<?php echo htmlspecialchars($this->session->userdata('username')); ?>");
    $j('#add_user_id_hidden').val("<?php echo htmlspecialchars($this->session->userdata('id')); ?>");
    $j('#add_category').val('');
  });
});

// Add function
$j("#addForm").on('submit', function() {
  var form = $j(this);
  $j(".text-danger").remove();

  $j.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success: function(response) {
      if (response.success === true) {
        $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
        '</div>');
        $j("#addModal").modal('hide');
        // Refresh the entire page after a short delay to show the success message
        setTimeout(function() {
          window.location.reload();
        }, 1000);
      } else {
        $j("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">'+
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
          '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
        '</div>');
      }
    }
  });
  return false;
});

// View function
function viewFunc(id) {
  if (id) {
    $j.ajax({
      url: base_url + 'Controller_Expenses/view/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.success === true) {
          $j('#view_expense_date').text(response.data.expense_date);
          $j('#view_amount').text(response.data.amount);
          $j('#view_description').text(response.data.description);
          $j('#view_category').text(response.data.category);
          $j('#view_user_name').text(response.data.user_name);
        } else {
          $j("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">'+
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
      url: base_url + 'Controller_Expenses/edit/' + id,
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
        } else {
          $j("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
          '</div>');
          $j('#editModal').modal('hide');
        }
      }
    });
  }
}

// Update function
$j("#editForm").on('submit', function() {
  var form = $j(this);
  $j(".text-danger").remove();

  $j.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    dataType: 'json',
    success: function(response) {
      if (response.success === true) {
        $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
        '</div>');
        $j("#editModal").modal('hide');
        manageTable.ajax.reload(null, false);
      } else {
        $j("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">'+
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
          '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
        '</div>');
      }
    }
  });
  return false;
});

// Remove function
function removeFunc(id) {
  if (id) {
    $j("#removeForm").on('submit', function() {
      var form = $j(this);
      $j(".text-danger").remove();

      $j.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { expense_id: id },
        dataType: 'json',
        success: function(response) {
          manageTable.ajax.reload(null, false);

          if (response.success === true) {
            $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            $j("#removeModal").modal('hide');
          } else {
            $j("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      });
      return false;
    });
  }
}
</script>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>