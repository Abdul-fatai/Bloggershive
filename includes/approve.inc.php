<?php

session_start();
if (isset($_POST['approve'])) {
	include_once 'dbh.php';
	$post_id = filter_input(INPUT_POST,'post_id', FILTER_SANITIZE_STRING);

	$status = "Approved";
	$sql = "UPDATE posts SET status='$status' WHERE post_id='$post_id'";
	mysqli_query($conn, $sql);
	header("Location: ../post_approve.php?post_id=".$post_id."success");
	exit();
}