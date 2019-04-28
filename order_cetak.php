
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="assets/css/table.css" />
<?php
	include 'koneksi_model.php';
	session_start();
	if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
		die("<div style='margin-top:200px'>
			<h1 style='text-align:center;color:red;font-weight:bold'>Kami tidak mengenali anda!</h1>
			<h3 style='text-align:center'>Silahkan login <a href='login_page.php'>disini</a></h3>
            </div>");
        }
    echo "<br><br>";
    echo "<br><br>Gudang FAVORIT <br>";
    echo "<center>LAPORAN PURCHASE ORDER</center>";
?>
<br>
<br>

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
            <th scope="col">Diterima</th>
        </tr>
    </thead>
<?php

    $sql3= "SELECT purchase_order.id_demand,purchase_order.tgl,purchase_order.ret_stat,product.nama_item,suppliers.nama_supplier,purchase_order.qty_demand,product.satuan,product.harga_satuan,purchase_order.sum_demand FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier WHERE purchase_order.status=1";
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
        <td style="background: white"><?php echo "Rp ".number_format($hsl3['harga_satuan'],2,",",".");?></td>
        <td style="background: white"><?php echo "Rp ".number_format($hsl3['sum_demand'],2,",",".");?></td>
        <td style="background: white"><?php if($hsl3['ret_stat']==0){echo "Belum Diterima";}else{echo "Diterima" ;}?></td>
    </tr>
<?php		
    }
?>	
</table>
<?php
                echo "<script> 
				window.print()
			</script>";
        ?>