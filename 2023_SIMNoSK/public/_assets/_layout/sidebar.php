<!-- <a href="" class="brand-link navbar-success">
  <img src="<?php //echo base_url('public/css/img/rssm_transparan.png') ?>" alt="RSUD dr. Soedono" class="brand-image img-circle elevation-3">
  <span class="brand-text font-weight-light">RSUD dr. Soedono</span>
</a> -->

<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div style="padding-top: 7px;">
      <img src="<?= base_url('_assets/css/img/user3.jpg') ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info" style="white-space: normal; ">          
      <a href="#" onclick="welcomedoc()" class="d-block" ><?php echo session()->get('full_name'); ?></a>
    </div>
  </div>
    <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <?php 
      $kddokter = session()->get('kd_dokter');
      if ($kddokter != ''){
      ?>
      <li class="nav-item" >
        <a href="<?php echo base_url(); ?>" class="klik_menu nav-link active" id="pelayananeresep"><i class="fas fa-home"></i> Halaman Utama</a>
      </li>
      <li class="nav-item" >
        <a href="#" class="klik_menu nav-link" id="pelayananpaketobat"><i class="fas fa-heartbeat"></i> Daftar Paket</a>
      </li>
      <li class="nav-item" >
        <a href="#" class="klik_menu nav-link" id="erm"><i class="fas fa-stethoscope"></i> E-RM</a>
      </li>
      <?php 
      }else if ($kddokter == ''){
      ?>
      <li class="nav-item" >
        <a href="#" class="klik_menu nav-link active" id="daftardokter"><i class="fas fa-stethoscope"></i> Data Dokter</a>
      </li>
      <?php 
      }else if ($kddokter == '353'){
      ?>
      <li class="nav-item" >
        <a href="<?php echo base_url(); ?>" class="klik_menu nav-link active" id="pelayananeresep"><i class="fas fa-home"></i> Halaman Utama</a>
      </li>
      <li class="nav-item" >
        <a href="#" class="klik_menu nav-link" id="pelayananpaketobat"><i class="fas fa-heartbeat"></i> Daftar Paket</a>
      </li>
      <li class="nav-item" >
        <a href="#" class="klik_menu nav-link" id="daftardokter"><i class="fas fa-stethoscope"></i> Data Dokter</a>
      </li>
      <?php 
      }
      ?>   
      <!-- <li class="nav-item" >
        <a href="#" class="klik_menu nav-link" id="tentang"><i class="fas fa-book"></i> Tentang Aplikasi</a>
      </li>   
      <li class="nav-item" >
        <a href="#" class="klik_menu nav-link" id="hubungi"><i class="fas fa-phone"></i> Hubungi</a>
      </li>    -->
    </ul>
  </nav>

</div>