<div class="container-fluid">
  <div class="row">
      <div class="modal-body">
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-success card-outline">
            
              <div class="overlay-wrapper" id="loading_utama">
                <div class="overlay light">
                  <img src="<?php echo base_url(); ?>public/tes2.svg" width="80px" height="80px"/>
                </div>
              </div>

              <div class="overlay-wrapper" id="hasil_kode">
                <div class="overlay dark">
                  
                  <form method="POST" enctype="multipart/form-data" id="upload_bukti">
                    <table border="0" cellpadding="1" cellspacing="0" style="border:solid; background-color: #0000002b;">
                      <tr>
                        <td rowspan="2" style="background-color: #0089ff94; font-size:70px; border:solid; ">
                          <label id="result_codex" style="color:#ffffff;"></label>
                          <input type="text" id="result_code" name="result_code" hidden="true">
                        </td>
                        <td style="vertical-align:top;" width="30" align="center">
                          <img src="<?php echo base_url(); ?>public/css/img/silang.png" height="20px" width="20px" onclick="tutup()" title="Tutup" style="cursor: pointer;"/>
                        </td>
                      </tr>
                      <tr>
                        <td style="vertical-align:bottom; border-bottom:solid; " align="center">
                          <i class="fa fa-copy" title="Copy Kode Surat" onclick="copy_code()" style="font-size:20px; cursor: pointer; color:#ffffff;"></i>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <div class="wrapper">
                          <table width="100%" border="0" cellpadding="1" cellspacing="0" style="border:double; background-color: #f3f1001a;">
                            <tr>                            
                              <td rowspan="2" >
                                <div class="form-group">
                                  <label style="color:#ffffff; font-size: 12px;">Upload Bukti (*Maks. 1 Mb / 1000 Kb)</label>
                                  <div class="input-group">
                                    <div class="custom-file">                                    
                                      <input type="file" class="custom-file-input" name="file" accept=".pdf,.gif,.jpg,.jpeg,.png,.doc,.docx,.xls" id="file_nya"> <!-- accept=".pdf" -->
                                      <label class="custom-file-label" id="file_nya_label">Pilih File Upload Bukti</label>
                                    </div>                            
                                  </div>                          
                                </div>
                              </td>
                              <td align="center">
                                <button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-save"></i> Simpan Bukti</button>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" width="20%">                              
                                <label class="btn btn-warning btn-sm" onclick="tutup()"><i class="fa fa-share"></i> Nanti</label>
                            </tr>
                          </table>
                            <div id = "loading_upload" class="overlay" style="height: 100%; width: 100%; position: absolute; bottom: 0; left: 0; background: rgba(0,0,0,.5);">
                              <img src="<?php echo base_url(); ?>public/Cube-0.8s-184px.svg" width="35px" height="35px"/>
                            </div>
                          </div>
                        </td>                      
                      </tr>
                    </table>
                  </form>
                </div>
              </div>

              <form action="#" id="form" class="form-horizontal">
                <div class="modal-body">          

                  <table border="0" cellpadding="2" cellspacing="0" width="100%">
                    <tr>
                      <td width="17%"><h6><i class="fas fa-calendar-alt"></i> Tgl. Surat Keluar *)</h6> </td>
                      <td>              
                        <input type="date" class="form-control cursor_tangan" value="<?php echo date('Y-m-d') ?>" id="tgl_surat_kluar" required style="width: 50mm; font-size:18px;" >
                      </td>
                    </tr>
                    <tr>                      
                      <td><h6><i class="fas fa-pencil-alt"></i> Pilih Bidang</h6></td>
                      <td>                
                        <div class="input-group" style="width: 90mm;">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-pencil-alt"></i></span>
                          </div>                
                          <select class="custom-select" id="vbidang" onchange="get_jenissurat()" ></select>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <table border="0" cellpadding="2" cellspacing="0" width="100%" >
                    <tr>                      
                      <td width="17%"><h6><i class="fas fa-pencil-alt"></i> Kode Jenis Surat</h6> </td>
                      <td>                
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-tag"></i></span>
                          </div>                
                          <select class="custom-select" id="vcode_jenissurat" onchange="get_jenissurat_sub()"></select>
                          <div class="input-group-prepend" style="margin-left:10px;">
                            <span class="input-group-text"><i class="fa fa-tags"></i></span>
                          </div>                
                          <select class="custom-select" id="vcode_jenissurat_sub"></select>
                        </div>                        
                      </td>
                      
                    </tr>                    
                  </table>
                  <table border="0" cellpadding="2" cellspacing="0" width="100%" >
                    <tr>
                      <td>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-pencil-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" id="perihal" placeholder="Perihal">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-pencil-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" id="ins_tujuan" placeholder="Instansi Tujuan">
                        </div>
                      </td>
                    </tr>                    
                  </table>

                </div> <!-- end modal-body -->
                <div class="card-footer p-2" style="text-align:center;">
                  <button type="button" class="btn btn-success" onclick="create_code()"><i class="fa fa-code"></i> Buat Kode Surat</button>
                  <button type="button" class="btn btn-danger" onclick="kosongi_code()"><i class="fa fa-times"></i> Batal</button>
                </div>
              </form>              
              
            </div>
            <!-- /.widget-user -->
          </div>
        </div>
  </div>
