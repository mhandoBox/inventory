<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
  <!-- Font Awesome -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileinput/fileinput.min.css') ?>">
  <!-- addedd -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/style/style.css') ?>"> -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/style/main.css') ?>"> 

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Loading Overlay -->
  <link rel="stylesheet" href="<?php echo base_url('assets/common/loading-overlay.css') ?>">

  <!-- Load jQuery first -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- Then jQuery UI -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Then Bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Loading Overlay JS -->
  <script src="<?php echo base_url('assets/common/loading-overlay.js') ?>"></script>
  <!-- jVectorMap CSS --> 
<!-- jVectorMap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"></script>
<!-- World Map Data (adjust based on your map needs) -->

  <!-- Then DataTables -->
   
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

  <!-- Other scripts (keep only if needed and not conflicting) -->
   <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
  <!-- Add this before your dashboard.js script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js') ?>"></script>
  <script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>

</head>
<body class="hold-transition skin-red sidebar-mini fixed">
<div id="loading-overlay" style="display: none;">
    <div class="loading-icon">
        <img src="<?php echo base_url('JEMAU-loading-animation-xl.svg') ?>" alt="Loading...">
    </div>
</div>
<div class="wrapper">