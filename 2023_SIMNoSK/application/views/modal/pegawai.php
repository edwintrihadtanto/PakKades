<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      Data Pegawai
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="add_pegawai()" title="Tambah Pegawai Baru"><i class="fas fa-plus-circle"></i></button>
      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div>
  
  <div class="card-body">
      <table id="ajax_datapegawai" class="table table-bordered table-striped" style="font-size: 12px;">
        <thead>
          <tr class="navbar-success" style="color: #ffffff;">
              <th width="5" align="center">No.</th>
              <th width="150">NIP/NPK</th>
              <th>Nama Pegawai</th>
              <th>Jabatan</th>
              <th width="128" style="text-align: center;">Status</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>      
  </div>

<!---- ADD / EDIT PEGAWAI --->
<div class="modal fade" id="modal-editlistpegawai">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header navbar-primary">
        <h6 class="modal-title" style="color: #ffffff;"><i class="fa fa-pencil-alt"></i> Data Pegawai</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_editpegawai">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
        </div>
      </div>
  
      <form action="#" id="form" class="form-horizontal">
      <div class="modal-body">        
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" id='id_nip' hidden="true" required>
            <input type="text" class="form-control" placeholder="Nama Pegawai" id='nama_pegawai' required>
            <b>*)</b>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
              <i class="fas fa-eye" onclick="enable_nip()" id="en_nip" style="cursor: pointer;"></i>
              <i class="fas fa-eye-slash" onclick="disable_nip()" id="dis_nip" style="cursor: pointer; color: #ff0000;"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="NIP/NIK" id='nip_nik' disabled="true" required>            
            <b>*)</b>          
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Jabatan" id='jabatan' required>
            <b>*)</b>
          </div>

          <div class="input-group mb-3">
           <label class="col-lg-5"><i class="fas fa-pencil-alt"></i> Golongan/Pangkat <b>*)</b></label>           
           <div class="col-lg-11">
              <select class="custom-select" id="golongan" > <!-- onclick="get_gol_pang()" -->
                <option value="">-Pilih Golongan Pegawai-</option>
                <?php foreach($gol_pangkat as $gol_pangkat_):?>                 
                <option value="<?php echo $gol_pangkat_->golongan; ?>"><?php echo $gol_pangkat_->golongan.' '.$gol_pangkat_->pangkat; ?></option>
                <?php endforeach;?>
              </select>              
           </div>           
          </div>  

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-building"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Unit Kerja" id='unit_kerja'>
          </div>

          <div class="form-group">
            <table border="0" width="100%">
              <td align="center">
               <label class="col-lg-8"><i class="fas fa-check"></i> Jenis Golongan <b>*)</b></label>
               <div class="col-lg-8">
                  <select class="form-control select2bs4" id="gol_peg" style="cursor:pointer;width: 100%;"  required>
                  <option value='PNS'>PNS</option>
                  <option value='PTT-BLUD'>PTT BLUD</option>
                  </select>                  
               </div>               
              </td>
              <td align="center">
               <label class="col-lg-8"><i class="fas fa-check"></i> Jenis Kelamin <b>*)</b></label>
               <div class="col-lg-8">
                  <select class="form-control select2bs4" id="jns_kel" style="cursor:pointer;width: 100%;"  required>
                  <option value='L'>Laki-Laki</option>
                  <option value='P'>Perempuan</option>
                  </select>                  
               </div>               
              </td>
            </table>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-at"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Kosongi Jika Tidak Ada (Opsional)" id='email' style="background-color: #fff2005e;">
          </div>

          <div class="form-group">
             <label class="col-lg-4"><i class="fas fa-check"></i> Status Pegawai <b>*)</b></label>
             <div class="col-lg-12">
                <select class="form-control select2bs4" id="status" style="cursor:pointer;width: 100%;"  required>
                <option value='y'>Aktif</option>
                <option value='t'>Non Aktif</option>
                </select>
             </div>
          </div>
          <label>*) Wajib Diisi</label>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
          <button type="submit" class="btn-sm btn-primary" id ="btn_simpanpegawai" onclick="simpanpegawai()"></button>
        </div>
      </form>

      </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>
  <!---- ----->
