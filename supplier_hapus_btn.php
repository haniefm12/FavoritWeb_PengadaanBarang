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
    
    $sql = "DELETE FROM account_payable WHERE account_payable.id_supplier ='$id'";
    mysqli_query($conn,$sql);

    $sql1 = "SELECT id_item,id_supplier FROM product WHERE id_supplier = '$id' ";
    $query1 =mysqli_query($conn,$sql1);
    
    while ($hsl1= mysqli_fetch_array($query1)){
        $sql1_a= "DELETE FROM purchase_order WHERE purchase_order.id_item='$hsl1[0]'";
        mysqli_query($conn,$sql1_a);
    }

	$sql2= "DELETE FROM product WHERE product.id_supplier='$id'";
    mysqli_query($conn,$sql2);
    
    $sql3= "DELETE FROM suppliers WHERE suppliers.id_supplier='$id'";
    mysqli_query($conn,$sql3);

	header("location: supplier.php");
?>