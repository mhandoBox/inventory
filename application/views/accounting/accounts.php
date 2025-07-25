<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Account Management
            <small>Accounting</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('accounting') ?>">Accounting</a></li>
            <li class="active">Account Management</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($this->session->userdata('user_permission')): ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Accounts</h3>
                            <?php if(in_array('createAccount', $user_permission)): ?>
                            <div class="box-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAccountModal">
                                    <i class="fa fa-plus"></i> Add New Account
                                </button>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body table-responsive">
                            <table id="accountsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Account Code</th>
                                        <th>Account Name</th>
                                        <th>Category</th>
                                        <th>Normal Balance</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <?php if(in_array('updateAccount', $user_permission) || in_array('deleteAccount', $user_permission)): ?>
                                        <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($accounts as $account): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($account->account_code) ?></td>
                                        <td><?php echo htmlspecialchars($account->account_name) ?></td>
                                        <td><?php echo htmlspecialchars($account->category) ?></td>
                                        <td><?php echo htmlspecialchars($account->normal_balance) ?></td>
                                        <td><?php echo htmlspecialchars($account->description) ?></td>
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
                                            <button type="button" class="btn btn-default btn-xs" onclick="editAccount(<?php echo $account->id ?>)">
                                                <i class="fa fa-edit"></i>
                                            </button>
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

<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Add New Account</h4>
            </div>
            <form id="addAccountForm" action="<?php echo base_url('accounting/add_account') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Account Code</label>
                        <input type="text" class="form-control" name="account_code" required>
                    </div>
                    <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" name="account_name" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Asset">Asset</option>
                            <option value="Liability">Liability</option>
                            <option value="Equity">Equity</option>
                            <option value="Revenue">Revenue</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Normal Balance</label>
                        <select class="form-control" name="normal_balance" required>
                            <option value="">Select Normal Balance</option>
                            <option value="Debit">Debit</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Initialize DataTable
    $('#accountsTable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false
    });
});

function editAccount(id) {
    // Load account details and show edit modal
    $.ajax({
        url: '<?php echo base_url('accounting/get_account/') ?>' + id,
        type: 'GET',
        success: function(response) {
            // Populate edit form with account details
            // Show edit modal
        },
        error: function() {
            alert('Error loading account details');
        }
    });
}

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
