<div class="card card-danger card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      List Verifikasi Berkas Tahap Lanjut
    </h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool"  id="centang_dokumenx" onclick="centang_dokumen()" title="Verifikasi Berkas Cek"><i class="fas fa-check"></i></button>
      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Hide"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
    </div>
  </div>
  <div class="card-body">      
      <table id="ajax_verifikasitahap2" class="table table-bordered table-striped">
        <thead>
          <tr class="navbar-success" style="font-size: 11px;color:#ffffff;" >
              <th width="5" align="center">No.</th>
              <th width="140">No. Kwitansi</th>
              <th>Nama Perusahaan / Rekanan</th>
              <th width="100">Nominal Kwitansi</th>
              <th width="85">Tgl. Penyerahan</th>
              <th width="130">Keterangan</th>
              <th width="75">Status</th>
              <th width="50"><input type="checkbox" class="check_all" hidden="true" />Proses</th>
          </tr>
        </thead>
        <tbody style="font-size: 13.5px;" class="check">
        </tbody>
      </table>
      <div class="garis_verikalmelayang1" id="garis_verikal"></div>
      <div class="garis_verikalmelayang2" id="garis_verikal2"></div>
      <div class="garis_verikalmelayang1_1" id="garis_verikal1_1"></div>
      <div class="garis_verikalmelayang2_1" id="garis_verikal2_1"></div>
      <!-- 
      <a href="#" class="btn btn-primary img-circle elevation-3 melayang2" id="kembalikan" onclick="kembalikan_kestep1()" title="Back to First Verification">
        <i class="fa fa-arrow-left"></i>
      </a>    -->
      <a href="#" class="btn btn-danger elevation-3 melayang2" id="hapus_verifikasi" onclick="hapus_verifikasi()" title="Hapus Verifikasi Berkas" style="width: 100px;">
        <i class="fas fa-check"></i>
        <i class="fas fa-trash"></i>
      </a>
      <a href="#" class="btn btn-success elevation-3 melayang" id="centang_dokumen" onclick="centang_dokumen()" title="Verifikasi Berkas Cek" style="width: 100px;">
        <i class="fas fa-check"></i>
      </a>
    <!-- </form> -->
  </div>
  <!-- /.card -->
</div>
<div class="modal fade" id="modal-viewcentangan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-check"></i> Proses Cek Verifikasi Berkas Tahap Lanjut</h4>
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
            <table>
              <tr>
                <td><i class="fa fa-pencil-alt"></i><b> No. In :</td>
                <td><i class="fa fa-pencil-alt"></i><b> No. Kwitansi :</td>                
                <td></td>
              </tr>
              <tr>
                <td><b><input type="text" id="no_in" disabled/></td>
                <td><b><input type="text" id="nokwitansi" disabled /></td>                
                <td><b><input type="text" id="idform" hidden="true" /></td>
                  <td><b><input type="text" id="jns_lap_drload" hidden="true"/></td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm" id="batallap" onclick="hapuslap()" ><i class="fa fa-trash"></i> Hapus Verifikasi</button>
                  <button type="button" class="btn btn-success btn-sm" id="centanganall" onclick="simpan_finish()"><i class="fa fa-check"></i> Verifikasi Selesai</button>
                  </td>
              </tr>
            </table>
        </div>
        <div class="form-group">
           <label class="col-lg-4"><i class="fa fa-arrow-down"></i> Jenis Laporan :</label>
           <div class="col-lg-12">
              <select class="custom-select" id="jns_laporan">
                <option value="">Pilih Jenis Laporan</option>
                <?php foreach($jns_lap as $getjenis):?> 
                <option value="<?php echo $getjenis->id; ?>"><?php echo $getjenis->nama_laporan; ?></option>
                <?php endforeach;?>
              </select>    
           </div>
        </div>
        
        <div id="view_laporanx"></div>
