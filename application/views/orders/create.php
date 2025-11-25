<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>Manage Orders <small>Add New Order</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_Orders'); ?>">Orders</a></li>
            <li class="active">Add Order</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div id="messages"></div>

                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php elseif($this->session->flashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('errors'); ?>
                    </div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <div class="box">
                    <div class="box-body">
                        <div class="pos-container">
                            <div class="pos-content">
                                <form id="createOrderForm" action="<?php echo base_url('Controller_Orders/create'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="customer_name">Client Name</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Client Name" autocomplete="off" required value="<?php echo isset($form_data['customer_name']) ? htmlspecialchars($form_data['customer_name']) : set_value('customer_name'); ?>">
                                    </div>

                                    <!-- header fields (keeps customer_phone, address, etc.) -->
                                    <div class="form-group">
                                        <label for="customer_phone">Client Phone</label>
                                        <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Client Phone" autocomplete="off" value="<?php echo set_value('customer_phone'); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_address">Client Address</label>
                                        <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Client Address" autocomplete="off" value="<?php echo set_value('customer_address'); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="store_id">Store</label>
                                        <?php // If active stores are provided, show a select for everyone so they can choose a store ?>
                                        <?php if (!empty($stores)): ?>
                                            <select id="store_id" name="store_id" class="form-control" required>
                                                <option value="">Select a store</option>
                                                <?php foreach ($stores as $s): ?>
                                                    <option value="<?php echo $s['id']; ?>" <?php echo (isset($store_data['store_id']) && $store_data['store_id'] == $s['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($s['name']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="store_display" value="<?php echo isset($store_data['store_name']) ? htmlspecialchars($store_data['store_name']) : ''; ?>" readonly>
                                            <input type="hidden" name="store_id" id="store_id" value="<?php echo isset($store_data['store_id']) ? htmlspecialchars($store_data['store_id']) : ''; ?>" required>
                                            <?php if (!isset($store_data['store_id'])): ?>
                                                <div class="alert alert-danger">
                                                    Error: No store assigned to your account. Please contact administrator.
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="order-products">
                                        <div class="product-header d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                            <h4 class="mb-0">Products</h4>
                                            <button type="button" id="add_row" class="btn btn-primary" title="Add Product">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-condensed" id="product_info_table">
                                                <thead>
                                                    <tr>
                                                        <th style="width:45%">Product</th>
                                                        <th style="width:20%" class="text-center">Qty</th>
                                                        <th style="width:15%" class="text-right">Price</th>
                                                        <th style="width:15%" class="text-right">Total</th>
                                                        <th style="width:5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- in the initial static row: replace the input-group with a single qty input -->
                                                    <tr id="row_1">
                                                        <td style="position: relative;">
                                                            <select class="form-control product" 
                                                                    data-row-id="1" 
                                                                    id="product_1" 
                                                                    name="product[]" 
                                                                    style="width:100%;" 
                                                                    required>
                                                                <option value="">Select Product</option>
                                                                <?php if (!empty($products)): ?>
                                                                    <?php foreach ($products as $product): ?>
                                                                        <option 
                                                                            value="<?php echo $product['id']; ?>"
                                                                            data-price="<?php echo isset($product['price']) ? $product['price'] : 0; ?>"
                                                                            data-stock="<?php echo isset($product['current_stock']) ? $product['current_stock'] : 0; ?>">
                                                                            <?php echo htmlspecialchars($product['name']); ?> 
                                                                            - Stock: <?php echo isset($product['current_stock']) ? number_format($product['current_stock']) : 0; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <!-- simplified qty input (removed + and - buttons) -->
                                                            <input type="number" name="qty[]" id="qty_1" class="form-control qty-input" value="1" min="1" onchange="updateRowTotals(1,'qty')" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="rate[]" id="rate_1" class="form-control text-right price-input" onchange="updateRowTotals(1,'rate')" oninput="updateRowTotals(1,'rate')" step="0.01" min="0" style="font-size: 16px;">
                                                            <input type="hidden" name="rate_value[]" id="rate_value_1">
                                                        </td>
                                                        <td>
                                                            <!-- allow manual total entry; keep a hidden raw value for form submission -->
                                                            <input type="number" name="amount[]" id="amount_1" class="form-control text-right amount-input" step="0.01" min="0" onchange="updateRowTotals(1,'amount')" oninput="updateRowTotals(1,'amount')">
                                                            <input type="hidden" name="amount_value[]" id="amount_value_1">
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1')">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Discount -->
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="<?php echo set_value('discount', '0'); ?>">
                                    </div>

                                    <!-- Payment status and amount paid -->
                                    <div class="form-group">
                                        <label for="paid_status">Payment Status</label>
                                        <select id="paid_status" name="paid_status" class="form-control">
                                            <option value="1">Not Paid</option>
                                            <option value="2">Paid</option>
                                            <option value="3">Partially Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="amount_paid_group" style="display:none;">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid" value="0.00">
                                    </div>

                                    <!-- Hidden totals / value fields (these must be posted) -->
                                    <input type="hidden" id="gross_amount_value" name="gross_amount_value" value="0.00">
                                    <input type="hidden" id="service_charge_value" name="service_charge_value" value="0.00">
                                    <input type="hidden" id="vat_charge_value" name="vat_charge_value" value="0.00">
                                    <input type="hidden" id="net_amount_value" name="net_amount_value" value="0.00">

                                    <!-- Rates (percent) if used -->
                                    <input type="hidden" id="service_charge_rate" name="service_charge_rate" value="<?php echo set_value('service_charge_rate','0'); ?>">
                                    <input type="hidden" id="vat_charge_rate" name="vat_charge_rate" value="<?php echo set_value('vat_charge_rate','0'); ?>">

                                    <!-- Create button uses JS handler -->
                                    <div class="form-group">
                                        <button type="button" id="createOrderBtn" class="btn btn-primary">Create Order</button>
                                    </div>
                                </form>
                            </div>

                            <div class="pos-footer">
                                <div class="totals-section">
                                    <div class="form-group">
                                        <label>Date & Time</label>
                                        <input type="text" class="form-control" value="<?php echo date('Y-m-d h:i a'); ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="gross_amount">Gross Amount</label>
                                        <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo isset($form_data['gross_amount']) ? htmlspecialchars($form_data['gross_amount']) : set_value('gross_amount', 0); ?>">
                                        <input type="hidden" id="gross_amount_value" name="gross_amount_value" value="<?php echo isset($form_data['gross_amount_value']) ? htmlspecialchars($form_data['gross_amount_value']) : set_value('gross_amount_value', 0); ?>">
                                    </div>
                                    <?php if($is_service_enabled == true): ?>
                                        <div class="form-group">
                                            <label for="service_charge">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                                            <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo isset($form_data['service_charge']) ? htmlspecialchars($form_data['service_charge']) : set_value('service_charge', 0); ?>">
                                            <input type="hidden" id="service_charge_value" name="service_charge_value" value="<?php echo isset($form_data['service_charge_value']) ? htmlspecialchars($form_data['service_charge_value']) : set_value('service_charge_value', 0); ?>">
                                            <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value']; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if($is_vat_enabled == true): ?>
                                        <div class="form-group">
                                            <label for="vat_charge">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                                            <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo isset($form_data['vat_charge']) ? htmlspecialchars($form_data['vat_charge']) : set_value('vat_charge', 0); ?>">
                                            <input type="hidden" id="vat_charge_value" name="vat_charge_value" value="<?php echo isset($form_data['vat_charge_value']) ? htmlspecialchars($form_data['vat_charge_value']) : set_value('vat_charge_value', 0); ?>">
                                            <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value']; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" value="<?php echo isset($form_data['discount']) ? htmlspecialchars($form_data['discount']) : set_value('discount', 0); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="net_amount">Net Amount</label>
                                        <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo isset($form_data['net_amount']) ? htmlspecialchars($form_data['net_amount']) : set_value('net_amount', 0); ?>">
                                        <input type="hidden" id="net_amount_value" name="net_amount_value" value="<?php echo isset($form_data['net_amount_value']) ? htmlspecialchars($form_data['net_amount_value']) : set_value('net_amount_value', 0); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="paid_status">Payment Status</label>
                                        <select class="form-control" id="paid_status" name="paid_status" onchange="toggleAmountPaidField()">
                                            <option value="1">Not Paid</option>
                                            <option value="2">Paid</option>
                                            <option value="3">Partially Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="amount_paid_group" style="display: none;">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="number" class="form-control" id="amount_paid" name="amount_paid" placeholder="Enter Amount Paid" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Custom CSS -->
    <style>
        .pos-container {
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .pos-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .pos-footer {
            padding: 20px;
            border-top: 1px solid #e7e7e7;
            background: #f9fafc;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control, select, input[type="number"], input[type="text"] {
            height: 42px;
            padding: 10px;
            font-size: 15px;
            border: 1px solid #d2d6de;
            border-radius: 6px;
            width: 100%;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #3c8dbc;
            box-shadow: 0 0 5px rgba(60, 141, 188, 0.3);
        }

        select {
            background: #fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 24 24'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 10px center;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .input-group-btn .btn {
            height: 42px !important;
            width: 42px !important;
            padding: 0 !important;
            font-size: 16px !important;
            background-color: #f8f9fa !important;
            border: 1px solid #ddd !important;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .btn {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #3c8dbc;
            border-color: #367fa9;
        }

        .btn-primary:hover {
            background: #367fa9;
            border-color: #2c6c8f;
        }

        .btn-danger {
            background: #dd4b39;
            border-color: #d73925;
        }

        .btn-danger:hover {
            background: #c9302c;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        #product_info_table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #product_info_table th, #product_info_table td {
            padding: 12px;
            border: 1px solid #e7e7e7;
            font-size: 14px;
        }

        #product_info_table th {
            background: #f4f6f9;
            font-weight: 600;
        }

        .totals-section {
            padding: 20px;
            background: #f9fafc;
            border-radius: 6px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
            position: relative;
        }

        .alert .close {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .qty-input {
            height: 42px !important;
            width: 80px !important;
            text-align: center !important;
            font-size: 14px !important;
            padding: 0 10px !important;
            border: 1px solid #ddd !important;
            background-color: #fff !important;
            border-radius: 6px !important;
        }

        .price-input {
            font-weight: 600 !important;
            background-color: #fff !important;
            border: 1px solid #ddd !important;
            padding: 10px !important;
            border-radius: 6px !important;
        }

        .btn-number {
            height: 42px !important;
            width: 42px !important;
            font-size: 16px !important;
            background-color: #f8f9fa !important;
            border-color: #ddd !important;
            border-radius: 6px !important;
        }

        .btn-number:hover {
            background-color: #e9ecef !important;
        }

        #add_row {
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background-color: #3c8dbc;
            border-color: #367fa9;
            margin-left: auto;
        }

        #add_row i {
            font-size: 16px;
            color: #fff;
        }

        .error {
            border-color: #dd4b39 !important;
            box-shadow: 0 0 5px rgba(221, 75, 57, 0.3) !important;
        }

        .select2-container--default.error .select2-selection--single {
            border-color: #dd4b39 !important;
            box-shadow: 0 0 5px rgba(221, 75, 57, 0.3) !important;
        }

        .select2-container {
            width: 100% !important;
            z-index: 10000 !important;
        }

        .select2-dropdown {
            z-index: 10001 !important;
            border: 1px solid #d2d6de !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        }

        .select2-container--default .select2-selection--single {
            height: 42px !important;
            line-height: 42px !important;
            border: 1px solid #d2d6de !important;
            border-radius: 6px !important;
            padding: 0 10px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px !important;
            font-size: 14px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px !important;
            right: 10px !important;
        }

        .select2-results__option {
            padding: 10px !important;
            font-size: 14px !important;
        }

        .select2-results__option--highlighted {
            background-color: #3c8dbc !important;
            color: #fff !important;
        }

        @media (max-width: 767px) {
            #product_info_table th:nth-child(3),
            #product_info_table td:nth-child(3) {
                display: none;
            }

            .form-control, select, input[type="number"], input[type="text"] {
                height: 38px;
                font-size: 13px;
            }

            .btn {
                font-size: 13px;
                padding: 8px;
            }
        }

        @media (min-width: 1024px) {
            .pos-container {
                flex-direction: row;
            }

            .pos-content {
                width: 65%;
                border-right: 1px solid #e7e7e7;
            }

            .pos-footer {
                width: 35%;
                height: calc(100vh - 120px);
                overflow-y: auto;
            }
        }
    </style>

    <!-- Custom JS -->
    <script>
$(document).ready(function() {
    // Prevent native form submit (Enter key)
    $('#createOrderForm').on('submit', function(e){
        e.preventDefault();
        return false;
    });

    // Use single paid_status handler that centralizes logic (defined later)
    $(document).on('change', '#paid_status', function() {
        toggleAmountPaidField();
    });
    // initialize visible/readonly/value state
    toggleAmountPaidField();

    // Replace the create button handler and add-row handler with the corrected versions
    $('#createOrderBtn').off('click').on('click', function(e){
        e.preventDefault();

        // Always take pos-footer controls (last occurrence) as authoritative and mirror them
        var $paidAll = $('[name="paid_status"]');
        var $amtAll = $('[name="amount_paid"]');
        var $paidFooter = $paidAll.length ? $paidAll.last() : $();
        var $amtFooter = $amtAll.length ? $amtAll.last() : $();

        // Mirror footer values to all controls (keeps UI consistent)
        if ($paidFooter.length) $paidAll.val($paidFooter.val());
        if ($amtFooter.length) $amtAll.val($amtFooter.val());

        // Ensure toggle logic uses footer value
        toggleAmountPaidField();

        if (!validateForm()) return;

        // Before serializing: ensure footer values are the only enabled inputs for these names
        // Disable earlier duplicates so server receives footer values only.
        var disabledTracker = [];
        if ($paidAll.length > 1) {
            $paidAll.slice(0, -1).each(function(){
                $(this).prop('disabled', true);
                disabledTracker.push(this);
            });
        }
        if ($amtAll.length > 1) {
            $amtAll.slice(0, -1).each(function(){
                $(this).prop('disabled', true);
                disabledTracker.push(this);
            });
        }

        // sync hidden values
        $('#product_info_table tbody tr').each(function(){
            var rid = $(this).attr('id')?.split('_')[1];
            if (!rid) return;
            if (!$('#amount_value_' + rid).length) $(this).append('<input type="hidden" name="amount_value[]" id="amount_value_'+rid+'" value="0.00">');
            if (!$('#rate_value_' + rid).length)   $(this).append('<input type="hidden" name="rate_value[]" id="rate_value_'+rid+'" value="0.00">');
            $('#amount_value_' + rid).val( ($('#amount_' + rid).val() !== undefined && $('#amount_' + rid).val() !== '') ? $('#amount_' + rid).val() : $('#amount_value_' + rid).val() );
            $('#rate_value_' + rid).val( ($('#rate_' + rid).val() !== undefined && $('#rate_' + rid).val() !== '') ? $('#rate_' + rid).val() : $('#rate_value_' + rid).val() );
        });

        var form = $('#createOrderForm');
        var payload = form.serialize();
        console.log('Submitting order payload:', payload);

        // Re-enable inputs immediately after serialization to avoid UI side-effects
        disabledTracker.forEach(function(el){ $(el).prop('disabled', false); });

        $('#createOrderBtn').prop('disabled', true).text('Processing...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: payload,
            traditional: true,
            success: function(resp, status, xhr) {
                console.log('Create order response:', resp, status, xhr);
                $('#createOrderBtn').prop('disabled', false).text('Create Order');
                if (resp && resp.success) {
                    $('#messages').html('<div class="alert alert-success">Order created successfully. Order ID: ' + (resp.order_id || '') + '</div>');
                    if (typeof resetForm === 'function') resetForm();
                } else {
                    var err = (resp && resp.error) ? resp.error : 'Failed to create order';
                    showError(err);
                }
            },
            error: function(xhr, status, err) {
                console.error('AJAX create error:', status, err, xhr.responseText);
                $('#createOrderBtn').prop('disabled', false).text('Create Order');
                var msg = 'Server error occurred';
                try { var r = JSON.parse(xhr.responseText); msg = r.error || JSON.stringify(r); } catch(e){
                    msg = xhr.responseText || msg;
                }
                showError(msg);
            }
        });
    });

    // Fix add-row binding: bind directly to #add_row (not delegated signature)
    $('#add_row').off('click').on('click', function(e){
        e.preventDefault();
        // initialize rowCount from existing rows if needed
        window.rowCount = window.rowCount || ($('#product_info_table tbody tr').length || 0);
        window.rowCount = parseInt(window.rowCount, 10) + 1;
        var id = window.rowCount;

        var newRow = (typeof window.createRow === 'function') ? window.createRow(id) : null;
        if (!newRow) return;

        $('#product_info_table tbody').append(newRow);

        // init select and trigger change so rate/stock/totals populate
        var $s = $('#product_' + id);
        if ($s.length) {
            $s.attr('data-row-id', id);
            if ($.fn.select2) { try { $s.select2({ width: '100%', placeholder: "Select Product", allowClear: true }); } catch(e) {} }
            $s.trigger('change');
        }

        // focus qty input for faster entry
        setTimeout(function(){ $('#qty_' + id).focus(); }, 30);

        // recalc totals (createRow or change handlers may already call this)
        if (typeof subAmount === 'function') setTimeout(subAmount, 40);
    });

    // Recalculate totals when qty/rate/amount inputs change
    $(document).on('input change', '.qty-input, .price-input, .amount-input', function(){
        var rid = $(this).closest('tr').attr('id')?.split('_')[1];
        if (!rid) return;
        if (typeof updateRowTotals === 'function') updateRowTotals(rid, $(this).hasClass('amount-input') ? 'amount' : ($(this).hasClass('price-input') ? 'rate' : 'qty'));
        else if (typeof getTotal === 'function') getTotal(rid);
    });

    $(document).on('change', 'select.product', function() {
        var $select = $(this);
        var rowId = $select.data('row-id');
        if (typeof rowId === 'undefined') return;

        var $opt = $select.find('option:selected');
        var price = Number($opt.attr('data-price')) || 0;
        var stockAttr = $opt.attr('data-stock');
        var stock = (stockAttr !== undefined && stockAttr !== '') ? parseInt(stockAttr, 10) : null;

        // apply price to inputs
        $('#rate_' + rowId).val(price.toFixed(2));
        $('#rate_value_' + rowId).val(price.toFixed(2));

        // enforce stock limit
        if (stock !== null && !isNaN(stock)) {
            $('#qty_' + rowId).attr('max', stock);
            var curQty = parseInt($('#qty_' + rowId).val(), 10) || 1;
            if (curQty > stock) {
                $('#qty_' + rowId).val(stock);
                $('#messages').html('<div class="alert alert-warning">Quantity adjusted to available stock (' + stock + ')</div>');
            }
        } else {
            $('#qty_' + rowId).removeAttr('max');
        }

        // recalc row total
        if (typeof updateRowTotals === 'function') {
            updateRowTotals(rowId, 'rate');
        } else if (typeof getTotal === 'function') {
            getTotal(rowId);
        }
    });
});
</script>
<script>
(function($){
    // Server products
    var serverProducts = <?php echo json_encode($products ?? []); ?>;

    // Build options HTML once
    var optsHtml = '<option value="">Select Product</option>';
    serverProducts.forEach(function(p) {
        var price = (parseFloat(p.price) || 0).toFixed(2);
        var stock = parseInt(p.current_stock || 0, 10) || 0;
        // NOTE: keep data-price/data-stock for JS logic, but do not show the price in the option text
        optsHtml += '<option value="' + p.id +
                    '" data-price="' + price +
                    '" data-stock="' + stock + '">' +
                    (p.name + ' - Stock: ' + stock) +
                    '</option>';
    });

    // Helpers
    function numberWithCommas(x){ if (x===null||x===undefined) return ''; return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }

    // Row management (expose globals)
    window.rowCount = window.rowCount || ($('#product_info_table tbody tr').length || 1);

    window.createRow = function(id){
        return `<tr id="row_${id}">
            <td style="position: relative;">
                <select class="form-control product" data-row-id="${id}" id="product_${id}" name="product[]" style="width:100%;" required>
                    ${optsHtml}
                </select>
            </td>
            <td>
                <!-- simplified qty input (no +/- buttons) -->
                <input type="number" name="qty[]" id="qty_${id}" class="form-control qty-input" value="1" min="1" onchange="updateRowTotals(${id},'qty')" required>
            </td>
            <td>
                <input type="number" name="rate[]" id="rate_${id}" class="form-control text-right price-input" value="0.00" step="0.01" min="0" onchange="updateRowTotals(${id},'rate')" oninput="updateRowTotals(${id},'rate')">
                <input type="hidden" name="rate_value[]" id="rate_value_${id}" value="0.00">
            </td>
            <td>
                <input type="number" name="amount[]" id="amount_${id}" class="form-control text-right amount-input" value="0.00" step="0.01" min="0" onchange="updateRowTotals(${id},'amount')" oninput="updateRowTotals(${id},'amount')">
                <input type="hidden" name="amount_value[]" id="amount_value_${id}" value="0.00">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow('${id}')"><i class="fa fa-times"></i></button>
            </td>
        </tr>`;
    }

    // Attach global functions used by inline handlers
    window.removeRow = function(rowId){
        $('#row_' + rowId).remove();
        subAmount();
    };

    /**
     * Update a row totals bi-directionally.
     * - source === 'amount'  -> user edited Total, compute rate = amount / qty (or set rate=amount when qty==0)
     * - source === 'rate'    -> user edited Price, compute total = qty * rate
     * - source === 'qty'     -> user edited Qty, compute total = qty * rate
     *
     * Keeps hidden rate_value/amount_value in sync and formats visible inputs to two decimals.
     */
    window.updateRowTotals = function(rowId, source){
        try {
            // read values defensively (allow string input from number fields)
            var rawQty = ($('#qty_' + rowId).val() === '' ? '0' : $('#qty_' + rowId).val());
            var rawRate = ($('#rate_' + rowId).val() === '' ? '0' : $('#rate_' + rowId).val());
            var rawAmount = ($('#amount_' + rowId).val() === '' ? '0' : $('#amount_' + rowId).val());

            var qty = parseFloat(String(rawQty).replace(/,/g, '')) || 0;
            var rate = parseFloat(String(rawRate).replace(/,/g, '')) || 0;
            var amount = parseFloat(String(rawAmount).replace(/,/g, '')) || 0;

            if (source === 'amount') {
                // user provided total -> compute rate
                amount = parseFloat(String($('#amount_' + rowId).val()).replace(/,/g, '')) || 0;
                if (qty > 0) {
                    var computedRate = amount / qty;
                    computedRate = isFinite(computedRate) ? computedRate : 0;
                    $('#rate_' + rowId).val(computedRate.toFixed(2));
                    $('#rate_value_' + rowId).val(computedRate.toFixed(2));
                } else {
                    // no qty: treat rate == amount (so user sees consistent numbers)
                    $('#rate_' + rowId).val(amount.toFixed(2));
                    $('#rate_value_' + rowId).val(amount.toFixed(2));
                }
                $('#amount_value_' + rowId).val(amount.toFixed(2));
            } else {
                // source 'rate' or 'qty' -> compute amount = qty * rate
                qty = parseFloat(String($('#qty_' + rowId).val()).replace(/,/g, '')) || 0;
                rate = parseFloat(String($('#rate_' + rowId).val()).replace(/,/g, '')) || 0;
                var computedAmount = qty * rate;
                computedAmount = isFinite(computedAmount) ? computedAmount : 0;
                $('#amount_' + rowId).val(computedAmount.toFixed(2));
                $('#amount_value_' + rowId).val(computedAmount.toFixed(2));
                $('#rate_value_' + rowId).val((parseFloat(rate) || 0).toFixed(2));
            }

            // update totals in footer/side
            if (typeof subAmount === 'function') subAmount();
        } catch (e) {
            console.error('updateRowTotals error for row ' + rowId, e);
        }
    };
})(jQuery);
</script>
<script src="<?php echo base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>"></script>
<script>
$(function(){

    // Authoritative (top) controls
    var $paidTop = $('[name="paid_status"]').first();
    var $amtTop  = $('[name="amount_paid"]').first();

    // Footer controls (mirror / read-only)
    var $paidFooter = $('[name="paid_status"]').last();
    var $amtFooter  = $('[name="amount_paid"]').last();
    var $amtFooterGroup = $amtFooter.closest('.form-group');

    // Make footer controls read-only/disabled so they don't interfere with form serialization
    if ($paidFooter.length) $paidFooter.prop('disabled', true);
    if ($amtFooter.length)  $amtFooter.prop('disabled', true).prop('readonly', true);

    // Centralized toggle — operates on the authoritative top controls and mirrors to footer
    window.toggleAmountPaidField = function() {
        try {
            var paidVal = String($paidTop.val() || '');
            var net = parseFloat($('#net_amount_value').val() || 0) || 0;

            if (paidVal === '2') { // Paid
                $amtTop.val(net.toFixed(2)).prop('readonly', true);
                $('#amount_paid_group').show();
                if ($amtFooterGroup.length) $amtFooterGroup.show();
            } else if (paidVal === '3') { // Partially
                $amtTop.prop('readonly', false);
                $('#amount_paid_group').show();
                if ($amtFooterGroup.length) $amtFooterGroup.show();
                if ($amtTop.val() === '' || isNaN(parseFloat($amtTop.val()))) $amtTop.val('0.00');
            } else { // Not Paid
                $amtTop.val('0.00').prop('readonly', false);
                $('#amount_paid_group').hide();
                if ($amtFooterGroup.length) $amtFooterGroup.hide();
            }

            // Mirror authoritative values to footer display
            if ($paidFooter.length) $paidFooter.val($paidTop.val());
            if ($amtFooter.length)  $amtFooter.val($amtTop.val());

        } catch (e) {
            console.error('toggleAmountPaidField error', e);
        }
    };

    // Bind changes on top controls -> update footer
    $paidTop.off('change.sync').on('change.sync', function(){ toggleAmountPaidField(); });
    $amtTop.off('input.sync').on('input.sync', function(){ 
        // validate numeric format while typing
        var v = $(this).val();
        $amtFooter.val(v);
    });

    // initialize
    toggleAmountPaidField();

    // Replace create button handler to use top controls (authoritative)
    $('#createOrderBtn').off('click.ajax').on('click.ajax', function(e){
        e.preventDefault();

        // Ensure top value is properly enforced (Paid -> amount_paid = net)
        toggleAmountPaidField();

        if (!validateForm()) return;

        // Sync per-row hidden fields
        $('#product_info_table tbody tr').each(function(){
            var rid = $(this).attr('id')?.split('_')[1];
            if (!rid) return;
            if (!$('#amount_value_' + rid).length) $(this).append('<input type="hidden" name="amount_value[]" id="amount_value_'+rid+'" value="0.00">');
            if (!$('#rate_value_' + rid).length)   $(this).append('<input type="hidden" name="rate_value[]" id="rate_value_'+rid+'" value="0.00">');
            $('#amount_value_' + rid).val( ($('#amount_' + rid).val() !== undefined && $('#amount_' + rid).val() !== '') ? $('#amount_' + rid).val() : $('#amount_value_' + rid).val() );
            $('#rate_value_' + rid).val( ($('#rate_' + rid).val() !== undefined && $('#rate_' + rid).val() !== '') ? $('#rate_' + rid).val() : $('#rate_value_' + rid).val() );
        });

        var form = $('#createOrderForm');

        // Make sure authoritative controls are enabled for serialization and footer ones are disabled
        // (footer should already be disabled, but ensure it)
        if ($paidFooter.length) $paidFooter.prop('disabled', true);
        if ($amtFooter.length)  $amtFooter.prop('disabled', true);

        var payload = form.serialize();
        console.log('Submitting order payload:', payload);

        $('#createOrderBtn').prop('disabled', true).text('Processing...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: payload,
            traditional: true,
            success: function(resp) {
                $('#createOrderBtn').prop('disabled', false).text('Create Order');
                if (resp && resp.success) {
                    $('#messages').html('<div class="alert alert-success">Order created successfully. Order ID: ' + (resp.order_id || '') + '</div>');
                    if (typeof resetForm === 'function') resetForm();
                } else {
                    showError(resp.error || 'Failed to create order');
                }
            },
            error: function(xhr) {
                $('#createOrderBtn').prop('disabled', false).text('Create Order');
                var msg = 'Server error occurred';
                try { var r = JSON.parse(xhr.responseText); msg = r.error || msg; } catch(e){}
                showError(msg);
            }
        });
    });

    // Replace the incorrect/delegated add-row handler and ensure existing selects initialize.
    // Ensure add-row button works: direct binding (works on create and edit)
    $('#add_row').off('click.addrow').on('click.addrow', function(e){
        e.preventDefault();
        window.rowCount = window.rowCount || ($('#product_info_table tbody tr').length || 0);
        window.rowCount = parseInt(window.rowCount, 10) + 1;
        var id = window.rowCount;

        var newRow = (typeof window.createRow === 'function') ? window.createRow(id) : null;
        if (!newRow) return;

        $('#product_info_table tbody').append(newRow);

        // init select and trigger change so rate/stock/totals populate
        var $s = $('#product_' + id);
        if ($s.length) {
            $s.attr('data-row-id', id);
            if ($.fn.select2) { try { $s.select2({ width: '100%', placeholder: "Select Product", allowClear: true }); } catch(e) {} }
            $s.trigger('change');
        }

        // focus qty input for faster entry and recalc totals
        setTimeout(function(){ $('#qty_' + id).focus(); if (typeof subAmount === 'function') subAmount(); }, 40);
    });

    // Initialize any existing product selects so price/stock pick-up and totals compute on load
    $('#product_info_table tbody select.product').each(function(){
        var $s = $(this);
        // ensure select2 present
        if ($.fn.select2) { try { $s.select2({ width: '100%', placeholder: "Select Product", allowClear: true }); } catch(e) {} }
        // trigger change to populate rate and recalc totals for rows already rendered (edit page)
        setTimeout(function(){ $s.trigger('change'); }, 20);
    });

    // locate the existing AJAX handler and ensure resetForm() is called on success:
    // Replace the success handler inside the create button AJAX with a call to resetForm()
    // (If multiple handlers exist they already check and call resetForm; this ensures coverage)

    // Example patch: ensure earlier success callback triggers resetForm if present
    // (No change to handler wiring here; the existing handlers below will call resetForm if defined)
});
</script>
<script>
/* Recalculate totals: gross, service_charge, vat_charge, discount, net_amount.
   (Replaced previous implementation with a robust, consistent version.)
*/
window.subAmount = function() {
    try {
        // Sum visible line totals (.amount-input). Fall back to hidden amount_value[] if present.
        var gross = 0;
        var found = false;
        $('.amount-input').each(function(){
            var v = parseFloat($(this).val() || 0) || 0;
            gross += v;
            found = true;
        });
        if (!found) {
            $('input[name="amount_value[]"]').each(function(){
                var v = parseFloat($(this).val() || 0) || 0;
                gross += v;
            });
        }

        // parse rates/values
        var sRate = parseFloat($('#service_charge_rate').val() || 0) || 0;
        var vRate = parseFloat($('#vat_charge_rate').val() || 0) || 0;

        // compute service and vat on gross
        var service = parseFloat((gross * sRate / 100) || 0);
        var vat = parseFloat(((gross + service) * vRate / 100) || 0);

        // discount (absolute)
        var discount = parseFloat($('#discount').val() || 0) || 0;

        // net amount
        var net = gross + service + vat - discount;
        if (!isFinite(net)) net = 0;

        // write values (two decimals)
        $('#gross_amount').val(gross.toFixed(2));
        $('#gross_amount_value').val(gross.toFixed(2));

        $('#service_charge').val(service.toFixed(2));
        $('#service_charge_value').val(service.toFixed(2));

        $('#vat_charge').val(vat.toFixed(2));
        $('#vat_charge_value').val(vat.toFixed(2));

        $('#net_amount').val(net.toFixed(2));
        $('#net_amount_value').val(net.toFixed(2));

        // if paid_status == Paid (2) ensure amount_paid equals net (authoritative top control)
        var paidStatus = String($('[name="paid_status"]').first().val() || '');
        if (paidStatus === '2') {
            $('[name="amount_paid"]').first().val(net.toFixed(2));
            // mirror to duplicates
            $('[name="amount_paid"]').val(net.toFixed(2));
        }
    } catch (e) {
        console.error('subAmount error', e);
    }
};

