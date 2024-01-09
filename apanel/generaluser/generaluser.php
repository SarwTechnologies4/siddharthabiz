<?php
$moduleTablename = "tbl_users"; // Database table name
$moduleId = 1;                // module id >>>>> tbl_modules
$moduleFoldername = "";        // Image folder name

// $position = array(1=>'Cash', 2=>'Point', 3=>'Prize');

$position = array(1=>'Add Point', 3=>'Deduct Point');
$packages = array(0=>'Package', 1=>'A La Carta');

// pr($_SESSION);
if (isset($_GET['page']) && $_GET['page'] == "generaluser" && isset($_GET['mode']) && $_GET['mode'] == "list"):
    ?>


<form action="" method="post" id="the_form">

    <!-- <div class="col-sm-4 form-input">
From <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="datepicker form-control" value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>" autocomplete="off"/> 
</div>
<div class="col-sm-4 form-input">
To <input type="text" name="end_date" id="end_date" placeholder="End Date" class="datepicker form-control" value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>" autocomplete="off"/>
</div> -->


<div class="row">
<div class="col-sm-4 form-input">
<div class="">
                 
                        <div class="form-input">
                            <select name="prop_id" id="prop_id" class="form-control validate[required]" <?php echo $disabled ?>>
                                <option value="">Choose Property ID</option>
                                <?php 
                                $desId = !empty($usersInfo->prop_id) ? $usersInfo->prop_id : '';
                                echo Hotelapi::get_user_option($desId); ?>
                            </select>
                        </div>
                        
                    </div>
</div>
<div class="col-sm-3">

<input type="hidden" name="export_type" id="export_type" value="all" />
<input type="button" name="export_selected" id="export_selected" value="Upcoming Birthday" class="btn medium bg-blue-alt" />
</div>
<div class="col-sm-3">

