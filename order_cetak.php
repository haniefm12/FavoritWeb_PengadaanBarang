<?php
	include 'koneksi_model.php';
	session_start();
	if (!isset($_SESSION["sukses"]) and !isset($_SESSION["username"]) and !isset($_SESSION["password"])) {
		die("<div style='margin-top:200px'>
			<h1 style='text-align:center;color:red;font-weight:bold'>Kami tidak mengenali anda!</h1>
			<h3 style='text-align:center'>Silahkan login <a href='login_page.php'>disini</a></h3>
            </div>");
        }
    echo "<br><br>Gudang FAVORIT <br>";
    echo "<center>LAPORAN DAFTAR PRODUCT</center>";

    echo    "<table align=center border=1px>			
				<thead >
					<tr>
                    <th>Id</th>
                    <th>Tanggal</th>
                    <th>Product</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
					</tr>
				</thead>";
				$sql1= "SELECT purchase_order.id_demand,purchase_order.tgl,product.nama_item,suppliers.nama_supplier,purchase_order.qty_demand,product.satuan,product.harga_satuan,purchase_order.sum_demand FROM purchase_order LEFT JOIN product ON purchase_order.id_item =product.id_item LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier WHERE purchase_order.status=1";
				$query1= mysqli_query($conn,$sql1);
  
				while ($hsl1= mysqli_fetch_assoc($query1)){
	
			
				echo "<tr>";
	    		echo "	<th>"; echo $hsl1['id_demand'];echo "</th>";
				echo "	<td>"; echo $hsl1['tgl'];echo "</td>";
				echo "	<td>"; echo $hsl1['nama_item'];echo "</td>";
				echo "	<td>"; echo $hsl1['nama_supplier'];echo "</td>";
				echo "	<td>"; echo $hsl1['qty_demand'];echo "</td>";
                echo "  <td>"; echo $hsl1['satuan'];echo "</td>";
                echo "  <td>"; echo "Rp ".number_format($hsl1['harga_satuan'],2,",",".");echo "</td>";
                echo "  <td>"; echo "Rp ".number_format($hsl1['sum_demand'],2,",",".");echo "</td>
                    </tr>";
                }
                echo "</table>";
                echo "<script> 
				window.print()
			</script>";
        ?>