<!--
        <table cellspacing='0' border='0' style='margin-left:10mm;'>   
            <tr>
                <td width='5mm' align='left' height='15mm'></td>
                <td width='20mm'><input type="checkbox" class="datasemua" /></td>
                <td align='left'><b>Centang Semua</td>
                <td width='200mm'><b>Keterangan</td>
            </tr>             
            <tr>
                <td width='5mm' align='left' height='15mm'><b>1.</td>
                <td width='20mm'><input type="checkbox" class="data1" /></td>
                <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP )</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>             
            <tr>
                <td width='5mm' align='left' height='7mm'><b>2.</td>
                <td><input type="checkbox" class="data2" /></td>
                <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
            <tr>
                <td width='5mm' align='left' height='7mm'><b>3.</td>
                <td><input type="checkbox" class="data3" /></td>
                <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>                
            <tr>
                <td width='5mm' align='left' height='7mm'><b>4.</td>
                <td><input type="checkbox" class="data4" /></td>
                <td align='left'>BA Hasil Pemeriksaan</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
            <tr>
                <td width='5mm' align='left' height='7mm'><b>5.</td>
                <td><input type="checkbox" class="data5" /></td>
                <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
            <tr>
                <td width='5mm' align='left' height='7mm'><b>6.</td>
                <td><input type="checkbox" class="data6" /></td>
                <td align='left'>BA Penyerahan Barang / Jasa</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>

            <tr>
                <td width='5mm' align='left' height='7mm'><b>7.</td>
                <td><input type="checkbox" class="data7" /></td>
                <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
            <tr>
                <td width='5mm' align='left' height='7mm'><b>8.</td>
                <td><input type="checkbox" class="data8" /></td>
                <td align='left'>Faktur Pajak</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
            <tr>
                <td width='5mm' align='left' height='7mm'><b>9.</td>
                <td><input type="checkbox" class="data9" /></td>
                <td align='left'>Perincian Perhitungan Pajak</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>                
            <tr>
                <td width='5mm' align='left' height='7mm'><b>10.</td>
                <td><input type="checkbox" class="data10" /></td>
                <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
            <tr>
                <td width='5mm' align='left' height='7mm'><b>11.</td>
                <td><input type="checkbox" class="data11" /></td>
                <td align='left'>Surat Keterangan Pembayaran DENDA</td>
                <td><input type="text" name="keterangan" placeholder="Keterangan..."></td>
            </tr>
        </table>
        <table cellspacing='0' border='0' style='margin-top:5mm;'>   
          <tr>
            <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
          </tr>    
        </table>
-->  
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Keluar</button>        
        <button type="button" class="btn btn-primary btn-sm" id="datablmselesai" onclick="simpan_baru()"><i class="fa fa-save"></i> Simpan Perubahan</button>
        
      </div>
    </div>
  </div>
</div>
<script>
hide_icon();
load_tabel();
load_checkbox();

