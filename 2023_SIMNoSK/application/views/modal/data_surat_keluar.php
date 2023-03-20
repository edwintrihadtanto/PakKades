<div class="card card-navy card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      Riwayat Kode Surat Keluar
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="window.location.reload(true)()" title="Tambah" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus-circle" style="color: #ff0000;"></i></button>      

      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh" data-toggle="tooltip" data-placement="top"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div>
  
  <div class="card-body">
      <table id="ajax_data_surat_keluar" class="table table-bordered table-striped" style="font-size: 12px;">
        <thead>
          <tr class="navbar-navy">
              <!-- <th width="5" align="center">No.</th> -->
              <th width="10">#</th>
              <th width="120">Kode Surat Keluar</th>
              <th>Nomor Surat Keluar</th>
              <th width="90">Tgl. Permintaan</th>
              <th width="100">Status Upload</th>
              <th width="150">Act</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>      
  </div>

<!---- ADD / EDIT PEGAWAI --->
    <div class="modal fade" id="modal-bidang">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header navbar-navy">
            <h6 class="modal-title" style="color: #ffffff;"><i class="fa fa-pencil-alt"></i> Tambah Bidang</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="overlay-wrapper" id="loading_bidang">
            <div class="overlay dark">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
            </div>
          </div>
      
          <form action="#" id="form" class="form-horizontal">
          <div class="modal-body">          

            <table border="0" cellpadding="2" cellspacing="0" width="100%">
              <tr>
                <td width="70px"><label><i class="fas fa-calendar-alt"></i> Code<b>*)</b></label> </td>
                <td>
                  <input type="text" class="form-control" value="" id="code_bidang" required style="width: 50mm;">
                </td>
              </tr>              
            </table>

            <hr width="90%">

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
              </div>              
              <input type="text" class="form-control" placeholder="Nama" id='nama_bidang' value="" required >
              <b>*)</b>
            </div>

            <hr width="90%">

            <table border="0" cellpadding="2" cellspacing="0" width="100%">
              <tr>
                <td width="90px"><label><i class="fas fa-pencil-alt"></i> Status<b>*)</b></label> </td>
                <td>
                  <select class="custom-select" style="width: 50mm;">
                    <option value="0">Belum Aktif</option>
                    <option value="1">Aktif</option>                    
                  </select>
                </td>
              </tr>              
            </table>

            <label style="background-color: #f5f409;">*) Wajib Diisi</label>

          </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times" ></i> Batal</button>
              <button type="submit" class="btn-sm btn-primary" id ="btn_simpanedit_bidang" onclick="simpan_databidang()"></button>

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
    <div class="modal fade" id="modal_hapusbidang">
      <div class="modal-dialog modal-sm">
        <div class="modal-content bg-default">        
          <div class="overlay-wrapper" id="loading_hapusbidang">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
            </div>
          </div>
          <div class="modal-body">        
            <input type="text" id="code_bidangdel" required disabled hidden="true">
            <input type="text" id="name_bidangdel" required disabled hidden="true">
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
$('#judul_perhalaman').html('<h5 class="m-0 text-dark wadah-mengetik">Informasi Riwayat Kode Surat Keluar</h5>');
$('#sub_breadcrumb').html('Riwayat Kode Surat Keluar');
var save_method;
var table;

