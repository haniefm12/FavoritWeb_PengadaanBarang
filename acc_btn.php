<?php

include 'koneksi_model.php';
session_start();
if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
    die("silahkan login <a href='login_page.php'>disini</a>");
	}

	$id=$_GET['id'];

	$sql= "DELETE FROM purchase_order WHERE purchase_order.id_demand='$id";
	$query= mysqli_query($conn,$sql);
	header("location: acc.php");
?>