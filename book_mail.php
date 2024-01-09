<?php

$usermail = User::get_UseremailAddress_byId(1);
//$ccusermail = User::field_by_id(1,'optional_email');
$sitename = Config::getField('sitename', true);
$pkgRec = Package::find_by_id($packageId);

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
                    <strong>Trip Date</strong> : ' . $traveldate . '<br/>
                    <strong>Message</strong>: ' . str_replace('\'', '', $message) . '<br/>
                </p>
            </td>
        </tr>
        ';
if (!empty($pax_full_name)) {
    $body .= '<tr>
                <p><strong>Additional Travellers Information</strong></p>
                <p>
                    <table border="1" style="font:12px Arial, serif;color:#222; border: 1px solid #222; text-align: center; width: 60%;">
                        <tr>
                            <th style="height:20px;">Full Name</th>
                            <th style="height:20px;">Email Address</th>
                            <th style="height:20px;">Age</th>
                        </tr>
            ';
    $length = sizeof($pax_full_name);
    for ($i = 0; $i < $length; $i++) {
        $body .= '
            <tr>
                <td style="height:20px;">' . $pax_full_name[$i] . '</td>
                <td style="height:20px;">' . $pax_email[$i] . '</td>
                <td style="height:20px;">' . $pax_age[$i] . '</td>
            </tr>
        ';
    }
    $body .= '    </table>
                </p>
            </tr>';
}
$body.='
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
$mail->Subject = 'Booking mail from ' . $full_name . ' for ' . $pkgRec->title;
$mail->MsgHTML($body);
$mail->IsHTML(true); // send as HTML
$mail->Send();
?>