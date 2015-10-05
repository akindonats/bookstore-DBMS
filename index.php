<?php
	require_once("sessionChk.php");
	if (isset($_POST['stitle'])) $stitle = $_POST['stitle'];
		else $stitle = "";
	if (isset($_POST['swriter'])) $swriter = $_POST['swriter'];
		else $swriter = "";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>メニュー</title>
	<style type="text/css">
		table,td{ border:1px solid black;}
		td{ text-align:center;padding:4px;}
	</style>
</head>
<body>
	<p>ようこそ <?php echo ($userid); ?>さん：<a href='logout.php'>ログアウト</a></p>
	<form action="index.php" method="post">
		<table bgcolor='#f5f5dc'>
		<tr>
		<td>検索</td>
		<td>タイトル<input type="text" name="stitle" value="<?php echo($stitle); ?>"/></td>
		<td>著者<input type="text" name="swriter" value="<?php echo($swriter); ?>"/></td>
		<td><input type="submit" value="検索" /></td>
		</tr>
		</table>
	</form>
	<?php
		require_once("connect.php");
		if (isset($_POST['stitle']) && isset($_POST['swriter'])){
			$sql = "SELECT * FROM book WHERE title LIKE '%" . $_POST['stitle'] . "%' AND writer LIKE '%" . $_POST['swriter'] . "%'";
		}else if (isset($_POST['stitle'])){
			$sql = "SELECT * FROM book WHERE title LIKE '%" . $_POST['stitle'] . "%'";
		}else if (isset($_POST['swriter'])){
			$sql = "SELECT * FROM book WHERE writer LIKE '%" . $_POST['swriter'] . "%'";
		}else{
			$sql = "SELECT * FROM book";
		}	
		$rs = mysqli_query($conn, $sql);
		
		if ($rs === false) {
			echo ("Failed to execute SELECT: " .  mysqli_error($conn));
			die ("<br />Program Terminated");
		} else {
			echo ("<form action='upd_del.php' method='post'>\n");
			echo ("<table bgcolor='#add8e6'>\n");
			echo ("<tr>");
			echo ("<td>No.</td>");
			echo ("<td>タイトル</td>");
			echo ("<td>著者</td>");
			echo ("<td>価格</td>");
			echo ("<td colspan='2'>更新時刻</td>");
			echo ("<td>選択</td>");
			echo ("</tr>\n");
			$i = '0';
			while ($arr = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
				if ($i % '2' == '0') echo("<tr bgcolor='#f0ffff'>");
					else	echo ("<tr>");
				echo ("<td>" . $arr['titleid']. "</td>");
				echo ("<td>" . $arr['title']. "</td>");
				echo ("<td>" . $arr['writer']. "</td>");
				echo ("<td>" . $arr['price']. "円 </td>");
				echo ("<td colspan='2'>" . $arr['lastupd']. "</td>");
				echo ("<td colspan='1'><input type='checkbox' name='checkedid[]' value=" . $arr['titleid'] . "></td>");
				echo ("</tr>\n");
				$i++;
			}
			mysqli_free_result($rs);
			echo ("<tr><td>操作</td>");
			echo ("<td colspan='3'></td>");
			echo ("<td><input type='radio' name='mode' value='update' checked>更新</td>");
			echo ("<td><input type='radio' name='mode' value='delete'>削除</td>\n");
			echo ("<td><input type='submit' value='実行' ></td></tr>\n");
			echo ("<tr><td colspan='6'></td>");
			echo ("<td colspan='1'><a href='insert.php'>追加</a></td></tr>\n");
			echo ("</table>\n");
			echo ("</form>");
		}
		mysqli_close($conn);
	?>
</body>
</html>