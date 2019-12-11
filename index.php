<?php
	include('auth.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Start page</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="form">
		<p><?php echo $_SESSION['login']; ?>, это начало</p>
		<a href="info.php">Информация</a></br>
		<a href="logout.php">Выйти</a>
	</div>
</body>
</html>