var table;
function load_tabel(){

  if ( $.fn.dataTable.isDataTable( '#ajax_verifikasitahap2' ) ) {
    table = $('#ajax_verifikasitahap2').DataTable();
  }else{
    table = $('#ajax_verifikasitahap2').DataTable({         
        responsive: true,
        retrieve  : true,
        autoWidth : false,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order     : [],   //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "load_module/get_extlist_rverifikasi_tahapdua",
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
  // $("input").change(function(){
  //     $(this).parent().parent().removeClass('has-error');
  //     $(this).next().empty();
  // });
  // $("textarea").change(function(){
  //     $(this).parent().parent().removeClass('has-error');
  //     $(this).next().empty();
  // });
  // $("select").change(function(){
  //     $(this).parent().parent().removeClass('has-error');
  //     $(this).next().empty();
  // });
}

function load_checkbox(){
  $('.check_all').click(function() {
      $('.cek_verif_awal').prop('checked', this.checked);
      var id_form = [];
      $('.cek_verif_awal').each(function(){  
        if($(this).is(":checked"))  
        {  
          id_form.push($(this).val());              
        }  
      });
      id_form = new Array(id_form.toString());
      //console.log(id_form);        

      if (id_form != ''){
        show_icon();
      }else{
        hide_icon();
      }    
  });
}

function ceklist_dokumen_semua(){
  
  var n = 0;
  $('.ceklist_lap1_all').click(function() {
      var id = [];
      $('.ceklist_lap1_1').prop('checked', this.checked);      
      $('.ceklist_lap1_2').prop('checked', this.checked);      
      $('.ceklist_lap1_3').prop('checked', this.checked);
      $('.ceklist_lap1_4').prop('checked', this.checked);
      $('.ceklist_lap1_5').prop('checked', this.checked);
      $('.ceklist_lap1_6').prop('checked', this.checked);
      $('.ceklist_lap1_7').prop('checked', this.checked);
      $('.ceklist_lap1_8').prop('checked', this.checked);
      $('.ceklist_lap1_9').prop('checked', this.checked);
      $('.ceklist_lap1_10').prop('checked', this.checked);
      $('.ceklist_lap1_11').prop('checked', this.checked);
      $('.ceklist_lap1_12').prop('checked', this.checked);
      $('.ceklist_lap1_13').prop('checked', this.checked);

      $('.ceklist_lap1_1').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_2').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_3').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_4').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_5').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_6').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_7').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_8').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_9').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_10').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_11').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_12').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });
      $('.ceklist_lap1_13').each(function(){  
        if($(this).is(":checked"))  
        {  
          id.push($(this).val());
        }  
      });

      disable_serentak_keterangan_laporan1();
      n = id.length;
      // if (n == '11'){
      //   $('#datablmselesai').hide();
      //   $('#centanganall').show();
      // }else{
      //   $('#datablmselesai').show();
      //   $('#centanganall').hide();
      // }  
  });  
  
 
}

function cek_check($id_form){

  $('.cek_verif_awal').click(function(){  
    var id_form = [];
    $('.cek_verif_awal').each(function(){  
        if($(this).is(":checked"))  
        {  
          id_form.push($(this).val());
        }  
    });  
    id_form = new Array(id_form.toString());
    //console.log(id_form); 
    if (id_form != ''){
      show_icon();
    }else{
      hide_icon();
    }
     
  });    
}

