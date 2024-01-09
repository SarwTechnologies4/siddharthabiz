<?php require_once("includes/initialize.php");
// 
if(!empty($_REQUEST['term'])) {
	$term = addslashes($_REQUEST['term']);

	$sql = "SELECT a.id, a.title, a.status,
            CONCAT(a.title, ',', b.title) as combine
            FROM tbl_route a
            LEFT OUTER JOIN (
                SELECT id, parent_id, title FROM tbl_route
                WHERE id in (SELECT parent_id FROM tbl_route)) as b
            ON a.parent_id=b.id 
            WHERE CONVERT( CONCAT(b.title, ',', a.title) USING utf8) like '%".$term."%'
            ORDER BY combine, id ASC";

    $newArr = array();
    $query = $db->query($sql);
	$totRec = $db->num_rows($query);
	if($totRec > 0) {
		while($row=$db->fetch_object($query)) {
			$newArr[] = array('value'=> $row->combine, 'id'=>$row->id);
		}
	}

	echo  json_encode($newArr);
}

// 
if(!empty($_POST['action']) and ($_POST['action']=='getlink')) {
	foreach($_POST as $key=>$val) { $$key = $val;}
	$data = serialize(array('fromkey'=>$searchkey_from, 'from_id'=>$search_from, 'tokey'=>$searchkey_to, 'to_id'=>$search_to, 'date'=>$search_date, 'pax'=>$search_pax ));
	echo json_encode(array('url'=>strtr(base64_encode($data), '+/', '-_')));
}


// Add Vehicle to Cart
if (!empty($_POST['action']) and ($_POST['action'] == 'add_cart')) {
    foreach ($_POST as $key => $val) { $$key = $val; }

    $message = '';
    $total = 0;

    if (isset($_SESSION['cart_detail'][$user_id])) {
        if (array_key_exists($user_id, $_SESSION['cart_detail'])) {
            if (array_key_exists($vehicle_id, $_SESSION['cart_detail'][$user_id])) {
                $qnt = $_SESSION['cart_detail'][$user_id][$vehicle_id]['quantity'];
                $qnt = $qnt + 1;
                $_SESSION['cart_detail'][$user_id][$vehicle_id]['quantity'] = $qnt;
            } else {
                $_SESSION['cart_detail'][$user_id][$vehicle_id]
                    = array(
                    'vehicle_price' => $vehicle_price,
                    'vprice_id' => $vprice_id,
                    'vendor_id' => $vendor_id,
                    'quantity' => '1');
            }
            $message = 'Vehicle added !';
            $total = count($_SESSION['cart_detail'][$user_id]);
        }
    } else {
        $_SESSION['cart_detail'][$user_id][$vehicle_id]
            = array('vehicle_price' => $vehicle_price,
            'vprice_id' => $vprice_id,
            'vendor_id' => $vendor_id,
            'quantity' => '1');
        $message = 'Vehicle added !';
        $total = count($_SESSION['cart_detail'][$user_id]);
    }

    echo json_encode(array('result' => $message, 'no_cart' => $total));
}


