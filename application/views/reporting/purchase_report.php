<!-- reporting/purchase_report.php -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Purchase/Stock Additions Report
      <small>Stock Activity Overview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('Controller_Reports') ?>">Reports</a></li>
      <li class="active">Purchases</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Purchase/Stock Additions Report</h3>
          </div>
          <div class="box-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-md-12">
                <button class="btn btn-default" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
              </div>
            </div>
            <table id="reportTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Source</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($report)): ?>
                  <?php foreach ($report as $row): ?>
                    <tr>
                      <td><?php echo isset($row['date']) ? date('Y-m-d H:i', strtotime($row['date'])) : ''; ?></td>
                      <td><?php echo isset($row['product']) ? $row['product'] : ''; ?></td>
                      <td><?php echo isset($row['quantity']) ? number_format($row['quantity']) : '0'; ?></td>
                      <td><?php echo isset($row['source']) ? $row['source'] : ''; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="4" class="text-center">No purchase/stock data found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <strong>Opening Stock:</strong> <?php echo isset($summary['opening']) ? number_format($summary['opening']) : '0'; ?>
              </div>
              <div class="col-md-3">
                <strong>Additions:</strong> <?php echo isset($summary['additions']) ? number_format($summary['additions']) : '0'; ?>
              </div>
              <div class="col-md-3">
                <strong>Reductions:</strong> <?php echo isset($summary['reductions']) ? number_format($summary['reductions']) : '0'; ?>
              </div>
              <div class="col-md-3">
                <strong>Closing Stock:</strong> <?php echo isset($summary['closing']) ? number_format($summary['closing']) : '0'; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
$j(document).ready(function() {
  $j('#reportTable').DataTable({
    order: [],
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
    paging: true,
    pagingType: 'simple_numbers',
    dom: 'Blfrtip',
    buttons: ['copy', 'csv', 'excel', 'print']
  });
});
</script>