<?php
$moduleTablename = "tbl_roomtype"; // Database table name
$moduleId = 24;                // module id >>>>> tbl_modules
$moduleFoldername = "roomtype";        // Image folder name
//$user_hotel_id = $session->get('user_hotel_id');
//$hotel_detail = Hotelapi::find_by_id($user_hotel_id);
if (isset($_GET['page']) && $_GET['page'] == "roomtype" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>
    <h3>
        Room Type <?php //echo "'s of " . $hotel_detail->title; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewType();">
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
                    <th class="text-center" width="10%">S.No.</th>
                    <th align="left">Title</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php
                //$records = Roomtype::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE 1=1 and hotel_id='" . $user_hotel_id . "' ORDER BY sortorder ASC ");
                $records = Roomtype::find_by_sql("SELECT * FROM " . $moduleTablename . " ORDER BY sortorder ASC ");
                foreach ($records as $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td class="text-center"><?php echo $record->sortorder; ?></td>
                        <td>
                            <div>
                                <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);" class="loadingbar-demo"
                                   title="<?php echo $record->title; ?>">
                                    <?php echo $record->title; ?>
                                </a>
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
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top"
                               title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                               onclick="recordDelete(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-remove"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $rowId = addslashes($_REQUEST['id']);
        $rowInfo = Roomtype::find_by_id($rowId);
        $status = ($rowInfo->status == 1) ? "checked" : " ";
        $unstatus = ($rowInfo->status == 0) ? "checked" : " ";
    endif;
    ?>

    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit type' : 'Add type'; ?> <?php //echo " [" . $hotel_detail->title . "]"; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewList();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-10 center-margin" id="addEdit_Frm">

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Title :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Title" class="col-md-4 validate[required,length[0,200]]" type="text" name="title" id="title"
                               value="<?php echo !empty($rowInfo->title) ? $rowInfo->title : ""; ?>">
                    </div>
                </div>




                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Published :
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

                <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($rowInfo) ? $rowInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>
<?php endif; ?>