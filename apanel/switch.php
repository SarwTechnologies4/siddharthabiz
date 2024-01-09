<?php
require_once("../includes/initialize.php");
$accesskey  =  isset($_GET['id']) ? $_GET['id'] : '';
$row_user  =  Hoteluser::get_by_accesskey($accesskey);
if(!empty($row_user)) {
    $access_user_id  =  $row_user->id;
    if(!empty($access_user_id)){
      if(isset($_SESSION['old_u_group']))
      {         $old_u_group    = $session->get('old_u_group');          
                $old_u_id       = $session->get('old_u_id');
                $old_accesskey     = $session->get('old_accesskey');
                $old_user_type    = $session->get('old_user_type'); 

                $session->set('u_group',$old_u_group);
                $session->set('u_id',$old_u_id);
                $session->set('accesskey',$old_accesskey);
                $session->set('user_type',$old_user_type);

                $session->clear('old_u_group');
                $session->clear('old_u_id');
                $session->clear('old_accesskey');
                $session->clear('old_user_type');
                $session->clear('user_hotel_id');
                redirect_to(BASE_URL.'apanel/dashboard');

      }else{ $user_type    = $session->get('user_type');  
           if($user_type=='admin'){ 
                $accsgroup    = $session->get('u_group');          
                $accsid       = $session->get('u_id');
                $accscode     = $session->get('accesskey');
                $user_type    = $session->get('user_type');

                $session->set('old_u_group',$accsgroup);
                $session->set('old_u_id',$accsgroup);
                $session->set('old_accesskey',$accscode);
                $session->set('old_user_type',$user_type);

                $session->set('u_group',$row_user->group_id);
                $session->set('u_id',$access_user_id);
                $session->set('accesskey',$row_user->accesskey);
                $session->set('user_type',$row_user->type);
                redirect_to(BASE_URL.'apanel/dashboard');
           }
           else {
                $session->set('u_group',$row_user->group_id);
                $session->set('u_id',$row_user->id);
                $session->set('acc_ip',$_SERVER['REMOTE_ADDR']);
                $session->set('acc_agent',$_SERVER['HTTP_USER_AGENT']);
                $session->set('user_type',$row_user->type);
                $session->set('loginUser',$row_user->first_name.' '.$row_user->middle_name.' '.$row_user->last_name);
                $session->set('accesskey',$row_user->accesskey);
                $m_dashboard = !empty($_POST['m_dashboard'])?addslashes($_POST['m_dashboard']):'';
                $session->set('m_dashboard', $m_dashboard);
                redirect_to(BASE_URL.'apanel/dashboard');
           }
      }
    }
}
else  {
    echo 'Hotel Login ! Access Denied !!';
}
?>