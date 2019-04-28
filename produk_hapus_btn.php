<?php

include 'koneksi_model.php';
session_start();
if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
    die("<div style='margin-top:200px'>
            <h1 style='text-align:center;color:red;font-weight:bold'>Kami tidak mengenali anda!</h1>
            <h3 style='text-align:center'>Silahkan login <a href='login_page.php'>disini</a></h3>
            </div>");
    }
    if ($_SESSION["username"] != "owner"){
        die("<div style='margin-top:200px'>
            <h1 style='text-align:center;color:red;font-weight:bold'>ANDA TIDAK DI IZINKAN!</h1>
            <h3 style='text-align:center'>Silahkan kembali <a href='produk.php'>disini</a></h3>
            </div>");
    }

    $id=$_GET['id'];
    

    
    $sql2= "DELETE FROM product WHERE product.id_item='$id'";
    mysqli_query($conn,$sql2);

	header("location: produk.php");
?>