<?php
function send_mail($tomail, $subject, $body, $cc = null){
    require_once DIR_CLASS.'phpmail/class.phpmailer.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.php.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'php@php.net';
    $mail->Password = 'php';
    $mail->From = 'php@php.net';
    $mail->FromName = 'php team';
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->AddAddress($tomail);
    $mail->AddReplyTo("php@php.net","php.net");
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = 'text/html';

    if(!empty($cc)){
        $mail->AddCC($cc);
    }

    if($mail->Send()){
        return true;
    }else {
        return false;
    }
}
