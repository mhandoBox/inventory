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
      View Expense
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Expenses'); ?>">Expenses</a></li>
      <li class="active">View Expense</li>
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

        <?php if(in_array('viewExpense', $user_permission)): ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Expense Details</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th>Date</th>
                <td><?php echo htmlspecialchars($expense['expense_date']); ?></td>
              </tr>
              <tr>
                <th>Amount</th>
                <td><?php echo htmlspecialchars($currency . ' ' . number_format($expense['amount'], 2)); ?></td>
              </tr>
              <tr>
                <th>Description</th>
                <td><?php echo htmlspecialchars($expense['description']); ?></td>
              </tr>
              <tr>
                <th>Category</th>
                <td><?php echo htmlspecialchars($expense['category']); ?></td>
              </tr>
              <tr>
                <th>Recorded By</th>
                <td><?php echo htmlspecialchars($expense['user_name'] ?? 'Unknown'); ?></td>
              </tr>
            </table>
            <a href="<?php echo base_url('Controller_Expenses') ?>" class="btn btn-default">Back to Expenses</a>
            <?php if(in_array('updateExpense', $user_permission)): ?>
              <a href="<?php echo base_url('Controller_Expenses/edit/' . $expense['id']) ?>" class="btn btn-primary">Edit Expense</a>
            <?php endif; ?>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php else: ?>
          <div class="alert alert-warning" role="alert">
            <strong>Permission Denied!</strong> You do not have permission to view expenses.
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
});
</script>