// Bindings to keep totals updated
$(document).ready(function(){
    // run on page load
    subAmount();

    // Recalculate when qty, rate (price) or amount inputs change
    $(document).off('input.subAmount change.subAmount', '.qty-input, .price-input, .amount-input, #discount').on('input.subAmount change.subAmount', '.qty-input, .price-input, .amount-input, #discount', function(){
        // ensure hidden amount_value for the row exists and sync it
        var rid = $(this).closest('tr').attr('id')?.split('_')[1];
        if (rid) {
            // Ensure hidden amount_value exists and is synced to visible amount
            if (!$('#amount_value_' + rid).length) {
                var v = $('#amount_' + rid).val() || '0';
                $(this).closest('tr').append('<input type="hidden" name="amount_value[]" id="amount_value_'+rid+'" value="'+parseFloat(v||0).toFixed(2)+'">');
            } else {
                if ($('#amount_' + rid).length) {
                    $('#amount_value_' + rid).val( (parseFloat($('#amount_' + rid).val()||0) || 0).toFixed(2) );
                }
            }
        }
        subAmount();
    });

    // When product selection changes: ensure rate is set and totals recalc
    $(document).off('change.subAmount', 'select.product').on('change.subAmount', 'select.product', function(){
        var $select = $(this);
        var rowId = $select.data('row-id');
        if (typeof rowId !== 'undefined') {
            var $opt = $select.find('option:selected');
            var price = Number($opt.attr('data-price')) || 0;
            $('#rate_' + rowId).val(price.toFixed(2));
            $('#rate_value_' + rowId).val(price.toFixed(2));
            // recalc row total via updateRowTotals (which calls subAmount)
            if (typeof updateRowTotals === 'function') updateRowTotals(rowId, 'rate');
            else subAmount();
        } else {
            // generic recalc
            subAmount();
        }
    });

    // Ensure recalculation after add/remove rows
    $(document).off('click.subAmount', '#add_row, .btn-danger').on('click.subAmount', '#add_row, .btn-danger', function(){
        // small delay to allow DOM changes
        setTimeout(subAmount, 40);
    });

    // Also ensure createRow calls subAmount after creating the row (safe-guard)
    var origCreateRow = window.createRow;
    if (typeof origCreateRow === 'function') {
        window.createRow = function(id){
            var html = origCreateRow(id);
            // after appending, caller already triggers change; still schedule subAmount
            setTimeout(subAmount, 40);
            return html;
        };
    }

    // initialize each existing row so price/amount/net compute immediately
    $('#product_info_table tbody tr[id^="row_"]').each(function(){
        var id = (this.id || '').split('_')[1];
        if (!id) return;

        var $sel = $('#product_' + id);
        var $qty = $('#qty_' + id);
        var $rate = $('#rate_' + id);
        var $amount = $('#amount_' + id);

        // set defaults if missing
        if ($qty.length && (!$qty.val() || parseFloat($qty.val()) <= 0)) $qty.val(1);
        if ($sel.length) {
            var $opt = $sel.find('option:selected');
            var price = Number($opt.attr('data-price')) || 0;
            if ($rate.length && ( $rate.val() === '' || parseFloat($rate.val()) === 0 )) {
                $rate.val(price.toFixed(2));
                if (!$('#rate_value_' + id).length) $rate.after('<input type="hidden" name="rate_value[]" id="rate_value_'+id+'" value="'+price.toFixed(2)+'">');
                else $('#rate_value_' + id).val(price.toFixed(2));
            }
        }

        // ensure hidden fields exist
        if (!$('#amount_value_' + id).length) {
            var amt = ($amount.length && $amount.val() !== '') ? parseFloat($amount.val()||0).toFixed(2) : '0.00';
            $amount.after('<input type="hidden" name="amount_value[]" id="amount_value_'+id+'" value="'+amt+'">');
        }

        // compute row totals using existing logic
        if (typeof updateRowTotals === 'function') {
            updateRowTotals(id, 'rate');
        } else {
            // fallback: compute simple total
            var qtyVal = parseFloat($qty.val()||0) || 0;
            var rateVal = parseFloat($rate.val()||0) || 0;
            var total = (qtyVal * rateVal) || 0;
            if ($amount.length) $amount.val(total.toFixed(2));
            if ($('#amount_value_' + id).length) $('#amount_value_' + id).val(total.toFixed(2));
        }
    });

    // recalc grand totals / net
    if (typeof subAmount === 'function') subAmount();
});
</script>
<script>
// Provide a global showError utility used by scripts
window.showError = window.showError || function(message) {
    $('#messages').html(
        '<div class="alert alert-danger alert-dismissible">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        message +
        '</div>'
    );
    if (window.console && console.error) console.error('showError:', message);
};
</script>
<script>
// basic client-side validation used by the Create button
window.validateForm = function() {
    var errors = [];
    var hasProducts = false;

    // required header fields
    if (!$('#customer_name').val() || !$('#customer_name').val().trim()) {
        errors.push('Client name is required.');
        $('#customer_name').addClass('error');
    } else {
        $('#customer_name').removeClass('error');
    }
    if (!$('#store_id').val()) {
        errors.push('Store is required.');
        $('#store_id').addClass('error');
    } else {
        $('#store_id').removeClass('error');
    }

    // product rows
    $('#product_info_table tbody tr').each(function(i){
        var $row = $(this);
        var pid = $row.find('select.product').val();
        var qty = parseFloat($row.find('.qty-input').val() || 0) || 0;
        var rate = parseFloat($row.find('.price-input').val() || 0) || 0;
        if (pid) {
            hasProducts = true;
            if (qty <= 0) {
                errors.push('Quantity must be > 0 in row ' + (i+1));
                $row.find('.qty-input').addClass('error');
            } else {
                $row.find('.qty-input').removeClass('error');
            }
            if (rate <= 0) {
                errors.push('Price must be > 0 in row ' + (i+1));
                $row.find('.price-input').addClass('error');
            } else {
                $row.find('.price-input').removeClass('error');
            }
        }
    });
    if (!hasProducts) errors.push('Add at least one product.');

    // payment validation (use authoritative top controls)
    var paidStatus = String($('[name="paid_status"]').first().val() || '1');
    var net = parseFloat($('#net_amount_value').val() || 0) || 0;
    var amtPaid = parseFloat($('[name="amount_paid"]').first().val() || 0) || 0;

    if (paidStatus === '2') {
        // enforce paid => amount_paid = net
        $('[name="amount_paid"]').first().val(net.toFixed(2));
    } else if (paidStatus === '3') {
        if (isNaN(amtPaid) || amtPaid <= 0) {
            errors.push('Enter a valid amount paid for partially paid orders.');
            $('[name="amount_paid"]').first().addClass('error');
        } else if (amtPaid > net) {
            errors.push('Amount paid cannot exceed net amount.');
            $('[name="amount_paid"]').first().addClass('error');
        } else {
            $('[name="amount_paid"]').first().removeClass('error');
        }
    }

    if (errors.length > 0) {
        showError('<ul style="margin:0;padding-left:18px;">' + errors.map(function(e){ return '<li>' + e + '</li>'; }).join('') + '</ul>');
        return false;
    }

    // clear messages if ok
    $('#messages').html('');
    return true;
};
</script>
<script>
/* resetForm: clear UI after successful order create */
window.resetForm = function() {
    try {
        // Clear header fields
        $('#customer_name').val('');
        $('#customer_phone').val('');
        $('#customer_address').val('');

        // Reset product rows
        $('#product_info_table tbody').html('');
        window.rowCount = 1;
        var rowHtml = (typeof window.createRow === 'function') ? window.createRow(1) : `
            <tr id="row_1">
                <td style="position: relative;">
                    <select class="form-control product" data-row-id="1" id="product_1" name="product[]" style="width:100%;" required>
                        ${optsHtml || '<option value=\"\">Select Product</option>'}
                    </select>
                </td>
                <td>
                    <!-- simplified qty input (removed + and - buttons) -->
                    <input type="number" name="qty[]" id="qty_1" class="form-control qty-input" value="1" min="1" onchange="updateRowTotals(1,'qty')" required>
                </td>
                <td>
                    <input type="number" name="rate[]" id="rate_1" class="form-control text-right price-input" onchange="updateRowTotals(1,'rate')" oninput="updateRowTotals(1,'rate')" step="0.01" min="0" style="font-size: 16px;">
                    <input type="hidden" name="rate_value[]" id="rate_value_1">
                </td>
                <td>
                    <!-- allow manual total entry; keep a hidden raw value for form submission -->
                    <input type="number" name="amount[]" id="amount_1" class="form-control text-right amount-input" step="0.01" min="0" onchange="updateRowTotals(1,'amount')" oninput="updateRowTotals(1,'amount')">
                    <input type="hidden" name="amount_value[]" id="amount_value_1">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1')"><i class="fa fa-times"></i></button>
                </td>
            </tr>`;
        $('#product_info_table tbody').append(rowHtml);

        // Re-init select2 & populate options
        var $sel = $('#product_1');
        if ($sel.length) {
            if ($sel.find('option').length <= 1 && typeof optsHtml !== 'undefined') $sel.html(optsHtml);
            if ($.fn.select2) { try { $sel.select2('destroy'); } catch(e){} $sel.select2({ width: '100%', placeholder: "Select Product", allowClear: true }); }
        }

        // Reset totals and hidden values
        $('#gross_amount').val('0.00'); $('#gross_amount_value').val('0.00');
        $('#service_charge').val('0.00'); $('#service_charge_value').val('0.00');
        $('#vat_charge').val('0.00'); $('#vat_charge_value').val('0.00');
        $('#net_amount').val('0.00'); $('#net_amount_value').val('0.00');
        $('#discount').val('0');

        // Reset payment controls (top authoritative)
        $('[name="paid_status"]').first().val('1').trigger('change');
        $('[name="amount_paid"]').first().val('0.00');

        // Clear messages and re-enable create button
        $('#messages').html('');
        $('#createOrderBtn').prop('disabled', false).text('Create Order');

        // focus first field
        $('#customer_name').focus();

        // ensure totals recalculation
        if (typeof subAmount === 'function') subAmount();
    } catch (e) {
        console.error('resetForm error', e);
    }
};
</script>
