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

    echo    "<table align=center border=1>			
				<thead >
					<tr>
						<th>Id Product</th>
						<th>Supplier</th>
						<th>Nama Product</th>
						<th>Jumlah Item</th>
						<th>Satuan</th>
						<th>Harga Satuan</th>
					</tr>
				</thead>";
                $sql1= "SELECT product.id_item ,product.nama_item, suppliers.nama_supplier, product.harga_satuan, product.satuan, product.jumlah_item FROM product LEFT JOIN suppliers ON product.id_supplier=suppliers.id_supplier";
				$query1= mysqli_query($conn,$sql1);
  
				while ($hsl1= mysqli_fetch_assoc($query1)){
	
			
				echo "<tr>";
	    		echo "	<th>"; echo $hsl1['id_item'];echo "</th>";
				echo "	<td>"; echo $hsl1['nama_supplier'];echo "</td>";
				echo "	<td>"; echo $hsl1['nama_item'];echo "</td>";
				echo "	<td>"; echo $hsl1['jumlah_item'];echo "</td>";
				echo "	<td>"; echo $hsl1['satuan'];echo "</td>";
                echo "   <td>"; echo "Rp ".number_format($hsl1['harga_satuan'],2,",",".");echo "</td>
                    </tr>";
                }
                echo "</table>";
                echo "<script> 
				window.print()
			</script>";
        ?>