<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add New Orders
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
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
        <?php elseif($this->session->flashdata('errors')): ?>
          <div class="alert alert-error" role="alert" id="error-message">
            <?php echo $this->session->flashdata('errors'); ?>
          </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box">
          <!-- /.box-header -->
          <form role="form" action="<?php echo base_url('Controller_Orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Time: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-7 col-xs-12 pull pull-left">
                  <div class="form-group">
                    <label for="customer_name" class="col-sm-5 control-label" style="text-align:left;">Client Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Client Name" autocomplete="off" required value="<?php echo isset($form_data['customer_name']) ? htmlspecialchars($form_data['customer_name']) : set_value('customer_name'); ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="customer_address" class="col-sm-5 control-label" style="text-align:left;">Client Address</label>
                    <div class="col-sm-7">
                      <textarea type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Client Address" autocomplete="off"><?php echo isset($form_data['customer_address']) ? htmlspecialchars($form_data['customer_address']) : set_value('customer_address'); ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="customer_phone" class="col-sm-5 control-label" style="text-align:left;">Client Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Client Phone" autocomplete="off" value="<?php echo isset($form_data['customer_phone']) ? htmlspecialchars($form_data['customer_phone']) : set_value('customer_phone'); ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="store_display" class="col-sm-5 control-label" style="text-align:left;">Store</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="store_display" value="<?php echo isset($store_data['store_name']) ? htmlspecialchars($store_data['store_name']) : ''; ?>" readonly>
                      <input type="hidden" name="store_id" id="store_id" value="<?php echo isset($store_data['store_id']) ? htmlspecialchars($store_data['store_id']) : ''; ?>" required>
                    </div>
                  </div>
                  <?php if (!isset($store_data['store_id'])): ?>
                  <div class="alert alert-danger">
                    Error: No store assigned to your account. Please contact administrator.
                  </div>
                  <?php endif; ?>
                </div>
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:10%">Price</th>
                      <th style="width:20%">Amount</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $row_count = isset($form_data['product']) && is_array($form_data['product']) ? count($form_data['product']) : 1;
                    for ($i = 0; $i < $row_count; $i++):
                      $row_id = $i + 1;
                    ?>
                    <tr id="row_<?php echo $row_id; ?>">
                      <td>
                        <select class="form-control select_group product" data-row-id="row_<?php echo $row_id; ?>" id="product_<?php echo $row_id; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $row_id; ?>)" required>
                          <option value="">Select a product</option>
                          <?php foreach ($products as $k => $v): ?>
                            <?php
                              $stockStatus = '';
                              if (!isset($v['qty']) || $v['qty'] <= 0) {
                                  $stockStatus = ' (Out of Stock)';
                              } else {
                                  $stockStatus = ' (Stock: ' . $v['qty'] . ')';
                              }
                              $priceStatus = '';
                              if (!isset($v['price']) || $v['price'] <= 0) {
                                  $priceStatus = ' - No Price Set';
                              }
                            ?>
                            <option value="<?php echo $v['id'] ?>" 
                                    data-price="<?php echo isset($v['price']) ? $v['price'] : 0 ?>" 
                                    data-stock="<?php echo isset($v['qty']) ? $v['qty'] : 0 ?>"
                                    <?php echo (isset($form_data['product'][$i]) && $form_data['product'][$i] == $v['id']) ? 'selected' : ''; ?>
                                    <?php echo (!isset($v['qty']) || $v['qty'] <= 0 || !isset($v['price']) || $v['price'] <= 0) ? 'class="text-muted"' : ''; ?>>
                                <?php echo htmlspecialchars($v['name']) . $stockStatus . $priceStatus; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td><input type="number" name="qty[]" id="qty_<?php echo $row_id; ?>" class="form-control" required min="1" onkeyup="getTotal(<?php echo $row_id; ?>)" value="<?php echo isset($form_data['qty'][$i]) ? htmlspecialchars($form_data['qty'][$i]) : set_value('qty['.$i.']', 1); ?>"></td>
                      <td>
                        <input type="text" name="rate[]" id="rate_<?php echo $row_id; ?>" class="form-control" onkeyup="getTotal(<?php echo $row_id; ?>)" autocomplete="off" value="<?php echo isset($form_data['rate'][$i]) ? htmlspecialchars($form_data['rate'][$i]) : set_value('rate['.$i.']'); ?>">
                        <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $row_id; ?>" class="form-control" value="<?php echo isset($form_data['rate_value'][$i]) ? htmlspecialchars($form_data['rate_value'][$i]) : set_value('rate_value['.$i.']'); ?>">
                      </td>
                      <td>
                        <input type="text" name="amount[]" id="amount_<?php echo $row_id; ?>" class="form-control" disabled autocomplete="off" value="<?php echo isset($form_data['amount'][$i]) ? htmlspecialchars($form_data['amount'][$i]) : set_value('amount['.$i.']'); ?>">
                        <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $row_id; ?>" class="form-control" value="<?php echo isset($form_data['amount_value'][$i]) ? htmlspecialchars($form_data['amount_value'][$i]) : set_value('amount_value['.$i.']'); ?>">
                      </td>
                      <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('<?php echo $row_id; ?>')"><i class="fa fa-close"></i></button></td>
                    </tr>
                    <?php endfor; ?>
                  </tbody>
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-left">
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off" value="<?php echo isset($form_data['gross_amount']) ? htmlspecialchars($form_data['gross_amount']) : set_value('gross_amount', 0); ?>">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off" value="<?php echo isset($form_data['gross_amount_value']) ? htmlspecialchars($form_data['gross_amount_value']) : set_value('gross_amount_value', 0); ?>">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off" value="<?php echo isset($form_data['service_charge']) ? htmlspecialchars($form_data['service_charge']) : set_value('service_charge', 0); ?>">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off" value="<?php echo isset($form_data['service_charge_value']) ? htmlspecialchars($form_data['service_charge_value']) : set_value('service_charge_value', 0); ?>">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off" value="<?php echo isset($form_data['vat_charge']) ? htmlspecialchars($form_data['vat_charge']) : set_value('vat_charge', 0); ?>">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off" value="<?php echo isset($form_data['vat_charge_value']) ? htmlspecialchars($form_data['vat_charge_value']) : set_value('vat_charge_value', 0); ?>">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off" value="<?php echo isset($form_data['discount']) ? htmlspecialchars($form_data['discount']) : set_value('discount', 0); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off" value="<?php echo isset($form_data['net_amount']) ? htmlspecialchars($form_data['net_amount']) : set_value('net_amount', 0); ?>">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off" value="<?php echo isset($form_data['net_amount_value']) ? htmlspecialchars($form_data['net_amount_value']) : set_value('net_amount_value', 0); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Paid Status</label>
                    <div class="col-sm-7">
                      <select class="form-control" id="paid_status" name="paid_status" onchange="toggleAmountPaidField()">
                        <option value="1" <?php echo (isset($form_data['paid_status']) && $form_data['paid_status'] == '1') ? 'selected' : set_select('paid_status', '1', TRUE); ?>>Not Paid</option>
                        <option value="2" <?php echo (isset($form_data['paid_status']) && $form_data['paid_status'] == '2') ? 'selected' : set_select('paid_status', '2'); ?>>Paid</option>
                        <option value="3" <?php echo (isset($form_data['paid_status']) && $form_data['paid_status'] == '3') ? 'selected' : set_select('paid_status', '3'); ?>>Partially Paid</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="amount_paid_group" style="display: none;">
                    <label for="amount_paid" class="col-sm-5 control-label">Amount Paid</label>
                    <div class="col-sm-7">
                      <input type="number" class="form-control" id="amount_paid" name="amount_paid" placeholder="Enter Amount Paid" autocomplete="off" step="0.01" min="0" value="<?php echo isset($form_data['amount_paid']) ? htmlspecialchars($form_data['amount_paid']) : set_value('amount_paid', 0); ?>">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="createOrderBtn">Create Order</button>
                <a href="<?php echo base_url('Controller_Orders/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
  var getProductValueByIdUrl = "<?php echo site_url('Controller_Orders/getProductValueById'); ?>";
  var getTableProductRowUrl = "<?php echo site_url('Controller_Orders/getTableProductRow'); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');
    
    $("#error-message").removeClass('alert-dismissible');
    $("#error-message .close").remove();
    
    subAmount();
    toggleAmountPaidField();

    // Form submission handler
    $("#createOrderBtn").closest("form").on("submit", function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return false;
        }

        // Create FormData object
        var formData = $(this).serializeArray();
        
        // Add current timestamp and ensure store_id is included
        formData.push({
            name: 'date_time',
            value: moment().format('YYYY-MM-DD HH:mm:ss')
        });

        
        // Ensure store_id is included
        var store_id = $("#store_id").val();
        if (!store_id) {
            $("#messages").html(
                '<div class="alert alert-danger alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button>' +
                'Store ID is required. Please contact administrator if no store is assigned.' +
                '</div>'
            );
            return false;
        }

        // Submit via AJAX
        $.ajax({
            url: "<?php echo base_url('Controller_Orders/create'); ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                $("#createOrderBtn").prop('disabled', true).html('Creating order...');
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    $("#messages").html(
                        '<div class="alert alert-danger alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button>' +
                        (response.error || 'Failed to create order') +
                        '</div>'
                    );
                    $("#createOrderBtn").prop('disabled', false).html('Create Order');
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = 'Server error occurred. Please try again.';
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        errorMessage = response.error;
                    }
                } catch (e) {}
                
                $("#messages").html(
                    '<div class="alert alert-danger alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button>' +
                    errorMessage +
                    '</div>'
                );
                $("#createOrderBtn").prop('disabled', false).html('Create Order');
            }
        });
    });

    function validateForm() {
        var isValid = true;
        var message = '';

        // Check customer name
        if (!$("input[name='customer_name']").val().trim()) {
            message = 'Please enter customer name';
            isValid = false;
        }

        // Check if any products are added
        if ($(".product").length === 0) {
            message = 'Please add at least one product';
            isValid = false;
        }

        // Check quantities
        $(".qty").each(function() {
            var qty = parseInt($(this).val());
            if (isNaN(qty) || qty <= 0) {
                message = 'Please enter valid quantities for all products';
                isValid = false;
                return false;
            }
        });

        if (!isValid) {
            $("#messages").html(
                '<div class="alert alert-danger alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button>' +
                message +
                '</div>'
            );
        }

        return isValid;
    }

    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: getTableProductRowUrl,
          type: 'post',
          dataType: 'json',
          success: function(response) {
              if (response.error) {
                  console.error('Error fetching products:', response.error);
                  alert('Failed to load products: ' + response.error);
                  return;
              }

              console.log('getTableProductRow response:', response);
              var html = '<tr id="row_' + row_id + '">' +
                  '<td>' + 
                  '<select class="form-control select_group product" data-row-id="' + row_id + '" id="product_' + row_id + '" name="product[]" style="width:100%;" onchange="getProductData(' + row_id + ')" required>' +
                  '<option value="">Select a product</option>';
              var hasAvailableProducts = false;
              $.each(response, function(index, value) {
                  hasAvailableProducts = true;
                  var stockStatus = '';
                  if (!value.qty || value.qty <= 0) {
                      stockStatus = ' (Out of Stock)';
                  } else {
                      stockStatus = ' (Stock: ' + value.qty + ')';
                  }
                  var priceStatus = '';
                  if (!value.price || value.price <= 0) {
                      priceStatus = ' - No Price Set';
                  }
                  var cssClass = (!value.qty || value.qty <= 0 || !value.price || value.price <= 0) ? ' class="text-muted"' : '';
                  html += '<option value="' + value.id + '" ' +
                         'data-price="' + (value.price || 0) + '" ' +
                         'data-stock="' + (value.qty || 0) + '"' + cssClass + '>' +
                         value.name + stockStatus + priceStatus + '</option>';
              });
              html += '</select></td>' + 
                  '<td><input type="number" name="qty[]" id="qty_' + row_id + '" class="form-control" required min="1" onkeyup="getTotal(' + row_id + ')"></td>' +
                  '<td><input type="text" name="rate[]" id="rate_' + row_id + '" class="form-control" onkeyup="getTotal(' + row_id + ')"><input type="hidden" name="rate_value[]" id="rate_value_' + row_id + '" class="form-control"></td>' +
                  '<td><input type="text" name="amount[]" id="amount_' + row_id + '" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_' + row_id + '" class="form-control"></td>' +
                  '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\'' + row_id + '\')"><i class="fa fa-close"></i></button></td>' +
                  '</tr>';

              if (!hasAvailableProducts) {
                alert('No products with available stock. Please add stock via purchases.');
                return;
              }

              if (count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              } else {
                $("#product_info_table tbody").html(html);
              }

              $(".select_group").select2();
          },
          error: function(xhr, status, error) {
              console.error('AJAX error in getTableProductRow:', status, error, xhr.responseText);
              alert('Failed to load products. Please check your network or contact support.');
          }
      });
    });
  });

  function getProductData(row_id) {
    var product_id = $("#product_" + row_id).val();
    console.log('Selected product_id:', product_id);

    if (!product_id || isNaN(product_id) || product_id <= 0) {
      console.warn('Invalid product_id:', product_id);
      $("#rate_" + row_id).val("");
      $("#rate_value_" + row_id).val("");
      $("#qty_" + row_id).val("");
      $("#amount_" + row_id).val("");
      $("#amount_value_" + row_id).val("");
      subAmount();
      return;
    }

    $.ajax({
      url: getProductValueByIdUrl,
      type: 'post',
      data: { product_id: product_id },
      dataType: 'json',
      success: function(response) {
        console.log('getProductValueById response:', response);
        if (response.error) {
          console.error('Error fetching product data:', response.error);
          alert('Error: ' + response.error);
          $("#product_" + row_id).val("").trigger('change.select2');
          $("#rate_" + row_id).val("");
          $("#rate_value_" + row_id).val("");
          $("#qty_" + row_id).val("");
          $("#amount_" + row_id).val("");
          $("#amount_value_" + row_id).val("");
          subAmount();
          return;
        }

        $("#rate_" + row_id).val(response.price);
        $("#rate_value_" + row_id).val(response.price);
        var stock = parseInt(response.qty) || 0;
        $("#qty_" + row_id).prop('max', stock > 0 ? stock : 1);
        $("#qty_" + row_id).val(stock > 0 ? 1 : '');
        $("#qty_" + row_id).prop('disabled', stock === 0);
        $("#amount_" + row_id).val(stock > 0 ? response.price : '');
        $("#amount_value_" + row_id).val(stock > 0 ? response.price : '');

        if (stock === 0) {
          alert('Warning: This product is out of stock. You can add stock via purchases.');
          $("#qty_" + row_id).val('0').prop('disabled', true);
        } else if (!response.price || response.price <= 0) {
          alert('Warning: This product has no price set. Please set a price first.');
          $("#rate_" + row_id).val('0');
          $("#rate_value_" + row_id).val('0');
          $("#qty_" + row_id).val('0').prop('disabled', true);
        }
        subAmount();
      },
      error: function(xhr, status, error) {
        console.error('AJAX error in getProductData:', status, error, xhr.responseText);
        alert('Failed to load product data. Please check your network or contact support.');
        $("#product_" + row_id).val("").trigger('change.select2');
        $("#rate_" + row_id).val("");
        $("#rate_value_" + row_id).val("");
        $("#qty_" + row_id).val("");
        $("#amount_" + row_id).val("");
        $("#amount_value_" + row_id).val("");
        subAmount();
      }
    });
  }

  function getTotal(row_id) {
    var qty = $("#qty_" + row_id).val();
    var rate = $("#rate_" + row_id).val();
    var stock = parseInt($("#product_" + row_id + " option:selected").data('stock')) || 0;

    if (qty && parseInt(qty) > stock) {
      alert('Quantity exceeds available stock (' + stock + ') for this product.');
      $("#qty_" + row_id).val(stock > 0 ? stock : '');
      $("#qty_" + row_id).prop('disabled', stock === 0);
      qty = $("#qty_" + row_id).val();
    }

    if (qty && rate && stock > 0) {
      var total = parseFloat(rate) * parseFloat(qty);
      total = total.toFixed(2);
      $("#amount_" + row_id).val(total);
      $("#amount_value_" + row_id).val(total);
    } else {
      $("#amount_" + row_id).val("");
      $("#amount_value_" + row_id).val("");
    }
    subAmount();
  }

  function subAmount() {
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for (var x = 1; x <= tableProductLength; x++) {
      var amount = $("#amount_value_" + x).val();
      if (amount) {
        totalSubAmount += parseFloat(amount);
      }
    }

    totalSubAmount = totalSubAmount.toFixed(2);
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    var service_charge_rate = parseFloat($("input[name='service_charge_rate']").val()) || 0;
    var vat_charge_rate = parseFloat($("input[name='vat_charge_rate']").val()) || 0;
    var discount = parseFloat($("#discount").val()) || 0;

    var service_charge = (totalSubAmount * (service_charge_rate / 100)).toFixed(2);
    $("#service_charge").val(service_charge);
    $("#service_charge_value").val(service_charge);

    var vat_charge = (totalSubAmount * (vat_charge_rate / 100)).toFixed(2);
    $("#vat_charge").val(vat_charge);
    $("#vat_charge_value").val(vat_charge);

    var net_amount = (parseFloat(totalSubAmount) + parseFloat(service_charge) + parseFloat(vat_charge) - parseFloat(discount)).toFixed(2);
    $("#net_amount").val(net_amount);
    $("#net_amount_value").val(net_amount);

    toggleAmountPaidField();
  }

  function toggleAmountPaidField() {
    var paid_status = $("#paid_status").val();
    var net_amount = parseFloat($("#net_amount_value").val()) || 0;

    if (paid_status == "3") {
      $("#amount_paid_group").show();
      $("#amount_paid").prop('disabled', false).prop('required', true);
      $("#amount_paid").val('');
    } else if (paid_status == "2") {
      $("#amount_paid_group").show();
      $("#amount_paid").val(net_amount.toFixed(2)).prop('disabled', true).prop('required', true);
    } else {
      $("#amount_paid_group").hide();
      $("#amount_paid").val('1').prop('disabled', true).prop('required', false);
    }
  }

  function removeRow(row_id) {
    if ($("#product_info_table tbody tr").length > 1) {
      $("#row_" + row_id).remove();
      subAmount();
    } else {
      alert("At least one product is required.");
    }
  }
</script>

<?php
log_message('debug', 'User permissions: ' . json_encode($this->permission));
?>