<div class="modal fade" id="form_kartu_kendali_group">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-plus-circle"></i> Form Kartu Kendali</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="overlay-wrapper" id="loading_formecc">
          <div class="overlay">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
          </div>
        </div>
        
        <div class="input-group mb-3" >
          <div class="col-sm-12">
            <label><i class="fas fa-calendar-alt"></i> Tgl. Kwitansi/Penyerahan Berkas :</label>
            <input type="date" class="form-control" id='form_ecc_tglkwitansi' value="<?php echo date('Y-m-d') ?>" style="text-align: right;"required>
          </div>
        </div> 
        <hr>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Inputkan Nomor Kwitansi" id='form_ecc_nokwitansi' required>
        </div>
        
        <div class="input-group mb-3">
           <label class="col-lg-6"><i class="fas fa-check"></i> Pilih Perusahaan / Rekanan</label>
           <div class="col-lg-12">
              <select class="custom-select" id="kd_vendor"> 
              <option value=''>Pilih Perusahaan / Rekanan</option>
                <?php foreach($vendor as $getvendor):?> 
                <option value="<?php echo $getvendor->kd_vendor; ?>"><?php echo $getvendor->vendor; ?></option>
                <?php endforeach;?>
              </select>  
           </div>
        </div>       

        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Input Nominal Kwitansi" id='form_ecc_nominal' style="text-align: right;" required>
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span>
          </div>          
        </div>   

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
          </div>
          <!-- <input type="text" class="form-control" placeholder="Input Keterangan" id='form_ecc_keterangan' required> -->
          <textarea type="text" class="form-control" placeholder="Input Keterangan" id='form_ecc_keterangan' required style="height: 30mm;"></textarea> 
        </div>   

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
        <button type="submit" class="btn btn-success" id ="btn_saveform_kartu_kendali_group"><i class="fas fa-save" ></i> Simpan</button>
      </div>      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//$(function() {
$(document).ready(function(e) {   
       
    $('#loading_formecc').hide();    
    function hub_admin(){
      toastr.error('Hubungi Admin !!!')
    }

    function empty(){        
      $('#form_ecc_nokwitansi').val(''),
      $('#form_ecc_nmperusahaan').val(''),
      $('#form_ecc_nominal').val(''),
      $('#form_ecc_keterangan').val('')
    }

    function params(){            

      var params = {
        no_kwitansi     : $('#form_ecc_nokwitansi').val(),
        //nm_perusahanan  : $('#form_ecc_nmperusahaan').val(),
        kd_vendor       : $('#kd_vendor').val(),
        nominal         : $('#form_ecc_nominal').val(),
        keterangan      : $('#form_ecc_keterangan').val(),
        tgl_kwitansi    : $('#form_ecc_tglkwitansi').val()
      }      
      console.log(params);
      return params
    }
    $('#btn_saveform_kartu_kendali_group').on('click',function(){        
        $('#loading_formecc').show();
        //save_form_kartu_kendali_groups
        Ext.Ajax.request({
          url: base_url+"index.php/main/save_form_kartukendali",
          params: params(),
          success: function(response) {
            var cst = Ext.decode(response.responseText);
            if (cst.count_data == 200){
              toastr.success(cst.pesan);
              $('#loading_formecc').hide();
              empty();
              $('#form_kartu_kendali_group').modal('hide');
            }else if (cst.count_data == 404){
              toastr.error(cst.pesan);
              $('#loading_formecc').hide();
            }else{
              toastr.error(cst.pesan);
              $('#loading_formecc').hide();              
            }
          },
          failure: function(o)
          { 
              $('#loading_formecc').hide();
              hub_admin();
          },  
        });
    });
  //});

// -----  
});
</script>