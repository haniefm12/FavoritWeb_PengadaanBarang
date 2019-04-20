<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Favorit</title>
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
				<h1> <span>Purchase Request</span></h1>	
			</header> 
			<div>
			<div class="row">
			<select style="padding:5px; width:270px" name="request" form="request">
			<option  selected value="">Pilih Product</option>
			<?php 
				$sql_s="SELECT product.id_item,product.nama_item,suppliers.nama_supplier FROM product LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier";
				$query_s= mysqli_query($conn,$sql_s);
				while ($hsl_s = mysqli_fetch_assoc($query_s)){
				?>
				
					<option value=<?php echo $hsl_s['id_item'];?>><?php echo "[".$hsl_s['id_item']."] ".$hsl_s['nama_item']." (".$hsl_s['nama_supplier'].")";?></option>
				
					<?php
					}
					?>
			</select>
			</div>
			<div class="row">
			<form method="POST" enctype="multipart/form-data" id="request">
			<input style="float:left; margin-left: 0; width:270px" type="number" name="qty_demand" placeholder="Jumlah" min="1"><br>
			<input style="float:left; margin-top: 10px" class="submitbut" type="submit" name="Pilih" value="Request">
			</form>
			</div>
			<?php

	if (isset($_POST['Pilih'])) {
		include 'koneksi_model.php';

		$supplier=$_POST['request'];
		$qty=$_POST['qty_demand'];
        
        $sql1="SELECT id_item,nama_item,satuan,harga_satuan FROM product WHERE id_item='".$supplier."'";
		$query1= mysqli_query($conn,$sql1);
		$result1= mysqli_fetch_array($query1);
		$qty_2 = $qty*$result1[3];

		$sql2= "INSERT INTO `purchase_order`(`id_item`,`tgl`,`qty_demand`,`sum_demand`)
				VALUES ('$supplier',now(),'$qty','$qty_2')";
		mysqli_query($conn,$sql2);

		header('Location: request.php');
		?> 
<?php
	}
	?>
			</div>
			<div>
			<br><br>
			<h2> <span> Daftar Purchase Request</span></h2>
			<table class="table">				
				<thead class="thead-dark">
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Product</th>
						<th scope="col">Supplier</th>
						<th scope="col">Jumlah</th>
						<th scope="col">Satuan</th>
						<th scope="col">Harga Satuan</th>
						<th scope="col">Harga Total</th>
					</tr>
				</thead>
			<?php
   
				$sql3= "SELECT purchase_order.id_demand,purchase_order.tgl,product.nama_item,suppliers.nama_supplier,purchase_order.qty_demand,product.satuan,product.harga_satuan,purchase_order.sum_demand FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier WHERE purchase_order.status=0";
				$query3= mysqli_query($conn,$sql3);
  
				while ($hsl3= mysqli_fetch_assoc($query3)){
			?>
			
				<tr>
					<th style="background: white" scope ="row"><?php echo $hsl3['id_demand'];?></th>
					<td style="background: white"><?php echo $hsl3['tgl'];?></td>
					<td style="background: white"><?php echo $hsl3['nama_item'];?></td>
					<td style="background: white"><?php echo $hsl3['nama_supplier'];?></td>
					<td style="background: white"><?php echo $hsl3['qty_demand'];?></td>
					<td style="background: white"><?php echo $hsl3['satuan'];?></td>
					<td style="background: white"><?php echo $hsl3['harga_satuan'];?></td>
					<td style="background: white"><?php echo $hsl3['sum_demand'];?></td>
				</tr>
			<?php		
				}
			?>	
			</table>

			</div>
		</div><!-- /container -->
		<script src="assets/GoogleNexusWebsiteMenu/js/classie.js"></script>
		<script src="assets/GoogleNexusWebsiteMenu/js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
</body>
</html>