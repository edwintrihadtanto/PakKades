<div class="card card-purple card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      Daftar Surat Perintah Perjalanan Dinas
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="add_sppd()" title="Tambah Surat Perintah Perjalanan Dinas" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus-circle" style="color: #ff0000;"></i></button>      

      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh" data-toggle="tooltip" data-placement="top"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div>
  
  <div class="card-body">
      <table id="ajax_daftar_sppd" class="table table-bordered table-striped" style="font-size: 12px;">
        <thead>
          <tr class="navbar-purple" style="color: #ffffff; " >
              <th rowspan="2" width="1" style="vertical-align: top;">No.</th>
              <th rowspan="2" width="50" style="vertical-align: top;">Tanggal</th>
              <th rowspan="2" style="vertical-align: top;">No. Surat Perintah Tugas</th>
              <th rowspan="2" style="vertical-align: top;">No. Surat Perintah Perjalanan Dinas</th>
              <th rowspan="2" width="190" style="vertical-align: top;">NIP/NPK dan Nama Pegawai</th>
              <th rowspan="2" width="30" style="vertical-align: top;">Lama Perjalanan</th>
              <th rowspan="0" colspan="3"style="text-align: center;">Status Laporan</th>
              <th rowspan="2" width="110" style="vertical-align: top;">On Proses</th>
          </tr>
          <tr class="navbar-warning">
            <th width="10">Perj.Dinas</th>            
            <th width="10">Rinc.Biaya</th>
            <th width="10">Rinc.Riil</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>      
  </div>

