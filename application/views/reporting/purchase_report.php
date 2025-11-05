<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Purchase/Stock Additions Report
      <small>Stock Activity Overview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
      <li class="active">Purchases</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Filter Report</h3>
          </div>
          <div class="box-body">
            <form id="filterForm" action="<?php echo base_url('Controller_Reports/purchase_report'); ?>" method="GET">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="date_from">Date From</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" value="<?php echo htmlspecialchars($filters['date_from'] ?? ''); ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="date_to">Date To</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo htmlspecialchars($filters['date_to'] ?? ''); ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="product">Product</label>
                    <select class="form-control" id="product" name="product">
                      <option value="">All Products</option>
                      <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['id']; ?>" <?php echo ($filters['product'] == $product['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($product['name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="warehouse">Warehouse</label>
                    <select class="form-control" id="warehouse" name="warehouse">
                      <option value="">All Warehouses</option>
                      <?php foreach ($warehouses as $warehouse): ?>
                        <option value="<?php echo $warehouse['id']; ?>" <?php echo ($filters['warehouse'] == $warehouse['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($warehouse['name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                      <option value="">All Statuses</option>
                      <option value="Paid" <?php echo ($filters['status'] == 'Paid') ? 'selected' : ''; ?>>Paid</option>
                      <option value="Unpaid" <?php echo ($filters['status'] == 'Unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                      <option value="Partial" <?php echo ($filters['status'] == 'Partial') ? 'selected' : ''; ?>>Partial</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select class="form-control" id="supplier" name="supplier">
                      <option value="">All Suppliers</option>
                      <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?php echo htmlspecialchars($supplier); ?>" <?php echo ($filters['supplier'] == $supplier) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($supplier); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="period">Period</label>
                    <select class="form-control" id="period" name="period">
                      <option value="">Custom</option>
                      <option value="today" <?php echo ($filters['period'] == 'today') ? 'selected' : ''; ?>>Today</option>
                      <option value="this_week" <?php echo ($filters['period'] == 'this_week') ? 'selected' : ''; ?>>This Week</option>
                      <option value="this_month" <?php echo ($filters['period'] == 'this_month') ? 'selected' : ''; ?>>This Month</option>
                      <option value="last_30_days" <?php echo ($filters['period'] == 'last_30_days') ? 'selected' : ''; ?>>Last 30 Days</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group" style="margin-top: 25px;">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="<?php echo base_url('Controller_Reports/purchase_report'); ?>" class="btn btn-default">Reset</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Purchase Report</h3>
            <div class="box-tools pull-right">
              <a href="<?php echo base_url('Controller_Reports/export/purchases/csv'); ?>" class="btn btn-success btn-sm">
                <i class="fa fa-download"></i> Export to CSV
              </a>
              <a href="<?php echo base_url('Controller_Reports/export/purchases/pdf'); ?>" class="btn btn-success btn-sm">
                <i class="fa fa-file-pdf-o"></i> Export to PDF
              </a>
            </div>
          </div>
          <div class="box-body">
            <?php log_message('debug', 'Report Data Before Rendering: ' . json_encode($report)); ?>
            <?php if (empty($report) || !is_array($report)): ?>
              <div class="alert alert-warning">
                No purchase data found for the selected filters:
                <?php
                $filter_summary = [];
                if (!empty($filters['date_from'])) $filter_summary[] = "Date From: " . htmlspecialchars($filters['date_from']);
                if (!empty($filters['date_to'])) $filter_summary[] = "Date To: " . htmlspecialchars($filters['date_to']);
                if (!empty($filters['product'])) $filter_summary[] = "Product ID: " . htmlspecialchars($filters['product']);
                if (!empty($filters['warehouse'])) $filter_summary[] = "Warehouse ID: " . htmlspecialchars($filters['warehouse']);
                if (!empty($filters['status'])) $filter_summary[] = "Status: " . htmlspecialchars($filters['status']);
                if (!empty($filters['supplier'])) $filter_summary[] = "Supplier: " . htmlspecialchars($filters['supplier']);
                echo implode(', ', $filter_summary) ?: 'No specific filters applied';
                ?>. Please adjust the filters or add purchase records.
              </div>
            <?php else: ?>
              <table id="reportTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Contact</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($report as $purchase): ?>
                    <tr>
                      <td><?php echo date('Y-m-d', strtotime($purchase['purchase_date'] ?? 'now')); ?></td>
                      <td><?php echo htmlspecialchars($purchase['supplier'] ?? 'Unknown'); ?></td>
                      <td><?php echo htmlspecialchars($purchase['supplier_no'] ?? 'N/A'); ?></td>
                      <td><?php echo htmlspecialchars($purchase['product_name'] ?? 'Unknown'); ?></td>
                      <td><?php echo number_format($purchase['qty'] ?? 0, 2); ?></td>
                      <td><?php echo htmlspecialchars($purchase['unit'] ?? ''); ?></td>
                      <td><?php echo number_format($purchase['price'] ?? 0, 2); ?></td>
                      <td><?php echo number_format($purchase['total_amount'] ?? 0, 2); ?></td>
                      <td><?php echo number_format($purchase['amount_paid'] ?? 0, 2); ?></td>
                      <td>
                        <span class="label label-<?php 
                          echo ($purchase['status'] ?? '') == 'Paid' ? 'success' : 
                              (($purchase['status'] ?? '') == 'Partial' ? 'warning' : 'danger'); 
                        ?>">
                          <?php echo htmlspecialchars($purchase['status'] ?? 'Unknown'); ?>
                        </span>
                      </td>
                      <td>
                        <button type="button" 
                                class="btn btn-xs btn-primary" 
                                onclick="editPurchase(<?php echo $purchase['id'] ?? 0; ?>)">
                          Edit
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4">Totals</th>
                    <th><?php echo number_format(array_sum(array_column($report, 'qty') ?? [0]), 2); ?></th>
                    <th></th>
                    <th></th>
                    <th><?php echo number_format($summary['total_amount'] ?? 0, 2); ?></th>
                    <th><?php echo number_format($summary['total_paid'] ?? 0, 2); ?></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Purchase</h4>
            </div>
            <div class="modal-body">
                <form id="editPurchaseForm">
                    <input type="hidden" id="edit_purchase_id" name="id">
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">Unpaid</option>
                            <option value="Partial">Partial</option>
                        </select>
                    </div>
                    <div class="form-group" id="amount_paid_group" style="display:none;">
                        <label for="edit_amount_paid">Amount Paid</label>
                        <input type="number" 
                               class="form-control" 
                               id="edit_amount_paid" 
                               name="amount_paid" 
                               step="0.01" 
                               min="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePurchase()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script>
// Define BASE_URL and jQuery noConflict
var BASE_URL = '<?php echo base_url(); ?>';
var $j = jQuery.noConflict(true);

$j(document).ready(function() {
    // Debug database connection
    console.log('Debug Info:', {
        dbConnected: <?php echo json_encode($this->db->conn_id ? true : false); ?>,
        filters: <?php echo json_encode($filters ?? []); ?>,
        reportData: <?php echo json_encode($report ?? []); ?>,
        summary: <?php echo json_encode($summary ?? []); ?>
    });
    
    // Initialize DataTable only once
    try {
        const table = $j('#reportTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            pageLength: 10,
            responsive: true,
            initComplete: function(settings, json) {
                console.log('DataTable initialized with data:', {
                    recordsTotal: settings._iRecordsTotal,
                    recordsDisplay: settings._iRecordsDisplay
                });
            }
        });
        console.log('DataTable successfully initialized');
    } catch (e) {
        console.error('Error initializing DataTable:', e);
    }

    // Handle status change in edit modal
    $j('#edit_status').change(function() {
        $j('#amount_paid_group').toggle($j(this).val() === 'Partial');
    });

    // Handle period selection
    $j('#period').on('change', function() {
        var period = $j(this).val();
        var dateFrom = $j('#date_from');
        var dateTo = $j('#date_to');
        
        // Reset dates if period is empty (Custom selected)
        if (!period) {
            dateFrom.val('');
            dateTo.val('');
            return;
        }

        var today = new Date();
        var fromDate = new Date();
        
        switch(period) {
            case 'today':
                fromDate = today;
                break;
                
            case 'this_week':
                // Set to Monday of current week
                fromDate.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? -6 : 1));
                break;
                
            case 'this_month':
                // Set to first day of current month
                fromDate.setDate(1);
                break;
                
            case 'last_30_days':
                // Set to 30 days ago
                fromDate.setDate(today.getDate() - 29);
                break;
        }

        // Format dates for input fields (YYYY-MM-DD)
        dateFrom.val(formatDate(fromDate));
        dateTo.val(formatDate(today));
        
        // Trigger form submission
        $j('#filterForm').submit();
    });

    // Helper function to format date as YYYY-MM-DD
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    // Disable date inputs when period is selected
    $j('#period').on('change', function() {
        var isCustom = !$j(this).val();
        $j('#date_from, #date_to').prop('disabled', !isCustom);
    });

    // Enable date inputs when custom is selected
    if (!$j('#period').val()) {
        $j('#date_from, #date_to').prop('disabled', false);
    } else {
        $j('#date_from, #date_to').prop('disabled', true);
    }
});

// Edit purchase function
function editPurchase(id) {
    $j.ajax({
        url: BASE_URL + 'Controller_Reports/getPurchaseData/' + id,
        type: 'GET',
        success: function(response) {
            try {
                var data = JSON.parse(response);
                $j('#edit_purchase_id').val(data.id);
                $j('#edit_status').val(data.status);
                $j('#edit_amount_paid').val(data.amount_paid);
                $j('#amount_paid_group').toggle(data.status === 'Partial');
                $j('#editModal').modal('show');
            } catch (e) {
                console.error('Error parsing purchase data:', e);
                alert('Error loading purchase data');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Error fetching purchase data: ' + error);
        }
    });
}

// Save purchase function
function savePurchase() {
    var formData = $j('#editPurchaseForm').serialize();
    $j.ajax({
        url: BASE_URL + 'Controller_Reports/updatePurchase',
        type: 'POST',
        data: formData,
        success: function(response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    $j('#editModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error updating purchase: ' + result.message);
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                alert('Error updating purchase');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Error updating purchase: ' + error);
        }
    });
}
</script>