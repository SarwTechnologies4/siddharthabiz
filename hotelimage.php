<?php ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("includes/initialize.php");
$code = addslashes($_REQUEST['code']);
$sql = "SELECT ht.image, ht.title FROM tbl_apihotel AS ht WHERE ht.status='1' AND code='$code' LIMIT 1 ";
$query = $db->query($sql);
$recRow = $db->fetch_object($query);

if($recRow) { 
$imageRec = unserialize(base64_decode($recRow->image)); ?>

<div class="photo-gallery style1" id="photo-gallery1" data-animation="slide" data-sync="#image-carousel1">
    <ul class="slides">
    <?php foreach($imageRec as $imgname) { ?> 
        <li><img src="<?php echo BASE_URL.'timthumb.php?src='.IMAGE_PATH.'hotelapi/'.$imgname.'&w=950&h=500&q=100';?>" alt="<?php echo $recRow->title;?>" /></li>
    <?php } ?>
    </ul>
</div>
<div class="image-carousel style1" id="image-carousel1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photo-gallery1">
    <ul class="slides">
    <?php foreach($imageRec as $imgRow) { ?> 
        <li><img src="<?php echo BASE_URL.'timthumb.php?src='.IMAGE_PATH.'hotelapi/'.$imgname.'&w=70&h=70&q=100';?>" alt="<?php echo $recRow->title;?>" /></li>
    <?php } ?>
    </ul>
</div>    

<?php } ?>