<!---- END ADD / EDIT PEGAWAI --->
<!---- DELETE PEGAWAI --->
  <div class="modal fade" id="modal-deletepegawai">
    <div class="modal-dialog modal-sm">
      <div class="modal-content bg-default">        
        <div class="overlay-wrapper" id="loading_delete_pegawai">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
        <div class="modal-body">        
          <input type="text" id="id_nip_delete" required disabled hidden="true">
          <input type="text" id="nip_delete" required disabled hidden="true">
          <p id="textx" align="left"></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="button" class="btn btn-sm btn-danger" id='delete_peg' onclick="delete_peg()"><i class="fa fa-trash"></i> Hapus</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>  
  </div>
</div>
<!---- END DELETE PEGAWAI --->
<!---- ADD / EDIT USER ANDROID --->
<div class="modal fade" id="modal-edit_user_login_apk">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header navbar-warning">
        <h6 class="modal-title"><i class="fa fa-pencil-alt"></i> Data User Login Aplikasi</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_edit_user_login_apk">
        <div class="overlay">
          <p align="center"><i class="fas fa-3x fa-sync-alt fa-spin"></i><br><br>
          <button id="reg_baru" type="button" class="btn-sm btn-primary" onclick="oke()"><i class="fas fa-plus-circle" ></i> Registrasi Baru E-SPPD</button>
        </div>        
      </div>
  
      <form action="#" id="form_USER" class="form-horizontal">
      <div class="modal-body">         
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <input type="text" class="form-control" id='id_akses' required>
              <span class="input-group-text">
              <i class="fas fa-eye" onclick="enable_nip_user()" id="en_nip_user" style="cursor: pointer;"></i>
              <i class="fas fa-eye-slash" onclick="disable_nip_user()" id="dis_nip_user" style="cursor: pointer;"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="NIP/NIK" id='user_login_nip' disabled="true" required>            
            <b>*)</b>          
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">              
              <span class="input-group-text">
              <i class="fas fa-eye" onclick="show_pass()" id="sh_pass" style="cursor: pointer;"></i>
              <i class="fas fa-eye-slash" onclick="hide_pass()" id="hi_pass" style="cursor: pointer;"></i>
              </span>
            </div>
            <input type="text" class="form-control" id='pass' disabled="true">
            <input type="text" class="form-control" placeholder="Masukkan Password User" id='pass_create' required>
            <b>*)</b>          
          </div>

          <div class="form-group">
             <label class="col-lg-4"><i class="fas fa-check"></i> Status Akun Login <b>*)</b></label>
             <div class="col-lg-12">
                <select class="form-control select2bs4" id="aktif" style="cursor:pointer;width: 100%;"  required>
                <option value='y'>Aktif</option>
                <option value='t'>Non Aktif</option>
                </select>
             </div>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">              
              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
            <input type="date" class="form-control" id='tgl_buat' required>            
            <b>*)</b>
          </div>

          <label>*) Wajib Diisi</label>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
          <button type="submit" class="btn-sm btn-success" id ="btn_edit_user_login_apk" onclick="onclick_update_user_login()"></button>
        </div>
      </form>

      </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>
<!---- END ADD / EDIT USER ANDROID --->
<script>
$('#judul_perhalaman').html('<h5 class="m-0 text-dark wadah-mengetik">Pegawai</h5>');
$('#sub_breadcrumb').html('Daftar Pegawai');
var save_method;
var table;
$('#dis_nip').hide();
$('#dis_nip_user').hide();
$('#hi_pass').hide();
$('#pass_create').hide();
$(document).ready(function() {
    
    if ( $.fn.dataTable.isDataTable( '#ajax_datapegawai' ) ) {
      table = $('#ajax_datapegawai').DataTable();
    }else{
      table = $('#ajax_datapegawai').DataTable({   
      //$('#ajax_listrekanan').DataTable({
          responsive: true,
          retrieve  : true,
          autoWidth : false,
          processing: true, //Feature control the processing indicator.
          serverSide: true, //Feature control DataTables' server-side processing mode.
          order     : [],   //Initial no order.

          // Load data for the table's content from an Ajax source
          ajax: {
              url: "load_module_pegawai/get_ajax_datapegawai",
              type: "POST"
          },

          //Set column definition initialisation properties.
          columnDefs: [
          { 
              targets: [ -1 ], //last column
              orderable: false, //set not orderable
          },
          ],

      });
    }
    //table.destroy();
    /*
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
   */

  

});
/*
function get_gol_pang(){

  // var id = $(this).val();
  // $.ajax({
  //     //url : "<?php //echo site_url('product/get_sub_category');?>",
  //     url : "daftar_sppd/get_petugasygditugaskan",
  //     method : "POST",
  //     data : {id: id},
  //     async : true,
  //     dataType : 'json',
  //     success: function(data){
           
  //         var html = '';
  //         var i;
  //         var no=1;
  //         for(i=0; i<data.length; i++){
  //             html += '<option value='+data[i].nip+'>'+no+'. '+data[i].nip+'-'+data[i].nama_pegawai+'</option>';
  //             no++;
  //         }
  //         $('#pelaksana').html(html);

  //     }
  // });
  // return false;

  Ext.Ajax.request({
      url: base_url+"index.php/load_module_pegawai/get_golongan",
      params: { },
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        $('#golongan').append('');
        if (cst.result == true){

          var html = '';
          var i;
          var no=1;
          for(i=0; i<cst.result_data.length; i++){
              //html += '<option value='+cst.result_data[i].golongan+'>'+cst.result_data[i].golongan+'-'+cst.result_data[i].pangkat+'</option>';
              $('#golongan').append('<option value='+cst.result_data[i].golongan+'>'+cst.result_data[i].golongan+'-'+cst.result_data[i].pangkat+'</option>');
          }
          
        }else{  

        }
      },
      failure: function(o) {        
        toastr.error('Hubungi Admin !!!');
      },  
  });
}
*/
function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax 
}

