 <nav class="main-header navbar navbar-expand navbar-dark navbar-red">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>          
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="font-size: 13px;">  
        <?php echo longdate_indo(date('Y-m-d')); ?>
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
          <a href="main/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" onclick="sembunyikan_semua_tombol()">
          <i class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>

  <script type="text/javascript">
    function cek_akun(){
      var status_akun = "<?php echo $this->session->userdata('aktif') ?>";

      if (status_akun == '1'){
        toastr.success('Akun Actived');
      }else{
        toastr.error('Akun Non Actived');
      }
    }
  </script>