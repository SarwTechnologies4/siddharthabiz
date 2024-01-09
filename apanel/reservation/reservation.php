<?php
$moduleTablename  = "tbl_apibooking";
$moduleFoldername = "reservation";
$user_hotel_id  =  $session->get('user_hotel_id');
$user_type      =  $session->get('user_type');
$hotel_detail   =  Hotelapi::find_by_id($user_hotel_id);
$addQuery =  '';
$show_list=0;
$today =  date("Y-m-d");

if(!empty($user_hotel_id)){
      $addQuery .=  " AND hotel_code='".$hotel_detail->code."'";
}

 
 $searchbydate =  isset($_POST['searchbydate'])? $_POST['searchbydate']  : '';
 $_SESSION['start_date']  =  isset($_SESSION['start_date']) ? $_SESSION['start_date']  : '';
     $_SESSION['start_date']  =  isset($_POST['start_date'])? $_POST['start_date']  : $_SESSION['start_date'];
   $_SESSION['end_date']  =  isset($_SESSION['end_date']) ? $_SESSION['end_date']  : '';
     $_SESSION['end_date']  =  isset($_POST['end_date'])? $_POST['end_date']  : $_SESSION['end_date'];

if(!empty($_SESSION['start_date']) and !empty($_SESSION['end_date'])){
    $datefield  =  'booking_date';
    if(!empty($searchbydate)){
       if($searchbydate=='checkindate'){
          $datefield  =  'checkin_date';
       }else if($searchbydate=='checkoutdate'){
          $datefield  =  'checkout_date';
       }else{
          $datefield  =  'booking_date';
       }
    }
    $addQuery .=  " AND   DATE_FORMAT($datefield,'%Y-%m-%d') >='".$_SESSION['start_date']. "' AND DATE_FORMAT($datefield,'%Y-%m-%d') <='".$_SESSION['end_date']."'";      
}

if(!empty($_GET['mode']) and in_array($_GET['mode'],array('list','inquiry','approved','active','paid','report'))){
	 $show_list=1;
	 if($_GET['mode']=='inquiry' or $_GET['mode']=='approved'){
	    $addQuery .=  " AND status='".$_GET['mode']."'";
	 }
   else if($_GET['mode']=='active'){
	     $addQuery .=  " AND approved='1'";
	     $addQuery .=  " AND DATE_FORMAT(checkin_date,'%Y-%m-%d') <='".$today. "' AND DATE_FORMAT(checkout_date,'%Y-%m-%d') >='".$today."'";
       $addQuery .=  " AND status!='inquiry'";
	 }
   else if($_GET['mode']=='paid'){
       $addQuery .=  " AND has_payment='1'";
       $addQuery .=  " AND status!='inquiry'";
   }
	 else{}

}

if(isset($_GET['page']) && $_GET['page'] == "reservation" && isset($_GET['mode']) && $show_list=='1'):
?>
<h3><?php echo ucwords($_GET['mode']);?> Reservation</h3>
<div class="clear"></div>

<form action="" method="post" id="the_form">
<div class="form-group">
<?php if($_GET['mode']=='report'){ ?>
<div class="col-sm-4 form-input">
Search By  <select class="form-control" name="searchbydate" id="searchbydate">
  <option value="">Search By </option>
  <option value="checkindate" <?php echo (!empty($_POST['searchbydate']) and $_POST['searchbydate']=='checkindate')?"selected":"";?> >Check In Date (Arrival Date)</option>
  <option value="datebooked" <?php echo (!empty($_POST['searchbydate']) and $_POST['searchbydate']=='datebooked')?"selected":"";?> >Date Booked (Booking Date)</option>
  <option value="checkoutdate" <?php echo (!empty($_POST['searchbydate']) and $_POST['searchbydate']=='checkoutdate')?"selected":"";?> >Check Out Date (Departure Date)</option>
</select>
</div>
<?php } ?>

<div class="col-sm-4 form-input">
From <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="datepicker_search form-control" value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>" /> 
</div>
<div class="col-sm-4 form-input">
To <input type="text" name="end_date" id="end_date" placeholder="End Date" class="datepicker_search form-control" value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>"/>
</div>
</div>

