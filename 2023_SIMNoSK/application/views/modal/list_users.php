<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      List Users
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div>
  
  <div class="card-body">
      <table id="ajax_listusers" class="table table-bordered table-striped">
        <thead>
          <tr class="navbar-primary " style="font-size: 11px;">
              <th width="5" align="center">No.</th>
              <th width="100">Username</th>
              <th>Nama Lengkap</th>
              <th>Dari Perusahaan</th>
              <th width="100">Password</th>
              <th width="180">NIP</th>
              <th width="70">Opsi</th>
          </tr>
        </thead>
        <tbody style="font-size: 13px;">
        </tbody>
      </table>      
  </div>
 
</div>

<div class="modal fade" id="modal-deletelistuser">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h5 class="modal-title">Peringatan !!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_delete_listusers">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
        </div>
      </div>
      <div class="modal-body">        
        <input type="text" id="id_form_delete" required disabled hidden="true">
        <p align="right"><strong>Hapus Data User ???</strong></p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        <button type="button" class="btn btn-outline-light btn-sm" id='deletelistuser' onclick="deletelistuser()"><i class="fa fa-trash"></i> Hapus</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-editlistuser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-pencil-alt"></i> Perubahan User</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_edituser">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
      <div class="modal-body">     
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Username" id='editusername_user' required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calculator"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="NIP/NIK" id='editnip_nik' required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Nama Lengkap" id='editnama_lengkap' required>
        </div>        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Password" id='editnewpassword_user' required>
        </div>

        <div class="form-group">
           <label class="col-lg-4"><i class="fas fa-check"></i> Pilih Group Modul</label>
           <div class="col-lg-12">
              <select multiple="multiple" class="form-control select2bs4" id="editgroupmod_idarray" style="cursor:pointer;width: 100%;"  required>
              <option value=''></option>             
              <?php foreach($groupmod as $groupmod_idarray):?> 
                <option value="<?php echo $groupmod_idarray->id_group; ?>"><?php echo $groupmod_idarray->group_name; ?></option>
              <?php endforeach;?>
              </select>
           </div>
        </div>

        <div class="form-group">
           <label class="col-lg-4"><i class="fas fa-check"></i> Pilih Modul</label>
           <div class="col-lg-10">
              <select multiple="multiple" class="form-control select2bs4" id="editmod_idarray" style="cursor:pointer;width: 100%;"  required>
              <option value=''></option>             
              <?php foreach($data as $mod_idarray):?> 
                <option value="<?php echo $mod_idarray->mod_id; ?>"><?php echo $mod_idarray->mod_name; ?></option>
              <?php endforeach;?>
              </select>
           </div>
        </div>

        <div class="form-group">
           <label class="col-lg-4"><i class="fas fa-check"></i> Pilih Vendor</label>
           <div class="col-lg-12">
              <select class="custom-select" id="vendor"> 
              <option value=''>Kosongi Jika Bukan Vendor</option>
                <?php foreach($vendor as $getvendor):?> 
                <option value="<?php echo $getvendor->kd_vendor; ?>"><?php echo $getvendor->vendor; ?></option>
                <?php endforeach;?>
              </select>  
           </div>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <div class="col-sm-6">
              <label><i class="fas fa-check"></i>  Pilih Tipe Pengakses</label>
                <select class="custom-select" id="editlevel">                  
                  <?php foreach($level as $getlevel):?> 
                  <option value="<?php echo $getlevel->level; ?>"><?php echo $getlevel->nmlevel; ?></option>
                  <?php endforeach;?>
                </select>              
            </div>
            <div class="col-sm-6">
              <label><i class="fas fa-check"></i>  Pilih Status Akun</label>
                <select class="custom-select" id="editaktif">                   
                  <option value="f">Tidak Aktif</option>
                  <option value="t">Aktif</option>                  
                </select>              
            </div>
          </div>
        </div>   
          

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
        <button type="submit" class="btn btn-success" id ="btn_updateuser" onclick="btn_updateuser()"><i class="fas fa-save" ></i> Update</button>
      </div>      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
