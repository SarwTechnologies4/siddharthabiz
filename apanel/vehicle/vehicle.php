<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename = "tbl_vehicle"; // Database table name
$moduleId = 49;                // module id >>>>> tbl_modules
$moduleFoldername = "vehicle";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "vehicle" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    @JsonclearImages($moduleTablename, $moduleFoldername);
    @JsonclearImages($moduleTablename, $moduleFoldername . "/thumbnails");

    @JsonclearImages($moduleTablename, $moduleFoldername. "/billbook" , "bill_book_image");
    @JsonclearImages($moduleTablename, $moduleFoldername . "/billbook/thumbnails" , "bill_book_image");
    $parent_id = (isset($_REQUEST['id']) and !empty($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : 0;
    ?>
    <h3>
        List Vehicles
        <?php if (!empty($_REQUEST['id'])) {
            $parentVehicle = Vehicle::find_by_id($parent_id);
            echo " of : " . $parentVehicle->title;
        } ?>

        <?php if (!empty($_REQUEST['id'])) { ?>
            <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewvehiclelist(0);"
               style="margin-left:2px;">
                    <span class="glyph-icon icon-separator">
                        <i class="glyph-icon icon-arrow-circle-left"></i>
                    </span>
                <span class="button-content"> Back </span>
            </a>
        <?php } ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewVehicles();">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-plus-square"></i>
            </span>
            <span class="button-content"> Add New </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <?php if ($loginUser->type == 'hotel') { ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                    <tr>
                        <th width="10%">S.No.</th>
                        <th class="text-center">Title</th>
                        <th class="text-center" width="10%">Occupancy</th>
                        <th class="text-center" width="10%">Parent</th>
                        <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                    </tr>
                    </thead>
                    <?php $records = Vehicle::find_all_byparent_by($loginUser->id);
                    foreach ($records as $key => $record): ?>
                        <tr id="<?php echo $record->id; ?>">
                            <td class="text-center"><?php echo $key + 1; ?></td>
                            <td>
                                <div class="col-md-7">
                                    <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);" class="loadingbar-demo"
                                       title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $record->max_pax; ?></td>
                            <td class="text-center"><?php echo Vehicle::field_by_id($record->parent_id, 'title'); ?></td>
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
                                <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top"
                                   title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                    <i class="glyph-icon icon-edit"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                                   onclick="recordDelete(<?php echo $record->id; ?>);">
                                    <i class="glyph-icon icon-remove"></i>
                                </a>
                                <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                    <tr>
                        <th width="10%">S.No.</th>
                        <th class="text-center">Title</th>
                        <th class="text-center" width="10%">Vehicle Child</th>
                        <th class="text-center" width="10%">Occupancy</th>
                        <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $records = Vehicle::find_all_byparent($parent_id);
                    foreach ($records as $key => $record): ?>
                        <tr id="<?php echo $record->id; ?>">
                            <td class="text-center"><?php echo $key + 1; ?></td>
                            <td>
                                <div class="col-md-7">
                                    <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);" class="loadingbar-demo"
                                       title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php $countChild = Vehicle::getTotalChild($record->id);
                                if ($countChild) { ?>
                                    <a class="primary-bg medium btn loadingbar-demo"
                                       title="" <?php echo ($countChild) ? 'onClick="viewvehiclelist(' . $record->id . ');"' : ''; ?>
                                       href="javascript:void(0);">
                                <span class="button-content">
                                    <span class="badge bg-orange radius-all-4 mrg5R" title=""
                                          data-original-title="Badge with tooltip"><?php echo $countChild; ?></span>
                                    <span class="text-transform-upr font-bold font-size-11">View Lists</span>
                                </span>
                                    </a>
                                <?php } else {
                                    echo 'N/A';
                                } ?>
                            </td>
                            <td class="text-center"><?php echo $record->max_pax; ?></td>
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
                                <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top"
                                   title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                    <i class="glyph-icon icon-edit"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                                   onclick="recordDelete(<?php echo $record->id; ?>);">
                                    <i class="glyph-icon icon-remove"></i>
                                </a>
                                <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>

    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $vehicleId = addslashes($_REQUEST['id']);
        $vehicleInfo = Vehicle::find_by_id($vehicleId);
        $status = ($vehicleInfo->status == 1) ? "checked" : " ";
        $unstatus = ($vehicleInfo->status == 0) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit Vehicle' : 'Add Vehicle'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="viewvehiclelist(<?php echo !empty($vehicleInfo->parent_id) ? $vehicleInfo->parent_id : 0; ?>);">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-arrow-circle-left"></i>
            </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="vehicle_frm">
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Parent :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <?php $Parentview = !empty($vehicleInfo->parent_id) ? $vehicleInfo->parent_id : 0;
                        echo Vehicle::get_parentList_bylevel(1, $Parentview); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Title :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Vehicle Title" class="col-md-6 validate[required,length[0,100]]" type="text" name="title" id="title"
                               value="<?php echo !empty($vehicleInfo->title) ? $vehicleInfo->title : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Registration Number :
                        </label>
                    </div>
                    <div class="form-input col-ms-20">
                        <input class="col-md-6 validate[length[0,255]]" type="text" name="reg_no" id="reg_no"
                               value="<?php echo !empty($vehicleInfo->reg_no) ? $vehicleInfo->reg_no : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Max Occupancy :
                        </label>
                    </div>
                    <div class="form-input">
                        <input class="col-md-2 validate[required,length[0,100]]" type="number" min="1" name="max_pax" id="max_pax"
                               value="<?php echo !empty($vehicleInfo->max_pax) ? $vehicleInfo->max_pax : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Year of Make :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <select class="chosen-select" name="make_year" id="make_year">
                            <option value="">Choose</option>
                            <?php
                            $currentYear = date('Y');
                            $pastYears = $currentYear - 40;
                            for ($i = $currentYear; $i > $pastYears; $i--) {
                                $sel = (!empty($vehicleInfo->make_year) and $vehicleInfo->make_year == $i) ? 'selected' : '';
                                ?>
                                <option value="<?= $i; ?>" <?= $sel; ?>><?= $i; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row ">
                    <div class="form-label col-md-2">
                        <label for="">
                            Bill Book :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploaderr">
                        <input type="file" name="bill_book_upload" id="bill_book_upload" class="transparent no-shadow">
                    </div>
                    <!-- Upload user image preview -->
                    <div id="preview_Bill_Book_Image"><input type="hidden" name="imageBillArrayname[]"/></div>
                    <?php
                    if (!empty($vehicleInfo->bill_book_image)) {
                        $imgRec = unserialize($vehicleInfo->bill_book_image);
                        if (is_array($imgRec)) {
                            foreach ($imgRec as $recimg) {
                                $deleteid = rand(0, 99999);
                                $imagePath = SITE_ROOT . 'images/vehicle/billbook/' . $recimg;
                                if (file_exists($imagePath)) { ?>
                                    <div class="col-md-3" id="removeSavedBillimg<?php echo $deleteid; ?>">
                                        <div class="infobox info-bg">
                                            <div class="button-group" data-toggle="buttons">
                                                <span class="float-left">
                                                    <?php
                                                    if (file_exists(SITE_ROOT . "images/vehicle/billbook/" . $recimg)):
                                                        $filesize = filesize(SITE_ROOT . "images/vehicle/billbook/" . $recimg);
                                                        echo 'Size : ' . getFileFormattedSize($filesize);
                                                    endif;
                                                    ?>
                                                </span>
                                                <a class="btn small float-right" href="javascript:void(0);"
                                                   onclick="deleteSavedVehiclesBillBookimage(<?php echo $deleteid; ?>);">
                                                    <i class="glyph-icon icon-trash-o"></i>
                                                </a>
                                            </div>
                                            <img src="<?php echo IMAGE_PATH . 'vehicle/billbook/thumbnails/' . $recimg; ?>" style="width:100%"/>
                                            <input type="hidden" name="imageBillArrayname[]" value="<?php echo $recimg; ?>"
                                                   class="validate[required,length[0,250]]"/>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }
                    } ?>
                </div>

                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="gallery_upload" id="gallery_upload" class="transparent no-shadow">
                        <label>
                            <small>Image Dimensions (<?php echo Module::get_properties($moduleId, 'imgwidth'); ?> px
                                X <?php echo Module::get_properties($moduleId, 'imgheight'); ?> px)
                            </small>
                        </label>
                    </div>
                    <!-- Upload user image preview -->
                    <div id="preview_Image"><input type="hidden" name="imageArrayname[]"/></div>
                    <?php
                    if (!empty($vehicleInfo->image)) {
                        $imgRec = unserialize($vehicleInfo->image);
                        if (is_array($imgRec)) {
                            foreach ($imgRec as $recimg) {
                                $deleteid = rand(0, 99999);
                                $imagePath = SITE_ROOT . 'images/vehicle/' . $recimg;
                                if (file_exists($imagePath)) { ?>
                                    <div class="col-md-3" id="removeSavedimg<?php echo $deleteid; ?>">
                                        <div class="infobox info-bg">
                                            <div class="button-group" data-toggle="buttons">
                                                <span class="float-left">
                                                    <?php
                                                    if (file_exists(SITE_ROOT . "images/vehicle/" . $recimg)):
                                                        $filesize = filesize(SITE_ROOT . "images/vehicle/" . $recimg);
                                                        echo 'Size : ' . getFileFormattedSize($filesize);
                                                    endif;
                                                    ?>
                                                </span>
                                                <a class="btn small float-right" href="javascript:void(0);"
                                                   onclick="deleteSavedVehiclesimage(<?php echo $deleteid; ?>);">
                                                    <i class="glyph-icon icon-trash-o"></i>
                                                </a>
                                            </div>
                                            <img src="<?php echo IMAGE_PATH . 'vehicle/thumbnails/' . $recimg; ?>" style="width:100%"/>
                                            <input type="hidden" name="imageArrayname[]" value="<?php echo $recimg; ?>"
                                                   class="validate[required,length[0,250]]"/>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }
                    } ?>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Brief :
                        </label>
                    </div>
                    <textarea name="content" id="content"
                              class="large-textarea"><?php echo !empty($vehicleInfo->content) ? $vehicleInfo->content : ""; ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1"
                               value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0"
                               value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                        <label for="">Un-Published</label>
                    </div>
                </div>

                <button btn-action='0' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <button btn-action='1' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save & More
                </span>
                </button>
                <button btn-action='2' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save & quit
                </span>
                </button>
                <input myaction='0' type="hidden" name="idValue" id="idValue" value="<?php echo !empty($vehicleInfo->id) ? $vehicleInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            /************************************ Editor for message *****************************************/
            var base_url = "<?php echo ASSETS_PATH; ?>";
            CKEDITOR.replace('content', {
                toolbar:
                    [
                        {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']},
                        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']}, '/',
                        {name: 'colors', items: ['TextColor', 'BGColor']},
                        {name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About']}
                    ]
            });
        });
    </script>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#gallery_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {PROJECT: '<?php echo SITE_FOLDER;?>', targetFolder: 'images/vehicle/', thumb_width: 200, thumb_height: 200},
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
                    $.post('<?php echo BASE_URL;?>apanel/vehicle/uploaded_image.php', {imagefile: filename}, function (msg) {
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

            $('#bill_book_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {PROJECT: '<?php echo SITE_FOLDER;?>', targetFolder: 'images/vehicle/billbook/', thumb_width: 200, thumb_height: 200},
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
                    $.post('<?php echo BASE_URL;?>apanel/vehicle/uploaded_image_bill.php', {imagefile: filename}, function (msg) {
                        $('#preview_Bill_Book_Image').append(msg).show();
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