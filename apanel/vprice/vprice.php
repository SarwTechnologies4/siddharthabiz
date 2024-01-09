<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename = "tbl_vprice"; // Database table name
$moduleId = 49;                // module id >>>>> tbl_modules
$moduleFoldername = "vprice";        // Image folder name

if (isset($_GET['page']) && $_GET['page'] == "vprice" && isset($_GET['mode']) && $_GET['mode'] == "list"): ?>
    <h3>
        List Vprices
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewVprices();">
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
                    <th width="10%">S.No.</th>
                    <th class="text-center">Route</th>
                    <th class="text-center" width="15%">Date</th>
                    <th class="text-center" width="20%"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php if($loginUser->type == 'hotel') { $records = Vprice::find_by_sql("SELECT vp.id, vf.title AS route_from, vt.title AS route_to, vp.status, vp.sortorder, vp.added_date FROM ".$moduleTablename." AS vp 
                    INNER JOIN tbl_route AS vf ON vf.id = vp.route_from
                    INNER JOIN tbl_route AS vt ON vt.id = vp.route_to
                    WHERE vp.added_by='".$loginUser->id."'
                    ORDER BY vp.sortorder ASC"); }
                else { $records = Vprice::find_by_sql("SELECT vp.id, vf.title AS route_from, vt.title AS route_to, vp.status, vp.sortorder, vp.added_date FROM ".$moduleTablename." AS vp 
                    INNER JOIN tbl_route AS vf ON vf.id = vp.route_from
                    INNER JOIN tbl_route AS vt ON vt.id = vp.route_to
                    ORDER BY vp.sortorder ASC"); }
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td class="text-center"><?php echo $key + 1; ?></td>
                        <td><?php echo $record->route_from . ' > ' . $record->route_to; ?></td>
                        <td class="text-center"><?php echo $record->added_date; ?></td>
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
        </div>

    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $vpriceId = addslashes($_REQUEST['id']);
        $vpriceInfo = Vprice::find_by_id($vpriceId);
        $status = ($vpriceInfo->status == 1) ? "checked" : " ";
        $unstatus = ($vpriceInfo->status == 0) ? "checked" : " ";
        $vRate = Vprice::get_vehicle_rate_by($vpriceId);
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit Vprice' : 'Add Vprice'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewvpricelist();">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-arrow-circle-left"></i>
            </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="vprice_frm">
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">From : </label>
                    </div>
                    <div class="form-input">
                        <select class="col-md-6 js-example-basic-single" name="route_from" id="route_from">
                            <option value="">Choose Route</option>
                            <?php $prnt = Route::find_route_by(0);
                            if (!empty($prnt)) {
                                foreach ($prnt as $pt) {
                                    $chnt = Route::find_route_by($pt->id);
                                    if (!empty($chnt)) { ?>
                                        <optgroup label="<?php echo $pt->title; ?>">
                                            <?php foreach ($chnt as $ct) {
                                                $sel = (!empty($vpriceInfo) AND $vpriceInfo->route_from == $ct->id) ? 'selected' : '';
                                                echo '<option value="' . $ct->id . '" ' . $sel . '>' . $ct->title . '</option>';
                                            } ?>
                                        </optgroup>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">To : </label>
                    </div>
                    <div class="form-input col-md-10">
                        <select class="col-md-6 js-example-basic-single" name="route_to" id="route_to">
                            <option value="">Choose Route</option>
                            <?php $prnt = Route::find_route_by(0);
                            if (!empty($prnt)) {
                                foreach ($prnt as $pt) {
                                    $chnt = Route::find_route_by($pt->id);
                                    if (!empty($chnt)) { ?>
                                        <optgroup label="<?php echo $pt->title; ?>">
                                            <?php foreach ($chnt as $ct) {
                                                $sel = (!empty($vpriceInfo) AND $vpriceInfo->route_to == $ct->id) ? 'selected' : '';
                                                echo '<option value="' . $ct->id . '" ' . $sel . '>' . $ct->title . '</option>';
                                            } ?>
                                        </optgroup>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <?php $vres = Vehicle::vehicle_list();
                if (!empty($vres)) {
                    foreach ($vres as $k => $vrow) { ?>
                        <div class="form-row">
                            <div class="form-label col-md-2">
                                <label for=""><?php echo ($k == 0) ? 'Vehicle Rate: ' : ''; ?></label>
                            </div>
                            <div class="form-input col-md-10">                                
                                <?php if($loginUser->type == 'hotel') {
                                    $subVehicles = Vehicle::find_all_child_by($vrow->id, $loginUser->id);
                                } else {
                                    $subVehicles = Vehicle::find_all_byparent($vrow->id);    
                                }
                                if (!empty($subVehicles)) { ?>
                                    <strong class="mb-4"><?php echo $vrow->title; ?>:&nbsp;&nbsp;</strong>
                                    <?php foreach ($subVehicles as $subVehicle) { ?>
                                        <div class="mrg5B">
                                            <strong class=""><?= $subVehicle->title; ?>:&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                            <input type="hidden" name="velicle_id[<?= $vrow->id ?>][]" value="<?php echo $subVehicle->id; ?>" readonly>
                                            <input class="col-md-1 validate[required]" min="0" type="number" id="vehicle_price"
                                                   name="vehicle_price[<?= $vrow->id ?>][]"
                                                   value="<?php echo !empty($vRate[$subVehicle->id]) ? $vRate[$subVehicle->id] : 0; ?>">
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    <?php }
                } ?>

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
                <input myaction='0' type="hidden" name="idValue" id="idValue" value="<?php echo !empty($vpriceInfo->id) ? $vpriceInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">$(document).ready(function () {
            $('.js-example-basic-single').select2();
        });</script>
<?php endif; ?>