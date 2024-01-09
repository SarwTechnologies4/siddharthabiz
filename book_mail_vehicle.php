<?php

$usermail = User::get_UseremailAddress_byId(1);
//$usermail = "swarna@longtail.info";
//$ccusermail = User::field_by_id(1,'optional_email');
$sitename = Config::getField('sitename', true);

$full_name = $fname . ' ' . $lname;

$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
        <tr>
            <td><p>Dear Sir,</p>
            </td>
        </tr>
        <tr>
            <td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Booking message</span><br/>
                The details provided are:</p>
                <p>
                    <strong>Fullname</strong> : ' . $full_name . '<br/>
                    <strong>E-mail Address</strong>: ' . $email . '<br/>
                    <strong>Phone</strong> : ' . $phone . '<br/>
                    <strong>City</strong> : ' . $city . '<br/>
                    <strong>Country</strong> : ' . $country . '<br/>
                    <strong>Pax</strong> : ' . $pax . '<br/>
                    <strong>Date</strong> : ' . $date . '<br/>
                    <strong>Message</strong>: ' . str_replace('\'', '', $message) . '<br/>
                </p>
                <p>
                <table border="1" style="font:12px Arial, serif;color:#222; border: 1px solid #222; text-align: center; width: 60%;">
                    <tr>
                        <td style="height:20px;"><p>Vehicle</p></th>
                        <td style="height:20px;"><p>Quantity</p></td>
                    </tr>
                    ';
$vehicles = $_SESSION['cart_detail'][$user_id];
foreach ($vehicles as $k => $v) {
    $vehicle = Vehicle::find_by_id($k);
    if (!empty($vehicle)) {
        $body .= '
                    <tr>
                        <td style="height:20px;">' . $vehicle->title . '</td>
                        <td style="height:20px;">' . $v['quantity'] . '</td>
                    </tr>
                ';
    }
}
$body .= '
                </table>
                </p>            
            </td>
        </tr>
        <tr>
            <td><p>&nbsp;</p>
                <p>Thank you,<br/>
                    ' . $full_name . '
                </p></td>
        </tr>
    </table>
	';

/*
* mail info
*/
$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->IsSMTP();                            // tell the class to use SMTP
$mail->SMTPAuth = true;                     // enable SMTP authentication
$mail->Port = 26;                           // set the SMTP server port
$mail->Host = "173.254.24.30";              // SMTP server
$mail->Username = "noreply@gundri.com";     // SMTP server username
$mail->Password = "Gundri@1234";            // SMTP server password

$mail->SetFrom($email, $full_name);
$mail->AddReplyTo($email, $full_name);
$mail->AddAddress($usermail, $sitename);
// if add extra email address on back end
if (!empty($ccusermail)) {
    $rec = explode(';', $ccusermail);
    if ($rec) {
        foreach ($rec as $row) {
            $mail->AddCC($row, $sitename);
        }
    }
}
$mail->Subject = 'Vehicle Booking mail from ' . $full_name;
$mail->MsgHTML($body);
$mail->IsHTML(true); // send as HTML
$mail->Send();
?>