function centang_dokumen(){
  // $('#kelengkapan_complete').click(function(){  
  var total=0;
  var id_form = [];  
  $('.cek_verif_awal').each(function(){
      if($(this).is(":checked"))
      {
           id_form.push($(this).val());
      }
  });
  total = id_form.length;
  //alert(id_form);

  if (id_form != ''){
    if (total == 1){

      $('#modal-viewcentangan').modal('show');
      $('#loading_viewverifdua').hide();
      //$('#jns_laporan').val('1');

      Ext.Ajax.request({
        url: base_url+"index.php/load_module/cek_proses_verifikasi",
        params:{
          id_form : id_form
        },
        success: function(response) {
          var cst = Ext.decode(response.responseText);
          
          if (cst.count == 1){ //berarti memiliki data no_in terdaftar
            var jns_laporan = cst.ListDataObj[0].jns_laporan;
            var no_in       = cst.noin;
            var nokwitansi  = cst.nokwitansi;
            var idform      = cst.idform;
            var jmlcek      = cst.count_det[0].jmlh_noin;
            
            $('#loading_viewverifdua').hide();
            $('#jns_laporan').val(jns_laporan);
            if (jns_laporan == 1){
              if (jmlcek == 12){
                $('#centanganall').show();
                $('#datablmselesai').show();
                $('#batallap').show();
              }else{
                $('#datablmselesai').show();
                $('#centanganall').hide();
                $('#batallap').show();
              }
            }else if (jns_laporan == 2) {
              if (jmlcek == 11){
                $('#centanganall').show();
                $('#datablmselesai').show();
                $('#batallap').show();
              }else{
                $('#datablmselesai').show();
                $('#centanganall').hide();
                $('#batallap').show();
              }
            }else if (jns_laporan == 3){
              if (jmlcek == 13){
                $('#centanganall').show();
                $('#datablmselesai').show();
                $('#batallap').show();
              }else{
                $('#datablmselesai').show();
                $('#centanganall').hide();
                $('#batallap').show();
              }
            }
            jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform);
          }else{
            var jns_laporan = '0';
            var no_in       = '0';
            var nokwitansi  = cst.nokwitansi;
            var idform      = cst.idform;
            var jmlcek      = cst.count_det[0].jmlh_noin;
            $('#jns_laporan').val('');
            if (jmlcek == 0){              
              $('#datablmselesai').show();
              $('#centanganall').hide();
              $('#batallap').hide();
            }else{
              $('#batallap').hide();  
            }
            
            $('#loading_viewverifdua').hide(); 
            jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform);
            //jns_laporan_onchange_kosong();
          }
        },
        failure: function(o){              
          toastr.error("Hubungi Admin");
        },  
      });      
      
    }else{
      hide_icon();
      toastr.error("Silahkan pilih salah satu untuk proses selanjutnya !!!");
    }

  }else{
    hide_icon();
    toastr.error("Belum ada yang dipilih !!!");
  }
}
function jns_laporan_onchange(no_in, nokwitansi, jns_laporan, idform){
  
  $('#nokwitansi').val(nokwitansi);
  $('#no_in').val(no_in);
  $('#idform').val(idform);
  $('#jns_lap_drload').val(jns_laporan);

  $('#loading_viewverifdua').show();

  Ext.Ajax.request({
    url: base_url+"index.php/load_module/getlaporan_jenislaporan",
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
        //reload_table();             
        ceklist_dokumen_semua();
        checklist_satupersatu_laporan1();

        var jmlcek      = cst.count_det[0].x;            
        // if (jmlcek > 0){              
        //   $('#datablmselesai').show();
        //   $('#centanganall').hide();
        //   $('#batallap').show();
        // }
        var cekjnslap   = $('#jns_lap_drload').val();
        if (jns_laporan == 1){
          if (jmlcek == 12){
            $('#centanganall').show();
            $('#datablmselesai').show();
            $('#batallap').show();
          }else{
            $('#datablmselesai').show();
            $('#centanganall').hide();
            $('#batallap').show();
          }
        }else if (jns_laporan == 2) {
          if (jmlcek == 11){
            $('#centanganall').show();
            $('#datablmselesai').show();
            $('#batallap').show();
          }else{
            $('#datablmselesai').show();
            $('#centanganall').hide();
            $('#batallap').show();
          }
        }else if (jns_laporan == 3){
          if (jmlcek == 13){
            $('#centanganall').show();
            $('#datablmselesai').show();
            $('#batallap').show();
          }else{
            $('#datablmselesai').show();
            $('#centanganall').hide();
            $('#batallap').show();
          }
        }
      }else{
        reload_table();
        $('#loading_viewverifdua').hide();
        toastr.warning(cst.data);
        $("#view_laporanx").html('');
        jns_laporan_onchange_kosong();
        if (jmlcek == 0){              
          $('#datablmselesai').show();
          $('#centanganall').hide();
          $('#batallap').hide();
        }
      }
    },
    failure: function(o){              
      toastr.error("Hubungi Admin");
    },  
  });

}

