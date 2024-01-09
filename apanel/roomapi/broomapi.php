<?php
$tablename  = "tbl_roomapi"; // Database table name
if(isset($_GET['page']) && $_GET['page'] == "roomapi" && isset($_GET['mode']) && $_GET['mode']=="list"):
JsonclearImages($tablename, "roomapi");
JsonclearImages($tablename, "roomapi/thumbnails");
?>
<h3>
Manage Rooms
<a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewRoom();">
    <span class="glyph-icon icon-separator">
        <i class="glyph-icon icon-plus-square"></i>
    </span>
    <span class="button-content"> Add New </span>
</a>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">    
    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
        <thead>
            <tr>
               <th style="display:none;"></th>
               <th class="text-center"><input class="check-all" type="checkbox" /></th>
               <th class="text-left">Title</th>   
               <th class="text-left">Type</th> 
               <th class="text-left">No. of Room</th> 
               <th class="text-left">Available Room</th> 
               <th>Status</th> 
               <th class="text-center"><?php echo $GLOBALS['basic']['action'];?></th>
            </tr>
        </thead> 
            
        <tbody>
            <?php $records = Roomapi::find_by_sql("SELECT * FROM ".$tablename." ORDER BY sortorder DESC "); 
                  foreach($records as $key=>$record): ?>    
            <tr id="<?php echo $record->id;?>">
                <td style="display:none;"><?php echo $key+1;?></td>
                <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id;?>" /></td>
                <td><a href="javascript:void(0);" onClick="editsubroom(<?php echo $record->type;?>,<?php echo $record->id;?>);" class="loadingbar-demo" title="<?php echo $record->title;?>"><?php echo $record->title;?></a>
                </td>       
                <td><?php $room_type  =  $record->room_type;
                  $rowType  =  Roomtype::find_by_id($room_type);
                  echo $rowType->title;
                ?></td>
                <td><?php echo $record->no_rooms;?></td>
                <td><?php echo $record->no_rooms;?></td>  
                 <td class="text-center">
                     <?php  
                        $statusImage = ($record->status == 1) ? "bg-green" : "bg-red" ; 
                        $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'] ; 
                    ?>                                             
                    <a href="javascript:void(0);" class="btn small <?php echo $statusImage;?> tooltip-button statusSubToggler" data-placement="top" title="<?php echo $statusText;?>" status="<?php echo $record->status;?>" id="imgHolder_<?php echo $record->id;?>" moduleId="<?php echo $record->id;?>">
                        <i class="glyph-icon icon-flag"></i>
                    </a>
                 </td> 
                <td class="text-center">                    
                    <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id;?>);">
                        <i class="glyph-icon icon-edit"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove" onclick="recordDelete(<?php echo $record->id;?>);">
                        <i class="glyph-icon icon-remove"></i>
                    </a>
                    <input name="sortId" type="hidden" value="<?php echo $record->id;?>">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<div class="pad0L col-md-2">
<select name="dropdown" id="groupTaskField" class="custom-select">
    <option value="0"><?php echo $GLOBALS['basic']['choseAction'];?></option>
    <option value="subdelete"><?php echo $GLOBALS['basic']['delete'];?></option>
    <option value="subtoggleStatus"><?php echo $GLOBALS['basic']['toggleStatus'];?></option>
</select>
</div>
<a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
    <span class="glyph-icon icon-separator float-right">
      <i class="glyph-icon icon-cog"></i>
    </span>
    <span class="button-content"> Submit </span>
</a>
</div>

<?php elseif(isset($_GET['mode']) && $_GET['mode'] == "form"): 
if(isset($_GET['id']) and !empty($_GET['id'])):
    $rowId  = addslashes($_REQUEST['id']);
    $rowInfo  = Roomapi::find_by_id($rowId);
    $status     = ($rowInfo->status==1)?"checked":" ";
    $unstatus   = ($rowInfo->status==0)?"checked":" ";
endif;  
?>
<h3>
<?php echo (isset($_GET['id']))?'Edit Room':'Add Room';?>
<a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewPackagelist();">
    <span class="glyph-icon icon-separator">
        <i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
    <span class="button-content"> Back </span>
</a>
</h3>

