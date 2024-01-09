<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename  = "tbl_room_calender"; // Database table name
$moduleId 		  = 29;				// module id >>>>> tbl_modules
$user_hotel_id  =  $session->get('user_hotel_id');
$hotel_detail   =  Hotelapi::find_by_id($user_hotel_id); 
if(isset($_GET['page']) && $_GET['page'] == "calenderbooking" && isset($_GET['mode']) && $_GET['mode']=="list"):
?>
<h3>
Calender Booking Management <?php echo "'s of ".$hotel_detail->title;?>
<a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNew();">
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
               <th class="text-left">Date</th>
               <th class="text-left">Room</th>
               <th class="text-left">Available No.</th>
               <!-- <th class="text-left">Booked Room.</th> -->
                <th class="text-center"><?php echo $GLOBALS['basic']['action'];?></th>
            </tr>
        </thead> 
            
        <tbody>
            <?php $records = Calenderbooking::find_by_sql("SELECT * FROM ".$moduleTablename." WHERE 1=1 and hotel_id='".$user_hotel_id."'  ORDER BY reserve_date DESC ");	
				  foreach($records as $key=>$record): 
                      $record_id  =  $record->room_id;
                   $roomInfo  =  Roomapi::find_by_id($record_id);
                    ?>    
            <tr id="<?php echo $record->id;?>">
            	<td style="display:none;"><?php echo $key+1;?></td>
                <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id;?>" /></td>       
                <td><?php echo set_na($record->reserve_date);?></td>
                <td><?php echo $roomInfo->title;?></td>
                <td><?php echo set_na($record->no_rooms);?></td>   
                <td class="text-center">
                    
                    <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id;?>);">
                        <i class="glyph-icon icon-edit"></i>
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
        <option value="delete"><?php echo $GLOBALS['basic']['delete'];?></option>
        <option value="toggleStatus"><?php echo $GLOBALS['basic']['toggleStatus'];?></option>
    </select>
    </div>
    <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
        <span class="glyph-icon icon-separator float-right">
          <i class="glyph-icon icon-cog"></i>
        </span>
        <span class="button-content"> Click </span>
    </a>
</div>

<?php elseif(isset($_GET['mode']) && $_GET['mode'] == "addEdit"): ?>
<h3>
Calender booking  <?php echo " [".$hotel_detail->title."]";?>
<a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewCalenderlist();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
    <span class="button-content"> Back </span>
</a>
</h3>
<?php
$date_from  =  isset($_POST['date_from']) ? $_POST['date_from'] : date('Y-m-d');
$date_to    =  isset($_POST['date_to']) ? $_POST['date_to'] : date('Y-m-d',strtotime("+6 days"));
?>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">

<form action="" method="post" id="calender_booking_form">
<div class="form-row">
    <div class="form-input col-md-4">
    Start Date <input type="text" name="date_from" id="date_from" value="<?php echo $date_from?>" > 
    </div>
    <div class="form-input col-md-4">
    to End Date <input type="text" name="date_to" id="date_to" value="<?php echo $date_to?>" > 
    </div>
    <div class="form-input col-md-4"><br>    
    <button value="create" name="submitBtn" id="submitBtn" class="button-content">Create</button>
    </div>
</div>
</form>
<h3>Calender From <?php echo $date_from;?> to <?php echo $date_to;?></h3>
<table cellpadding="" cellspacing="" border="1">
<?php $days  =  daterange($date_from,$date_to);?>
    <tr>
    <?php 
    $i=1;
    foreach($days as $key=>$val){?>
     <td class="cal_td"><a href="#datePopup" title="<?php echo str_replace("-","_",$val);?>" class="cal_anchor"><?php echo date("dS F, Y",strtotime($val));?><br><?php echo date("l",strtotime($val));?></a></td>
    <?php if($i%7=='0'){?></tr><tr><?php } ?>
    <?php $i++; } ?>
    <?php if($i%7!='0')echo "</tr>";?>
</table>

</div>
</div>

<div id="datePopup" style="display: none;"></div>

<?php endif; ?>