$('.select2bs4').select2({
  theme: 'bootstrap4'
})

var table;
$(document).ready(function() {

    //datatables  
    if ( $.fn.dataTable.isDataTable( '#ajax_listusers' ) ) {
      table = $('#ajax_listusers').DataTable();
    }else{
      table = $('#ajax_listusers').DataTable({   
      //$('#ajax_listrekanan').DataTable({
          responsive: true,
          retrieve  : true,
          autoWidth : false,
          processing: true, //Feature control the processing indicator.
          serverSide: true, //Feature control DataTables' server-side processing mode.
          order     : [],   //Initial no order.

          // Load data for the table's content from an Ajax source
          ajax: {
              url: "load_module/get_listusers",
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
   
});

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax 
}


function view_deleteusers($id_akses){ //delete
  $('#modal-deletelistuser').modal('show');  
  
  $('#id_form_delete').val($id_akses);
  $('#loading_delete_listusers').hide();
}

function view_editusers($id_akses){ //delete
  $('#modal-editlistuser').modal('show');  
  $('#loading_edituser').hide();
  get_datauser($id_akses);  
}

function deletelistuser(){
  // $('#deleteform').click(function() {
    $('#loading_delete_listusers').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module/delete_usersijisiji",
        params: {
            id_akses    : $('#id_form_delete').val()            
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          
          if (cst.count_data == 200){
            reload_table();
            toastr.success(cst.pesan);
            $('#loading_delete_listusers').hide();
            $('#modal-deletelistuser').modal('hide');
          }else{            
            toastr.error(cst.pesan);
            $('#loading_delete_listusers').hide();
            $('#modal-deletelistuser').modal('hide');  
          }
        },
        failure: function(o) { 
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });
  // });
}

function get_datauser($id_akses){
  // $('#deleteform').click(function() {
    var id_akses = $id_akses;
    $('#loading_edituser').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module/getDataUser_list",
        params: {
            id_akses    : id_akses            
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          //console.log(cst);
          if (cst.result == true){

            $('#editusername_user').val(cst.result_data[0].username);
            $('#editnip_nik').val(cst.result_data[0].nip);
            $('#editnama_lengkap').val(cst.result_data[0].nama_lengkap);
            $('#editnewpassword_user').val(cst.result_data[0].password);
            //$('#editgroupmod_idarray').val(cst.result_data[0].mod_id_group);
            $('#editmod_idarray').val(["101_4", "102_1", "101_2"]);
            $('#editlevel').val(cst.result_data[0].level);
            $('#editaktif').val(cst.result_data[0].aktif);
            $('#vendor').val(cst.result_data[0].kd_vendor);

            $('#loading_edituser').hide();            

          }else{  

            toastr.error(cst.pesan);
            $('#loading_edituser').hide();
            $('#modal-editlistuser').modal('hide'); 

          }
        },
        failure: function(o) { 
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });
  // });
}
function params(){
  var params = {
        username          : $('#editusername_user').val(),
        nip_nik           : $('#editnip_nik').val(),
        nama_lengkap      : $('#editnama_lengkap').val(),
        password          : $('#editnewpassword_user').val(),
        // groupmod_idarray  : $('#editgroupmod_idarray').val(),
        // mod_idarray       : $('#editmod_idarray').val(),
        level             : $('#editlevel').val(),        
        aktif             : $('#editaktif').val()
      }
  
  console.log(params);
  return params
}
function btn_updateuser(){
      
    $('#loading_edituser').show();

    Ext.Ajax.request({
        url: base_url+"index.php/load_module/update_user",
        params: params(),
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          //console.log(cst);
          if (cst.result == true){
            reload_table();
            $('#loading_edituser').hide();
            $('#modal-editlistuser').modal('hide');

          }else{  
            toastr.error(cst.pesan);            
          }
        },
        failure: function(o) {           
          toastr.error('Hubungi Admin !!!');
          $('#loading_edituser').hide();
          $('#modal-editlistuser').modal('hide');
          reload_table();
        },  
    });  
}
</script>