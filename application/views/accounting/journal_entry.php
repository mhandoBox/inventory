<div class="content-wrapper">
    <section class="content-header">
        <h1>Journal Entry</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_accounting') ?>">Accounting</a></li>
            <li class="active">Journal Entry</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Journal Entry</h3>
                    </div>
                    
                    <form action="<?php echo base_url('Controller_accounting/save_journal_entry') ?>" method="post" class="form-horizontal">
                        <div class="box-body">
                            <?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                            <?php endif; ?>
                            
                            <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-4">
                                    <input type="date" name="entry_date" class="form-control" value="<?php echo set_value('entry_date', date('Y-m-d')); ?>" required>
                                </div>
                                
                                <label class="col-sm-2 control-label">Reference No</label>
                                <div class="col-sm-4">
                                    <input type="text" name="reference_no" class="form-control" value="<?php echo set_value('reference_no'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Module</label>
                                <div class="col-sm-4">
                                    <select name="module" class="form-control">
                                        <option value="Manual">Manual Entry</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Purchase">Purchase</option>
                                        <option value="Expense">Expense</option>
                                    </select>
                                </div>
                                
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-4">
                                    <input type="text" name="description" class="form-control" value="<?php echo set_value('description'); ?>" required>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="journal_lines">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Description</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="account_id[]" class="form-control" required>
                                                    <option value="">Select Account</option>
                                                    <?php foreach($accounts as $account): ?>
                                                        <option value="<?php echo $account->id; ?>"><?php echo $account->account_code . ' - ' . $account->account_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td><input type="text" name="line_description[]" class="form-control"></td>
                                            <td><input type="number" name="debit[]" class="form-control debit" step="0.01" min="0"></td>
                                            <td><input type="number" name="credit[]" class="form-control credit" step="0.01" min="0"></td>
                                            <td><button type="button" class="btn btn-danger btn-sm remove-line"><i class="fa fa-times"></i></button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right"><strong>Total</strong></td>
                                            <td><span id="total_debit">0.00</span></td>
                                            <td><span id="total_credit">0.00</span></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <button type="button" class="btn btn-info" id="add_line"><i class="fa fa-plus"></i> Add Line</button>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Save Journal Entry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Add new line
    $('#add_line').click(function() {
        var newLine = $('#journal_lines tbody tr:first').clone();
        newLine.find('input').val('');
        $('#journal_lines tbody').append(newLine);
    });

    // Remove line
    $(document).on('click', '.remove-line', function() {
        if ($('#journal_lines tbody tr').length > 1) {
            $(this).closest('tr').remove();
            calculateTotals();
        }
    });

    // Calculate totals
    $(document).on('input', '.debit, .credit', function() {
        calculateTotals();
    });

    function calculateTotals() {
        var totalDebit = 0;
        var totalCredit = 0;

        $('.debit').each(function() {
            totalDebit += parseFloat($(this).val() || 0);
        });

        $('.credit').each(function() {
            totalCredit += parseFloat($(this).val() || 0);
        });

        $('#total_debit').text(totalDebit.toFixed(2));
        $('#total_credit').text(totalCredit.toFixed(2));

        // Highlight totals if they don't match
        if (totalDebit != totalCredit) {
            $('#total_debit, #total_credit').css('color', 'red');
        } else {
            $('#total_debit, #total_credit').css('color', 'black');
        }
    }
});
</script>