<div class="row">
<div class="col-sm-4">
&nbsp;
<input type="button" name="searchBtn" id="searchBtn" value="Search" class="btn medium bg-blue-alt " />
</div>
<div class="col-sm-4">
&nbsp;
<input type="hidden" name="export_type" id="export_type" value="all" />
<input type="button" name="export_selected" id="export_selected" value="Export Selected" class="btn medium bg-blue-alt" />
</div>
<div class="col-sm-4">
&nbsp;
<input type="button" name="export_all" id="export_all" value="Export All" class="btn medium bg-blue-alt " />
</div>
</div>


<br /><br /><br />


<div id="my-msg"></div>
<div class="example-box">
  <div class="example-code">
    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
      <thead>
        <tr>
          <th>S.N</th>
          <th class="text-center"><input class="check-all" type="checkbox" /></th>
          <?php if($user_type=='admin'){?><th class="text-center">Hotel</th><?php } ?>
          <th class="text-center">Code</th>
          <th class="text-center">Contact Name</th>
          <th class="text-center">Room</th>   
          <th class="text-center">Checkin Date</th>
          <th class="text-center">CheckOut Date</th>      
          <th class="text-center">Book Date</th>
          <th class="text-center">Grand Total</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
<?php 
$sql  =  "SELECT * FROM ".$moduleTablename." Where 1=1   {$addQuery} ORDER BY booking_date DESC "; 		
$records = $db->query($sql);	
$num     =  $db->num_rows($records);
if($num>0){ $key=0;  
while($record = $db->fetch_object($records)){ //pr($record);?>
        <tr id="<?php echo $record->id;?>">
          <td><?php echo $key+1;?></td>
          <td><input type="checkbox" name="selected[]" class="bulkCheckbox" bulkId="<?php echo $record->id;?>" value="<?php echo $record->id;?>" /></td>
      <?php if($user_type=='admin'){?><td><?php $hotel_code = $record->hotel_code;
        $hotelInfo  =  Hotelapi::find_by_code($hotel_code);echo $hotelInfo->title;?></td><?php } ?>
          <td><a href="<?php echo BASE_URL?>apanel/reservation/detail/<?php echo $record->booking_code;?>"  class="" title="<?php echo $record->booking_date;?>"><?php echo $record->booking_code;?></a></td>
          <td><a href="<?php echo BASE_URL?>apanel/reservation/detail/<?php echo $record->booking_code;?>"  class="" title="<?php echo $record->booking_date;?>"><?php echo $record->first_name." ".$record->last_name;?></a><br>
            <?php echo $record->contact_no;?><br>
            <?php echo $record->email;?><br>
            <?php echo $record->address;?><br>
            <?php echo $record->city;?><br>
            <?php echo $record->zipcode;?><br>
            <?php echo $record->country;?>
           </td>
           <td><?php 
               $childs      =  Bookingchild::get_bookchild_by($record->id);
               foreach($childs as $key_child=>$val_child){
				echo $val_child->room_label.'<br /> No. Of Room : '.$val_child->no_of_room.'<br />';
				echo "Adult : ".$val_child->adult.'<br /> Child : '.$val_child->child.'<br /> Extra Bed : '. $val_child->extra_bed.'<br><br>';
					}

           ?></td>
           <td><?php echo date("F d,Y",strtotime($record->checkin_date));?></td>
           <td><?php echo date("F d,Y",strtotime($record->checkout_date));?></td>
          <td><?php echo date("F d,Y",strtotime($record->booking_date));?></td>          
          <td><?php echo $record->currency;?> <?php echo $record->grand_total;?></td>
          <td>
          <?php if($record->approved=='1'){?>
              Approved By : <br><?php
                $approved_by  =  $record->approved_by; 
                $userInfo     =  User::find_by_id($approved_by);
                echo !(empty($userInfo->first_name))? $userInfo->first_name." ".$userInfo->last_name."<br>" : "System<br>";                
            }else{
               echo "Not Approved Yet<br>";
              }?>

          <?php if($record->approved=='0' and $_GET['mode']!='report'){?>
              <a href="javascript:void(0);" class="btn small bg-blue-alt make_approve" data-id="<?php echo $record->id;?>" style="margin-bottom: 5px;">Approve</a>
              <a href="javascript:void(0);" class="btn small bg-blue-alt un_approve" data-id="<?php echo $record->id;?>">Un-Approved</a>
              <?php 
          	}?>

            <?php if($record->has_payment=='1'){?>
              Payment Date : <br><?php  
                echo date("F d,Y",strtotime($record->payment_date));                
            }?>
            </td>
          
        </tr>
        <?php $key++;}}else{} ?>
      </tbody>
    </table>
  </div>