</div><!--/. container-fluid -->


<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});

var date           = new Date();
var day            = date.getDate();
var month          = date.getMonth() + 1;
var year           = date.getFullYear();
if(day < 10){
  day  = '0' + day;
}

if(month < 10){
  month = '0' + month;
}

var minDate = year +'-'+month+'-'+day;
document.getElementById('tgl_surat_kluar').setAttribute("max", minDate);

$('#loading_utama').hide();
$('#loading_upload').hide();
$('#hasil_kode').hide();
//$('#hasil_kode').show();
$('#vcode_jenissurat_sub').hide();

//$('#result_codex').html("123/12345/303/2021");
//$('#result_code').val("123/12345/303/2021");
get_bidang();

function kosongi_jenissurat(){
  $('#vcode_jenissurat').html('');
  $('#vcode_jenissurat_sub').html('');
  $('#perihal').val('');
  $('#ins_tujuan').val('');
  get_bidang();
}

function kosongi_code(){
   $('#form')[0].reset();
}

function get_bidang(){
  $('#vbidang').html('');
  var where = "WHERE status = '1' ORDER BY code_bidang ASC";  
  Ext.Ajax.request({
    url: base_url+"index.php/load_module/get_bidang",
    params: {
        params : where
      },
    cache: false,
    success: function(response) {
      var cst = Ext.decode(response.responseText);        
      if (cst.result == true){

        $('#vbidang').append('<option value="">-Pilih Bidang-</option>');
        $('#vcode_jenissurat').append('<option value="">-Pilih Kode Jenis Surat-</option>');
        for(let i = 0; i < cst.totalrecords; i++){
          $('#vbidang').append('<option value="'+cst._data[i].code_bidang+'">'+(i+1)+". "+cst._data[i].name+'</option>');
        }        
      }else{
        
        toastr.error(cst.pesan);
      }
    },
    failure: function(o) {
      toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
    },
  });
}

function get_jenissurat(){
  $('#vcode_jenissurat').html('');
  var where = "WHERE status = '1' ORDER BY code_jenissurat ASC";  
  Ext.Ajax.request({
    url: base_url+"index.php/load_module/get_jenissurat",
    params: {
        params : where
      },
    cache: false,
    success: function(response) {
      var cst = Ext.decode(response.responseText);        
      if (cst.result == true){
        $('#vcode_jenissurat').append('<option value="">-Pilih Kode Jenis Surat-</option>');
        for(let i = 0; i < cst.totalrecords; i++){
          $('#vcode_jenissurat').append('<option value="'+cst._data[i].code_jenissurat+'">'+cst._data[i].code_jenissurat+". "+cst._data[i].name_surat+'</option>');
        }        
      }else{
        $('#vcode_jenissurat_sub').hide();
        toastr.error(cst.pesan);
      }
    },
    failure: function(o) {
      toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
    },
  });
}

