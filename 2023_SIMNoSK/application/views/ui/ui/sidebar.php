<!--     <a href="#" class="brand-link elevation-4">
      <img src="<?php //echo base_url('public/css/img/rssm_transparan.png') ?>" alt="RSUD dr. Soedono" 
      class="brand-image img-circle elevation-3" >
      <span class="brand-text font-weight-light"><strong><u>RSUD dr. Soedono Madiun</u></strong></span>
    </a>

    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="padding-top: 6px;">
          <img src="<?php //echo base_url('public/css/img/logosidebar.png') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="font-size: 13px;"><?php //echo  $this->session->userdata('nm_lengkap'); ?></a>
          <a href="#" class="d-block"><?php //echo  $this->session->userdata('user'); ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="content_sidebar">
          <li class="nav-item has-treeview">
            <a href="<?php //echo base_url(); ?>" class="nav-link <?php //echo $this->uri->segment(2) == '' ? 'active': '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Halaman Utama</p>
            </a>
          </li>
           
        </ul>
      </nav>

    </div>
 -->
<script type="text/javascript">
$(document).ready(function(){
  Get_modules();  
  // open_menu();
  // open_submenu();
});

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
          
          open_menu();
      }else if (cst.success === false){
          open_menu();
      }
    },
    failure: function(o)
    {      
      toastr.error('Gagal Load Group Module');
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

</script>