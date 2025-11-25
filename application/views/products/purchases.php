<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Ensure $stores exists to avoid undefined variable warnings when controller doesn't provide it
if (!isset($stores) || !is_array($stores)) {
  $stores = array();
}
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
              <!-- Update the store filter section -->
              <?php if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2): ?>
              <div class="col-md-4">
                  <label for="storeFilter">Filter by Store:</label>
                  <select id="storeFilter" class="form-control">
                      <option value="">All Stores</option>
                      <?php foreach($stores as $store): ?>
                          <option value="<?php echo $store['id']; ?>">
                              <?php echo htmlspecialchars($store['name']); ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="box-body">
            <table id="purchasesTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Supplier</th>
                  <th>Supplier Phone</th>
                  <th>Date</th>
                  <?php if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2): ?>
                  <th>Store</th>
                  <?php endif; ?>
                  <th>Quantity</th>
                  <th>Price per Unit</th>
                  <th>Total Amount</th>
                  <th>Actions</th>
                </tr>
              </thead>
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
          <h4 class="modal-title" id="addStockModalLabel">Add Purchases (Multiple)</h4>
        </div>
        <form id="addStockForm" action="<?php echo site_url('Controller_Products/addStock'); ?>" method="post">
          <div class="modal-body">
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-6">
                <label for="purchase_date_global"><strong>Purchase Date</strong></label>
                <input type="datetime-local" class="form-control" id="purchase_date_global" name="purchase_date_global" value="<?php echo date('Y-m-d\\TH:i'); ?>" required>
              </div>
                <div class="col-md-6">
                <label for="store_id_global"><strong>Store</strong></label>
                  <select class="form-control" id="store_id_global" name="store_id_global" required>
                    <option value="">Select Store</option>
                    <?php foreach($stores as $store): ?>
                      <option value="<?php echo $store['id']; ?>"><?php echo htmlspecialchars($store['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                  <script>
                    // Debug: log stores passed from PHP to the view
                    try { console.log('DEBUG: stores from PHP ->', <?php echo json_encode($stores, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>); } catch(e) {}
                  </script>
              </div>
            </div>
            <div class="order-products">
              <div class="product-header d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <h4 class="mb-0">Products</h4>
                <button type="button" id="addRowBtn" class="btn btn-primary" title="Add Product"><i class="fa fa-plus"></i></button>
              </div>
              <div class="table-responsive">
                <table class="table table-condensed" id="purchase_info_table">
                  <thead>
                    <tr>
                      <th style="width:40%">Product</th>
                      <th style="width:15%">Supplier</th>
                      <th style="width:15%" class="text-center">Qty</th>
                      <th style="width:15%" class="text-right">Price</th>
                      <th style="width:10%" class="text-right">Total</th>
                      <th style="width:5%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="prow_1">
                      <td style="position: relative;">
                        <select class="form-control product" data-row-id="1" id="product_1" name="purchases[0][product_id]" style="width:100%;" required>
                          <option value="">Select Product</option>
                          <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['id']; ?>" data-price="<?php echo $product['price']; ?>" data-unit="<?php echo $product['unit']; ?>">
                              <?php echo $product['name']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <input type="text" id="supplier_1" name="purchases[0][supplier]" class="form-control supplier-input" placeholder="Supplier name">
                      </td>
                      <td>
                        <input type="number" name="purchases[0][qty]" id="qty_1" class="form-control qty-input" value="1" min="1" required>
                      </td>
                      <td>
                        <input type="number" name="purchases[0][price]" id="price_1" class="form-control text-right price-input" step="0.01" min="0" required>
                      </td>
                      <td>
                        <input type="number" name="purchases[0][total_amount]" id="total_1" class="form-control text-right total-amount-input" step="0.01" readonly>
                      </td>
                      <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-row" data-row="1"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </tbody>
                  <!-- hidden template row for cloning -->
                  <tbody id="purchase_row_template" style="display:none">
                    <tr id="prow___ID_INDEX__">
                      <td style="position: relative;">
                        <select class="form-control product" data-row-id="__ID_INDEX__" id="product___ID_INDEX__" name="purchases[__NAME_INDEX__][product_id]" style="width:100%;" disabled>
                       <option value="">Select Product</option>
                       <?php foreach ($products as $product): ?>
                         <option value="<?php echo $product['id']; ?>" data-price="<?php echo $product['price']; ?>" data-unit="<?php echo $product['unit']; ?>">
                           <?php echo $product['name']; ?>
                         </option>
                       <?php endforeach; ?>
                     </select>
                   </td>
                      <td>
                        <input type="text" id="supplier___ID_INDEX__" name="purchases[__NAME_INDEX__][supplier]" class="form-control supplier-input" placeholder="Supplier name" disabled>
                      </td>
                      <td>
                        <input type="number" name="purchases[__NAME_INDEX__][qty]" id="qty___ID_INDEX__" class="form-control qty-input" value="1" min="1" disabled>
                      </td>
                      <td>
                        <input type="number" name="purchases[__NAME_INDEX__][price]" id="price___ID_INDEX__" class="form-control text-right price-input" step="0.01" min="0" disabled>
                      </td>
                      <td>
                        <input type="number" name="purchases[__NAME_INDEX__][total_amount]" id="total___ID_INDEX__" class="form-control text-right total-amount-input" step="0.01" readonly disabled>
                      </td>
                      <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-row" data-row="__ID_INDEX__"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row" style="margin-top:10px;">
              <div class="col-md-12 text-right">
                <strong>Total: <span id="grandTotal">0.00</span></strong>
              </div>
            </div>
            </div>
          </div>
          <div class="row" style="margin-top:10px;">
            <div class="col-md-12 text-right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Purchases</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Load JS/CSS libraries before inline scripts so $ is defined -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

  <script>
  $(function() {
  let purchaseIndex = 1;

  // Add select2 for product search
  function applySelect2() {
    $('#purchase_info_table tbody').first().find('.product').select2({
      dropdownParent: $('#addStockModal'),
      width: '100%',
      placeholder: 'Select Product'
    });
  }
  applySelect2();

  // Add new row (use hidden template)
  $('#addRowBtn').on('click', function() {
    // compute next index based on visible rows in the first tbody only
    const visibleRows = $('#purchase_info_table tbody').first().find('tr').length;
    const nameIndex = visibleRows; // zero-based index for form names
    const idIndex = visibleRows + 1; // 1-based index for DOM ids to keep them unique
    const tpl = $('#purchase_row_template').html();
    const newHtml = tpl.replace(/__NAME_INDEX__/g, nameIndex).replace(/__ID_INDEX__/g, idIndex);
    $('#purchase_info_table tbody').first().append(newHtml);
    const $last = $('#purchase_info_table tbody').first().find('tr').last();
    // enable inputs/selects that were disabled in the template and restore required attributes
    $last.find('select, input').prop('disabled', false);
    $last.find('.product').prop('required', true);
    $last.find('.qty-input').prop('required', true);
    $last.find('.price-input').prop('required', true);
    applySelect2();
    updateGrandTotal();
  });

  // Delegated remove handler (only counts visible rows in the first tbody)
  $('#purchase_info_table').on('click', '.btn-remove-row', function() {
    if ($('#purchase_info_table tbody').first().find('tr').length > 1) {
      $(this).closest('tr').remove();
      updateGrandTotal();
    }
  });

  // Update total per row and grand total
  $('#purchase_info_table').on('input change', '.qty-input, .price-input, .product', function() {
    $('#purchase_info_table tbody').first().find('tr').each(function() {
      const $row = $(this);
      const qty = parseFloat($row.find('.qty-input').val()) || 0;
      const price = parseFloat($row.find('.price-input').val()) || 0;
      $row.find('.total-amount-input').val((qty * price).toFixed(2));
    });
    updateGrandTotal();
  });

  function updateGrandTotal() {
    let total = 0;
    $('#purchase_info_table tbody').first().find('.total-amount-input').each(function() {
      total += parseFloat($(this).val()) || 0;
    });
    $('#grandTotal').text(total.toFixed(2));
  }

  // Set price when product changes
  $('#purchase_info_table').on('change', '.product', function() {
    const $row = $(this).closest('tr');
    const price = parseFloat($(this).find('option:selected').data('price') || 0) || 0;
    $row.find('.price-input').val(price.toFixed(2));
    $row.find('.qty-input').trigger('input');
  });

  // no per-row store sync needed; rows now use supplier input

  // Handle form submit: add global date and store to each purchase row
  $('#addStockForm').on('submit', function(e) {
    e.preventDefault();
    
    // Get global date and store
    const globalDate = $('#purchase_date_global').val();
    const storeId = $('#store_id_global').val();
    
    // Validate
    if (!globalDate) {
      alert('Please select a purchase date');
      return false;
    }
    if (!storeId) {
      alert('Please select a store');
      return false;
    }
    
    // Add hidden fields for each purchase row with date and store
    $('#purchase_info_table tbody').first().find('tr').each(function(idx) {
      const $row = $(this);
      // Check if this row already has hidden fields (skip if so)
      if (!$row.find('input[name="purchases[' + idx + '][purchase_date]"]').length) {
        $row.append('<input type="hidden" name="purchases[' + idx + '][purchase_date]" value="' + globalDate + '">');
        $row.append('<input type="hidden" name="purchases[' + idx + '][store_id]" value="' + storeId + '">');
      }
    });
    
    // Submit via AJAX
    const form = $(this);
    const formData = form.serialize();
    
    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      dataType: 'json',
      data: formData,
      success: function(resp) {
        if (resp.success) {
          Swal.fire('Success', 'Purchases added successfully', 'success').then(function() {
            $('#addStockModal').modal('hide');
            form[0].reset();
            // Reinitialize form
            purchaseIndex = 1;
            if (typeof purchasesTable !== 'undefined') purchasesTable.ajax.reload();
            else location.reload();
          });
        } else {
          Swal.fire('Error', resp.error || 'Failed to add purchases', 'error');
        }
      },
      error: function(xhr, status, err) {
        console.error('Submit error:', err, xhr.responseText);
        Swal.fire('Error', 'Server error: ' + err, 'error');
      }
    });
  });
});
</script>

<script>
// Provide a global deletePurchase JS function used by the Actions column
function deletePurchase(id) {
  if (!id) return;
  if (!confirm('Delete this purchase? This cannot be undone.')) return;
  $.post('<?php echo site_url('Controller_Products/deletePurchase'); ?>', { id: id }, function(resp) {
    if (resp && resp.success) {
      if (typeof purchasesTable !== 'undefined') purchasesTable.ajax.reload();
      else location.reload();
    } else {
      alert(resp && resp.message ? resp.message : 'Failed to delete');
    }
  }, 'json').fail(function(xhr){
    console.error('Delete request failed', xhr.responseText);
    alert('Server error deleting purchase');
  });
}
</script>

<script>
// Delete purchase helper (called by action buttons)
window.deletePurchase = function(id) {
  if (!id) return;
  Swal.fire({
    title: 'Delete purchase?','
    text: 'This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel'
  }).then(function(result){
    if (result.isConfirmed) {
      $.post('<?php echo site_url('Controller_Products/deletePurchase'); ?>', { id: id }, function(resp){
        if (resp && resp.success) {
          Swal.fire('Deleted', 'Purchase removed', 'success');
          if (typeof purchasesTable !== 'undefined') purchasesTable.ajax.reload(); else location.reload();
        } else {
          Swal.fire('Error', resp && resp.error ? resp.error : 'Delete failed', 'error');
        }
      }, 'json').fail(function(xhr){
        Swal.fire('Error', 'Server error', 'error');
      });
    }
  });
};
</script>

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
              <label for="edit_supplier_no">Supplier Phone</label>
              <input type="tel" 
                     class="form-control" 
                     id="edit_supplier_no" 
                     name="supplier_no" 
                     placeholder="Enter supplier phone number"
                     pattern="[0-9]{10,15}"
                     title="Please enter a valid phone number">
              <small class="help-block">Format: 255XXXXXXXXX</small>
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

  <!-- Products table with stock information -->
  
</div>
<script>
var purchasesTable;

$(document).ready(function() {
  var columns = [
    { "data": "product_name", "title": "Product" },
    { "data": "supplier", "title": "Supplier" },
    { "data": "supplier_no", "title": "Supplier Phone", "render": function(data){ return data || '-'; } },
    { "data": "purchase_date", "title": "Date", "render": function(data) {
        if (!data) return '-';
        if (window.moment) return moment(data).format('DD/MM/YYYY HH:mm');
        try { return new Date(data).toLocaleString(); } catch(e){ return data; }
      }
    },
    <?php if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2): ?>
    { "data": "store_name", "title": "Store" },
    <?php endif; ?>
    { "data": "qty", "title": "Quantity", "render": function(data, type, row){ return data + ' ' + (row.unit || ''); } },
    { "data": "price", "title": "Price/Unit", "render": function(data){ return 'TZS ' + parseFloat(data).toFixed(2); } },
    { "data": "total_amount", "title": "Total", "render": function(data){ return 'TZS ' + parseFloat(data).toFixed(2); } },
    { "data": null, "title": "Actions", "orderable": false, "className": "text-center", "render": function(data,type,row){
        var buttons = '<div class="btn-group">';
        <?php if(in_array('updateProduct', $this->permission)): ?>
        buttons += `<button class="btn btn-warning btn-sm" onclick="editPurchase(${row.id})" title="Edit"><i class="fa fa-pencil"></i></button>`;
        <?php endif; ?>
        <?php if(in_array('deleteProduct', $this->permission)): ?>
        buttons += `<button class="btn btn-danger btn-sm" onclick="deletePurchase(${row.id})" title="Delete"><i class="fa fa-trash"></i></button>`;
        <?php endif; ?>
        buttons += '</div>';
        return buttons;
      }
    }
  ];

  // find index of purchase_date column to set default ordering
  var orderIndex = columns.findIndex(function(c){ return c.data === 'purchase_date'; });
  if (orderIndex < 0) orderIndex = 0; // fallback

  // Initialize DataTable
  purchasesTable = $('#purchasesTable').DataTable({
    "processing": true,
    "serverSide": false,
    "ajax": {
        "url": '<?php echo base_url('Controller_Products/fetchPurchasesData'); ?>',
        "type": "POST",
        "data": function(d) {
            d.group_id = '<?php echo $this->session->userdata('group_id'); ?>';
            d.store_id = $('#storeFilter').length ? $('#storeFilter').val() : '<?php echo $this->session->userdata('store_id'); ?>';
            d.status_filter = $('#statusFilter').val() || '';
            d.date_filter = $('#dateFilter').val() || '';
          },
          "error": function(xhr, error, thrown) {
            console.error('purchases fetch error:', error, thrown, xhr.responseText);
            $('#messages').html('<div class="alert alert-danger">Failed to load purchases. See console for details.</div>');
          },
          "dataType": "json",
          "dataSrc": function(response) {
              if (response === null || typeof response === 'undefined') {
                console.error('Empty response from purchases endpoint');
                return [];
              }
              if (response.error) {
                console.error('Data error:', response.error);
                showAlert('error', response.error);
                return [];
              }
              var rows = response.data || [];

            // client-side filtering fallback (if server doesn't filter)
            var statusF = $('#statusFilter').val();
            if (statusF) {
                rows = rows.filter(function(r){ return String(r.status || '').toLowerCase() === String(statusF).toLowerCase(); });
            }
            var dateF = $('#dateFilter').val();
            if (dateF) {
                var now = moment ? moment() : null;
                rows = rows.filter(function(r){
                    if (!r.purchase_date) return false;
                    if (now) {
                        var pd = moment(r.purchase_date);
                        if (!pd.isValid()) return true;
                        if (dateF === 'today') return pd.isSame(now, 'day');
                        if (dateF === 'week') return pd.isSame(now, 'week');
                        if (dateF === 'month') return pd.isSame(now, 'month');
                        return true;
                    } else {
                        // fallback: compare dates approximately
                        try {
                            var pd2 = new Date(r.purchase_date);
                            var todays = new Date();
                            if (dateF === 'today') return pd2.toDateString() === todays.toDateString();
                            if (dateF === 'week') {
                                var oneWeekAgo = new Date(); oneWeekAgo.setDate(todays.getDate() - 7);
                                return pd2 >= oneWeekAgo && pd2 <= todays;
                            }
                            if (dateF === 'month') {
                                return pd2.getMonth() === todays.getMonth() && pd2.getFullYear() === todays.getFullYear();
                            }
                        } catch(e){ return true; }
                        return true;
                    }
                });
            }
            return rows;
        }
    },
    "columns": columns,
    // order by purchase_date desc (latest first)
    "order": [[ orderIndex, "desc" ]],
    "pageLength": 25,
    "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
           "<'row'<'col-sm-12'tr>>" +
           "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    "drawCallback": function() {
      $('.dataTables_processing').hide();
    }
  });

  // filter change handlers: reload table
  $('#statusFilter, #dateFilter').on('change', function() { purchasesTable.ajax.reload(); });
  <?php if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2): ?>
  $('#storeFilter').on('change', function() { purchasesTable.ajax.reload(); });
  <?php endif; ?>

  // load moment.js (if not yet loaded) - keep existing call
  $.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js');
});
</script>
<script>
$(function(){

    // compute total for Add Purchase modal
    function computeAddTotal() {
        var price = parseFloat($('#add_price').val() || 0) || 0;
        var qty   = parseFloat($('#add_qty').val()   || 0) || 0;
        var total = (price * qty) || 0;
        $('#add_total_amount').val(total.toFixed(2));
    }

    // compute total for Edit Purchase modal
    function computeEditTotal() {
        var price = parseFloat($('#edit_price').val() || 0) || 0;
        var qty   = parseFloat($('#edit_qty').val()   || 0) || 0;
        var total = (price * qty) || 0;
        $('#edit_total_amount').val(total.toFixed(2));
    }

    // set price when product changed (Add)
    $('#add_product_id').on('change', function(){
        var price = parseFloat($(this).find('option:selected').data('price') || 0) || 0;
        $('#add_price').val(price.toFixed(2));
        var unit = $(this).find('option:selected').data('unit') || '';
        $('#add_unit').val(unit);
        computeAddTotal();
    });

    // set price when product changed (Edit)
    $('#edit_product_id').on('change', function(){
        var price = parseFloat($(this).find('option:selected').data('price') || 0) || 0;
        $('#edit_price').val(price.toFixed(2));
        var unit = $(this).find('option:selected').data('unit') || '';
        $('#edit_unit').val(unit);
        computeEditTotal();
    });

    // update total on input change (Add modal)
    $('#add_price, #add_qty').on('input change', function(){
        computeAddTotal();
    });

    // update total on input change (Edit modal)
    $('#edit_price, #edit_qty').on('input change', function(){
        computeEditTotal();
    });

    // ensure totals are computed when modals open
    $('#addStockModal').on('shown.bs.modal', function(){
        computeAddTotal();
        // focus qty
        setTimeout(function(){ $('#add_qty').focus(); }, 50);
    });
    $('#editStockModal').on('shown.bs.modal', function(){
        computeEditTotal();
        setTimeout(function(){ $('#edit_qty').focus(); }, 50);
    });

    // also compute totals on page load in case fields are pre-filled (edit)
    computeAddTotal();
    computeEditTotal();
});
</script>