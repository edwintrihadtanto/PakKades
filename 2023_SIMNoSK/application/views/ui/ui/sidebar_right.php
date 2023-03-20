<button class="btn" data-widget="control-sidebar" data-slide="true" style="color:#ffffff;" title="Tutup"><i class="fas fa-arrow-right" ></i></button>

<h6 align="center">Menu Laporan</h6>
<hr class="mb-2"/>
<div style="margin:15px;">  
  <div align="center" id="loading_sidebar_right">
    <img src="<?php echo base_url(); ?>public/loading-ring.gif" width="50" height="50"/>    
  </div>
  <div id="kump_button_lap">    
  </div>
</div>

<script type="text/javascript">

function sembunyikan_semua_tombol() {
  $('#loading_sidebar_right').show();
  $('#kump_button_lap').hide();
}

</script>