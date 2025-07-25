<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Accounting
      <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Accounting</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h4>Journal Entry</h4>
            <p>Create new entries</p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
          <a href="<?php echo base_url('accounting/journal_entry') ?>" class="small-box-footer">Enter Journal <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4>Trial Balance</h4>
            <p>View Trial Balance</p>
          </div>
          <div class="icon">
            <i class="fa fa-balance-scale"></i>
          </div>
          <a href="<?php echo base_url('accounting/trial_balance') ?>" class="small-box-footer">View Balance <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h4>Income Statement</h4>
            <p>View P&L</p>
          </div>
          <div class="icon">
            <i class="fa fa-line-chart"></i>
          </div>
          <a href="<?php echo base_url('accounting/income_statement') ?>" class="small-box-footer">View Statement <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h4>Balance Sheet</h4>
            <p>View Balance Sheet</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-text-o"></i>
          </div>
          <a href="<?php echo base_url('accounting/balance_sheet') ?>" class="small-box-footer">View Sheet <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
</div>
