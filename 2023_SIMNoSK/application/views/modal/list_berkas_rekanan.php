<div class="card card-success card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      Daftar Berkas Verifikasi
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div> 
  <div class="card-body">      
      <table id="ajax_berkasrekanan" class="table table-bordered table-striped">
        <thead>
          <tr class="navbar-danger" style="font-size: 11px;color:#ffffff;" >
              <th width="5" align="center">No.</th>
              <th width="140">No. Kwitansi</th>
              <th>Nama Perusahaan / Rekanan</th>
              <th width="100">Nominal Kwitansi</th>
              <th width="85">Tgl. Penyerahan</th>
              <th width="130">Keterangan</th>
              <th width="75">Status</th>
              <th width="30">View</th>
          </tr>
        </thead>
        <tbody style="font-size: 13.5px;" >
        </tbody>
      </table>      
    <!-- </form> -->
  </div>
  <!-- /.card -->
</div>

<div class="modal fade" id="modal-viewcentangan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-check"></i> Berkas Verifikasi </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <div  id="loading_viewverifdua">
        <div class="overlay d-flex justify-content-center align-items-center">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
      </div>
      
      <div class="modal-body">
        <div class="col-lg-12" align="left">
            <table border="0">
              <tr>                
                <td width="100px"><i class="fa fa-pencil-alt"></i><b> No. Kwitansi :</td>
                <td width="250px"><i class="fa fa-desktop"></i><b> Nama Perusahaan / Rekanan :</td>
                <td></td>
                <td></td>
              </tr>
              <tr>                
                <td><input type="text" id="nokwitansi" disabled /></td>
                <td><input type="text" id="rekanan" readonly="readonly" style="width: 300px;" /></td>
                <td><input type="text" id="no_in" disabled hidden="true" /></td>
                <td><input type="text" id="idform"disabled hidden="true" /></td>                
              </tr>
            </table>
        </div>
        <!-- 
        <div class="form-group">
           <label class="col-lg-4"><i class="fa fa-arrow-down"></i> Tipe Laporan :</label>
           <div class="col-lg-12">
              <select class="custom-select" id="jns_laporan">                
                <?php foreach($jns_lap as $getjenis):?>
                <option value="<?php echo $getjenis->id; ?>"><?php echo $getjenis->nama_laporan; ?></option>
                <?php endforeach;?>
              </select>    
           </div>
        </div>
         -->
        <div id="view_laporanx"></div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Keluar</button>      
      </div>
    </div>
  </div>
</div>
<script>
//hide_icon();
load_tabel();

var table;
function load_tabel(){

  if ( $.fn.dataTable.isDataTable( '#ajax_berkasrekanan' ) ) {
    table = $('#ajax_berkasrekanan').DataTable();
  }else{
    table = $('#ajax_berkasrekanan').DataTable({         
        responsive: true,
        retrieve  : true,
        autoWidth : false,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order     : [],   //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "load_module_rekanan/get_table",
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
  
}


function view_dokumen($id_form, $nokwitansi, $valuenoin, $jns_laporan, $nm_rekanan){
  // $('#kelengkapan_complete').click(function(){  
  
      $('#modal-viewcentangan').modal('show');
      $('#loading_viewverifdua').hide();
      //$('#jns_laporan').val('1');

      var jns_laporan = $jns_laporan;
      var no_in       = $valuenoin;
      var nokwitansi  = $nokwitansi;
      var idform      = $id_form;
      var rekanan     = $nm_rekanan;

      $('#nokwitansi').val(nokwitansi);
      $('#no_in').val(no_in);
      $('#idform').val(idform);
      $('#rekanan').val(rekanan);
      jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform);
      
      // Ext.Ajax.request({
      //   url: base_url+"index.php/load_module_rekanan/cek_proses_verifikasi",
      //   params:{
      //     id_form : $id_form
      //   },
      //   success: function(response) {
      //     var cst = Ext.decode(response.responseText);
          
      //     if (cst.count == 1){ //berarti memiliki data no_in terdaftar
      //       var jns_laporan = cst.ListDataObj[0].jns_laporan;
      //       var no_in       = cst.noin;
      //       var nokwitansi  = cst.nokwitansi;
      //       var idform      = cst.idform;
      //       var jmlcek      = cst.count_det[0].jmlh_noin;
            
      //       $('#loading_viewverifdua').hide();
      //       $('#jns_laporan').val(jns_laporan);
      //       jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform);

      //     }else{
      //       var jns_laporan = '0';
      //       var no_in       = '0';
      //       var nokwitansi  = cst.nokwitansi;
      //       var idform      = cst.idform;
      //       var jmlcek      = cst.count_det[0].jmlh_noin;
      //       $('#loading_viewverifdua').hide(); 
      //       $('#jns_laporan').val('');
      //       jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform);
      //     }
      //   },
      //   failure: function(o){              
      //     toastr.error("Hubungi Admin");
      //   },  
      // });      
      
  //   }else{
  //     hide_icon();
  //     toastr.error("Silahkan pilih salah satu untuk proses selanjutnya !!!");
  //   }

  // }else{
  //   hide_icon();
  //   toastr.error("Belum ada yang dipilih !!!");
  // }
}
function jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform){
  //$("#jns_laporan").change(function(){
      //var idjns_laporan = $("#jns_laporan").val();
     
      $('#loading_viewverifdua').show();

      Ext.Ajax.request({
        url: base_url+"index.php/load_module_rekanan/getlaporan_jenislaporan",
        params:{
          no_in       : no_in,
          nokwitansi  : nokwitansi,
          id          : jns_laporan
        },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          if (cst.count_data == 'success'){
            $("#view_laporanx").html(cst.data);
            $('#loading_viewverifdua').hide(); 
            reload_table();                         
          }else{
            reload_table();
            $('#loading_viewverifdua').hide();
            //toastr.warning(cst.data);
            $("#view_laporanx").html("<div align='center' class='berkedip'><hr><h5>Belum Di Proses<br>Tim Verifikasi RSUD dr. Soedono Madiun</h5><hr></div>");
            
          }
        },
        failure: function(o){              
          toastr.error("Hubungi Admin");
        },  
      });

  //});
  

}

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax 
}

function print_laporan($id_form, $nokwitansi, $valuenoin, $jns_laporan){
  
  var idform     = $id_form;
  var nokwitansi = $nokwitansi;
  var valuenoin  = $valuenoin;
  var jns_lap    = $jns_laporan;

  var params={};
  params['idform']      = idform;
  params['nokwitansi']  = nokwitansi;
  params['valuenoin']   = valuenoin;
  params['jns_lap']     = jns_lap;
  //console.log(params);
  var form = document.createElement("form");
  form.setAttribute("method", "post");
  form.setAttribute("target", "_blank");
  if (jns_lap == 1){
    form.setAttribute("action", base_url + "index.php/lap_verifikasi/preview_verifstep2_1");
  }else if (jns_lap == 2){
    form.setAttribute("action", base_url + "index.php/lap_verifikasi/preview_verifstep2_2");
  }else if (jns_lap == 3){
    form.setAttribute("action", base_url + "index.php/lap_verifikasi/preview_verifstep2_3");
  }else{
    toastr.error("Erorr,..");
  }  
  var hiddenField = document.createElement("input");
  hiddenField.setAttribute("type", "hidden");
  hiddenField.setAttribute("name", "data");
  hiddenField.setAttribute("value", Ext.encode(params));
  form.appendChild(hiddenField);
  document.body.appendChild(form);
  form.submit();
  //loadMask.hide();

}
</script>