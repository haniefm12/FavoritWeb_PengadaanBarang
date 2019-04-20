<?php

include 'koneksi_model.php';
session_start();
if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
    die("<div style='margin-top:200px'>
            <h1 style='text-align:center;color:red;font-weight:bold'>Kami tidak mengenali anda!</h1>
            <h3 style='text-align:center'>Silahkan login <a href='login_page.php'>disini</a></h3>
            </div>");
	}

    $id=$_GET['id'];
    
    $sql = "SELECT id_demand,id_item FROM purchase_order WHERE id_item = '$id' ";
    $query1 =mysqli_query($conn,$sql);
    
    while ($hsl= mysqli_fetch_array($query)){
        $sql_a= "DELETE FROM account_payable WHERE account_payable.id_demand='$hsl[0]'";
        mysqli_query($conn,$sql_a);
    }

	$sql1= "DELETE FROM purchase_order WHERE purchase_order.id_item='$id'";
    mysqli_query($conn,$sql1);
    
    $sql2= "DELETE FROM product WHERE product.id_item='$id'";
    mysqli_query($conn,$sql2);

	header("location: produk.php");
?>