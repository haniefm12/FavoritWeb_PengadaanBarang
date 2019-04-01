<?php
	
	session_start();

	unset($_SESSION['sukses']);
	unset($_SESSION['username']);
	unset($_SESSION['password']);

	$destroy=session_destroy();
	 if (!$destroy) {
	 	echo "gagal logout";
	 }else{
	 	header("location: login.php");
	 }
?>