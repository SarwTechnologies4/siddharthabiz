<?php
$tablename = "tbl_hall"; // Database table name

if (isset($_GET['page']) && $_GET['page'] == "hotelapi" && isset($_GET['mode']) && $_GET['mode'] == "halllist"):
    $user_hotel_id  = intval(addslashes($_GET['id']));
    $hotel_detail   = Hotelapi::find_by_id($user_hotel_id);

    JsonclearImagesNorace($tablename, "hallapi");
    JsonclearImagesNorace($tablename, "hallapi/thumbnails");

    clearImages($tablename, "hallapi/banner_image", "banner_image");
    clearImages($tablename, "hallapi/banner_image/thumbnails", "banner_image");
    ?>
    <h3>
        Manage halls <?php echo "'s of " . $hotel_detail->title; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="addNewhall(<?php echo $user_hotel_id; ?>);">
            <span class="glyph-icon icon-separator"><i class="glyph-icon icon-plus-square"></i></span>
            <span class="button-content"> Add New </span>
        </a>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right mrg5R" href="javascript:void(0);" onClick="viewHotellist();">
            <span class="glyph-icon icon-separator"><i class="glyph-icon icon-arrow-circle-left"></i></span>
            <span class="button-content"> Back </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="hallListTable">
                <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
                    <th class="text-left">Title</th>
                    <th>Status</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = hallapi::find_by_sql("SELECT * FROM " . $tablename . " WHERE 1=1 and hotel_id='" . $user_hotel_id . "' ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td><a href="javascript:void(0);" onClick="edithall(<?php echo $record->hotel_id; ?>,<?php echo $record->id; ?>);" class="loadingbar-demo"
                               title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <a href="javascript:void(0);" class="btn small <?php echo $statusImage; ?> tooltip-button" data-placement="top"
                               title="<?php echo $statusText; ?>" id="imgHolder_<?php echo $record->id; ?>"
                               onclick="statusTogglehall(<?php echo $record->id; ?>,<?php echo $record->status; ?>);">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top" title="Edit"
                               onclick="edithall(<?php echo $record->hotel_id; ?>,<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                               onclick="deletehall(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-remove"></i>
                            </a>
                            <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pad0L col-md-2">
            <select name="dropdown" id="groupTaskField" class="custom-select">
                <option value="0"><?php echo $GLOBALS['basic']['choseAction']; ?></option>
                <option value="delete"><?php echo $GLOBALS['basic']['delete']; ?></option>
                <option value="toggleStatus"><?php echo $GLOBALS['basic']['toggleStatus']; ?></option>
            </select>
        </div>
        <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn_hall">
            <span class="glyph-icon icon-separator float-right"><i class="glyph-icon icon-cog"></i></span>
            <span class="button-content"> Submit </span>
        </a>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "hallAddEdit"):
    $pid            = addslashes($_REQUEST['id']);
    $user_hotel_id  = $pid;
    $hotel_detail   = Hotelapi::find_by_id($pid);
    if (isset($_GET['subid']) and !empty($_GET['subid'])):
        $rowId      = addslashes($_REQUEST['subid']);
        $rowInfo    = hallapi::find_by_id($rowId);

        $status     = ($rowInfo->status == 1) ? "checked" : " ";
        $unstatus   = ($rowInfo->status == 0) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['subid'])) ? 'Edit hall' : 'Add hall'; ?><?php echo " [" . $hotel_detail->title . "]"; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewhallList(<?= $pid ?>);">
            <span class="glyph-icon icon-separator"><i class="glyph-icon icon-arrow-circle-left"></i></span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" method="post" class="col-md-12 center-margin" id="hallapi_frm">

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Title :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="hall Title" class="col-md-12 validate[required,length[0,100]]" type="text" name="title" id="title"
                               value="<?php echo !empty($rowInfo->title) ? $rowInfo->title : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Area :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input class="col-md-2 validate[required,length[0,20]]" type="text" name="hall_size" id="hall_size"
                               value="<?php echo !empty($rowInfo->hall_size) ? $rowInfo->hall_size : ""; ?>">
                        square
                        <select name="hall_size_label" id="hall_size_label" class="col-md-2">
                            <option value="meters" <?php echo (!empty($rowInfo->hall_size_label) && $rowInfo->hall_size_label == 'meters') ? "selected" : ""; ?> >Meters
                            </option>
                            <option value="feet" <?php echo (!empty($rowInfo->hall_size_label) && $rowInfo->hall_size_label == 'feet') ? "selected" : ""; ?> >Feet
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Dimension :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Size in sq.ft" class="col-md-3 validate[length[0,2]]" type="text" name="no_hall" id="no_hall"
                               value="<?php echo !empty($rowInfo->no_hall) ? $rowInfo->no_hall : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Capacity :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-2 validate[required,length[0,2]]" type="text" name="max_people" id="max_people"
                               value="<?php echo !empty($rowInfo->max_people) ? $rowInfo->max_people : ''; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Height :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Feet" class="col-md-2 validate[required,length[0,2]]" type="text" name="max_child" id="max_child"
                               value="<?php echo !empty($rowInfo->max_child) ? $rowInfo->max_child : ''; ?>">
                    </div>
                </div>
                
                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Banner Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="banner_image_upload" id="banner_image_upload" class="transparent no-shadow">
                        <label><small>Image Dimensions (2880 px X 860 px)</small></label>
                    </div>
                    <div id="preview_Image2"><input type="hidden" name="imageArrayname2"/></div>
                </div>

                <div class="form-row">
                    <?php
                    if (!empty($rowInfo->banner_image)):
                        $imageRow2 = $rowInfo->banner_image; ?>
                        <div class="col-md-3" id="removeSavedimg001">
                            <?php
                            if (file_exists(SITE_ROOT . "images/hallapi/banner_image/" . $imageRow2)):?>
                                <div class="infobox info-bg">
                                    <div class="button-group" data-toggle="buttons">
                                    <span class="float-left">
                                <?php
                                $filesize = filesize(SITE_ROOT . "images/hallapi/banner_image/" . $imageRow2);
                                echo 'Size : ' . getFileFormattedSize($filesize);
                                ?>
                                    </span>
                                        <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedimage('001');">
                                            <i class="glyph-icon icon-trash-o"></i>
                                        </a>
                                    </div>
                                    <img src="<?php echo IMAGE_PATH . 'hallapi/banner_image/thumbnails/' . $imageRow2; ?>" style="width:100%"/>
                                    <input type="hidden" name="imageArrayname2" value="<?php echo $imageRow2; ?>"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
               

                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="image_upload" id="image_upload" class="transparent no-shadow">
                        <label><small>Image Dimensions (980 px X 653 px)</small></label>
                    </div>
                    <div id="preview_Image"><input type="hidden" name="imageArrayname[]"/></div>
                </div>

                <div class="form-row">
                    <?php
                    if (!empty($rowInfo->image)):
                        $imageRec = unserialize(base64_decode($rowInfo->image));

                        if ($imageRec):
                            foreach ($imageRec as $k => $imageRow): ?>
                                <div class="col-md-3" id="removeSavedimg<?php echo $k; ?>">
                                    <div class="infobox info-bg">
                                        <div class="button-group" data-toggle="buttons">
                                    <span class="float-left">
                                        <?php
                                        if (file_exists(SITE_ROOT . "images/hallapi/" . $imageRow)):
                                            $filesize = filesize(SITE_ROOT . "images/hallapi/" . $imageRow);
                                            echo 'Size : ' . getFileFormattedSize($filesize);
                                        endif;
                                        ?>
                                    </span>
                                            <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedimage(<?php echo $k; ?>);">
                                                <i class="glyph-icon icon-trash-o"></i>
                                            </a>
                                        </div>
                                        <img src="<?php echo IMAGE_PATH . 'hallapi/thumbnails/' . $imageRow; ?>" style="width:100%"/>
                                        <input type="hidden" name="imageArrayname[]" value="<?php echo $imageRow; ?>"/>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif;
                    endif; ?>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Theatre:
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-12 validate[required,length[0,2]]" type="text" name="seat_a" id="seat_a"
                               value="<?php echo !empty($rowInfo->seat_a) ? $rowInfo->seat_a: ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Circular :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-12 validate[required,length[0,2]]" type="text" name="seat_b" id="seat_b"
                               value="<?php echo !empty($rowInfo->seat_b) ? $rowInfo->seat_b: ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            U-shaped :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-12 validate[required,length[0,2]]" type="text" name="seat_c" id="seat_c"
                               value="<?php echo !empty($rowInfo->seat_c) ? $rowInfo->seat_c: ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Class-room :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-12 validate[required,length[0,2]]" type="text" name="seat_d" id="seat_d"
                               value="<?php echo !empty($rowInfo->seat_d) ? $rowInfo->seat_d: ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Sit-down :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-12 validate[required,length[0,2]]" type="text" name="seat_e" id="seat_e"
                               value="<?php echo !empty($rowInfo->seat_e) ? $rowInfo->seat_e: ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Reception :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Pax" class="col-md-12 validate[required,length[0,2]]" type="text" name="seat_f" id="seat_f"
                               value="<?php echo !empty($rowInfo->seat_e) ? $rowInfo->seat_f : ""; ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Short Details :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <textarea name="detail" id="detail" class="medium-textarea"><?php echo !empty($rowInfo->detail) ? $rowInfo->detail : ""; ?></textarea>
                    </div>
                </div>
               

                

                
                
               

                <div class="form-row">              
                <div class="form-checkbox-radio col-md-9">
                	<a class="btn medium bg-blue" href="javascript:void(0);" onClick="toggleMetadata();">
                        <span class="glyph-icon icon-separator float-right">
                        	<i class="glyph-icon icon-caret-down"></i>
                        </span>
                        <span class="button-content"> Metadata Info </span>
                    </a>
                </div>                
            </div>  
            <div class="form-row <?php echo (!empty($rowInfo->meta_keywords) || !empty($rowInfo->meta_description))?'':'hide';?> metadata">   
            	<div class="col-md-6">
                	<textarea placeholder="Meta Keyword" name="meta_keywords" id="meta_keywords" class="character-keyword validate[required]"><?php echo !empty($rowInfo->meta_keywords)?$rowInfo->meta_keywords:"";?></textarea>
                    <div class="keyword-remaining clear input-description">250 characters left</div>
                </div>  
                <div class="col-md-6">
                	<textarea placeholder="Meta Description" name="meta_description" id="meta_description" class="character-description validate[required]"><?php echo !empty($rowInfo->meta_description)?$rowInfo->meta_description:"";?></textarea>
                    <div class="description-remaining clear input-description">160 characters left</div>
                </div>                
            </div>


                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Published :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1" value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0" value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                        <label for="">Un-Published</label>
                    </div>
                </div>

                <button btn-action='0' type="submit" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <button btn-action='1' type="submit" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save & More
                </span>
                </button>
                <button btn-action='2' type="submit" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save & quit
                </span>
                </button>
                <input myaction='0' type="hidden" name="idValue" id="idValue" value="<?php echo !empty($rowInfo->id) ? $rowInfo->id : 0; ?>"/>
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $pid; ?>"/>
            </form>
        </div>
    </div>
    <script>
        var base_url = "<?php echo ASSETS_PATH; ?>";
        var editor_arr = [];
        create_editor(base_url, editor_arr);
    </script>

    <link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#image_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/image_uploadify.php',
                'formData': {PROJECT: '<?php echo SITE_FOLDER;?>', targetFolder: 'images/hallapi/', thumb_width: 360, thumb_height: 270},
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': true,
                'hideButton': false,
                'buttonText': 'Upload Image',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    $('#uploadedImageName').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_hall_image.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image').append(msg).show();
                    });

                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });

            $('#banner_image_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {PROJECT: '<?php echo SITE_FOLDER;?>', targetFolder: 'images/hallapi/banner_image/', thumb_width: 380, thumb_height: 478},
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': false,
                'hideButton': false,
                'buttonText': 'Upload Image',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    $('#uploadedImageName').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_banner_image.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image2').html(msg).show();
                    });

                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });
        });
        // ]]>
    </script>
<?php endif; ?>