function get_datapegawai($id_nip){
  // $('#deleteform').click(function() {
    var id_nip = $id_nip;
    $('#loading_editpegawai').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module_pegawai/get_datapegawai_byidnip",
        params: {
            id_nip    : id_nip            
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          //console.log(cst);
          if (cst.result == true){

            $('#id_nip').val(cst.result_data[0].id_nip);
            $('#nip_nik').val(cst.result_data[0].nip);
            $('#nama_pegawai').val(cst.result_data[0].nama_pegawai);
            $('#jabatan').val(cst.result_data[0].jabatan);
            $('#golongan').val(cst.result_data[0].golongan);            
            $('#unit_kerja').val(cst.result_data[0].unit_kerja);
            $('#gol_peg').val(cst.result_data[0].gol_peg);
            $('#jns_kel').val(cst.result_data[0].jns_kel);
            $('#email').val(cst.result_data[0].email);
            $('#status').val(cst.result_data[0].status);

            $('#loading_editpegawai').hide();            

          }else{  

            toastr.error(cst.pesan);
            $('#loading_editpegawai').hide();
            $('#modal-editlistpegawai').modal('hide'); 

          }
        },
        failure: function(o) {
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });
  // });
}


function get_data_edit_user_login_apk($nip){

    $('#loading_edit_user_login_apk').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module_pegawai/get_data_edit_user_login_apk",
        params: {
            nip    : $nip            
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          //console.log(cst);
          if (cst.result == true){

            $('#id_akses').val(cst.result_data[0].id_akses);
            $('#user_login_nip').val(cst.result_data[0].nip);
            $('#pass').val(cst.result_data[0].pass);
            $('#aktif').val(cst.result_data[0].aktif);
            $('#tgl_buat').val(cst.result_data[0].tgl_buat);
            $('#pass_create').val(cst.result_data[0].show_pass);

            $('#loading_edit_user_login_apk').hide();
            $('#reg_baru').hide();

          }else{  

            toastr.error(cst.pesan);
            $('#id_akses').val('');
            $('#user_login_nip').val(cst.nip);
            $('#reg_baru').show();
            //$('#loading_edit_user_login_apk').hide();
            //$('#modal-edit_user_login_apk').modal('hide'); 

          }
        },
        failure: function(o) {
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });
  // });
}

function oke(){
  $('#loading_edit_user_login_apk').hide();
  $('#id_akses').val('');
  $('#pass').val('-');
  $('#pass_create').val('');
  $('#aktif').val('t');
  
  //var arrbulan  = ["01","02","03","04","05","06","07","08","09","10","11","12"];
  var date      = new Date();
  var tanggal   = (("0"+date.getDate()).slice(-2));
  var bulan     = (("0"+(date.getMonth()+1)).slice(-2));
  var tahun     = (date.getFullYear());
  var tgl_skrng = tahun+'-'+bulan+'-'+tanggal;

  $('#tgl_buat').val(tgl_skrng);
}

function view_editpegawai($id_nip){
  save_method = 'edit_pegawai';
  $('#form')[0].reset(); // reset form on modals
  $('#modal-editlistpegawai').modal('show');  
  $('#loading_editpegawai').hide();  
  $('#btn_simpanpegawai').html('<i class="fas fa-save" ></i> Update');
  $('#btn_simpanpegawai').attr('disabled',false);
  get_datapegawai($id_nip);

}

