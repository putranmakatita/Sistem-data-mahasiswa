<?php 
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}
if(isset($_POST['keluar'])){
	session_destroy();
	$_SESSION = [];
	header('Location: login.php');
	exit;
}
require 'functions.php';
if (isset($_GET['submit'])){
	$data = $_GET['search'];
	$mahasiswa = query("SELECT * FROM Mahasiswa 
		WHERE Nama LIKE '%$data%' OR
		NRP LIKE '%$data%' OR
		Email LIKE '%$data%' OR
		Jurusan LIKE '%$data%'
		");
} else {
	$mahasiswa = query('SELECT * FROM Mahasiswa');
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>CRUD</title>
 </head>
 <body>
 	<h1>Data Mahasiswa</h1>
 	<form action="" method="post"> 
 		<button type="submit" name="keluar">Keluar!</button>
 	</form>
 	<a href="tambah.php">Tambah data</a>
 	<form action="" method="get">
 		<input type="text" name="search" placeholder="cari disini..." autofocus>
 		<button type="submit" name="submit">Search!</button>
 	</form>

 	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<td>Id</td>
			<td>Action</td>
			<td>Nama</td>
			<td>NRP</td>
			<td>Email</td>
			<td>Jurusan</td>
			<td>Gambar</td>
		</tr>
		<?php foreach ($mahasiswa as $data) { ?>
		
		<tr>
			<td><?php echo $data["id"]; ?></td>
			<td> 
				<a href="ubah.php?id=<?= $data['id'] ?>">Update</a>
				<a href="hapus.php?id=<?= $data['id'] ?>">Delete</a>
			</td>
			<td><?php echo $data["Nama"]; ?></td>
			<td><?php echo $data["NRP"]; ?></td>
			<td><?php echo $data["Email"]; ?></td>
			<td><?php echo $data["Jurusan"]; ?></td>
			<td><img src="images/<?= $data['Gambar']; ?>" height="100px"></td>
		</tr>

		<?php } ?>
		
	</table>
 
 </body>
 </html>