<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <form action="" method="post" class="col-md-12 center-margin" id="roomapi_frm">         
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Title :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Room Title" class="col-md-12 validate[required,length[0,100]]" type="text" name="title" id="title" value="<?php echo !empty($rowInfo->title)?$rowInfo->title:"";?>">
                </div>                
            </div>  

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Room Type :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <select data-placeholder="Room Type" class="chosen-select validate[required,length[0,500]]" id="room_type" name="room_type">
                        <option value="">Choose</option>                        
                        <?php $roomType = Roomtype::find_all();
                        if($roomType): foreach($roomType as $roowtyperow): 
                $sel = (!empty($rowInfo->room_type) && $rowInfo->room_type==$roowtyperow->id)?'selected':'';
                        ?>
                        <option value="<?php echo $roowtyperow->id;?>" <?php echo $sel;?>><?php echo $roowtyperow->title;?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>                
            </div> 

            

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Minimum size of room :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[required,length[0,20]]" type="text" name="room_size" id="room_size" value="<?php echo !empty($rowInfo->room_size)?$rowInfo->room_size:"";?>">
                    square
                    <select name="room_size_label" id="room_size_label" class="col-md-2" >
                        <option value="meters" <?php  echo (!empty($rowInfo->room_size_label) && $rowInfo->room_size_label=='meters') ? "selected":"";?> >Meters</option>
                        <option value="feet" <?php  echo (!empty($rowInfo->room_size_label) && $rowInfo->room_size_label=='feet') ? "selected":"";?> >Feet</option>
                    </select>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Smoking / Non Smoking :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <select name="smoking" id="smoking" class="col-md-4" >
                        <option value="yes" <?php  echo (!empty($rowInfo->smoking) && $rowInfo->smoking=='yes') ? "selected":"";?> >Can Smoke</option>
                        <option value="no" <?php  echo (!empty($rowInfo->smoking) && $rowInfo->smoking=='no') ? "selected":"";?> >Non Smoking</option>
                        <option value="both" <?php  echo (!empty($rowInfo->smoking) && $rowInfo->smoking=='both') ? "selected":"";?> >Both</option>
                    </select>
                </div>                
            </div>

            <p><h4>Type of bedding - Individual rooms</h4>
               Number of beds in this type of room</p>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Single(bed) :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="single_bed" id="single_bed" value="<?php echo !empty($rowInfo->single_bed)?$rowInfo->single_bed:"";?>">
                    <br><small>90-130 cm (35-51 inches) wide</small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Double(bed) :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="double_bed" id="double_bed" value="<?php echo !empty($rowInfo->double_bed)?$rowInfo->double_bed:"";?>">
                    <br><small>131-150 cm (52-59 inches) wide</small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Large Double(bed) :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="large_double" id="large_double" value="<?php echo !empty($rowInfo->large_double)?$rowInfo->large_double:"";?>">
                    <br><small>151-180 cm (60-70 inches) wide</small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Extra Large Double(bed) :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="extra_large_double" id="extra_large_double" value="<?php echo !empty($rowInfo->extra_large_double)?$rowInfo->extra_large_double:"";?>">
                    <br><small>181-210 cm (71-82 inches) wide</small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Bunk Bed :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="bunk_bed" id="bunk_bed" value="<?php echo !empty($rowInfo->bunk_bed)?$rowInfo->bunk_bed:"";?>">
                    <br><small>Variable Size</small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Sofa Bed :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="sofa_bed" id="sofa_bed" value="<?php echo !empty($rowInfo->sofa_bed)?$rowInfo->sofa_bed:"";?>">
                    <br><small>Variable Size</small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">Futon Bed :</label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[length[0,2]]" type="text" name="futon_bed" id="futon_bed" value="<?php echo !empty($rowInfo->futon_bed)?$rowInfo->futon_bed:"";?>">
                    <br><small>Variable Size</small>
                </div>                
            </div>
            


            <!-- Feature Listing -->
            <?php $svfr = !empty($rowInfo->feature)?$rowInfo->feature:'';
            $saveRec =  unserialize($svfr);    
            $RecFearures = Roomfeatures::find_all_byparent(0);
                if($RecFearures){ 
                    foreach($RecFearures as $recRow){ ?>
            <div class="form-row">  
                <div class="form-label col-md-2">
                    <label for="">
                        <?php echo $recRow->title;?> :
                    </label>
                </div>   
<?php 
$savedTitle  =   isset(  $saveRec[$recRow->id]['name'] ) ?  $saveRec[$recRow->id]['name'] : $recRow->title;
?>
                <div class="form-checkbox-radio col-md-10 form-input">                   
                    <input type="text" placeholder="Title" class="col-md-4 validate[length[0,250]]" name="fparent[<?php echo $recRow->id;?>][name]" value="<?php echo $savedTitle;?>">
                    <div class="clear"></div>
<?php 
$savedFeatures  =   isset(  $saveRec[$recRow->id]['features'] ) ?  $saveRec[$recRow->id]['features'] : array();
$childRec = Roomfeatures::find_all_byparent($recRow->id);
if($childRec){
    $i=1;
    foreach($childRec as $childRow){  $child_id  =  $childRow->id;
$check='';
$child_title=isset($savedFeatures[$child_id]['id'])?$savedFeatures[$child_id]['title'] :$childRow->title;
$child_icon =isset($savedFeatures[$child_id]['id'])?$savedFeatures[$child_id]['icon_class']:$childRow->icon_class; 
$check =  isset( $savedFeatures[$child_id]['id'] ) ? 'checked="checked"' : ''; ?>
<div><input type="checkbox" class="custom-radio" name="feature[<?php echo $recRow->id;?>][<?php echo $child_id;?>][id]" value="<?php echo $childRow->id;?>" <?php echo $check;?>>
<input type="text" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]" name="feature[<?php echo $recRow->id;?>][<?php echo $child_id;?>][icon_class]" value="<?php echo $child_icon;?>">
<input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]" name="feature[<?php echo $recRow->id;?>][<?php echo $child_id;?>][title]" value="<?php echo $child_title;?>"><br></div>
<?php
        $i++;       
    }
} ?>

