
<div class="modal fade" id="user_modultarget">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Tambah User</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="overlay-wrapper" id="loading_user">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Username" id='username_user' required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calculator"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="NIP/NIK" id='nip_nik' required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Nama Lengkap" id='nama_lengkap' required>
        </div>        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Password" id='newpassword_user' required>
        </div>

        <div class="form-group">
           <label class="col-lg-4"><i class="fas fa-check"></i> Pilih Group Modul</label>
           <div class="col-lg-12">
              <select multiple="multiple" class="form-control select2bs4" id="groupmod_idarray" style="cursor:pointer;width: 100%;"  required>
              <option value=''></option>             
              <?php foreach($groupmod as $groupmod_idarray):?> 
                <option value="<?php echo $groupmod_idarray->id_group; ?>"><?php echo $groupmod_idarray->group_name; ?></option>
              <?php endforeach;?>
              </select>
           </div>
        </div>

        <div class="form-group">
           <label class="col-lg-4"><i class="fas fa-check"></i> Pilih Modul</label>
           <div class="col-lg-12">
              <select multiple="multiple" class="form-control select2bs4" id="mod_idarray" style="cursor:pointer;width: 100%;"  required>
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
                <select class="custom-select" id="level" onchange="cekrekanan()">                  
                  <?php foreach($level as $getlevel):?> 
                  <option value="<?php echo $getlevel->level; ?>"><?php echo $getlevel->nmlevel; ?></option>
                  <?php endforeach;?>
                </select>              
            </div>
            <div class="col-sm-6">
              <label><i class="fas fa-check"></i>  Pilih Status Akun</label>
                <select class="custom-select" id="aktif">                   
                  <option value="false">Tidak Aktif</option>
                  <option value="true">Aktif</option>                  
                </select>              
            </div>
          </div>
        </div> 

          

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
        <button type="submit" class="btn btn-primary" id ="btn_saveuser"><i class="fas fa-save" ></i> Simpan</button>
      </div>      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//$(function() {
$(document).ready(function(e) {   
    
    
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#loading_user').hide();        
    function hub_admin(){
      toastr.error('Hubungi Admin !!!')
    }

    function empty(){        
        $('#username_user').val('');
        $('#newpassword_user').val('');
        $('#nip_nik').val('');
        $('#nama_lengkap').val('');
    }
  //$('.user_modultarget').on('click',function(){    
    //empty();
    function params(){
      var mod_id      = $('#mod_idarray').val();
      var groupmod_id = $('#groupmod_idarray').val();
      
      var params = {
        username    : $('#username_user').val(),
        newpassword : $('#newpassword_user').val(),
        nip_nik     : $('#nip_nik').val(),
        nama_lengkap: $('#nama_lengkap').val(),
        level       : $('#level').val(),        
        aktif       : $('#aktif').val(),
        kd_vendor   : $('#vendor').val()
      }
      //if (mod_id <> ''){
        params['list[]'] = mod_id;
      // }else{
      //   params['list[]'] = '0';
      // }      
      params['list_groupmod[]'] = groupmod_id;
      console.log(params);
      return params
    }

    function cekrekanan(){
      var level = document.getElementById("level").value;

      if (level == 5){//user rekanan
        alert();
      }
    }

    $('#btn_saveuser').on('click',function(){        
        $('#loading_user').show();
        
        Ext.Ajax.request({
          url: base_url+"index.php/main/save_user",
          params: params(),
          success: function(response) {
            var cst = Ext.decode(response.responseText);            
            if (cst.count_data == 200){            
              toastr.success(cst.pesan);
              $('#loading_user').hide();
              empty();
              $('#user_modultarget').modal('hide');            
            }else{
              toastr.error(cst.pesan);
              $('#loading_user').hide();
              empty();
              $('#user_modultarget').modal('hide');
            }
          },
          failure: function(o)
          { 
              $('#loading_user').hide();
              hub_admin();
          },  
        });
    });
  //});

// -----  
});
</script>