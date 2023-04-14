<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$mail = new PHPMailer(True);
$mail -> IsSMTP();
$mail -> Host = 'ssl0.ovh.net';
$mail -> Port = 465;
$mail -> SMTPAuth = true;

if ($mail -> SMTPAuth) {

    $mail->SMTPSecure = 'ssl';
    $mail->Username = 'cours@jasonlevecq.be';
    $mail->Password = 'ProjetTFE';
}



$mail -> CharSet = 'UTF-8';
$mail -> isHTML(true);
$mail -> smtpConnect();

$mail -> From = 'cours@jasonlevecq.be';
$mail -> FromName = 'NO REPLY';
$mail -> addAddress('levecqjason@gmail.com');

$mail -> Subject = 'Merci pour votre message !';
$mail -> Body = 'test';

$mail -> send();

?>