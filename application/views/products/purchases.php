<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Purchases <small>View and Add Stock Purchases</small></h1>
    <button type="button" class="btn btn-success" style="margin-bottom:10px;" data-toggle="modal" data-target="#addStockModal">
      <i class="fa fa-plus"></i> Add Purchase
    </button>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Purchase History</h3>
            <div class="row" style="margin-top: 10px;">
              <div class="col-md-4">
                <label for="statusFilter">Filter by Status:</label>
                <select id="statusFilter" class="form-control">
                  <option value="">All</option>
                  <option value="Paid">Paid</option>
                  <option value="Unpaid">Unpaid</option>
                  <option value="Partial">Partial</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="dateFilter">Filter by Date:</label>
                <select id="dateFilter" class="form-control">
                  <option value="">All</option>
                  <option value="today">Today</option>
                  <option value="week">This Week</option>
                  <option value="month">This Month</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <table id="purchasesTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Supplier</th>
                  <th>Supplier No</th>
                  <th>Price per Unit</th>
                  <th>Total Amount</th>
                  <th>Amount Paid</th>
                  <th>Status</th>
                  <th>Purchase Date</th>
                  <th>Current Stock</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Add Purchase Modal -->
  <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="addStockModalLabel">Add Purchase</h4>
        </div>
        <form id="addStockForm" action="<?php echo base_url('Controller_Products/addStock'); ?>" method="post">
          <div class="modal-body">
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <div class="form-group">
              <label for="add_product_id">Product</label>
              <select class="form-control select_group" id="add_product_id" name="product_id" required>
                <option value="">Select Product</option>
                <?php if(isset($products) && !empty($products)): ?>
                  <?php foreach($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>" data-unit="<?php echo isset($product['unit']) ? htmlspecialchars($product['unit']) : ''; ?>">
                      <?php echo htmlspecialchars($product['name']); ?>
                    </option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No products available</option>
                <?php endif; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="add_supplier">Supplier</label>
              <input type="text" class="form-control" id="add_supplier" name="supplier" required>
            </div>
            <div class="form-group">
              <label for="add_supplier_no">Supplier No</label>
              <input type="text" class="form-control" id="add_supplier_no" name="supplier_no" placeholder="Enter supplier number">
            </div>
            <div class="form-group">
              <label for="add_price">Price per Unit</label>
              <input type="number" min="0" step="0.01" class="form-control" id="add_price" name="price" required>
            </div>
            <div class="form-group">
              <label for="add_unit">Unit</label>
              <input type="text" class="form-control" id="add_unit" name="unit" required>
            </div>
            <div class="form-group">
              <label for="add_qty">Quantity</label>
              <input type="number" min="1" max="999999999" class="form-control" id="add_qty" name="qty" required>
            </div>
            <div class="form-group">
              <label for="add_total_amount">Total Amount</label>
              <input type="number" step="0.01" class="form-control" id="add_total_amount" name="total_amount" readonly>
            </div>
            <div class="form-group">
              <label for="add_status">Status</label>
              <select class="form-control" id="add_status" name="status" required>
                <option value="">Select Status</option>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
                <option value="Partial">Partial</option>
              </select>
            </div>
            <div class="form-group" id="add_amount_paid_group" style="display: none;">
              <label for="add_amount_paid">Amount Paid</label>
              <input type="number" step="0.01" min="0" class="form-control" id="add_amount_paid" name="amount_paid" required>
            </div>
            <div class="form-group">
              <label for="add_purchase_date">Purchase Date</label>
              <input type="datetime-local" class="form-control" id="add_purchase_date" name="purchase_date" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Purchase</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Purchase Modal -->
  <div class="modal fade" id="editStockModal" tabindex="-1" role="dialog" aria-labelledby="editStockModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="editStockModalLabel">Edit Purchase</h4>
        </div>
        <form id="editStockForm" action="<?php echo base_url('Controller_Products/updatePurchase'); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" id="edit_purchase_id" name="purchase_id">
            <div class="form-group">
              <label for="edit_product_id">Product</label>
              <select class="form-control select_group" id="edit_product_id" name="product_id" required>
                <option value="">Select Product</option>
                <?php if(isset($products) && !empty($products)): ?>
                  <?php foreach($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>" data-unit="<?php echo isset($product['unit']) ? htmlspecialchars($product['unit']) : ''; ?>">
                      <?php echo htmlspecialchars($product['name']); ?>
                    </option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">No products available</option>
                <?php endif; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="edit_supplier">Supplier</label>
              <input type="text" class="form-control" id="edit_supplier" name="supplier" required>
            </div>
            <div class="form-group">
              <label for="edit_supplier_no">Supplier No</label>
              <input type="text" class="form-control" id="edit_supplier_no" name="supplier_no" placeholder="Enter supplier number">
            </div>
            <div class="form-group">
              <label for="edit_price">Price per Unit</label>
              <input type="number" min="0" step="0.01" class="form-control" id="edit_price" name="price" required>
            </div>
            <div class="form-group">
              <label for="edit_unit">Unit</label>
              <input type="text" class="form-control" id="edit_unit" name="unit" required>
            </div>
            <div class="form-group">
              <label for="edit_qty">Quantity</label>
              <input type="number" min="1" max="999999999" class="form-control" id="edit_qty" name="qty" required>
            </div>
            <div class="form-group">
              <label for="edit_total_amount">Total Amount</label>
              <input type="number" step="0.01" class="form-control" id="edit_total_amount" name="total_amount" readonly>
            </div>
            <div class="form-group">
              <label for="edit_status">Status</label>
              <select class="form-control" id="edit_status" name="status" required>
                <option value="">Select Status</option>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
                <option value="Partial">Partial</option>
              </select>
            </div>
            <div class="form-group" id="edit_amount_paid_group" style="display: none;">
              <label for="edit_amount_paid">Amount Paid</label>
              <input type="number" step="0.01" min="0" class="form-control" id="edit_amount_paid" name="amount_paid">
            </div>
            <div class="form-group">
              <label for="edit_purchase_date">Purchase Date</label>
              <input type="datetime-local" class="form-control" id="edit_purchase_date" name="purchase_date" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Purchase</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
  var purchasesTable = $('#purchasesTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'print'],
    ajax: {
      url: '<?php echo base_url('Controller_Products/fetchPurchasesData'); ?>',
      dataSrc: 'data',
      error: function(xhr, error, thrown) {
        console.error('DataTable AJAX error:', xhr, error, thrown);
        $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Failed to load purchase data: ' + xhr.statusText + ' (Status: ' + xhr.status + ')</div>');
      }
    },
    columns: [
      { data: 'product_name' },
      { 
        data: null, 
        render: function(data, type, row) { 
          return row.qty + ' ' + row.unit; 
        } 
      },
      { data: 'supplier' },
      { data: 'supplier_no' },
      { data: 'price', render: function(data) { return 'TZS ' + data; } },
      { data: 'total_amount', render: function(data) { return 'TZS ' + data; } },
      { data: 'amount_paid', render: function(data) { return 'TZS ' + data; } },
      { data: 'status' },
      { data: 'purchase_date', render: function(data) { return new Date(data).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' }); } },
      { data: 'stock', render: function(data) { return data <= 10 ? '<span class="label label-danger">Low (' + data + ')</span>' : data; } },
      {
        data: null,
        render: function(data, type, row) {
          var buttons = '';
          if (<?php echo in_array('updateProduct', $this->permission) ? 'true' : 'false'; ?>) {
            buttons += '<button class="btn btn-warning btn-sm edit-purchase" data-id="' + row.id + '" data-toggle="modal" data-target="#editStockModal"><i class="fa fa-pencil"></i> Edit</button> ';
          }
          if (<?php echo in_array('deleteProduct', $this->permission) ? 'true' : 'false'; ?>) {
            buttons += '<button class="btn btn-danger btn-sm delete-purchase" data-id="' + row.id + '"><i class="fa fa-trash"></i> Delete</button>';
          }
          return buttons;
        }
      }
    ],
    drawCallback: function(settings) {
      var api = this.api();
      var rows = api.rows({page: 'current'}).data();
      var lowStockProducts = [];

      for (var i = 0; i < rows.length; i++) {
        if (rows[i].stock < 200) {
          lowStockProducts.push(rows[i].product_name + ' (' + rows[i].stock + ' ' + rows[i].unit + ')');
        }
      }

      if (lowStockProducts.length > 0) {
        var message = '<div class="alert alert-warning alert-dismissible" role="alert">' +
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
                      '<strong>Warning!</strong> Low stock detected for: ' + lowStockProducts.join(', ') + '. Please restock soon.' +
                      '</div>';
        $('#messages').html(message);
      } else {
        if ($('#messages').find('.alert-warning').length > 0) {
          $('#messages').empty();
        }
      }
    }
  });

  $('.select_group').select2({ width: '100%' });

  // Auto-set unit based on product selection for Add modal
  $('#add_product_id').on('change', function() {
    var unit = $(this).find(':selected').data('unit');
    $('#add_unit').val(unit ? unit : '');
  });

  // Auto-set unit based on product selection for Edit modal
  $('#edit_product_id').on('change', function() {
    var unit = $(this).find(':selected').data('unit');
    $('#edit_unit').val(unit ? unit : '');
  });

  // Auto-calculate total amount for Add modal
  function calculateAddTotal() {
    var price = parseFloat($('#add_price').val()) || 0;
    var qty = parseInt($('#add_qty').val()) || 0;
    var total = price * qty;
    $('#add_total_amount').val(total.toFixed(2));
    if ($('#add_status').val() === 'Paid') {
      $('#add_amount_paid').val(total.toFixed(2));
    } else if ($('#add_status').val() === 'Partial') {
      $('#add_amount_paid').val(''); // Reset for manual entry
    }
  }

  $('#add_price, #add_qty').on('input', calculateAddTotal);

  // Auto-calculate total amount for Edit modal
  function calculateEditTotal() {
    var price = parseFloat($('#edit_price').val()) || 0;
    var qty = parseInt($('#edit_qty').val()) || 0;
    var total = price * qty;
    $('#edit_total_amount').val(total.toFixed(2));
    if ($('#edit_status').val() === 'Paid') {
      $('#edit_amount_paid').val(total.toFixed(2));
    } else if ($('#edit_status').val() === 'Partial') {
      $('#edit_amount_paid').val(''); // Reset for manual entry
    }
  }

  $('#edit_price, #edit_qty').on('input', calculateEditTotal);

  // Handle status change for Add modal
  $('#add_status').on('change', function() {
    var status = $(this).val();
    if (status === 'Partial') {
      $('#add_amount_paid_group').show();
      $('#add_amount_paid').prop('required', true).val(''); // Show and require, but don't auto-fill
    } else if (status === 'Paid') {
      $('#add_amount_paid_group').hide();
      $('#add_amount_paid').prop('required', false);
      calculateAddTotal(); // Auto-fill total for Paid
    } else {
      $('#add_amount_paid_group').hide();
      $('#add_amount_paid').prop('required', false).val('');
    }
  });

  // Handle status change for Edit modal
  $('#edit_status').on('change', function() {
    var status = $(this).val();
    if (status === 'Partial') {
      $('#edit_amount_paid_group').show();
      $('#edit_amount_paid').prop('required', true).val(''); // Show and require, but don't auto-fill
    } else if (status === 'Paid') {
      $('#edit_amount_paid_group').hide();
      $('#edit_amount_paid').prop('required', false);
      calculateEditTotal(); // Auto-fill total for Paid
    } else {
      $('#edit_amount_paid_group').hide();
      $('#edit_amount_paid').prop('required', false).val('');
    }
  });

  // AJAX form submission for Add modal
  $('#addStockForm').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var formData = form.serialize();
    var price = parseFloat($('#add_price').val()) || 0;
    var qty = parseInt($('#add_qty').val()) || 0;
    var total_amount = parseFloat($('#add_total_amount').val()) || 0;

    if (Math.abs(price * qty - total_amount) > 0.01) {
      $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Total amount does not match price × quantity.</div>');
      return;
    }

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: formData,
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $('#messages').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Success!</strong> ' + response.messages + '</div>');
          $('#addStockModal').modal('hide');
          purchasesTable.ajax.reload(null, false);
          form[0].reset();
          $('#add_unit').val('');
          $('#add_total_amount').val('');
          $('#add_amount_paid_group').hide();
          $('#add_amount_paid').prop('required', false);
          $('#add_status').val('');
        } else {
          $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> ' + response.messages + '</div>');
        }
      },
      error: function(xhr, error, thrown) {
        console.error('Add purchase AJAX error:', xhr, error, thrown);
        $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')</div>');
      }
    });
  });

  // Handle Edit button click
  $('#purchasesTable').on('click', '.edit-purchase', function() {
    var purchaseId = $(this).data('id');
    $.ajax({
      url: '<?php echo base_url('Controller_Products/getPurchaseData'); ?>/' + purchaseId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $('#edit_purchase_id').val(response.data.id);
          $('#edit_product_id').val(response.data.product_id).trigger('change');
          $('#edit_supplier').val(response.data.supplier);
          $('#edit_price').val(response.data.price);
          $('#edit_unit').val(response.data.unit);
          $('#edit_qty').val(response.data.qty);
          $('#edit_total_amount').val(response.data.total_amount);
          $('#edit_status').val(response.data.status).trigger('change');
          $('#edit_amount_paid').val(response.data.amount_paid);
          $('#edit_purchase_date').val(response.data.purchase_date.replace(' ', 'T'));
          $('#editStockModal').modal('show');
        } else {
          $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> ' + response.message + '</div>');
        }
      },
      error: function(xhr, error, thrown) {
        console.error('Edit purchase AJAX error:', xhr, error, thrown);
        $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Failed to load purchase data: ' + xhr.statusText + '</div>');
      }
    });
  });

  // AJAX form submission for Edit modal
  $('#editStockForm').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var formData = form.serialize();
    var price = parseFloat($('#edit_price').val()) || 0;
    var qty = parseInt($('#edit_qty').val()) || 0;
    var total_amount = parseFloat($('#edit_total_amount').val()) || 0;

    if (Math.abs(price * qty - total_amount) > 0.01) {
      $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> Total amount does not match price × quantity.</div>');
      return;
    }

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: formData,
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $('#messages').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Success!</strong> ' + response.messages + '</div>');
          $('#editStockModal').modal('hide');
          purchasesTable.ajax.reload(null, false);
          form[0].reset();
          $('#edit_unit').val('');
          $('#edit_total_amount').val('');
          $('#edit_amount_paid_group').hide();
          $('#edit_amount_paid').prop('required', false);
          $('#edit_status').val('');
        } else {
          $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> ' + response.messages + '</div>');
        }
      },
      error: function(xhr, error, thrown) {
        console.error('Update purchase AJAX error:', xhr, error, thrown);
        $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')</div>');
      }
    });
  });

  // Handle Delete button click
  $('#purchasesTable').on('click', '.delete-purchase', function() {
    var purchaseId = $(this).data('id');
    if (confirm('Are you sure you want to delete this purchase?')) {
      $.ajax({
        url: '<?php echo base_url('Controller_Products/removePurchase'); ?>',
        type: 'POST',
        data: { purchase_id: purchaseId },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            $('#messages').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Success!</strong> ' + response.messages + '</div>');
            purchasesTable.ajax.reload(null, false);
          } else {
            $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> ' + response.messages + '</div>');
          }
        },
        error: function(xhr, error, thrown) {
          console.error('Delete purchase AJAX error:', xhr, error, thrown);
          $('#messages').html('<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')</div>');
        }
      });
    }
  });

  // Status filter
  $('#statusFilter').on('change', function() {
    var status = $(this).val();
    purchasesTable.columns(6).search(status ? status : '', true, false).draw();
  });

  // Date filter
  $('#dateFilter').on('change', function() {
    var filter = $(this).val();
    var now = new Date();
    var startDate;

    if (filter === 'today') {
      startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    } else if (filter === 'week') {
      var firstDay = new Date(now.setDate(now.getDate() - now.getDay()));
      startDate = new Date(firstDay.getFullYear(), firstDay.getMonth(), firstDay.getDate());
    } else if (filter === 'month') {
      startDate = new Date(now.getFullYear(), now.getMonth(), 1);
    } else {
      startDate = null; // All
    }

    if (startDate) {
      purchasesTable.column(7).search(startDate.toISOString().split('T')[0], true, false).draw();
    } else {
      purchasesTable.column(7).search('').draw();
    }
  });
});
</script>