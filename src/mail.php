<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 3;
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "innovatel.sup@gmail.com";
$mail->Password   = "Innovatel12345";

$mail->IsHTML(true);
$mail->AddAddress("01boulanouar@gmail.com", "client");
$mail->SetFrom("innovatel.sup@gmail.com", "amine");

$mail->Subject = "registration email";
$content = '';

$mail->MsgHTML($content);
$mail->Send();