// Show Vehicle in Cart
if (!empty($_POST['action']) and ($_POST['action'] == 'list_cart')) {
    foreach ($_POST as $key => $val) { $$key = $val; }

    $res = '';
    $sesRec = isset($_SESSION['cart_detail'][$user_id]) ? $_SESSION['cart_detail'][$user_id] : '';

    if (!empty($sesRec)) {
        $res .= '<ul>';
        foreach ($sesRec as $k => $sesRow) {
            $vehicleInfo = Vehicle::find_by_id($k);
            $imglink = BASE_URL . 'template/nepalhotel/images/gal/1.jpg';
            if ($vehicleInfo->image != "a:0:{}") {
                $imageList = unserialize($vehicleInfo->image);
                $imgno = array_rand($imageList);
                $file_path = SITE_ROOT . 'images/vehicle/' . $imageList[$imgno];
                if (file_exists($file_path)) {
                    $imglink = IMAGE_PATH . 'vehicle/' . $imageList[$imgno];
                }
            }
            $res .= '
                <li class="clearfix cart-remove" data-id="' . $k . '">
                    <a href="javascript:;" class="position-absolute end-0 zindex-2 remove-cart"><i class="fa fa-times"></i></a>  
                    <a href="#" class="widget-posts-img">
                        <img src="' . $imglink . '" class="img-fluid" alt="' . $vehicleInfo->title . '">
                    </a>
                    <div class="widget-posts-descr">
                        <a href="#" title="">' . $vehicleInfo->title . '</a>
                        <div class="geodir-category-location fl-wrap">
                            <!--<a href="#"><i class="fas fa-map-marker-alt"></i> Kathmandu > Pokhara</a>-->
                        </div>
                        <div class="rooms-price">
                            <span class="veh-decrement"><i class="fas fa-minus"></i></span>
                            x<span class="qqnt">' . $sesRow['quantity'] . '</span>
                            <span class="veh-increment"><i class="fas fa-plus"></i></spana> 
                            &nbsp;&nbsp;&nbsp;&nbsp; $ ' . $sesRow['vehicle_price'] . '<strong>/ per ride</strong>
                        </div>
                    </div>
                </li>
            ';
        }
        $res .= '
                <a href="javascript:;" class="btn btn-sm checkout book-vehicle">Check Out</a> 
            </ul>
		';
    } else {
        $res .= '<ul><li>Select your Vehicles and add to cart !</li></ul>';
    }

    echo json_encode(array('result' => $res));
}


// Remove Vehicle from Cart
if (!empty($_POST['action']) and ($_POST['action'] == 'remove_cart')) {
    foreach ($_POST as $key => $val) { $$key = $val; }

    $message = '';
    $total = count($_SESSION['cart_detail'][$user_id]);
    $item_id = !empty($item_id) ? addslashes($item_id) : '';

    if (!empty($item_id)) {
        unset($_SESSION['cart_detail'][$user_id][$item_id]);
        $total = count($_SESSION['cart_detail'][$user_id]);
        $message = 'Vehicle removed !';
    }

    echo json_encode(array('result' => $message, 'no_cart' => $total));
}


// Increment Vehicle
if (!empty($_POST['action']) and ($_POST['action'] == 'increment')) {
    foreach ($_POST as $key => $val) { $$key = $val; }

    if (array_key_exists($cart_id, $_SESSION['cart_detail'][$user_id])) {
        $qnt = $_SESSION['cart_detail'][$user_id][$cart_id]['quantity'];
        $qnt = $qnt + 1;
        $_SESSION['cart_detail'][$user_id][$cart_id]['quantity'] = $qnt;
    }
}


// Decrement Vehicle
if (!empty($_POST['action']) and ($_POST['action'] == 'decrement')) {
    foreach ($_POST as $key => $val) { $$key = $val; }

    if (array_key_exists($cart_id, $_SESSION['cart_detail'][$user_id])) {
        $qnt = $_SESSION['cart_detail'][$user_id][$cart_id]['quantity'];
        if($qnt > 1){ $qnt = $qnt - 1; }
        $_SESSION['cart_detail'][$user_id][$cart_id]['quantity'] = $qnt;
    }
}


// Check before Booking
if (!empty($_POST['action']) and ($_POST['action'] == 'check_for_booking')) {
    foreach ($_POST as $key => $val) { $$key = $val; }

    if (isset($_SESSION['cart_detail'][$user_id])) {
        $new_arr = array();
        $total_pax = 0;
        $vehicles = $_SESSION['cart_detail'][$user_id];
        foreach ($vehicles as $k => $v) {
            $vehicle = Vehicle::find_by_id($k);
            if (!empty($vehicle)) {
                $total_pax = $total_pax + ($vehicle->max_pax * ($v['quantity']));
            }
        }
        if ($total_pax < $pax) {
            echo json_encode(array('action' => 'unsuccess_no_space', 'message' => "Please add more vehicles, not enough space !!!"));
        } else {
            $data = serialize(array(
                'user_id' => $user_id,
                'fromkey' => $searchkey_from,
                'from_id' => $search_from,
                'tokey' => $searchkey_to,
                'to_id' => $search_to,
                'date' => $search_date,
                'pax' => $pax));
            echo json_encode(array('action' => 'success', 'url' => strtr(base64_encode($data), '+/', '-_')));
        }
    } else {
        echo json_encode(array('action' => 'unsuccess_no_vehicle_added', 'message' => "No Vehicles Added !!!"));
    }
}