function jns_laporan_onchange_kosong(){
  $("#jns_laporan").change(function(){
      var idjns_laporan = $("#jns_laporan").val();

      $('#loading_viewverifdua').show();
      Ext.Ajax.request({
        url: base_url+"index.php/load_module/getlaporan_jenislaporan",
        params:{
          no_in       : '0',
          nokwitansi  : '0',
          id          : idjns_laporan
        },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          if (cst.count_data == 'success'){
            $("#view_laporanx").html(cst.data);              
            $('#loading_viewverifdua').hide(); 
            //reload_table();             
            ceklist_dokumen_semua();
            checklist_satupersatu_laporan1();
            $('#datablmselesai').show();
          }else{
            reload_table();
            $('#loading_viewverifdua').hide();
            toastr.warning(cst.data);
            $("#view_laporanx").html('');
          }
        },
        failure: function(o){              
          toastr.error("Hubungi Admin");
        },  
      });

  });
}
function kembalikan_kestep1($id_form, $nokwitansi, $valuenoin, $jns_laporan){
   
  var idform     = $id_form;
  var nokwitansi = $nokwitansi;
  var valuenoin  = $valuenoin;
  var jns_lap    = $jns_laporan;
  console.log($id_form, $nokwitansi, $valuenoin, $jns_laporan);
  // var id_form = []; 
  
  // var explode; 
  // $('.cek_verif_awal').each(function(){  
  //     if($(this).is(":checked"))  
  //     {  
  //          id_form.push($(this).val());


  //     }  
  // });
  // var jsonString = JSON.stringify(id_form);
  // // console.log(jsonString);
  // // var explode = jsonString.split("##",1);
  // // var jsonStringx = JSON.stringify(explode);
  // explode = jsonString.substr(2,4);
  // var re = /\s*;\s*/;
  // var nameList = explode.split(re);
  // console.log(id_form);
  // console.log(jsonString);
  // console.log(explode);
  // console.log(nameList);
  var tanya = confirm("Data akan dikembalikan ke Verifikasi Awal ?");
 
   if(tanya === true) {
    if (idform != '') {
      if ((valuenoin == '')||(valuenoin == 0)){      
        Ext.Ajax.request({
          url: base_url+"index.php/load_module/update_verifstepdua",
          params:{
            id_form : idform //jsonString
          },
          success: function(response) {
            var cst = Ext.decode(response.responseText);
            //console.log(cst);
            if (cst.count_data == 200){
              reload_table();
              toastr.success(cst.pesan);
              //hide_icon();
            }else{
              reload_table();
              toastr.error(cst.pesan);
              hide_icon();
            }
          },
          failure: function(o){              
            toastr.error("Hubungi Admin");
          },  
        });
      }else{
        hide_icon();
        reload_table();
        toastr.error("Sedang Dalam Proses Verifikasi,..<br>Hapus Verifikasi terlebih dahulu !!!");
      }   
    }else{
      hide_icon();
      reload_table();
      toastr.error("Error, Reload Data !!!");
    }   
   }else{
      hide_icon();
      reload_table();
      toastr.warning("Batal");
   }
}

