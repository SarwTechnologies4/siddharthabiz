<?php


require_once("includes/initialize.php");

$today = date('Y-m-d', time());


$sql2 = "UPDATE tbl_users SET status = 0 WHERE expiry_date < '".$today."' AND type='general'";


$query2 = $db->query($sql2);


