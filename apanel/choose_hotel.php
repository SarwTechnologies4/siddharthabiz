<?php 
if($user_type=='hotel'){
  if(!isset($_SESSION['user_hotel_id'])){
      $accsid    = $session->get('u_id');
      $accscode  = $session->get('accesskey');    
      $num_hotel  =  Hotelapi::count_hotel_by_id($accsid);
      if(empty($num_hotel)){
        redirect_to(ADMIN_URL.'hotelapi/addEdit/'.$accscode);
      }else if($num_hotel=='1'){
          $hotel_id  =  Hotelapi::get_field_by_user_id($accsid,'id');
          $session->set('user_hotel_id',$hotel_id);
      }else{ ?>
<div id="hotelChoosePopup" style="display: none;">
  <div class="row">
      <div class="col-md-12"><h4>Choose a Property</h4></div>
     <?php $records  =  Hotelapi::find_all_by_user_id($accsid);
         foreach($records as $record){
    echo "<div class='col-md-6'><a href='javascript:void(0);' onclick=\"choose_hotel('".$record->code."');\" >".$record->title."</a></div>";
         }?>
  </div>
</div>          
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
$.fancybox("#hotelChoosePopup",{
          closeBtn  : false,
          autoSize  : true,
          width     : '600',
          helpers : {
              title   : false,
               overlay : {closeClick: false} 
            }
        });
  });

  function choose_hotel(c){ 
       $.ajax({
           type: "POST",
           dataType:"JSON",
           url:  "<?php echo BASE_URL;?>includes/controllers/ajax.hotelapi.php",
           data: 'action=switch_hotel&id='+c,
           success: function(data){
             parent.$.fancybox.close();
             window.location.href=window.location.href;   
           }
        });
  }
</script>      
          <?php
      }
  }
}
?>