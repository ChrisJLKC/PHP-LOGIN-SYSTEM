<?php

require_once "LoginSystemConfig.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if(empty(trim($_POST["username"]))) {
		$username_err = "Please enter a username.";
	}

	else {
		$sql = "SELECT id FROM users WHERE username = ?";

		if($stmt = mysqli_prepare($link, $sql)) {
			mysql_stmt_bind_param($stmt, "s", $param_username);

			$param_username = trim($_POST["username"]);

			if(mysql_stmt_execute($stmt)) {
				mysql_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1) {
					$username_err = "This username is already taken.";
				}

				else {
					$username = trim($_POST["username"]);
				}
			}

			else {
				echo "Oops! Something went wrong. Please try again later.";
			}

			myspli_stmt_close($stmt);
		}
	}

	if(empty(trim($_POST["password"]))) {
		$password_err = "Please enter a password.";
	}

	else if(strlen(trim($_POST["password"])) < 6) {
		$password_err = "Password must have at least 6 characters.";
	}

	else {
		$password = trim($_POST["password"]);
	}


	if(empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err = "Please confirm password.";
	}

	else {
		$confirm_password = trim($_POST["confirm_password"]);

		if(empty($password_err) && ($password != $confirm_password)) {
			$confirm_password_err = "Password did not match.";
		}
	}

	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
		$sql = "INSERT INTO users (username, password) VALUES (?, ?)";

		if($stmt = mysqli_perpare($link, $sql)) {
			mysql_stmt_bind_param($stmt, "ss", $param_username, $param_password);

			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT);


			if(mysqli_stmt_execute($stmt)) {
				header("location: login.php");
			}

			else {
				echo "Something went wrong. Please try again later.";
			}

			mysqli_stmt_close($stmt);
		}
	}

	mysqli_close($link);

}

?>

