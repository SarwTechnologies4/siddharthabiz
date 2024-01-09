<?php
$tablename      = "tbl_event_hall";
$user_hotel_id  = $session->get('user_hotel_id');
$hotel_detail   = Hotelapi::find_by_id($user_hotel_id);

if (isset($_GET['page']) && $_GET['page'] == "eventhall" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    clearImages($tablename, 'eventhall');
    clearImages($tablename, 'eventhall/thumbnails');
    ?>
    <h3>
        Manage Event Hall<?php echo "'s of " . $hotel_detail->title; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="addNewEventHall();">
            <span class="glyph-icon icon-separator"><i class="glyph-icon icon-plus-square"></i></span>
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
                    <th class="text-left">Title</th>
                    <th>Status</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = EventHall::find_by_sql("SELECT * FROM " . $tablename . " WHERE 1=1 and hotel_id='" . $user_hotel_id . "' ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td><a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);"
                               class="loadingbar-demo" title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
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
                        </td>
                        <td class="text-center">
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
        </div>
        <div class="pad0L col-md-2">
            <select name="dropdown" id="groupTaskField" class="custom-select">
                <option value="0"><?php echo $GLOBALS['basic']['choseAction']; ?></option>
                <option value="delete"><?php echo $GLOBALS['basic']['delete']; ?></option>
                <option value="toggleStatus"><?php echo $GLOBALS['basic']['toggleStatus']; ?></option>
            </select>
        </div>
        <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
            <span class="glyph-icon icon-separator float-right"><i class="glyph-icon icon-cog"></i></span>
            <span class="button-content"> Submit </span>
        </a>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "form"):
    if (isset($_GET['id']) and !empty($_GET['id'])):
        $rowId      = addslashes($_REQUEST['id']);
        $rowInfo    = EventHall::find_by_id($rowId);

        $status     = ($rowInfo->status == 1) ? "checked" : " ";
        $unstatus   = ($rowInfo->status == 0) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit Hall' : 'Add Hall'; ?><?php echo " [" . $hotel_detail->title . "]"; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewEventHallList();">
            <span class="glyph-icon icon-separator"><i class="glyph-icon icon-arrow-circle-left"></i></span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" method="post" class="col-md-12 center-margin" id="event_hall_frm">

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Title :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Title" class="col-md-12 validate[required,length[0,250]]" type="text" name="title" id="title"
                               value="<?php echo !empty($rowInfo->title) ? $rowInfo->title : ""; ?>">
                    </div>
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
                    <div id="preview_Image"><input type="hidden" name="imageArrayname"/></div>
                </div>

                <div class="form-row">
                    <?php
                    if (!empty($rowInfo->image)):
                        $imageRow2 = $rowInfo->image; ?>
                        <div class="col-md-3" id="removeSavedimg001">
                            <?php
                            if (file_exists(SITE_ROOT . "images/eventhall/" . $imageRow2)):?>
                                <div class="infobox info-bg">
                                    <div class="button-group" data-toggle="buttons">
                                        <span class="float-left">
                                            <?php
                                            $filesize = filesize(SITE_ROOT . "images/eventhall/" . $imageRow2);
                                            echo 'Size : ' . getFileFormattedSize($filesize);
                                            ?>
                                        </span>
                                        <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedImage('001');">
                                            <i class="glyph-icon icon-trash-o"></i>
                                        </a>
                                    </div>
                                    <img src="<?php echo IMAGE_PATH . 'eventhall/thumbnails/' . $imageRow2; ?>" style="width:100%"/>
                                    <input type="hidden" name="imageArrayname" value="<?php echo $imageRow2; ?>"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Area :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="Area" class="col-md-12 validate[length[0,250]]" type="text" name="area" id="area"
                               value="<?php echo !empty($rowInfo->area) ? $rowInfo->area : ""; ?>">
                    </div>

                    <div class="form-label col-md-2">
                        <label for="">
                            Theater :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="Theater" class="col-md-12 validate[length[0,250]]" type="text" name="theater" id="theater"
                               value="<?php echo !empty($rowInfo->theater) ? $rowInfo->theater : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Circular :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="Circular" class="col-md-12 validate[length[0,250]]" type="text" name="circular" id="circular"
                               value="<?php echo !empty($rowInfo->circular) ? $rowInfo->circular : ""; ?>">
                    </div>

                    <div class="form-label col-md-2">
                        <label for="">
                            U Shaped :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="U Shaped" class="col-md-12 validate[length[0,250]]" type="text" name="u_shaped" id="u_shaped"
                               value="<?php echo !empty($rowInfo->u_shaped) ? $rowInfo->u_shaped : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Board Room :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="Board Room" class="col-md-12 validate[length[0,250]]" type="text" name="board_room" id="board_room"
                               value="<?php echo !empty($rowInfo->board_room) ? $rowInfo->board_room : ""; ?>">
                    </div>

                    <div class="form-label col-md-2">
                        <label for="">
                            Class Room :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="Class Room" class="col-md-12 validate[length[0,250]]" type="text" name="class_room" id="class_room"
                               value="<?php echo !empty($rowInfo->class_room) ? $rowInfo->class_room : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Reception :
                        </label>
                    </div>
                    <div class="form-input col-md-4">
                        <input placeholder="Reception" class="col-md-12 validate[length[0,250]]" type="text" name="reception" id="reception"
                               value="<?php echo !empty($rowInfo->reception) ? $rowInfo->reception : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Content :
                        </label>
                        <textarea name="content" id="content"
                                  class="large-textarea"><?php echo !empty($rowInfo->content) ? $rowInfo->content : ""; ?></textarea>
                        <a class="btn medium bg-orange mrg5T hide" title="Read More" id="readMore" href="javascript:void(0);">
                            <span class="button-content">Read More</span>
                        </a>
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

                            <!-- Meta Tags-->
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

                <button btn-action='0' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                    <span class="button-content">Save</span>
                </button>
                <button btn-action='1' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                    <span class="button-content">Save & More</span>
                </button>
                <button btn-action='2' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                    <span class="button-content">Save & quit</span>
                </button>
                <input myaction='0' type="hidden" name="idValue" id="idValue" value="<?php echo !empty($rowInfo->id) ? $rowInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>
    <script>
        var base_url = "<?php echo ASSETS_PATH; ?>";
        var editor_arr = ["content"];
        create_editor(base_url, editor_arr);
    </script>

    <link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#image_upload').uploadify({
                'swf':          '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader':     '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData':     {PROJECT: '<?php echo SITE_FOLDER;?>', targetFolder: 'images/eventhall/', thumb_width: 380, thumb_height: 478},
                'method':       'post',
                'cancelImg':    '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto':         true,
                'multi':        false,
                'hideButton':   false,
                'buttonText':   'Upload Image',
                'width':        125,
                'height':       21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit':  100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass':  'button formButtons',
                'onUploadSuccess': function (file, data, response) {
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/eventhall/uploaded_image.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image').html(msg).show();
                    });
                },
                'onDialogOpen': function (event, ID, fileObj) {},
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