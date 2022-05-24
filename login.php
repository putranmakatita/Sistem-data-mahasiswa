<?php 

require 'functions.php';
session_start();
if(isset($_SESSION['login'])){
	header('Location: CRUD.php');
	exit;
}

if (isset($_POST["login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$query = "SELECT * FROM users WHERE Username = '$username'";
	$result = mysqli_query($connection, $query);
	if (mysqli_num_rows($result)){
		$rows = mysqli_fetch_assoc($result);
		if(password_verify($password, $rows['Password'])){
			$_SESSION['login'] = true;
			header('Location: CRUD.php');
			exit;
		}
	}

	$error = true;
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Login sistem!
 	</title>
 </head>
 <body>
 	<h1>Login duls!</h1>
 	<?php if (isset($error)){ ?>
 		<p style="color: red; font-style:italic; font-weight: bold;">Username / Password anda salah!</p>
 	<?php } ?>
 	<form action="" method="post">
 		<ul>
 			<li>
 				<label for="username">Username</label>
 				<input type="text" name="username" id="username">
 			</li>
 			<li>
 				<label for="password">Password</label>
 				<input type="password" name="password" id="password">
 			</li>
 			<li>
 				<button type="submit" name="login">Login!</button>
 			</li>
 		</ul>
 	</form>
 </body>
 </html>