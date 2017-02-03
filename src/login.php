<?php
session_start();
require_once('credentials.php');

if (isset($_GET['logout'])) {
	session_destroy();
	//unset($_SESSION['user']);
	header('Location: login.php', TRUE, 302);
	exit;
}

if(isset($_SESSION['user']))
{
    header("Location: index.php", TRUE, 302);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Shorten Request Variables if they are set
	$username = isset($_POST['username']) ? trim($_POST['username']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';

	// $valid_user = 'Rudra';
	// $valid_hash = '$2y$10$tvKXv57wFWSeECg2ALkh3uQE.F6z7cSjQT/A.3CzfHIVYQtp2/YFe';

	if (array_key_exists(strtolower($username), $valid_users)) {
		if (password_verify($password, $valid_users[strtolower($username)]['hash'])) {
			$_SESSION['user'] = $valid_users[strtolower($username)]['name'];
			header("Location: index.php", TRUE, 302);
    		exit;
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap.min.css"> -->
</head>
<body>
<center>
	
	<div>
	<h1>Login</h1><br>
	<form action="login.php" method="POST">
		<label>Username: <input type="text" name="username"></label><br>
		<label>Password: <input type="password" name="password"></label><br>
		<input type="submit" value="Login">
	</form>
	</div>
</center>
</body>
</html>

