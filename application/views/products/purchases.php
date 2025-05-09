<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Purchases
      <small>View and Add Stock Purchases</small>
    </h1>
    <a href="<?php echo base_url('Controller_Products/addStock'); ?>" class="btn btn-success" style="margin-bottom:10px;">
      <i class="fa fa-plus"></i> Add Purchase
    </a>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Purchase History</h3>
          </div>
          <div class="box-body">
            <table id="purchasesTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Supplier</th>
                  <th>Price per Unit</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($purchases) && !empty($purchases)): ?>
                  <?php foreach($purchases as $purchase): ?>
                    <tr>
                      <td><?php echo $purchase['product_name']; ?></td>
                      <td><?php echo $purchase['qty']; ?></td>
                      <td><?php echo $purchase['supplier']; ?></td>
                      <td><?php echo $purchase['price']; ?></td>
                      <td><?php echo $purchase['date']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#purchasesTable').DataTable();
});
</script>