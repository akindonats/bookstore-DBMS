<?php
	require_once("sessionChk.php");
	
	if (isset($_GET['datanum'])) $datanum = $_GET['datanum'];
		else $datanum = '1';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>データ追加フォーラム</title>
</head>
<body>
	<form action='insertProcess.php' method='post'>
		<table>
		<tr>
		<td>タイトル</td>
		<td>著者</td>
		<td>価格</td>
		</tr>
		<?php
		for ($i = '0'; $i < $datanum; $i++) {
			echo ("<tr>");
			echo ("<td><input type='text' name='bookdata[".$i."][title]' /></td>");
			echo ("<td><input type='text' name='bookdata[".$i."][writer]' /></td>");
			echo ("<td><input type='text' name='bookdata[".$i."][price]' /></td>");
			echo ("</tr>\n");
		}
		?>
		</table>
		<input type='submit' value='保存' />
		<a href='index.php'>メニューへ戻る</a>
	</form>
	<form action='insert.php' method='get'>
		<p>複数のデータを追加したい場合はデータ数を指定して変更ボタンを押してください</p>
		<select name="datanum">
			<option value="1" selected>1</option>
			<?php
			for ($i = '2'; $i <= '10'; $i++) {
				echo ("<option value='" . $i . "'>" . $i . "</option>");
			}
			?>
		</select>
		<input type='submit' value='変更' />
	</form>
</body>
</html>