<?php 
require 'C:/wamp64/bin/php/php5.6.25/PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer();
$mail->isSMTP(); // telling the class to use SMTP
$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
$mail->Port = 587;                                    	// TCP port to connect to
$mail->SMTPDebug  = 0;                     				// enables SMTP debug information
$mail->SMTPAuth = true;                               	// Enable SMTP authentication
$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
$mail->Username = 'vrtnarija.praktikum@gmail.com';              // SMTP username
$mail->Password = 'vrtnar123'; 

/* The correct fix for this is to replace the invalid, misconfigured or self-signed 
certificate with a good one. Failing that, you can allow insecure connections via the 
SMTPOptions property introduced in PHPMailer 5.2.10 (it's possible to do this by subclassing 
the SMTP class in earlier versions), though this is not recommended:  */
$mail->SMTPOptions = array(								
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);					// SMTP password

$mail->setFrom('vrtnarija.praktikum@gmail.com', 'Posodim ti, posodi mi');
$mail->AddReplyTo('vrtnarija.praktikum@gmail.com','no-reply');
$mail->isHTML(true);                                  // Set email format to HTML

?>