<?php
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Stock Transfers
      <small>Manage Stock Transfers</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stock Transfers</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>

        <?php if(in_array('createTransfer', $this->permission)): ?>
          <a href="<?php echo base_url('Controller_Transfers/create') ?>" class="btn btn-primary">Add Transfer</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Stock Transfer History</h3>
          </div>
          <div class="box-body">
            <table id="transferTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Transfer Code</th>
                  <th>From Store</th>
                  <th>To Store</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Date</th>
                  <th>Status</th>
                  <?php if(in_array('createTransfer', $this->permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>