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
                                <form role="form" id="createOrderForm" action="<?php echo base_url('Controller_Orders/create') ?>" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="customer_name">Client Name</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Client Name" autocomplete="off" required value="<?php echo isset($form_data['customer_name']) ? htmlspecialchars($form_data['customer_name']) : set_value('customer_name'); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_phone">Client Phone</label>
                                        <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Client Phone" autocomplete="off" value="<?php echo isset($form_data['customer_phone']) ? htmlspecialchars($form_data['customer_phone']) : set_value('customer_phone'); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="store_display">Store</label>
                                        <input type="text" class="form-control" id="store_display" value="<?php echo isset($store_data['store_name']) ? htmlspecialchars($store_data['store_name']) : ''; ?>" readonly>
                                        <input type="hidden" name="store_id" id="store_id" value="<?php echo isset($store_data['store_id']) ? htmlspecialchars($store_data['store_id']) : ''; ?>" required>
                                        <?php if (!isset($store_data['store_id'])): ?>
                                            <div class="alert alert-danger">
                                                Error: No store assigned to your account. Please contact administrator.
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="product-section">
                                        <div class="product-header">
                                            <h4>Products</h4>
                                            <button type="button" id="add_row" class="btn btn-primary">
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
                                                    <tr id="row_1">
                                                        <td>
                                                            <select class="form-control select_group product" data-row-id="1" 
                                                                    id="product_1" name="product[]" style="width:100%;" 
                                                                    onchange="getProductData(1)" required>
                                                                <option value="">Select Product</option>
                                                                <?php foreach ($products as $k => $v): ?>
                                                                    <option value="<?php echo $v['id'] ?>" 
                                                                            data-price="<?php echo $v['price'] ?>"
                                                                            data-stock="<?php echo $v['qty'] ?>">
                                                                        <?php echo $v['name'] ?> (Stock: <?php echo $v['qty'] ?>)
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-default btn-number" 
                                                                            onclick="decrementQty(1)">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </span>
                                                                <input type="number" name="qty[]" id="qty_1" 
                                                                       class="form-control qty-input" 
                                                                       value="1" min="1" 
                                                                       onchange="getTotal(1)" 
                                                                       required>
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-default btn-number" 
                                                                            onclick="incrementQty(1)">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="rate[]" id="rate_1" 
                                                                   class="form-control text-right price-input" 
                                                                   onchange="getTotal(1)" step="0.01" min="0"
                                                                   style="font-size: 16px;">
                                                            <input type="hidden" name="rate_value[]" id="rate_value_1">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="amount[]" id="amount_1" 
                                                                   class="form-control text-right" disabled>
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

                                    <div class="form-group">
                                        <button type="submit" id="createOrderBtn" class="btn btn-primary btn-lg btn-block">
                                            Create Order
                                        </button>
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
        /* POS Layout */
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
            padding: 15px;
            overflow-y: auto;
        }

        .pos-footer {
            padding: 15px;
            border-top: 1px solid #e7e7e7;
            background: #f9fafc;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control, select, input[type="number"], input[type="text"] {
            height: 40px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #d2d6de;
            border-radius: 4px;
            width: 100%;
        }

        select {
            background: #fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 24 24'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 10px center;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .input-group-btn .btn {
            height: 34px !important;
            width: 34px !important;
            padding: 0 !important;
            font-size: 14px !important;
            background-color: #f8f9fa !important;
            border-color: #ddd !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn {
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .btn-primary {
            background: #3c8dbc;
            border-color: #367fa9;
        }

        .btn-primary:hover {
            background: #367fa9;
        }

        .btn-danger {
            background: #dd4b39;
            border-color: #d73925;
        }

        .btn-default {
            background: #d2d6de;
            border-color: #c5c9d1;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        #product_info_table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        #product_info_table th, #product_info_table td {
            padding: 10px;
            border: 1px solid #e7e7e7;
            font-size: 13px;
        }

        #product_info_table th {
            background: #f4f6f9;
            font-weight: 600;
        }

        .totals-section {
            padding: 15px;
            background: #f9fafc;
            border-radius: 4px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 13px;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }

        .quick-action {
            padding: 10px;
            font-size: 13px;
            background: #e9ecef;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .quick-action:hover {
            background: #d2d6de;
        }

        /* Custom Styles */
        .qty-input {
            height: 34px !important;
            width: 60px !important;
            text-align: center !important;
            font-size: 14px !important;
            font-weight: normal !important;
            padding: 0 5px !important;
            border: 1px solid #ddd !important;
            background-color: #fff !important;
        }

        .price-input {
            font-weight: bold !important;
            background-color: #fff !important;
            border: 1px solid #ddd !important;
            padding: 8px !important;
        }

        .btn-number {
            height: 45px !important;
            width: 45px !important;
            padding: 0 !important;
            font-size: 16px !important;
            background-color: #f8f9fa !important;
            border-color: #ddd !important;
        }

        .btn-number:hover {
            background-color: #e9ecef !important;
        }

        #add_row {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            background-color: #3c8dbc;
            border-color: #367fa9;
            margin-left: auto;
        }

        #add_row i {
            font-size: 14px;
            color: #fff;
        }

        .product-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .product-header h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        /* Error Styles */
        .error {
            border-color: #dd4b39 !important;
            box-shadow: 0 0 3px #dd4b39 !important;
        }

        .select2-container--default.error .select2-selection--single {
            border-color: #dd4b39 !important;
            box-shadow: 0 0 3px #dd4b39 !important;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            #product_info_table th:nth-child(3),
            #product_info_table td:nth-child(3) {
                display: none;
            }

            .form-control, select, input[type="number"], input[type="text"] {
                height: 38px;
                font-size: 13px;
            }

            .btn, .quick-action {
                font-size: 13px;
                padding: 8px;
            }
        }

        @media (min-width: 1024px) {
            .pos-container {
                flex-direction: row;
            }

            .pos-content {
                width: 70%;
                border-right: 1px solid #e7e7e7;
            }

            .pos-footer {
                width: 30%;
                height: calc(100vh - 110px);
                overflow-y: auto;
            }
        }
    </style>

    <!-- Custom JS -->
    <script>
        // Initialize global variables from PHP values
        var service_charge_rate = <?php echo $company_data['service_charge_value'] ?? 0; ?>;
        var vat_charge_rate = <?php echo $company_data['vat_charge_value'] ?? 0; ?>;

        $(document).ready(function() {
            // Select2 initialization
            $(".select_group").select2({
                width: '100%',
                minimumResultsForSearch: 6
            });

            // Remove loading indicator when selecting products
            $('.product').select2({
                placeholder: "Select a Product",
                allowClear: true,
                width: '100%'
            });

            // Form submission
            $("#createOrderForm").submit(function(e) {
                e.preventDefault();
                
                // Clear previous errors
                $(".error").removeClass('error');
                $("#messages").empty();

                // Validate form data
                var isValid = validateOrderData();
                if (!isValid) {
                    return false;
                }

                // Debug logging for payment values
                var paid_status = $("#paid_status").val();
                var net_amount = parseFloat($("#net_amount_value").val().replace(/,/g, '')) || 0;
                var amount_paid = parseFloat($("#amount_paid").val().replace(/,/g, '')) || 0;

                console.log('=== Payment Debug ===');
                console.log('Paid Status:', paid_status);
                console.log('Net Amount:', net_amount);
                console.log('Amount Paid:', amount_paid);
                console.log('Is amount_paid >= net_amount?', amount_paid >= net_amount);
                console.log('==================');

                // Collect form data
                // Update the orderData object collection
                var orderData = {
                    customer_name: $("#customer_name").val().trim(),
                    customer_phone: $("#customer_phone").val().trim() || '',
                    customer_address: '', // Empty string instead of null
                    store_id: $("#store_id").val(),
                    gross_amount: $("#gross_amount_value").val() || '0', // Ensure not null
                    service_charge_rate: $("input[name='service_charge_rate']").val() || '0',
                    service_charge: $("#service_charge_value").val() || '0',
                    vat_charge_rate: $("input[name='vat_charge_rate']").val() || '0',
                    vat_charge: $("#vat_charge_value").val() || '0',
                    net_amount: $("#net_amount_value").val() || '0',
                    discount: $("#discount").val() || '0',
                    paid_status: paid_status,
                    amount_paid: amount_paid,
                    net_amount_value: net_amount
                };

                // Force convert any null/undefined values to '0.00'
                ['gross_amount', 'service_charge', 'vat_charge', 'net_amount', 'discount', 'amount_paid'].forEach(field => {
                    if (!orderData[field] || orderData[field] === 'null') {
                        orderData[field] = '0.00';
                    }
                });

                // Add validation before submission
                if (!orderData.gross_amount || orderData.gross_amount === 'null' || orderData.gross_amount === '') {
                    orderData.gross_amount = '0';
                }

                // Collect and validate products data
                var products = [];
                var hasStockError = false;
                $("#product_info_table tbody tr").each(function(index) {
                    var $row = $(this);
                    var product_id = $row.find('select.product').val();
                    var qty = parseInt($row.find('input[name="qty[]"]').val());
                    var stock = parseInt($row.find('select.product option:selected').data('stock')) || 0;
                    var rate = parseFloat($row.find('input[name="rate[]"]').val());
                    
                    if (qty > stock) {
                        hasStockError = true;
                        $row.find('input[name="qty[]"]').addClass('error');
                        $("#messages").append(
                            '<div class="alert alert-danger">Product in row ' + (index + 1) + 
                            ' exceeds available stock (' + stock + ')</div>'
                        );
                        return false;
                    }

                    if (product_id && qty > 0 && rate > 0) {
                        orderData['product[' + index + ']'] = product_id;
                        orderData['qty[' + index + ']'] = qty;
                        orderData['rate[' + index + ']'] = rate.toFixed(2);
                        orderData['amount[' + index + ']'] = (qty * rate).toFixed(2);
                    }
                });

                if (hasStockError) {
                    return false;
                }

                // Log the data being sent
                console.log('Sending order data:', orderData);

                // Disable submit button and show loading state
                $("#createOrderBtn")
                    .prop('disabled', true)
                    .html('<i class="fa fa-spinner fa-spin"></i> Processing...');

                // Send AJAX request
                $.ajax({
                    url: '<?php echo base_url('Controller_Orders/create') ?>',
                    type: 'POST',
                    data: orderData,
                    dataType: 'json',
                    beforeSend: function() {
                        console.log('Sending payment data:', {
                            paid_status: orderData.paid_status,
                            amount_paid: orderData.amount_paid,
                            net_amount: orderData.net_amount_value
                        });
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#messages").html(
                                '<div class="alert alert-success alert-dismissible">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                'Order created successfully!</div>'
                            );
                            
                            if (response.order_id) {
                                // Check for Android POS device first
                                if (typeof Android !== 'undefined') {
                                    try {
                                        // Send print command to Android
                                        Android.printReceipt(JSON.stringify({
                                            order_id: response.order_id,
                                            order_data: response.order_data,
                                            items: response.order_items
                                        }));

                                        // Open cash drawer if available
                                        if (typeof Android.openCashDrawer === 'function') {
                                            Android.openCashDrawer();
                                        }
                                    } catch (e) {
                                        console.error('Android POS Error:', e);
                                        // Fallback to browser printing
                                        fallbackPrinting(response.order_id);
                                    }
                                } else {
                                    // Regular browser printing
                                    fallbackPrinting(response.order_id);
                                }

                                // Reset form after successful print
                                resetForm();
                            }
                        } else {
                            $("#messages").html(
                                '<div class="alert alert-danger alert-dismissible">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                (response.error || 'Failed to create order') + '</div>'
                            );
                        }
                        
                        // Reset button state
                        $("#createOrderBtn").prop('disabled', false).html('Create Order');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', {
                            status: status,
                            error: error,
                            response: xhr.responseText
                        });
                        
                        // Try to extract the actual database error message
                        let errorMessage = 'Server error occurred.';
                        try {
                            if (xhr.responseText.includes('A Database Error Occurred')) {
                                const match = xhr.responseText.match(/<p>(.*?)<\/p>/g);
                                if (match && match.length > 1) {
                                    // Get the actual error message (second <p> tag)
                                    errorMessage = match[1].replace(/<\/?p>/g, '');
                                }
                            }
                        } catch (e) {
                            console.error('Error parsing error message:', e);
                        }
                        
                        $("#messages").html(
                            '<div class="alert alert-danger alert-dismissible">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            errorMessage + '</div>'
                        );
                        $("#createOrderBtn").prop('disabled', false).html('Create Order');
                    }
                });
            });

            // Add product row
            $("#add_row").click(function(e) {
                e.preventDefault(); // Prevent form submission
                
                var table = $("#product_info_table");
                var count_table_tbody_tr = $("#product_info_table tbody tr").length;
                var row_id = count_table_tbody_tr + 1;

                $.ajax({
                    url: '<?php echo base_url('Controller_Orders/getTableProductRow'); ?>',
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        // Clear any existing messages
                        $("#messages").empty();

                        if (response.error) {
                            $("#messages").html(
                                '<div class="alert alert-danger alert-dismissible">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                'Failed to load products: ' + response.error + '</div>'
                            );
                            return;
                        }

                        var hasAvailableProducts = false;
                        var options = '<option value="">Select Product</option>';
                        
                        $.each(response, function(index, value) {
                            if (parseInt(value.qty) > 0) {
                                hasAvailableProducts = true;
                                options += '<option value="' + value.id + '" ' +
                                          'data-price="' + value.price + '" ' +
                                          'data-stock="' + value.qty + '">' +
                                          value.name + ' (Stock: ' + value.qty + ')</option>';
                            }
                        });

                        if (!hasAvailableProducts) {
                            $("#messages").html(
                                '<div class="alert alert-warning alert-dismissible">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                'No products with available stock.</div>'
                            );
                            return;
                        }

                        var html = '<tr id="row_' + row_id + '">' +
                            '<td>' +
                            '<select class="form-control select_group product" ' +
                            'data-row-id="' + row_id + '" ' +
                            'id="product_' + row_id + '" ' +
                            'name="product[]" ' +
                            'style="width:100%;" ' +
                            'onchange="getProductData(' + row_id + ')" required>' +
                            options +
                            '</select>' +
                            '</td>' +
                            '<td>' +
                            '<div class="input-group">' +
                            '<span class="input-group-btn">' +
                            '<button type="button" class="btn btn-default btn-number" onclick="decrementQty(' + row_id + ')">' +
                            '<i class="fa fa-minus"></i>' +
                            '</button>' +
                            '</span>' +
                            '<input type="number" name="qty[]" id="qty_' + row_id + '" ' +
                            'class="form-control text-center qty-input" value="1" min="1" ' +
                            'onchange="getTotal(' + row_id + ')" required>' +
                            '<span class="input-group-btn">' +
                            '<button type="button" class="btn btn-default btn-number" onclick="incrementQty(' + row_id + ')">' +
                            '<i class="fa fa-plus"></i>' +
                            '</button>' +
                            '</span>' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<input type="number" name="rate[]" id="rate_' + row_id + '" ' +
                            'class="form-control text-right price-input" ' +
                            'onchange="getTotal(' + row_id + ')" step="0.01" min="0">' +
                            '<input type="hidden" name="rate_value[]" id="rate_value_' + row_id + '">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="amount[]" id="amount_' + row_id + '" ' +
                            'class="form-control text-right" disabled>' +
                            '<input type="hidden" name="amount_value[]" id="amount_value_' + row_id + '">' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<button type="button" class="btn btn-danger btn-sm" onclick="removeRow(' + row_id + ')">' +
                            '<i class="fa fa-times"></i>' +
                            '</button>' +
                            '</td>' +
                            '</tr>';

                        $("#product_info_table tbody").append(html);
                        
                        // Initialize select2 for the new row
                        $("#product_" + row_id).select2({
                            width: '100%',
                            minimumResultsForSearch: 6
                        });

                        // Clear the new row's values
                        $("#rate_" + row_id).val('');
                        $("#amount_" + row_id).val('');
                        
                        // Update totals
                        subAmount();
                    },
                    error: function() {
                        $("#messages").html(
                            '<div class="alert alert-danger alert-dismissible">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Failed to load products. Please check your network.</div>'
                        );
                    }
                });
            });
        });

        function validateForm() {
            var errors = [];
            
            // Check customer name
            if (!$("#customer_name").val().trim()) {
                errors.push("Client name is required");
            }

            // Check store
            if (!$("#store_id").val()) {
                errors.push("Store is required");
            }

            // Check products
            var hasProducts = false;
            $("#product_info_table tbody tr").each(function() {
                var row = $(this);
                var product_id = row.find('.product').val();
                var qty = row.find('input[name="qty[]"]').val();
                
                if (product_id) {
                    hasProducts = true;
                    if (!qty || qty <= 0) {
                        errors.push("Quantity is required for all products");
                    }
                }
            });

            if (!hasProducts) {
                errors.push("At least one product is required");
            }

            // Show all errors if any
            if (errors.length > 0) {
                var errorHtml = '<div class="alert alert-danger alert-dismissible">' +
                               '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                               '<ul style="margin-bottom: 0; padding-left: 20px;">';
        
                errors.forEach(function(error) {
                    errorHtml += '<li>' + error + '</li>';
                });
        
                errorHtml += '</ul></div>';
        
                $("#messages").html(errorHtml);
                return false;
            }

            return true;
        }

        function validateOrderData() {
            // Clear previous errors
            $(".error").removeClass('error');
            $("#messages").empty();

            let errors = [];
            let isValid = true;

            // Validate customer name
            const customerName = $("#customer_name").val().trim();
            if (!customerName) {
                $("#customer_name").addClass('error');
                errors.push("Client name is required");
                isValid = false;
            }

            // Validate store
            const storeId = $("#store_id").val();
            if (!storeId) {
                $("#store_display").addClass('error');
                errors.push("Store is required");
                isValid = false;
            }

            // Validate products
            let hasProducts = false;
            $("#product_info_table tbody tr").each(function(index) {
                const $row = $(this);
                const productId = $row.find('select.product').val();
                const qty = parseInt($row.find('input[name="qty[]"]').val());
                const stock = parseInt($row.find('select.product option:selected').data('stock')) || 0;
                const rate = parseFloat($row.find('input[name="rate[]"]').val());

                if (productId) {
                    hasProducts = true;
                    
                    if (!qty || qty <= 0) {
                        $row.find('input[name="qty[]"]').addClass('error');
                        errors.push(`Quantity is required for product in row ${index + 1}`);
                        isValid = false;
                    } else if (qty > stock) {
                        $row.find('input[name="qty[]"]').addClass('error');
                        errors.push(`Quantity (${qty}) exceeds available stock (${stock}) in row ${index + 1}`);
                        isValid = false;
                    }

                    if (!rate || rate <= 0) {
                        $row.find('input[name="rate[]"]').addClass('error');
                        errors.push(`Valid price is required for product in row ${index + 1}`);
                        isValid = false;
                    }
                }
            });

            if (!hasProducts) {
                errors.push("At least one product is required");
                isValid = false;
            }

            // Validate amounts
            const grossAmount = parseFloat($("#gross_amount_value").val()) || 0;
            const netAmount = parseFloat($("#net_amount_value").val()) || 0;

            if (grossAmount < 0) {
                errors.push("Gross amount cannot be negative");
                isValid = false;
            }

            if (netAmount < 0) {
                errors.push("Net amount cannot be negative");
                isValid = false;
            }

            // Display validation errors if any
            if (errors.length > 0) {
                let errorHtml = '<div class="alert alert-danger alert-dismissible">' +
                               '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                               '<ul style="margin-bottom: 0;">';
                       
                errors.forEach(error => {
                    errorHtml += `<li>${error}</li>`;
                });
                
                errorHtml += '</ul></div>';
                $("#messages").html(errorHtml);
            }

            return isValid;
        }

        function getProductData(row_id) {
            var product_id = $("#product_"+row_id).val();    
            if(product_id) {
                $.ajax({
                    url: '<?php echo base_url('Controller_Orders/getProductValueById') ?>',
                    type: 'post',
                    data: {product_id : product_id},
                    dataType: 'json',
                    success:function(response) {
                        $("#rate_"+row_id).val(response.price);
                        $("#rate_value_"+row_id).val(response.price);
                        $("#stock_"+row_id).val(response.qty);
                        $("#stock_value_"+row_id).val(response.qty);
                        
                        // Just call getTotal directly without showing/hiding preloader
                        getTotal(row_id);
                    },
                    error: function() {
                        $("#messages").html(
                            '<div class="alert alert-danger alert-dismissible">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Failed to load product data.</div>'
                        );
                    }
                });
            } else {
                // Reset fields
                $("#rate_"+row_id).val('');
                $("#rate_value_"+row_id).val('');
                $("#stock_"+row_id).val('');
                $("#stock_value_"+row_id).val('');
                getTotal(row_id);
            }
        }

        function getTotal(row_id) {
            var qty = $("#qty_" + row_id).val() || 0;
            var rate = $("#rate_" + row_id).val() || 0;
            var stock = parseInt($("#product_" + row_id + " option:selected").data('stock')) || 0;

            if (qty && rate && stock > 0) {
                var total = (parseFloat(rate) * parseFloat(qty)).toFixed(2);
                $("#amount_" + row_id).val(total);
                $("#amount_value_" + row_id).val(total);
            } else {
                $("#amount_" + row_id).val("0.00");
                $("#amount_value_" + row_id).val("0.00");
            }
            subAmount();
        }

        function subAmount() {
            var totalSubAmount = 0;
            $("#product_info_table tbody tr").each(function() {
                var amount = $(this).find("input[name='amount_value[]']").val();
                if (amount) totalSubAmount += parseFloat(amount);
            });

            // Format for display vs hidden value
            var totalFormatted = totalSubAmount.toFixed(2);
            $("#gross_amount").val(numberWithCommas(totalFormatted));  // Display with commas
            $("#gross_amount_value").val(totalFormatted);  // Hidden without commas

            // Calculate other charges using global variables
            var service_charge = ((totalSubAmount * service_charge_rate) / 100).toFixed(2);
            var vat_charge = ((totalSubAmount * vat_charge_rate) / 100).toFixed(2);
            var discount = parseFloat($("#discount").val() || 0).toFixed(2);

            // Set values without commas for calculations
            $("#service_charge_value").val(service_charge);
            $("#vat_charge_value").val(vat_charge);
            
            // Display with commas
            $("#service_charge").val(numberWithCommas(service_charge));
            $("#vat_charge").val(numberWithCommas(vat_charge));

            // Calculate net amount
            var net_amount = (parseFloat(totalSubAmount) + 
                             parseFloat(service_charge) + 
                             parseFloat(vat_charge) - 
                             parseFloat(discount)).toFixed(2);

            console.log('subAmount calculation:', {
                totalSubAmount: totalSubAmount,
                service_charge: service_charge,
                vat_charge: vat_charge,
                discount: discount,
                net_amount: net_amount
            });

            $("#net_amount_value").val(net_amount);
            $("#net_amount").val(numberWithCommas(net_amount));  // Display with commas

            // Update amount paid if paid status is "Paid"
            if ($("#paid_status").val() == "2") {
                $("#amount_paid").val(net_amount);
            } else if ($("#paid_status").val() == "3") {
                // For partial payments, ensure amount paid is less than total
                var current_paid = parseFloat($("#amount_paid").val()) || 0;
                if (current_paid >= parseFloat(net_amount)) {
                    $("#amount_paid").val('');
                }
                $("#amount_paid").attr('max', net_amount);
            }
        }

        // Helper function for comma formatting
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function toggleAmountPaidField() {
            var paid_status = $("#paid_status").val();
            var net_amount = parseFloat($("#net_amount_value").val().replace(/,/g, '')) || 0;

            $("#amount_paid_group").show();
            
            switch(paid_status) {
                case "3": // Partially Paid
                    $("#amount_paid")
                        .prop('disabled', false)
                        .prop('required', true)
                        .val('')
                        .attr('max', net_amount)
                        .on('input', function() {
                            var amount_paid = parseFloat($(this).val()) || 0;
                            // Clear previous error
                            $("#messages").empty();
                            
                            if (amount_paid >= net_amount) {
                                $("#messages").html(
                                    '<div class="alert alert-warning alert-dismissible">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    'Partial payment must be less than total amount (' + numberWithCommas(net_amount.toFixed(2)) + ')</div>'
                                );
                                $(this).val('');
                            }
                        });
                    break;
                    
                case "2": // Paid
                    $("#amount_paid")
                        .val(net_amount.toFixed(2))
                        .prop('disabled', true)
                        .prop('required', true);
                    break;
                    
                default: // Not Paid
                    $("#amount_paid_group").hide();
                    $("#amount_paid")
                        .val('0')
                        .prop('disabled', true)
                        .prop('required', false);
                    break;
            }
        }

        function incrementQty(row_id) {
            var qty = parseInt($("#qty_" + row_id).val()) || 0;
            var max = parseInt($("#product_" + row_id + " option:selected").data('stock')) || 0;
            if (qty < max) {
                $("#qty_" + row_id).val(qty + 1);
                getTotal(row_id);
            } else {
                $("#messages").html(
                    '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Maximum available stock reached.</div>'
                );
            }
        }

        function decrementQty(row_id) {
            var qty = parseInt($("#qty_" + row_id).val()) || 0;
            if (qty > 1) {
                $("#qty_" + row_id).val(qty - 1);
                getTotal(row_id);
            }
        }

        function removeRow(row_id) {
            if ($("#product_info_table tbody tr").length > 1) {
                $("#row_" + row_id).fadeOut(300, function() {
                    $(this).remove();
                    subAmount();
                });
            } else {
                $("#messages").html(
                    '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>At least one product is required.</div>'
                );
                $("#product_" + row_id).val('').trigger('change');
                $("#qty_" + row_id).val(1);
                $("#rate_" + row_id).val('');
                $("#amount_" + row_id).val('');
                subAmount();
            }
        }

        function resetForm() {
            $("#createOrderForm")[0].reset();
            $("#product_info_table tbody").html(
                '<tr id="row_1">' +
                '<td><select class="form-control select_group product" data-row-id="1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>' +
                '<option value="">Select Product</option>' +
                '<?php foreach ($products as $k => $v): ?>' +
                '<option value="<?php echo $v['id'] ?>" data-price="<?php echo $v['price'] ?>" data-stock="<?php echo $v['qty'] ?>">' +
                '<?php echo $v['name'] ?> (Stock: <?php echo $v['qty'] ?>)' +
                '</option>' +
                '<?php endforeach ?>' +
                '</select></td>' +
                '<td><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default" onclick="decrementQty(1)">-</button></span>' +
                '<input type="number" name="qty[]" id="qty_1" class="form-control text-center qty-input" required min="1" value="1" onchange="getTotal(1)">' +
                '<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="incrementQty(1)">+</button></span></div></td>' +
                '<td><input type="number" name="rate[]" id="rate_1" class="form-control text-right price-input" onchange="getTotal(1)" step="0.01" min="0" style="font-size: 16px;">' +
                '<input type="hidden" name="rate_value[]" id="rate_value_1"></td>' +
                '<td><input type="text" name="amount[]" id="amount_1" class="form-control text-right" disabled>' +
                '<input type="hidden" name="amount_value[]" id="amount_value_1"></td>' +
                '<td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\'1\')"><i class="fa fa-times"></i></button></td>' +
                '</tr>'
            );
            $(".select_group").select2({ width: '100%', minimumResultsForSearch: 6 });
            subAmount();
        }

        function handlePOSOperations(orderId) {
            const posType = detectPOSHardware();
            switch (posType) {
                case 'ANDROID':
                    try {
                        if (typeof Android !== 'undefined') {
                            Android.printReceipt(orderId);
                            Android.openDrawer();
                        }
                    } catch (e) {
                        console.error('Android POS Error:', e);
                        fallbackPrinting(orderId);
                    }
                    break;
                default:
                    fallbackPrinting(orderId);
            }
        }

        function detectPOSHardware() {
            try {
                if (typeof Android !== 'undefined') {
                    return 'ANDROID';
                }
                return 'BROWSER';
            } catch (e) {
                console.error('Hardware detection error:', e);
                return 'BROWSER';
            }
        }

        function fallbackPrinting(orderId) {
            var printWindow = window.open(
                '<?php echo base_url('Controller_Orders/thermalPrint/'); ?>' + orderId,
                'thermal_print',
                'width=400,height=600'
            );
            
            if (printWindow) {
                printWindow.onload = function() {
                    try {
                        printWindow.focus();
                        printWindow.print();
                        setTimeout(function() {
                            printWindow.close();
                        }, 1000);
                    } catch (e) {
                        console.error('Print error:', e);
                        showPrintError();
                    }
                };
            } else {
                showPrintError();
            }
        }

        // Add helper function for print errors
        function showPrintError() {
            $("#messages").append(
                '<div class="alert alert-warning alert-dismissible">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                'Could not print receipt. Please try manual printing.</div>'
            );
        }

        // Add Android detection function
        function isAndroidPOS() {
            return typeof Android !== 'undefined' && 
                   typeof Android.printReceipt === 'function';
        }

        // Add function to handle barcode scanning
        function handleBarcodeScan() {
            if (typeof Android !== 'undefined' && typeof Android.startBarcodeScanner === 'function') {
                Android.startBarcodeScanner(function(barcode) {
                    if (barcode) {
                        // Add product by barcode
                        addProductByBarcode(barcode);
                    }
                });
            } else {
                $("#messages").html(
                    '<div class="alert alert-warning alert-dismissible">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    'Barcode scanner not available on this device.</div>'
                );
            }
        }
    </script>