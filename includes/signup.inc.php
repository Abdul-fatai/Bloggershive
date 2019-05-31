<?php
	session_start();
	$id = $_SESSION['u_id'];
if (isset($_POST['submit'])) {
	include_once 'dbh.php';

	$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
	$cpwd = filter_input(INPUT_POST, 'cpwd', FILTER_SANITIZE_STRING);
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

  
	$allowed = array('jpg', 'jpeg', 'png', 'gif');

	// Error handlers 
	// Check if input is empty

	if (empty($fname)) {
		header("Location: ../signup.php?input=emptyfirstname");
		exit();
	}elseif(empty($lname)){
		header("Location: ../signup.php?input=emptylastname");
		exit();

	}elseif(empty($username)){
		header("Location: ../signup.php?input=emptyusername");
		exit();

	}elseif(empty($email)){
		header("Location: ../signup.php?input=emptyemail");
		exit();

	}elseif(empty($pwd)){
		header("Location: ../signup.php?input=emptypwd");
		exit();
	}elseif(empty($cpwd)){
		header("Location: ../signup.php?input=emptycpwd");
		exit();
	} else{
		// check if input character are valid
		if (!preg_match("/^[a-zA-Z]*/", $fname) || !preg_match("/^[a-zA-Z]*/", $lname) || !preg_match("/^[a-zA-Z]*/", $username)) {
			header("Location: ../signup.php?character=invalid");
			exit();
		}else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?email=invalidemail&fname=$fname&lname=$lname&uid=$username");
				exit();
			}else{
				$sql = "SELECT * FROM users WHERE username='$username'";
				$result = mysqli_query($conn, $sql);
				$resultcheck = mysqli_num_rows($result);

				if ($resultcheck > 0) {
				header("Location: ../signup.php?username=usernametaken");
				exit();
			}else {
				if ($pwd != $cpwd) {
					header("Location: ../signup.php?pwd=pwdnotmatch");
					exit();
				}else {
					// hashing the password
					$hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 1000000) {
				$fileNewName = "firstprofileimg".'.'.$fileActualExt;
				$fileDestination = '../profile_imgs/'.$fileNewName;
				move_uploaded_file($fileTmpName, $fileDestination);

				$date = Date('Y-M-d h:i:sa');
				$usertype = "user";
				

				$sqli ="INSERT INTO users (status, firstname, lastname, username, email, profile_img, password, reg_date) VALUES ('$usertype','$fname', '$lname', '$username', '$email', '$fileNewName', '$hashedpwd', '$date');";
				mysqli_query($conn, $sqli);
				header("Location: ../login.php?signupsuccessfully");


			
			} 
		}
	} 
				
				} 
			}
		}
	}




}
} else {
	header("Location: ../signup.php?signuperror");
	exit();
}