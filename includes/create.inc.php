<?php

session_start();

if (isset($_POST['submit'])) {
	include_once 'dbh.php';

	$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
	$select = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
	$massage = filter_input(INPUT_POST, 'massage', FILTER_SANITIZE_STRING);
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed =  array('jpg', 'jpeg', 'png', 'gif', 'pdf');

	// Error handlers 
	// Check if input is empty

	if (empty($subject) || empty($select) || empty($massage)) {
		header("Location: ../create.php?emptyinput");
		exit();
	} else{
		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNewName = uniqid('', true).'.'.$fileActualExt;
					$fileDestination = '../posts_img/'.$fileNewName;
					move_uploaded_file($fileTmpName, $fileDestination);

					$post_date = date('Y-m-d h:i:sa');
				    $username = $_SESSION['u_uid'];
				    $id = $_SESSION['u_id'];
				    $status = "Pending";

					$sql = "INSERT INTO posts (subject, label, post_img, content, author, status, post_date) VALUES ('$subject', '$select', '$fileNewName', '$massage', '$username', '$status', '$post_date');";

					mysqli_query($conn, $sql);
					header("Location: ../profile.php?id=".$id."success");

				}else {
					echo "This file is too big ";
				}
			}else{
				echo "They was a problem uploading your file";
			}
			
		} else {
			echo "You can not upload file of this type";
		}

	}


}else {
	header("Location: ../create.php?error");
	exit();
}