function simpan_baru(){
  load_ceklist_awal();
  var cekbox_laporan = [];
  var no_urut = [];  
  var ket = [];

  $('.cekbox_laporan').each(function(){  
      // if($(this).is(":checked"))  
      // {  
           cekbox_laporan.push($(this).val());
           //no_urut = $('.nourut').push($(this).val());
  });

  $('.nourut').each(function(){  
      no_urut.push($(this).val());        
  });
  $('.keterangan').each(function(){  
      ket.push($(this).val());        
  });
  
  var jsonString_cekbox = JSON.stringify(cekbox_laporan);
  var jsonString_nourut = JSON.stringify(no_urut);  
  var jsonString_ket    = JSON.stringify(ket);  
  console.log(jsonString_cekbox,jsonString_nourut,jsonString_ket);

  var nokwitansi  = $('#nokwitansi').val();
  var noin        = $('#no_in').val();
  var idform      = $('#idform').val();
  var jns_lap     = $('#jns_laporan').val(); //dari pilihan
  var jns_lap_drload  = $('#jns_lap_drload').val(); // dari load
  //var tanya = confirm("Data akan dikembalikan ke Verifikasi Awal ?");
  

  if(jsonString_cekbox != '') {
    if (jns_lap != ''){
      // var jsonString = JSON.stringify(id_form);
      if (jns_lap == jns_lap_drload){ //nilaix sama
          Ext.Ajax.request({
            url: base_url+"index.php/load_module/savelaporan_verifstepdua",
            params:{
              idform          : idform,
              noin            : noin,
              nokwitansi      : nokwitansi,
              jns_lap         : jns_lap, 
              cekbox_laporan  : jsonString_cekbox,
              nourut          : jsonString_nourut,
              ket             : jsonString_ket,
            },
            success: function(response) {
              var cst = Ext.decode(response.responseText);
              //console.log(cst);
              if (cst.count_data == 200){
                reload_table();
                toastr.success(cst.pesan);
                $('#no_in').val(cst.no_in);
                var cekjnslap = $('#jns_lap_drload').val();
                var count = cst.count_det[0].x;
                if (cekjnslap == 1){
                  if (count == 12){
                    $('#centanganall').show();
                    $('#datablmselesai').show();
                    $('#batallap').show();
                  }else{
                    $('#datablmselesai').show();
                    $('#centanganall').hide();
                    $('#batallap').show();
                  }
                }else if (cekjnslap == 2) {
                  if (count == 11){
                    $('#centanganall').show();
                    $('#datablmselesai').show();
                    $('#batallap').show();
                  }else{
                    $('#datablmselesai').show();
                    $('#centanganall').hide();
                    $('#batallap').show();
                  }
                }else if (cekjnslap == 3){
                  if (count == 13){
                    $('#centanganall').show();
                    $('#datablmselesai').show();
                    $('#batallap').show();
                  }else{
                    $('#datablmselesai').show();
                    $('#centanganall').hide();
                    $('#batallap').show();
                  }
                }

                // if (count >= 11){
                //   $('#centanganall').show();
                //   $('#datablmselesai').show();
                //   $('#batallap').show();
                // }else{
                //   $('#datablmselesai').show();
                //   $('#centanganall').hide();
                //   $('#batallap').show();
                // }
                //hide_icon();
              }else{
                //reload_table();
                $('#modal-viewcentangan').modal('hide');
                toastr.error(cst.pesan);
                //hide_icon();
              }
            },
            failure: function(o){              
              toastr.error("Hubungi Admin");
            },  
          });
      }else if (jns_lap_drload == 0){ //kondisi masih baru
          Ext.Ajax.request({
              url: base_url+"index.php/load_module/savelaporan_verifstepdua",
              params:{
                idform          : idform,
                noin            : noin,
                nokwitansi      : nokwitansi,
                jns_lap         : jns_lap, 
                cekbox_laporan  : jsonString_cekbox,
                nourut          : jsonString_nourut,
                ket             : jsonString_ket,
              },
              success: function(response) {
                var cst = Ext.decode(response.responseText);
                //console.log(cst);
                if (cst.count_data == 200){
                  reload_table();
                  toastr.success(cst.pesan);
                  $('#no_in').val(cst.no_in);                  
                  $('#jns_lap_drload').val(cst.jns_lap)
                  var count = cst.count_det[0].x;
                  if (count >= 11){
                    $('#centanganall').show();
                    $('#datablmselesai').show();
                    $('#batallap').show();
                  }else{
                    $('#datablmselesai').show();
                    $('#centanganall').hide();
                    $('#batallap').show();
                  }
                  //hide_icon();
                }else{
                  //reload_table();
                  $('#modal-viewcentangan').modal('hide');
                  toastr.error(cst.pesan);
                  //hide_icon();
                }
              },
              failure: function(o){              
                toastr.error("Hubungi Admin");
              },  
          });
      }else if (jns_lap != jns_lap_drload){ //nilaix tidak sma tapi jns_lap_drload harus ada nilaix
        toastr.error("Hapus Verifikasi dahulu apabila ingin merubah Jenis Laporannya !!!");
      }   
    }else{      
      toastr.error("Jenis Laporan Belum Dipilih !!!");
    }
  }else{      
    toastr.warning("Error !!!");
  }
}

function show_icon(){
  $('#centang_dokumen').show();  
  $('#hapus_verifikasi').show();  
  //$('#kembalikan').show();
  $('#garis_verikal').show();
  $('#garis_verikal2').show();
  $('#garis_verikal1_1').show();
  $('#garis_verikal2_1').show();
}

function hide_icon(){
  $('#centang_dokumen').hide();
  $('#hapus_verifikasi').hide();  
  $('#garis_verikal').hide();
  $('#garis_verikal2').hide();
  $('#garis_verikal1_1').hide();
  $('#garis_verikal2_1').hide();

  //----------MODAL------------//
  $('#datablmselesai').hide();
  $('#centanganall').hide();
  $('#batallap').hide();
}

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax 
  hide_icon();
}

