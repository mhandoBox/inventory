<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chart of Accounts
            <small>Accounting</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('accounting') ?>">Accounting</a></li>
            <li class="active">Chart of Accounts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($this->session->userdata('user_permission')): ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Chart of Accounts</h3>
                            <?php if(in_array('createAccount', $user_permission)): ?>
                            <div class="box-tools">
                                <a href="<?php echo base_url('accounting/add_account') ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New Account
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body table-responsive">
                            <?php foreach(['Asset', 'Liability', 'Equity', 'Revenue', 'Expense'] as $category): ?>
                                <?php if(isset($accounts[$category]) && !empty($accounts[$category])): ?>
                                    <h4><?php echo $category; ?></h4>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">Account Code</th>
                                                <th style="width: 35%">Account Name</th>
                                                <th style="width: 20%">Normal Balance</th>
                                                <th style="width: 15%">Status</th>
                                                <?php if(in_array('updateAccount', $user_permission) || in_array('deleteAccount', $user_permission)): ?>
                                                <th style="width: 15%">Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($accounts[$category] as $account): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($account->account_code) ?></td>
                                                <td><?php echo htmlspecialchars($account->account_name) ?></td>
                                                <td><?php echo htmlspecialchars($account->normal_balance) ?></td>
                                                <td>
                                                    <?php if($account->status == 1): ?>
                                                        <span class="label label-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="label label-default">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if(in_array('updateAccount', $user_permission) || in_array('deleteAccount', $user_permission)): ?>
                                                <td>
                                                    <?php if(in_array('updateAccount', $user_permission)): ?>
                                                    <a href="<?php echo base_url('accounting/edit_account/'.$account->id) ?>" class="btn btn-default btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                    <?php if(in_array('deleteAccount', $user_permission)): ?>
                                                    <button type="button" class="btn btn-danger btn-xs" onclick="deleteAccount(<?php echo $account->id ?>)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <?php endif; ?>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.box-body -->
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

<script type="text/javascript">
function deleteAccount(id) {
    if(confirm('Are you sure you want to delete this account?')) {
        $.ajax({
            url: '<?php echo base_url('accounting/delete_account/') ?>' + id,
            type: 'DELETE',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert('Error deleting account');
                }
            },
            error: function() {
                alert('Error deleting account');
            }
        });
    }
}
</script>
