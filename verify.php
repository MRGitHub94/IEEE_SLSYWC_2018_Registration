<?php
	function redirect() {
		header('Location: already_verified');
		exit();
	}

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	} else {
		$con = new mysqli('localhost:3306', 'svsl_mano', 'MR100%pro', 'svsl_ieeeSLSYWC');

		$email = $con->real_escape_string($_GET['email']);
		$token = $con->real_escape_string($_GET['token']);

		$sql = $con->query("SELECT id FROM delegates WHERE email='$email' AND token='$token' AND isEmailConfirmed=0");

		if ($sql->num_rows > 0) {
			$con->query("UPDATE delegates SET isEmailConfirmed=1, token='' WHERE email='$email'");
			header('Location: verified');
		} else
			redirect();
	}
?>