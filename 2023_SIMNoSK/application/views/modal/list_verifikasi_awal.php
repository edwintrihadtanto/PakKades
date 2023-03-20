<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      List Verifikasi Awal
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
    <!-- <form method="post" id="update_verifikasiawal"> -->
    <!--
      <div class="input-group mb-3">
        <div class="col-sm-2.5">
          <label><i class="fas fa-calendar-alt"></i> Tgl. :</label>          
          <span><input type="date" value="<?php echo date('Y-m-d') ?>" id="pencariantgl">
            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Pencarian Berdaasarkan Tanggal Penyerahan Berkas" style="margin-bottom: 1mm;" onclick="loadtabel_pencarian()"><i class="fa fa-search"></i></a>
          </span>          
        </div>
      </div>
    
      <hr>
      -->
      <table id="ajax_verifikasiawal" class="table table-bordered table-striped">
        <thead>
          <tr class="navbar-warning " style="font-size: 11px;">
              <th width="5" align="center">No.</th>
              <th width="140">No. Kwitansi</th>
              <th>Nama Perusahaan / Rekanan</th>
              <th width="100">Nominal Kwitansi</th>
              <th width="85">Tgl. Penyerahan</th>
              <th width="130">Keterangan</th>
              <th width="70" style="vertical-align:middle;">Cek All <input type="checkbox" class="check_all"/></th>
          </tr>
        </thead>
        <tbody style="font-size: 13.5px;" class="check">
        </tbody>
      </table>
      <div class="garis_verikalmelayang1" id="garis_verikal"></div>
      <div class="garis_verikalmelayang2" id="garis_verikal2"></div>
      <div class="garis_verikalmelayang1_1" id="garis_verikal1_1"></div>
      <div class="garis_verikalmelayang2_1" id="garis_verikal2_1"></div>

      <a href="#" class="btn btn-primary elevation-3 melayang2" id="print_tandaterima" onclick="fprint_tndaterima()" title="Cetak Tanda Terima" style="width: 100px;">
        <i class="fas fa-print"></i>
      </a>      
      <a href="#" class="btn btn-danger elevation-3 melayang" id="kelengkapan_complete" onclick="kelengkapan_complete()" title="Send to Verification Step 2" style="width: 100px;">
        <i class="fas fa-check"></i>
      </a>
    <!-- </form> -->
  </div>
  <!-- /.card -->
</div>

<script>
hide_icon();
load_tabel();
load_checkbox();

var table;
function load_tabel(){

  if ( $.fn.dataTable.isDataTable( '#ajax_verifikasiawal' ) ) {
    table = $('#ajax_verifikasiawal').DataTable();
  }else{
    table = $('#ajax_verifikasiawal').DataTable({         
        responsive: true,
        retrieve  : true,
        autoWidth : false,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order     : [],   //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "load_module/get_extlist_rverifikasi_awal",
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
}

function loadtabel_pencarian(){
  var tglcari = $('#pencariantgl').val();
  if ( $.fn.dataTable.isDataTable( '#ajax_verifikasiawal' ) ) {
    table = $('#ajax_verifikasiawal').DataTable();
  }else{
    table = $('#ajax_verifikasiawal').DataTable({
        data  : tglcari,  
        responsive: true,
        retrieve  : true,
        autoWidth : false,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order     : [],   //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "load_module/get_extlist_rverifikasi_awal",
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

function kelengkapan_complete(){
  // $('#kelengkapan_complete').click(function(){  
    var id_form = [];  
    $('.cek_verif_awal').each(function(){  
        if($(this).is(":checked"))  
        {  
             id_form.push($(this).val());  
        }  
    });  
    //id_form = new Array(id_form.toString());      
    //console.log(id_form);
    var tanya = confirm("Data akan dikirim ke Verifikasi Tahap Selanjutnya ?");
 
   if(tanya === true) {
    if (id_form != ''){
      var jsonString = JSON.stringify(id_form);
      Ext.Ajax.request({
        url: base_url+"index.php/load_module/update_verifawal",
        params:{
          id_form : jsonString
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
      toastr.error("Cek Kelengkapan<br>Belum ada yang dipilih !!!");
    }   
   }else{
      hide_icon();
      toastr.warning("Batal");
   }
     
  // });
}


function fprint_tndaterima(){

    var id_formx = [];  
    $('.cek_verif_awal').each(function(){  
        if($(this).is(":checked"))  
        {  
             id_formx.push($(this).val());  
        }  
    });  
    //id_formx = new Array(id_formx.toString());      
    //console.log(id_form);
    
    if (id_formx != ''){
        var jsonString = JSON.stringify(id_formx);
        var no_kwitansi = JSON.stringify(id_formx);
        Ext.Ajax.request({
          url: base_url+"index.php/lap_verifikasi/kroscek",
          params:{
            id_form : jsonString
          },
          success: function(response) {
            var cst = Ext.decode(response.responseText);
            console.log(cst);
            if (cst.totalrecords > 0){
              for(var i=0; i<cst.ListDataObj.length; i++){
            //console.log(cst.ListDataObj[i].no_kwitansi);              
                //no_kwitansi = cst.ListDataObj[i].no_kwitansi;
              }
              print_tanda_terima(no_kwitansi);
            }else{
              toastr.error("Preview Failed !!!");
            }
          },
          failure: function(o){              
            toastr.error("Hubungi Admin");
          },  
        });

    }else{
      hide_icon();
      toastr.error("Cek Kelengkapan<br>Belum ada yang dipilih !!!");
    }    
  // });
}

function print_tanda_terima(no_kwitansi){
  
  var params={};
  params['criteria']=no_kwitansi;
  //console.log(params);
  var form = document.createElement("form");
  form.setAttribute("method", "post");
  form.setAttribute("target", "_blank");
  
  form.setAttribute("action", base_url + "index.php/lap_verifikasi/preview");
  
  var hiddenField = document.createElement("input");
  hiddenField.setAttribute("type", "hidden");
  hiddenField.setAttribute("name", "data");
  hiddenField.setAttribute("value", Ext.encode(params));
  form.appendChild(hiddenField);
  document.body.appendChild(form);
  form.submit();
  //loadMask.hide();

}
function show_icon(){
  $('#kelengkapan_complete').show();
  $('#print_tandaterima').show();
  $('#garis_verikal').show();
  $('#garis_verikal2').show();
  $('#garis_verikal1_1').show();
  $('#garis_verikal2_1').show();
}

function hide_icon(){
  $('#kelengkapan_complete').hide();
  $('#print_tandaterima').hide();
  $('#garis_verikal').hide();
  $('#garis_verikal2').hide();
  $('#garis_verikal1_1').hide();
  $('#garis_verikal2_1').hide();
}

function reload_table(){
  table.ajax.reload(null,false); //reload datatable ajax 
}

</script>