<?php

	session_start();
	$id = $_SESSION['u_id'];

if (isset($_POST['update_post'])) {
	include_once 'dbh.php';
	$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
	$post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_STRING);
	$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

	// Error handlers 
	// Check for empty inputs

	if (empty($subject) || empty($message)) {
		header("Location: ../post_edit.php?emptyinput");
		exit();
	}else{
		
		$sql = "UPDATE posts SET status='Pending', subject='$subject', content='$message' WHERE post_id='$post_id'";
		mysqli_query($conn, $sql);
		header("Location: ../profile.php?id=".$id."updatesuccess");
		exit();
	}


}else{
	header("Location: ../post_edit.php?error");
	exit();
}


?>