<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename    = "tbl_review"; // Database table name
$moduleId           = 31;              // module id >>>>> tbl_modules
$moduleFoldername   = "reviews";     // Image folder name

$hotel_id = Hotelapi::find_by_sql("SELECT id FROM tbl_apihotel order by id DESC LIMIT 1");
clearImages($moduleTablename, $moduleFoldername . "/banner", "banner_image");
    clearImages($moduleTablename, $moduleFoldername . "/banner/thumbnails", "banner_image");
foreach($hotel_id as $h_id){
    $u_hotel_id      = $h_id->id;
}
if(!empty($session->get('review_hotel_id'))){
    $user_hotel_id      = $session->get('review_hotel_id');
}
else{
    $user_hotel_id = $session->get($u_hotel_id);
}
$hotel_detail       = Hotelapi::find_by_id($user_hotel_id);

if (isset($_GET['page']) && $_GET['page'] == "review" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
    <h3>
        Manage Reviews of

        <?php 
            $hotels = Hotelapi::find_all($session->get('id'));
            if(! empty($hotels)) {
                
                $hotel_select_html = '<div class="pad0L col-md-3"><select class="user-hotel-select">';
                foreach ($hotels as $hotel) {
                    $hotel_select_html .= '<option value="' . $hotel->id . '" ' . ($hotel->id == $user_hotel_id ? ' selected' : '') . '>' . $hotel->title . '</option>';
                }
                $hotel_select_html .= '</select></div>';
                echo $hotel_select_html;
            }
        ?>
        
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="addReview();">
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
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
                    <th class="text-center">Name</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = Review::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE 1=1 and hotel_id='" . $user_hotel_id . "' ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td>
                            <div class="col-md-7">
                                <a href="javascript:void(0);" onClick="editReview(<?php echo $record->id; ?>);" class="loadingbar-demo"
                                   title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <a href="javascript:void(0);" class="btn small <?php echo $statusImage; ?> tooltip-button statusToggler"
                               data-placement="top" title="<?php echo $statusText; ?>" status="<?php echo $record->status; ?>"
                               id="imgHolder_<?php echo $record->id; ?>" moduleId="<?php echo $record->id; ?>">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                               data-placement="top" title="View detail" onclick="editReview(<?php echo $record->id; ?>);">
                                <!--<span class="button-content"> View Detail </span>-->
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                               onclick="recordReviewDelete(<?php echo $record->id; ?>);">
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
        <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
        <span class="glyph-icon icon-separator float-right">
          <i class="glyph-icon icon-cog"></i>
        </span>
            <span class="button-content"> Click </span>
        </a>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $reviewId = addslashes($_REQUEST['id']);
        $reviewInfo = Review::find_by_id($reviewId);

        $status = ($reviewInfo->status == 1) ? "checked" : " ";
        $unstatus = ($reviewInfo->status == 0) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'View Review' : 'View Review'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewreviewlist();">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-arrow-circle-left"></i>
            </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="user_review_frm">
                <!--
                <div class="form-row ">
                    <div class="form-label col-md-2">
                        <label for="">
                            User
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <select name="user_id" id="user_id" class="form-control validate[required]">
                            <option value="">Choose User</option>
                            <?php $desId = !empty($reviewInfo->user_id) ? $reviewInfo->user_id : 0;
                echo Hoteluser::get_user_option($desId); ?>
                        </select>
                    </div>
                </div>
                -->

                <!--
                <div class="form-row ">
                    <div class="form-label col-md-2">
                        <label for="">
                            Hotel
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <select name="hotel_id" id="hotel_id" class="form-control validate[required]">
                            <option value="">Choose Hotel</option>
                            <?php $desId = !empty($reviewInfo->hotel_id) ? $reviewInfo->hotel_id : 0;
                            echo Hotelapi::get_user_option($desId); ?>
                        </select>
                    </div>
                </div>
                -->

                <div class="form-row ">
                    <div class="form-label col-md-2">
                        <label for="">
                            User Title
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="User Title" class="col-md-6 validate[required,length[0,150]]" type="text" name="title" id="title"
                               value="<?php echo !empty($reviewInfo->title) ? $reviewInfo->title : ""; ?>">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Name :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Name" class="col-md-6 validate[required,length[0,200]]" type="text"
                               name="name" id="name"
                               value="<?php echo !empty($reviewInfo->name) ? $reviewInfo->name : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Email :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Email" class="col-md-6 validate[required,length[0,200]]" type="text"
                               name="email" id="email"
                               value="<?php echo !empty($reviewInfo->email) ? $reviewInfo->email : ""; ?>">
                    </div>
                </div>
                  
                <!-- <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Profile Image :
                        </label>
                    </div>

                    <?php if (!empty($reviewInfo->banner_image)): ?>
                        <div class="col-md-3" id="removeSavedimg<?php echo $reviewInfo->id; ?>">
                            <div class="infobox info-bg">
                                <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                                if (file_exists(SITE_ROOT . "images/reviews/banner/" . $reviewInfo->banner_image)):
                                    $filesize = filesize(SITE_ROOT . "images/reviews/banner/" . $reviewInfo->banner_image);
                                    echo 'Size : ' . getFileFormattedSize($filesize);
                                endif;
                                ?>
                            </span>
                                    <a class="btn small float-right" href="javascript:void(0);"
                                       onclick="deleteSavedreviewimage('<?php echo $reviewInfo->id; ?>');">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>
                                </div>
                                <img src="<?php echo IMAGE_PATH . 'reviews/banner/thumbnails/' . $reviewInfo->banner_image; ?>"
                                     style="width:100%"/>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="banner_upload" id="banner_upload" class="transparent no-shadow">
                        <label>
                            <small>Image Dimensions (1353px X 253px)</small>
                        </label>
                    </div>
                    <div id="previewUserimage"><input type="hidden" name="imageArrayname2"
                                                    value="<?php echo !empty($reviewInfo->banner_image) ? $reviewInfo->banner_image : ""; ?>"
                                                    class=""/></div>
                </div> -->
               

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                        Country :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Country" class="col-md-6 validate[required,length[0,200]]" type="text"
                               name="country" id="country"
                               value="<?php echo !empty($reviewInfo->country) ? $reviewInfo->country : ""; ?>">
                    </div>
                </div>

                <div class="hide form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                        Subject :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Subject" class="col-md-6 validate[required,length[0,200]]" type="text"
                               name="subject" id="subject"
                               value="<?php echo !empty($reviewInfo->subject) ? $reviewInfo->subject : ""; ?>">
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-label col-md-6">
                        <label for="">
                            Message :
                        </label>
                        <div class="form-input">
                            <textarea name="message" id="message"
                                        class="medium-textarea"><?php echo !empty($reviewInfo->message) ? $reviewInfo->message : ""; ?></textarea>
                        </div>
                    </div>
                </div> -->

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Rating :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <select class="col-md-6" name="rating" id="rating">
                            <option value="<?php echo !empty($reviewInfo->rating) ? $reviewInfo->rating : "0"; ?>"
                                    selected="selected">
                                <?php echo !empty($reviewInfo->rating) ? $reviewInfo->rating : "Rating"; ?></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Message :
                        </label>
                        <textarea name="review" id="review"
                                  class="medium-textarea"><?php echo !empty($reviewInfo->review) ? $reviewInfo->review : ""; ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Status :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1"
                               value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0"
                               value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                        <label for="">Un-Published</label>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                    <span class="button-content">
                        Save
                    </span>
                </button>
                <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($reviewInfo->id) ? $reviewInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>

    <script>
        var base_url = "<?php echo ASSETS_PATH; ?>";
        var editor_arr = ["review"];
        // create_editor(base_url, editor_arr);
    </script>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        $('#banner_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/reviews/banner/',
                    thumb_width: 200,
                    thumb_height: 200
                },
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
                    $('#uploadedImageName2').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/review/banner_image.php', {imagefile: filename}, function (msg) {
                        $('#previewUserimage').html(msg).show();
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
    </script>
<?php endif; ?>