  <label class="navbar-brand" >
    <img src="<?php echo base_url('public/css/img/rssm_transparan.png') ?>" alt="RSUD dr. Soedono Madiun" class="brand-image img-circle elevation-3" >
    <span class="brand-text font-weight-light" style="font-style: oblique;"><strong>RSUD dr. Soedono Madiun</strong></span>
  </label>
      
  <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse order-3" id="navbarCollapse">
    <!-- Left navbar links -->
    <ul class="navbar-nav" id="content_sidebar">
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>" class="nav-link"><i class="fas fa-home"></i> Halaman Utama</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <li><a href="#" class="dropdown-item">Some action </a></li>
          <li><a href="#" class="dropdown-item">Some other action</a></li>

          <li class="dropdown-divider"></li>

           Level two dropdown
          <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
              <li>
                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
              </li>

               Level three dropdown
              <li class="dropdown-submenu">
                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                  <li><a href="#" class="dropdown-item">3rd level</a></li>
                  <li><a href="#" class="dropdown-item">3rd level</a></li>
                </ul>
              </li>
              End Level three

              <li><a href="#" class="dropdown-item">level 2</a></li>
              <li><a href="#" class="dropdown-item">level 2</a></li>
            </ul>
          </li>
          End Level two
        </ul>
      </li> -->
    </ul>

  </div>

  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="font-size: 13px;">  
        <?php echo longdate_indo2(date('Y-m-d')); ?>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" onclick="cek_akun()">
          <?php 
            $status_akun = $this->session->userdata('aktif');
            if ($status_akun == '1'){                  
                echo "<i class='fas fa-check' style='color: #00a005;'></i>";
            }else{
                echo "<i class='fas fa-times' style='color: #ff0000;'></i>";
            }
          ?> 
        </a>        
      </li>

      <li class="nav-item dropdown">        
        <a class="nav-link" data-toggle="dropdown" href="#">          
           <i class="fas fa-cogs"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#setting_user">
            <i class="fas fa-user mr-2"></i> Profil Pengguna
            <span class="float-right text-sm text-success"><i class="fas fa-star"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="main/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
          </a> -->
          <a href="main/logout" class="dropdown-item">
            <i class="fas fa-cogs mr-2" style="margin-left:-5px;"></i> Pengaturan
            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
          </a>
          
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" data-widget="control-sidebar" data-slide="true" href="#" onclick="sembunyikan_semua_tombol()">
            <i class="fas fa-th-large mr-2"></i> Laporan
            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="main/logout" role="button" title="Keluar Aplikasi">
          <i class="fas fa-sign-out-alt"></i></a>
      </li>
<!-- 
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" onclick="sembunyikan_semua_tombol()">
          <i class="fas fa-th-large"></i></a>
      </li>
 -->
    
  </ul>

