<?php
session_start();
include_once 'dbh.php';
$id = $_SESSION['u_id']; 

	

	if (isset($_POST['profile_update'])) {
	
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'png', 'pdf');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError == 0) {
			if ($fileSize < 1000000) {
				$fileNameNew = "profile".$id.".".$fileActualExt;
				$fileDestination = '../profile_imgs/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);

				$sql = "UPDATE users  SET profile_img = '$fileNameNew' WHERE id='$id'";
				mysqli_query($conn, $sql);
				header("Location: ../profile.php?id=".$id."success");
				exit();

			} else {
				header("Location: ../profile.php?id=".$id."&file=toobig");
				exit();
			}
		}else{
			header("Location: ../profile.php?id=".$i."&file=error");
			exit();
		}
		
	} else{
		header("Location: ../profile.php?id=".$id."&file=notthsitype");
		exit();
	}


	} else {
		header("Location: ../profile.php?id=".$id."uploaderror");
		exit();
	}
?>