function get_jenissurat_sub(){  
  $('#vcode_jenissurat_sub').html('');
  var getcode = $('#vcode_jenissurat').val();  
  var where = "WHERE code_jenissurat = '"+getcode+"' ORDER BY code_jenissurat ASC";  
    
  Ext.Ajax.request({
      url: base_url+"index.php/load_module/get_jenissurat_sub",
      params: {
          params : where
        },
      cache: false,
      success: function(response) {
        var cst = Ext.decode(response.responseText);        
        if (cst.result == true){

            $('#vcode_jenissurat_sub').show();
            $('#vcode_jenissurat_sub').append('<option value="">----</option>');
            for(let i = 0; i < cst.totalrecords; i++){
                 $('#vcode_jenissurat_sub').append('<option value="'+cst._data[i].code_surat_sub+'">'+cst._data[i].code_surat_sub+". "+cst._data[i].name_surat_sub+'</option>');
            }

        }else{
            $('#vcode_jenissurat_sub').hide();
            $('#vcode_jenissurat_sub').append('<option value="-"></option>');
            //toastr.error(cst.pesan);
        }
      },
      failure: function(o) {
        toastr.error("Gagal Memuat Data<br><i class='fas fa-sync-alt fa-spin'></i> Refresh Ulang (F5) !!!");
      },
  });
}

function tutup(){
  $('#hasil_kode').hide();

}

function copy_code(){

  var copyText = document.getElementById("result_code");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */
  
  //navigator.clipboard.writeText(copyText.value);  
  document.execCommand("copy");
  toastr.info("Copy Kode Surat Keluar : "+copyText.value);
}

function create_code() {
  $('#loading_utama').show();
  var tgl_surat     = $('#tgl_surat_kluar').val();
  var code_bid      = $('#vbidang').val();
  var code_jnis     = $('#vcode_jenissurat').val();
  var code_jnis_sub = $('#vcode_jenissurat_sub').val();  
  var perihal       = $('#perihal').val();
  var tujuan        = $('#ins_tujuan').val();  
  var fileupload    = $('#fileupload').val();

  //console.log(fileupload);
  // if (code_bid == ''){
  //   toastr.error("Bidang belum dipilih !!!");
  // }else if ((code_jnis == '')&&(code_jnis_sub == '')){
  //   toastr.error("Jenis surat belum dipilih !!!");
  // }else{

  Ext.Ajax.request({
      url: base_url+"index.php/load_module/create_code",
      params: {
          tgl_out       : tgl_surat,
          code_bidang   : code_bid,
          code_jnis     : code_jnis,
          code_jnis_sub : code_jnis_sub,
          perihal       : perihal,
          tujuan        : tujuan
        },
      cache: false,
      success: function(response) {
        var cst = Ext.decode(response.responseText);
        if (cst.result == true){
            toastr.success(cst.pesan);
            $('#loading_utama').hide();
            $('#hasil_kode').show();
            $('#result_codex').html(cst.codenya);
            $('#result_code').val(cst.codenya);
            kosongi_jenissurat();
        }else{
          if (cst.count_data = '505'){
            $('#loading_utama').hide();
            toastr.error(cst.pesan);
            kosongi_jenissurat();          
          }else{
            $('#loading_utama').hide();
            toastr.error(cst.pesan);
            kosongi_jenissurat();
          }
   
        }
      },
      failure: function(o) {
        toastr.error("Script Bermasalah, Hub. Admin !!!");
      },
  });
// }
}

