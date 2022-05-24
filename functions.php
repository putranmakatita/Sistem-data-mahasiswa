<?php 

$connection = mysqli_connect("localhost", "root", "", "phpcukupdasar");

function query($query){
	global $connection;
	$result = mysqli_query($connection, $query);
	$rows = [];
	while ($data = mysqli_fetch_assoc($result)){
		$rows[] = $data;
	}

	return $rows;
}

function show($query){
	global $connection;
	$result = mysqli_query($connection, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

function tambah($data){
		global $connection;
		$nama = htmlspecialchars($data['nama']);
		$nrp = htmlspecialchars($data['nrp']);
		$email = htmlspecialchars($data['email']);
		$jurusan = htmlspecialchars($data['jurusan']);
		$gambar = upload();

		if (!$gambar){
			return false;
		}
		
		$query = "INSERT INTO mahasiswa VALUES('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
		mysqli_query($connection, $query);
		return mysqli_affected_rows($connection);
}

function hapus($data){
	global $connection;
	mysqli_query($connection, "DELETE FROM Mahasiswa WHERE id= $data");
	return mysqli_affected_rows($connection);
}

function ubah($data, $id){
	global $connection;
	$nama = htmlspecialchars($data['nama']);
	$nrp = htmlspecialchars($data['nrp']);
	$email = htmlspecialchars($data['email']);
	$jurusan = htmlspecialchars($data['jurusan']);
	if ($_FILES['gambar']['error'] === 4){
		$gambar = htmlspecialchars($data['gambarLama']);
	}elseif ($_FILES['gambar']['error'] === 0) {
		$gambar = upload();
	}
		

	$query = "UPDATE mahasiswa SET `Nama` = '$nama', `NRP` = '$nrp', `Email` = '$email' , `Gambar` = '$gambar' , `Jurusan` = '$jurusan' WHERE `mahasiswa`.`id` = '$id'";
	mysqli_query($connection, $query);
	return mysqli_affected_rows($connection);
}

function upload(){
	$namaGambar = $_FILES['gambar']['name'];
	$ukuranGambar = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpGambar = $_FILES['gambar']['tmp_name'];

	if ($error === 4){
		echo "
		<script>
			alert('Silahkan isi dulu file gambar!');
		</script>";
		return false;
	}
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaGambar);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "
		<script>
			alert('File yang dikirimkan bukan gambar!');
		</script>";
		return false;
	}

	// if ($ukuranGambar > 1000000){
	// 	echo "
	// 	<script>
	// 		alert('Ukuran file terlalu besar!');
	// 	</script>";
	// 	return false;
	// }
	$namaFileBaru = uniqid();
	$namaFileBaru .= ".";
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpGambar, 'images/'. $namaFileBaru);
	return $namaFileBaru;
}

function registrasi($data){
	global $connection;
	$username = strtolower(stripslashes($data['username']));
	$password = mysqli_real_escape_string($connection, $data['password']);
	$konfirmasiPassword = mysqli_real_escape_string($connection, $data['konfirmasiPassword']);
	$userTersedia = mysqli_query($connection, 
		"SELECT username FROM users WHERE username = '$username'");
	if(mysqli_fetch_assoc($userTersedia)){
		echo "
			<script>
				alert('Username sudah ada!');
			</script>
		";
		return false;
	}

	if ($password != $konfirmasiPassword){
		echo "
			<script>
				alert('Konfrimasi Password tidak sesuai!');
			</script>
		";
		return false;
	}



	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO users VALUES('','$username', '$password')";
	mysqli_query($connection, $query);

	return mysqli_affected_rows($connection);

}

 ?>