$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip()

    if ( $.fn.dataTable.isDataTable( '#ajax_data_surat_keluar' ) ) {
      table = $('#ajax_data_surat_keluar').DataTable();
    }else{
      table = $('#ajax_data_surat_keluar').DataTable({         
          responsive: true,
          retrieve  : true,
          autoWidth : false,
          processing: true, //Feature control the processing indicator.
          serverSide: true, //Feature control DataTables' server-side processing mode.
          order     : [],   //Initial no order.

          // Load data for the table's content from an Ajax source
          ajax: {
              url: "load_module_riwayatkode/get_ajax_data_surat_keluar",
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


function add_bidang(){  
    save_method = 'tambah_bidang';
    $('#form')[0].reset(); // reset form on modals
    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string
    $('#modal-bidang').modal('show');
    $('#loading_bidang').hide();    
    $('#btn_simpanedit_bidang').html('<i class="fas fa-save" ></i> Simpan');
    $('#btn_simpanedit_bidang').attr('disabled',false);    
}

function proses_jmlh_petugas(){
  var a = $('#petugas_ygberangkat').val();

  if (a.length == 0){
    $('#jml_petugas').val("Jumlah Petugas yang Ditugaskan (Otomatis)");  
  }else{
    $('#jml_petugas').val(a.length+" Petugas");
  }
  
}


function view_editspt($id_spt, $nomor_spt){
  kosongi_form();
  save_method = 'update_spt';
  $('#form')[0].reset(); // reset form on modals
  $('#modal-bidang').modal('show');
  $('#show_jabatan_ttd').hide();
  $('#loading_bidang').show();
  $('#btn_simpanedit_bidang').html('<i class="fas fa-save" ></i> Update');

  $('#btn_simpanedit_bidang').attr('disabled',false);

  
  get_dataspt($id_spt, $nomor_spt);
  /*PROSES AMBIL DATA PEGAWAI YG DITUGASKAN*/
  
  /*PROSES AMBIL DATA TANDA TANGAN*/
  
  /*PROSES AMBIL DATA LENGKAP SPT*/
}

function get_dataspt($id_spt, $nomor_spt){
  
    var id_spt    = $id_spt;
    var nomor_spt = $nomor_spt;
    $('#loading_bidang').show();

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
            $('#loading_bidang').hide();

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
                    $('#loading_bidang').show();
                  },
              });

            }
            
            get_petugasygditugaskan($nomor_spt);
            

          }else{
            toastr.error(cst.pesan);
            $('#loading_bidang').show();
          }          
        },
        failure: function(o) {
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });  
}

function simpan_dataspt() {
  
  $('#btn_simpanedit_bidang').attr('disabled',true);

  $('#loading_bidang').show();
  var URL;

  if(save_method == 'tambah_spt') {

    $('#btn_simpanedit_bidang').html("<i class='fas fa-sync-alt fa-spin'></i> Proses Simpan Data...");

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

    $('#btn_simpanedit_bidang').html("<i class='fas fa-sync-alt fa-spin'></i> Proses Update Data...");

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
          $('#loading_bidang').hide();
          $('#modal-bidang').modal('hide');
          reload_table();
        }else{
          if (cst.count_data == 404){            
            Toast.fire({
              icon: 'warning',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_bidang').hide();
            if (URL == 'tambah_spt'){
              $('#btn_simpanedit_bidang').html('<i class="fas fa-save" ></i> Simpan');

            }else{
              $('#btn_simpanedit_bidang').html('<i class="fas fa-save" ></i> Update');

            }
            
            $('#btn_simpanedit_bidang').attr('disabled',false);

          }else if (cst.count_data == 405){
            Toast.fire({
              icon: 'error',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_bidang').hide();
            if (URL == 'tambah_spt'){
              $('#btn_simpanedit_bidang').html('<i class="fas fa-save" ></i> Simpan');

            }else{
              $('#btn_simpanedit_bidang').html('<i class="fas fa-save" ></i> Update');

            }
            $('#btn_simpanedit_bidang').attr('disabled',false);

          }else{            
            Toast.fire({
              icon: 'error',
              title: "&nbsp;&nbsp;"+cst.pesan
            })
            $('#loading_bidang').hide();
            $('#modal-bidang').modal('hide');
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
  $('#modal_hapusbidang').modal('show');  
  $('#loading_hapusbidang').hide();
  $('#id_spt_delete').val($id_spt);
  $('#nospt_delete').val($nomor_spt);
  $('#textx').html("<strong>Hapus Nomor SPT : "+$nomor_spt+" ?</strong>");
}

function delete_spt(){
  $('#loading_hapusbidang').show();
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
        
        $('#loading_hapusbidang').hide();
        $('#modal_hapusbidang').modal('hide');
      },
      failure: function(o) { 
        reload_table();
        toastr.error('Hubungi Admin !!!');
      },  
  });  
}

</script>