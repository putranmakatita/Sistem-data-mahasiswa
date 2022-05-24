<?php 
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}
require 'functions.php';

$id = $_GET['id'];
$mahasiswa = show("SELECT * FROM mahasiswa WHERE `mahasiswa`.`id` ='$id'");
if (isset($_POST['submit'])){
	if (ubah($_POST, $id)){
		echo "
	<script type='text/javascript'>
	 	alert('Data sukses diubah!');
	 	document.location.href = 'view.php';
	</script>
	";
	}else{
		echo "
		<script>
		 	alert('Data gagal diubah!');
		 	document.location.href = 'view.php';
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
	<title>Ubah data Mahasiswa</title>
</head>
<body>
	<h1>Ubah Data Mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="gambarLama" value="<?php echo $mahasiswa["Gambar"]; ?>">
		<ul>
			<li>
				<label for="nama">Nama</label>
				<input type="text" name="nama" id="nama"  value="<?php echo $mahasiswa["Nama"]; ?>">

			</li>
			<li>
				<label for="nrp">NRP</label>
				<input type="text" name="nrp" id="nrp" value="<?php echo $mahasiswa["NRP"]; ?>">

			</li>
			<li>
				<label for="email">email</label>
				<input type="text" name="email" id="email" value="<?php echo $mahasiswa["Email"]; ?>">

			</li>
			<li>
				<label for="jurusan">Jurusan</label>
				<input type="text" name="jurusan" id="jurusan" value="<?php echo $mahasiswa["Jurusan"]; ?>">

			</li>
			<li>
				<label for="gambar">Gambar</label><br>
				<img src="images/<?php echo $mahasiswa["Gambar"]; ?>" width="45"><br>
				<input type="file" name="gambar" id= "gambar" >

			</li>
			
			<li>
				<button type="submit" name="submit">Ubah!</button>
			</li>
		</ul>
	</form>
</body>
</html>
