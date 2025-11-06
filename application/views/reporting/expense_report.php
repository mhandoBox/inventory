<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Expense Report</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
            <li class="active">Expenses</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <form id="expenseFilters" class="form-inline">
                            <div class="form-group">
                                <label>Date from</label>
                                <input type="date" id="date_from" class="form-control" name="date_from" 
                                       value="<?php echo htmlspecialchars($filters['date_from'] ?? ''); ?>">
                            </div>
                            <div class="form-group" style="margin-left:8px;">
                                <label>Date to</label>
                                <input type="date" id="date_to" class="form-control" name="date_to"
                                       value="<?php echo htmlspecialchars($filters['date_to'] ?? ''); ?>">
                            </div>
                            <?php if(!empty($stores)): ?>
                            <div class="form-group" style="margin-left:8px;">
                                <label>Store/Warehouse</label>
                                <select id="storeFilter" class="form-control" name="store">
                                    <option value="">All Locations</option>
                                    <?php foreach($stores as $store): ?>
                                        <option value="<?php echo $store['id']; ?>">
                                            <?php echo htmlspecialchars($store['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <button type="button" id="applyFilters" class="btn btn-primary" style="margin-left:8px;">
                                Apply
                            </button>
                            <button type="button" id="clearFilters" class="btn btn-default" style="margin-left:6px;">
                                Clear
                            </button>
                        </form>
                    </div>

                    <div class="box-body">
                        <table id="expenseTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Category</th>
                                    <th>Store</th>
                                    <th>Description</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function() {
    var table = $('#expenseTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo site_url("Controller_Reports/expense_report_data"); ?>',
            type: 'POST',
            data: function(d) {
                return $.extend({}, d, {
                    date_from: $('#date_from').val(),
                    date_to: $('#date_to').val(),
                    store: $('#storeFilter').val()
                });
            }
        },
        columns: [
            { data: 'date' },
            { data: 'reference' },
            { data: 'category' },
            { data: 'store' },
            { data: 'description' },
            { 
                data: 'amount',
                className: 'text-right',
                render: function(data) {
                    return parseFloat(data).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>"
    });

    $('#applyFilters').on('click', function() {
        table.ajax.reload();
    });

    $('#clearFilters').on('click', function() {
        $('#date_from,#date_to,#storeFilter').val('');
        table.ajax.reload();
    });
});
</script>