function load_ceklist_awal(){
  $('.ceklist_lap1_1').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_2').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_3').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_4').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_5').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_6').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_7').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_8').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_9').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_10').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
  $('.ceklist_lap1_11').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_12').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_13').each(function(){      
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });
}

function checklist_satupersatu_laporan1(){
  var id = [];
  var n = 0;
  $('.ceklist_lap1_1').click(function() {
      $('#ket1').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');
              //id.push($(this).val());              
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket1').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_2').click(function() {
      $('#ket2').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket2').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_3').click(function() {
      $('#ket3').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket3').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_4').click(function() {
      $('#ket4').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket4').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_5').click(function() {
      $('#ket5').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket5').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_6').click(function() {
      $('#ket6').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket6').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_7').click(function() {
      $('#ket7').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket7').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_8').click(function() {
      $('#ket8').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket8').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_9').click(function() {
      $('#ket9').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket9').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_10').click(function() {
      $('#ket10').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket10').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_11').click(function() {
      $('#ket11').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket11').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_12').click(function() {
      $('#ket12').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket12').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

  $('.ceklist_lap1_13').click(function() {
      $('#ket13').each(function() {
          if ($(this).attr('disabled')) {
              $(this).removeAttr('disabled');                
          }else{
              $(this).attr({
                  'disabled': 'disabled'
              });
              $('#ket13').val('');
          }
      });
      if($(this).is(":checked")){  
        $(this).val('1');
      }else{
        $(this).val('0');
      }
  });

}

function disable_serentak_keterangan_laporan1(){
  
  $('#ket1').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket1').val('');
      }
  });

  $('#ket2').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket2').val('');
      }
  });

  $('#ket3').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket3').val('');
      }
  });

  $('#ket4').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket4').val('');
      }
  });    
    
  $('#ket5').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket5').val('');
      }
  });

  $('#ket6').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket6').val('');
      }
  });

  $('#ket7').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket7').val('');
      }
  });

  $('#ket8').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket8').val('');
      }
  });
       
  $('#ket9').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket9').val('');
      }
  });
    
  $('#ket10').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket10').val('');
      }
  });
    
  $('#ket11').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket11').val('');
      }
  });

  $('#ket12').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket12').val('');
      }
  });

  $('#ket13').each(function() {
      if ($(this).attr('disabled')) {
          $(this).removeAttr('disabled');                
      }else{
          $(this).attr({
              'disabled': 'disabled'
          });
          $('#ket13').val('');
      }
  });
    
}

function hapuslap(){
 
$('#loading_viewverifdua').show();
 var tanya = confirm("Laporan Verifikasi Berkas akan dibatalkan/dihapus ???");
 
   if(tanya === true) {
    Ext.Ajax.request({
      url: base_url+"index.php/load_module/delete_laporanverif",
      params:{
        idform      : $('#idform').val(),
        no_in       : $('#no_in').val(),
        nokwitansi  : $('#nokwitansi').val(),      
        reason      : tanya,
      },
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        if (cst.count_data == 200){
          $('#loading_viewverifdua').hide(); 
          reload_table();        
          toastr.success(cst.pesan);
          $('#modal-viewcentangan').modal('hide');
        }else{          
          $('#loading_viewverifdua').hide();
          reload_table();
          toastr.warning(cst.pesan);
          $('#modal-viewcentangan').modal('hide');
        }
      },
      failure: function(o){  
        reload_table();             
        toastr.error("Hubungi Admin");
      },  
    });
  }else{
    $('#modal-viewcentangan').modal('hide');
    toastr.error("Batal,..");
  }
}

