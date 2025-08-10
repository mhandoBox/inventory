<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>JIC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <div class="header-logo" style="height: 40px; margin-top: -10px;">
          <?php echo file_get_contents(FCPATH . 'JEMAU-loading-animation-xl.svg'); ?>
        </div>
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

    
    </nav>
  </header>

<style>
.header-logo {
    display: inline-block;
    vertical-align: middle;
}

.header-logo svg {
    width: auto;
    height: 100%;
}

/* Optimize animations for header */
.logo-lg .header-logo svg .loading-dots {
    display: none;
}

.logo-lg .header-logo svg text {
    font-size: 24px;
}

@media print {
    .logo-lg .header-logo svg animate,
    .logo-lg .header-logo svg animateTransform {
        display: none;
    }
}
</style>