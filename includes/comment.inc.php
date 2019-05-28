<?php

if (isset($_POST['submit_comment'])) {
	include_once 'dbh.php';
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
	$post_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
	// Error handlers
	// Chech for empty input
	if (empty($name) || empty($message)) {
		header("Location: ../article.php?emptyinput");
	}else {
		$date = Date('Y-m-d');
		$sql = "INSERT INTO comments (name, post_id, comment, comment_date) VALUES ('$name', '$post_id', '$message', '$date');";
		mysqli_query($conn, $sql);
		header("Location: ../article.php?post_id=".$post_id."success");
	}


}else {
	header("Location: ../article.php?error");
	exit();
}