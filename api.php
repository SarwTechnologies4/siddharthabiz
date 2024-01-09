<?php header('Content-Type: application/json');
require_once("includes/initialize.php");
$action = addslashes($_REQUEST['act']);
switch($action) {
    case "hotels":
        
        $output = array();
        $sql = "SELECT hd.title, hd.code, hd.slug, hd.home_image, hd.street, hd.city, rd.currency, rp.one_person 
    		FROM tbl_apihotel AS hd 
    		INNER JOIN tbl_roomapi AS rd
    		ON hd.id = rd.hotel_id
    		INNER JOIN tbl_roomapi_price AS rp 
    		ON rd.id = rp.room_id
    	WHERE hd.status='1' AND hd.featured='1' GROUP BY hd.id ORDER BY hd.id ASC limit 8";
    
    	$query = $db->query($sql);
    	$totno = $db->num_rows($query);
    	
    	if($totno>0) {
    	    while($rhapiRow = $db->fetch_object($query)) {
    	        $imgname = $rhapiRow->home_image;
        	    $output[] = array(
                    'title' => $rhapiRow->title,
                    'url' => BASE_URL.'hotel/'.$rhapiRow->slug,
                    'image' => IMAGE_PATH.'hotelapi/home/'.$imgname,
                    'address' => $rhapiRow->street.', '.$rhapiRow->city,
                    'price' => $rhapiRow->currency.' '.$rhapiRow->one_person
                );
    	    }
    	}
        
        echo ( json_encode($output) );
        break;
        
    case "global_search":
        $term = addslashes($_REQUEST['search']);
    	$sql = "SELECT ht.code, ht.title, ht.street, ht.city, ht.zone, ht.district, ht.country FROM tbl_apihotel AS ht WHERE ht.status='1' AND ( 
    		CONVERT(ht.street USING utf8) like '%".$term."%'
    		OR CONVERT(ht.zone USING utf8) like '%".$term."%'
    	   	OR CONVERT(ht.district USING utf8) like '%".$term."%'
    	   	OR CONVERT(ht.country USING utf8) like '%".$term."%' ) GROUP BY ht.district ORDER BY id DESC ";
    	$query = $db->query($sql);
    	$totRec = $db->num_rows($query);
    	$newArr = array();
    	if($totRec>0) {
    		while($row=$db->fetch_object($query)) {
    			$address = $row->zone.', '.$row->district;
    			$newArr[] = array('id'=>$row->district, 'text'=> $address);
    		}
    	}
    
    	$sql2 = "SELECT ht.code, ht.title, ht.street, ht.city, ht.zone, ht.district FROM tbl_apihotel AS ht WHERE ht.status='1' AND ( 
    		ht.title like '%".$term."%' 
    	   	OR ht.street like '%".$term."%' 
    	   	OR ht.city like '%".$term."%' 
    	   	OR ht.zone like '%".$term."%'
    	   	OR ht.district like '%".$term."%') ORDER BY id DESC ";
    	$query2 = $db->query($sql2);
    	$totRec2 = $db->num_rows($query2);
    	if($totRec2>0) {
    		while($row=$db->fetch_object($query2)) {
    			$hotel = $row->title.', '.$row->street.', '.$row->city.', '.$row->zone.', '.$row->district;
    			$newArr[] = array('id'=>$row->code, 'text'=> $hotel);
    		}
    	}
    
    	echo  json_encode($newArr);
        break;
        
    case "slink":
    	foreach($_GET as $key=>$val) { $$key = $val;}
    	$data = serialize(array('searchkey'=>$searchkey, 'hotelid'=>$searchkey, 'checkin'=>$checkin, 'checkout'=>$checkout, 'adults'=>$adults , 'child'=>$child ));
    	echo json_encode(array('url'=>strtr(base64_encode($data), '+/', '-_')));
        break;
}