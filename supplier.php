<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Favorit</title>
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
		<link rel="stylesheet" type="text/css" href="assets/css/table.css" />
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
	?>
		<div class="container">
			<ul id="gn-menu" style="z-index:99" class="gn-menu-main">
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
						</div>
						<!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href='mainMenu.php'>Favorit</a></li>
				<li><a><span>Hi <?php echo $hello ?>!</span></a></li>
			</ul>

			<!-- Main Content -->
			<header>
				<h1> <span>Supplier</span></h1>	
			</header>
			<?php 
				$sql1= "SELECT sisa_tagihan FROM suppliers";
				$query1 = mysqli_query($conn,$sql1);
				$sisa = 0;
				while($hsl1=mysqli_fetch_assoc($query1)){
					$sisa = $sisa + $hsl1['sisa_tagihan'];
				}
			?>
			<div class="head row">
        			
				<div style="z-index:1"class="col-sm-6 col-md-6 col-xl-6 col-lg-6">
					<form>
         				<button class="tambahBut" style="float:left" type="submit" formaction="tambah_supplier.php">Tambah Supplier</button>
					  </form>	
					  <form>
         				<button class="tambahBut" style="float:left"type="submit" formaction="">Cetak</button>
      				</form>	
				</div>

				<div class="col-sm-6 col-md-6 col-xl-6 col-lg-6">		
					<p style="margin-bottom: 5px;"class="card-text">Sisa Tagihan Keseluruhan :  Rp <?php echo $sisa.",00" ?> </p>
				</div>
			</div>
           
			 
			 <table class="table">				
				<thead class="thead-dark">
					<tr>
						<th scope="col">Nama Supplier</th>
						<th scope="col">e-Mail</th>
						<th scope="col">Alamat</th>
						<th scope="col">Nomor Telepon</th>
						<th scope="col">Sisa Tagihan</th>
						<th> </th>
					</tr>
				</thead>
			<?php
   
    			$sql= "SELECT * FROM suppliers";
				$query= mysqli_query($conn,$sql);
   
				while ($hsl= mysqli_fetch_assoc($query)){
			?>
			
				<tr>
	    			<th style="background: white" scope ="row"><?php echo $hsl['nama_supplier'];?></th>
					<td style="background: white"><?php echo $hsl['email'];?></td>
					<td style="background: white"><?php echo $hsl['alamat'];?></td>
					<td style="background: white"><?php echo "(+62) ".$hsl['no_hp'];?></td>
					<td style="background: white"><?php echo "Rp ".$hsl['sisa_tagihan'];?></td>
					<td style="background: white"> <?php echo"<button class='actButtonNo'><a class='actText' href='supplier_hapus_btn.php?id=$hsl[id_supplier]'>Hapus</a></button>";?></td>
				</tr>
			<?php		
				}
			?>	
			</table>
			<br>
			<br>
			
			 
		
		</div><!-- /container -->
		<script src="assets/GoogleNexusWebsiteMenu/js/classie.js"></script>
		<script src="assets/GoogleNexusWebsiteMenu/js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>

</body>
</html>