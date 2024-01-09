<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename  = "tbl_room_calender"; // Database table name
$moduleId 		  = 29;				// module id >>>>> tbl_modules
$user_hotel_id  =  $session->get('user_hotel_id');
$hotel_detail   =  Hotelapi::find_by_id($user_hotel_id); 
if(isset($_GET['page']) && $_GET['page'] == "calenderbooking" && isset($_GET['mode']) && $_GET['mode']=="list"):
?>
<h3>Calender Management<?php echo "'s of ".$hotel_detail->title;?></h3>
<div class="my-msg"></div>
<div class="example-box">
    <?php $date_from  =  isset($_POST['date_from']) ? $_POST['date_from'] : date('Y-m-d');
    $date_to    =  isset($_POST['date_to']) ? $_POST['date_to'] : date('Y-m-d',strtotime("+20 days")); ?>
    <form action="" method="post" id="calender_booking_form">
        <div class="form-row">
            <div class="form-input col-md-2">
            Start Date <input type="text" name="date_from" id="date_from" value="<?php echo $date_from?>" readonly> 
            </div>
            <div class="form-input col-md-2">
            End Date <input type="text" name="date_to" id="date_to" value="<?php echo $date_to?>" readonly> 
            </div>
            <div class="form-input col-md-4"><br>    
            <button value="create" name="submitBtn" id="submitBtn" class="btn medium bg-blue-alt button-content">Set Period</button>
            </div>
        </div>
    </form>

    <?php $tday = getDaysDiff($date_from, $date_to); 
    $rmRes = Roomapi::find_by_sql("SELECT id, title, no_rooms, room_type FROM tbl_roomapi WHERE hotel_id='".$hotel_detail->id."' ORDER BY sortorder DESC ");  
    if(!empty($rmRes)) { 
        foreach ($rmRes as $rmRow) { 
            $myArr = array();     
            $offRes = Roomoffers::find_by_sql("SELECT title, date_from, date_to, discount, apply_for, apply_id FROM tbl_roomapi_offers WHERE hotel_id='".$hotel_detail->id."' AND (date_from >='".$date_from."' OR date_to >='".$date_from."') ORDER BY date_from ASC ");
            $prRow  = $db->fetch_object($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_roomapi_price WHERE room_id='".$rmRow->id."' LIMIT 1 "));

            for($i = new DateTime( $date_from ); $i <= new DateTime( $date_to ); $i->modify('+1 day')) {
                $m_date = $i->format("Y-m-d");
                $calRow = $db->fetch_object($db->query("SELECT no_rooms FROM tbl_room_calender WHERE hotel_id='".$hotel_detail->id."' AND reserve_date='".$m_date."' AND room_id='".$rmRow->id."' LIMIT 1 "));
                $boked_room = Bookingmaster::cond_booked_room($hotel_detail->code, $rmRow->id, $m_date);
                $myArr[] = array(
                    's_date' => $m_date,
                    'm_room' => $rmRow->no_rooms,
                    'c_room' => !empty($calRow)?$calRow->no_rooms:($rmRow->no_rooms - $boked_room),
                    'p_room' => !empty($prRow)?$prRow:array()
                    );
            } ?>
            <div class="row">
                <div class="col-sm-12" style="overflow-x: scroll;">
                    <h3><?php echo $rmRow->title;?></h3>
                    <table class="table booking">
                        <tr>
                            <td>&nbsp;</td>
                            <?php foreach($myArr as $k=>$val) {
                                $row = (object) $val;
                                echo '<td>'.date('M d', strtotime($row->s_date)).'</td>';
                            } ?>
                        </tr>
                        <tr class="text-center">
                            <td>Room Staus</td>
                            <?php foreach($myArr as $k=>$val) {
                                $row = (object) $val;
                                $nres='<td>';
                                // Not avaliable
                                if($row->c_room==0) {$nres.='<button class="btn bg-red small btn-act '.date('Md', strtotime($row->s_date)).'-'.$rmRow->id.'" data-rum="'.$rmRow->no_rooms.'" data-inrow="'.date('Md', strtotime($row->s_date)).'-'.$rmRow->id.'"></button>';}                                
                                // On sell
                                if($row->c_room > 0) {$nres.='<button class="btn bg-green small btn-act '.date('Md', strtotime($row->s_date)).'-'.$rmRow->id.'" data-rum="0" data-inrow="'.date('Md', strtotime($row->s_date)).'-'.$rmRow->id.'"></button>';}
                                echo $nres.='</td>';
                            } ?>
                        </tr>

                        <tr class="text-center">
                            <td>Rooms to Sell <button class="btn bg-blue small dbulk" data-bulk="<?php echo $hotel_detail->id.'||'.$rmRow->id.'||'.$date_from.'||'.$date_to.'||'.$rmRow->no_rooms;?>"></button></td>
                            <?php foreach($myArr as $k=>$val) {
                                $row = (object) $val;
                                $main_data = $hotel_detail->id.'||'.$row->s_date.'||'.$rmRow->id;
                                echo '<td><div class="form-input"><input type="text" class="room-block '.date('Md', strtotime($row->s_date)).'-'.$rmRow->id.'" value="'.$row->c_room.'" data-max="'.$rmRow->no_rooms.'" data-main="'.$main_data.'"></div></td>';
                            } ?>
                        </tr>
                        
                        <tr class="text-center">
                            <td><a href="javascript:;" class="get-indvres" data-mrate='<?php echo $date_from.'||'.$date_to.'||'.$hotel_detail->id.'||'.$rmRow->id;?>'>Standard Rate <i class="glyph-icon icon-plus-square"></i></a></td>
                            <?php foreach($myArr as $k=>$val) {
                                $row = (object) $val;
                                $mr='<td><button class="btn small bg-green mytooltip" data-show="1" data-mrate="MRP||'.$hotel_detail->id.'||'.$rmRow->id.'||'.$row->s_date.'"><span class="tooltiptext">Loading...</span></button></td>';
                                echo $mr;
                            } ?>
                        </tr>
                        <!-- For Individual Room -->
                        <tr class="<?php echo 'one-'.$rmRow->id;?>"></tr>
                        <tr class="<?php echo 'two-'.$rmRow->id;?>"></tr>
                        <tr class="<?php echo 'three-'.$rmRow->id;?>"></tr>
                        <tr class="<?php echo 'extra-'.$rmRow->id;?>"></tr>

                        <?php if(!empty($offRes)) { 
                            foreach($offRes as $offRow) {
                                switch ($offRow->apply_for) {
                                    case 'room':
                                        if($offRow->apply_id == $rmRow->id) { ?>
                                        <tr class="text-center">
                                            <td><?php echo $offRow->discount;?>% Discount<br /><small><?php echo $offRow->title;?></small></td>
                                            <?php foreach($myArr as $k=>$val) {
                                                $row = (object) $val;                                                
                                                if($row->s_date >= $offRow->date_from AND $row->s_date <= $offRow->date_to) {                                                    
                                                    echo '<td><button class="btn small bg-green mytooltip" data-show="1" data-mrate="DIS||'.$hotel_detail->id.'||'.$rmRow->id.'||'.$row->s_date.'||'.$offRow->discount.'"><span class="tooltiptext">Loading...</span></button></td>';                                                    
                                                } else {
                                                    echo '<td><button class="btn small bg-red">&nbsp;</button></td>';
                                                }
                                            } ?>    
                                        </tr>
                                        <?php } 
                                        break;
                                    
                                    case 'all': ?>
                                        <tr class="text-center">
                                            <td><?php echo $offRow->discount;?>% Discount<br /><small><?php echo $offRow->title;?></small></td>
                                            <?php foreach($myArr as $k=>$val) {
                                                $row = (object) $val;
                                                if($row->s_date >= $offRow->date_from AND $row->s_date <= $offRow->date_to) {                                                    
                                                    echo '<td><button class="btn small bg-green mytooltip" data-show="1" data-mrate="DIS||'.$hotel_detail->id.'||'.$rmRow->id.'||'.$row->s_date.'||'.$offRow->discount.'"><span class="tooltiptext">Loading...</span></button></td>';
                                                } else {
                                                    echo '<td><button class="btn small bg-red">&nbsp;</button></td>';
                                                }
                                            } ?> 
                                        </tr>
                                        <?php break;

                                    case 'room_type':
                                        if($offRow->apply_id == $rmRow->room_type) { ?>
                                        <tr class="text-center">
                                            <td><?php echo $offRow->discount;?>% Discount<br /><small><?php echo $offRow->title;?></small></td>
                                            <?php foreach($myArr as $k=>$val) {
                                                $row = (object) $val;
                                                if($row->s_date >= $offRow->date_from AND $row->s_date <= $offRow->date_to) {
                                                    echo '<td><button class="btn small bg-green mytooltip" data-show="1" data-mrate="DIS||'.$hotel_detail->id.'||'.$rmRow->id.'||'.$row->s_date.'||'.$offRow->discount.'"><span class="tooltiptext">Loading...</span></button></td>';
                                                } else {
                                                    echo '<td><button class="btn small bg-red">&nbsp;</button></td>';
                                                }
                                            } ?> 
                                        </tr>
                                        <?php }
                                        break;
                                }                                
                            }
                        } ?>
                    </table>
                </div>
            </div>
        <?php }
    } ?>
</div>
<?php endif; ?>