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
      Edit Expense
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Expenses'); ?>">Expenses</a></li>
      <li class="active">Edit Expense</li>
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

        <?php if(in_array('updateExpense', $user_permission)): ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Update Expense</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="<?php echo base_url('Controller_Expenses/edit/' . $expense['id']) ?>" method="post" id="editForm">
              <div class="form-group">
                <label for="expense_date">Date</label>
                <input type="date" class="form-control" id="expense_date" name="expense_date" value="<?php echo htmlspecialchars($expense['expense_date']); ?>" required>
              </div>
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($expense['description']); ?></textarea>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                  <option value="">Select Category</option>
                  <option value="Office Supplies" <?php echo $expense['category'] == 'Office Supplies' ? 'selected' : ''; ?>>Office Supplies</option>
                  <option value="Travel" <?php echo $expense['category'] == 'Travel' ? 'selected' : ''; ?>>Travel</option>
                  <option value="Utilities" <?php echo $expense['category'] == 'Utilities' ? 'selected' : ''; ?>>Utilities</option>
                  <option value="Rent" <?php echo $expense['category'] == 'Rent' ? 'selected' : ''; ?>>Rent</option>
                  <option value="Salaries" <?php echo $expense['category'] == 'Salaries' ? 'selected' : ''; ?>>Salaries</option>
                  <option value="Other" <?php echo $expense['category'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="user_id">Recorded By</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($expense['user_name'] ?? $this->session->userdata('username')); ?>" readonly>
                <input type="hidden" name="user_id_hidden" value="<?php echo htmlspecialchars($expense['user_id'] ?? $this->session->userdata('id')); ?>">
              </div>
              <button type="submit" class="btn btn-primary">Update Expense</button>
              <a href="<?php echo base_url('Controller_Expenses') ?>" class="btn btn-default">Cancel</a>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php else: ?>
          <div class="alert alert-warning" role="alert">
            <strong>Permission Denied!</strong> You do not have permission to edit expenses.
          </div>
        <?php endif; ?>
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

$j(document).ready(function() {
  $j("#mainExpensesNav").addClass('active');
  $j("#manageExpensesNav").addClass('active');

  // Form submission handling
  $j("#editForm").on('submit', function() {
    var form = $j(this);
    $j(".text-danger").remove();

    $j.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
        if(response.success === true) {
          $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');

          // Redirect to expenses list after successful update
          setTimeout(function() {
            window.location.href = base_url + 'Controller_Expenses';
          }, 2000);
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
});
</script>