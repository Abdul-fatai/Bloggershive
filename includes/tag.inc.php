<?php



if (isset($_POST['submit'])) {
	include_once 'dbh.php';

	$tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING);

	// Error handlers 
	// check for empty field

	if (empty($tag)) {
		header("Location: ../addtag.php?emptyinput");
		exit();
	} else {
		$sql = "INSERT INTO tags (name) VALUES ('$tag');";
		mysqli_query($conn, $sql);
		header("Location: ../addtag.php?succes");
	}
}else {
	header("Location: ../addtag.php?error");
	exit();
}