<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Favorit | Product</title>
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
				<h3 style='text-align:center'>Silahkan kembali <a href='produk.php'>disini</a></h3>
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
							<li><a class="gn-icon gn-icon-cog" href='request.php'>Purchase Request</a></li>
								<li><a class="gn-icon gn-icon-help"href='acc.php'>Approval</a></li>
								<li><a class="gn-icon gn-icon-cog" href='order.php'>Purchase Order</a></li>
								<li><a class="gn-icon gn-icon-download" href='hutang.php'>Account Payable</a></li>
								<li><a class="gn-icon gn-icon-help" href='supplier.php'>Supplier</a></li>
								<li><a class="gn-icon gn-icon-help" href='produk.php'>Product</a></li>
								<li class="bawah"><a class="gn-icon gn-icon-cog" href='logout.php'>Logout</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href='mainMenu.php'>Favorit</a></li>
				<li><a><span>Hi <?php echo $hello ?>!</span></a></li>
			</ul>
			<header>
				<h1> <span>Product</span></h1>	
			</header> 
			<h2 style="text-align: center">Tambah Product</h2>
			<div style="display:block; text-align: center">
				
            <form class="mainform" method="POST" enctype="multipart/form-data">
                <div class="row">
                <div class="col-lg-6" style="padding:0"><input style="width:270px;float:right" list="suppliers" autocomplete="off" placeholder="Supplier" name="supplier" required=""></div>
			    <datalist id="suppliers">	
			    <?php 
				    $sql_s="SELECT id_supplier,nama_supplier FROM suppliers";
				    $query_s= mysqli_query($conn,$sql_s);
				    while ($hsl_s = mysqli_fetch_assoc($query_s)){
				?>
				
					<option value=<?php echo $hsl_s['nama_supplier'];?>>
				
				<?php
				}
				?>
				</datalist>
                <div class="col-lg-6" style="padding:0"><input style="width:270px;float:left"placeholder="Nama item" type="text" name="nama_item" required=""></div>
                </div>
                <div class="row">
                <div class="col-lg-6" style="padding:0"><input style="width:270px;float:right" list="satuan"  placeholder="Satuan" name="satuan" required=""></div>
                <datalist id="satuan">
                    <option value="Lembar">
                    <option value="Rim">
                    <option value="Box">
                    <option value="Lusin">
                    <option value="Buah">
                </datalist>
				<div class="col-lg-6" style="padding:0"><input style="width:270px;float:left" type="number" name="harga_satuan" placeholder="Harga Satuan (Rp)"></div>
				<br>
				<input class="submitbut" type="submit" name="submit" value="Submit">
				</div>
			</form>
			<br>
			
<?php

	if (isset($_POST['submit'])) {
		include 'koneksi_model.php';

		$supplier=$_POST['supplier'];
		$produk=$_POST['nama_item'];
		$satuan=$_POST['satuan'];
		$harga=$_POST['harga_satuan'];
        $jumlah=0;
        
        $sql1="SELECT id_supplier FROM suppliers WHERE nama_supplier='".$supplier."'";
		$query1= mysqli_query($conn,$sql1);
		$result1= mysqli_fetch_array($query1);
		$n_supplier = $result1[0];

		$sql2= "INSERT INTO `product`(`id_supplier`,`nama_item`,`jumlah_item`,`satuan`,`harga_satuan`)
				VALUES ('$n_supplier','$produk','$jumlah','$satuan','$harga')";
		mysqli_query($conn,$sql2);
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