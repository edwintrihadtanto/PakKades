<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      List Kartu Kendali
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div>
  <!-- 
  <div class="overlay-wrapper" id="loading_form_listrekanan">
    <div class="overlay">
      <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
    </div>
  </div> 
  -->
  <div class="card-body">
      <table id="ajax_listkendali" class="table table-bordered table-striped">
        <thead>
          <tr class="navbar-warning " style="font-size: 11px;">
              <th width="5" align="center">No.</th>
              <th width="140">No. Kwitansi</th>
              <th>Nama Perusahaan / Rekanan</th>
              <th width="100">Nominal Kwitansi</th>
              <th width="85">Tgl. Penyerahan</th>
              <th width="130">Keterangan</th>
              <th width="70">Opsi</th>              
          </tr>
        </thead>
        <tbody style="font-size: 13px;">
        </tbody>
      </table>      
  </div>
  <!-- /.card -->
</div>

<div class="modal fade" id="modal-deletelist">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h5 class="modal-title">Peringatan !!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_form_deletekendali">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
        </div>
      </div>
      <div class="modal-body">
        
        <table>
          <tr>
            <td>No Kwitansi</td>
            <td>:</td>
            <td><input type="text" id="nokwitansi" disabled="disabled" ="true" style="width: 45mm;"></td>
          </tr>
          <tr>
            <td>Rekanan</td>
            <td>:</td>
            <td><input type="text" id="rekanan" disabled="disabled" ="true" style="width: 70mm;"></td>
          </tr>          
        </table>
        <br>
        <input type="text" id="id_form_delete" required disabled hidden="true">
        <p align="right"><strong>Hapus data ini ???</strong></p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        <button type="button" class="btn btn-warning btn-sm" id='deleteform' onclick="deleteform()"><i class="fa fa-trash"></i> Hapus</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-editelist">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-pencil-alt"></i> Perubahan Form Kartu Kendali</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_form_editkendali">
        <div class="overlay">
          <p align="center"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
            <!-- <img src="<?php //echo base_url(); ?>public/blue-loading.gif"/> -->
            <br><br>
          <strong>-_Sedang Memuat_-</strong>
          </p>
        </div>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3" >
          <div class="col-sm-12">
            <label><i class="fas fa-calendar-alt"></i> Tgl. Kwitansi/Penyerahan Berkas :</label>
            <input type="date" class="form-control" id='form_edittglkwitansi' value="<?php echo date('Y-m-d') ?>" style="text-align: right;"required>
          </div>
        </div>  
        <hr>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Inputkan Nomor Kwitansi" id='form_editnokwitansi' disabled="disabled" required>
        </div>
        <div class="input-group mb-3">
           <label class="col-lg-6"><i class="fas fa-desktop"></i> Pilih Perusahaan / Rekanan</label>
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
          <input type="number" class="form-control" placeholder="Input Nominal Kwitansi" id='form_editnominal' style="text-align: right;" required>
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span>
          </div>          
        </div>   

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
          </div>
          <!-- <input type="text" class="form-control" placeholder="Input Keterangan" id='form_ecc_keterangan' required> -->
          <textarea type="text" class="form-control" placeholder="Input Keterangan" id='form_editketerangan' required style="height: 30mm;"></textarea> 
        </div>
        <div class="col-sm-10">
            <label><i class="fas fa-calendar-alt"></i> Tgl. Entry :</label>
          </div>
        <div class="input-group mb-2" >          
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <input type="text" class="form-control" id='form_edittglentry' value="<?php echo date('Y-m-d') ?>" required disabled>
        </div>  
         
        <input type="text" id='id_formedit' required disabled hidden="true">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        <button type="button" class="btn btn-success btn-sm" id="updateform" onclick="updateform()"><i class="fa fa-save"></i> Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
