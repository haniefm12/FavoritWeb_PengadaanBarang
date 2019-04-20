<?php

include 'koneksi_model.php';
session_start();
if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
    die("silahkan login <a href='login_page.php'>disini</a>");
	}

	$id=$_GET['id'];

	$sql= "UPDATE purchase_order SET purchase_order.status=purchase_order.status+1 WHERE purchase_order.id_demand='$id'";
	$query= mysqli_query($conn,$sql);

	$sql1 = "SELECT purchase_order.id_demand,suppliers.id_supplier,purchase_order.sum_demand FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier WHERE purchase_order.id_demand='$id'";
	$query1= mysqli_query($conn,$sql1);
	$result1= mysqli_fetch_array($query1);

	$sql2= "INSERT INTO  `account_payable` (`tanggal`, `id_debts`, `id_demand`, `id_supplier`, `total_tagihan`, `sisa_tagihan`, `paid`) 
	VALUES (now(), NULL, $result1[0], $result1[1], $result1[2], $result1[2], '0')";
	mysqli_query($conn,$sql2);

	$sql3 = "UPDATE suppliers SET suppliers.sisa_tagihan = suppliers.sisa_tagihan+'$result1[2]' WHERE suppliers.id_supplier ='$result1[1]'";
	mysqli_query($conn,$sql3);

	$sql4 = "SELECT id_item,qty_demand FROM purchase_order WHERE id_demand='$id'";
	$query4= mysqli_query($conn,$sql4);
	$result4= mysqli_fetch_array($query4);

	$sql5 = "UPDATE product SET product.jumlah_item = product.jumlah_item + '$result4[1]' WHERE product.id_item = '$result4[0]' ";
	mysqli_query($conn,$sql5);

	header("location: acc.php");
?>