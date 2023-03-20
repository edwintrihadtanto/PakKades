<div class="modal fade" id="setting_user">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h6 class="modal-title">Profil</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-success">
                <h3 class="widget-user-username" style="font-size: 20px;"><?php echo $this->session->userdata("nm_lengkap")?></h3>
                <h5 class="widget-user-desc" style="font-size: 18px;"><?php echo $this->session->userdata("user")?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?php echo base_url('public/css/img/rssm_transparan.png') ?>" alt="Foto Profil">
              </div>
              <div class="card-footer">                
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
      <?php 
      //if (isset($error_updatepassword)) { echo $error_updatepassword; };
      ?>
      <!-- <form action="#" id="form" class="form-horizontal" method="POST"> -->
        <div class="overlay-wrapper" id="loading">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
        
        <div class="input-group mb-3" onload="setFocusToTextBox()">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Password Lama" id='oldpassword' required autofocus>
        </div>
        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Password Baru" id='newpassword' required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-check"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Hak Akses Sebagai" name='akses' value='<?php echo $this->session->userdata("ket_level")?>' required readonly="readonly">
        </div>    
      
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
        <button type="submit" class="btn btn-primary" id ="btn_updatepass"><i class="fas fa-save" ></i> Simpan Perubahan</button>
      </div>
      <!-- </form> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('#loading').hide();  
    
    function setFocusToTextBox(){
      document.getElementById("oldpassword").focus();
    }
    
    function hub_admin(){
      toastr.error('Hubungi Admin !!!');
    }

    function params(){      
      var params = {
        oldpassword : $('#oldpassword').val(),
        newpassword : $('#newpassword').val(),       
      }
      console.log(params);
      return params
    }

    $('#btn_updatepass').on('click',function(){        
        $('#loading').show();
        var oldpassword = $('#oldpassword').val();
        var newpassword = $('#newpassword').val();        

        Ext.Ajax.request({
          url: base_url+"index.php/main/gantiPass",
          params: params(),
          success: function(response) {
            var cst = Ext.decode(response.responseText);            
            if (cst.count_data == 1){            
              toastr.success(cst.pesan);
              $('#loading').hide();
              $('#oldpassword').val('');
              $('#newpassword').val('');
              $('#setting_user').modal('hide');
            }else if (cst.count_data == 404){
              toastr.error(cst.pesan);
              $('#loading').hide();
              $('#oldpassword').val('');
              $('#newpassword').val('');
            }else{
              toastr.error(cst.pesan);
              $('#loading').hide();
              $('#oldpassword').val('');
              $('#newpassword').val('');
            }
          },
          failure: function(o)
          { 
              $('#loading').hide();
              hub_admin();
          },  
        });

    });
  });
</script>