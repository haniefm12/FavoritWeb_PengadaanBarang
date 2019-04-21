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
    echo "<center>LAPORAN ACCOUNT PAYABLE</center>";

    echo    "<table align=center border=1>			
				<thead >
					<tr>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Sisa</th>
					</tr>
				</thead>";
				$sql1= "SELECT account_payable.tanggal,account_payable.id_demand,suppliers.nama_supplier,product.nama_item,purchase_order.qty_demand,
				product.satuan,product.harga_satuan,account_payable.paid,account_payable.total_tagihan,account_payable.sisa_tagihan 
				FROM account_payable 
				LEFT JOIN purchase_order ON account_payable.id_demand = purchase_order.id_demand
				LEFT JOIN product ON purchase_order.id_item = product.id_item
				LEFT JOIN suppliers ON product.id_supplier = suppliers.id_supplier";
				$query1= mysqli_query($conn,$sql1);
				$tot=0;
				$sis=0; 
  
				while ($hsl1= mysqli_fetch_assoc($query1)){
					$tot = $tot + $hsl1['total_tagihan'];
                    $sis = $sis + $hsl1['sisa_tagihan'];
                    
				echo "<tr>";
                echo "	<th>"; echo $hsl1['tanggal'];echo "</th>";
                echo "	<td>"; echo $hsl1['id_demand'];echo "</td>";
				echo "	<td>"; echo $hsl1['nama_supplier'];echo "</td>";
				echo "	<td>"; echo $hsl1['nama_item'];echo "</td>";
                echo "	<td>"; echo $hsl1['qty_demand'];echo "</td>";
                echo "   <td>"; echo "Rp ".number_format($hsl1['harga_satuan'],2,",",".");echo "</td>";
				echo "	<td>"; if($hsl1['paid']==0){echo "Belum Lunas";}else{echo "Lunas";} echo "</td>";
                echo "   <td>"; echo "Rp ".number_format($hsl1['total_tagihan'],2,",",".");echo "</td>";
                echo "   <td>"; echo "Rp ".number_format($hsl1['sisa_tagihan'],2,",",".");echo "</td>
                    </tr>";
                }
                echo "<tr>
                <th>  </th>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> JUMLAH</td>
                <td> Rp ".number_format($tot,2,",",".")."</td>
                <td> Rp ".number_format($sis,2,",",".")."</td></td>
                <td> </td>

            </tr>";
                echo "</table>";
                echo "<script> 
				window.print()
			</script>";
        ?>