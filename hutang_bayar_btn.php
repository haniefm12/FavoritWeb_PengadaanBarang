<?php

include 'koneksi_model.php';
session_start();
if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
    die("silahkan login <a href='login_page.php'>disini</a>");
	}

    $id=$_GET['id'];

    $sql4= "SELECT id_supplier,sisa_tagihan FROM account_payable WHERE id_demand='$id' ";
    $query4= mysqli_query($conn,$sql4);
    $result4= mysqli_fetch_array($query4);

    $sql3 = "UPDATE suppliers SET suppliers.sisa_tagihan = suppliers.sisa_tagihan-'$result4[1]' WHERE suppliers.id_supplier ='$result4[0]'";
	mysqli_query($conn,$sql3);

	$sql= "UPDATE account_payable SET account_payable.sisa_tagihan = account_payable.sisa_tagihan - account_payable.sisa_tagihan, account_payable.paid = account_payable.paid + 1  WHERE account_payable.id_demand='$id'";
    mysqli_query($conn,$sql);

	header("location: hutang.php");
?>