<!---- ADD / EDIT PEGAWAI --->
    <div class="modal fade" id="modal-ADDeditlistsppd">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header navbar-purple">
            <h6 class="modal-title" style="color: #ffffff;"><i class="fa fa-pencil-alt"></i> Surat Perintah Perjalanan Dinas</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="overlay-wrapper" id="loading_ADDeditsppd">
            <div class="overlay dark">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
            </div>
          </div>
      
          <form action="#" id="form" class="form-horizontal">
          <div class="modal-body">          

            <table border="0" cellpadding="2" cellspacing="0" width="100%">
              <tr>
                <td width="60%"><label class="col-lg-7"><i class="fas fa-calendar-alt"></i> Tgl. Surat Masuk  <b>*)</b></label> </td>
                <td></td>    
              </tr>
              <tr>
                <td>              
                  <input type="date" class="form-control cursor_tangan" value="<?php echo date('Y-m-d') ?>" id="tgl_surat_masuk" required style="width: 50mm;">
                </td>
                <td align="right">                
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>                
                    <input type="text" class="form-control" placeholder="Jumlah Petugas yang Ditugaskan (Otomatis) " id='jml_petugas' readonly="readonly" style="background-color: #ff141457;">                
                  </div>
                </td>
              </tr>
            </table>

            <hr width="90%">

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
              </div>
              <input type="text" class="form-control" id='id_spt' hidden="true" required>
              <input type="text" class="form-control" placeholder="Input Nomor Surat Perintah Tugas" id='nomor_spt' value="800/" required >
              <b>*)</b>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Masukkan Instansi Tujuan" id="surat_masuk_dari" required>
              <b>*)</b>
            </div>
          
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
              </div>
              <textarea class="form-control" placeholder="Masukkan Dasar Undangan SPT" id='dasar_undanganspt' style="height: 30mm;" required></textarea> 
              <b>*)</b>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
              </div>
              <textarea class="form-control" placeholder="Masukkan Isi dari Dasar Undangan SPT" id='untuk_undanganspt' style="height: 30mm;" required></textarea> 
              <b>*)</b>
            </div>

            <hr width="90%">

            <table border="0" cellpadding="2" cellspacing="0" width="100%">
              <tr>
                <td><label class="col-lg-7"><i class="fas fa-calendar-alt"></i> Tgl. Keberangkatan <b>*)</b></label> </td>
                <td rowspan="2" width="5"></td>
                <td><label class="col-lg-7"><i class="fas fa-calendar-alt"></i> Tgl. Kembali <b>*)</b></label> </td>
              </tr>
              <tr>
                <td>              
                  <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="tgl_berangkatspt" required>
                </td>
                <td>                
                  <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="tgl_kembalispt" required>
                </td>
              </tr>
            </table>

            <div class="input-group mb-3">
              <label class="col-lg-5"><i class="fas fa-calendar-alt"></i> Tgl. Dikeluarkan <b>*)</b></label>           
              <div class="col-lg-11">
                <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="tgl_dikeluarkan" required>  
              </div>
            </div>
            
            <hr width="90%">

            <div class="input-group mb-3">
              <label class="col-lg-5"><i class="fas fa-users"></i> Petugas yang Berangkat</label>           
              <div class="col-lg-11">
                <select class="form-control select2bs4" id="petugas_ygberangkat" multiple="multiple" onchange="proses_jmlh_petugas()" placeholder="Silahkan Pilih" required>

                </select>
              </div>
            </div>

            <hr width="90%">

            <div class="input-group mb-3">
             <label class="col-lg-5"><i class="fas fa-pencil-alt"></i> Tanda Tangan <b>*)</b></label>           
             <div class="col-lg-11">
                <select class="custom-select" id="ttd_pejabat_spt" onchange="onChange_ttd()" style="background-color: #ff000026; font-size: 14px;">
                </select>
             </div>
            </div>

            <div class="input-group mb-3" id="show_jabatan_ttd">
             <label class="col-lg-5"><i class="fas fa-pencil-alt"></i> Pilih Jabatan <b>*)</b></label>           
             <div class="col-lg-11">
                <select class="custom-select" id="ttd_pejabat_jabatan" style="background-color: #ff000026; font-size: 14px;">
                </select>
             </div>
            </div>

            <label style="background-color: #f5f409;">*) Wajib Diisi</label>

          </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
              <button type="submit" class="btn-sm btn-primary" id ="btn_ADDEDITspt" onclick="simpan_dataspt()"></button>
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
    <div class="modal fade" id="modal-deleteSPT">
      <div class="modal-dialog modal-sm">
        <div class="modal-content bg-default">        
          <div class="overlay-wrapper" id="loading_deleteSPT">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
            </div>
          </div>
          <div class="modal-body">        
            <input type="text" id="id_spt_delete" required disabled hidden="true">
            <input type="text" id="nospt_delete" required disabled hidden="true">
            <p id="textx" align="left"></p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            <button type="button" class="btn btn-sm btn-danger" id='delete_spt' onclick="delete_spt()"><i class="fa fa-trash"></i> Hapus</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>  
    </div>
<!---- END DELETE PEGAWAI --->

</div>

<!---- END DELETE PEGAWAI --->
<!---- ADD / EDIT USER ANDROID --->

<!---- END ADD / EDIT USER ANDROID --->
<script>
$('#judul_perhalaman').html('<h5 class="m-0 text-dark wadah-mengetik">Surat Perintah Perjalanan Dinas</h5>');
$('#sub_breadcrumb').html('Daftar Surat Perintah Perjalanan Dinas');
var save_method;
var table;

