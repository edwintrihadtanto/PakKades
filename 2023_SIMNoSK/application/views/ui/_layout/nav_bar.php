<div class="container">
  <a href="<?php echo base_url(); ?>" class="navbar-brand">
    <img src="<?= base_url('public/_assets/dist/img/logoRSSM.png') ?>"class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sim-NoSK</span>
  </a>

  <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse order-3" id="navbarCollapse">    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>     
    </ul>
  </div>

  <!-- Right navbar links -->
  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="main/logout" role="button" title="Keluar Aplikasi">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li>
  </ul>
</div>