function view_deletepegawai($id_nip, $nip){   
  $('#modal-deletepegawai').modal('show');  
  $('#loading_delete_pegawai').hide();
  $('#id_nip_delete').val($id_nip);
  $('#nip_delete').val($nip);
  $('#textx').html("<strong>Yakin di hapus Data<br>Sistem akan menghapus <br>Data Pegawai & Data Login Aplikasi<br>-"+$nip+"- ?</strong>");
}

function view_user($nip, $level){ 
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-start',
    showConfirmButton: false,
    timer: 6000
  }); 

  if ($level == 4){ // admin
    save_method = 'edit_user_login_apk';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-edit_user_login_apk').modal('show');  
    $('#loading_edit_user_login_apk').hide();  
    $('#btn_edit_user_login_apk').html('<i class="fas fa-save" ></i> Update');
    $('#btn_edit_user_login_apk').attr('disabled',false);
    get_data_edit_user_login_apk($nip);    
  }else{
    Toast.fire({
      icon: 'error',
      title: "&nbsp;&nbsp; Terkunci oleh Admin &nbsp;&nbsp;<i class='fa fa-lock' style='color:#fa0000;'></i>"
    })
  }
}

function add_pegawai(){
    save_method = 'tambah_pegawai';
    $('#form')[0].reset(); // reset form on modals
    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string
    $('#modal-editlistpegawai').modal('show');
    $('#loading_editpegawai').hide();
    $('#btn_simpanpegawai').html('<i class="fas fa-save" ></i> Simpan'); //text
    $('#btn_simpanpegawai').attr('disabled',false);
    //$('.modal-title').text('Tambah Surat Perintah Perjalanan Dinas (SPPD)'); // Set Title to Bootstrap modal title
}

function simpanpegawai(){  

  $('#btn_simpanpegawai').attr('disabled',true); //set button disable 
  var url;
  $('#loading_editpegawai').show();
  if(save_method == 'tambah_pegawai') {
    $('#btn_simpanpegawai').text('Simpan Data...'); //change button text    
    url = "tambah_pegawai";
    function params(){
      var params = {
        nip_nik       : $('#nip_nik').val(),
        nama_pegawai  : $('#nama_pegawai').val(),
        jabatan       : $('#jabatan').val(),
        golongan      : $('#golongan').val(),
        unit_kerja    : $('#unit_kerja').val(),        
        gol_peg       : $('#gol_peg').val(),
        jns_kel       : $('#jns_kel').val(),
        email         : $('#email').val(),
        status        : $('#status').val()
      }

      //console.log(params);
      return params
    }
  }else{
    $('#btn_simpanpegawai').text('Update Data...'); //change button text
    url = "update_pegawai";
    function params(){
      var params = {
        id_nip        : $('#id_nip').val(),
        nip_nik       : $('#nip_nik').val(),
        nama_pegawai  : $('#nama_pegawai').val(),
        jabatan       : $('#jabatan').val(),
        golongan      : $('#golongan').val(),
        unit_kerja    : $('#unit_kerja').val(),        
        gol_peg       : $('#gol_peg').val(),
        jns_kel       : $('#jns_kel').val(),
        email         : $('#email').val(),
        status        : $('#status').val()
      }

      console.log(params);
      return params
    }
  }

  Ext.Ajax.request({
      url: base_url+"index.php/load_module_pegawai/"+url,
      params: params(),
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        //console.log(cst);
        if (cst.result == true){
          toastr.success(cst.pesan);
          $('#loading_editpegawai').hide();
          $('#modal-editlistpegawai').modal('hide');
          reload_table();
        }else{  
          if (cst.count_data == 404){
            toastr.warning(cst.pesan);
            $('#loading_editpegawai').hide();
            $('#btn_simpanpegawai').html('<i class="fas fa-save" ></i> Simpan'); //text
            $('#btn_simpanpegawai').attr('disabled',false);    
          }else{            
            Toast.fire({
              icon: 'error',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_editpegawai').hide();
            $('#modal-editlistpegawai').modal('hide');
          }          
        }
      },
      failure: function(o) {
        reload_table();
        //toastr.error('Hubungi Admin !!!');
        Toast.fire({
          icon: 'error',
          title: "&nbsp;&nbsp; Hubungi Admin !!!"
        })
      },  
  }); 


  const Toast = Swal.mixin({
    toast: true,
    position: 'top-start',
    showConfirmButton: false,
    timer: 6000
  }); 
}

function onclick_update_user_login(){
  $('#btn_edit_user_login_apk').attr('disabled',true); //set button disable   
  $('#loading_edit_user_login_apk').show();  
  var url;
  
  if ($('#id_akses').val() == ''){ //reg_baru    
    
    $('#btn_edit_user_login_apk').text('Proses Data...'); //change button text    
    url = "reg_insert";
    function params(){
      var params = {
        //id_akses            : $('#nip_nik').val(),
        nip                 : $('#user_login_nip').val(),
        pass                : $('#pass_create').val(),
        level               : 0,
        security_level_apk  : 2,
        show_pass           : $('#pass_create').val(),
        tgl_buat            : $('#tgl_buat').val(),
        aktif               : 'y'
      }      
      return params
    }   

  }else{ //update
    
    $('#btn_edit_user_login_apk').text('Proses Data...'); //change button text    
    url = "reg_update";
    function params(){
      var params = {
        id_akses            : $('#id_akses').val(),
        nip                 : $('#user_login_nip').val(),
        pass                : $('#pass_create').val(),        
        security_level_apk  : 2,
        show_pass           : $('#pass_create').val(),
        tgl_buat            : $('#tgl_buat').val(),
        aktif               : $('#aktif').val()
      }
      return params
    }

  }

  Ext.Ajax.request({
      url: base_url+"index.php/load_module_pegawai/"+url,
      params: params(),
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        //console.log(cst);
        if (cst.result == true){
          toastr.success(cst.pesan);
          $('#loading_edit_user_login_apk').hide();
          $('#modal-edit_user_login_apk').modal('hide');
          reload_table();
        }else{
          if (cst.count_data == 404){
            toastr.warning(cst.pesan);
            $('#loading_edit_user_login_apk').hide();
            $('#btn_edit_user_login_apk').html('<i class="fas fa-save" ></i> Update'); //text
            $('#btn_edit_user_login_apk').attr('disabled',false);    
          }else{            
            Toast.fire({
              icon: 'error',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_edit_user_login_apk').hide();
            $('#modal-edit_user_login_apk').modal('hide');
          }          
        }
      },
      failure: function(o) {
        reload_table();        
        Toast.fire({
          icon: 'error',
          title: "&nbsp;&nbsp; Hubungi Admin !!!"
        })
      },  
  }); 

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-start',
    showConfirmButton: false,
    timer: 6000
  }); 

}