<!-- <input type="button" name="export_all" id="export_all" value="Export All" class="btn medium bg-blue-alt " /> -->
</div>
</div>
</form>


    <h3>
        Approved Users

        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewUsers();">
            <span class="glyph-icon icon-separator">
                <i class="glyph-icon icon-plus-square"></i>
            </span>
            <span class="button-content"> Add User </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                <tr>
                    <th class="text-center">S.No.</th>
                    <th class="text-center">Id</th>
                    <th class="text-left">Full Name</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Phone</th>
                    <th class="text-left">Address</th>
                    <th class="text-left">Reg.date</th>
                    <th class="text-left">DOB.date</th>


                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                <tr>
                    <th class=""></th>
                    <th><input type="text" id="column1_filter" /></th>
                    <th><input type="text" id="column2_filter" /></th>
                    <th><input type="text" id="column3_filter" /></th>
                    <th><input type="text" id="column4_filter" /></th>
                    <th><input type="text" id="column5_filter" /></th>
                    <th><input type="text" id="column6_filter" /></th>
                    <th><input type="text" id="column7_filter" /></th>

                    <th></th>
                </tr>

                </thead>

                <tbody>

                <?php 
                
                $records = Generaluser::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE type='general' AND status='1' ORDER BY sortorder DESC ");
                
            //     $records = Generaluser::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE type='general' AND status='1' ORDER BY CASE
            //     WHEN MONTH(dob) > MONTH(CURDATE()) OR (MONTH(dob) = MONTH(CURDATE()) AND DAY(dob) >= DAY(CURDATE()))
            //     THEN 0
            //     ELSE 1
            // END,
            // MONTH(dob),
            // DAY(dob);");

                foreach ($records as $key => $record): 
                $user_id = $record->id; ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td class="text-center"><?php echo $key + 1;?></td>
                        <td>
                            <?php 
                                      $property = Hotelapi::find_by_id($record->prop_id);
                            echo (!empty($property->prop_code ) && !empty($record->id)) ? $property->prop_code . "-" . $record->id : ''; ?>
                        </td>
                        <td>
                            <div class="col-md-7">
                                <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);" class="loadingbar-demo"
                                   title="<?php echo $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name; ?>"><?php echo $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name; ?></a>
                            </div>
                        </td>
                        <td>
                            <?php echo !empty($record->email) ? $record->email : ''; ?>
                        </td>
                        <td>
                        
                            <?php echo !empty($record->contact) ? $record->contact : ''; ?>
                        </td>
                        <td>
                        <?php echo !empty($record->address) ? $record->address : ''; ?>
                        </td>
                        <td>
                        <?php echo !empty($record->added_date) ? $record->added_date : ''; ?>
                        </td>
                        <td>
                        <?php echo !empty($record->dob) ? $record->dob : ''; ?>
                        </td>

                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <?php if ($record->group_id != 1): ?>
                                <a href="javascript:void(0);"
                                   class="btn small <?php echo $statusImage; ?> tooltip-button statusTogglerr lstatusToggler" data-placement="top"
                                   title="<?php echo $statusText; ?>" status="<?php echo $record->status; ?>"
                                   id="imgHolder_<?php echo $record->id; ?>" moduleId="<?php echo $record->id; ?>">
                                    <i class="glyph-icon icon-flag"></i>
                                </a>
                            <?php endif; ?>
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top"
                               title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <?php if ($record->group_id != 1): ?>
                                <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                                   onclick="recordDelete(<?php echo $record->id; ?>);">
                                    <i class="glyph-icon icon-remove"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <!-- <tfoot>
                <tr>
                <th></th>
                <th>id</th>
                <th>full name</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>reg.date</th>
                </tr>
            </tfoot> -->
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function () {


        $('#start_date').datepicker({
            dateFormat :"yy-mm-dd",
        });
        $('#end_date').datepicker({
            dateFormat :"yy-mm-dd",
        });
    });



    $(function(){
    $(document).on('click','#export_all,#export_selected',function(){
        console.log($(this).val());
        if($(this).val()=="Export All")
        {
        $("#export_type").val('all');
        }else{
        $("#export_type").val('selected');
        }
        $('#the_form').attr('action',"<?php echo BASE_URL?>apanel/report.php").submit();
    });  
    
        $(document).on('click','#searchBtn',function(){
        $('#the_form').attr('action',"").submit();
    });  
    
    
    });
    </script>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $userId = addslashes($_REQUEST['id']);
        $usersInfo = Generaluser::find_by_id($userId);
        $published = ($usersInfo->status == 1) ? "checked" : "";
        $unpublished = ($usersInfo->status == 0) ? "checked" : "";
        $male = ($usersInfo->gender == 1) ? "checked" : "";
        $female = ($usersInfo->gender == 0) ? "checked" : "";

        $physicalcardyes = ($usersInfo->physicalcard == 1) ? "checked" : "";
        $physicalcardno = ($usersInfo->physicalcard == 0) ? "checked" : "";

        $active = ($usersInfo->status == 1) ? "checked" : "";
        $inactive = ($usersInfo->status == 0) ? "checked" : "";
    endif;
    ?>





    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit User' : 'Add Hotel User'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewuserslist();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
            <span class="button-content"> Back </span>
        </a>
        <?php if (isset($_GET['id']) && !empty($_GET['id'])):?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right me-3" href="javascript:void(0);" onClick="updateRecord(<?php echo $usersInfo->id; ?>);">

            <span class="button-content"> Update Records </span>
        </a>
        <?php      endif;?>

        <?php if (isset($_GET['id']) && !empty($_GET['id'])):?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right me-3" href="javascript:void(0);" onClick="correctRecord(<?php echo $usersInfo->id; ?>);">

            <span class="button-content"> Correction </span>
        </a>
        <?php      endif;?>

    </h3>
    <script language="javascript">
        $(document).ready(function () {
            $('#adminusersetting_frm').passroids({
                main: '#password',
                verify: '#passwordConfirm',
                minimum: 6
            });
        });
    </script>

    <?php 
    $readonly = '';
    $disabled ='';
    if($user_type == "hotel" && isset($_GET['id']) && !empty($_GET['id'])){
        $readonly = " readonly ";
        $disabled =' disabled';

    }
    ?>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="example-code">
            <form action="" class="" 
            <?php     
            if(!($user_type == "hotel" && isset($_GET['id']) && !empty($_GET['id']))){
                echo 'id="adminusersetting_frm"';
            }?>>
                <h4 class="mb-3">User Details</h4>
                <hr class="mb-5"/>

                <div class="row">
                    <div class="form-row hide">
                        <div class="row">
                            <div class="form-label col-md-4">
                                <label for="">
                                    Group Type :
                                </label>
                            </div>
                            <div class="form-input col-md-8" style="padding:0px !important;">
                                <!-- <select data-placeholder="Choose Field Type" class="chosen-select validate[required,length[0,500]]" id="field_type" name="field_type">
                                <option value=""></option>
                                <?php $GroupTypeRec = Usergrouptype::find_all(2);
                                if ($GroupTypeRec): foreach ($GroupTypeRec as $GroupTypeRow):
                                    $sel = (!empty($usersInfo->group_id) && $usersInfo->group_id == $GroupTypeRow->id) ? 'selected' : '';
                                    ?>
                                <option value="<?php echo $GroupTypeRow->id; ?>" <?php echo $sel; ?>><?php echo $GroupTypeRow->group_name; ?></option>
                                <?php endforeach; endif; ?>
                            </select> -->
                                <input type="hidden" name="field_type" name="field_type" value="3">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-row-one">
                            <div class="row">
                                <div class="form-label col-md-3">
                                    <label for="">
                                    Property ID
                                    </label>
                                </div>
                                <div class="form-input col-md-9">
                                    <select name="prop_id" id="prop_id" class="form-control validate[required]" <?php echo $disabled ?>>
                                        <option value="">Choose Property ID</option>
                                        <?php 
                                        $desId = !empty($usersInfo->prop_id) ? $usersInfo->prop_id : '';
                                        echo Hotelapi::get_user_option($desId); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Name :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Name" class=" validate[required,length[0,50]]" type="text" name="first_name" id="first_name"
                                       value="<?php echo !empty($usersInfo->first_name) ? $usersInfo->first_name : ""; ?>" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-label col-md-4">
                            <label for="">
                                Middle Name :
                            </label>
                        </div>
                        <div class="form-input col-md-8">
                            <input placeholder="Middle Name" class="col-md-4 validate[length[0,50]]" type="text" name="middle_name" id="middle_name"
                                   value="<?php echo !empty($usersInfo->middle_name) ? $usersInfo->middle_name : ""; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-label col-md-4">
                            <label for="">
                                Last Name :
                            </label>
                        </div>
                        <div class="form-input col-md-8">
                            <input placeholder="Last Name" class="col-md-4 validate[length[0,50]]" type="text" name="last_name" id="last_name"
                                   value="<?php echo !empty($usersInfo->last_name) ? $usersInfo->last_name : ""; ?>">
                        </div>
                    </div>
                    -->

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Username :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Username" class="validate[required,maxSize[10],custom[onlyLetterNumber]]" type="text"
                                       name="username" id="username" value="<?php echo !empty($usersInfo->username) ? $usersInfo->username : ""; ?>" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Password :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Password" class="<?php echo !empty($usersInfo) ? '' : 'validate[required,length[0,50]]'; ?>"
                                       type="password" name="password" id="password" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Re-password :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Re-password" class=" validate[equals[password]]" type="password" id="passwordConfirm" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Contact No :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Contact No" class="validate[required,length[0,50]]" type="text" name="contact" id="contact"
                                       value="<?php echo !empty($usersInfo->contact) ? $usersInfo->contact : ""; ?>" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Email :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Email Address" class="validate[required,custom[email]]" type="text" id="email" name="email"
                                       value="<?php echo !empty($usersInfo->email) ? $usersInfo->email : ""; ?>" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Address :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Address" class="validate[required,length[0,50]]" type="text" id="address" name="address"
                                       value="<?php echo !empty($usersInfo->address) ? $usersInfo->address : ""; ?>" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    DOB :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <input placeholder="Date of Birth" class="validate[required,length[0,50]] datepicker" type="text" id="dob" name="dob"
                                       value="<?php echo !empty($usersInfo->dob) ? $usersInfo->dob : ""; ?>" <?php echo $readonly ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3"><label for="">Gender</label></div>
                            <div class="form-checkbox-radio col-md-9">
                                <input type="radio" class="custom-radio" name="gender" id="check1"
                                       value="1" <?php echo !empty($male) ? $male : "checked"; ?> <?php echo $disabled ?>>
                                <label for="">Male</label>
                                <input type="radio" class="custom-radio" name="gender" id="check0"
                                       value="0" <?php echo !empty($female) ? $female : ""; ?> <?php echo $disabled ?>>
                                <label for="">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-4"><label for="">Physical Mileage Card</label></div>
                            <div class="form-checkbox-radio col-md-8">
                                <input type="radio" class="custom-radio" name="physicalcard" id="check1"
                                       value="1" <?php echo !empty($physicalcardyes) ? $physicalcardyes : "checked"; ?> <?php echo $disabled ?>>
                                <label for="">Yes</label>
                                <input type="radio" class="custom-radio" name="physicalcard" id="check0"
                                       value="0" <?php echo !empty($physicalcardno) ? $physicalcardno : ""; ?> <?php echo $disabled ?>>
                                <label for="">No</label>
                            </div>
                        </div>
                    </div>
                    <?php     if (isset($_GET['id']) && !empty($_GET['id'])): ?>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Status :
                                </label>
                            </div>
                            <div class="form-checkbox-radio col-md-9">
                                <input type="radio" class="custom-radio" name="status" id="check1"
                                    value="1" <?php echo !empty($active) ? $active : "checked"; ?> <?php echo $disabled ?>>
                                <label for="">Active</label>
                                <input type="radio" class="custom-radio" name="status" id="check0"
                                    value="0" <?php echo !empty($inactive) ? $inactive : ""; ?> <?php echo $disabled ?>>
                                <label for="">Inactive</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row-one row">
                            <div class="form-label col-md-3">
                                <label for="">
                                    Level :
                                </label>
                            </div>
                            <div class="form-input col-md-9">
                                <label for="">
                                    <?php
                                    $user_get = Generaluser::find_by_id($_GET['id']);
                                    $count= Level::greater_level_count($user_get->actual_point);
                                $data = Level::get_level($user_get->actual_point, $count);   
                                    echo ($data)?$data[0]->title:'Undefined';
                                    ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <?php      endif;?>
                <div class="form-row hide">
                    <div class="form-label col-md-4">
                        <label for="">
                            CC Email :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="CC Email Address" class="col-md-4" type="text" id="optional_email" name="optional_email"
                               value="<?php echo !empty($usersInfo->optional_email) ? $usersInfo->optional_email : ""; ?>">
                        <br/>
                        <small>if more than one email address. e.g. email1@email.com;email2@email.com</small>
                    </div>
                </div>
                <!-- <div class="form-row">
                    <div class="form-label col-md-4"></div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1"
                               value="1" <?php echo !empty($published) ? $published : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0"
                               value="0" <?php echo !empty($unpublished) ? $unpublished : ""; ?>>
                        <label for="">Un-published</label>
                    </div>
                </div> -->
                
                <div class="row">
                <div class="form-label col-md-4">

                <?php     
                if(!($user_type == "hotel" && isset($_GET['id']) && !empty($_GET['id']))):?>
                <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>

                <?php endif;?>
                </div>
            </div>
                 </div>

                <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($userId) ? $userId : 0; ?>"/>

            </form>

               

        
    </div>
    <?php     if (isset($_GET['id']) && !empty($_GET['id'])): ?>
        <div class="col-sm-12 apanel-text2">
            <div class="alert alert-grey d-flex">
                <div>
                Usable Points: 
            <?php   $user_get = Generaluser::find_by_id($_GET['id']);
                            echo $user_get->usable_point;
                        ?>
                        </div>
                        <div class="px-4">|</div>
                        <div>

                        Life time Point: <?php $user_get = Generaluser::find_by_id($_GET['id']);
                            echo $user_get->actual_point; ?>
                        </div>
            </div>
            <div class="example-box pt-0" style="border-top:0;">
                <h4 class="mb-3">Reward Points</h4>
                <form action="" method="post" id="the_form">
                    <div class="row">
                        <div class="col-sm-3 form-input">
                            From <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="datepicker form-control" value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>" autocomplete="off"/> 
                        </div>

                        <div class="col-sm-3 form-input">
                            To <input type="text" name="end_date" id="end_date" placeholder="End Date" class="datepicker form-control" value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>" autocomplete="off"/>
                        </div>

                        <div class="col-sm-3">
                            <input type="hidden" name="export_type" id="export_type" value="all" />
                            <input type="hidden" name="userid" id="userid" value="<?php echo $_GET['id'] ?>" />

                            <input type="button" name="export_selected_point" id="export_selected_point" value="Export Selected" class="btn medium bg-blue-alt apanel-btn5" />
                        </div>

                        <div class="col-sm-3">
                            <input type="button" name="export_all_point" id="export_all_point" value="Export All" class="btn meallexport dium bg-blue-alt apanel-btn5" />
                        </div>
                    </div>
                </form>

                <div class="example-code apanel-text2">
                    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                        <thead>
                            <tr>
                                <th class="text-center hide">S.No.</th>
                                <th class="text-left" width="10%">Date</th>
                                <th class="text-left" width="15%">Particulars</th>
                                <th class="text-left" width="10%" title="Method of Payment">Method</th>

                                <th class="text-left" width="15%" title="Transaction point">Transaction point</th>
                                <th class="text-left" width="10%"title="Useable Points">Useable Points</th>
                                <th class="text-left" width="10%" title="Lifetime Points">Lifetime Points</th>
                                <th class="text-left" width="10%" title="Branch">Branch</th>
                                <th class="text-left" width="15%" title="Package Type">Pkg. Type</th>

                                <th class="text-left" width="5%" title="Bill Amt.">Amount</th>

                            </tr>
                        </thead>

                        <tbody>
                        <?php 
                        $r=Generaluser::find_by_id($_GET['id']);
                        $records = Point::find_by_userid($r->id);
                        if($records){
                        foreach ($records as $key => $record){

                        ?>
                            <tr id="<?php echo $record->reg_date; ?>">
                            <td class="text-center hide"><?php echo $key + 1;?></td>
                                <td>
                                <?php echo date("d M Y", strtotime($record->reg_date)); ?>
                                     
                                   
                                </td>
                                <td>
                                    <?php echo $record->particulars; ?>
                                </td>
                                <td>
                                
                                    <?php 
                                        $mop = '';
                                        if($record->status == 1){
                                            $mop = 'Add Point';
                                        }elseif($record->status == 2){
                                            $mop = 'Points';
                                        }elseif($record->status == 3){
                                            $mop = 'Deduct Point';
                        
                                        }elseif($record->status == 4){
                                            $mop = 'Correction';
                                        }
                                        echo $mop; 
                                    ?>                                
                                </td>
                                <td>
                                
                                    <?php echo $record->point; ?>
                                </td>
                                <td>
                                    <?php echo $record->usable_point; ?>
                                </td>

                                <td>
                                    <?php echo $record->actual_point; ?>
                                </td>
                                <td>
                                    <?php 
                                        $va =!empty($record->propertyid)?$record->propertyid:'';
                                        $dat=Hotelapi::find_by_userid($va);
                                        echo !empty($dat->title)?$dat->title:'Super Admin';
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    if($record->pkgtype==0){
                                        echo "Package";
                                    }elseif($record->pkgtype==1){
                                        echo "A La Carta";
                                    }elseif($record->pkgtype==3){
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $record->billamt; ?>
                                </td>
                                
                                <?php     
                                    //if(!($user_type == "hotel" && isset($_GET['id']) && !empty($_GET['id']))){?>

                                        <!-- <td class="text-center">
                                        
                                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top"
                                            title="Edit" onclick="editRecordSub(<?php echo $r->id; ?>, <?php echo $record->id; ?>);">
                                                <i class="glyph-icon icon-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove"
                                            onclick="recordDelete(<?php echo $record->id; ?>);">
                                                <i class="glyph-icon icon-remove"></i>
                                            </a>
                                        </td> -->
                                <?php //} ?>




                        </tr>
                        
                        <?php
                        }
                    }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="example-box">
            <h4 class="mb-3">Claim Prize</h4>
                <div class="example-code">
                    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                        <thead>
                        <tr>
                            <th class="text-left">Prize</th>
                            <th class="text-left">Description</th>
                            <th class="text-left" width="10%">Points</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php                             $records ='';

                                $user_get = Generaluser::find_by_id($_GET['id']);
                                $count= Level::greater_level_count($user_get->actual_point,$count);
                                $data = Level::get_level($user_get->actual_point,$count);  
                                if($data){
                                $records = Reward::find_by_slug($data[0]->slug);      
                                }
                        if($records){             
                        foreach ($records as $key => $record):                  

                        ?>
                            <tr id="<?php echo $record->id; ?>">
                                <td>
                                    
                                        <?php echo $record->title; ?>
                                   
                                </td>
                                <td>
                                    <?php echo $record->description; ?>
                                </td>
                                <td>
                                
                                    <?php echo $record->point; ?>
                                </td>
    
                                
                            </tr>
                        <?php endforeach; }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php      endif;
?>
        
    </div>
<?php endif; ?>
<script>
    $(document).ready(function () {


        $('#start_date').datepicker({
            dateFormat :"yy-mm-dd",
        });
        $('#end_date').datepicker({
            dateFormat :"yy-mm-dd",
        });
    });



    $(function(){
    $(document).on('click','#export_all_point,#export_selected_point',function(){
        console.log($(this).val());
        if($(this).val()=="Export All")
        {
        $("#export_type").val('all');
        }else{
        $("#export_type").val('selected');
        }
        $('#the_form').attr('action',"<?php echo BASE_URL?>apanel/report_point.php").submit();
    });  
    
        $(document).on('click','#searchBtn',function(){
        $('#the_form').attr('action',"").submit();
    });  
    
    
    });
</script>


<?php 
if (isset($_GET['mode']) && $_GET['mode'] == "update" ):

    if (isset($_GET['id']) && !empty($_GET['id'])):
        $userId = addslashes($_REQUEST['id']);
        $usersInfo = Generaluser::find_by_id($userId);
        $published = ($usersInfo->status == 1) ? "checked" : "";
        $unpublished = ($usersInfo->status == 0) ? "checked" : "";
        $male = ($usersInfo->gender == 1) ? "checked" : "";
        $female = ($usersInfo->gender == 0) ? "checked" : "";
    endif;

    
    if (isset($_GET['subid']) && !empty($_GET['subid'])):
        $pointId = addslashes($_REQUEST['subid']);
        $pointInfo = Point::find_by_id($pointId);

    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['subid'])) ? 'Update Reward' : 'Edit Reward'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="editRecord(<?php echo $usersInfo->id; ?>);">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>
    <script language="javascript">
        $(document).ready(function () {
            $('#adminusersetting_frm').passroids({
                main: '#password',
                verify: '#passwordConfirm',
                minimum: 6
            });
        });
    </script>
    <div class="my-msg"></div>
    <div class="example-box col-md-120">
        <div class="example-code">
            <form action="" class="" id="adminusersetting_frm_reward">
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Group Type :
                        </label>
                    </div>
                    <div class="form-input col-md-4" style="padding:0px !important;">
                        <!-- <select data-placeholder="Choose Field Type" class="chosen-select validate[required,length[0,500]]" id="field_type" name="field_type">
                        <option value=""></option>
                        <?php $GroupTypeRec = Usergrouptype::find_all(2);
                        if ($GroupTypeRec): foreach ($GroupTypeRec as $GroupTypeRow):
                            $sel = (!empty($usersInfo->group_id) && $usersInfo->group_id == $GroupTypeRow->id) ? 'selected' : '';
                            ?>
					    <option value="<?php echo $GroupTypeRow->id; ?>" <?php echo $sel; ?>><?php echo $GroupTypeRow->group_name; ?></option>
						<?php endforeach; endif; ?>
                    </select> -->
                        <input type="hidden" name="field_type" name="field_type" value="3">
                        
                        <input type="hidden" name="accsid" name="accsid" value="<?php echo $accsid  ?>">

                    </div>
                </div>

                <?php if(isset($_GET['subid'])):?>

                            <input class="col-md-4 validate[required,length[0,50]] hidden" type="hidden" id="cor_point" name="cor_point"
                            value="<?php echo $pointInfo->point; ?>">
                            <input class="col-md-4 validate[required,length[0,50]] hidden" type="hidden" id="cor_status" name="cor_status"
                            value="<?php echo $pointInfo->status; ?>">

                <?php endif;?>




                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            User Usable Point :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <?php   $user_get = Generaluser::find_by_id($_GET['id']);
                            echo $user_get->usable_point;
                        ?>
                    </div>
                    
                </div>


                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Method :
                        </label>
                    </div>                                       
                    <div class="form-input col-md-10">
                        <select name="payment_type" id="payment_type" class="col-md-2 validate[required]">
                        <?php foreach ($position as $key => $val) {
                           echo '<option value="'.$key.'" >'.$val.'</option>' ;
                        }?>
                        </select>
                    </div>
                </div>




                <!-- <div class="form-row points">
                    <div class="">
                        <div class="col-sm-2 form-label">
                            <label class="form-label">Range :</label>
                        </div>
                        <?php 
                            $user_get = Generaluser::find_by_id($_GET['id']);
                        ?>
                        <div class="col-sm-2 form-input">
                            <select name="range" class="form-control validate[required]">
                                <option value="">Options</option>
                                <?php echo Pricerange::get_user_option($user_get->actual_point)?>
                            </select>                        
                        </div>
 
                    </div>
                </div> -->

                <div class="form-row points">
                    <div class="form-label col-md-2">
                        <label for="">
                            Package Type :
                        </label>
                    </div>                                       
                    <div class="form-input col-md-10">
                        <select name="pkgtype" id="pkgtype" class="col-md-2 validate[required]">
                        <?php foreach ($packages as $key => $val) {
                           echo '<option value="'.$key.'" >'.$val.'</option>' ;
                        }?>
                        </select>
                    </div>
                </div>

                <div class="form-row points">
                    <div class="form-label col-md-2">
                        <label for="">
                            Bill Amount:
                        </label>
                    </div>                                       
                    <div class="form-input col-md-10">
                        <input placeholder="Bill Amount" class="col-md-4 validate[required,length[0,50]]" type="number" id="billamt" name="billamt">
                    </div>
                </div>


                
                <!-- <div class="form-row points">
                    <div class="">
                        <div class="col-sm-2 form-label">
                            <label class="form-label">Range :</label>
                        </div>
                        <?php 
                            $user_get = Generaluser::find_by_id($_GET['id']);
                        ?>
                        <div class="col-sm-2 form-input">
                            <select name="range" class="form-control validate[required]">
                                <option value="">Options</option>
                                <?php echo Pricerange::get_user_option($user_get->actual_point)?>
                            </select>                        
                        </div>
 
                    </div>
                </div> -->



                <?php
                    $user_get = Generaluser::find_by_id($_GET['id']);
                    $count= Level::greater_level_count($user_get->actual_point);

                    $data = Level::get_level($user_get->actual_point,$count);
                ?>

                <div class="form-row prize hide">
                    <!-- <div class="row"> -->
                        <div class="col-sm-2 form-label">
                            <label class="">Prize</label>

                        </div>
                        <div class="col-sm-4 form-input">
                            <select name="prize" class="form-control validate[required]">
                                <option value="">Options</option>
                                <?php echo Reward::find_all_by_level($data[0]->slug)?>
                            </select>                        
                        </div>
                    <!-- </div> -->
                </div>
                
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Remark :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <input placeholder="Remark" class="col-md-4 validate[required,length[0,50]]" type="text" id="particular" name="particular"
                        value="<?php echo !empty($pointInfo->particulars) ? $pointInfo->particulars : ""; ?>">
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-label col-md-2"></div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1"
                               value="1" <?php echo !empty($published) ? $published : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0"
                               value="0" <?php echo !empty($unpublished) ? $unpublished : ""; ?>>
                        <label for="">Un-published</label>
                    </div>
                </div> -->
                

                <div class="form-label col-md-2"></div>
                <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($userId) ? $userId : 0; ?>"/>
            </form>

    
        </div>
    </div>
