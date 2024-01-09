<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename    = "tbl_roomapi_offers";
$moduleId           = 29;

if (isset($_GET['page']) && $_GET['page'] == "hotelapi" && isset($_GET['mode']) && $_GET['mode'] == "offerList"):
    $user_hotel_id      = intval(addslashes($_GET['id']));
    $hotel_detail       = Hotelapi::find_by_id($user_hotel_id);

    clearImages($moduleTablename, "roomoffers");
    clearImages($moduleTablename, "roomoffers/thumbnails");
    ?>
    <h3>
        FAQ Management <?php echo " of " . $hotel_detail->title; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="addNewOffer(<?php echo $user_hotel_id; ?>);">
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
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="offerListTable">
                <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
                    <th class="text-left">Title</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = Roomoffers::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE 1=1 and hotel_id='" . $user_hotel_id . "' ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td>
                            <div>
                                <a href="javascript:void(0);" onClick="editOffer(<?php echo $record->hotel_id; ?>,<?php echo $record->id; ?>);" class="loadingbar-demo"
                                   title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <a href="javascript:void(0);" class="btn small <?php echo $statusImage; ?> tooltip-button" data-placement="top"
                               title="<?php echo $statusText; ?>" id="imgHolder_<?php echo $record->id; ?>"
                               onclick="statusToggleOffer(<?php echo $record->id; ?>,<?php echo $record->status; ?>);">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top" title="Edit"
                               onclick="editOffer(<?php echo $record->hotel_id; ?>,<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                               onclick="deleteOffer(<?php echo $record->id; ?>);">
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
        <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn_offer">
            <span class="glyph-icon icon-separator float-right"><i class="glyph-icon icon-cog"></i></span>
            <span class="button-content"> Click </span>
        </a>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "offerAddEdit"):
    $pid = addslashes($_REQUEST['id']);
    $hotel_detail = Hotelapi::find_by_id($pid);
    if (isset($_GET['subid']) && !empty($_GET['subid'])):
        $advId      = addslashes($_REQUEST['subid']);
        $advInfo    = Roomoffers::find_by_id($advId);
        $status     = ($advInfo->status == 1) ? "checked" : " ";
        $unstatus   = ($advInfo->status == 0) ? "checked" : " ";
        $homepage   = ($advInfo->homepage == 1) ? "checked" : " ";
        $nothomepage = ($advInfo->homepage == 0) ? "checked" : " ";
        $external   = ($advInfo->linktype == 1) ? "checked" : " ";
        $internal   = ($advInfo->linktype == 0) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['subid'])) ? 'Edit FAQ' : 'Add FAQ'; ?> <?php echo " [" . $hotel_detail->title . "]"; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewOfferList(<?php echo $pid; ?>);">
            <span class="glyph-icon icon-separator"><i class="glyph-icon icon-arrow-circle-left"></i></span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="offers_frm">

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Question :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="FAQ Title" class="col-md-6 validate[required,length[0,50]]" type="text" name="title" id="title"
                               value="<?php echo !empty($advInfo->title) ? $advInfo->title : ""; ?>">
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            From Date :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="From Date" class="col-md-4 validate[required]" type="text" name="date_from" id="date_from"
                               value="<?php echo !empty($advInfo->date_from) ? $advInfo->date_from : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            To Date :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="To Date" class="col-md-4 validate[required]" type="text" name="date_to" id="date_to"
                               value="<?php echo !empty($advInfo->date_to) ? $advInfo->date_to : ""; ?>">
                    </div>
                </div> -->

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Price :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Currency" class="col-md-1 validate[required,length[0,50]]" type="text" name="currency" id="currency"
                               value="<?php echo !empty($advInfo->currency) ? $advInfo->currency : ""; ?>">
                        <input placeholder="Price" class="col-md-2 validate[required,length[0,50]]" type="text" name="price" id="price"
                               value="<?php echo !empty($advInfo->price) ? $advInfo->price : ""; ?>">
                    </div>
                </div>
                -->

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Discount (%) :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <select class="col-md-1 validate[required]" name="discount">
                            <?php foreach (range(1, 100) as $v):
                    $sel = ($advInfo->discount == $v) ? "selected" : ""; ?>
                                <option value="<?= $v ?>" <?= $sel ?> ><?= $v ?> %</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Apply For :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <label><input type="radio" class="custom-radio apply_for" value="all" name="apply_for"
                                      checked="checked" <?php echo (@$advInfo->apply_for == 'all') ? "checked" : ""; ?> ?> All Room</label>
                        <label><input type="radio" class="custom-radio apply_for" value="room_type"
                                      name="apply_for" <?php echo (@$advInfo->apply_for == 'room_type') ? "checked" : ""; ?> > Rooms Types</label>
                        <label><input type="radio" class="custom-radio apply_for" value="room"
                                      name="apply_for" <?php echo (@$advInfo->apply_for == 'room') ? "checked" : ""; ?> > Rooms</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Select :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <select class="col-md-4" name="apply_id" id="apply_id">
                            <?php if (!empty($advInfo->apply_id)) {
                    $v = $advInfo->apply_for;
                    $contents = "";
                    if ($v == 'room') {
                        $records = Roomapi::find_by_sql("SELECT * FROM tbl_roomapi ORDER BY sortorder DESC ");
                        foreach ($records as $key => $record):
                            $sel = ($advInfo->apply_id == $record->id) ? "selected" : "";
                            $contents .= "<option value='" . $record->id . "' " . $sel . " >" . $record->title . "</option>";
                        endforeach;
                    } else if ($v == 'room_type') {
                        $records = Roomtype::find_by_sql("SELECT * FROM tbl_roomtype ORDER BY sortorder DESC ");
                        foreach ($records as $key => $record):
                            $sel = ($advInfo->apply_id == $record->id) ? "selected" : "";
                            $contents .= "<option value='" . $record->id . "' " . $sel . " >" . $record->title . "</option>";
                        endforeach;
                    } else {
                        $contents = "<option value='0'>All Room</option>";
                    }
                    echo $contents;
                } else { ?>
                                <option value="0">All Room</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                -->

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Image :
                        </label>
                    </div>

                    <?php if (!empty($advInfo->image)): ?>
                        <div class="col-md-3" id="removeSavedimg1">
                            <div class="infobox info-bg">
                                <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                    if (file_exists(SITE_ROOT . "images/roomoffers/" . $advInfo->image)):
                        $filesize = filesize(SITE_ROOT . "images/roomoffers/" . $advInfo->image);
                        echo 'Size : ' . getFileFormattedSize($filesize);
                    endif;
                    ?>
                            </span>
                                    <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedOffersimage(1);">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>
                                </div>
                                <img src="<?php echo IMAGE_PATH . 'roomoffers/thumbnails/' . $advInfo->image; ?>" style="width:100%"/>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-input col-md-10 uploader1 <?php echo !empty($advInfo->image) ? "hide" : ""; ?>">
                        <input type="file" name="background_upload" id="background_upload" class="transparent no-shadow">
                        <label><small>Image Dimensions (0 px X 0 px)</small></label>
                    </div>
                    <div id="preview_Image"><input type="hidden" name="imageArrayname" value="" class=""/></div>
                </div>
                -->

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Link Type :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                            <input id="" class="custom-radio" type="radio" name="linktype" value="0"
                               onClick="linkTypeSelect(0);" <?php echo !empty($internal) ? $internal : "checked"; ?>>
                        <label for="">Internal Link</label>
                        <input id="" class="custom-radio" type="radio" name="linktype" value="1"
                               onClick="linkTypeSelect(1);" <?php echo !empty($external) ? $external : ""; ?>>
                        <label for="">External Link</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Link :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <div class="col-md-10" style="padding-left:0px !important;">
                            <input placeholder="Offers Link" class="" type="text" name="linksrc" id="linksrc"
                                   value="<?php echo !empty($advInfo->linksrc) ? $advInfo->linksrc : ""; ?>">
                        </div>
                    </div>
                </div>
                -->

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Answer :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <textarea name="content" id="content" class="large-textarea"><?php echo !empty($advInfo->content) ? $advInfo->content : ""; ?></textarea>
                        <a id="readMore" class="hide"></a>
                    </div>
                </div>

                
                <!-- <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                             Answer:
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <textarea name="quick_info" id="quick_info" class="large-textarea"><?php echo !empty($advInfo->quick_info) ? $advInfo->quick_info : ""; ?></textarea>
                    </div>
                </div> -->
               

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Status :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1" value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0" value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                        <label for="">Un-Published</label>
                    </div>
                </div>
                <!-- <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Homepage :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="homepage" id="homepage1" value="1" <?php echo !empty($homepage) ? $homepage : "checked"; ?>>
                        <label for="">Homepage</label>
                        <input type="radio" class="custom-radio" name="homepage" id="homepage0" value="0" <?php echo !empty($nothomepage) ? $nothomepage : ""; ?>>
                        <label for="">Not at Homepage</label>
                    </div>
                </div> -->

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
                <div class="form-row <?php echo (!empty($advInfo->meta_keywords) || !empty($advInfo->meta_description)) ? '' : 'hide'; ?> metadata">
                    <div class="col-md-6">
                        <textarea placeholder="Meta Keyword" name="meta_keywords" id="meta_keywords"
                                  class="character-keyword validate[required]"><?php echo !empty($advInfo->meta_keywords) ? $advInfo->meta_keywords : ""; ?></textarea>
                        <div class="keyword-remaining clear input-description">250 characters left</div>
                    </div>
                    <div class="col-md-6">
                        <textarea placeholder="Meta Description" name="meta_description" id="meta_description"
                                  class="character-description validate[required]"><?php echo !empty($advInfo->meta_description) ? $advInfo->meta_description : ""; ?></textarea>
                        <div class="description-remaining clear input-description">160 characters left</div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($advInfo->id) ? $advInfo->id : 0; ?>"/>
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $pid; ?>"/>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#background_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {PROJECT: '<?php echo SITE_FOLDER;?>', targetFolder: 'images/roomoffers/', thumb_width: 200, thumb_height: 200},
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
                    $.post('<?php echo BASE_URL;?>apanel/roomoffers/uploaded_image.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image').html(msg).show();
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
    <script>
        $(document).ready(function () {
            /************************************ Editor for message *****************************************/
            var base_url = "<?php echo ASSETS_PATH; ?>";
            CKEDITOR.replace('', {
                toolbar:
                    [
                        {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']},
                        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']}, '/',
                        {name: 'colors', items: ['TextColor', 'BGColor']},
                        {name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About']}
                    ]
            });

            // CKEDITOR.replace('quick_info', {
            //     toolbar:
            //         [
            //             {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']},
            //             {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']}, '/',
            //             {name: 'colors', items: ['TextColor', 'BGColor']},
            //             {name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About']}
            //         ]
            // });
        });
    </script>
<?php endif; ?>