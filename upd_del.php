<?php
	require_once("sessionChk.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>操作結果</title>
</head>
<body>
	<?php
		if (isset($_POST['checkedid'])){
			$mode = $_REQUEST['mode'];
			$where = "WHERE ";
			$i = "0";
			$frag = false;
			foreach( $_POST['checkedid'] as $value ){
				if ($frag == false){
					$frag = true;
				}else{
					$where .= " OR ";
				}
				$where .= "titleid = " . $value ;
			}
			if ($mode == 'delete'){
				
				require_once("connect.php");
				$sql = "SELECT * FROM book ";
				$sql .= $where;
				$rs = mysqli_query($conn, $sql);
				
				if($rs === false){
					echo("データの読み込みに失敗しました:" . mysqli_error($conn));
					die("<br />Program Terminated");
				}else{
					$arr = mysqli_fetch_array($rs, MYSQLI_ASSOC);
				}
				$sql = "DELETE FROM book ";
				$sql .= $where;
				
				if (mysqli_query($conn, $sql) === false) {
					echo ("削除に失敗しました。: " .  mysqli_error($conn));
					die ("<br />Program Terminated");
				} else {
					printf ("<p>変更された項目数: %d</p>\n", mysqli_affected_rows($conn));
					echo ("<p>削除に成功しました。</p>");
				}
				echo ("<p><a href='index.php'>メニューへ戻る</a></p>");
			}
			if ($mode == 'update'){
				
				require_once("connect.php");
				$sql = "SELECT * FROM book ";
				$sql .= $where;
				$rs = mysqli_query($conn, $sql);
				
				if ($rs === false) {
					echo ("Failed to execute SELECT: " .  mysqli_error($conn));
					die ("<br />Program Terminated");
				}
				echo ("<form action='updateProcess.php' method='post'>");
					echo ("<table>\n");
					echo ("<tr>");
					echo ("<td>No.</td>");
					echo ("<td>タイトル</td>");
					echo ("<td>著者</td>");
					echo ("<td>価格</td>");
					echo ("</tr>\n");
					while ($arr = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
						echo ("<tr>");
						echo ("<td><input type='hidden' name='bookdata[".$i."][titleid]' value=" . $arr['titleid'] . " />" . $arr['titleid'] . "</td>");
						echo ("<td><input type='text' name='bookdata[".$i."][title]' value=" . $arr['title'] . " /></td>");
						echo ("<td><input type='text' name='bookdata[".$i."][writer]' value=" . $arr['writer'] . " /></td>");
						echo ("<td><input type='text' name='bookdata[".$i."][price]' value=" . $arr['price'] . " /></td>");
						echo ("</tr>\n");
						$i++;
					}
					mysqli_free_result($rs);
					echo ("</table>\n");
					echo ("<input type='submit' value='保存' />");
					echo ("<a href='index.php'>メニューへ戻る</a>");
				echo ("</form>");
			}
			mysqli_close($conn);
		}else{
			echo("<p class='error'>変更したいデータにチェックを入れてください。</p>");
			echo ("<a href='index.php'>メニューへ戻る</a>");
		}
	?>
</body>
</html>