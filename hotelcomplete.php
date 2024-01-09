<?php 
require_once("includes/initialize.php");

// $term = addslashes($_REQUEST['term']);
// $sql = "SELECT ht.code, ht.title, ht.street, ht.city, ht.zone, ht.district FROM tbl_apihotel AS ht WHERE ht.status='1' AND ( 
// 		ht.title like '%".$term."%' 
// 	   	OR ht.street like '%".$term."%' 
// 	   	OR ht.city like '%".$term."%' 
// 	   	OR ht.zone like '%".$term."%'
// 	   	OR ht.district like '%".$term."%') ORDER BY id DESC ";
// $query = $db->query($sql);
// $totRec = $db->num_rows($query);

// $newArr = array();
// if($totRec>0) {
// 	while($row=$db->fetch_object($query)) {
// 		$fulladdress = $row->title.', '.$row->street.', '.$row->city.', '.$row->zone.', '.$row->district;
// 		$newArr[] = array('value'=> $fulladdress, 'id'=>$row->code);
// 	}
// }

// echo json_encode($newArr);

if(!empty($_REQUEST['term'])) {
	$term = addslashes($_REQUEST['term']);
	// $sql = "SELECT ht.code, ht.title, ht.street, ht.city, ht.zone, ht.district, ht.country FROM tbl_apihotel AS ht WHERE ht.status='1' AND ( 
	// 	CONVERT(ht.street USING utf8) like '%".$term."%'
	// 	OR CONVERT(ht.zone USING utf8) like '%".$term."%'
	//    	OR CONVERT(ht.district USING utf8) like '%".$term."%'
	//    	OR CONVERT(ht.country USING utf8) like '%".$term."%' ) GROUP BY ht.district ORDER BY id DESC ";
	// $query = $db->query($sql);
	// $totRec = $db->num_rows($query);
	// $newArr = array();
	// if($totRec>0) {
	// 	while($row=$db->fetch_object($query)) {
	// 		$address = $row->zone.', '.$row->district;
	// 		$newArr[] = array('value'=> $address, 'id'=>$row->district);
	// 	}
	// }
	$sql2 = "SELECT ht.code, ht.title, ht.slug, ht.hotel_code, ht.street, ht.city, ht.zone, ht.district FROM tbl_apihotel AS ht WHERE ht.status='1' AND ht.hotel_type='Hotel & Resort' AND  (
		ht.title like '%".$term."%') ORDER BY id DESC  ";
	$query2 = $db->query($sql2);
	$totRec2 = $db->num_rows($query2);
	if($totRec2>0) {
		while($row=$db->fetch_object($query2)) {
			$hotel = $row->title;
			$slug = $row->slug;
			$hotel_code = $row->hotel_code;
			$newArr[] = array('value'=> $hotel, 'slug'=>$slug, 'hotel_code'=>$hotel_code);
		}
	}

	// $sql2 = "SELECT ht.code, ht.title, ht.street, ht.city, ht.zone, ht.district FROM tbl_apihotel AS ht WHERE ht.status='1' AND ( 
	// 	ht.title like '%".$term."%' 
	//    	OR ht.street like '%".$term."%' 
	//    	OR ht.city like '%".$term."%' 
	//    	OR ht.zone like '%".$term."%'
	//    	OR ht.district like '%".$term."%') ORDER BY id DESC ";
	// $query2 = $db->query($sql2);
	// $totRec2 = $db->num_rows($query2);
	// if($totRec2>0) {
	// 	while($row=$db->fetch_object($query2)) {
	// 		$hotel = $row->title.', '.$row->street.', '.$row->city.', '.$row->zone.', '.$row->district;
	// 		$newArr[] = array('value'=> $hotel, 'id'=>$row->code);
	// 	}
	// }

	echo  json_encode($newArr);
}


if(!empty($_POST['action']) and ($_POST['action']=='getlink')) {
	foreach($_POST as $key=>$val) { $$key = $val;}
	$data = serialize(array('searchkey'=>$searchkey, 'datepicker2'=>$datepicker2,'hotel_code'=>$hotel_code ));
	echo json_encode(array('url'=>strtr(base64_encode($data), '+/', '-_')));

}

if (!empty($_POST['action']) and ($_POST['action'] == 'getlinktour')) {
    foreach ($_POST as $key => $val) {$$key = $val;}
    $data = serialize(array(
        'destination' => $destination,
        'activity' => $activity,
        'duration' => $duration));
    echo json_encode(array('url' => strtr(base64_encode($data), '+/', '-_')));
}

if(!empty($_POST['action']) and ($_POST['action']=='getsearch')) {
    foreach($_POST as $key=>$val) { $$key = $val;}
    $rating = (!empty($rating))?$rating:'';
    $data = serialize(array('destination_id'=>$destination_id, 'price_range'=>$price_range, 'checkin'=>$checkin, 'checkout'=>$checkout, 'adults'=>$adults , 'child'=>$child , 'rating'=>$rating ));
    echo json_encode(array('url'=>strtr(base64_encode($data), '+/', '-_')));
}