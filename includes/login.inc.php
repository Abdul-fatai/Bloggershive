<?php
	session_start();
if (isset($_POST['submit'])) {
	include_once 'dbh.php';

	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$pwd 	  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

	// Error handlers
	// Check if inputs are empty

	if (empty($username) || empty($pwd)) {
		header("Location: ../login.php?input=empty");
		exit();
	}else {
		$sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck < 1) {
			header("Location: ../login.php?uid=incorrectusername");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				// De-hashing the password

				$hashedPwdCheck = password_verify($pwd, $row['password']);

				if ($hashedPwdCheck == false) {
					header("Location: ../login.php?pwd=incorrectpwd");
					exit();
				}elseif ($hashedPwdCheck == true) {
					// Login  user in here

					$_SESSION['u_id'] = $row['id'];
					$_SESSION['u_first'] = $row['firstname'];
					$_SESSION['u_last'] = $row['lastname'];
					$_SESSION['u_uid'] = $row['username'];
					$_SESSION['u_email'] = $row['email'];
					header("Location: ../index.php?login=success");
					exit();
					

				} 
				}
			}
		}
	}



 else {
	header("Location: ../login.php?login=errorsubmit");
	exit();
}






