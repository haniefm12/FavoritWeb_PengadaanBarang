<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Favorit | Supplier</title>
        <link rel="stylesheet" href="assets/bootstrap-4.3.1-dist/css/bootstrap-grid.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<meta name="description" content="A sidebar menu as seen on the Google Nexus 7 website" />
		<meta name="keywords" content="google nexus 7 menu, css transitions, sidebar, side menu, slide out menu" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="assets/GoogleNexusWebsiteMenu/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="assets/GoogleNexusWebsiteMenu/css/style.css" />
		<link rel="stylesheet" type="text/css" href="assets/GoogleNexusWebsiteMenu/css/component.css" />
		<script src="assets/GoogleNexusWebsiteMenu/js/modernizr.custom.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/mainform.css" />
	</head>
	<body>
	<?php
	include 'koneksi_model.php';
	session_start();
	if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
		die("<div style='margin-top:200px'>
			<h1 style='text-align:center;color:red;font-weight:bold'>Kami tidak mengenali anda!</h1>
			<h3 style='text-align:center'>Silahkan login <a href='login_page.php'>disini</a></h3>
			</div>");
	}else
		{
			$sql= "SELECT nama FROM user WHERE username='".$_SESSION["username"]."'";
			$query= mysqli_query($conn,$sql);
			$result= mysqli_fetch_array($query);
			$hello = $result[0];
		}
	if ($_SESSION["username"] != "owner"){
		die("<div style='margin-top:200px'>
			<h1 style='text-align:center;color:red;font-weight:bold'>ANDA TIDAK DI IZINKAN!</h1>
			<h3 style='text-align:center'>Silahkan kembali <a href='supplier.php'>disini</a></h3>
			</div>");
	}
?>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
							<li><a class="gn-icon gn-icon-article" href='request.php'>Purchase Request</a></li>
								<li><a class="gn-icon gn-icon-help"href='acc.php'>Approval</a></li>
								<li><a class="gn-icon gn-icon-article" href='order.php'>Purchase Order</a></li>
								<li><a class="gn-icon gn-icon-download" href='terima.php'>Receiving</a></li>
								<li><a class="gn-icon gn-icon-earth" href='hutang.php'>Account Payable</a></li>
								<li><a class="gn-icon gn-icon-archive" href='supplier.php'>Supplier</a></li>
								<li><a class="gn-icon gn-icon-archive" href='produk.php'>Product</a></li>
								<li class="bawah"><a class="gn-icon gn-icon-cog" href='logout.php'>Logout</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href='mainMenu.php'>Favorit</a></li>
				<li><a><span>Hi <?php echo $hello ?>!</span></a></li>
			</ul>
			<header>
				<h1> <span>Supplier</span></h1>	
			</header> 
			<h2 style="text-align: center">Tambah Supplier</h2>
			<div style="display:block; text-align: center">
				
			<form class="mainform" method="POST" enctype="multipart/form-data">
				<input style="width:386px" placeholder="Nama" type="text" name="nama_supplier" required="">
				<br>
				<input style="width:386px" placeholder="E-mail" type="email" name="email">
				<br>
				<input style="width:386px" type="text" name="telp" placeholder="Nomor Telepon">
				<br>
				<textarea style="width:386px" name="alamat" placeholder="Alamat"></textarea>
				<br>
				<input class="submitbut" type="submit" name="submit" value="Submit">
			</form>
			<br>
			
<?php

	if (isset($_POST['submit'])) {
		include 'koneksi_model.php';

		$nama=$_POST['nama_supplier'];
		$email=$_POST['email'];
		$alamat=$_POST['alamat'];
		$telp=$_POST['telp'];
		$sisa=0;
		

		$sql= "INSERT INTO `suppliers`(`nama_supplier`,`email`,`alamat`,`no_hp`,`sisa_tagihan`)
				VALUES ('$nama','$email','$alamat','$telp','$sisa')";
		mysqli_query($conn,$sql);
		?> 
		<div class="alert">
  		<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  		<strong>Sukses!</strong>
		</div>
<?php
	}
?>
	
			</div>

		</div><!-- /container -->
		<script src="assets/GoogleNexusWebsiteMenu/js/classie.js"></script>
		<script src="assets/GoogleNexusWebsiteMenu/js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>

</body>
</html>