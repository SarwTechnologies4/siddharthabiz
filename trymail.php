<?php

require_once("includes/initialize.php");
//require_once("includes/helpers/class.smtp.php");

try {
    $mail = new PHPMailer(true); //New instance, with exceptions enabled

    $body = "Test mail.";

    $mail->IsSMTP();                           // tell the class to use SMTP
    $mail->SMTPAuth = true;                  // enable SMTP authentication
    $mail->Port = 26;                    // set the SMTP server port
    $mail->Host = "173.254.24.30"; // SMTP server
    $mail->Username = "noreply@gundri.com";     // SMTP server username
    $mail->Password = "Gundri@1234";            // SMTP server password

    //$mail->IsSendmail();  // tell the class to use Sendmail

    $mail->AddReplyTo("noreply@gundri.com", "Gundri BEta");

    $mail->From = "noreply@gundri.com";
    $mail->FromName = "Gundri";

    $to = "swarnamanshakya@gmail.com";

    $mail->AddAddress($to);

    $mail->Subject = "First PHPMailer Message";

    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->WordWrap = 80; // set word wrap

    $mail->MsgHTML($body);

    $mail->IsHTML(true); // send as HTML

    $mail->Send();
    echo 'Message has been sent.';
} catch (phpmailerException $e) {
    echo $e->errorMessage();
}
?>