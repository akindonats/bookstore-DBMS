<?php
	session_start();
	require_once("connect.php");
	if(isset($_POST['userid'])&&isset($_POST['passwd'])){
		$sql = "SELECT * FROM users";
		$rs = mysqli_query($conn, $sql);
		while ($arr = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
			if($_POST['userid'] == $arr['userid'] && $_POST['passwd'] == $arr['passwd']){
				$_SESSION['userid'] = $arr['userid'];
				header("Location:index.php");
				exit;
			}
		}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
</head>
<body>
	<form action="login.php" method="post">
		<?php
			if (isset($_POST['userid']))
				echo("<p class='error'>ユーザーIDかパスワードが間違っています</p>");
			else
				echo("<p>ログインしてください</p>");
		?>
		<table>
			<tr><td>UserID:</td>
				<td><input type="text" name="userid" maxlength="10" /></td></tr>
			<tr><td>Password:</td>
				<td><input type="password" name="passwd" maxlength="10" /></td></tr>
			<tr><td><input type="submit" value="Login" /></td>
				<td><input type="reset" value="Clear" /></td></tr>
		</table>
	</form>
</body>
</html>