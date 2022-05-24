<?php 
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}
require "functions.php";

if (isset($_POST['submit'])){
		if (tambah($_POST) > 0){
			echo "
			<script>
				alert('Sukses!');
				document.location.href = 'CRUD.php';
			</script>
			";
	}else{
		echo "
		<script>
			alert('gagal!');
			document.location.href = 'CRUD.php';
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
	<title>Tambah data Mahasiswa</title>
</head>
<body>
	<h1>Tambah Data Mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nama">Nama</label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="nrp">NRP</label>
				<input type="text" name="nrp" id="nrp" required>
			</li>
			<li>
				<label for="email">email</label>
				<input type="text" name="email" id="email" required>
			</li>
			<li>
				<label for="jurusan">Jurusan</label>
				<input type="text" name="jurusan" id="jurusan" required>
			</li>
			<li>
				<label for="gambar">Gambar</label>
				<input type="file" name="gambar" id="gambar" required>
			</li>
			
			<li>
				<button type="submit" name="submit">Tambahkan!</button>
			</li>
		</ul>
	</form>
</body>
</html>