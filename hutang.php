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
		<link rel="stylesheet" type="text/css" href="assets/css/table.css" />
		<script src="assets/GoogleNexusWebsiteMenu/js/modernizr.custom.js"></script>
	</head>
	<body>
	<?php
	include 'koneksi_model.php';
	session_start();
	if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
		die("silahkan login <a href='login_page.php'>disini</a>");
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
								<li><a class="gn-icon gn-icon-download" href='hutang.php'>Account Receivable</a></li>
								<li><a class="gn-icon gn-icon-cog" href='order.php'>Purchase Request</a></li>
								<li><a class="gn-icon gn-icon-help" href='produk.php'>Product</a></li>
								<li><a class="gn-icon gn-icon-help" href='supplier.php'>Supplier</a></li>
								<li><a class="gn-icon gn-icon-help"href='acc.php'>Approval</a></li>
								<li><br><br><br><br></li>
								<li><a class="gn-icon gn-icon-cog" href='logout.php'>Logout</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href='mainMenu.php'>Favorit</a></li>
				<li><a><span>Hi <?php echo $hello ?>!</span></a></li>
			</ul>
			<!-- Main Content -->
			<header>
				<h1> <span>Account Recievable</span></h1>	
			</header>
			<div class="head row">
				<div class="col-sm-6 col-md-6 col-xl-6 col-lg-6">		
				</div>
				<div class="col-sm-6 col-md-6 col-xl-6 col-lg-6">
					<form>
         				<button type="submit" formaction="tambah_supplier.php">Tambah Supplier</button>
      				</form>	
				</div>
			</div>
           
			 
			 <table class="table">				
				<thead class="thead-dark">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Supplier</th>
						<th scope="col">Sisa Tagihan</th>
						<th scope="col">Total Tagihan</th>
					</tr>
				</thead> 
		</div><!-- /container -->
		<script src="assets/GoogleNexusWebsiteMenu/js/classie.js"></script>
		<script src="assets/GoogleNexusWebsiteMenu/js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>

</body>
</html>