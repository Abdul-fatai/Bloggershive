<?php


if (isset($_POST["reset-password-submit"])) {
	
	$selector = $_POST['selector'];
	$validator = $_POST["validator"];
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$comfirmpassword = filter_input(INPUT_POST, 'pwd-repeat', FILTER_SANITIZE_STRING);

	if (empty($password) || empty($validator)) {
		header("Location: ../create-new-password.php?selector=".$selector." &validator=".$validator."emptyinput");
		exit();
	} else if ($password != $comfirmpassword) {
		header("Location: ../create-new-password.php?selector=".$selector." &validator=".$validator."passwordnotsame");
	}

	$currentDate = date("U");

	require 'dbh.php';

	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >=?";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "You need to re-submit your request.";
			exit();
		} else {

			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

			if ($tokenCheck === false) {
			echo "You need to re-submit your request.";
			exit();

			} elseif ($tokenCheck === true){

				$tokenEmail = $row['pwdResetEmail'];

				$sql = "SELECT * FROM users WHERE email=?;";
				$stmt = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "There was an error!";
					exit();
				} else {
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);

					$result = mysqli_stmt_get_result($stmt);

					if (!$row = mysqli_fetch_assoc($result)) {
						echo "There was an error!";
						exit();
					} else {

						$sql = "UPDATE users SET password=? WHERE email=?";
						$stmt = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "There was a error!";
							exit();
						} else {
							$newpwdhash = password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "ss", $newpwdhash, $tokenEmail);
							mysqli_stmt_execute($stmt);

							$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
							$stmt = mysqli_stmt_init($conn);

							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "There was a error!";
								exit();
							} else {
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../login.php?newpwd=passwordupdated");
							}
						}
					}
				}

			}
		}
	}




} else {
	header("Location: ../index.php?error");
	exit();
}