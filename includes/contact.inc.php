<?php

if (isset($_POST['contact'])) {

require '../PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'oldendayboy@gmail.com';                 // SMTP username
$mail->Password = 'lovemeone';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom($_POST['email'],$_POST['fullname']);
$mail->addAddress('oldendayboy@gmail.com');     // Add a recipient
// $mail->addAddress('staticdev20046@gmail.com');               // Name is optional
$mail->addReplyTo($_POST['email'],$_POST['fullname']);
// $mail->addCC('staticdev20046@gmail.com');
// $mail->addBCC('staticdev20046@gmail.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Form Submission: '.$_POST['subject'];
$mail->Body    = '<div style="background-color: #f2f2f2; width: 40%; margin-left: 20%;"><h3 align=center>Name: '.$_POST['fullname']. '</h3>'.'<p style=" font-size: 15px; width: 70%; margin-left: 20%;">  Message: '.$_POST['message']. '</p></div>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Something went wrong. Please try again.';
} else {
   header("Location: ../contact_us.php?contact=success");
   exit();
}




} else{
	header("Location: ../contact_us.php?error");
	exit();

}