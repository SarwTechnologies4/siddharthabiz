<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename  = "tbl_page"; // Database table name
$moduleId 		  = 49;				// module id >>>>> tbl_modules
$moduleFoldername = "apply";		// Image folder name

if(isset($_GET['page']) && $_GET['page'] == "apply" && isset($_GET['mode']) && $_GET['mode']=="triplist"): ?>
<h3>Apply For Trip Service</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <form action="" class="col-md-12 center-margin" id="page_frm">      
            <div class="form-row add-image">
                <div class="form-label col-md-2">
                    <label for="">
                        Document :
                    </label>
                </div>                
                <div class="form-input col-md-10 uploader">          
                   <input type="file" name="gallery_upload" id="gallery_upload" class="transparent no-shadow">
                   <small>Upload related company document</small>
                </div>                
            </div>
        </form>
    </div>
</div>

<?php endif;
if(isset($_GET['page']) && $_GET['page'] == "apply" && isset($_GET['mode']) && $_GET['mode']=="vehiclelist"): ?>
<h3>Apply For Vehicle Service</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <form action="" class="col-md-12 center-margin" id="page_frm">      
            <div class="form-row add-image">
                <div class="form-label col-md-2">
                    <label for="">
                        Document :
                    </label>
                </div>                
                <div class="form-input col-md-10 uploader">          
                   <input type="file" name="gallery_upload" id="gallery_upload" class="transparent no-shadow">
                   <small>Upload related company document</small>
                </div>                
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<center><b>Admin can approved those feature after verify your submited document.</b></center>
<script>
var base_url =  "<?php echo ASSETS_PATH; ?>";
var editor_arr = ["content"];
create_editor(base_url,editor_arr);
</script>

<script type="text/javascript" src="<?php echo ASSETS_PATH;?>uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript">
   // <![CDATA[
    $(document).ready(function() {
    $('#gallery_upload').uploadify({
    'swf'  : '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
    'uploader'   : '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
    'formData'   : {PROJECT : '<?php echo SITE_FOLDER;?>',targetFolder:'images/page/',thumb_width:200,thumb_height:200},
    'method'     : 'post',
    'cancelImg'  : '<?php echo BASE_URL;?>uploadify/cancel.png',
    'auto'       : true,
    'multi'      : true,    
    'hideButton' : false,   
    'buttonText' : 'Upload',
    'width'      : 125,
    'height'     : 21,
    'removeCompleted' : true,
    'progressData' : 'speed',
    'uploadLimit' : 100,
    'fileTypeExts' : '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
     'buttonClass' : 'button formButtons',
   /* 'checkExisting' : '/uploadify/check-exists.php',*/
    'onUploadSuccess' : function(file, data, response) {
        $('#uploadedImageName').val('1');
        var filename =  data;
        $.post('<?php echo BASE_URL;?>apanel/page/uploaded_image.php',{imagefile:filename},function(msg){           
               $('#preview_Image').append(msg).show();
            }); 
            
    },
    'onDialogOpen'      : function(event,ID,fileObj) {      
    },
    'onUploadError' : function(file, errorCode, errorMsg, errorString) {
           alert(errorMsg);
        },
    'onUploadComplete' : function(file) {
          //alert('The file ' + file.name + ' was successfully uploaded');
        }   
  });
});
    // ]]>
</script>
