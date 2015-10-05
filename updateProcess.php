<?php
	require_once("sessionChk.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>更新結果</title>
</head>
<body>
	<?php
		foreach( $_POST['bookdata'] as $value){
			$sql = "UPDATE book SET title='$value[title]', writer='$value[writer]', price='$value[price]', lastupd=NOW() " .
			"WHERE titleid='$value[titleid]'";
			
			require_once("connect.php");
			
			if (mysqli_query($conn, $sql) === false) {
				echo ("更新に失敗しました: " .  mysqli_error($conn));
				die ("<br />Program Terminated");
			} else {
				echo ("<p>" . $value['title'] . "の更新に成功しました。</p>");
			}
		}
		mysqli_close($conn);
		echo ("<p><a href='index.php'>メニューへ戻る</a></p>");
	?>
</body>
</html>