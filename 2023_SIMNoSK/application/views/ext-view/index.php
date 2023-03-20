<?php //$base_url = "http://localhost/ujicoba_cidanextjs/ext-codeigniter/index.php/extjs"; ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo base_url();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo SITE_NAME ;?></title>
        <!-- <link rel="stylesheet" type="text/css" href="../ext/resources/css/ext-all.css" /> -->
        <!-- <script type="text/javascript" src="../ext/ext-all.js"></script> -->
        <link rel="stylesheet" href="<?php echo base_url('public/ext-4.2.1/resources/css/ext-all.css'); ?>" type="text/css">  
        <script type="text/javascript" src="<?php echo base_url(); ?>public/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url('public/ext-4.2.1/ext-all.js'); ?>"></script>
        <!-- 
        <link rel="stylesheet" href="<?php //echo base_url('public/ext-3.3.0/css/ext-all.css'); ?>" type="text/css"> 
        <script src="<?php //echo base_url('public/ext-3.3.0/ext-all.js'); ?>"></script>
        <script src="<?php //echo base_url('public/ext-3.3.0/adapter/ext/ext-base.js'); ?>"></script>        
         -->         
    </head>
    <body>
        

      
        <div id="grid-view">
            <div align="center" style="margin-top:250px;"> 
            <center>
                <img alt = "" src="<?php echo base_url(); ?>public/blue-loading.gif" width="32" height="32"  style="float:center;vertical-align:middle;"/><br />
                <span id="loading-msg"></span>
            </center>
            </div> 
        </div>
        
        <script type="text/javascript">        
        var strModul = 'Electronic Control Card Verfication\nRSUD dr. Soedono Madiun';
        document.getElementById('loading-msg').innerHTML = 'Loading Core Component... <br>' + strModul;
        </script>
        <script type="text/javascript" src="<?php echo base_url('public/ui/ui.js'); ?>"></script>

    </body>
</html>
<script>

Ext.onReady(function () {
    if(Ext.isChrome===true){       
        var chromeDatePickerCSS = ".x-date-picker {border-color: #1b376c;background-color:#fff;position: relative;width: 185px;}";
        Ext.util.CSS.createStyleSheet(chromeDatePickerCSS,'chromeDatePickerStyle');
    }
});
</script>