function enable_nip(){
  $('#nip_nik').attr('disabled',false); //set button disable
  $('#en_nip').hide();
  $('#dis_nip').show();
  $('#nip_nik').focus();
}
function disable_nip(){
  $('#nip_nik').attr('disabled',true); //set button disable
  $('#en_nip').show();
  $('#dis_nip').hide();
  $('#nip_nik').focus();
}

function enable_nip_user(){
  $('#user_login_nip').attr('disabled',false); //set button disable
  $('#en_nip_user').hide();
  $('#dis_nip_user').show();
  $('#user_login_nip').focus();
}
function disable_nip_user(){
  $('#user_login_nip').attr('disabled',true); //set button disable
  $('#en_nip_user').show();
  $('#dis_nip_user').hide();
  $('#user_login_nip').focus();
}

function show_pass(){
  $('#pass').attr('disabled',false); //set button disable
  $('#sh_pass').hide();
  $('#pass').hide();
  $('#hi_pass').show();
  $('#pass_create').show();
  $('#pass_create').focus();

}
function hide_pass(){
  $('#pass').attr('disabled',true); //set button disable
  $('#sh_pass').show();
  $('#pass').show();
  $('#hi_pass').hide();
  $('#pass_create').hide();
  $('#pass_create').focus();
}


function delete_peg(){
  $('#loading_delete_pegawai').show();
  Ext.Ajax.request({
      url: base_url+"index.php/load_module_pegawai/delete_pegawai",
      params: {
          id_nip    : $('#id_nip_delete').val(),
          nip       : $('#nip_delete').val()
        },
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        
        if (cst.result == true){
          reload_table();
          toastr.success(cst.pesan);          
        }else{            
          toastr.error(cst.pesan);
        }
        
        $('#loading_delete_pegawai').hide();
        $('#modal-deletepegawai').modal('hide');
      },
      failure: function(o) { 
        reload_table();
        toastr.error('Hubungi Admin !!!');
      },  
  });  
}
</script>