<?php 
if(sizeof($savedFeatures)>0 and is_array($savedFeatures)){
    $i=1;
    foreach($savedFeatures as $childKey=>$childRow){  $child_id  =  $childKey;
    $id_arr=array();if($childRec){foreach($childRec as $childRows){$id_arr[] = $childRows->id;}}
    if(!in_array($child_id,$id_arr)): 
        $check =  isset($childRow['id']) ?  'checked="checked"' : ''; ?>
<div><input type="checkbox" class="custom-radio" name="feature[<?php echo $recRow->id;?>][<?php echo $child_id;?>][id]" value="<?php echo $child_id;?>" <?php echo $check;?>>
<input type="text" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]" name="feature[<?php echo $recRow->id;?>][<?php echo $child_id;?>][icon_class]" value="<?php echo $childRow['icon_class'];?>">
<input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]" name="feature[<?php echo $recRow->id;?>][<?php echo $child_id;?>][title]" value="<?php echo $childRow['title'];?>">
<span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br></div>
<?php
        $i++;
      endif; //inarray 
    }
} ?>

                    <div id="add_option_div<?php echo $recRow->id;?>"></div>
            <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" title="Add" onclick="addFeaturesRows('<?php echo $recRow->id;?>');">
                            <i class="glyph-icon icon-plus-square"></i>
                       </a>
                </div>                                          
            </div> 
            <?php   } 
            }?> 


      <?php 
      $id_arr=array();if($RecFearures){foreach($RecFearures as $rr){$id_arr[] = $rr->id;}}
      if(is_array($saveRec) and sizeof($saveRec)>0){ 
                    foreach($saveRec as $recRow){
               if(!in_array($recRow['id'],$id_arr)): 
         ?>
            <div class="form-row">  
                <div class="form-label col-md-2">
                    <label for="">
                        <?php echo $recRow['name'];?> :
                    </label>
                </div>   

                <div class="form-checkbox-radio col-md-10 form-input">                   
                    <input type="text" placeholder="Title" class="col-md-4 validate[length[0,250]]" name="fparent[<?php echo $recRow['id'];?>][name]" value="<?php echo $recRow['name'];?>">
                    <div class="clear"></div>
<?php 
if(sizeof($recRow['features'])>0){
    $i=1;
    foreach($recRow['features'] as $childKey=>$childRow){  $child_id  =  $childKey;
        $check =  isset($childRow['id']) ?  'checked="checked"' : ''; ?>
<div><input type="checkbox" class="custom-radio" name="feature[<?php echo $recRow['id'];?>][<?php echo $child_id;?>][id]" value="<?php echo $child_id;?>" <?php echo $check;?>>
<input type="text" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]" name="feature[<?php echo $recRow['id'];?>][<?php echo $child_id;?>][icon_class]" value="<?php echo $childRow['icon_class'];?>">
<input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]" name="feature[<?php echo $recRow['id'];?>][<?php echo $child_id;?>][title]" value="<?php echo $childRow['title'];?>">
<span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br></div>
<?php
        $i++;
       
    }
} ?>
                    <div id="add_option_div<?php echo $recRow['id'];?>"></div>
            <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" title="Add" onclick="addFeaturesRows('<?php echo $recRow['id'];?>');">
                            <i class="glyph-icon icon-plus-square"></i>
                       </a>
                </div>                                          
            </div> 
            <?php 
                endif;
              } 
            }?> 

            
            <div id="add_facility_div"></div>

            <div class="form-row">  
                <div class="form-label col-md-2">
                    <label for="">Add Facility</label>
                </div>   
                <div class="form-checkbox-radio col-md-10 form-input">                   
            <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" title="Add" onclick="addFacilityRows();"><i class="glyph-icon icon-plus-square"></i></a>
                </div>                                          
            </div>    
            <hr />
            <div class="form-row add-image">
                <div class="form-label col-md-2">
                    <label for="">
                        Banner Image :
                    </label>
                </div> 
                <div class="form-input col-md-10 uploader">          
                   <input type="file" name="banner_image_upload" id="banner_image_upload" class="transparent no-shadow">
                </div>                
                <!-- Upload user image preview -->
                <div id="preview_Image2"><input type="hidden" name="imageArrayname2" /></div>
            </div>      

            <div class="form-row">
            <?php 
                if(!empty($rowInfo->banner_image)):
                   $imageRow2 = $rowInfo->banner_image; ?>
                        <div class="col-md-3" id="removeSavedimg001">
                           <?php   
                           if(file_exists(SITE_ROOT."images/roomapi/banner_image/".$imageRow2)):?>
                            <div class="infobox info-bg">                                                               
                                <div class="button-group" data-toggle="buttons">
                                    <span class="float-left">
                                <?php                                           
                                $filesize = filesize(SITE_ROOT."images/roomapi/banner_image/".$imageRow2);
                                echo 'Size : '.getFileFormattedSize($filesize);                                       
                                ?>
                                    </span> 
                                    <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedPackageimage('001');">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>                                                       
                                </div>
                                <img src="<?php echo IMAGE_PATH.'roomapi/banner_image/thumbnails/'.$imageRow2;?>"  style="width:100%"/>                                                                                   
                                <input type="hidden" name="imageArrayname2" value="<?php echo $imageRow2;?>" />
                            </div> 
                             <?php endif;?>
                        </div>
                <?php endif;?>
            </div>           
                     
            <div class="form-row add-image">
                <div class="form-label col-md-2">
                    <label for="">
                         Image :
                    </label>
                </div> 
                <div class="form-input col-md-10 uploader">          
                   <input type="file" name="image_upload" id="image_upload" class="transparent no-shadow">
                </div>                
                <!-- Upload user image preview -->
                <div id="preview_Image"><input type="hidden" name="imageArrayname[]" /></div>
            </div>      

            <hr />

            <div class="form-row">
            <?php 
                if(!empty($rowInfo->image)):
                    $imageRec = unserialize($rowInfo->image);
                if($imageRec):
                    foreach($imageRec as $k=>$imageRow): ?>
                        <div class="col-md-3" id="removeSavedimg<?php echo $k;?>">
                            <div class="infobox info-bg">                                                               
                                <div class="button-group" data-toggle="buttons">
                                    <span class="float-left">
                                        <?php 
                                            if(file_exists(SITE_ROOT."images/roomapi/".$imageRow)):
                                                $filesize = filesize(SITE_ROOT."images/roomapi/".$imageRow);
                                                echo 'Size : '.getFileFormattedSize($filesize);
                                            endif;
                                        ?>
                                    </span> 
                                    <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedPackageimage(<?php echo $k;?>);">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>                                                       
                                </div>
                                <img src="<?php echo IMAGE_PATH.'roomapi/thumbnails/'.$imageRow;?>"  style="width:100%"/>                                                                                   
                                <input type="hidden" name="imageArrayname[]" value="<?php echo $imageRow;?>" />
                            </div> 
                        </div>
                <?php endforeach;
                endif;
                endif;?>
            </div>
   

        

            <div class="form-row">                  
                <div class="form-label col-md-2">
                    <label for="">
                        Short Details :
                    </label>
                </div>                
                <div class="form-input col-md-8">
                    <textarea name="detail" id="detail" class="medium-textarea"><?php echo !empty($rowInfo->detail)?$rowInfo->detail:"";?></textarea>                    
                </div>            
            </div> 

            <div class="form-row">
                <div class="form-label col-md-12">
                    <label for="">
                        Content :
                    </label>
                    <textarea name="content" id="content" class="large-textarea"><?php echo !empty($rowInfo->content)?$rowInfo->content:"";?></textarea>
                    <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore" href="javascript:void(0);">
                        <span class="button-content">Read More</span>
                    </a>
                </div>            
            </div>    
            
            <h3>No. of Room and Prices</h3>
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        No. of Rooms :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="No. of Rooms" class="col-md-3 validate[length[0,2]]" type="text" name="no_rooms" id="no_rooms" value="<?php echo !empty($rowInfo->no_rooms)?$rowInfo->no_rooms:"";?>">
                </div>                
            </div> 

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Max Persons :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[required,custom[integer],length[0,2]]" type="text" name="max_people" id="max_people" value="<?php echo !empty($rowInfo->max_people)?$rowInfo->max_people:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Max Children :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[required,custom[integer],length[0,2]]" type="text" name="max_child" id="max_child" value="<?php echo !empty($rowInfo->max_child)?$rowInfo->max_child:"";?>">
                    <br><small>This is the maximum number of children that can stay in this room for free. The maximum age of these children is 6. </small>
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Currency :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Currency" class="col-md-3 validate[length[0,5]]" type="text" name="currency" id="currency" value="<?php echo !empty($rowInfo->currency)?$rowInfo->currency:"";?>">
                </div>                
            </div> 




                          

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label class="text-right">Default Price</label>                    
               </div>
               <?php $sbpkg = !empty($rowInfo->id)?$rowInfo->id:0;
               $rec2 = Roomapiprice::find_by_rsid($sbpkg); ?>
                <div class="form-input col-md-10">
                    <div class="col-md-2 hide rmovprice1">             
                        <label>1 no. of: </label>
                        <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[0][]" id="room_price1" value="<?php echo !empty($rec2->one_person)?$rec2->one_person:'';?>">
                    </div>
                    <div class="col-md-2 hide rmovprice2">
                        <label>2 no. of: </label>
                        <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[0][]" id="room_price2" value="<?php echo !empty($rec2->two_person)?$rec2->two_person:'';?>">
                    </div>
                    <div class="col-md-2 hide rmovprice3">
                        <label>3 no. of: </label>
                        <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[0][]" id="room_price3" value="<?php echo !empty($rec2->three_person)?$rec2->three_person:'';?>">
                    </div>
                    <div class="col-md-2 hide rmovprice4">
                        <label>Extra Bed: </label>
                        <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[0][]" id="room_price4" value="<?php echo !empty($rec2->extra_bed)?$rec2->extra_bed:'';?>">
                    </div>
                </div>                
            </div> 
            <?php $sesrec = Season::get_all();
            if($sesrec){
                foreach($sesrec as $sesrow){ 
                    $rec = Roomapiprice::find_by_rsid($sbpkg,$sesrow->id); 
                    ?>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label class="text-right"><?php echo $sesrow->season;?> Price</label>                        
                    </div>                
                    <div class="form-input col-md-10">       
                        <div class="col-md-2 hide rmovprice1">             
                            <label>1 no. of: </label>
                            <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[<?php echo $sesrow->id;?>][]" id="room_price1" value="<?php echo !empty($rec->one_person)?$rec->one_person:'';?>">
                        </div>
                        <div class="col-md-2 hide rmovprice2">
                            <label>2 no. of: </label>
                            <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[<?php echo $sesrow->id;?>][]" id="room_price2" value="<?php echo !empty($rec->two_person)?$rec->two_person:'';?>">
                        </div>
                        <div class="col-md-2 hide rmovprice3">
                            <label>3 no. of: </label>
                            <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[<?php echo $sesrow->id;?>][]" id="room_price3" value="<?php echo !empty($rec->three_person)?$rec->three_person:'';?>">
                        </div>
                        <div class="col-md-2 hide rmovprice4">
                            <label>Extra Bed: </label>
                            <input placeholder="Price" class="validate[groupRequired,length[0,7]]" type="text" name="room_price[<?php echo $sesrow->id;?>][]" id="room_price4" value="<?php echo !empty($rec->extra_bed)?$rec->extra_bed:'';?>">
                        </div>
                    </div>                
                </div>  
            <?php  }
            } 
            ?>
            

              <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Extra Bed :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input class="col-md-2 validate[required,custom[integer],length[0,2]]" type="text" name="extra_bed" id="extra_bed" value="<?php echo !empty($rowInfo->extra_bed)?$rowInfo->extra_bed:"";?>">
                </div>                
            </div>
            

            <div class="form-row">   
                <div class="form-label col-md-2">
                    <label for="">
                        Published :
                    </label>
                </div>             
                <div class="form-checkbox-radio col-md-9">
                    <input type="radio" class="custom-radio" name="status" id="check1" value="1" <?php echo !empty($status)?$status:"checked";?>>
                    <label for="">Published</label>
                    <input type="radio" class="custom-radio" name="status" id="check0" value="0" <?php echo !empty($unstatus)?$unstatus:"";?>>
                    <label for="">Un-Published</label>
                </div>                
            </div> 
                                   
            <button btn-action='0' type="submit" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
            </button>
            <button btn-action='1' type="submit" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save & More
                </span>
            </button>
            <button btn-action='2' type="submit" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save & quit
                </span>
            </button>
            <input myaction='0' type="hidden" name="idValue" id="idValue" value="<?php echo !empty($rowInfo->id)?$rowInfo->id:0;?>" />
         </form>    
    </div>
