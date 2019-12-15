<?php
	require('db.php');
	session_start();
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$login = $_POST['login'];
		$pasw = $_POST['pasw'];
		$pasw_r = $_POST['pasw_r'];
		
		if (!preg_match('/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-z]{2,6}$/', $email))
			die("Введен некорректный email,  <a href='reg.html'>заригистрироваться заново</a>");
		if (!preg_match('/^(\+){1}([0-9]{11})$/', $phone))
			die("Введен некорректный телефон,  <a href='reg.html'>заригистрироваться заново</a>");
		if (!preg_match('/^([a-zA-Z]{1})([a-zA-Z0-9_]{5,})$/', $login))
			die("Введен некорректный логин");
		if ($pasw != $pasw_r)
			die("Пароли не совпадают,  <a href='reg.html'>заригистрироваться заново</a>");

		$query = "
			SELECT * 
			FROM users
			WHERE
				email = '$email' OR
				phone = '$phone' OR
				login = '$login'
		";
		$result = mysqli_query($conn, $query) or die(mysql_errno());
		if (mysqli_num_rows($result) == 0) {
			$query = "
				INSERT INTO users (email, login, phone, pass)
				VALUES ('$email', '$login', '$phone', '".md5($pasw)."')
			";
			$result = mysqli_query($conn, $query);
			if($result) {
				echo "Вы успешно зарегистрировались, <a href='login.html'>войдите</a></div>";
			}
		} else {
			die("Данный пользователь уже существует,  <a href='reg.html'>заригистрироваться заново</a>");
		}
	}
?>
