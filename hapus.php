<?php 
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}
require 'functions.php';

$id = $_GET['id'];

if (hapus($id) > 0){
	echo "
	<script type='text/javascript'>
	 	alert('Data sukses dihapus!');
	 	document.location.href = 'view.php';
	</script>
	";
}else{
	echo "
	<script>
	 	alert('Data gagal dihapus!');
	 	document.location.href = 'view.php';
 	</script>
 	";
}

 ?>

