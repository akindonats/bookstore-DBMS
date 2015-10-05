<?php
	require_once("sessionChk.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>データ追加結果</title>
</head>
<body>
	<?php
		require_once("connect.php");
		foreach( $_POST['bookdata'] as $value){
			$flag = false;
			$sql = "SELECT * FROM book";
			$rs = mysqli_query($conn, $sql);
			while ($arr = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
				if($arr['title'] == $value['title'] && $arr['writer'] == $value['writer']) $flag = true;
			}
			mysqli_free_result($rs);
			if($flag == true){
				echo ("<p>" . $value['writer'] . "の" . $value['title'] . "はすでに登録されています。</p>");
			} else {
				$lastupd = $arr['lastupd'];
				$sql = "INSERT INTO book (title, writer, price, lastupd) " .
						"VALUES ('$value[title]', '$value[writer]', '$value[price]', NOW())";
				
				if (mysqli_query($conn, $sql) === false) {
					echo ("追加に失敗しました。: " .  mysqli_error($conn));
					die ("<br />Program Terminated");
				} else {
					echo ("<p>" . $value['title'] . "をデータベースに追加しました。</p>");
				}
			}
		}
		mysqli_close($conn);
		echo ("<p><a href='insert.php'>続けて追加</a></p>");
		echo ("<p><a href='index.php'>メニューへ戻る</a></p>");
	?>
</body>
</html>