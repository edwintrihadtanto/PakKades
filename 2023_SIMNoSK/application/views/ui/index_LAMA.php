<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<?php 
//if ($this->_ci_cached_vars['controller']->_is_logged_in()) { 
if($this->session_apps->logged_id()){
    date_default_timezone_set("Asia/Jakarta");
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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/dist/css/adminlte.min.css'); ?>">
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/toastr/toastr.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
  <link rel="stylesheet" href="<?php //echo base_url('public/css/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- datatables bootstrap4-->
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  
  
  <!-- extjs -->
  <link rel="stylesheet" href="<?php //echo base_url('public/ext-4.2.1/resources/css/ext-all.css'); ?>" type="text/css">  
  <script type="text/javascript" src="<?php echo base_url(); ?>public/jquery-2.1.4.min.js"></script>
  <script src="<?php echo base_url('public/ext-all.js'); ?>"></script>
  <style type="text/css">
  body {
    font-family: 'Times New Roman';
  }
    .ukuran_icon{
      width: 5.5mm;
      height: 5.5mm;
    }
    .melayang {
      top: 4rem;
      right:20rem;
      position: fixed;        
      z-index:1032      
    }
 
    .melayang:focus {
      box-shadow: none;
    }

    .melayang2 {
      top: 4rem;
      right:27rem;
      position: fixed;        
      z-index:1032;
    }
 
    .melayang2:focus {
      box-shadow: none;
    }

    .garis_verikalmelayang1{
      border-right: 5px black dashed;
      height: 5rem;
      width: 0px;
      top: 0rem;
      right:21rem;
      position: fixed;        
      z-index:1032
    }

    .garis_verikalmelayang2{
      border-right: 5px black dashed;
      height: 5rem;
      width: 0px;
      top: 0rem;
      right:25rem;
      position: fixed;
      z-index:1032
    }

    .garis_verikalmelayang1_1{
      border-right: 5px black dashed;
      height: 5rem;
      width: 0px;
      top: 0rem;
      right:28rem;
      position: fixed;
      z-index:1032
    }

    .garis_verikalmelayang2_1{
      border-right: 5px black dashed;
      height: 5rem;
      width: 0px;
      top: 0rem;
      right:32rem;
      position: fixed;
      z-index:1032
    }

    .garis_horizontal{
       border-right: 3.5px black solid;
      height: 0rem;
      width: 5px;
      top: 0rem;
      right:25.20rem;
      position: fixed;
      z-index:1032     
    }

    .text_bold{
      font-style: italic;
      text-align: right;
      background: border-box;
      background-color: #AAAAAA;
    }
    
    .preloader{
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      /*background-color: #e6fff4d4;*/
      background-color: #627d608f;
    }
    .preloader .loading{
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font: 14px;
    }
    
    .form-control-dua{
      display: block;
      width: 90%;
      height: 34px;
      padding: 6px 12px;
      font-size: 12px;
      font-weight: bold;
      line-height: 1.42857143;
      color: #555;
      background-color: #fff;
      background-image: none;
      border: 1px solid #ccc;
      border-radius: 2px;
      cursor:pointer;
    }

    hr{
      background-color: #000000;
    }
    .cursor_tangan{
      cursor: pointer;
    }
    /*table{
      font-size: 12px;        
    }*/

   /* tr:hover{
      background-color: #e48d8d85 ;
      cursor: pointer; 
      font-style: italic;
    }*/

    .wadah-mengetik {
      font-size: 22px;
      width: 540px;
      white-space:nowrap;
      overflow:hidden;
      -webkit-animation: ketik 5s steps(50, end);
      animation: ketik 5s steps(50, end);
    }

    @keyframes ketik{
        from { width: 0; }
    }

    @-webkit-keyframes ketik{
        from { width: 0; }
    }
    

    .wadah-blink {  
      animation: 2s linear infinite kedip;
    }
   
    @keyframes kedip {
      0% {
        visibility: hidden;
      }
      50% {
        visibility: hidden;
      }
      100% {
        visibility: visible;
      }
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function(e) {
      $(".preloader").fadeOut();
    })
  </script>
</head>
<!-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-fuchsia ">  TAMPIL FULL--> 
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-fuchsia sidebar-collapse">
<script type="text/javascript">  
    var base_url = "<?php echo base_url(); ?>";
    var dikeluarkan = "<?php echo base_url(); ?>main/logout";
</script>
<div class="preloader">
  <div class="loading" align="center">
    <img src="<?php echo base_url(); ?>public/blue-loading.gif"/>
    <br>
    <b><p>Loading Core Component... <br><?php echo SITE_NAME ?><br>RSUD dr. Soedono Madiun</p></b>
  </div>
</div>
<div class="wrapper">
  
  <!-- Navbar -->
 <!-- ui.navbar.php --> 
 <?php $this->load->view("ui/ui/nav_bar.php") ?> 
 <!-- disini -->
 <?php //$this->load->view("ui/ui/sidebar.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- <aside class="main-sidebar elevation-4 sidebar-light-warning"> -->
  <!-- <aside class="main-sidebar sidebar-dark-primary elevation-4">   
   <?php //$this->load->view("ui/ui/sidebar.php") ?>   
  </aside> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <!-- disini -->
    <?php $this->load->view("ui/ui/content-header.php") ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- <section class="content">      -->
    <div class="content">  
      <?php //$this->load->view("ui/ui/content.php") ?>
      <!-- <script type="text/javascript" src="<?php //echo base_url('public/ui/ui.js'); ?>"></script>
      <div id="grid-view">
      </div> -->
      <div class="container">
        <div class="content_body">
          
        </div>
      </div>
    </div>
    <!-- </section> -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <div id="report"></div>
  <aside class="control-sidebar control-sidebar-dark">
    <?php $this->load->view("ui/ui/sidebar_right.php") ?>
  </aside> <!-- MEMANGGIL MENU LAPORAN DISAMPING -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <b>Version</b> 4.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017-<?php echo date("Y") ?> ITISI - <a href="https://rssoedono.jatimprov.go.id/">RSUD dr. Soedono Madiun</a>.</strong>
    All rights reserved.
  </footer>  
</div>

<?php //$this->load->view("modal/form_profil.php") ?>
<?php //$this->load->view("modal/plus_user.php") ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url('public/css/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap -->

<script src="<?php echo base_url('public/css/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="<?php echo base_url('public/css/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<script src="<?php echo base_url('public/css/dist/js/adminlte.js'); ?>"></script>
<script src="<?php echo base_url('public/css/dist/js/adminlte.min.js'); ?>"></script>

<!-- <script src="dist/js/adminlte.js"></script> -->

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url('public/css/dist/js/demo.js'); ?>"></script>
<!-- <script src="dist/js/demo.js"></script> -->

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url('public/css/plugins/jquery-mousewheel/jquery.mousewheel.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/jquery-mapael/jquery.mapael.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/jquery-mapael/maps/usa_states.min.js'); ?>"></script>
<!-- 
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
 -->
<!-- ChartJS -->
<script src="<?php echo base_url('public/css/plugins/jquery-mapael/maps/usa_states.min.js'); ?>"></script>
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->

<!-- PAGE SCRIPTS -->
<script src="<?php //echo base_url('public/css/dist/js/pages/dashboard2.js'); ?>"></script>
<!-- <script src="dist/js/pages/dashboard2.js"></script> -->
<!-- SweetAlert2 -->
<script src="<?php echo base_url('public/css/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
<!-- Toastr -->
<script src="<?php echo base_url('public/css/plugins/toastr/toastr.min.js'); ?>"></script>

<script src="<?php echo base_url('public/css/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php //echo base_url('public/css/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('public/css/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('public/css/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>

<script type="text/javascript">
  //get_image();
  
  function get_image(){
    Ext.Ajax.request({
      url: base_url+"index.php/main/get_image",
      params:{ },
      success: function(response) {
        var cst = Ext.decode(response.responseText);
        
        for(var i = 0; i < cst.ListDataObj.length; i++){
          var alamat_image = "<?php echo base_url();?>public/css/img/";
          var image = cst.ListDataObj[i].nama_image;          
          $('#content_carousel_image').append("<div class='carousel-item'><img class='d-block w-100' src='"+alamat_image+image+"' height='500'></div>");          
        }          
       
      },
      failure: function(o){              
        toastr.warning("Error !!!");
      },  
    });
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
  .backgr{        
    background: radial-gradient(circle at top right, #000c19, #bd7676);
    /*background: url("http://localhost/2021_esppd_webbase/public/css/img/unnamed.jpg"); */
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: auto;
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

</style>
</head>
<body class="hold-transition login-page backgr">
<div class="login-logo">
  <img src="<?php echo base_url('public/css/img/logosidebar.png') ?>" width="150" height="150">
</div>
<div align="center" style="color: #ffffff;  text-shadow: 3px 2px 5px black;">
  <h4>Aplikasi Kode Surat Masuk<br>(E-Korsuk)</h4>
</div>

<div class="login-box" id="masuk_memulai_session">
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

      <form action="<?php echo base_url() ?>main/login" method="POST">
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
          <b>E-KORSUK v.1</b>
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
