<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename  = "tbl_configs"; // Database table name
$moduleId 		  = 12;				// module id >>>>> tbl_modules
$moduleFoldername = "";		// Image folder name

?>
<h3>Preference Management</h3>
<?php $locationRow   = Config::find_by_id(1); 
    $status      = ($locationRow->location_type==1)?"checked":" ";
    $unstatus    = ($locationRow->location_type==0)?"checked":" "; ?>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
    	<form action="" class="col-md-12 center-margin" id="location_frm">
        	
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Site Title :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Site Title" class="col-md-6 validate[required,length[0,200]]" type="text" name="sitetitle" id="sitetitle" value="<?php echo !empty($locationRow->sitetitle)?$locationRow->sitetitle:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Site Name :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Site Name" class="col-md-6 validate[required,length[0,200]]" type="text" name="sitename" id="sitename" value="<?php echo !empty($locationRow->sitename)?$locationRow->sitename:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Street Address :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Fiscal Address" class="col-md-6" type="text" name="fiscal_address" id="fiscal_address" value="<?php echo !empty($locationRow->fiscal_address)?$locationRow->fiscal_address:"";?>">
                </div>                
            </div>
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        City :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Mail Address" class="col-md-6" type="text" name="mail_address" id="mail_address" value="<?php echo !empty($locationRow->mail_address)?$locationRow->mail_address:"";?>">
                </div>                
            </div>
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Contact No :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Contact Info" class="col-md-6" type="text" name="contact_info" id="contact_info" value="<?php echo !empty($locationRow->contact_info)?$locationRow->contact_info:"";?>">
                </div>                
            </div>
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Email Address :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Email Address" class="col-md-6" type="text" name="email_address" id="email_address" value="<?php echo !empty($locationRow->email_address)?$locationRow->email_address:"";?>">
                </div>                
            </div>
            
                                               
            <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
            </button>
            <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($locationRow->id)?$locationRow->id:0;?>" />
         </form>    
    </div>
</div>