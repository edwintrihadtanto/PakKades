
<div class="modal fade" id="add_group_module_modultarget">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Tambah Group Module</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="overlay-wrapper" id="loading_groupmodul">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-text-width"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Nama Group" id='mod_group' required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
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
            <div class="col-sm-6">
              <label><i class="fas fa-list-alt"></i> Nanti Punya Sub Modul</label>
                <select class="custom-select" id="select_opsi_sub">
                  <option value="0"> Modal</option>
                  <option value="1"> Sub Menu</option>
                  <option value="2"> Langsung Menu</option>
                </select>
            </div>
          </div>
        </div>   

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
        <button type="submit" class="btn btn-primary" id ="btn_savemod_group"><i class="fas fa-save" ></i> Simpan</button>
      </div>      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//$(function() {
$(document).ready(function(e) {   
       
    $('#loading_groupmodul').hide();        
    function hub_admin(){
      toastr.error('Hubungi Admin !!!')
    }

    function empty(){        
        $('#mod_group').val('');        
    }

    function params(){            

      var params = {
        group_name    : $('#mod_group').val(),
        select_icon   : $('#select_icon').val(),
        select_opsi_sub   : $('#select_opsi_sub').val(),
      }      
      console.log(params);
      return params
    }

    $('#btn_savemod_group').on('click',function(){        
        $('#loading_groupmodul').show();
        
        Ext.Ajax.request({
          url: base_url+"index.php/main/save_modgroup",
          params: params(),
          success: function(response) {
            var cst = Ext.decode(response.responseText);            
            if (cst.count_data == 200){            
              toastr.success(cst.pesan);
              $('#loading_groupmodul').hide();
              empty();
              $('#add_group_module_modultarget').modal('hide');            
            }else{
              toastr.error(cst.pesan);
              $('#loading_groupmodul').hide();
              empty();
              $('#add_group_module_modultarget').modal('hide');
            }
          },
          failure: function(o)
          { 
              $('#loading_groupmodul').hide();
              hub_admin();
          },  
        });
    });
  //});

// -----  
});
</script>