</div>  
<script>
var base_url =  "<?php echo ASSETS_PATH; ?>";
var editor_arr = ["content"];
create_editor(base_url,editor_arr);
</script>

<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo ASSETS_PATH;?>uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript">
   // <![CDATA[
$(document).ready(function() {
    $('#image_upload').uploadify({
    'swf'  : '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
    'uploader'    : '<?php echo ASSETS_PATH;?>uploadify/image_uploadify.php',
    'formData'      : {PROJECT : '<?php echo SITE_FOLDER;?>',targetFolder:'images/roomapi/',thumb_width:360,thumb_height:270},
    'method'   : 'post',
    'cancelImg' : '<?php echo BASE_URL;?>uploadify/cancel.png',
    'auto'      : true,
    'multi'     : true, 
    'hideButton': false,    
    'buttonText' : 'Upload Image',
    'width'     : 125,
    'height'    : 21,
    'removeCompleted' : true,
    'progressData' : 'speed',
    'uploadLimit' : 100,
    'fileTypeExts' : '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
     'buttonClass' : 'button formButtons',
   /* 'checkExisting' : '/uploadify/check-exists.php',*/
    'onUploadSuccess' : function(file, data, response) {
        $('#uploadedImageName').val('1');
        var filename =  data;
        $.post('<?php echo BASE_URL;?>apanel/roomapi/uploaded_image.php',{imagefile:filename},function(msg){            
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
    
    $('#banner_image_upload').uploadify({
        'swf'  : '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
        'uploader'    : '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
        'formData'      : {PROJECT : '<?php echo SITE_FOLDER;?>',targetFolder:'images/roomapi/banner_image/',thumb_width:380,thumb_height:478},
        'method'   : 'post',
        'cancelImg' : '<?php echo BASE_URL;?>uploadify/cancel.png',
        'auto'      : true,
        'multi'     : false, 
        'hideButton': false,    
        'buttonText' : 'Upload Image',
        'width'     : 125,
        'height'    : 21,
        'removeCompleted' : true,
        'progressData' : 'speed',
        'uploadLimit' : 100,
        'fileTypeExts' : '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
         'buttonClass' : 'button formButtons',
       /* 'checkExisting' : '/uploadify/check-exists.php',*/
        'onUploadSuccess' : function(file, data, response) {
            $('#uploadedImageName').val('1');
            var filename =  data;
            $.post('<?php echo BASE_URL;?>apanel/roomapi/uploaded_banner_image.php',{imagefile:filename},function(msg){            
                   $('#preview_Image2').html(msg).show();
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
<?php endif; ?>