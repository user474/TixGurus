<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

// new email object
$email = new PHPMailer(true);

try
{
	// Server settings - defined in /config/config.php
	$email->SMTPDebug = SMTP::DEBUG_OFF;
	$email->isSMTP();
	$email->Host = MAIL_HOST;
	$email->SMTPAuth = true;
	$email->Username = USERNAME;
	$email->Password = PASSWORD;
	$email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$email->Port = PORT;


	// recipient
	$email->setFrom(FROM, COMPANY_NAME);

	// message
	$email->Subject = 'TixGurus: Password Reset Code';

}
catch(Exception $ex)
{
	echo "Message could not be sent." . $email->ErrorInfo;
}

?>
