var baseURL = "http://localhost/2020_ecardcontrol/";
Ext.onReady(function () {
LoadDataUser();
function LoadDataUser(){	
	Ext.Ajax.request({
		url: baseURL +  "index.php/main/getDataUser",
		params: {
			kd_unit 	: null
		},

		success: function(response) {
			var cst = Ext.decode(response.responseText);
			var modid = cst.result_data[0].mod_id;			
			
			// if (setting_tracer == 'f') {
			// 	Ext.getCmp('cboStatusAntrian_viKasirRwj').enable();
			// 	Ext.getCmp('cboStatusAntrian_viKasirRwj').setValue("Semua");
			// }else{
			// 	Ext.getCmp('cboStatusAntrian_viKasirRwj').setValue("Tunggu Berkas");
			// 	Ext.getCmp('cboStatusAntrian_viKasirRwj').disable();
			// }
			//RefreshDataFilterKasirRWJ();
		},
	});
}


});