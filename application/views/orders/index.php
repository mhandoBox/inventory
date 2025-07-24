<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

<!-- DataTables Core CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css">

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Custom CSS -->
<style>
    .dataTables_wrapper .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        text-align: center;
        padding: 1em 0;
    }
    .pagination .page-item .page-link {
        color: #333;
        background-color: #fff;
        border: 1px solid #ddd;
        margin: 0 2px;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #ddd;
    }
    /* Dropdown styling */
    .btn-group {
        position: relative;
        display: inline-flex;
    }
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: 4px;
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }
    .dropdown-menu.show {
        display: block;
    }
    .dropdown-item {
        display: block;
        width: 100%;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        color: #333;
        text-align: inherit;
        white-space: nowrap;
        background: none;
        border: 0;
        text-decoration: none;
    }
    .dropdown-item:hover, .dropdown-item:focus {
        color: #262626;
        text-decoration: none;
        background-color: #f5f5f5;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Orders
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
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createOrder', $user_permission)): ?>
          <a href="<?php echo base_url('Controller_Orders/create') ?>" class="btn btn-primary">Add Order</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Bill No.</th>
                  <th>Client</th>
                  <th>Contact</th>
                  <th>DateTime</th>
                  <th>Prod.Qty</th>
                  <th>Amount</th>
                  <th>Clerk</th>
                  <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                    <th>Actions</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
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

<?php if(in_array('deleteOrder', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Orders/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- Add this before closing body tag -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Print Preview</h4>
      </div>
      <div class="modal-body" id="printDiv">
        <!-- Print content will be loaded here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="printOrder()">Print</button>
      </div>
    </div>
  </div>
</div>

<!-- Core jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap Integration -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>

<!-- DataTables Buttons and Extensions -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- Export Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

<!-- Initialize Bootstrap Dropdowns -->
<script>
$(document).ready(function() {
    // Initialize Bootstrap dropdowns
    $('[data-toggle="dropdown"]').dropdown();
    
    // Re-initialize dropdowns after DataTable updates
    $('#manageTable').on('draw.dt', function() {
        $('[data-toggle="dropdown"]').dropdown();
    });
});</script>

<script type="text/javascript">
$(document).ready(function() {
    // Disable jvectormap initialization if it exists
    if (typeof dashboard !== 'undefined' && dashboard.initJVector) {
        dashboard.initJVector = function() { /* empty */ };
    }

    // Set active navigation
    $("#mainOrdersNav").addClass('active');
    $("#manageOrdersNav").addClass('active');

    // Initialize DataTable with improved error handling and logging
    var manageTable = $('#manageTable').DataTable({
        "processing": true,
        "serverSide": false,
        "pageLength": 10,
        "responsive": true,
        "dom": '<"top"Blf>rt<"bottom"ip><"clear">',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            "url": '<?php echo base_url('Controller_Orders/fetchOrdersData'); ?>',
            "type": 'POST',
            "dataType": 'json',
            "data": function(d) {
                return $.extend({}, d, {
                    '<?php echo addslashes($this->security->get_csrf_token_name()); ?>': '<?php echo addslashes($this->security->get_csrf_hash()); ?>'
                });
            },
            "dataSrc": function(response) {
                return response && response.data ? response.data : [];
            },
            "error": function(xhr, status, error) {
                alert('Failed to load orders. Please try again or contact administrator.');
            }
        },
        "columns": [
            {"data": "bill_no", "defaultContent": "N/A"},
            {"data": "customer_name", "defaultContent": "N/A"},
            {"data": "customer_phone", "defaultContent": "N/A"},
            {"data": "date_time", "defaultContent": "N/A"},
            {
                "data": "total_products",
                "render": function(data) {
                    return data ? parseInt(data).toLocaleString() : '0';
                },
                "defaultContent": "0"
            },
            {
                "data": "total_amount",
                "render": function(data) {
                    return data ? 'TZS ' + parseFloat(data).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',') : 'TZS 0.00';
                }
            },
            {"data": "clerk_name", "defaultContent": "Unknown"},
            {
                "data": null,
                "render": function(data) {
                    var buttons = '<div class="btn-group dropright">';
                    buttons += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
                    buttons += '<ul class="dropdown-menu dropdown-menu-right" role="menu">';
                    <?php if(in_array('updateOrder', $user_permission)): ?>
                    buttons += '<li><a href="javascript:void(0)" onclick="editOrder(' + data.id + ')" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a></li>';
                    <?php endif; ?>
                    buttons += '<li><a href="javascript:void(0)" onclick="printInvoice(' + data.id + ')" class="dropdown-item"><i class="fa fa-print"></i> Print Invoice</a></li>';
                    <?php if(in_array('deleteOrder', $user_permission)): ?>
                    buttons += '<li><a href="javascript:void(0)" onclick="deleteOrder(' + data.id + ')" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a></li>';
                    <?php endif; ?>
                    buttons += '</ul></div>';
                    return buttons;
                }
            }
        ],
        "order": [[3, "desc"]],
        "language": {
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
            "emptyTable": "No orders found",
            "zeroRecords": "No matching orders found",
            "info": "Showing _START_ to _END_ of _TOTAL_ orders",
            "infoEmpty": "Showing 0 to 0 of 0 orders",
            "infoFiltered": "(filtered from _MAX_ total orders)",
            "paginate": {
                "previous": "Previous",
                "next": "Next",
                "first": "First",
                "last": "Last"
            }
        },
        "pagingType": "full_numbers"
    });
});

function editOrder(id) {
    window.location.href = '<?php echo base_url("Controller_Orders/edit/"); ?>' + id;
}

function printInvoice(id) {
    if (!id) {
        console.error('Invalid order ID');
        return;
    }

    // Create print window
    var printWindow = window.open('', '_blank', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Invoice</title>');
    printWindow.document.write('<style>');
    printWindow.document.write(`
        @media print {
            body { margin: 0; padding: 20px; }
            .invoice-container { max-width: 100%; }
            .print-header { display: none; }
        }
        body { font-family: Arial, sans-serif; }
        .invoice-container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .print-header { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f5f5f5; }
        .text-right { text-align: right; }
    `);
    printWindow.document.write('</style></head><body>');
    
    // Show loading message
    printWindow.document.write('<div style="text-align: center; padding: 20px;"><i class="fa fa-spinner fa-spin"></i> Loading invoice...</div>');
    
    // Fetch invoice content
    $.ajax({
        url: '<?php echo base_url("Controller_Orders/printDiv/"); ?>' + id,
        type: 'GET',
        cache: false,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            try {
                // Check if response is an error message
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.error) {
                    printWindow.document.body.innerHTML = '<div class="alert alert-danger">' + jsonResponse.error + '</div>';
                    return;
                }
            } catch(e) {
                // Not JSON, it's the invoice HTML content
                printWindow.document.body.innerHTML = '<div class="invoice-container">' + response + '</div>';
                
                // Add print button at the top
                var printButton = '<div class="print-header"><button onclick="window.print(); return false;" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Print Invoice</button></div>';
                printWindow.document.body.insertAdjacentHTML('afterbegin', printButton);
                
                // Auto print setup
                printWindow.onload = function() {
                    // Add event listener for after print
                    printWindow.onafterprint = function() {
                        // Optional: close the window after printing
                        // printWindow.close();
                    };
                };
            }
        },
        error: function(xhr, status, error) {
            printWindow.document.body.innerHTML = '<div class="alert alert-danger">Error loading invoice. Please try again.</div>';
        }
    });
    
    printWindow.document.write('</body></html>');
    printWindow.document.close();
}

function deleteOrder(id) {
    if (!id) {
        console.error('Invalid order ID for deletion');
        return;
    }
    if (confirm('Are you sure you want to delete this order?')) {
        $.ajax({
            url: '<?php echo base_url('Controller_Orders/remove'); ?>',
            type: 'POST',
            data: {
                id: id,
                '<?php echo addslashes($this->security->get_csrf_token_name()); ?>': '<?php echo addslashes($this->security->get_csrf_hash()); ?>'
            },
            dataType: 'json',
            success: function(response) {
                console.log('Delete response:', response);
                if (response.success) {
                    $('#manageTable').DataTable().ajax.reload(null, false);
                    alert('Order deleted successfully');
                } else {
                    alert(response.messages || 'Failed to delete order');
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting order. Please try again.');
            }
        });
    }
}
</script>