var table;
$(document).ready(function() {

    //datatables  
    if ( $.fn.dataTable.isDataTable( '#ajax_listkendali' ) ) {
      table = $('#ajax_listkendali').DataTable();
    }else{
      table = $('#ajax_listkendali').DataTable({   
      //$('#ajax_listrekanan').DataTable({
          responsive: true,
          retrieve: true,
          autoWidth : false,
          processing: true, //Feature control the processing indicator.
          serverSide: true, //Feature control DataTables' server-side processing mode.
          order     : [],   //Initial no order.

          // Load data for the table's content from an Ajax source
          ajax: {
              url: "load_module/get_extlist_kendali",
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

function view_deleteform($nokwitansi, $id_form, $nm_rekanan){ //delete
  $('#modal-deletelist').modal('show');  

  $('#rekanan').val($nm_rekanan);
  $('#nokwitansi').val($nokwitansi);
  $('#id_form_delete').val($id_form);
  $('#loading_form_deletekendali').hide();

}

function deleteform(){
  // $('#deleteform').click(function() {
    $('#loading_form_deletekendali').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module/delete_listformx",
        params: {
            id_form    : $('#id_form_delete').val(),
            nokwitansi : $('#nokwitansi').val()
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          
          if (cst.count_data == 200){
            reload_table();
            toastr.success(cst.pesan);
            $('#loading_form_deletekendali').hide();
            $('#modal-deletelist').modal('hide');
          }else{            
            toastr.error(cst.pesan);
            $('#loading_form_deletekendali').hide();
            $('#modal-deletelist').modal('hide');  
          }
        },
        failure: function(o) { 
          reload_table();
          hub_admin();
        },  
    });
  // });
}

function view_editform($id_form, $nokwitansi){ //edit
  $('#modal-editelist').modal('show');
  var id_form    = $id_form;
  var nokwitansi = $nokwitansi;
  
  Ext.Ajax.request({
      url: base_url+"index.php/load_module/get_datakendali",
      params: {
          id_form : id_form,
          nokwitansi : nokwitansi
        },
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        if (cst.count_data == 200){ 
          //toastr.success(cst.pesan);
          $('#form_editnokwitansi').val(cst.result_data[0].no_kwitansi);
          $('#form_editrekanan').val(cst.result_data[0].nm_rekanan);
          $('#form_editnominal').val(cst.result_data[0].rpkwitansi);
          $('#form_editketerangan').val(cst.result_data[0].ket);
          $('#form_edittglkwitansi').val(cst.result_data[0].tgl_kwitansi);
          $('#form_edittglentry').val(cst.result_data[0].tgl_entry);
          $('#id_formedit').val(cst.result_data[0].id_form);
          $('#kd_vendor').val(cst.result_data[0].kd_vendor);

          $('#loading_form_editkendali').hide();
        }else{
          toastr.warning(cst.pesan);
          $('#modal-editelist').modal('hide');
          $('#loading_form_editkendali').hide();
        }
      },
      failure: function(o)
      { 
          //$('#loading_form_editkendali').hide();
          hub_admin();
      },  
  });  

  // $('#updateform').on('click',function(){
  //   $('#loading_form_editkendali').show();
  //   Ext.Ajax.request({
  //       url: base_url+"index.php/load_module/update_form_kartukendali",
  //       params: {
  //           id_form         : id_form,
  //           nokwitansi      : nokwitansi,
  //           nm_perusahanan  : $('#form_editrekanan').val(),
  //           nominal         : $('#form_editnominal').val(),
  //           keterangan      : $('#form_editketerangan').val(),
  //           tgl_kwitansi    : $('#form_edittglkwitansi').val()
  //         },
  //       success: function(response) {
  //         var cst = Ext.decode(response.responseText);            
  //         if (cst.count_data == 200){
  //           reload_table();           
  //           toastr.success(cst.pesan);
  //           $('#loading_form_editkendali').hide();
  //           $('#modal-editelist').modal('hide');
  //         }else{
  //           toastr.error(cst.pesan);            
  //         }
  //       },
  //       failure: function(o)
  //       {             
  //           reload_table();
  //           hub_admin();
  //       },  
  //   });
  // });
}

function updateform(){
  // $('#updateform').on('click',function(){
    $('#loading_form_editkendali').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module/update_form_kartukendali",
        params: {
            id_form         : $('#id_formedit').val(),
            nokwitansi      : $('#form_editnokwitansi').val(),
            kd_vendor       : $('#kd_vendor').val(),
            nominal         : $('#form_editnominal').val(),
            keterangan      : $('#form_editketerangan').val(),
            tgl_kwitansi    : $('#form_edittglkwitansi').val()
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          if (cst.count_data == 200){
            reload_table();           
            toastr.success(cst.pesan);
            $('#loading_form_editkendali').hide();
            $('#modal-editelist').modal('hide');
          }else{
            toastr.error(cst.pesan);            
          }
        },
        failure: function(o)
        {             
            reload_table();
            hub_admin();
        },  
    });
  // });
}
function cek_check($id_form){
  

    // var id = $('#cek_verif_awal').val();
      
    //   var params = {
    //     // username    : $('#username_user').val(),
    //     // newpassword : $('#newpassword_user').val(),
    //     // nip_nik     : $('#nip_nik').val(),
    //     // nama_lengkap: $('#nama_lengkap').val(),
    //     // level       : $('#level').val(),        
    //     // aktif       : $('#aktif').val()
    //   }
    //   params['list[]'] = id;
    //   console.log(params);
    //   return params

    
    
      $('.cek_verif_awal').click(function(){  
        var id_form = [];  
        $('.cek_verif_awal').each(function(){  
            if($(this).is(":checked"))  
            {  
              id_form.push($(this).val());
            }  
        });  
        id_form = new Array(id_form.toString());
        console.log(id_form); 
        if (id_form != ''){
          $('#kelengkapan_complete').show();
        }else{
          $('#kelengkapan_complete').hide();
        }
         

      });

    
    
    
}

function hub_admin(){
  toastr.error('Hubungi Admin !!!')
}

</script>