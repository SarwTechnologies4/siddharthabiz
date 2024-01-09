<?php
// Load the header files first
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

// Load necessary files then...
require_once('../initialize.php');

$action = $_REQUEST['action'];

$usermail = User::field_by_id('1', 'email');
$sitename = Config::getField('sitename',true);
$bccmail = User::field_by_id('1','optional_email');

switch($action)
{

    case "addNewUser":
        $record = new Generaluser();

        $record->first_name 	= $_REQUEST['first_name'];
//        $record->middle_name	= $_REQUEST['middle_name'];
//        $record->last_name		= $_REQUEST['last_name'];
        $record->email			= $_REQUEST['email'];
//        $record->optional_email = $_REQUEST['optional_email'];
        $record->username		= $_REQUEST['username'];
        $record->password		= md5($_REQUEST['password']);
        $record->accesskey		= @randomKeys(6);
        $record->group_id		= $_REQUEST['field_type'];
        $record->status			= 1;
        $record->sortorder		= User::find_maximum();
        $record->added_date 	= registered();
        $record->type			= 'general';
        $record->contact		= $_REQUEST['contact'];

        $record->address		= $_REQUEST['address'];
        $record->prop_id		= $_REQUEST['prop_id'];

        $record->dob		= $_REQUEST['dob'];
        $record->gender		= $_REQUEST['gender'];

        $record->physicalcard		= $_REQUEST['physicalcard'];


        $record->actual_point		= 0;

        



        $data_hotelapi = Hotelapi::find_by_id($_REQUEST['prop_id']);
        $uniqueid = $db->insert_id();
        $record->user_id = $data_hotelapi->prop_code ."-". $uniqueid;

        $checkDupliUname = Generaluser::checkDupliUname($record->username);
        if ($checkDupliUname):
            echo json_encode(array("action" => "warning", "message" => "Username Already Exists."));
            exit;
        endif;
        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "User '" . $record->first_name . " " . $record->middle_name . " " . $record->last_name . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action("User [" . $record->first_name . " " . $record->middle_name . " " . $record->last_name . "] login Created " . $GLOBALS['basic']['addedSuccess'], 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
    break;

    case "editNewUser":
        $record = Generaluser::find_by_id($_REQUEST['idValue']);

        $record->first_name 	= $_REQUEST['first_name'];
//        $record->middle_name	= $_REQUEST['middle_name'];
//        $record->last_name		= $_REQUEST['last_name'];
        $record->email			= $_REQUEST['email'];
//        $record->optional_email = $_REQUEST['optional_email'];
        $record->accesskey		= @randomKeys(6);
        if($record->username!=$_REQUEST['username']){
            $checkDupliUname = Generaluser::checkDupliUname($_REQUEST['username']);
            if ($checkDupliUname):
                echo json_encode(array("action" => "warning", "message" => "Username Already Exists."));
                exit;
            endif;
        }
        $record->username	= $_REQUEST['username'];
        $record->status		= $_REQUEST['status'];
        $record->group_id	= $_REQUEST['field_type'];
        if(!empty($_REQUEST['password']))
        { $record->password	= md5($_REQUEST['password']); }
        $record->type			= 'general';
        $record->contact		= $_REQUEST['contact'];

        $record->address		= $_REQUEST['address'];
        $record->prop_id		= $_REQUEST['prop_id'];

        $record->dob		= $_REQUEST['dob'];
        $record->gender		= $_REQUEST['gender'];

        $record->physicalcard		= $_REQUEST['physicalcard'];


        $data_hotelapi = Hotelapi::find_by_id($_REQUEST['prop_id']);

        $record->user_id = $data_hotelapi->prop_code ."-". $_REQUEST['idValue'];


        $db->begin();
        if ($record->save()):$db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "User '" . $record->first_name . " " . $record->middle_name . " " . $record->last_name . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action("User [" . $record->first_name . " " . $record->middle_name . " " . $record->last_name . "] Edit Successfully", 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
        endif;
    break;

    case "addReward":
        $record = new Point();
        $edited= "";

        // if($_REQUEST['payment_type'] == 1){
        //     $range = $_REQUEST['range'];
        //     $data = Pricerange::find_by_id($range);
        //     $svfr = !empty($data->feature) ? $data->feature : '';
        //     $saveRec = unserialize(base64_decode($svfr));
        //     $user = Generaluser::find_by_id($_REQUEST['idValue']);
        //     $count= Level::greater_level_count($user->actual_point);   

        //     $level = Level::get_level($user->actual_point,$count);

        //     if(!empty($saveRec[$level[0]->id]['reward_point'])){
        //         $point_tobe =$saveRec[$level[0]->id]['reward_point'];
        //     }else{
        //         echo json_encode(array("action"=>"warning","message"=>"Level Value Not Defined !"));
        //         exit;            }
        //     $record->actual_point = $user->actual_point;
        //     $record->usable_point = $user->usable_point;

        //     $record->point = $point_tobe;
        //     $hoteldata = Hoteluser::find_by_id($_REQUEST['accsid']);
        //     $record->propertyid =$hoteldata->id;


        //     /*correction*/
        //     if(!empty($_REQUEST['cor_status'])){
        //         if($_REQUEST['cor_status'] == 1){
        //             if($user->usable_point<$_REQUEST['cor_point']):				
        //                 echo json_encode(array("action"=>"warning","message"=>"Insufficient balance !"));
        //                 exit;					
        //             endif;
        //             Generaluser::correct_cash($_REQUEST['idValue'],$_REQUEST['cor_point']);
        //         }elseif($_REQUEST['cor_status'] == 2 || $_REQUEST['cor_status'] == 3){
        //             Generaluser::correct_point($_REQUEST['idValue'],$_REQUEST['cor_point']);
        //         }
        //         $edited = "(EDITED)";
        //     }

        //     $result = Generaluser::by_cash($_REQUEST['idValue'],$point_tobe);

        // }


        if($_REQUEST['payment_type'] == 1){

            $billamt = !empty($_REQUEST['billamt'])?$_REQUEST['billamt']:'';
            $data = Pricerange::find_by_billamt($billamt);

            // pr($data);

            if(empty($data)){
                echo json_encode(array("action"=>"warning","message"=>"Price Range Not Defined !"));
                exit;       
            }
            // $range = !empty($_REQUEST['range'])?$_REQUEST['range']:'';
            // $data = Pricerange::find_by_id($range);
            // $svfr = !empty($data->feature) ? $data->feature : '';
            // $saveRec = unserialize(base64_decode($svfr));

            $user = Generaluser::find_by_id($_REQUEST['idValue']);
            $count= Level::greater_level_count($user->actual_point);   

            $level = Level::get_level($user->actual_point,$count);

            if(!empty($data->point)){
                $point_tobe =$data->point;
            }else{
                echo json_encode(array("action"=>"warning","message"=>"Point Not Defined !"));
                exit;            }
            $record->actual_point = $user->actual_point;
            $record->usable_point = $user->usable_point;

            $record->point = $point_tobe;
            $hoteldata = Hoteluser::find_by_id($_REQUEST['accsid']);
            $record->propertyid =$hoteldata->id;


            /*correction*/
            if(!empty($_REQUEST['cor_status'])){
                if($_REQUEST['cor_status'] == 1){
                    if($user->usable_point<$_REQUEST['cor_point']):				
                        echo json_encode(array("action"=>"warning","message"=>"Insufficient balance !"));
                        exit;					
                    endif;
                    Generaluser::correct_cash($_REQUEST['idValue'],$_REQUEST['cor_point']);
                }elseif($_REQUEST['cor_status'] == 2 || $_REQUEST['cor_status'] == 3){
                    Generaluser::correct_point($_REQUEST['idValue'],$_REQUEST['cor_point']);
                }
                $edited = "(EDITED)";
            }

            $result = Generaluser::by_cash($_REQUEST['idValue'],$point_tobe);

        }

        if($_REQUEST['payment_type'] == 2){
            $range = $_REQUEST['range'];
            $data = Pricerange::find_by_id($range);
            $svfr = !empty($data->feature) ? $data->feature : '';
            $saveRec = unserialize(base64_decode($svfr));
            $user = Generaluser::find_by_id($_REQUEST['idValue']);
            $count= Level::greater_level_count($user->actual_point);   

            $level = Level::get_level($user->actual_point,$count);            
            if(!empty($saveRec[$level[0]->id]['reward_point'])){
                $point_tobe =$saveRec[$level[0]->id]['reward_point'];
            }else{
                echo json_encode(array("action"=>"warning","message"=>"Level Value Not Defined !"));
                exit;            }
            $record->actual_point = $user->actual_point;
            $record->usable_point = $user->usable_point;

            $record->point = $point_tobe;
            $hoteldata = Hoteluser::find_by_id($_REQUEST['accsid']);
            $record->propertyid =$hoteldata->id;

            /*correction*/
            if(!empty($_REQUEST['cor_status'])){
                if($_REQUEST['cor_status'] == 1){
                    if($user->usable_point<$_REQUEST['cor_point']):				
                        echo json_encode(array("action"=>"warning","message"=>"Insufficient balance !"));
                        exit;					
                    endif;
                    Generaluser::correct_cash($_REQUEST['idValue'],$_REQUEST['cor_point']);
                }elseif($_REQUEST['cor_status'] == 2 || $_REQUEST['cor_status'] == 3){
                    Generaluser::correct_point($_REQUEST['idValue'],$_REQUEST['cor_point']);
                }
                $edited = "(EDITED)";
            }

            if($user->usable_point<$point_tobe):				
                echo json_encode(array("action"=>"warning","message"=>"Insufficient balance !"));
                exit;					
            endif;
            $result = Generaluser::by_point($_REQUEST['idValue'],$point_tobe);
        }

        if($_REQUEST['payment_type'] == 3){
            $prizeid = $_REQUEST['prize'];
            $data = Reward::find_by_id($prizeid);
           

            $user = Generaluser::find_by_id($_REQUEST['idValue']);
            $count= Level::greater_level_count($user->actual_point);   

            $level = Level::get_level($user->actual_point,$count);        
            // pr($data);   
            $point_tobe =$data->point;
 
            // if(!empty($saveRec[$level[0]->id]['reward_point'])){
            // }else{
            //     echo json_encode(array("action"=>"warning","message"=>"Level Value Not Defined !"));
            //     exit;					

            // }
            $record->actual_point = $user->actual_point;
            $record->usable_point = $user->usable_point;

            $record->point = $point_tobe;
            $hoteldata = Hoteluser::find_by_id($_REQUEST['accsid']);
            $record->propertyid =$hoteldata->id;

            /*correction*/
            if(!empty($_REQUEST['cor_status'])){
                if($_REQUEST['cor_status'] == 1){
                    if($user->usable_point<$_REQUEST['cor_point']):				
                        echo json_encode(array("action"=>"warning","message"=>"Insufficient balance !"));
                        exit;					
                    endif;
                    Generaluser::correct_cash($_REQUEST['idValue'],$_REQUEST['cor_point']);
                }elseif($_REQUEST['cor_status'] == 2 || $_REQUEST['cor_status'] == 3){
                    Generaluser::correct_point($_REQUEST['idValue'],$_REQUEST['cor_point']);
                }
                $edited = "(EDITED)";
            }

            if($user->usable_point<$point_tobe):				
                echo json_encode(array("action"=>"warning","message"=>"Insufficient balance !"));
                exit;					
            endif;
            $result = Generaluser::by_point($_REQUEST['idValue'],$point_tobe);
        }


        $record->particulars = $_REQUEST['particular'] . $edited;
        $record->user_id = $_REQUEST['idValue'];

        $record->status = $_REQUEST['payment_type'];
        $record->reg_date = registered();


        // $general_user = Generaluser::find_by_id($_REQUEST['idValue']);

        $count= Level::greater_level_count($record->actual_point);
        $data = Level::get_level($record->actual_point, $count);   

        
        $expiry_date = registered_adddays($data[0]->exptime);
        Generaluser::modified_date($_REQUEST['idValue'],$expiry_date);
        // pr($general_user,1);


        $db->begin();

        if ($record->save()):        
        // $general_user->save();
        $db->commit();

            $message = sprintf($GLOBALS['basic']['changesSaved_'], "User ''");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action("User [] Edit Successfully", 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
        endif;

    break;

    case "delete":
        $id = $_REQUEST['id'];
        $record = Generaluser::find_by_id($id);
        $db->begin();
        $res = $db->query("DELETE FROM tbl_users WHERE id='{$id}'");
        if($res):$db->commit();	else: $db->rollback();endif;
        reOrder("tbl_users", "sortorder");

        $message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
        echo json_encode(array("action"=>"success","message"=>$message));
        log_action("User [".$record->first_name.' '.$record->middle_name.' '.$record->last_name."]".$GLOBALS['basic']['deletedSuccess'],1,6);
    break;

    // Module Setting Sections  >> <<
    case "toggleStatus":
        $id = $_REQUEST['id'];
        $record = Generaluser::find_by_id($id);
        $record->status = ($record->status == 1) ? 0 : 1 ;
        $db->begin();
        $res = $record->save();
        if($res):$db->commit();	else: $db->rollback();endif;
        echo "";
    break;

    case "toggleApproved":
        $id = $_REQUEST['id'];
        $record = Generaluser::find_by_id($id);

        if ($record->status != '1') {
            $record->status = ($record->status == 1) ? 0 : 1;

            /*
            * Main mail info
            */

            $fullname = $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;

            $body = '
                <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
		  			<tr><td><p>Dear ' . $fullname . ',</p></td></tr>
			  		<tr>
					    <td>    
                            <p>
                                <span style="color:#0065B3; font-size:14px; font-weight:bold">Your Account has been approved by ' . $sitename . '</span>
                                <br />The details provided are :
                            </p>
                            <p>
                                <strong>Name</strong> : ' . $fullname . '<br />				
                                <!--<strong>Middle Name</strong> : ' . $record->middle_name . '<br />				
                                <strong>Last Name</strong> : ' . $record->last_name . '<br />-->				
                                <strong>Username</strong> : ' . $record->username . '<br />				
                                <strong>E-mail Address</strong>: ' . $record->email . '<br />
                                <strong>Phone Number</strong>: ' . $record->contact . '<br />
                            </p>
                            <!--<p>Please log in through ' . BASE_URL . 'apanel or click <a href="' . BASE_URL . 'apanel" target="_blank">here</a></p></p>-->
				 		</td>
			  		</tr>
			  		<tr>
						<td><p>&nbsp;</p><p>Thank you,<br />' . $sitename . '</p></td>
			  		</tr>
				</table>
                ';

            $mail = new PHPMailer(true); // defaults to using php "mail()"

            $mail->IsSMTP();                            // tell the class to use SMTP
            $mail->SMTPAuth = true;                     // enable SMTP authentication
            $mail->Port = 26;                           // set the SMTP server port
            $mail->Host = "173.254.24.30";              // SMTP server
            $mail->Username = "noreply@gundri.com";     // SMTP server username
            $mail->Password = "Gundri@1234";            // SMTP server password

            $mail->SetFrom($usermail, $sitename);
            $mail->AddReplyTo($usermail, $sitename);
            $mail->AddAddress($record->email, $fullname);

            $mail->Subject = "Account Verified From " . $sitename;
            $mail->MsgHTML($body);

            $mail->IsHTML(true); // send as HTML

            if (!$mail->Send()) {
                $message = "Sorry! Could not send your request.";
                echo json_encode(array("action" => "error", "message" => $message));
            } else {
                $db->begin(); $record->save(); $db->commit();
                $message = "User " . $fullname . " has been verified and sent verified mail.";
                echo json_encode(array("action" => "success", "message" => $message));
            }
        } else {
            $record->status = ($record->status == 1) ? 0 : 1;

            /*
            * Main mail info
            */

            $fullname = $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;

            $body = '
                    <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
                        <tr><td><p>Dear ' . $fullname . ',</p></td></tr>
                        <tr>
                            <td>    
                                <p>
                                    <span style="color:#0065B3; font-size:14px; font-weight:bold">Your Account has been deactivated by ' . $sitename . '</span>
                                    <br />The login details provided are :
                                </p>
                                <p>
                                    <strong>First Name</strong> : ' . $record->first_name . '<br />				
                                    <!--<strong>Middle Name</strong> : ' . $record->middle_name . '<br />				
                                    <strong>Last Name</strong> : ' . $record->last_name . '<br />-->				
                                    <strong>Username</strong> : ' . $record->username . '<br />				
                                    <strong>E-mail Address</strong>: ' . $record->email . '<br />
                                    <strong>Phone Number</strong>: ' . $record->contact . '<br />
                                </p>
                                <br />
                                Please contact admin for further assistance.
                            </td>
                        </tr>
                        <tr>
                            <td><p>&nbsp;</p><p>Thank you,<br />' . $sitename . '</p></td>
                        </tr>
                    </table>
                ';

            $mail = new PHPMailer(true); // defaults to using php "mail()"

            $mail->IsSMTP();                            // tell the class to use SMTP
            $mail->SMTPAuth = true;                     // enable SMTP authentication
            $mail->Port = 26;                           // set the SMTP server port
            $mail->Host = "173.254.24.30";              // SMTP server
            $mail->Username = "noreply@gundri.com";     // SMTP server username
            $mail->Password = "Gundri@1234";            // SMTP server password

            $mail->SetFrom($usermail, $sitename);
            $mail->AddReplyTo($usermail, $sitename);
            $mail->AddAddress($record->email, $fullname);

            $mail->Subject = "Account Deactivated From " . $sitename;
            $mail->MsgHTML($body);

            $mail->IsHTML(true); // send as HTML

            if (!$mail->Send()) {
                $message = "Sorry! Could not send your request.";
                echo json_encode(array("action" => "error", "message" => $message));
            } else {
                $db->begin(); $record->save(); $db->commit();
                $message = "User " . $fullname . " has been deactivated and sent mail.";
                echo json_encode(array("action" => "success", "message" => $message));
            }
        }

        break;

    case "sortbyadmin":
        $id 	= $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
        $order	= ($_REQUEST['toPosition']==1)?0:$_REQUEST['toPosition'];// IS a line containing sortorder
        $db->begin();
        $res = $db->query("UPDATE tbl_users SET sortorder=".$order." WHERE id=".$id." ");
        if($res):$db->commit();	else: $db->rollback();endif;
        reOrder("tbl_users", "sortorder");
        $message  = sprintf($GLOBALS['basic']['sorted_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
        echo json_encode(array("action"=>"success","message"=>$message));
    break;


    case "changepassword":
        $record = Generaluser::find_by_id($_REQUEST['idValue']);

        if(!empty($_REQUEST['password']))
            $record->password	= md5($_REQUEST['password']);
        $db->begin();
        if($record->save()): $db->commit();
            $message  = sprintf($GLOBALS['basic']['changesSaved_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
            echo json_encode(array("action"=>"success","message"=>$message));
        else: $db->rollback();echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
        endif;
    break;

    case "forgetuser_password":
        $emailAddress  = addslashes($_REQUEST['mailaddress']);
        $mailcheck     = Generaluser::get_validMember_mail($emailAddress);

        if($mailcheck):
            $accessToken = randomKeys(10);
            $row = Generaluser::find_by_mail($emailAddress);

            $forgetRec	 = Generaluser::find_by_id($row->id);
            $forgetRec->access_code = $accessToken;

            /* Mail Format */
            $siteName   = Config::getField('sitename',true);
            $AdminEmail = User::get_UseremailAddress_byId(1);
            $UserName	= User::get_user_shotInfo_byId($row->id);
            $fullName	= $UserName->first_name.' '.$UserName->middle_name.' '.$UserName->last_name;

            $msgbody = '<div>
				<h3>Reset password on '.$siteName.'</h3>				
				<div><font face="Trebuchet MS">Dear '.$fullName.' !</font> <br /><br><br>
				Please <a href="'.ADMIN_URL.'resetpassword-'.$accessToken.'">click here to reset your password.</a> <br><br>
				If you didn\'t request your password then delete this email.  <br>
				<br><br>
				<p>Thanks,
				<br> Webmaster<br>
				'.$siteName.'
				</p>
				</div>
				</div>';

            $mail = new PHPMailer();

            $mail->IsSMTP();                            // tell the class to use SMTP
            $mail->SMTPAuth = true;                     // enable SMTP authentication
            $mail->Port = 26;                           // set the SMTP server port
            $mail->Host = "173.254.24.30";              // SMTP server
            $mail->Username = "noreply@gundri.com";     // SMTP server username
            $mail->Password = "Gundri@1234";            // SMTP server password

            $mail->SetFrom($AdminEmail,$siteName);
            $mail->AddReplyTo($forgetRec->email,$fullName);
            $mail->AddAddress($forgetRec->email,$fullName);
            $mail->Subject    = "Forgot password on ".$siteName;
            $mail->MsgHTML($msgbody);

            $mail->IsHTML(true); // send as HTML

            if(!$mail->Send()):
                echo json_encode(array('action'=>'unsuccess','message'=>'Not valid User email address'));
            else:
                $forgetRec->save();
                echo json_encode(array('action'=>'success','message'=>'Please check your mail for reset passord'));
            endif;
        else:
            echo json_encode(array('action'=>'unsuccess','message'=>'Not valid User email address'));
        endif;
        break;

    case "resetuser_password":
        $id = addslashes($_REQUEST['userId']);
        $record = Generaluser::find_by_id($id);
        $record->password = md5($_REQUEST['password']);
        $record->access_code = randomKeys(10);
        if($record->save()):
            echo json_encode(array('action'=>'success','message'=>'Password has been changed, please login!'));
        else:
            echo json_encode(array('action'=>'unsuccess','message'=>'Internal error.'));
        endif;
    break;
}
?>