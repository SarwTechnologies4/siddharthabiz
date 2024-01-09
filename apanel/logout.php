<?php
require_once("../includes/initialize.php");
$user = User::find_by_id($session->get('u_id'));
$session->clear('u_id');
$session->clear('accesskey');
@$session->clear('old_u_group');
@$session->clear('old_u_id');
@$session->clear('old_accesskey');
@$session->clear('old_user_type');
@$session->clear('user_hotel_id');
@$session->clear('m_dashboard');
if ($user->group_id == 1) {
    redirect_to(BASE_URL . 'apanel/login');
} else {
    redirect_to(BASE_URL . 'apanel/partner');
}
?>