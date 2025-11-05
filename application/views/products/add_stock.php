<?php
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- ...existing modal markup ... -->

<form id="addStockForm" method="post" action="<?php echo site_url('Controller_Products/addStock'); ?>">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

  <div class="form-group">
    <label>Product</label>
    <select name="product_id" id="product_id" class="form-control" required>
      <option value="">Select product</option>
      <?php if(!empty($products)): foreach ($products as $p): ?>
        <option value="<?php echo $p['id']; ?>" data-price="<?php echo isset($p['price']) ? $p['price'] : '0'; ?>" data-unit="<?php echo isset($p['unit']) ? $p['unit'] : ''; ?>">
          <?php echo htmlspecialchars($p['name']); ?>
        </option>
      <?php endforeach; endif; ?>
    </select>
  </div>

  <div class="form-group">
    <label>Price per unit</label>
    <input type="number" step="0.01" min="0" name="price" id="add_price" class="form-control" value="0.00">
  </div>

  <div class="form-group">
    <label>Qty</label>
    <input type="number" name="qty" id="add_qty" class="form-control" min="1" value="1" required>
  </div>

  <div class="form-group">
    <label>Total Amount</label>
    <input type="number" step="0.01" min="0" name="total_amount" id="add_total_amount" class="form-control" value="0.00" readonly>
  </div>

  <div class="form-group">
    <label>Status</label>
    <select name="status" id="add_status" class="form-control">
      <option value="Unpaid">Unpaid</option>
      <option value="Partial">Partial</option>
      <option value="Paid">Paid</option>
    </select>
  </div>

  <div class="form-group" id="add_amount_paid_group" style="display:none;">
    <label>Amount Paid</label>
    <input type="number" step="0.01" min="0" class="form-control" id="add_amount_paid" name="amount_paid">
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
</form>

<script>
(function($){
  function computeAddTotal(){
    var price = parseFloat($('#add_price').val() || 0) || 0;
    var qty = parseFloat($('#add_qty').val() || 0) || 0;
    var total = (price * qty) || 0;
    $('#add_total_amount').val(total.toFixed(2));
    // if status is Paid, mirror total to amount_paid
    if ($('#add_status').val() === 'Paid') {
      $('#add_amount_paid').val(total.toFixed(2));
    }
  }

  // set price when product selected (uses data-price on option)
  $('#product_id').on('change', function(){
    var $opt = $(this).find('option:selected');
    var price = parseFloat($opt.data('price') || 0) || 0;
    $('#add_price').val(price.toFixed(2));
    computeAddTotal();
  });

  // recompute total when price or qty change
  $('#add_price, #add_qty').on('input change', function(){
    computeAddTotal();
  });

  // toggle amount_paid visibility/required based on status
  $('#add_status').on('change', function(){
    var s = $(this).val();
    if (s === 'Paid') {
      $('#add_amount_paid_group').show();
      // do not set required (avoid "not focusable" browser validation)
      $('#add_amount_paid').prop('required', false);
      // auto-fill amount_paid with total
      var total = parseFloat($('#add_total_amount').val() || 0) || 0;
      $('#add_amount_paid').val(total.toFixed(2));
    } else if (s === 'Partial') {
      $('#add_amount_paid_group').show();
      $('#add_amount_paid').prop('required', true);
      // keep current value so user can enter partial
    } else {
      $('#add_amount_paid_group').hide();
      $('#add_amount_paid').prop('required', false).val('');
    }
  });

  // init on load
  $(function(){
    // ensure default price & total reflect selected product/qty
    var $prod = $('#product_id');
    if ($prod.length && $prod.val()) $prod.trigger('change');
    computeAddTotal();
    $('#add_status').trigger('change');
  });

  // submit via AJAX, handle server response
  $('#addStockForm').on('submit', function(e){
    e.preventDefault();
    var $f = $(this);
    // basic client validation for Partial
    if ($('#add_status').val() === 'Partial') {
      var paid = $('#add_amount_paid').val();
      if (!paid || parseFloat(paid) <= 0) {
        alert('Enter an amount paid for Partial status');
        return;
      }
    }
    $.post($f.attr('action'), $f.serialize(), function(resp){
        if (resp && resp.success) {
            // hide modal if present
            if ($('#addStockModal').length) $('#addStockModal').modal('hide');
            if (typeof purchasesTable !== 'undefined') purchasesTable.ajax.reload();
            else location.reload();
        } else {
            alert(resp.error || 'Save failed');
        }
    }, 'json').fail(function(xhr){
        console.error('Add purchase error', xhr.responseText);
        alert('Server error');
    });
  });

})(jQuery);
</script>