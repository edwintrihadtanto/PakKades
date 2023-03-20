<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<?php 
//if ($this->_ci_cached_vars['controller']->_is_logged_in()) { 
if($this->session_apps->logged_id()){
  
?>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo SITE_NAME ;?></title>
  <link rel="icon"       href="<?php echo base_url('public/css/img/favicon.png'); ?>">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/fontawesome-free/css/all.min.css'); ?>">  
  <!-- Theme style -->  
  <link rel="stylesheet" href="<?php echo base_url('public/css/dist/css/adminlte.min.css'); ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/toastr/toastr.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <!-- datatables bootstrap4-->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- <script type="text/javascript" src="<?php //echo base_url(); ?>public/jquery-2.1.4.min.js"></script> -->
  <script type="text/javascript" src="<?php echo base_url(); ?>public/jquery-3.2.1.js"></script>
  <style type="text/css">
    body {
      font-family: 'Cambria';
    }
    .preloader{
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #e6fff4d4;
      /*background-color: #627d608f;*/
      
      color:  #000000;
    }
    .preloader .loading{
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font-size: 18px;
    }


    /*animasi */
    .wadah-mengetik {
      font-size: 22px;
      width: 430px;
      white-space:nowrap;
      overflow:hidden;
      -webkit-animation: ketik 5s steps(50, end);
      animation: ketik 5s steps(50, end);
    }
    .navbar-gradasi {
      background: radial-gradient(circle at top left, #000c19, #bd7676);

    }

    @keyframes ketik{
        from { width: 0; }
    }

    @-webkit-keyframes ketik{
        from { width: 0; }
    }
    /*end animasi*/
  </style>  
</head>
<body class="hold-transition layout-top-nav accent-primary">
<script type="text/javascript">  
    var base_url = "<?php echo base_url(); ?>";
    var dikeluarkan = "<?php echo base_url(); ?>main/logout";
</script>
<div class="preloader">
  <div class="loading" align="center">
    <img src="<?php echo base_url(); ?>public/tes2.svg"/>
    <br>
    <p>Loading Core Component... <br><?php echo SITE_NAME ?><br>RSUD dr. Soedono Madiun<br>by<br>Instalasi Teknologi Informasi dan Sistem Informasi</p>
  </div>
</div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-gradasi">
    <div class="container">
      <?php $this->load->view("ui/ui/nav_bar.php") ?>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view("ui/ui/content-header.php") ?>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <!-- <div class="row">     -->      
            <div class="content_body"></div>          
        <!-- </div> -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 <!--  <aside class="control-sidebar control-sidebar-dark">    
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside> -->

  <div id="report"></div>
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
    <?php $this->load->view("ui/ui/sidebar_right.php") ?>
    </div>
  </aside> <!-- MEMANGGIL MENU LAPORAN DISAMPING -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
       <b><?php echo SITE_NAME ?></b>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017-<?php echo date("Y") ?> ITISI - <a href="https://rssoedono.jatimprov.go.id/">RSUD dr. Soedono Madiun</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="<?php echo base_url('public/css/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('public/css/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('public/css/dist/js/adminlte.min.js'); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url('public/css/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
<!-- Toastr -->
<script src="<?php echo base_url('public/css/plugins/toastr/toastr.min.js'); ?>"></script>

<script src="<?php echo base_url('public/css/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- extjs -->
<script src="<?php echo base_url('public/ext-all.js'); ?>"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('public/css/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('public/css/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>


<script type="text/javascript">

//$(document).ready(function(){
  //(".preloader").fadeOut();
Get_modules();  
  // open_menu();
  // open_submenu();
//});

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
</html>
<?php
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo SITE_NAME ;?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/fontawesome-free/css/all.min.css'); ?>">  
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>"> 
  <link rel="stylesheet" href="<?php echo base_url('public/css/dist/css/adminlte.min.css'); ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <!-- extjs -->
  <link rel="icon"       href="<?php echo base_url('public/css/img/favicon.png'); ?>">
  <link rel="stylesheet" href="<?php //echo base_url('public/ext-4.2.1/resources/css/ext-all.css'); ?>" type="text/css">  
  <script type="text/javascript" src="<?php echo base_url(); ?>public/jquery-2.1.4.min.js"></script>  
  <script src="<?php echo base_url('public/ext-all.js'); ?>"></script>
 <style type="text/css">
 body{
  font-family:Times New Roman;
 }
  .backgr{        
    background: radial-gradient(circle at top right, #000c19, #bd7676);
    /*background: url("http://localhost/2021_esppd_webbase/public/css/img/unnamed.jpg"); */
    /*background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: auto;*/
  }

  .btn_down{        
   /*background: radial-gradient(circle at bottom right, #a9117bd9, #e0b500);*/
   background: radial-gradient(circle at bottom right, #007bff, #ffc107);
   color: #fff;
   border-color: #fff;
   box-shadow: none;
  }
  .btn_down:hover{
   /*background: radial-gradient(circle at bottom right, #ff0000db, #0cc303c2);   */
   background: radial-gradient(circle at bottom right, #ffc107, #007bff);
   color: #fff;
   border-color: #fff;
   box-shadow: none;
  }

  .login-border{    
    background-color: #ffffff6e; 
    border-radius: 10px; 
    border: 7px double #000; 
    padding: 10px; 
    position: relative;
    /*text-align: center;*/
  }

</style>
</head>
<body class="hold-transition login-page backgr">
<div class="login-border">

  <div class="login-logo">
    <div align="center" style="color: #ffffff;  text-shadow: 3px 2px 5px black;">
      <img src="<?php echo base_url('public/css/img/logosidebar.png') ?>" width="100" height="100">
      <h4>Sistem Informasi Manajemen Nomor Surat<br>Sim-NoS</h4>
    </div>        
  </div>

<div class="login-box" id="masuk_memulai_session" style="width: auto;">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
              
      <div class="row">        
        <!-- /.col -->
        <div class="col-11">
          <p class="login-box-msg">Masuk untuk memulai session</p>
        </div>
        <!-- /.col -->
      </div>

      <?php 
      if (isset($error)) { echo $error; };
      ?>
      <div id="pesan_error">
        
      </div>

      <form action="<?php echo base_url() ?>main/loginx" method="POST">
      <div id="form1" align="center">        
        <div class="input-group mb-3">
          <input type="text" name="username"  id="username" class="form-control" placeholder="Masukkan NIP/NPK">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>          
        </div>
        <?php //echo form_error('username'); ?>
        <div class="input-group mb-3">
          <input type="password" name="password"  id="password" class="form-control" placeholder="Masukkan Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>           
        </div>
        <?php //echo form_error('password'); ?>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">                            
                <a href="#" onclick="forget()"><span class="fas fa-info-circle"></span> Lupa Password</a>              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="btnLogin" class="btn btn-success btn-block"><i class="fa fa-sign-in-alt"></i> Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </div> <!-- end form1 -->

      <div id="form3" >
        <div class="text-center">
            <div class="col-lg-12" >            
            </div>            
            <div id="text-user"><label><b>Selamat Datang,...</b></label></div>
            <label><b>Sistem Sedang Memeriksa Account Anda</b></label>
            <div> <img src="<?php echo base_url(); ?>public/blue-loading.gif"/></div>
        </div>
      </div>

      </form>    
      <!-- /.social-auth-links -->
      <hr>
      <div class="row">
        <div class="col-8">
          <b>RSUD dr. Soedono Madiun</b>
        </div>
        <div class="col-4.5" style="text-align: right;">
          <b><?php echo SITE_NAME ?></b>
        </div>
      </div>
      <p class="mb-0">
        
        <!--<button id='exit'>Exit Tanpa Konfirmasi</button>-->
        <!--<button id='confirmExit'>Exit Dengan Konfirmasi</button>-->
        <!--<button id='jsConfirm'>Exit dengan Konfirmasi dari Javascript</button>-->
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url('public/css/plugins/jquery/jquery.min.js'); ?>"></script>

<script src="<?php echo base_url('public/css/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<script src="<?php echo base_url('public/css/dist/js/adminlte.min.js'); ?>"></script>

<!-- SweetAlert2 SWAL-->
<script src="<?php echo base_url('public/css/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<script type="text/javascript">
$(document).ready(function(e) {
  var v = "<?php if (isset($true)) { echo $true; }?>";
  
  if (v == 400){    
    $("#username").focus();
    $('#form1').show();
    $('#form3').hide();
  }


    $("#username").focus();
    $('#form1').show();
    $('#form3').hide();

    var w = $('#form1').width();
    var h = $('#form1').height();

    $('#form3').css({'width':'100%','height':h});

    $('#link2').click(function(e) {
        $('#form1').stop().animate().hide(500);
      $('#form3').stop().animate().hide(500);
    });
      
    $('#link1').click(function(e) {
        $('#form1').stop().animate().show(500);
      $('#form3').stop().animate().hide(500);
    });
      

    $("#btnLogin" ).click(function(e) {
    var nama = $("#username").val();  
    var pass = $("#password").val();  

      if(nama == ''){
        Toast.fire({
          icon: 'warning',
          title: "Username belum diisi !!!"
        })
        e.preventDefault();
      }else if(pass == ''){
        Toast.fire({
          icon: 'warning',
          title: "Password belum diisi !!!"
        })
        e.preventDefault();
      }else{
        $('#form1').stop().animate().hide();
        $("#text-user").empty().append('<b>Selamat Datang, '+nama+'</b>');
        $('#form3').stop().animate().show();  

        var timer = setInterval(function(){
          clearInterval(timer);
        },2000);
            
      }

    });  

});

function forget(){    
    Toast.fire({
      icon: 'info',
      title: "Hubungi ITISI untuk mengetahui Password Anda !!!"
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
</html>

<?php
}
?>
