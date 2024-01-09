<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename = "tbl_apihotel"; // Database table name
$moduleId = 29;                // module id >>>>> tbl_modules

if (isset($_GET['page']) && $_GET['page'] == "hotelapi" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    JsonclearImagesNorace($moduleTablename, "hotelapi");
    JsonclearImagesNorace($moduleTablename, "hotelapi/thumbnails");
    clearImages($moduleTablename, "hotelapi/logo", "logo");
    clearImages($moduleTablename, "hotelapi/logo/thumbnails", "logo");
    clearImages($moduleTablename, "hotelapi/home", "home_image");
    clearImages($moduleTablename, "hotelapi/home/thumbnails", "home_image");

    $accesskey = isset($_GET['id']) ? $_GET['id'] : '';
    $add_query = "";
    $some_text = "";
    if ($user_type == 'admin') {
        if (!empty($accesskey)) {
            $row_user = Hoteluser::get_by_accesskey($accesskey);
            $access_user_id = $row_user->id;
            $add_query = " AND user_id='$access_user_id'";
            $some_text = "'s of <a href='" . ADMIN_URL . "hoteluser/profile/" . $row_user->accesskey . "'>" . $row_user->first_name . ' ' . $row_user->last_name . "</a>";
        }
    }
    if ($user_type == 'hotel') {
        if (!empty($accesskey)) {
            $row_user = Hoteluser::get_by_accesskey($accesskey);
            $access_user_id = $row_user->id;
            $add_query = " AND user_id='$access_user_id'";
            $some_text = "'s of <a href='" . ADMIN_URL . "hoteluser/profile/" . $row_user->accesskey . "'>" . $row_user->first_name . ' ' . $row_user->last_name . "</a>";
        } else {
            $accesskey = $session->get('accesskey');
            redirect_to(ADMIN_URL . 'hotelapi/list/' . $accesskey);
        }
    }

    $records = $db->query("SELECT * FROM " . $moduleTablename . " WHERE 1=1 {$add_query} ORDER BY id ASC ");
    $num_records = $db->num_rows($records);
    ?>

    <?php
    $show_hotels = 0;
    if ($user_type == 'admin') {
        $show_hotels = 1;
    } else {
        if (empty($num_records)) {
            redirect_to(ADMIN_URL . 'hotelapi/addEdit/' . $accesskey);
        } else if ($num_records == '1') {
            $one_record = $db->query("SELECT * FROM " . $moduleTablename . " WHERE 1=1 {$add_query} LIMIT 0,1");
            $row_record = $db->fetch_array($one_record);
            $hotel_code = $row_record['code'];
            redirect_to(ADMIN_URL . 'hotelapi/profile/' . $hotel_code);
        } else {
            $show_hotels = 1;
        }
    }
    if ($show_hotels == 1) { ?>
        <h3>
            Properties<?php echo $some_text; ?>
            <?php
            $uId = (!empty($session->get('u_id'))) ? $session->get('u_id') : 0;
            $user = Hoteluser::find_by_id($uId);
            $hotels = Hotelapi::find_all_by_user_id($uId);
            $hotels_no = sizeof($hotels);
            if ($user_type == 'admin' or ($hotels_no < $user->hotels_no)) { ?>
                <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
                   onClick="<?php if (!empty($accesskey)) { ?>AddNewHotelTo('<?php echo $accesskey; ?>');<?php } else { ?>AddNewHotel();<?php } ?>">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-plus-square"></i>
    </span>
                    <span class="button-content"> Add New Property</span>
                </a>
            <?php } ?>
        </h3>
        <div class="my-msg"></div>
        <div class="example-box">
            <div class="example-code">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th class="text-left">Property Name</th>
                        <th class="text-left">Prop_id</th>
                        <!-- <th class="text-left">User</th> -->
                        <th class="text-center">Event Hall</th>
                        <th class="text-center">FAQ</th>
                        <!-- <th class="text-left">Property Details</th>
                        <th class="text-left">Contact Details</th> -->
                        <?php if ($user_type == 'admin') { ?>
                            <th class="text-center">Feat.</th>
                            <!-- <th class="text-center">Show Home</th> -->
                        <?php } ?>
                        <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if ($num_records > 0) {
                        $key = 0;
                        while ($record = $db->fetch_array($records)): ?>
                            <tr id="<?php echo $record['id']; ?>">
                                <td class="text-center"><?php echo $key + 1;
                                    $key++; ?></td>
                                
                                <td>
                                    <a href="javascript:void(0);" onClick="editRecord('<?php echo $record['id']; ?>');"
                                       class="loadingbar-demo"
                                       title="<?php echo $record['title']; ?>"><?php echo $record['long_name']; ?></a><br>
                                    </a>

                                </td>
                                <td>
                                   <?php echo $record['prop_code']; ?>
                                </td>
                               <td class="text-center">
                                    <?php $countChild = Hallapi::getTotalChild($record['id']); ?>
                                    <a class="primary-bg medium btn loadingbar-demo" title="" onClick="viewhallList(<?= $record['id'] ?>)" href="javascript:void(0);">
                                        <span class="button-content">
                                            <span class="badge bg-orange radius-all-4 mrg5R" title=""
                                                  data-original-title="Badge with tooltip"><?php echo $countChild; ?></span>
                                            <span class="text-transform-upr font-bold font-size-11">view list</span>
                                        </span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?php $countChild = Roomoffers::getTotalChild($record['id']); ?>
                                    <a class="primary-bg medium btn loadingbar-demo" title="" onClick="viewOfferList(<?= $record['id'] ?>)" href="javascript:void(0);">
                                        <span class="button-content">
                                            <span class="badge bg-orange radius-all-4 mrg5R" title=""
                                                  data-original-title="Badge with tooltip"><?php echo $countChild; ?></span>
                                            <span class="text-transform-upr font-bold font-size-11">View Lists</span>
                                        </span>
                                    </a>
                                </td>
                                
                                <!-- <td><a href=""><?php $usersInfo = Hoteluser::find_by_id($record['user_id']);
                                        echo $usersInfo->first_name . ' ' . $usersInfo->last_name; ?></a><br>
                                    Contact No: <?php echo $usersInfo->contact; ?><br>
                                    Email : <?php echo $usersInfo->email; ?><br></td> -->
                                <!-- <td>
                                    Contact No: <?php echo $record['contact_no']; ?><br>
                                    Email : <?php echo $record['email']; ?><br>
                                    Street : <?php echo $record['street']; ?><br>
                                    City : <?php echo $record['city']; ?><br>
                                    District: <?php echo $record['district']; ?>
                                </td> -->
                                <!-- <td><?php echo $record['contact_person']; ?><br>
                                    Contact No: <?php echo $record['contact_person_contact_no']; ?><br>
                                    Email : <?php echo $record['contact_person_email']; ?><br></td> -->
                                <?php if ($user_type == 'admin') { ?>
                                    <td class="text-center">
                                        <?php $featureImage = ($record['featured'] == 1) ? "bg-green" : "bg-red";
                                        $featlureText = ($record['featured'] == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub']; ?>
                                        <a href="javascript:void(0);"
                                           class="btn small <?php echo $featureImage; ?> tooltip-button featureToggler"
                                           data-placement="top" title="<?php echo $featlureText; ?>"
                                           status="<?php echo $record['featured']; ?>" id="futimgHolder_<?php echo $record['id']; ?>"
                                           moduleId="<?php echo $record['id']; ?>">
                                            <i class="glyph-icon icon-flag"></i>
                                        </a>
                                    </td>

                                    <!-- <td class="text-center">
<?php // $homeImage = ($record['homepage'] == 1) ? "bg-green" : "bg-red" ; 
                                    // $homeText = ($record['homepage'] == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'] ; ?><a href="javascript:void(0);" class="btn small <?php // echo $homeImage;?> tooltip-button homeToggler" data-placement="top" title="<?php // echo $homeText;?>" status="<?php // echo $record['homepage'];?>" id="hmimgHolder_<?php // echo $record['id'];?>" moduleId="<?php // echo $record['id'];?>">
<i class="glyph-icon icon-flag"></i>
</a>
</td> -->
                                <?php } ?>

                                <td class="text-center text-nowrap">
                                    <?php if ($user_type == 'admin') { ?>
                                        <?php
                                        $statusImage = ($record['status'] == 1) ? "bg-green" : "bg-red";
                                        $statusText = ($record['status'] == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                                        ?>
                                        <a href="javascript:void(0);"
                                           class="btn small <?php echo $statusImage; ?> tooltip-button statusToggler"
                                           data-placement="top" title="<?php echo $statusText; ?>"
                                           status="<?php echo $record['status']; ?>" id="imgHolder_<?php echo $record['id']; ?>"
                                           moduleId="<?php echo $record['id']; ?>">
                                            <i class="glyph-icon icon-flag"></i>
                                        </a>
                                    <?php } ?>
                                    <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                                       data-placement="top" title="Edit" onclick="editRecord(<?php echo $record['id']; ?>);">
                                        <i class="glyph-icon icon-edit"></i>
                                    </a>

                                    <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove" onclick="recordDelete(<?php echo $record['id']; ?>);">
                        <i class="glyph-icon icon-remove"></i>
                    </a>

                                    <input name="sortId" type="hidden" value="<?php echo $record['id']; ?>">
                                    <?php if ($user_type == 'admin') { ?>
                                        <a style="padding:0px 4px;" class="btn small bg-blue-alt tooltip-button"
                                                   href="<?php echo ADMIN_URL ?>switch/<?php echo $usersInfo->accesskey; ?>">
                                            <i class="glyph-icon icon-key"></i> Login</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endwhile;
                    } ?>
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

    <?php } ?>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "profile"):
    $aId = isset($_GET['id']) ? $_GET['id'] : '';
    $rowInfo = Hotelapi::find_by_code($aId);
    $session->set('user_hotel_id', $rowInfo->id);
    /* require_once('./code_zip.php');
    $zip_path = SITE_ROOT.'apanel/hotelcode/'.$rowInfo->code.'.zip';
    if (file_exists($zip_path)) { unlink($zip_path); }
    $files_to_zip = array('hotelcode/index.php', 'hotelcode/result.php');
    create_zip($files_to_zip, 'hotelcode/'.$rowInfo->code.'.zip'); */
    ?>

    <!-- <div class="well">
 <strong>Use following code to implement hotel booking in any website.</strong>
    <a class="btn medium bg-blue-alt" href="<?php echo ADMIN_URL; ?>hotelcode/<?php echo $rowInfo->code; ?>.zip">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-download"></i>
        </span>
        <span class="button-content">Download Code</span>
    </a>
           </div>-->

    <h3>
        <?php echo $rowInfo->long_name; ?> <a class="btn medium bg-blue-alt float-right"
                                              href="<?php echo ADMIN_URL ?>hotelapi/addEdit/<?php echo $rowInfo->id; ?>">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
            <span class="button-content"> Edit </span>
        </a>
        <!-- <span class="float-right btn medium">CODE : <?php echo $rowInfo->code; ?></span> -->
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" method="post" class="col-md-12 center-margin" id="hotelapi_frm">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-5">
                                <div class="col-md-6">
                                    <?php if ($user_type == '') { ?>
                                        <div class="form-row">
                                            <div class="form-label col-md-6">
                                                <label for="">
                                                    Property User
                                                </label>
                                            </div>
                                            <div class="form-input col-md-6">
                                                <?php echo $rowInfo->user_id; ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>Property Full Name :</strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->long_name) ? $rowInfo->long_name : ""; ?>
                                        </div>
                                    </div>

                                    <!-- <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                                Alias Name :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->title) ? $rowInfo->title : ""; ?>
                                        </div>
                                    </div> -->


                                    <div class="form-row">
                                        <div class="form-label col-md-3">
                                            <strong>
                                                Contact No :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-3">
                                            <?php echo !empty($rowInfo->contact_no) ? $rowInfo->contact_no : ""; ?>
                                        </div>
                                        
                                    </div>

                                    <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                                Email :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->email) ? $rowInfo->email : ""; ?>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                                Property Type :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->hotel_type) ? $rowInfo->hotel_type : ""; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                            Destination :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php 
                                                $t = Destination::find_by_id($rowInfo->destinationId);
                                                echo !empty($rowInfo->destinationId) ? $t->title : ""; ?>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                            Address :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->street) ? $rowInfo->street : ""; ?>
                                        </div>
                                    </div>

                                    <!-- <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                                City :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->city) ? $rowInfo->city : ""; ?>
                                        </div>
                                    </div> -->

                                    <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <strong>
                                                Star :
                                            </strong>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php echo !empty($rowInfo->star) ? $rowInfo->star : ""; ?>
                                        </div>
                                    </div>


                                    <!-- <div class="form-row">
                                        <div class="form-label col-md-6">
                                            <label for="">
                                                District :
                                            </label>
                                        </div>
                                        <div class="form-input col-md-6">
                                            <?php $zoneRec = Zonedestrict::getbyparent();
                                            foreach ($zoneRec as $zRow) {
                                                if (!empty($rowInfo->district) and $rowInfo->district == $zRow->zone_district) {
                                                    echo $zRow->zone_district;
                                                }
                                            } ?>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-5">
                    <div class="card-body p-5">
                        <div class="form-row">
                            <div class="form-label col-md-2">
                                <strong>
                                    Short Details :
                                </strong>
                            </div>
                            <div class="form-input col-md-10">
                                <?php echo !empty($rowInfo->detail) ? $rowInfo->detail : ""; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-5">
                    <div class="card-body p-5">
                        <div class="form-row">
                            <div class="form-label col-md-12">
                                <strong>
                                    Content :
                                </strong>
                                <div class="form-input ">
                                    <?php echo !empty($rowInfo->content) ? $rowInfo->content : ""; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-5">
                    <div class="card-body p-5">
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
                                        if (file_exists(SITE_ROOT . "images/hotelapi/" . $imageRow)):
                                            $filesize = filesize(SITE_ROOT . "images/hotelapi/" . $imageRow);

                                        endif;
                                        ?>
                                    </span>
                                                    <a class="btn small float-right" href="javascript:void(0);"
                                                       onclick="deleteSavedimage(<?php echo $k; ?>);">
                                                        <i class="glyph-icon icon-trash-o"></i>
                                                    </a>
                                                </div>
                                                <img src="<?php echo IMAGE_PATH . 'hotelapi/thumbnails/' . $imageRow; ?>"
                                                     style="width:100%"/>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endif;
                            endif; ?>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $aId = addslashes($_REQUEST['id']);
        if (is_numeric($aId)) {
            $rowInfo = Hotelapi::find_by_id($aId);
            if ($user_type == 'hotel' and $rowInfo->user_id != $accsid) {
                redirect_to(ADMIN_URL . 'dashboard');
            }
        } else {
            $user_accesskey = addslashes($_REQUEST['id']);
            $rowInfo = new Hotelapi();
        }

        $status = ($rowInfo->status == 1) ? "checked" : " ";
        $unstatus = ($rowInfo->status == 0) ? "checked" : " ";
        $feature = ($rowInfo->featured == 1) ? "checked" : " ";
        $unfeature = ($rowInfo->featured == 0) ? "checked" : " ";
        $homepg = ($rowInfo->homepage == 1) ? "checked" : " ";
        $unhomepg = ($rowInfo->homepage == 0) ? "checked" : " ";
    else: $aId = '';
    endif;
    $back = "";
    if (!is_numeric($aId)) {
        $back = $aId;
    }
    ?>
    <h3>
        <?php echo (isset($_GET['id']) and is_numeric($_GET['id'])) ? 'Edit Property' : 'Add New Property'; ?>
        <a class="btn medium bg-blue-alt float-right" href="<?php echo ADMIN_URL ?>hotelapi/list/<?php echo $back; ?>">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" method="post" class="col-md-12 center-margin" id="hotelapi_frm">

                <?php
                $add_class = "";
                if (is_numeric($aId)) {
                    $add_class = "hide";
                } else {
                    if (empty($aId)) {
                        $add_class = "";
                    } else {
                        $add_class = "hide";
                    }
                } ?>
                <!--<div class="form-row <?php echo $add_class; ?>">-->
                <!--
                <div class="form-row ">
                    <div class="form-label col-md-2">
                        <label for="">
                            Hotel User
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <!--  <?php //if (is_numeric($aId)) {
                ?>
                            <input type="hidden" name="user_id" value="<?php echo $rowInfo->user_id; ?>">
                        <?php //} else {
                //if (empty($aId)) {
                ?>
                                <select name="user_id" id="user_id" class="form-control required">
                                    <option value="">Choose Hotel User</option>
                                    <?php //$records = Hoteluser::find_by_sql("SELECT * FROM tbl_users WHERE type='hotel' and status='1' ORDER BY sortorder ASC ");
                //foreach ($records as $record):
                ?>
                                        <option value="<?php //echo $record->id;
                ?>"><?php //echo $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;
                ?></option>
                                    <?php //endforeach;
                ?>
                                </select>
                            <?php //} else {
                //$row_user = Hoteluser::get_by_accesskey($aId);
                ?>
                                <input type="hidden" name="user_id" value="<?php echo $row_user->id; ?>">
                            <?php // }
                // }
                ?>-->

                <!--
                        <select name="user_id" id="user_id" class="form-control required">
                            <option value="">Choose Hotel User</option>
                            <?php $desId = !empty($rowInfo->user_id) ? $rowInfo->user_id : 0;
                echo Hoteluser::get_user_option($desId); ?>
                        </select>
                    </div>
                </div>
                -->

                

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Hotel Full Name :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Hotel Name" class="col-md-12 validate[required,length[0,255]]" type="text"
                               name="long_name" id="long_name"
                               value="<?php echo !empty($rowInfo->long_name) ? $rowInfo->long_name : ""; ?>">
                    </div>
                </div>
                -->

                <div class="form-row">
                    <div class="form-label col-md-2">
                    <label for="">
                            Property:
                        </label>
                        
                    </div>
                    <div class="form-input col-md-10">
                        
                       <div class="row">
                            <div class="form-input col-md-8">
                            <label for="">
                        Property Name :
                        </label> <br>
                                    <input placeholder="Property Full Name" class="col-md-12 validate[required,length[0,255]]" type="text"
                                        name="title" id="title" value="<?php echo !empty($rowInfo->title) ? $rowInfo->title : ""; ?>">
                            </div>
                        
                            <div class="form-input col-md-4">
                                <label for="">Star :</label> <br>
                                <select class="col-md-4 form-input" name="star">
                                    <option value="0">Choose Star</option>
                                    <?php $ratingId = !empty($rowInfo->star) ? $rowInfo->star : 0;
                                    for ($i = 1; $i < 6; $i++) {
                                        $sel = ($i == $ratingId) ? 'selected' : '';
                                        echo '<option value="' . $i . '" ' . $sel . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
              
               

                <div class="form-row">
                    <div class="form-label col-md-2">
                       
                    </div>
                    <div class="form-input col-md-8">
                        <div class="row">
                            <?php if ($user_type == 'admin') { ?>
                   
                       
                                <div class="form-input col-md-3">
                                    <label for="">Property User</label> <br>
                                    <select name="user_id" id="user_id" class="form-control validate[required]">
                                        <option value="">Choose Property User</option>
                                        <?php $desId = !empty($rowInfo->user_id) ? $rowInfo->user_id : 0;
                                        echo Hoteluser::get_user_option($desId); ?>
                                    </select>
                                </div>
                                
                            <?php } else {
                                $userId = $session->get('u_id'); ?>
                                <input type="hidden" name="user_id" value="<?= $userId ?>">
                            <?php } ?>

                            <div class="form-input col-md-3">
                            <label for="">Property Type:</label> <br>
                                <select id="val" class="col-md-12 form-input" name="hotel_type" onchange="selectcafe()">
                                    <option value="">Choose Property Type</option>
                                    <?php
                                    $types = array("Hotel & Resort", "Restaurant", "Cafe");
                                    for ($i = 0; $i < sizeof($types); $i++) {
                                        $sel = (@$rowInfo->hotel_type == $types[$i]) ? ' selected' : '';
                                        echo '<option value="' . $types[$i] . '" ' . $sel . '>' . $types[$i] . '</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-input col-md-3">
                                <label for="">Property Code :</label> <br>
                                <input placeholder="Property Code" class=" validate[required,length[0,200]]" type="text"
                                    name="prop_code" id="prop_code"
                                    value="<?php echo !empty($rowInfo->prop_code) ? $rowInfo->prop_code : ""; ?>">
                            </div>

                            <div class="form-input col-md-3">
                                <label for="">Hotel Code :</label> <br>
                                <input placeholder="Hotel Code" class=" validate[required,length[0,200]]" type="text"
                                    name="hotel_code" id="hotel_code"
                                    value="<?php echo !empty($rowInfo->hotel_code) ? $rowInfo->hotel_code : ""; ?>">
                            </div>

                        </div>
                    </div>
                    
                </div>


                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Contact No :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        
                      <div class="row">
                        <div class="form-input col-md-4">
                                <label for="">General :</label> <br>
                                <input placeholder="Contact No" class="col-md-12 validate[required,length[0,50]]" type="text"
                                    name="contact_no" id="contact_no"
                                    value="<?php echo !empty($rowInfo->contact_no) ? $rowInfo->contact_no : ""; ?>">
                                    <small>Use ,(comma) if more than one</small>
                            </div>
                            <div class="form-input col-md-4">
                                <label for="">Reservation Contact No :</label> <br>
                                <input placeholder="Contact No" class="col-md-12" type="text"
                                    name="res_contact_no" id="res_contact_no"
                                    value="<?php echo !empty($rowInfo->res_contact_no) ? $rowInfo->res_contact_no : ""; ?>">
                            </div>
                            <div class="form-input col-md-4">
                                <label for="">Meetings & events Contact No :</label> <br>
                                <input placeholder="Contact No" class="col-md-12" type="text"
                                    name="meet_contact_no" id="meet_contact_no"
                                    value="<?php echo !empty($rowInfo->meet_contact_no) ? $rowInfo->meet_contact_no: ""; ?>">
                            </div>
                      </div>
                    </div>
                </div>
               
              

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Email :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <div class="row">
                            <div class="form-input col-md-4">
                                <label for="">General</label><br>
                                <input placeholder="Email Address" class="col-md-12 validate[required,custom[email]]" type="text"
                                    id="email" name="email" value="<?php echo !empty($rowInfo->email) ? $rowInfo->email : ""; ?>">
                            </div>
                            <div class="form-input col-md-4">
                                <label for="">Reservation Email :</label> <br>
                                <input placeholder="Email Address" class="col-md-12 validate[custom[email]" type="text"
                                    id="res_email" name="res_email" value="<?php echo !empty($rowInfo->res_email) ? $rowInfo->res_email : ""; ?>">
                            </div>
                            <div class="form-input col-md-4">
                                <label for="">Meetings & events Email :</label> <br>
                                <input placeholder="Email Address" class="col-md-12 validate[custom[email]" type="text"
                                    id="meet_email" name="meet_email" value="<?php echo !empty($rowInfo->meet_email) ? $rowInfo->meet_email : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <strong>
                            Email Inquiry :
                        </strong>
                    </div>
                    <div class="form-input col-md-6">
                        <select class="col-sm-1" name="inquiry_type">
                            <option value="1"
                                <?php echo (!empty($rowInfo->inquiry_type) AND $rowInfo->inquiry_type == 1) ? 'selected' : ""; ?>>
                                No
                            </option>
                            <option value="2"
                                <?php echo (!empty($rowInfo->inquiry_type) AND $rowInfo->inquiry_type == 2) ? 'selected' : ""; ?>>
                                Yes
                            </option>
                        </select>
                        <input placeholder="Email Address"
                               class="col-md-3 <?php echo (!empty($rowInfo->inquiry_type) AND $rowInfo->inquiry_type == 2) ? 'validate[required,custom[email]]' : ""; ?>"
                               type="text" id="inquiry_email" name="inquiry_email"
                               value="<?php echo !empty($rowInfo->inquiry_email) ? $rowInfo->inquiry_email : ""; ?>">
                    </div>
                </div>
                -->

                

               
                <div class="row">
                <div class="form-label col-md-2">
                                <label for="">Destination</label>
                            </div>
                    <div class="col-md-10">
                        <div class="form-row">
                           
                            <div class="form-input col-md-6">
                                <select name="destinationId" class="col-md-4 validate[required] destinationId">
                                    <option value=" ">Choose</option>
                                    <?php $desId = !empty($rowInfo->destinationId) ? $rowInfo->destinationId : 0;
                                    echo Destination::get_destination_option($desId); ?>
                                </select>
                                <?php if ($user_type == 'admin') { ?>
                                    <a class="btn medium bg-green" href="<?php echo ADMIN_URL ?>destination/addEdit/">
                                        <i class="glyph-icon icon-plus-circle"></i>
                                    </a>
                                <?php } ?>
                                <br>
                                <small>Choose the popular destination in which your Property lies</small>
                            </div>

                            <div class="form-input col-md-6">
                                <label for="">Address :</label><br>
                                <input placeholder="Address" class=" validate[required,length[0,200]]" type="text"
                                    name="street" id="street"
                                    value="<?php echo !empty($rowInfo->street) ? $rowInfo->street : ""; ?>">
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-md-6">

                        <div class="form-row">
                            <div class="form-label col-md-4">
                                <label for="">
                                    Zone :
                                </label>
                            </div>
                            <div class="form-input col-md-8">
                                <select name="zone" class="col-md-4 " id="zone-list">
                                    <option value="">Choose Zone</option>
                                    <?php $zoneRec = Zonedestrict::getbyparent();
                                    foreach ($zoneRec as $zRow) {
                                        $zonsel = (!empty($rowInfo->zone) and $rowInfo->zone == $zRow->zone_district) ? 'selected ' : '';
                                        $disel = !empty($rowInfo->district) ? $rowInfo->district : 0;
                                        echo '<option value="' . $zRow->zone_district . '" parentOf="' . $zRow->id . '" ' . $zonsel . ' seldest="' . $disel . '">' . $zRow->zone_district . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4">
                                <label for="">
                                    District :
                                </label>
                            </div>
                            <div class="form-input col-md-8">
                                <select name="district" class="col-md-4 " id="district-list">
                                    <option value="">Choose District</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-label col-md-4">
                                <label for="">
                                    City :
                                </label>
                            </div>
                            <div class="form-input col-md-8">
                                <input placeholder="City" class=" validate[required,length[0,200]]" type="text"
                                       name="city" id="city"
                                       value="<?php echo !empty($rowInfo->city) ? $rowInfo->city : ""; ?>">
                            </div>
                        </div>
                    </div>

                    -->

                </div>

           
              
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Website :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Website" class="col-md-8 validate[url]" type="text" name="website" id="website"
                               value="<?php echo !empty($rowInfo->website) ? $rowInfo->website : ""; ?>">
                    </div>
                </div>

                <!--<div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Nearby Attractions :
                        </label>
                    </div>

                    <div class="form-checkbox-radio col-md-10 form-input nearby_att">
                        <div class="clear"></div>

                        <?php
                        $attrs = !empty($rowInfo->nearby_attractions) ? $rowInfo->nearby_attractions : '';
                        $saveRec = unserialize(base64_decode($attrs));
                        $destination_id = !empty($rowInfo->destinationId) ? $rowInfo->destinationId : '';
                        $RecAttractions = Attractions::find_all_byparent($destination_id);

                        if ($RecAttractions) {
                            foreach ($RecAttractions as $recRow) { ?>
                                <?php
                                $i = 1;
                                $check = '';
                                $child_title = isset($saveRec[$recRow->id]['id']) ? $saveRec[$recRow->id]['title'] : $recRow->title;
                                $check = isset($saveRec[$recRow->id]['id']) ? 'checked="checked"' : ''; ?>
                                <div>
                                    <input type="checkbox" class="custom-radio"
                                           name="nearby_attractions[<?php echo $recRow->id; ?>][id]"
                                           value="<?php echo $recRow->id; ?>" <?php echo $check; ?>>
                                    <input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]"
                                           name="nearby_attractions[<?php echo $recRow->id; ?>][title]"
                                           value="<?php echo $child_title; ?>" readonly><br>
                                </div>
                                <?php
                                $i++;
                                ?>
                            <?php }
                        } else { ?>
                            <label>Please select a Destination</label>
                        <?php } ?>
                    </div>
                </div>-->


                <!-- Feature Listing -->
                <?php $svfr = !empty($rowInfo->feature) ? $rowInfo->feature : '';
                $saveRec = unserialize(base64_decode($svfr));
                $RecFearures = Hotelservices::find_all_byparent(0);

                if ($RecFearures) {
                    foreach ($RecFearures as $recRow) { ?>
                        <div class="hide form-row" id="hideser<?php echo $recRow->id; ?>">
                            <div class="form-label col-md-2">
                                <label for="">
                                    <?php echo $recRow->title; ?> :
                                </label>
                            </div>
                            <?php
                            $savedTitle = isset($saveRec[$recRow->id]['name']) ? $saveRec[$recRow->id]['name'] : $recRow->title;

                            ?>
                            <div class="form-checkbox-radio col-md-10 form-input">
                                <input type="text" placeholder="Title" class="col-md-4 validate[length[0,250]]"
                                       name="fparent[<?php echo $recRow->id; ?>][name]" value="<?php echo $savedTitle; ?>">
                                <div class="clear"></div>
                                <?php
                                $savedFeatures = isset($saveRec[$recRow->id]['features']) ? $saveRec[$recRow->id]['features'] : array();

                                $childRec = Hotelservices::find_all_byparent($recRow->id);

                                if ($childRec) {
                                    $i = 1;
                                    foreach ($childRec as $childRow) {
                                        $child_id = $childRow->id;
                                        $check = '';
                                        // $child_title = isset($savedFeatures[$child_id]['id']) ? $savedFeatures[$child_id]['title'] : $childRow->title;
                                        // $child_icon = isset($savedFeatures[$child_id]['id']) ? $savedFeatures[$child_id]['icon_class'] : $childRow->icon_class;
                                        $child_title = $childRow->title;
                                        $child_icon = $childRow->icon_class;
                                        $child_image = $childRow->image;
                                        
                                        // pr($child_image);
                                        $check = isset($savedFeatures[$child_id]['id']) ? 'checked="checked"' : ''; ?>
                                        <div ><input type="checkbox" class="custom-radio"
                                                    name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][id]"
                                                    value="<?php echo $childRow->id; ?>" <?php echo $check; ?>>
                                            <input type="hidden" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]"
                                                   name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][icon_class]"
                                                   value="<?php echo $child_icon; ?>">
                                            
                                            <input type="hidden" placeholder="Image Class" class="col-md-2 validate[length[0,30]]"
                                                   name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][image_class]"
                                                   value="<?php echo $child_image; ?>">
                                                   
                                            <input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]"
                                                   name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][title]"
                                                   value="<?php echo $child_title; ?>" readonly><br>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                } ?>

                                <?php
                                if (@sizeof($savedFeatures) > 0 and is_array($savedFeatures)) {
                                    $i = 1;

                                    foreach ($savedFeatures as $childKey => $childRow) {
                                        $child_id = $childKey;
                                        $id_arr = array();
                                        if ($childRec) {
                                            foreach ($childRec as $childRows) {
                                                $id_arr[] = $childRows->id;
                                            }
                                        }
                                        if (!in_array($child_id, $id_arr)):
                                            $check = isset($childRow['id']) ? 'checked="checked"' : ''; ?>
                                            <div><input type="checkbox" class="custom-radio"
                                                        name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][id]"
                                                        value="<?php echo $child_id; ?>" <?php echo $check; ?>>
                                                <input type="hidden" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]"
                                                       name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][icon_class]"
                                                       value="<?php echo $childRow['icon_class']; ?>">

                                                <input type="hidden" placeholder="Image Class" class="col-md-2 validate[length[0,30]]"
                                                        name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][image_class]"
                                                        value="<?php echo $childRow['image_class']; ?>">

                                                <input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]"
                                                       name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][title]"
                                                       value="<?php echo $childRow['title']; ?>">
                                                <span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br>
                                            </div>
                                            <?php
                                            $i++;
                                        endif; //inarray
                                    }
                                } ?>

                                <!--    <div id="add_option_div<?php echo $recRow->id; ?>"></div>
            <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" title="Add" onclick="addFeaturesRows('<?php echo $recRow->id; ?>');">
                            <i class="glyph-icon icon-plus-square"></i>
                       </a>  -->
                            </div>
                        </div>
                    <?php }
                } ?>


                <?php
                $id_arr = array();
                if ($RecFearures) {
                    foreach ($RecFearures as $rr) {
                        $id_arr[] = $rr->id;
                    }
                }
                if (is_array($saveRec) and sizeof($saveRec) > 0) {
                    foreach ($saveRec as $recRow) {
                        if (!in_array($recRow['id'], $id_arr)):
                            ?>
                            <div class="form-row">
                                <div class="form-label col-md-2">
                                    <label for="">
                                        <?php echo $recRow['name']; ?> :
                                    </label>
                                </div>

                                <div class="form-checkbox-radio col-md-10 form-input">
                                    <input type="text" placeholder="Title" class="col-md-4 validate[length[0,250]]"
                                           name="fparent[<?php echo $recRow['id']; ?>][name]" value="<?php echo $recRow['name']; ?>">
                                    <div class="clear"></div>
                                    <?php
                                    if (sizeof($recRow['features']) > 0) {
                                        $i = 1;
                                        foreach ($recRow['features'] as $childKey => $childRow) {
                                            $child_id = $childKey;
                                            $check = isset($childRow['id']) ? 'checked="checked"' : ''; ?>
                                            <div><input type="checkbox" class="custom-radio"
                                                        name="feature[<?php echo $recRow['id']; ?>][<?php echo $child_id; ?>][id]"
                                                        value="<?php echo $child_id; ?>" <?php echo $check; ?>>
                                                <input type="text" placeholder="Icon Class" class="col-md-2 validate[length[0,30]]"
                                                       name="feature[<?php echo $recRow['id']; ?>][<?php echo $child_id; ?>][icon_class]"
                                                       value="<?php echo $childRow['icon_class']; ?>">
                                                <input type="hidden" placeholder="Image Class" class="col-md-2 validate[length[0,30]]"
                                                   name="feature[<?php echo $recRow->id; ?>][<?php echo $child_id; ?>][image_class]"
                                                   value="<?php echo $child_image; ?>">
                                                   
                                                <input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]"
                                                       name="feature[<?php echo $recRow['id']; ?>][<?php echo $child_id; ?>][title]"
                                                       value="<?php echo $childRow['title']; ?>">
                                                <span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span><br>
                                            </div>
                                            <?php
                                            $i++;

                                        }
                                    } ?>
                                    <!--
                    <div id="add_option_div<?php echo $recRow['id']; ?>"></div>
            <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button" title="Add" onclick="addFeaturesRows('<?php echo $recRow['id']; ?>');">
                            <i class="glyph-icon icon-plus-square"></i>
                       </a> -->
                                </div>
                            </div>
                        <?php
                        endif;
                    }
                } ?>

                

                <!-- <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="image_upload" id="image_upload" class="transparent no-shadow">
                    </div> -->
                    <!-- Upload user image preview -->
                    <!-- <div id="preview_Image"><input type="hidden" name="imageArrayname[]"/></div>
                </div>

                <hr/>

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
                                if (file_exists(SITE_ROOT . "images/hotelapi/" . $imageRow)):
                                    $filesize = filesize(SITE_ROOT . "images/hotelapi/" . $imageRow);
                                    echo 'Size : ' . getFileFormattedSize($filesize);
                                endif;
                                ?>
                            </span>
                                            <a class="btn small float-right" href="javascript:void(0);"
                                               onclick="deleteSavedimage('<?php echo $k; ?>');">
                                                <i class="glyph-icon icon-trash-o"></i>
                                            </a>
                                        </div>
                                        <img src="<?php echo IMAGE_PATH . 'hotelapi/thumbnails/' . $imageRow; ?>" style="width:100%"/>
                                        <input type="hidden" name="imageArrayname[]" value="<?php echo $imageRow; ?>"/>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif;
                    endif; ?>
                </div> -->

                
                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Banner Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="banner_image_upload" id="banner_image_upload"
                               class="transparent no-shadow">
                               <label><small>Image Dimensions (2880 px X 860 px)</small></label>
                               <div id="previewhotelsimage"><input type="hidden" name="imageArraynameBanner"/></div>
                    </div>
                </div>
                
            

                <div class="form-row">
                    <?php
                if (!empty($rowInfo->banner_image)):
                    ?>
                        <div class="col-md-3" id="removeSavedimg1001">
                            <div class="infobox info-bg">
                                <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                    if (file_exists(SITE_ROOT . "images/hotelapi/banner/" . $rowInfo->banner_image)):
                        $filesize = filesize(SITE_ROOT . "images/hotelapi/banner/" . $rowInfo->banner_image);
                        echo 'Size : ' . getFileFormattedSize($filesize);
                    endif;
                    ?>
                            </span>
                                    <a class="btn small float-right" href="javascript:void(0);"
                                       onclick="deleteSavedimage('1001');">
                                        <i class="glyph-icon icon-trash-o"></i>
                                    </a>
                                </div>
                                <img src="<?php echo IMAGE_PATH . 'hotelapi/banner/thumbnails/' . $rowInfo->banner_image; ?>"
                                     style="width:100%"/>
                                <input type="hidden" name="imageArraynameBanner"
                                       value="<?php echo $rowInfo->banner_image; ?>"/>
                            </div>
                        </div>
                    <?php
                endif; ?>
                </div>
               

                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Home Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="home_image_upload" id="home_image_upload" class="transparent no-shadow">
                        <label><small>Image Dimensions (620 px X 560 px)</small></label>
                    </div>
                    <!-- Upload user image preview -->
                    <div id="preview_Home_Image"><input type="hidden" name="homeimageArrayname"/></div>
                </div>

                <div class="form-row">
                    <?php
                    if (!empty($rowInfo->home_image)):
                        $homeImage = $rowInfo->home_image; ?>
                        <div class="col-md-3" id="removeSavedimg101">
                            <?php
                            if (file_exists(SITE_ROOT . "images/hotelapi/home/" . $homeImage)):?>
                                <div class="infobox info-bg">
                                    <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                                $filesize = filesize(SITE_ROOT . "images/hotelapi/home/" . $homeImage);
                                echo 'Size : ' . getFileFormattedSize($filesize);
                                ?>
                            </span>
                                        <a class="btn small float-right" href="javascript:void(0);"
                                           onclick="deleteSavedimage('101');">
                                            <i class="glyph-icon icon-trash-o"></i>
                                        </a>
                                    </div>
                                    <img src="<?php echo IMAGE_PATH . 'hotelapi/home/thumbnails/' . $homeImage; ?>"
                                         style="width:100%"/>
                                    <input type="hidden" name="homeimageArrayname" value="<?php echo $homeImage; ?>"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Detail Page Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="detail_image_upload" id="detail_image_upload" class="transparent no-shadow">
                        <label><small>Image Dimensions (484 px X 186 px)</small></label>
                    </div>
                    <!-- Upload user image preview -->
                    <div id="preview_Detail_Image"><input type="hidden" name="detailimageArrayname"/></div>
                </div>

                <div class="form-row">
                    <?php
                    if (!empty($rowInfo->detail_image)):
                        $detailImage = $rowInfo->detail_image; ?>
                        <div class="col-md-3" id="removeSavedimg102">
                            <?php
                            if (file_exists(SITE_ROOT . "images/hotelapi/detail/" . $detailImage)):?>
                                <div class="infobox info-bg">
                                    <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                                $filesize = filesize(SITE_ROOT . "images/hotelapi/detail/" . $detailImage);
                                echo 'Size : ' . getFileFormattedSize($filesize);
                                ?>
                            </span>
                                        <a class="btn small float-right" href="javascript:void(0);"
                                           onclick="deleteSavedimage('102');">
                                            <i class="glyph-icon icon-trash-o"></i>
                                        </a>
                                    </div>
                                    <img src="<?php echo IMAGE_PATH . 'hotelapi/detail/thumbnails/' . $detailImage; ?>"
                                         style="width:100%"/>
                                    <input type="hidden" name="detailimageArrayname" value="<?php echo $detailImage; ?>"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Google Map:
                        </label>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="form-input col-md-6">
                                <label for="">Map [Embedded link] :</label> <br>
                                <textarea name="map" id="map"
                                placeholder="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14134....."
                                        class="medium-textarea"><?php echo !empty($rowInfo->map) ? $rowInfo->map : ""; ?></textarea>
                                        <small>Just copy src url and paste here</small>
                            </div>

                            <div class="form-input col-md-6">
                                <label for="">Map :</label> <br>
                                <textarea name="map_embed" id="map_embed"
                                    
                                    class="medium-textarea"><?php echo !empty($rowInfo->map_embed) ? $rowInfo->map_embed : ""; ?></textarea>
                                    <small>To redirect to google map</small>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        
                    </div>
                    
                </div>

                <!--
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Short Details :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                    <textarea name="detail" id="detail"
                              class="medium-textarea"><?php echo !empty($rowInfo->detail) ? $rowInfo->detail : ""; ?></textarea>
                    </div>
                </div>
                -->

                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Note :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Note information" class="col-md-6 validate[length[0,200]]" type="text"
                               name="note" id="note" value="<?php echo !empty($rowInfo->note) ? $rowInfo->note : ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Brief :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <textarea name="brief" id="brief"
                                  class="medium-textarea character-brief validate[required]"><?php echo !empty($rowInfo->brief) ? $rowInfo->brief : ""; ?></textarea>
                        <div class="brief-remaining clear input-description">250 characters left</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Overview :
                        </label>
                        <textarea name="content" id="content"
                                  class="large-textarea"><?php echo !empty($rowInfo->content) ? $rowInfo->content : ""; ?></textarea>
                        <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore"
                           href="javascript:void(0);">
                            <span class="button-content">Read More</span>
                        </a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="hide form-label col-md-12 ">
                        <label for="">
                            Nearby Attractions :
                        </label>
                        <textarea name="nearby_attractions" id="nearby_attractions"
                                  class="large-textarea"><?php echo !empty($rowInfo->nearby_attractions) ? $rowInfo->nearby_attractions : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_1" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                

                <div class="form-row">
                    <div id="hide" class="unhide form-label col-md-12">
                        <label for="">
                            Fitness and Wellness :
                        </label>
                        <textarea name="imp_info" id="imp_info"
                                  class="large-textarea"><?php echo !empty($rowInfo->imp_info) ? $rowInfo->imp_info : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_2" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hideb" class="unhide form-label col-md-12 ">
                        <label for="">
                            Weddings :
                        </label>
                        <textarea name="weddinghall" id="weddinghall"
                                  class="large-textarea"><?php echo !empty($rowInfo->weddinghall) ? $rowInfo->weddinghall : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_4" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hidec" class="hide form-label col-md-12 ">
                        <label for="">
                        cuisine :
                        </label>
                        <textarea name="cuisine" id="cuisine"
                                  class="large-textarea"><?php echo !empty($rowInfo->cuisine) ? $rowInfo->cuisine : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_5" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hided" class="hide form-label col-md-12 ">
                        <label for="">
                        breads :
                        </label>
                        <textarea name="breads" id="breads"
                                  class="large-textarea"><?php echo !empty($rowInfo->breads) ? $rowInfo->breads : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_6" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hidee" class="hide form-label col-md-12 ">
                        <label for="">
                        cakes :
                        </label>
                        <textarea name="cakes" id="cakes"
                                  class="large-textarea"><?php echo !empty($rowInfo->cakes) ? $rowInfo->cakes : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_7" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hidef" class="hide form-label col-md-12 ">
                        <label for="">
                        beverages :
                        </label>
                        <textarea name="beverages" id="beverages"
                                  class="large-textarea"><?php echo !empty($rowInfo->beverages) ? $rowInfo->beverages : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_8" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hideg" class="hide form-label col-md-12">
                        <label for="">
                        RESTAUARNT :
                        </label>
                        <textarea name="restaurant" id="restaurant"
                                  class="large-textarea"><?php echo !empty($rowInfo->restaurant) ? $rowInfo->restaurant: ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_3" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>
                <div class="form-row">
                    <div id="hideh" class="hide form-label col-md-12 ">
                        <label for="">
                        whyus :
                        </label>
                        <textarea name="whyus" id="whyus"
                                  class="large-textarea"><?php echo !empty($rowInfo->whyus) ? $rowInfo->whyus : ""; ?></textarea>
                                  <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore_9" href="javascript:void(0);">
                    	<span class="button-content">Read More</span>
                    </a>
                    </div>
                </div>

                <!--
                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Cleaning / Safety Practice :
                        </label>
                        <textarea name="cleaning" id="cleaning"
                                  class="large-textarea"><?php echo !empty($rowInfo->cleaning) ? $rowInfo->cleaning : ""; ?></textarea>
                    </div>
                </div>
                -->

                

                <div class="form-row hide">
                    <div class="form-label col-md-12">
                        <label for="">
                            About Property :
                        </label>
                        <textarea name="about_property" id="about_property"
                                  class="large-textarea"><?php echo !empty($rowInfo->about_property) ? $rowInfo->about_property : ""; ?></textarea>

                    </div>
                </div>

                <!--
                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Policies :
                        </label>
                        <textarea name="policy" id="policy"
                                  class="large-textarea"><?php echo !empty($rowInfo->policy) ? $rowInfo->policy : ""; ?></textarea>

                    </div>
                </div>
                -->

                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Policies :
                        </label>
                    </div>

                    <div class="form-checkbox-radio col-md-10 form-input nearby_att">
                        <div class="clear"></div>

                        <?php
                        $pols = !empty($rowInfo->policy) ? $rowInfo->policy : '';
                        $saveRec = unserialize(base64_decode($pols));
                        $RecPolicies = Policies::find_all_by_active_status();

                        if ($RecPolicies) {
                            foreach ($RecPolicies as $recRow) { ?>
                                <?php
                                $i = 1;
                                $check = '';
                                $child_title = isset($saveRec[$recRow->id]['id']) ? $saveRec[$recRow->id]['title'] : $recRow->title;
                                $check = isset($saveRec[$recRow->id]['id']) ? 'checked="checked"' : ''; ?>
                                <div>
                                    <input type="checkbox" class="custom-radio"
                                           name="policy[<?php echo $recRow->id; ?>][id]"
                                           value="<?php echo $recRow->id; ?>" <?php echo $check; ?>>
                                    <input type="text" placeholder="Title" class="col-md-6 validate[length[0,100]]"
                                           name="policy[<?php echo $recRow->id; ?>][title]"
                                           value="<?php echo $recRow->title; ?>" readonly><br>
                                </div>
                                <?php
                                $i++;
                            }
                        } ?>
                    </div>
                </div>

                <!--
                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            FAQ :
                        </label>
                        <textarea name="faq" id="faq"
                                  class="large-textarea"><?php echo !empty($rowInfo->faq) ? $rowInfo->faq : ""; ?></textarea>

                    </div>
                </div>
                -->

                <!--
                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            FAQ :
                        </label>
                        <?php
                $svfr = !empty($rowInfo->faq) ? $rowInfo->faq : '';
                $saveRec = unserialize(base64_decode($svfr));

                $i = 1;

                if (!empty($saveRec)) {
                    foreach ($saveRec as $saveRow) { ?>
                                <div class="form-checkbox-radio col-md form-input">
                                    <div>
                                        <input type="text" placeholder="Question" class="col-md-3 validate[]"
                                               name="faq[<?= $i ?>][question]" value="<?php echo $saveRow['question']; ?>">
                                        <input type="text" placeholder="Answer" class="col-md-8 validate[]"
                                               name="faq[<?= $i ?>][answer]" value="<?php echo $saveRow['answer']; ?>">
                                        <span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span>
                                        <br>
                                    </div>
                                </div>
                                <?php $i++;
                    }
                } ?>

                        <div id="add_faq_div" class="form-input"></div>
                        <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button mrg5T" title="Add"
                           id="faq_add" onclick="addFaqRows(<?= $i ?>);">
                            <i class="glyph-icon icon-plus-square"></i>
                        </a>
                    </div>
                </div>
                -->

                <div class="form-row hide">
                    <div class="form-label col-md-12">
                        <label for="">
                            FAQ :
                        </label>
                    </div>

                    <div class="form-checkbox-radio col-md-10 form-input nearby_att">
                        <div class="clear"></div>

                        <?php
                        $faqs = !empty($rowInfo->faq) ? $rowInfo->faq : '';
                        $saveRec = unserialize(base64_decode($faqs));
                        $RecFaqs = Hotelfaq::find_all_by_active_status();

                        if ($RecFaqs) {
                            foreach ($RecFaqs as $recRow) { ?>
                                <?php
                                $check = isset($saveRec[$recRow->id]['id']) ? 'checked="checked"' : '';
                                $child_question = isset($saveRec[$recRow->id]['id']) ? $saveRec[$recRow->id]['question'] : $recRow->title;
                                $child_answer = isset($saveRec[$recRow->id]['id']) ? $saveRec[$recRow->id]['answer'] : '';
                                ?>
                                <div class="form-checkbox-radio col-md form-input">
                                    <input type="checkbox" class="custom-radio"
                                           name="faq[<?php echo $recRow->id; ?>][id]"
                                           value="<?php echo $recRow->id; ?>" <?php echo $check; ?>>
                                    <input type="text" placeholder="Title" class="col-md-11 mrg5L validate[length[0,100]]"
                                           name="faq[<?php echo $recRow->id; ?>][question]"
                                           value="<?php echo $recRow->title; ?>" readonly><br>
                                    <textarea placeholder="Answer" class="col-md-11 mrg25L validate[]" rows="3"
                                              name="faq[<?= $recRow->id; ?>][answer]"><?php echo $child_answer; ?></textarea>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>

                <!--
                <div class="form-row">
                    <div class="form-label col-md-12">
                        <label for="">
                            Nearby Attractions :
                        </label>
                        <?php
                $svfr = !empty($rowInfo->nearby_attractions) ? $rowInfo->nearby_attractions : '';
                $saveRec = unserialize(base64_decode($svfr));

                $i = 1;

                if (!empty($saveRec)) {
                    foreach ($saveRec as $saveRow) { ?>
                                <div class="form-checkbox-radio col-md form-input">
                                    <div>
                                        <input type="text" placeholder="Title" class="col-md-3 validate[]"
                                               name="nearby_attractions[<?= $i ?>][title]" value="<?php echo $saveRow['title']; ?>">
                                        <input type="text" placeholder="Location" class="col-md-8 validate[]"
                                               name="nearby_attractions[<?= $i ?>][location]"
                                               value="<?php echo $saveRow['location']; ?>">
                                        <span class="cp remove_feature_row"><i class="glyph-icon icon-minus-square"></i></span>
                                        <br>
                                    </div>
                                </div>
                                <?php $i++;
                    }
                } ?>

                        <div id="add_nearby_div" class="form-input"></div>
                        <a href="javascript:void(0);" class="btn medium bg-blue tooltip-button mrg5T" title="Add"
                           id="nearby_add" onclick="addNearbyRows(<?= $i ?>);">
                            <i class="glyph-icon icon-plus-square"></i>
                        </a>
                    </div>
                </div>
                -->
            <div class="row">
                <div class="col-md-6">
                <h3 class="">OTA Details</h3>
                <div class="form-row">
                    <div class="form-label col-md-4">
                        <label for="">
                            Booking.com :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Booking.com" class="col-md-12 validate[length[0,255]]" type="text"
                               name="ota_booking_com" id="ota_booking_com"
                               value="<?php echo !empty($rowInfo->ota_booking_com) ? $rowInfo->ota_booking_com : ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-4">
                        <label for="">
                            Tripadvisor :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Tripadvisor" class="col-md-12 validate[length[0,255]]" type="text"
                               name="ota_trip_advisor" id="ota_trip_advisor"
                               value="<?php echo !empty($rowInfo->ota_trip_advisor) ? $rowInfo->ota_trip_advisor : ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-4">
                        <label for="">
                            Expedia :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Expedia" class="col-md-12 validate[length[0,255]]" type="text"
                               name="ota_expedia" id="ota_expedia"
                               value="<?php echo !empty($rowInfo->ota_expedia) ? $rowInfo->ota_expedia : ""; ?>">
                    </div>
                </div>
    </div>
    <div class="col-md-6">
    <h3 class="">Social Media Details</h3>
                <div class="form-row">
                    <div class="form-label col-md-4">
                        <label for="">
                            Facebook :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Facebook" class="col-md-12 validate[length[0,255]]" type="text"
                               name="social_facebook" id="social_facebook"
                               value="<?php echo !empty($rowInfo->social_facebook) ? $rowInfo->social_facebook : ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-4">
                        <label for="">
                            Instagram :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Instagram" class="col-md-12 validate[length[0,255]]" type="text"
                               name="social_instagram" id="social_instagram"
                               value="<?php echo !empty($rowInfo->social_instagram) ? $rowInfo->social_instagram : ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-4">
                        <label for="">
                            Tik Tok :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Tik Tok" class="col-md-12 validate[length[0,255]]" type="text"
                               name="social_tiktok" id="social_tiktok"
                               value="<?php echo !empty($rowInfo->social_tiktok) ? $rowInfo->social_tiktok : ""; ?>">
                    </div>
                </div>

    </div>
</div>
                

               


                <h3 class="hide">Front Details</h3>
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                        Property Rooms :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Rooms" class="col-md-4 validate[length[0,255]]" type="text"
                               name="hotel_rooms" id="hotel_rooms"
                               value="<?php echo !empty($rowInfo->hotel_rooms) ? $rowInfo->hotel_rooms : ""; ?>">
                    </div>
                </div>
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Customers Per Year :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="No. of Customers Per Year" class="col-md-4 validate[length[0,255]]" type="text"
                               name="customers_per_year" id="customers_per_year"
                               value="<?php echo !empty($rowInfo->customers_per_year) ? $rowInfo->customers_per_year : ""; ?>">
                    </div>
                </div>
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Distance to Center :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Distance to Center" class="col-md-4 validate[length[0,255]]" type="text"
                               name="distance_to_center" id="distance_to_center"
                               value="<?php echo !empty($rowInfo->distance_to_center) ? $rowInfo->distance_to_center : ""; ?>">
                    </div>
                </div>
                


                <h3 class="hide">Contact Information</h3>
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Contact Person :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Contact Person" class="col-md-4 validate[required,length[0,200]]" type="text"
                               name="contact_person" id="contact_person"
                               value="<?php echo !empty($rowInfo->contact_person) ? $rowInfo->contact_person : ""; ?>">
                    </div>
                </div>
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Contact No :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Contact No" class="col-md-4 validate[required,length[0,200]]" type="text"
                               name="contact_person_contact_no" id="contact_person_contact_no"
                               value="<?php echo !empty($rowInfo->contact_person_contact_no) ? $rowInfo->contact_person_contact_no : ""; ?>">
                    </div>
                </div>
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Email :
                        </label>
                    </div>
                    <div class="form-input col-md-6">
                        <input placeholder="Email Address" class="col-md-4 validate[required,custom[email]]" type="text"
                               id="contact_person_email" name="contact_person_email"
                               value="<?php echo !empty($rowInfo->contact_person_email) ? $rowInfo->contact_person_email : ""; ?>">
                    </div>
                </div>


                <?php if ($accsid == '1') { ?>

                    <h3 class="hide">Payment Gateway</h3>
                    <div class="form-row hide">
                        <div class="form-label col-md-2">
                            <label for="">
                                Type :
                            </label>
                        </div>
                        <div class="form-input col-md-6">
                            <select name="payment_type" id="payment_type" class="col-md-2 validate[required]">
                                <option value="">Choose</option>
                                <option value="1"
                                    <?php echo (!empty($rowInfo->payment_type) and $rowInfo->payment_type == '1') ? 'selected' : ''; ?>>
                                    Stripe
                                </option>
                                <option value="2"
                                    <?php echo (!empty($rowInfo->payment_type) and $rowInfo->payment_type == '2') ? 'selected' : ''; ?>>
                                    Braintree
                                </option>
                                <option value="3"
                                    <?php echo (!empty($rowInfo->payment_type) and $rowInfo->payment_type == '3') ? 'selected' : ''; ?>>
                                    Himalayan Bank
                                </option>
                                <option value="4"
                                    <?php echo (!empty($rowInfo->payment_type) and $rowInfo->payment_type == '4') ? 'selected' : ''; ?>>
                                    Nabil Bank
                                </option>
                            </select>
                        </div>
                    </div>
                    <div
                            class="form-row hide hblinfo <?php echo (!empty($rowInfo->payment_type) and $rowInfo->payment_type != '3') ? 'hide' : ''; ?>">
                        <div class="">
                            <div class="col-sm-3 form-input">
                                <label class="form-label">Merchant ID</label>
                                <input class="form-control" type="text" name="merchant_id"
                                       value="<?php echo !empty($rowInfo->merchant_id) ? $rowInfo->merchant_id : ""; ?>">
                            </div>
                            <div class="col-sm-4 form-input">
                                <label class="form-label">Secrek Key</label>
                                <input class="form-control" type="text" name="merchant_key"
                                       value="<?php echo !empty($rowInfo->merchant_key) ? $rowInfo->merchant_key : ""; ?>">
                            </div>
                        </div>
                    </div>

                    <div
                            class="form-row hide nabilinfo <?php echo (!empty($rowInfo->payment_type) and $rowInfo->payment_type != '4') ? 'hide' : ''; ?>">
                        <div class="">
                            <div class="col-sm-2 form-input">
                                <label class="form-label">Transaction</label>
                                <select name="nabil_mode" class="form-control">
                                    <option value="1"
                                        <?php echo (!empty($rowInfo->nabil_mode) and $rowInfo->nabil_mode == 1) ? 'selected' : ''; ?>>
                                        Test Mode
                                    </option>
                                    <option value="2"
                                        <?php echo (!empty($rowInfo->nabil_mode) and $rowInfo->nabil_mode == 2) ? 'selected' : ''; ?>>
                                        Live Mode
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-4 form-input">
                                <label class="form-label">Merchant ID</label>
                                <input class="form-control" type="text" name="nmerchant_id"
                                       value="<?php echo !empty($rowInfo->merchant_id) ? $rowInfo->merchant_id : ""; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">*.crt file</label>
                                <input type="file" id="twpg_cert_file" class="transparent no-shadow">
                                <input type="hidden" name="twpg_cert_file"
                                       value="<?php echo !empty($rowInfo->twpg_cert_file) ? $rowInfo->twpg_cert_file : ""; ?>"/>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">*.key file</label>
                                <input type="file" id="twpg_key_file" class="transparent no-shadow">
                                <input type="hidden" name="twpg_key_file"
                                       value="<?php echo !empty($rowInfo->twpg_key_file) ? $rowInfo->twpg_key_file : ""; ?>"/>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <input type="hidden" name="payment_type" value="3">
                <?php } ?>

                <button btn-action='0' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save"><span class="button-content">Save</span></button>
                <input myaction='0' type="hidden" name="idValue" id="idValue"
                       value="<?php echo !empty($rowInfo->id) ? $rowInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>
    <script>
        var base_url = "<?php echo ASSETS_PATH; ?>";
        var editor_arr = ["content", ,];
        create_editor(base_url, editor_arr);
        var editor_arr_1 = ["nearby_attractions"];
        create_editor_1(base_url, editor_arr_1);
        var editor_arr_2 = ["imp_info"];
        create_editor_2(base_url, editor_arr_2);
        var editor_arr_3 = ["restaurant",];
        create_editor_3(base_url, editor_arr_3);
        var editor_arr_4 = ["weddinghall"];
        create_editor_4(base_url, editor_arr_4);
        var editor_arr_5 = ["cuisine"];
        create_editor_5(base_url, editor_arr_5);
        var editor_arr_6 = ["breads"];
        create_editor_6(base_url, editor_arr_6);
        var editor_arr_7 = ["cakes"];
        create_editor_7(base_url, editor_arr_7);
        var editor_arr_8 = ["beverages"];
        create_editor_8(base_url, editor_arr_8);
        var editor_arr_9 = ["whyus"];
        create_editor_9(base_url, editor_arr_9);
    
        
    </script>

    <link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script>
    selectcafe()
    function selectcafe(){
        let val = document.getElementById('val').value
        // console.log(val);
        switch(val){
            
        case"Restaurant":
            var bro = document.querySelector("#hide");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hideb");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hidec");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hided");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hidee");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hidef");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hideg");
            bro.classList.replace("hide", "hide");
            var bro = document.querySelector("#hideh");
            bro.classList.replace("hide", "hide");
            var bro = document.querySelector("#hideser26");
            bro.classList.replace("hide", "unhide");
            var broa = document.querySelector("#hideser5");
            broa.classList.replace("unhide", "hide");
            var brob = document.querySelector("#hideser27");
            brob.classList.replace("unhide", "hide");
            break;   
        case"Cafe":
            var bro = document.querySelector("#hide");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hideb");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hidec");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hided");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hidee");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hidef");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hideg");
            bro.classList.replace("hide", "hide");
            var bro = document.querySelector("#hideh");
            bro.classList.replace("hide", "unhide");
            var broc = document.querySelector("#hideser27");
            broc.classList.replace("hide", "unhide");
            var brod = document.querySelector("#hideser5");
            brod.classList.replace("unhide", "hide");
            var broe = document.querySelector("#hideser26");
            broe.classList.replace("unhide", "hide");
        break;
        case"Hotel & Resort":
            var bro = document.querySelector("#hide");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hideb");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hidec");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hided");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hidee");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hidef");
            bro.classList.replace("unhide", "hide");
            var bro = document.querySelector("#hideg");
            bro.classList.replace("hide", "unhide");
            var bro = document.querySelector("#hideh");
            bro.classList.replace("hide", "unhide");
            var brof = document.querySelector("#hideser5");
            brof.classList.replace("hide", "unhide");
            var brog = document.querySelector("#hideser26");
            brog.classList.replace("unhide", "hide");
            var broh = document.querySelector("#hideser27");
            broh.classList.replace("unhide", "hide");
           
        break;
        default:
        const element = document.querySelector('div');
            element.setAttribute('hide', '');
        }
    }
    </script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#image_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/image_uploadify',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/',
                    thumb_width: 720,
                    thumb_height: 560
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
                    $('#uploadedImageName').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_image.php', {
                        imagefile: filename
                    }, function (msg) {
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

            $('#logo_image_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/logo/',
                    thumb_width: 360,
                    thumb_height: 360
                },
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
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_logo_image.php', {
                        imagefile: filename
                    }, function (msg) {
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

            $('#home_image_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/home/',
                    thumb_width: 360,
                    thumb_height: 360
                },
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
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_home_image.php', {
                        imagefile: filename
                    }, function (msg) {
                        $('#preview_Home_Image').html(msg).show();
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

            $('#detail_image_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/detail/',
                    thumb_width: 360,
                    thumb_height: 360
                },
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
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_detail_image.php', {
                        imagefile: filename
                    }, function (msg) {
                        $('#preview_Detail_Image').html(msg).show();
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
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/banner/',
                    thumb_width: 360,
                    thumb_height: 360
                },
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
                    $.post('<?php echo BASE_URL;?>apanel/hotelapi/uploaded_hotel_image.php', {
                        imagefile: filename
                    }, function (msg) {
                        $('#previewhotelsimage').html(msg).show();
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

            // Nabil
            $('#twpg_cert_file').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/file_uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/docs/',
                    thumb_width: 360,
                    thumb_height: 270
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'width': 125,
                'height': 21,
                'auto': true,
                'multi': false,
                'hideButton': false,
                'buttonText': 'Upload Certificate',
                'progressData': 'speed',
                'uploadLimit': 5,
                'fileTypeExts': '*.crt;',
                'onUploadSuccess': function (file, data, response) {
                    var filename = data;
                    $('input[name="twpg_cert_file"]').val(filename);
                }
            });

            $('#twpg_key_file').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/file_uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/hotelapi/docs/',
                    thumb_width: 360,
                    thumb_height: 270
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'width': 125,
                'height': 21,
                'auto': true,
                'multi': false,
                'hideButton': false,
                'buttonText': 'Upload RSA Key',
                'progressData': 'speed',
                'uploadLimit': 5,
                'fileTypeExts': '*.key;',
                'onUploadSuccess': function (file, data, response) {
                    var filename = data;
                    $('input[name="twpg_key_file"]').val(filename);
                }
            });


        });
        // ]]>
    </script>
<?php endif; 
require_once 'offers.php';
require_once 'hall.php';
?>