function hapus_verifikasi(){

  var total=0;
  var id_form = [];  
  $('.cek_verif_awal').each(function(){
      if($(this).is(":checked"))
      {
           id_form.push($(this).val());
      }
  });
  total = id_form.length;  

  if (id_form != ''){
    if (total == 1){      

      Ext.Ajax.request({
        url: base_url+"index.php/load_module/cek_proses_verifikasi",
        params:{
          id_form : id_form
        },
        success: function(response) {
          var cst = Ext.decode(response.responseText);
          
          if (cst.count == 1){ //berarti memiliki data no_in terdaftar            
            var no_in       = cst.noin;
            var nokwitansi  = cst.nokwitansi;
            var idform      = cst.idform;            
            
            hapus_verifikasi_akhir(no_in, nokwitansi, idform);
          }else{
           toastr.error("Belum DiProses Verifikasi !!!");
          }
        },
        failure: function(o){              
          toastr.error("Hubungi Admin");
        },  
      });      
      
    }else{
      hide_icon();
      toastr.error("Harus Pilih Salah Satu Untuk Proses Hapus Verifikasi !!!");
    }

  }else{
    hide_icon();
    toastr.error("Belum ada yang dipilih !!!");
  }
}

function hapus_verifikasi_akhir(no_in, nokwitansi, idform){
  var tanya = confirm("Laporan Verifikasi Berkas akan dibatalkan/dihapus ???");
 
  if(tanya === true) {
    Ext.Ajax.request({
      url: base_url+"index.php/load_module/delete_laporanverif",
      params:{
        idform      : idform,
        no_in       : no_in,
        nokwitansi  : nokwitansi,      
        reason      : tanya,
      },
      success: function(response) {
        var cst = Ext.decode(response.responseText);
        if (cst.count_data == 200){
          reload_table();
          toastr.success(cst.pesan);
        }else{
          reload_table();
          toastr.warning(cst.pesan);
        }
      },
      failure: function(o){  
        reload_table();
        toastr.error("Hubungi Admin");
      },  
    });
  }else{
    //$('#modal-viewcentangan').modal('hide');
    toastr.error("Batal,..");
  }
}

function simpan_finish(){
 
$('#loading_viewverifdua').show();
 var tanya = confirm("Proses cek verifikasi telah selesai ???");
 
   if(tanya === true) {
    Ext.Ajax.request({
      url: base_url+"index.php/load_module/posting_verifkedua",
      params:{
        idform      : $('#idform').val(),
        no_in       : $('#no_in').val(),
        nokwitansi  : $('#nokwitansi').val(),      
        reason      : tanya,
      },
      success: function(response) {
        var cst = Ext.decode(response.responseText);            
        if (cst.count_data == 200){
          $('#loading_viewverifdua').hide(); 
          reload_table();        
          toastr.success(cst.pesan);
          $('#modal-viewcentangan').modal('hide');
        }else{          
          $('#loading_viewverifdua').hide();
          reload_table();
          toastr.warning(cst.pesan);
          $('#modal-viewcentangan').modal('hide');
        }
      },
      failure: function(o){  
        reload_table();             
        toastr.error("Hubungi Admin");
      },  
    });
  }else{
    reload_table();
    $('#modal-viewcentangan').modal('hide');
    toastr.error("Batal,..");
  }
}

// function print_laporan($id_form, $nokwitansi, $valuenoin){
 
//   Ext.Ajax.request({
//     url: base_url+"index.php/lap_verifikasi/preview_verifstep2_1",
//     params:{
//       // idform      : $('#idform').val(),
//       // no_in       : $('#no_in').val(),
//       // nokwitansi  : $('#nokwitansi').val(),      
//       // reason      : tanya,
//     },
//     success: function(response) {
//       var cst = Ext.decode(response.responseText);            
//       if (cst.count_data == 200){
//         $('#loading_viewverifdua').hide(); 
//         reload_table();        
//         toastr.success(cst.pesan);
//         $('#modal-viewcentangan').modal('hide');
//       }else{          
//         $('#loading_viewverifdua').hide();
//         reload_table();
//         toastr.warning(cst.pesan);
//         $('#modal-viewcentangan').modal('hide');
//       }
//     },
//     failure: function(o){  
//       reload_table();             
//       toastr.error("Hubungi Admin");
//     },  
//   });
  
// }

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