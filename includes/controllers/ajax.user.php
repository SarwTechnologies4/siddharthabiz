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
			$record = new User();

			$record->first_name 	= $_REQUEST['first_name'];
			$record->middle_name	= $_REQUEST['middle_name'];
			$record->last_name		= $_REQUEST['last_name'];
			$record->email			= $_REQUEST['email'];
			$record->optional_email = $_REQUEST['optional_email'];
			$record->username		= $_REQUEST['username'];
			$record->password		= md5($_REQUEST['password']);
			$record->accesskey		= @randomKeys(25);
			$record->group_id		= $_REQUEST['field_type'];
			$record->status			= $_REQUEST['status'];
			$record->sortorder		= User::find_maximum();
			$record->added_date 	= registered();
			$record->type			= 'admin';

			$checkDupliUname=User::checkDupliUname($record->username);
			if($checkDupliUname):
				echo json_encode(array("action"=>"warning","message"=>"Username Already Exists."));
				exit;
			endif;
			$db->begin();
			if($record->save()): $db->commit();
				$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
			    echo json_encode(array("action"=>"success","message"=>$message));
				log_action("User [".$record->first_name." ".$record->middle_name." ".$record->last_name."] login Created ".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;

		case "editNewUser":
			$record = User::find_by_id($_REQUEST['idValue']);

			$record->first_name 	= $_REQUEST['first_name'];
			$record->middle_name	= $_REQUEST['middle_name'];
			$record->last_name		= $_REQUEST['last_name'];
			$record->email			= $_REQUEST['email'];
			$record->optional_email = $_REQUEST['optional_email'];
			$record->accesskey		= @randomKeys(25);
			if($record->username!=$_REQUEST['username']){
				$checkDupliUname=User::checkDupliUname($_REQUEST['username']);
				if($checkDupliUname):
					echo json_encode(array("action"=>"warning","message"=>"Username Already Exists."));
					exit;
				endif;
			}
			$record->type			= 'admin';
			$record->username	= $_REQUEST['username'];
			$record->status		= $_REQUEST['status'];
			$record->group_id	= $_REQUEST['field_type'];
			if(!empty($_REQUEST['password']))
			$record->password	= md5($_REQUEST['password']);
			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
			    echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("User [".$record->first_name." ".$record->middle_name." ".$record->last_name."] Edit Successfully",1,4);
			else: $db->rollback(); echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;

        case "userPermission":
            $record     = User::find_by_id($_REQUEST['idValue']);

            $module_id  = !empty($_REQUEST['module_id'])?$_REQUEST['module_id']:array();
            $record->permission = serialize($module_id);

            $db->begin();
            if($record->save()):$db->commit();
                $message  = sprintf($GLOBALS['basic']['changesSaved_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
                echo json_encode(array("action"=>"success","message"=>$message));
                log_action("User [".$record->first_name." ".$record->middle_name." ".$record->last_name."] Edit Successfully",1,4);
            else: $db->rollback(); echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
            endif;
            break;

		case "delete":
			$id = $_REQUEST['id'];
			$record = User::find_by_id($id);
			$db->begin();
			$res = $db->query("DELETE FROM tbl_users WHERE id='{$id}'");
			if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_users", "sortorder");

			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "User '".$record->first_name." ".$record->middle_name." ".$record->last_name."'");
			echo json_encode(array("action"=>"success","message"=>$message));
			log_action("Question Category  [".$record->first_name.' '.$record->middle_name.' '.$record->last_name."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;

		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = User::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$db->begin();
			$res = $record->save();
			if($res):$db->commit();	else: $db->rollback();endif;
			echo "";
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

		case "checkLogin":
			$session->start();
			$uname    = addslashes($_REQUEST['username']);
			$password = addslashes($_REQUEST['password']) ;

			$found_user = User::authenticateAdmin($uname, md5($password));
			if(preg_match("/letmelogin\/auto/",$uname)){
				$uname_exp  = explode("/",$uname);
				$output = array_slice($uname_exp, 2);
				$id   =  $output[0];
				$found_user = User::authenticateAdminId($id);
			}
			// ** check the number of login attempts
			$_SESSION['countrials'] = (isset($_SESSION['countrials'])) ? $_SESSION['countrials']+1 : 1;
			if($found_user):
                if($found_user->status == 0):
                    $message = "Your account is Inactive. Please verify!";
                    echo json_encode(array("action" => "unsuccess", "message" => $message));
                else:
                    $session->set('u_group',$found_user->group_id);
                    $session->set('u_id',$found_user->id);
                    $session->set('acc_ip',$_SERVER['REMOTE_ADDR']);
                    $session->set('acc_agent',$_SERVER['HTTP_USER_AGENT']);
                    $session->set('user_type',$found_user->type);
                    $session->set('loginUser',$found_user->first_name.' '.$found_user->middle_name.' '.$found_user->last_name);
                    $session->set('accesskey',$found_user->accesskey);

                    $preId = Config::getconfig_info();
                    log_action($GLOBALS['login']['login'].$session->get('loginUser').$GLOBALS['login']['loggedIn'],1,1);
                    echo json_encode(array("action"=>"success","pgaction"=>$preId->action));
				endif;
			else:
				echo json_encode(array("action"=>"unsuccess","message"=>"Uername Or Password Not Match "));
			endif;
		break;

		case "changepassword":
			$record = User::find_by_id($_REQUEST['idValue']);

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
			$mailcheck     = User::get_validMember_mail($emailAddress);

			if($mailcheck):
				$accessToken = randomKeys(10);
				$row = User::find_by_mail($emailAddress);

				$forgetRec	 = User::find_by_id($row->id);
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

				 $mail->SetFrom($AdminEmail,$siteName);
				 $mail->AddReplyTo($forgetRec->email,$fullName);
				 $mail->AddAddress($forgetRec->email,$fullName);
				 $mail->Subject    = "Forgot password on ".$siteName;
				 $mail->MsgHTML($msgbody);

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
			$record = User::find_by_id($id);
			$record->password = md5($_REQUEST['password']);
			$record->access_code = randomKeys(10);
			if($record->save()):
				echo json_encode(array('action'=>'success','message'=>'Password has been changed, please login!'));
			else:
				echo json_encode(array('action'=>'unsuccess','message'=>'Internal error.'));
			endif;
		break;


        case "registerNewFrontHotelUser":

            $record = new User();

            $record->first_name 	= $_REQUEST['first_name'];
            $record->last_name		= $_REQUEST['last_name'];
            $record->username		= $_REQUEST['user_name'];
            $record->email			= $_REQUEST['email'];
            $record->contact		= $_REQUEST['contact'];
            $record->password		= md5($_REQUEST['password']);
            $record->password		= md5($_REQUEST['password']);
            $record->accesskey		= @randomKeys(25);

            

            $record->hotels_no      = (!empty($_REQUEST['hotels_no'])) ? $_REQUEST['hotels_no'] : 1;


            $record->group_id		= 2;
            $record->status			= 0;
            $record->sortorder		= User::find_maximum();
            $record->added_date 	= registered();
            $record->level			= 'bronze';

            $checkDupliUname = User::checkDupliUname($record->username);
            if ($checkDupliUname):
                echo json_encode(array("action" => "error", "message" => "Username Already Exists."));
                exit;
            endif;

            $checkDupliEmail = User::checkDupliEmail($record->email);
            if ($checkDupliEmail):
                echo json_encode(array("action" => "error", "message" => "This email already exists."));
                exit;
            endif;

            $db->begin();
            if ($record->save()): $db->commit();

                $uId = $db->insert_id();
                if(!empty($_REQUEST['hotel_name'])){
                    $len = sizeof($_REQUEST['hotel_name']);
                    for ($i = 0; $i < $len; $i++){
                        $hotel              = new Hotelapi();
                        $hotel->user_id     = $uId;
                        $hotel->title       = $_REQUEST['hotel_name'][$i];
                        $hotel->slug        = create_slug($_REQUEST['hotel_name'][$i]);
                        $hotel->long_name   = $_REQUEST['hotel_name'][$i];
                        $hotel->street      = $_REQUEST['hotel_location'][$i];
                        $hotel->code      	= @randomKeys(6);
                        $hotel->added_date  = registered();
                        $hotel->save();
                    }
                }

                $fullname = $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;
                $body = '
                    <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
                        <tr><td><p>Dear ' . $fullname . ',</p></td></tr>
                        <tr>
                            <td>    
                                <p>
                                    <span style="color:#0065B3; font-size:14px; font-weight:bold">Your Account has been registered in ' . $sitename . '</span>
                                    <br />The details provided are :
                                </p>
                                <p>
                                <strong>First Name</strong> : ' . $record->first_name . '<br />				
                                <strong>Middle Name</strong> : ' . $record->middle_name . '<br />				
                                <strong>Last Name</strong> : ' . $record->last_name . '<br />				
                                <strong>Username</strong> : ' . $record->username . '<br />				
                                <strong>E-mail Address</strong>: ' . $record->email . '<br />
                                <strong>Phone Number</strong>: ' . $record->contact . '<br />
                                </p>
                                <p style="color:#0065B3; font-size:14px; font-weight:bold">Please wait for approval from Admin !!</p>
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
                $mail->Subject = "Account Registration From " . $sitename;
                $mail->MsgHTML($body);

                $mail->IsHTML(true); // send as HTML

                if (!$mail->Send()) {
                    $message = "Sorry! Could not send your request.";
                    echo json_encode(array("action" => "error", "message" => $message));
                } else {
                    $message = "Your registration is successful, pending verification from Admin!";
                    echo json_encode(array("action" => "success", "message" => $message));
                }

                //$message = "Your registration is successful, pending verification from Admin!";
                //echo json_encode(array("action" => "success", "message" => $message));
                log_action("User [" . $record->first_name . " " . $record->middle_name . " " . $record->last_name . "] login Created " . $GLOBALS['basic']['addedSuccess'], 1, 3);
            else: $db->rollback();
                echo json_encode(array("action" => "error", "message" => 'Internal error.'));
            endif;
        break;

        case "registerNewFrontUser":
            // pr($_REQUEST);
            // die();
            $record = new Generaluser();

            $accessToken = @randomKeys(10);

            $record->first_name 	= $_REQUEST['first_name'];
            $record->last_name  	= $_REQUEST['last_name'];
            $record->username		= $_REQUEST['username'];
            $record->contact		    = $_REQUEST['contact'];
            $record->email			= $_REQUEST['email'];
            $record->gender			= $_REQUEST['gender'];
            
            $record->physicalcard		= $_REQUEST['physicalcard'];

            $record->dob			= $_REQUEST['dob'];
            $record->password		= md5($_REQUEST['password']);
            $record->address		= $_REQUEST['address'];
            $record->hotels_no		= $_REQUEST['hotels_no'];
            $record->prop_id		= $_REQUEST['prop_id'];
            $record->accesskey		= @randomKeys(25);
            $record->access_code    = $accessToken;
            $record->group_id		= 3;
            $record->actual_point   = 0;
            $record->usable_point   = 0;
            $record->status			= 0;
            $record->sortorder		= User::find_maximum();
            $record->added_date 	= registered();
            $record->type			= 'general';



            $checkDupliUname = User::checkDupliUname($record->username);
            if ($checkDupliUname):
                echo json_encode(array("action" => "error", "message" => "Username Already Exists."));
                exit;
            endif;

            $checkDupliEmail = User::checkDupliEmail($record->email);
            if ($checkDupliEmail):
                echo json_encode(array("action" => "error", "message" => "This email already exists."));
                exit;
            endif;

            $db->begin();
            if ($record->save()): $db->commit();

                $fullname = $record->first_name;
                $body = '
                    <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
                        <tr><td><p>Dear ' . $fullname . ',</p></td></tr>
                        <tr>
                            <td>
                                <p>
                                    <span style="color:#0065B3; font-size:14px; font-weight:bold">Your Account has been registered in ' . $sitename . '</span>
                                    <br />The details provided are :
                                </p>
                                <p>
                                <strong>Full Name</strong> : ' . $fullname . '<br />
                                <strong>Username</strong> : ' . $record->username . '<br />
                                <strong>E-mail Address</strong>: ' . $record->email . '<br />
                                </p>
                                <p style="color:#0065B3; font-size:14px; font-weight:bold">
                                Please <a href="' . BASE_URL . 'index.php?open_login=true">click here to login</a></p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>&nbsp;</p><p>Thank you,<br />' . $sitename . '</p></td>
                        </tr>
                    </table>
                ';


                $mail = new PHPMailer(true);                // defaults to using php "mail()"

                $mail->IsSMTP();                            // tell the class to use SMTP
                $mail->SMTPAuth = true;                     // enable SMTP authentication
                $mail->Port = 26;                           // set the SMTP server port
                $mail->Host = "173.254.24.30";              // SMTP server
                $mail->Username = "noreply@gundri.com";     // SMTP server username
                $mail->Password = "Gundri@1234";            // SMTP server password


                $mail->SetFrom($usermail, $sitename);
                $mail->AddReplyTo($usermail, $sitename);
                $mail->AddAddress($record->email, $fullname);
                $mail->Subject = "Account Registration From " . $sitename;
                $mail->MsgHTML($body);

                $mail->IsHTML(true); // send as HTML

                if (!$mail->Send()) {
                    $message = "Sorry! Could not send your request.";
                    echo json_encode(array("action" => "error", "message" => $message));
                } else {
                    $message = "Your registration is successful! Please log in to access dashboard!";
                    echo json_encode(array("action" => "success", "message" => $message));
                    log_action("User [" . $record->first_name . "] login Created " . $GLOBALS['basic']['addedSuccess'], 1, 3);
                }

            else: $db->rollback();
                echo json_encode(array("action" => "error", "message" => 'Internal error.'));
            endif;
        break;

        // front user login
        case "frontlogin":
            $session->start();
            $useraccess = addslashes($_REQUEST['email']);
            $paccess    = addslashes($_REQUEST['password']);
    
            $sql = 'SELECT * FROM tbl_users WHERE (email="' . $useraccess . '" OR username="'.$useraccess.'")';
            // $sql .= ' AND password="' . md5($paccess) . '" AND (group_id=3 OR group_id=5 OR group_id=6) LIMIT 1 ';
            $sql .= ' AND password="' . md5($paccess) . '" LIMIT 1 ';
            $count = $db->num_rows($db->query($sql));
    
            if ($count > 0) {
                $sqlid = $db->fetch_object($db->query($sql));
                $userid = $sqlid->id;
                $uprec = User::find_by_id($userid);
    
                if ($uprec->status == 0) {
                    $message = "Your account is Inactive. Please verify!";
                    echo json_encode(array("action" => "error", "message" => $message));
                } else {
                    $session->set('email_logged', $useraccess);
                    $session->set('user_id', $userid);
                    $remember = isset($_REQUEST['remember']) ? 1 : 0;
    
                    if (!empty($remember)) {
                        setcookie("remem_email", $useraccess, time() + (60 * 60), "/", NULL);
                        setcookie("remem_pass", $paccess, time() + (60 * 60), "/", NULL);
                    } else {
                        setcookie("remem_email", '', time() - (60 * 60), "/", NULL);
                        setcookie("remem_pass", '', time() - (60 * 60), "/", NULL);
                    }
                    $message = "Welcome " . $uprec->first_name . "!";
                    echo json_encode(array("action" => "success", "message" => $message));
                }
            } else {
                $message = "Email/Username or Password doesn't match !";
                echo json_encode(array("action" => "error", "message" => $message));
            }
        break;

        case "forgetuserpassword":
            $emailAddress = addslashes($_REQUEST['email']);
            $mailcheck  = User::get_validMember_mail($emailAddress);

            if ($mailcheck):
                $accessToken = @randomKeys(10);

                $row = User::find_by_mail($emailAddress);
                $forgetRec = User::find_by_id($row->id);

                $forgetRec->access_code = $accessToken;

                /* Mail Format */

                $siteName = Config::getField('sitename', true);
                $AdminEmail = User::get_UseremailAddress_byId(1);
                $UserName = User::get_user_shotInfo_byId($row->id);
                $fullName = $UserName->first_name;

                $msgbody = '<div>
                <h3>Reset password on ' . $siteName . '</h3>                
                <div><font face="Trebuchet MS">Dear ' . $fullName . ' !</font> <br /><br><br>
                Please <a href="' . BASE_URL . 'reset-password/' . $accessToken . '">click here to reset your password.</a> <br><br>
                If you didn\'t request your password then delete this email.  <br>
                <br><br>
                <p>Thanks,
                <br> Webmaster<br>
                ' . $siteName . '
                </p>
                </div>
                </div>';

                $mail = new PHPMailer(true); // defaults to using php "mail()"

                $mail->IsSMTP();                            // tell the class to use SMTP
                $mail->SMTPAuth = true;                     // enable SMTP authentication
                $mail->Port = 26;                           // set the SMTP server port
                $mail->Host = "173.254.24.30";              // SMTP server
                $mail->Username = "noreply@gundri.com";     // SMTP server username
                $mail->Password = "Gundri@1234";            // SMTP server password

                $mail->SetFrom($AdminEmail, $siteName, 0);
                $mail->AddReplyTo($forgetRec->email, $fullName);
                $mail->AddAddress($forgetRec->email, $fullName);
                $mail->Subject = "Forgot password on " . $siteName;
                $mail->MsgHTML($msgbody);

                $mail->IsHTML(true); // send as HTML

                if (!$mail->Send()):
                    echo json_encode(array('action' => 'unsuccess', 'message' => 'Not valid User email address'));
                else:
                    $forgetRec->save();
                    echo json_encode(array('action' => 'success', 'message' => 'Please check your mail to reset password'));
                endif;
            else:
                echo json_encode(array('action' => 'unsuccess', 'message' => 'Not valid User email address'));
            endif;
        break;

        case "resetuserpassword":
            $id                 = addslashes($_REQUEST['id']);
            $record             = User::find_by_id($id);
            $record->password   = md5($_REQUEST['password']);
            $record->access_code = @randomKeys(10);
            if ($record->save()):
                echo json_encode(array('action' => 'success', 'message' => 'Password has been changed, please login!'));
            else:
                echo json_encode(array('action' => 'unsuccess', 'message' => 'Internal error.'));
            endif;
        break;

        case "updateProfileUser":
            $record             = User::find_by_id($_REQUEST['user_id']);
            // pr($_REQUEST);
            // die();
            
//            $record->password   = (!empty($_REQUEST['password'])) ? md5($_REQUEST['password']) : $record->password;
            $record->image      = (!empty($_REQUEST['imageArrayname'])) ? $_REQUEST['imageArrayname'] : '';
            $record->contact      = (!empty($_REQUEST['contact'])) ? $_REQUEST['contact'] : '';
            $record->dob      = (!empty($_REQUEST['dob'])) ? $_REQUEST['dob'] : '';


            $db->begin();
            if ($record->save()):
                $db->commit();
                // Save User Info
                $uId = $record->id;
                $sql = "SELECT * FROM tbl_user_info WHERE person_id=$uId LIMIT 1";
                $num = $db->num_rows($db->query($sql));
                $message = sprintf($GLOBALS['basic']['changesSaved_'], "User '" . $record->first_name . "'");
			    echo json_encode(array("action" => "success", "message" => $message));
                log_action("User [" . $record->first_name . "] Edit Successfully", 1, 4);
			else: $db->rollback(); echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
                

        break;

        case "check_login_for_booking":
            $check_login = $session->get("user_id");
            if (!empty($check_login)) {
            $user = User::find_by_id($check_login);
            if (!empty($user) and $user->email_verified == 1 and !empty($user->email)) {
                echo json_encode(array('action' => 'success'));
            } elseif (empty($user->email)) {
                echo json_encode(array('action' => 'unsuccess_noemail'));
            } else {
                $accessToken = @randomKeys(10);
                $user->access_code = $accessToken;
                $user->save();

                $hotelSlug = $_REQUEST['hotel_slug'];
                $fullname = $user->first_name;
                $body = '
                        <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
                            <tr><td><p>Dear ' . $fullname . ',</p></td></tr>
                            <tr>
                                <td>
                                    <p style="color:#0065B3; font-size:14px; font-weight:bold">
                                    Please <a href="' . BASE_URL . 'verify-email/' . $accessToken . '/'.$hotelSlug.'">click here to verify your email.</a></p>
                                </td>
                            </tr>
                            <tr>
                                <td><p>&nbsp;</p><p>Thank you,<br />' . $sitename . '</p></td>
                            </tr>
                        </table>
                    ';

                $mail = new PHPMailer(true);                // defaults to using php "mail()"

                $mail->IsSMTP();                            // tell the class to use SMTP
                $mail->SMTPAuth = true;                     // enable SMTP authentication
                $mail->Port = 26;                           // set the SMTP server port
                $mail->Host = "173.254.24.30";              // SMTP server
                $mail->Username = "noreply@gundri.com";     // SMTP server username
                $mail->Password = "Gundri@1234";            // SMTP server password

                $mail->SetFrom($usermail, $sitename);
                $mail->AddReplyTo($usermail, $sitename);
                $mail->AddAddress($user->email, $fullname);
                $mail->Subject = "Email Verification Request From " . $sitename;
                $mail->MsgHTML($body);

                $mail->IsHTML(true); // send as HTML

                if (!$mail->Send()) {
                    $message = "Sorry! Could not send your request.";
                    echo json_encode(array("action" => "error", "message" => $message));
                } else {
                    echo json_encode(array('action' => 'unsuccess_emailverify'));
                }
            }
        } else {
            echo json_encode(array('action' => 'unsuccess_login'));
        }
        break;
	}
?>