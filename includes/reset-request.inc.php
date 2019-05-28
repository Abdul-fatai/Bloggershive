<?php

if (isset($_POST['reset-request-submit'])) {

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);


	$url = "http://localhost/projects/bloggershive/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	require 'dbh.php';

	$userEmail = $_POST['email'];

	$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

	
	$sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

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

$mail->setFrom('oldendayboy@gmail.com', 'bloggershive');
$mail->addAddress($_POST['email']);     // Add a recipient
// $mail->addAddress('staticdev20046@gmail.com');               // Name is optional
$mail->addReplyTo('bloggershive@gmail.com');
// $mail->addCC('staticdev20046@gmail.com');
// $mail->addBCC('staticdev20046@gmail.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Reset your password for bloggershive';
$mail->Body    = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email</p><br>'. '<a href="'.$url.'">'.$url.'</a>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Something went wrong. Please try again.';
} else {
   header("Location: ../forgottenpwd.php?reset=success");
   exit();
}




} else{
	header("Location: ../forgottenpwd.php?error");
	exit();
}