<?php
	define ("HOSTNAME", "localhost");
	define ("USERNAME", "root");
	define ("PASSWORD", "");
	define ("DB_NAME", "bookshop");
	
	$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
	
	if (mysqli_connect_errno()) {
		echo ("接続に失敗しました。: " .  mysqli_connect_error());
		die ("<br />Program Terminated");
	} else {
		mysqli_set_charset($conn, "utf8");
	}
?>