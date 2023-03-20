<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-check"></i>
      List Module
    </h3>
    <div class="card-tools">      
      <button type="button" class="btn btn-tool" onclick="reload_table()" title="Refresh"><i class="fas fa-sync-alt"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>    
  </div>
  
  <div class="card-body">
      <table id="ajax_listusers" class="table table-bordered table-striped">
        <thead>
          <tr class="navbar-primary " style="font-size: 11px;">
              <th width="5" align="center">No.</th>
              <th width="100">Username</th>
              <th>Nama Lengkap</th>
              <th width="100">Password</th>
              <th width="180">NIP</th>
              <th width="70">Opsi</th>
          </tr>
        </thead>
        <tbody style="font-size: 13px;">
        </tbody>
      </table>      
  </div>
 
</div>

<div class="modal fade" id="modal-deletelistuser">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h5 class="modal-title">Peringatan !!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="overlay-wrapper" id="loading_delete_listusers">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>            
        </div>
      </div>
      <div class="modal-body">        
        <input type="text" id="id_form_delete" required disabled hidden="true">
        <p align="right"><strong>Hapus Data User ???</strong></p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        <button type="button" class="btn btn-outline-light btn-sm" id='deletelistuser' onclick="deletelistuser()"><i class="fa fa-trash"></i> Hapus</button>
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
    if ( $.fn.dataTable.isDataTable( '#ajax_listusers' ) ) {
      table = $('#ajax_listusers').DataTable();
    }else{
      table = $('#ajax_listusers').DataTable({   
      //$('#ajax_listrekanan').DataTable({
          responsive: true,
          retrieve  : true,
          autoWidth : false,
          processing: true, //Feature control the processing indicator.
          serverSide: true, //Feature control DataTables' server-side processing mode.
          order     : [],   //Initial no order.

          // Load data for the table's content from an Ajax source
          ajax: {
              url: "load_module/get_listusers",
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


function view_deleteusers($id_akses){ //delete
  $('#modal-deletelistuser').modal('show');  
  
  $('#id_form_delete').val($id_akses);
  $('#loading_delete_listusers').hide();
}

function deletelistuser(){
  // $('#deleteform').click(function() {
    $('#loading_delete_listusers').show();
    Ext.Ajax.request({
        url: base_url+"index.php/load_module/delete_usersijisiji",
        params: {
            id_akses    : $('#id_form_delete').val()            
          },
        success: function(response) {
          var cst = Ext.decode(response.responseText);            
          
          if (cst.count_data == 200){
            reload_table();
            toastr.success(cst.pesan);
            $('#loading_delete_listusers').hide();
            $('#modal-deletelistuser').modal('hide');
          }else{            
            toastr.error(cst.pesan);
            $('#loading_delete_listusers').hide();
            $('#modal-deletelistuser').modal('hide');  
          }
        },
        failure: function(o) { 
          reload_table();
          toastr.error('Hubungi Admin !!!');
        },  
    });
  // });
}
</script>