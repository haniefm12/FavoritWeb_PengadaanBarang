<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Favorit | Purchase Order</title>
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
				<li><a href="password.php"><span>Hi <?php echo $hello ?>!</span></a></li>
			</ul>
			<header>
				<h1> <span>Receiving</span></h1>
			</header>
			<div>
			<table class="table">
                <?php
   $id=$_GET['id'];
   $sql3= "SELECT purchase_order.id_demand,purchase_order.tgl,product.nama_item,suppliers.nama_supplier,purchase_order.qty_demand,product.satuan,product.harga_satuan,purchase_order.sum_demand FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier WHERE purchase_order.id_demand='$id'";
   $query3= mysqli_query($conn,$sql3);
   $hsl3= mysqli_fetch_assoc($query3);
?>
					<tr>
                        <th scope="col">Id</th> <th>:</th><th><?php echo $hsl3['id_demand'];?> </th>
                    </tr>
                    <tr>
                        <th scope="col">Tanggal</th><th>:</th><th><?php echo $hsl3['tgl'];?> </th>
                    </tr>
                    <tr>
                        <th scope="col">Product</th><th>:</th><th><?php echo $hsl3['nama_item'];?> </th>
                    </tr>
                    <tr>
                        <th scope="col">Supplier</th><th>:</th><th><?php echo $hsl3['nama_supplier'];?> </th>
                    </tr>
                    <tr>
                        <th scope="col">Jumlah</th><th>:</th><th><?php echo $hsl3['qty_demand']." ".$hsl3['satuan'];?> </th>
                        </tr>
                        <tr>
                        <th scope="col">Jumlah Diterima</th><th>:</th><th><form method="POST" enctype="multipart/form-data" id="terima">
                        <input style="float:left; margin-left: 0; height:25px; width:75px" type="number" name="qty_ret" placeholder="" min="0"><?php echo $hsl3['satuan'];?></th>
                    </tr>
            </table>
            <input style="float:left; margin-top: 10px" class="submitbut" type="submit" name="terima" value="Diterima"></form>
        <?php
	if (isset($_POST['terima'])) {
		include 'koneksi_model.php';
        $diterima=$_POST['qty_ret'];

        $sql4 ="SELECT purchase_order.qty_demand,purchase_order.qty_ret,product.harga_satuan FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item WHERE purchase_order.id_demand='$id' ";
        $query4= mysqli_query($conn,$sql4);
        $hsl4= mysqli_fetch_assoc($query4);

        $retur = $hsl4['qty_demand']-$diterima;
        $r_price=$hsl4['harga_satuan']*$retur;

        $sql5 = "UPDATE purchase_order SET purchase_order.qty_ret=purchase_order.qty_ret+$retur, purchase_order.ret_stat=purchase_order.ret_stat+1 WHERE purchase_order.id_demand='$id' ";
        mysqli_query($conn,$sql5);

	    $sql6 = "SELECT purchase_order.id_demand,suppliers.id_supplier,purchase_order.sum_demand FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier WHERE purchase_order.id_demand='$id'";
	    $query6= mysqli_query($conn,$sql6);

	    $result1= mysqli_fetch_array($query6);
        $sisa= $result1[2]-$r_price;
	    $sql7= "INSERT INTO  `account_payable` (`tanggal`, `id_debts`, `id_demand`, `id_supplier`, `total_tagihan`, `sisa_tagihan`, `paid`)
	    VALUES (now(), NULL, $result1[0], $result1[1], $result1[2], $sisa, '0')";
	    mysqli_query($conn,$sql7);

	    $sql8 = "UPDATE suppliers SET suppliers.sisa_tagihan = suppliers.sisa_tagihan+$sisa WHERE suppliers.id_supplier ='$result1[1]'";
	    mysqli_query($conn,$sql8);

	    $sql9 = "SELECT id_item,qty_demand FROM purchase_order WHERE id_demand='$id'";
	    $query9= mysqli_query($conn,$sql9);
	    $result9= mysqli_fetch_array($query9);

	    $sql10 = "UPDATE product SET product.jumlah_item = product.jumlah_item + $diterima WHERE product.id_item = '$result9[0]' ";
	    mysqli_query($conn,$sql10);

        header('Location: terima.php') ;
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