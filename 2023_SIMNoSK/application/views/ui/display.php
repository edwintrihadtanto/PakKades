<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo SITE_NAME ;?></title>
  <link rel="icon"       href="<?= base_url('public/_assets/dist/img/logoRSSM.png'); ?>">
  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/fontawesome-free/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('public/_assets/dist/css/adminlte.min.css'); ?>">  
  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/toastr/toastr.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css');?>">

  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('public/_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('public/_assets/_layout/asset.css'); ?>">
  
</head>
<!-- <body class="hold-transition sidebar-mini sidebar-collapse text-sm layout-fixed accent-danger" style="background-color: #d5ecef;"> -->
<!-- <body class="hold-transition layout-top-nav accent-danger" style="background-color: #d5ecef;"> -->
<!-- <body class="hold-transition sidebar-collapse layout-top-nav accent-danger" style="background-color: #d5ecef;"> -->
<?php if($this->session_apps->logged_id()){ ?>
<body class="hold-transition sidebar-collapse layout-top-nav">
<script type="text/javascript">  
  var base_url        = "<?= base_url(); ?>";
  var dikeluarkan     = "<?= base_url(); ?>/login/logout";
</script>
<div class="wrapper">
  <div class="preloader flex-column justify-content-center align-items-center navbar-dark">
    <img class="animation__shake" src="<?= base_url('public/_assets/dist/img/logoRSSM.png') ?>" alt="Logo SIM-RS">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <?php $this->load->view("ui/_layout/nav_bar") ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php $this->load->view("ui/_layout/sidebar") ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->load->view("ui/ui/content-header") ?>
    <!-- Main content -->
    <div class="content">
      <div class="content_body"></div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      v.1
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">I.T</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- jQuery -->
<script src="<?= base_url('public/_assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('public/_assets/ext-all.js'); ?>"></script>
<script src="<?= base_url('public/_assets/jquery-3.6.1.js'); ?>"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('public/_assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('public/_assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- CSS Private -->
<script src="<?= base_url('public/_assets/dist/js/customize.js'); ?>"></script>
<script src="<?= base_url('public/_assets/plugins/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url('public/_assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<!-- bs-custom-file-input -->
<script src="<?= base_url('public/_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>

<script src="<?= base_url('public/_assets/plugins/select2/js/select2.full.min.js'); ?>"></script>

<script src="<?= base_url('public/_assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('public/_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('public/_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('public/_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>

<script type="text/javascript">  
Get_modules();  

function open_menu(){
  $('.klik_menu').click(function(){
    $('#show_content').hide();
    var menu = $(this).attr('id');    
    if(menu == "daftar_kartu_kendali_group"){
      $('.content_body').load('load_module/get_module_formkartukendali');
      LoadDataUser();
    }else if(menu == "data_pegawai"){
      $('.content_body').load('load_module/get_pegawai');
    }else if(menu == "data_bidang"){
      $('.content_body').load('load_module/get_data_bidang');
    }else if(menu == "data_surat_keluar"){
      $('.content_body').load('load_module/get_data_surat_kluar');      
    }else if(menu == "daftar_sppd"){
      $('.content_body').load('load_module/get_daftar_sppd');
    }
    $('[data-widget="pushmenu"]').PushMenu('toggle');
  });
  $('.content_body').load('load_module'); 
}

function open_submenu(){
  $('.klik_menu').click(function(){
    var menu = $(this).attr('id');
    //$(".content_body").html("<div align='center'><img src='<?php echo base_url(); ?>public/blue-loading.gif'/></div>");
    if(menu == "verifikasi_berkas_awal_modultarget"){
      $('.content_body').load('load_module/get_module_listverfikasi_awal');
    }else if(menu == "list_user_modultarget"){
      $('.content_body').load('load_module/get_module_listusers');
    }else if(menu == "verifikasi_berkas_tahap_2_modultarget"){
      $('.content_body').load('load_module/get_module_listverfikasi_thpkedua');
    }else if(menu == "daftar_berkas_verifikasi_group"){
      $('.content_body').load('load_module_rekanan/get_module_daftar_berkas_verifikasi_group');
    }

  });  
}
function LoadDataUser(){
  Ext.Ajax.request({
    url: base_url+"index.php/main/getDataUser",
    params: {},
    success: function(response) {
      var cst = Ext.decode(response.responseText);
      var modid = cst.result_data[0].mod_id;      
      if (cst.count_data == 1){
       console.log(cst);
      }
    },
    failure: function(o)
    {      
      dialog('Hubungi Admin', 'Info');
    },  
  });
}

function Get_modules(){
  var group_name;
  var id_model;
  Ext.Ajax.request({
    url: base_url+"index.php/main/get_modulesidebar",
    params: {},

    success: function(o) {
      var cst = Ext.decode(o.responseText);
      if (cst.success === true){
          console.log(cst);          
          //var desc = cst.result_data[0];
          for(var i=0; i<cst.ListDataObj.length; i++){
            //console.log(cst.ListDataObj[i].deskripsi);
            group_name = cst.ListDataObj[i].group_name;
            id_model   = cst.ListDataObj[i].id_model;
            
            $('#content_sidebar').append(cst.ListDataObj[i].deskripsi);
            //Get_SubModules(group_name, id_model);
          }
          
          $('.preloader').fadeOut();
          open_menu();
      }else if (cst.success === false){
          open_menu();
      }
    },
    failure: function(o)
    {      
      toastr.error('Gagal Load Module !!!');
    },  
  });
}

function Get_SubModules(group_name, id_model){
  Ext.Ajax.request({
    url: base_url+"index.php/main/get_modulesidebar_sub",
    params: {},
    success: function(o) {
      var cst = Ext.decode(o.responseText);
      if (cst.success === true){
          //console.log(group_name+"|"+id_model);          
          //var desc = cst.result_data[0];
          for(var i=0; i<cst.ListDataObj_Mod.length; i++){
            //console.log(cst.ListDataObj_Mod[i].deskripsi_mod);
            var nama_group_mod = cst.ListDataObj_Mod[i].group_name;
            var nama_group     = group_name;
            var idmodel = "#"+id_model;
             
            if (nama_group == nama_group_mod){
              $(idmodel).append(cst.ListDataObj_Mod[i].deskripsi_mod);
              //console.log(group_name+"|"+id_model+"|"+cst.ListDataObj_Mod[i].deskripsi_mod);
            }            
          }
          open_submenu();
      }else if (cst.success === false){
          open_menu();
      }

    },
    failure: function(o)
    {      
      toastr.error('Gagal Load Sub Module');
    },  
  });
}

function cek_akun(){
  var status_akun = "<?php echo $this->session->userdata('aktif') ?>";

  if (status_akun == '1'){
    toastr.success('Akun Actived');
  }else{
    toastr.error('Akun Non Actived');
  }
}
</script>
</body>
<?php 
}else{    
?>
<body class="login-page" style="min-height: 466px;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center">      
      <img class="animation__shake" src="<?= base_url('public/_assets/dist/img/logoRSSM.png') ?>" alt="Logo SIM-RS" width="150" height="150">  
      <a href="#" class="h1"><b>Sim</b>NoSK</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk untuk memulai sessian anda</p>
      <?php 
      if (isset($error)) { echo $error; };
      ?>
      <form action="<?php echo base_url() ?>main/onproces" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" id="username" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password"  id="password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Ingatkan saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>      
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#" onclick="forget();">I forgot my password</a>
      </p>      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('public/_assets/plugins/jquery/jquery.min.js'); ?>"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('public/_assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('public/_assets/dist/js/adminlte.min.js'); ?>"></script>

<script src="<?= base_url('public/_assets/plugins/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url('public/_assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script type="text/javascript">
  
function forget(){    
  Toast.fire({
    icon: 'info',
    title: "Hubungi I.T.I.S.I untuk mengetahui Password Anda !!!"
  })   
}

const Toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 5000
}); 

</script>
</body>

<?php
}
?>
</html>
