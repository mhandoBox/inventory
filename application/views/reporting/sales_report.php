<!-- reporting/sales_report.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="content-wrapper">
  <section class="content-header">
    <h1>Sales Report <small>Sales Activity Overview</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
      <li class="active">Sales</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Sales Report</h3>
          </div>
          <div class="box-body">
            <button class="btn btn-default mb-3" onclick="window.print()"><i class="fa fa-print"></i> Print</button>

            <!-- Modal -->
            <div class="modal fade" id="saleDetailsModal" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sale Details</h4>
                  </div>
                  <div class="modal-body" id="saleDetailsBody"></div>
                </div>
              </div>
            </div>

            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($report)): ?>
                  <?php foreach ($report as $row): ?>
                    <tr class="sale-row"
                      data-orderid="<?php echo htmlspecialchars($row['order_id']); ?>"
                      data-items='<?php echo htmlspecialchars(json_encode($row['items'] ?? []), ENT_QUOTES, 'UTF-8'); ?>'>
                      <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                      <td><?php echo date('Y-m-d H:i', strtotime($row['date'])); ?></td>
                      <td><?php echo htmlspecialchars($row['customer']); ?></td>
                      <td><?php echo number_format($row['total'], 2); ?></td>
                      <td><?php echo ucfirst($row['status']); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="5" class="text-center">No sales data found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>

            <hr>
            <div class="row">
              <div class="col-md-4">
                <strong>Total Revenue:</strong> <?php echo number_format($aggregates['total_revenue'] ?? 0, 2); ?>
              </div>
              <div class="col-md-4">
                <strong>Total Orders:</strong> <?php echo number_format($aggregates['total_items'] ?? 0); ?>
              </div>
              <div class="col-md-4">
                <strong>Avg. Order Value:</strong> <?php echo number_format($aggregates['avg_order_value'] ?? 0, 2); ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<!-- Scripts -->
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
$j(document).ready(function() {
  // Initialize DataTable
  $j('#reportTable').DataTable({
    order: [[1, 'desc']],
    pageLength: 10,
    lengthMenu: [[10, 25, 50], [10, 25, 50]],
    pagingType: 'simple_numbers'
  });

  // Show sale details modal on click
  $j(document).on('click', '.sale-row', function() {
    let itemsJson = $j(this).attr('data-items');
    let orderId = $j(this).attr('data-orderid');
    let items = [];

    try {
      items = JSON.parse(itemsJson);
    } catch (e) {
      console.error("Failed to parse JSON", e);
    }

    let html = '<h5>Order ID: ' + orderId + '</h5>';
    if (items.length > 0) {
      html += '<table class="table table-bordered"><thead><tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead><tbody>';
      for (let item of items) {
        html += '<tr>';
        html += '<td>' + (item.name || '') + '</td>';
        html += '<td>' + (item.quantity || 0) + '</td>';
        html += '<td>' + (parseFloat(item.unit_price || 0).toFixed(2)) + '</td>';
        html += '<td>' + (parseFloat(item.total || 0).toFixed(2)) + '</td>';
        html += '</tr>';
      }
      html += '</tbody></table>';
    } else {
      html += '<p>No item data available.</p>';
    }

    $j('#saleDetailsBody').html(html);
    $j('#saleDetailsModal').modal('show');
  });
});
</script>
