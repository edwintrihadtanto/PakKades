
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('_assets/css/img/user3.jpg') ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIM-RS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('_assets/css/img/user3.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo session()->get('full_name'); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Rawat Jalan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="./Rawatjalan/pendaftaranRWJ/" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Pendaftaran Rawat Jalan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Rawatjalan/penatajasaRWJ/" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Penata Jasa</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="#" class="klik_menu nav-link" id="pendaftaranRWJ">
                  <i class="far fa-file nav-icon"></i>
                  <p>Pendf. Rawat Jalan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="klik_menu nav-link" id="penatajasaRWJ">
                  <i class="far fa-file nav-icon"></i>
                  <p>Penata Jasa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Kasir Rawat Jalan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Rawat Inap
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./pendRWI" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Pendf. Rawat Inap</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./pnatajasaRWI" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Penata Jasa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./kasirRWI" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Kasir Rawat Inap</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header">SETUP</li>
                    
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

