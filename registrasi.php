<?php 

require "functions.php";

if (isset($_POST['registrasi'])){
	if(registrasi($_POST) > 0){
		echo "
		 <script>
		 	alert('berhasil registrasi!')
		 </script>
		 ";
	}else{
		echo "
		 <script>
		 	alert('gagal registrasi!')
		 </script>
		 ";
	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrasi Akun</title>
	<style type="text/css">
		label {
			display: block;
		}
	</style>
</head>
<body>
	<h1>Registrasi Akun</h1>
	
	<ul>
		<form action="" method="post">
			<li>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" autofocus required>	
			</li>
			<li>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required>				
			</li>
			<li>
				<label for="konfirmasiPassword">Konfirmasi Password</label>
				<input type="password" name="konfirmasiPassword" id="konfirmasiPassword" required>
			</li>
			<li>
				<button type="submit" name="registrasi">Registrasi!</button>
			</li>
		</form>		
	</ul>
</body>
</html>