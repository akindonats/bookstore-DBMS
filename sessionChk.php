<?php
	session_start();
	if (isset($_SESSION['userid'])) {
		$userid = $_SESSION['userid'];
	} else {
		header("Location: login.php");
		exit;
	}
?>