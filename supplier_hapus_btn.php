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
			<h3 style='text-align:center'>Silahkan kembali <a href='supplier.php'>disini</a></h3>
			</div>");
	}

    $id=$_GET['id'];
    

    
    $sql3= "DELETE FROM suppliers WHERE suppliers.id_supplier='$id'";
    mysqli_query($conn,$sql3);

	header("location: supplier.php");
?>