$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip()

    $('.select2bs4').select2({
      theme       : 'bootstrap4',
      allowClear  : true,
      language    : 'id',
      placeholder : '-Silahkan Pilih-'
    })
    
    if ( $.fn.dataTable.isDataTable( '#ajax_daftar_sppd' ) ) {
      table = $('#ajax_daftar_sppd').DataTable();
    }else{
      table = $('#ajax_daftar_sppd').DataTable({   
      //$('#ajax_listrekanan').DataTable({
          responsive: true,
          retrieve  : true,
          autoWidth : false,
          processing: true, //Feature control the processing indicator.
          serverSide: true, //Feature control DataTables' server-side processing mode.
          order     : [],   //Initial no order.

          // Load data for the table's content from an Ajax source
          ajax: {
              url: "load_module_sppd/get_ajax_daftar_sppd",
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
});

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax 
}

function show_tombol_cetak($id_sppd, $nomor_spt, $nomor_sppd){
  
  
  var $param = ''+"'"+$id_sppd+"','"+$nomor_spt+"','"+$nomor_sppd+"'"+'';

  if ((($id_sppd != 'undefined') || ($id_sppd != '')) && ($nomor_sppd != '')){
    $('#loading_sidebar_right').hide();
    $('#kump_button_lap').show();    
    $("#kump_button_lap").html('<button class="btn btn-outline-danger btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Rekap Data SPPD</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-success btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Perjalanan Dinas</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-info btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Rincian Biaya</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-primary btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Rincian Riil</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-warning btn-sm" onclick="onCall_kwitansi('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Kwitansi</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-danger btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Dokumen</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-success btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Pernyataan Menginap</button><hr class="mb-2" style="background-color:#ffffff;"/><button class="btn btn-outline-info btn-sm" onclick="onCall_sppd('+$param+')" data-widget="control-sidebar" data-slide="true"><i class="fas fa-list-alt"></i> Lap. Penyataan Tidak Menginap</button>');
  }else{
    $('#loading_sidebar_right').show();
    $('#kump_button_lap').hide();
  }
  
}


function onCall_sppd($id_sppd, $nomor_spt, $nomor_sppd){
  alert($id_sppd+" "+$nomor_spt+" "+$nomor_sppd);
  // var urut = $urut;

  // var params={};
  // params['id_spt']      = $id_spt;
  // params['nomor_spt']   = $nomor_spt;  
  // params['urut']        = $urut;
  // console.log(params);
  // var form = document.createElement("form");
  // form.setAttribute("method", "post");
  // form.setAttribute("target", "_blank");
  // if (urut == 1){
  //   form.setAttribute("action", base_url + "index.php/load_laporan/onPrint_spt");  
  // }else{
  //   alert("Gagal Mencetak !!!");
  // }  
  // var hiddenField = document.createElement("input");
  // hiddenField.setAttribute("type", "hidden");
  // hiddenField.setAttribute("name", "data");
  // hiddenField.setAttribute("value", Ext.encode(params));
  // form.appendChild(hiddenField);
  // document.body.appendChild(form);
  // form.submit();
}

// function onCall_rincianbiaya(){
//   var id_spt = $('#id_spt_sidebarright').val();
//   var nomor_spt = $('#nomor_spt_sidebarright').val();
//   alert(id_spt+" ||| "+nomor_spt);
// }


// function onCall_rincianriil(){
//   var id_spt = $('#id_spt_sidebarright').val();
//   var nomor_spt = $('#nomor_spt_sidebarright').val();
//   alert(id_spt+" ||| "+nomor_spt);
// }

/*
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

*/

function kosongi_form(){
  $('#petugas_ygberangkat').html('');
  $('#ttd_pejabat_spt').html('');
  $('#ttd_pejabat_jabatan').html('');
}

function memanggil_daftar_pegawai(data){
  
  var where = "WHERE id_nip not in (1,2) and status = 'y'";
  Ext.Ajax.request({
    url: base_url+"index.php/load_module_pegawai/get_datapegawai",
    params: {
        params : where
      },
    success: function(response) {
      var cst = Ext.decode(response.responseText);
      if (cst.result == true){            

          $('#loading_ADDeditspt').hide();
          //$('#petugas_ygberangkat').html('<option value="1">TES 1</option><option value="2">TES 2</option>');
          //$('#petugas_ygberangkat').append('<option value="">-Silahkan Pilih-</option>');
          if((data == 'undefined')||(data == '')) { // PROSES TAMBAH SPT BARU
            
            for(let i = 0; i < cst.totalrecords; i++){
              $('#petugas_ygberangkat').append('<option value="'+cst.result_data[i].nip+"##"+cst.result_data[i].nama_pegawai+"##"+cst.result_data[i].jabatan+"##"+cst.result_data[i].golongan+'">'+(i+1)+") "+cst.result_data[i].nip+" / "+cst.result_data[i].nama_pegawai+'</option>');
            }

          }else{ // PROSES EDIT SPT // PALING SULIT, RUWET, DAN AKHIRNYA BISA TAMPIL JUGA
            
            for(i = 0; i < cst.totalrecords; i++){
              $('#petugas_ygberangkat').append('<option value="'+cst.result_data[i].nip+"##"+cst.result_data[i].nama_pegawai+"##"+cst.result_data[i].jabatan+"##"+cst.result_data[i].golongan+'" >'+(i+1)+") "+cst.result_data[i].nip+" / "+cst.result_data[i].nama_pegawai+'</option>');
            }
            
            /*CARA MENGGABUNGKAN OBJECT OBJECT ARRAY PALING SUSAH*/
            var xxx = [];
            for(a = 0; a < data.length; a++){
              xxx[a]= JSON.stringify(data[a].gabungan);
            }
            var result = xxx.join();
            var result_jadikan_array = JSON.parse("[" + result + "]"); //.split() => BELUM DICOBA
            $('#petugas_ygberangkat').val(result_jadikan_array);
            
            console.log(result);
            //console.log(result_jadikan_array);
            //console.log($('#petugas_ygberangkat').val());
          }
          

      }else{
          toastr.warning(cst.pesan);
      }
    },
    failure: function(o) {
      toastr.error("Gagal Memuat Data Pegawai<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
    },  
  });
}

function memanggil_ttd_pejabat(nip){  
  var where = "WHERE status = 'y' ORDER BY urut DESC";  
  Ext.Ajax.request({
    url: base_url+"index.php/load_module_pegawai/get_data_ttd",
    params: {
        params : where
      },
    cache: false,
    success: function(response) {
      var cst = Ext.decode(response.responseText);        
      if (cst.result == true){            

        $('#loading_ADDeditspt').hide();
        $('#ttd_pejabat_spt').append('<option value="">-Silahkan Pilih-</option>');
        if((nip == 'undefined')||(nip == '')) {
          for(let i = 0; i < cst.totalrecords; i++){
            $('#ttd_pejabat_spt').append('<option value="'+cst.result_data[i].nip+'">'+(i+1)+") "+cst.result_data[i].nip+" / "+cst.result_data[i].nama+'</option>');
          }
        }else{
          for(let i = 0; i < cst.totalrecords; i++){
            $('#ttd_pejabat_spt').append('<option value="'+cst.result_data[i].nip+'" selected="selected" >'+(i+1)+") "+cst.result_data[i].nip+" / "+cst.result_data[i].nama+'</option>');
          }
          $('#ttd_pejabat_spt').val(nip);
        }

      }else{
          toastr.warning(cst.pesan);
      }
    },
    failure: function(o) {
      toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
    },
  });
}

function add_sppd(){  
    save_method = 'tambah_sppd';
    $('#form')[0].reset(); // reset form on modals
    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string
    $('#modal-ADDeditlistsppd').modal('show');
    $('#loading_ADDeditsppd').show();
    //$('#show_jabatan_ttd').hide();
    $('#btn_ADDEDITsppd').html('<i class="fas fa-save" ></i> Simpan');
    $('#btn_ADDEDITsppd').attr('disabled',false);
    //kosongi_form();
    //$('.modal-title').text('Tambah Surat Perintah Perjalanan Dinas (SPPD)');
    //var data = '';
    /*PROSES AMBIL DATA PEGAWAI YG DITUGASKAN*/
    //memanggil_daftar_pegawai(data);
    /*PROSES AMBIL DATA TANDA TANGAN*/
    //memanggil_ttd_pejabat();
}

function proses_jmlh_petugas(){
  var a = $('#petugas_ygberangkat').val();

  if (a.length == 0){
    $('#jml_petugas').val("Jumlah Petugas yang Ditugaskan (Otomatis)");  
  }else{
    $('#jml_petugas').val(a.length+" Petugas");
  }
  
}

function onChange_ttd(){
  var nip = $('#ttd_pejabat_spt').val();
  var querry = "nip = '"+nip+"' and status = 't'";
  $('#show_jabatan_ttd').hide();
  $('#ttd_pejabat_jabatan').html('');

  Ext.Ajax.request({
      url: base_url+"index.php/load_module_pegawai/get_jabatan_tandatangan",
      params: {
          params : querry
        },
      success: function(response) {
        var cst = Ext.decode(response.responseText);        
        if (cst.result == true){

            $('#show_jabatan_ttd').show();
            $('#ttd_pejabat_jabatan').append('<option value="">-Silahkan Pilih-</option>');
            for(let i = 0; i < cst.totalrecords; i++){
                $('#ttd_pejabat_jabatan').append('<option value="'+cst.result_data[i].atas_nama+'">'+(i+1)+") "+cst.result_data[i].nama_jabatan+'</option>');
            }
            toastr.warning(cst.pesan);
        }else{
            $('#show_jabatan_ttd').hide();
            $('#ttd_pejabat_jabatan').html('');
            toastr.info(cst.pesan);
        }
      },
      failure: function(o) {
        toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
      },
  });
}

function view_editspt($id_spt, $nomor_spt){
  kosongi_form();
  save_method = 'update_spt';
  $('#form')[0].reset(); // reset form on modals
  $('#modal-ADDeditlistspt').modal('show');
  $('#show_jabatan_ttd').hide();
  $('#loading_ADDeditspt').show();
  $('#btn_ADDEDITspt').html('<i class="fas fa-save" ></i> Update');
  $('#btn_ADDEDITspt').attr('disabled',false);
  
  get_dataspt($id_spt, $nomor_spt);
  /*PROSES AMBIL DATA PEGAWAI YG DITUGASKAN*/
  
  /*PROSES AMBIL DATA TANDA TANGAN*/
  
  /*PROSES AMBIL DATA LENGKAP SPT*/
}

function get_dataspt($id_spt, $nomor_spt){
  
    var id_spt    = $id_spt;
    var nomor_spt = $nomor_spt;
    $('#loading_ADDeditspt').show();

    Ext.Ajax.request({
        url: base_url+"index.php/load_module_spt/get_data_SPT",
        params: {
            id_spt    : id_spt,
            nomor_spt : nomor_spt
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          
          if (cst.result == true){
            toastr.success(cst.pesan);
            $('#loading_ADDeditspt').hide();

            $('#id_spt').val(cst._data[0].id_spt);
            $('#nomor_spt').val(cst._data[0].nomor_spt);
            $('#surat_masuk_dari').val(cst._data[0].surat_masuk_dari);
            $('#tgl_surat_masuk').val(cst._data[0].tgl_surat_masuk);
            $('#dasar_undanganspt').val(cst._data[0].dasar);
            $('#untuk_undanganspt').val(cst._data[0].untuk);            
            $('#tgl_berangkatspt').val(cst._data[0].tgl_berangkat);
            $('#tgl_kembalispt').val(cst._data[0].tgl_tiba);          
            $('#tgl_dikeluarkan').val(cst._data[0].tgl_dikeluarkan);
            $('#jml_petugas').val(cst._data[0].jml_petugas);
            var nip = cst._data[0].nip;
            memanggil_ttd_pejabat(nip);
            //$('#ttd_pejabat_spt').val(cst._data[0].nip);
            //$('#ttd_pejabat_jabatan').val(cst._data[0].atas_nama);
            var atas_nama = cst._data[0].atas_nama;            
            if (atas_nama != ''){

              var querry = "nip = '"+cst._data[0].nip+"' and status = 't'";
              Ext.Ajax.request({
                  url: base_url+"index.php/load_module_pegawai/get_jabatan_tandatangan",
                  params: {
                      params : querry
                    },
                  success: function(response) {
                    var cst = Ext.decode(response.responseText);        
                    if (cst.result == true){

                        $('#show_jabatan_ttd').show();
                        $('#ttd_pejabat_jabatan').append('<option value="">-Silahkan Pilih-</option>');
                        for(let i = 0; i < cst.totalrecords; i++){                            
                            $('#ttd_pejabat_jabatan').append('<option value="'+cst.result_data[i].atas_nama+'" selected="selected">'+(i+1)+") "+cst.result_data[i].nama_jabatan+'</option>');
                        }
                        $('#ttd_pejabat_jabatan').val(atas_nama);
                        toastr.warning(cst.pesan);
                    }else{
                        $('#show_jabatan_ttd').hide();
                        $('#ttd_pejabat_jabatan').html('');
                        toastr.info(cst.pesan);
                    }
                  },
                  failure: function(o) {
                    toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) atau Hub. Administrator !!!");
                    $('#loading_ADDeditspt').show();
                  },
              });

            }
            
            get_petugasygditugaskan($nomor_spt);
            

          }else{
            toastr.error(cst.pesan);
            $('#loading_ADDeditspt').show();
          }          
        },
        failure: function(o) {
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });  
}


function get_petugasygditugaskan($nomor_spt){
  
  var where1 = "nomor_spt = '"+$nomor_spt+"'";  
  Ext.Ajax.request({
    url: base_url+"index.php/load_module_spt/get_petugas",
    params: {
        params : where1
      },
    success: function(response) {
      var cst = Ext.decode(response.responseText);
      var data = cst.result_data;
      memanggil_daftar_pegawai(data);
    },
    failure: function(o) {
      toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
    },  
  });
}

function simpan_dataspt() {
  
  $('#btn_ADDEDITspt').attr('disabled',true);
  $('#loading_ADDeditspt').show();
  var URL;

  if(save_method == 'tambah_spt') {

    $('#btn_ADDEDITspt').html("<i class='fas fa-sync-alt fa-spin'></i> Proses Simpan Data...");
    URL = "tambah_spt";

    function params(){
      /*MENGHITUNG LAMA PELAKSANAAN*/
      var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
      var tgl_berangkatspt  = new Date($("#tgl_berangkatspt").val());
      var tgl_kembalispt    = new Date($("#tgl_kembalispt").val());
      var diffDays = Math.round(Math.round((tgl_kembalispt.getTime() - tgl_berangkatspt.getTime()) / (oneDay)));
      /*END MENGHITUNG LAMA PELAKSANAAN*/

      var petugas_ygberangkat = $('#petugas_ygberangkat').val();
      var jml_petugas         = $('#petugas_ygberangkat').val();
      var params = {
        
        nomor_spt             : $('#nomor_spt').val(),
        surat_masuk_dari      : $('#surat_masuk_dari').val(),
        tgl_surat_masuk       : $('#tgl_surat_masuk').val(),
        dasar_undanganspt     : $('#dasar_undanganspt').val(),
        untuk_undanganspt     : $('#untuk_undanganspt').val(),
        lama_pelaksanaan      : diffDays+1,
        tgl_berangkatspt      : $('#tgl_berangkatspt').val(),
        tgl_kembalispt        : $('#tgl_kembalispt').val(),
        dikeluarkan           : 'Madiun',
        tgl_dikeluarkan       : $('#tgl_dikeluarkan').val(),
        //jml_petugas           : $('#jml_petugas').val(),
        jml_petugas           : jml_petugas.length,
        nip_user              : '123456',
        ttd_pejabat_spt       : $('#ttd_pejabat_spt').val(),
        atas_nama             : $('#ttd_pejabat_jabatan').val(),
        atas_nama_bawah       : ''
      }

      params['list_petugas_yg_berangkat[]'] = petugas_ygberangkat;
      //console.log(params);
      return params
    }

  }else if(save_method == 'update_spt'){

    $('#btn_ADDEDITspt').html("<i class='fas fa-sync-alt fa-spin'></i> Proses Update Data...");
    URL = "update_spt";

    function params(){
      /*MENGHITUNG LAMA PELAKSANAAN*/
      var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
      var tgl_berangkatspt  = new Date($("#tgl_berangkatspt").val());
      var tgl_kembalispt    = new Date($("#tgl_kembalispt").val());
      var diffDays = Math.round(Math.round((tgl_kembalispt.getTime() - tgl_berangkatspt.getTime()) / (oneDay)));
      /*END MENGHITUNG LAMA PELAKSANAAN*/

      var petugas_ygberangkat = $('#petugas_ygberangkat').val();
      var jml_petugas         = $('#petugas_ygberangkat').val();
      var params = {
        id_spt                : $('#id_spt').val(),
        nomor_spt             : $('#nomor_spt').val(),
        surat_masuk_dari      : $('#surat_masuk_dari').val(),
        tgl_surat_masuk       : $('#tgl_surat_masuk').val(),
        dasar_undanganspt     : $('#dasar_undanganspt').val(),
        untuk_undanganspt     : $('#untuk_undanganspt').val(),
        lama_pelaksanaan      : diffDays+1,
        tgl_berangkatspt      : $('#tgl_berangkatspt').val(),
        tgl_kembalispt        : $('#tgl_kembalispt').val(),
        dikeluarkan           : 'Madiun',
        tgl_dikeluarkan       : $('#tgl_dikeluarkan').val(),
        //jml_petugas           : $('#jml_petugas').val(),
        jml_petugas           : jml_petugas.length,
        nip_user              : '123456',
        ttd_pejabat_spt       : $('#ttd_pejabat_spt').val(),
        atas_nama             : $('#ttd_pejabat_jabatan').val(),
        atas_nama_bawah       : ''
      }

      params['list_petugas_yg_berangkat[]'] = petugas_ygberangkat;
      //console.log(params);
      return params
    }

  }else{
    Toast.fire({
      icon: 'error',
      title: "&nbsp;&nbsp; Nothing Found !!!"
    })
  }

  Ext.Ajax.request({
      url: base_url+"index.php/load_module_spt/"+URL,
      params: params(),
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        
        if (cst.result == true){
          toastr.success(cst.pesan);
          $('#loading_ADDeditspt').hide();
          $('#modal-ADDeditlistspt').modal('hide');
          reload_table();
        }else{
          if (cst.count_data == 404){            
            Toast.fire({
              icon: 'warning',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_ADDeditspt').hide();
            if (URL == 'tambah_spt'){
              $('#btn_ADDEDITspt').html('<i class="fas fa-save" ></i> Simpan');
            }else{
              $('#btn_ADDEDITspt').html('<i class="fas fa-save" ></i> Update');
            }
            
            $('#btn_ADDEDITspt').attr('disabled',false);
          }else if (cst.count_data == 405){
            Toast.fire({
              icon: 'error',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_ADDeditspt').hide();
            if (URL == 'tambah_spt'){
              $('#btn_ADDEDITspt').html('<i class="fas fa-save" ></i> Simpan');
            }else{
              $('#btn_ADDEDITspt').html('<i class="fas fa-save" ></i> Update');
            }
            $('#btn_ADDEDITspt').attr('disabled',false);
          }else{            
            Toast.fire({
              icon: 'error',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_ADDeditspt').hide();
            $('#modal-ADDeditlistspt').modal('hide');
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
    position: 'top-right',
    showConfirmButton: false,
    timer: 12000
  }); 

}

function view_deletespt($id_spt, $nomor_spt){   
  $('#modal-deleteSPT').modal('show');  
  $('#loading_deleteSPT').hide();
  $('#id_spt_delete').val($id_spt);
  $('#nospt_delete').val($nomor_spt);
  $('#textx').html("<strong>Hapus Nomor SPT : "+$nomor_spt+" ?</strong>");
}

function delete_spt(){
  $('#loading_deleteSPT').show();
  Ext.Ajax.request({
      url: base_url+"index.php/load_module_spt/delete_spt_petugas_ygberangkat",
      params: {
          id_spt    : $('#id_spt_delete').val(),
          nomor_spt : $('#nospt_delete').val()
        },
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        
        if (cst.result == true){
          reload_table();
          toastr.success(cst.pesan);          
        }else{            
          toastr.error(cst.pesan);
        }
        
        $('#loading_deleteSPT').hide();
        $('#modal-deleteSPT').modal('hide');
      },
      failure: function(o) { 
        reload_table();
        toastr.error('Hubungi Admin !!!');
      },  
  });  
}

</script>