</div>
</form>
<script>
$(function(){
   $(document).on('click','#export_all,#export_selected',function(){
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
<?php elseif(isset($_GET['mode']) && $_GET['mode'] == "detail"):
$id  =  $_GET['id'];
?>
<a class="btn medium bg-blue-alt" href="<?php echo BASE_URL?>apanel/reservation/active"> 
<span class="glyph-icon icon-separator"> <i class="glyph-icon icon-arrow-circle-left"></i> </span>
 <span class="button-content"> Back </span> </a></h3>
<div class="my-msg"></div>
<br>
<div class="example-box">
  <div class="example-code">
    <?php
        
      $result    =  $db->query("SELECT * FROM ".$moduleTablename." WHERE booking_code='$id'");
      $row       =  $db->fetch_array($result);           
      $fullname  = $row['first_name']." ".$row['last_name'];
        ?>
    <h2>Booking Details</h2>
    <table width="100%" class="table table-bordered">
      <tbody>
        
        <tr>
          <td>Booking Date:</td>
          <td><?php echo date("F d,Y",strtotime($row['booking_date']));?></td>
        </tr>
        
        <tr>
          <td>Check In Date:</td>
          <td><?php echo date("F d,Y",strtotime($row['checkin_date']));?></td>
        </tr>

        <tr>
          <td>Check Out Date:</td>
          <td><?php echo date("F d,Y",strtotime($row['checkout_date']));?></td>
        </tr>
       
        <tr>
          <td>Nights :</td>
          <td><?=$row['nights']?></td>
        </tr>

        <tr>
        <td>Flight Name:</td>
        <td><?=$row['flightname']?></td>
      </tr>

      <tr>
        <td>Flight Time:</td>
        <td><?=$row['arrivaltime']?></td>
      </tr>
       
    </table>
    <h2>Person Information</h2>
    <table width="100%" class="table table-bordered">
      <tr>
        <td width="20%">Fullname:</td>
        <td><?=$fullname?></td>
      </tr>
     
      <tr>
        <td>E-mail address:</td>
        <td><?=$row['email']?></td>
      </tr>
      <tr>
        <td>Contact No:</td>
        <td><?=$row['contact_no']?></td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><?=$row['address']?></td>
      </tr>
      <tr>
        <td>City:</td>
        <td><?=$row['city']?></td>
      </tr>
      <tr>
        <td>Zipcode:</td>
        <td><?=$row['zipcode']?></td>
      </tr>
      <tr>
        <td>Country:</td>
        <td><?=$row['country']?></td>
      </tr>

      <tr>
        <td>Details:</td>
        <td><?=$row['personal_request']?></td>
      </tr>

      
    </table>
    <h2>Booking Information</h2>    
    <table class="table table-bordered" width="100%">
      <thead>
        <tr>
          <th>Room</th>
          <th>S.No.</th>
          <th>Adult</th>
          <th>Child</th>
          <th>Extra Bed</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $sql = "SELECT `master_id`, `room_type`, `room_label`, `no_of_room` FROM `tbl_apibooking_child` WHERE master_id = '".$row['id']."' GROUP BY room_type ORDER BY id ASC ";
          $roomQuery = $db->query($sql);
          $totRoom = $db->num_rows($roomQuery);
          if($totRoom>0) { 
              while($roomRow = $db->fetch_object($roomQuery)) { 
                  $nsql="SELECT `currency`, `price`, `adult`, `child`, `extra_bed` FROM `tbl_apibooking_child` WHERE master_id = '".$row['id']."' AND room_type = '".$roomRow->room_type."' ORDER BY id ASC ";
                  $nroomQuery = $db->query($nsql);
                  $ntotRoom = $db->num_rows($nroomQuery); ?>
                  <tr>
                      <td rowspan="<?php echo $ntotRoom+1;?>"><?php echo $roomRow->room_label;?> (<?php echo $roomRow->no_of_room;?>)</td>
                  </tr>
                  <?php if($ntotRoom>0) {
                      $i=1;
                      while($nroomRow = $db->fetch_object($nroomQuery)) { ?>
                          <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $nroomRow->adult;?></td>
                              <td><?php echo $nroomRow->child;?></td>
                              <td><?php echo $nroomRow->extra_bed;?></td>
                              <td><?php echo $nroomRow->currency.' '.$nroomRow->price;?></td>
                          </tr>
                      <?php $i++; }
                  } ?>
              <?php }
           } ?>   
        <tr>
            <td colspan="5">Sub Total</td>
            <td><?php echo $row['currency_symbol'];?> <?php echo $row['subtotal'];?></td>
        </tr>

        <tr>
            <td colspan="5">Service Charge</td>
            <td><?php echo $row['currency_symbol'];?> <?php echo $row['service_charge'];?></td>
        </tr>

        <tr>
            <td colspan="5">Tax</td>
            <td><?php echo $row['currency_symbol'];?> <?php echo $row['tax_amount'];?></td>
        </tr>
  
        <tr>
            <td colspan="5">Grand Total</td>
            <td><?php echo $row['currency_symbol'];?> <?php echo $row['grand_total'];?></td>
        </tr>
        <?php if($row['pay_type']!='himalayanBank' AND $row['pay_type']!='nabilBank') {
        $comision = ceil($row['grand_total']*10/100); ?>
        <tr>
            <td colspan="5">Nepal Hotel Commision (10%)</td>
            <td><?php echo $row['currency_symbol'];?> <?php echo $comision;?></td>
        </tr>

        <tr>
            <td colspan="5">Hotel Grand Total</td>
            <td><?php echo $row['currency_symbol'];?> <?php echo ($row['grand_total']-$comision);?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <br/>
    <br/>
    <strong>Booking Status : <?php echo ucfirst($row['status'])?></strong>
    <hr>
    <?php if($row['has_payment']=='1' AND $row['pay_type']!='nabilBank'){ ?>
    <strong>Pay Type : <?php echo ucfirst($row['pay_type'])?></strong><hr />    
    <strong>Card No. <?php echo $row['pay_pan'];?></strong><br />
    <strong> Payment Transaction Id : <?php echo $row['transaction_id'];?></strong><br>
    <strong> Payment Date : <?php echo date("F d,Y",strtotime($row['payment_date']));?></strong><br />
    <?php if(!empty($row['pay_invoice'])) { ?> 
    <strong>Invoice No. : <?php echo ucfirst($row['pay_invoice'])?></strong><br />
    <strong>Bank Approved Code : <?php echo $row['pay_code'];?></strong><br />
    <strong>Payment Card : <?php echo $row['pay_pan'];?></strong>
    <?php } ?>
    <?php } else { ?>
    <strong>Pay Type : <?php echo ucfirst($row['pay_type'])?></strong><hr />    
    <strong>Order Id : <?php echo $row['nabil_orderid'];?></strong><br />
    <strong>Card Holder : <?php echo $row['nabil_cardholder'];?></strong><br />
    <strong><?php echo $row['nabil_card'];?> Card : <?php echo $row['nabil_pan'];?></strong><br />
    <strong> Payment Date : <?php echo $row['nabil_approved_datetime'];?></strong><br />
    <strong>Bank Approved Code : <?php echo $row['nabil_approved_id'];?></strong><br />
    <strong>Order Status : <?php echo $row['nabil_order_status'];?></strong>
    <?php } ?>
  </div>
</div>
<?php  
endif;
?>