function simpan_upload() {
  //$('#loading_utama').show();
  var nomor_surat_kluar = $('#result_code').val();  
  //const name_image       = document.getElementById("profile_pic").files[0].name;
  const name_image      = $('#profile_pic').prop('files')[0];
  //const name_image      = $('#profile_pic').prop('files')[0].name;
  const type_image      = $('#profile_pic').prop('files')[0].type;
  console.log(name_image, type_image);  
  let formData = new FormData();
  formData.append('file', name_image);
  formData.append('nomor_surat_kluar', nomor_surat_kluar);

  // Ext.Ajax.request({
  //   url: base_url+"index.php/upload_controller/upload2",
  //   params: new FormData(this),      
  //   /*params: {
  //     nomor_surat_kluar : nomor_surat_kluar,
  //     profile_pic : name_image,
  //     type : type_image
  //   },*/
  //   cache: false,
  //   success: function(response) {
  //     var cst = Ext.decode(response.responseText);
  //     if (cst.result == true){
  //         toastr.success(cst.pesan);
  //         $('#loading_utama').hide();
  //         $('#hasil_kode').show();
  //         $('#result_codex').html(cst.codenya);
  //         $('#result_code').val(cst.codenya);
  //         kosongi_jenissurat();
  //     }else{
  //       if (cst.count_data = '505'){
  //         $('#loading_utama').hide();
  //         toastr.error(cst.pesan);
  //         kosongi_jenissurat();          
  //       }else{
  //         $('#loading_utama').hide();
  //         toastr.error(cst.pesan);
  //         kosongi_jenissurat();
  //       }
 
  //     }
  //     toastr.error(cst.pesan);
  //   },
  //   failure: function(o) {
  //     toastr.error("Script Bermasalah, Hub. Admin !!!");
  //   },
  // });  
}

//function upload_bukti(){
  
$('#upload_bukti').submit(function(e){
  e.preventDefault();
  $('#loading_upload').show();

  var file_nya = $('#file_nya').val();
  if (file_nya != ''){
    var file_x = $('#file_nya').prop('files')[0];
    //var file_x1 = $('#file_nya').prop('images')[0];
    //console.log(file_x.images);
    if (file_x.size >= '5363801'){       
      Toast.fire({
        icon: 'warning',
        title: '&nbsp Ukuran File Melebihi Batas Maks. Upload<br>&nbsp Max. Ukuran File Upload 1 Mb / 1024 Kb'
      })
      $('#loading_upload').hide();
      $('#file_nya').val('');
      $('#file_nya_label').html('Pilih File Upload Bukti');
    }else{        
      $.ajax({
        url         : base_url+"index.php/upload_controller/upload_file",
        type        : "post",
        data        : new FormData(this),
        processData : false,
        contentType : false,
        cache       : false,
        async       : false,
          success: function(data){
            var cst = JSON.parse(data); 
            
            if (cst.result == true){
              //toastr.info(cst.pesan);
              Toast.fire({
                icon: 'success',
                title: '&nbsp'+cst.pesan
              })
              $('#loading_upload').hide();
              $('#hasil_kode').hide();
              $('#upload_bukti')[0].reset();
            }else{              
              Toast.fire({
                icon: 'error',
                title: '&nbsp'+cst.pesan
              })
              $('#loading_upload').hide();              
              $('#file_nya').val('');
              $('#file_nya_label').html('Pilih File Upload Bukti');

            }
            //location.reload();            
          }.bind(this),
          error: function (xhr, status, err) {
              toastr.error("Script Bermasalah, Hub. Admin !!!<br>Refresh");
              //$('#loading_upload').hide();
          }.bind(this)
      });
    }
  }else{
    Toast.fire({
      icon: 'error',
      title: '&nbsp Anda Belum Memilih File Untuk Upload.'
    })
    $('#loading_upload').hide();
  }  
});
    

/*
  $('#upload_bukti').submit(function(e){
    e.preventDefault();
    Ext.Ajax.request({
      url: base_url + "index.php/upload_controller/do_upload",
      params: new FormData(this),    
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(response) {
        var cst = Ext.decode(response.responseText);      
        toastr.info(cst.pesan);
      },
      failure: function(o) {
        toastr.error("Script Bermasalah, Hub. Admin !!!");
      },
    });
  }); 
*/
//}
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 10000
}); 

/*
var xhr = new XMLHttpRequest();
xhr.open('GET', '/2021_ekorsuk', true);
// If specified, responseType must be empty string or "text"
xhr.responseType = 'text';
xhr.onload = function () {
    if (xhr.readyState === xhr.DONE) {
        if (xhr.status === 200) {
            console.log(xhr.response);
            console.log(xhr.responseText);
        }
    }
};
xhr.send(null);
*/

</script>