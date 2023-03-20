
<div class="modal fade" id="add_module_modultarget">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Tambah Module</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="overlay-wrapper" id="loading_modul">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-text-height"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Nama Module" id='mod_name' required>
        </div>        

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <div class="col-sm-7">
              <label><i class="fas fa-check"></i>  Pilih Group Module</label>
                <select class="custom-select" id="group_name">
                  <option value="0">Pilih Jenis Group</option>
                  <?php foreach($group_name as $get_group_name):?>                  
                  <option value="<?php echo $get_group_name->group_name; ?>"><?php echo $get_group_name->group_name; ?></option>
                  <?php endforeach;?>
                </select>              
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <div class="col-sm-6">
              <label><i class="fas fa-list-alt"></i> Pilih Modal / Content</label>
                <select class="custom-select" id="select_opsi_submenu">
                  <option value="9"> Wajib Pilih</option>
                  <option value="0"> Modal Dialog</option>
                  <option value="1"> Content</option>
                </select>
            </div>
            <div class="col-sm-6">
              <label><i class="fas fa-list-alt"></i> Pilih Icon</label>
                <select class="custom-select" id="select_icon">
                  <option value="0"> Icon Check</option>
                  <option value="1"> Icon Daftar 1</option>
                  <option value="2"> Icon Daftar 2</option>
                  <option value="3"> Icon Tambah</option>
                  <option value="4"> Icon User Single</option>
                  <option value="5"> Icon User Banyak</option>
                  <option value="6"> Icon Keluar</option>
                </select>
            </div>  
          </div>
        </div>
          

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
        <button type="submit" class="btn btn-primary" id ="btn_savemodul"><i class="fas fa-save" ></i> Simpan</button>
      </div>      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//$(function() {
$(document).ready(function(e) {   
       
    $('#loading_modul').hide();        
    function hub_admin(){
      toastr.error('Hubungi Admin !!!')
    }

    function empty(){        
        $('#mod_name').val('');        
    }

    function params(){            

      var params = {
        mod_name              : $('#mod_name').val(),
        group_name            : $('#group_name').val(),
        select_icon           : $('#select_icon').val(),
        select_opsi_submenu   : $('#select_opsi_submenu').val(),
      }      
      console.log(params);
      return params
    }

    $('#btn_savemodul').on('click',function(){        
        $('#loading_modul').show();
        
        Ext.Ajax.request({
          url: base_url+"index.php/main/save_mod",
          params: params(),
          success: function(response) {
            var cst = Ext.decode(response.responseText);            
            if (cst.count_data == 200){            
              toastr.success(cst.pesan);
              $('#loading_modul').hide();
              empty();
              $('#add_module_modultarget').modal('hide');            
            }else{
              toastr.error(cst.pesan);
              $('#loading_modul').hide();
              empty();
              $('#add_module_modultarget').modal('hide');
            }
          },
          failure: function(o)
          { 
              $('#loading_modul').hide();
              hub_admin();
          },  
        });
    });
  //});

// -----  
});
</script>