<?php endif; ?>


<?php 
/*----------------For Correction--------------------*/
if (isset($_GET['mode']) && $_GET['mode'] == "correct" ):

    if (isset($_GET['id']) && !empty($_GET['id'])):
        $userId = addslashes($_REQUEST['id']);
        $usersInfo = Generaluser::find_by_id($userId);
        $published = ($usersInfo->status == 1) ? "checked" : "";
        $unpublished = ($usersInfo->status == 0) ? "checked" : "";
        $male = ($usersInfo->gender == 1) ? "checked" : "";
        $female = ($usersInfo->gender == 0) ? "checked" : "";
    endif;


    ?>
    <h3>
        <?php echo (isset($_GET['subid'])) ? 'Manual Correction' : 'Manual Correction'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="editRecord(<?php echo $usersInfo->id; ?>);">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>
    <script language="javascript">
        $(document).ready(function () {
            $('#adminusersetting_frm').passroids({
                main: '#password',
                verify: '#passwordConfirm',
                minimum: 6
            });
        });
    </script>
    <div class="my-msg"></div>
    <div class="example-box col-md-120">
        <div class="example-code">
            <form action="" class="" id="adminusersetting_frm_correction">
                <div class="form-row hide">
                    <div class="form-label col-md-2">
                        <label for="">
                            Group Type :
                        </label>
                    </div>
                    <div class="form-input col-md-4" style="padding:0px !important;">
                        <!-- <select data-placeholder="Choose Field Type" class="chosen-select validate[required,length[0,500]]" id="field_type" name="field_type">
                        <option value=""></option>
                        <?php $GroupTypeRec = Usergrouptype::find_all(2);
                        if ($GroupTypeRec): foreach ($GroupTypeRec as $GroupTypeRow):
                            $sel = (!empty($usersInfo->group_id) && $usersInfo->group_id == $GroupTypeRow->id) ? 'selected' : '';
                            ?>
					    <option value="<?php echo $GroupTypeRow->id; ?>" <?php echo $sel; ?>><?php echo $GroupTypeRow->group_name; ?></option>
						<?php endforeach; endif; ?>
                    </select> -->
                        <input type="hidden" name="field_type" name="field_type" value="3">
                        
                        <input type="hidden" name="accsid" name="accsid" value="<?php echo $accsid  ?>">

                    </div>
                </div>






                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            User Usable Point :
                        </label>
                    </div>
                    <div class="form-input col-md-10">
                        <?php   $user_get = Generaluser::find_by_id($_GET['id']);
                            echo $user_get->usable_point;
                        ?>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Correction :
                        </label>
                    </div>                                       
                    <div class="form-input col-md-10">
                        <select name="correction" id="correction" class="col-md-2 validate[required]">
                            <option value="">Select Correction</option>
                        <?php 
                        $data_arr = Point::get_particulars_byid($_GET['id']);
                        echo $data_arr;
                        ?>
                        </select>
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Method (Actual):
                        </label>
                    </div>                                       
                    <div class="form-input col-md-10">
                        <select name="payment_type" id="payment_type" class="col-md-2 validate[required]">
                        <option value="">Select Method</option>

                        <?php foreach ($position as $key => $val) {
                           echo '<option value="'.$key.'" >'.$val.'</option>' ;
                        }?>
                        </select>
                    </div>
                </div>


                
                <div class="form-row ">
                    <div class="form-label col-md-2">
                        <label for="">
                            Point (Actual):
                        </label>
                    </div>                                       
                    <div class="form-input col-md-10">
                        <input placeholder="Actual Point" class="col-md-4 validate[required,length[0,50]]" type="number" id="newpoint" name="newpoint">
                    </div>
                </div>

                

                <div class="form-label col-md-2"></div>
                <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($userId) ? $userId : 0; ?>"/>
            </form>

    
        </div>
    </div>
<?php endif; ?>