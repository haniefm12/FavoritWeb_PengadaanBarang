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
    echo "<center>LAPORAN DAFTAR SUPPLIER</center>";

    echo    "<table align=center border=1>			
				<thead >
					<tr>
						<th>Nama Supplier</th>
						<th>e-Mail</th>
						<th>Alamat</th>
						<th>Kontak</th>
						<th>Sisa Tagihan</th>
					</tr>
				</thead>";
                $sql1= "SELECT * FROM suppliers";
				$query1= mysqli_query($conn,$sql1);
				$si = 0;
				while ($hsl1= mysqli_fetch_assoc($query1)){
	
			
				echo "<tr>";
	    		echo "	<th>"; echo $hsl1['nama_supplier'];echo "</th>";
				echo "	<td>"; echo $hsl1['email'];echo "</td>";
				echo "	<td>"; echo $hsl1['alamat'];echo "</td>";
				echo "	<td>"; echo $hsl1['no_hp'];echo "</td>";
				echo "	<td>"; echo $hsl1['sisa_tagihan'];echo "</td>
                    </tr>";$si = $si + $hsl1['sisa_tagihan'];
                }
                echo "</table>";
                

                echo "<br> Tagihan belum dibayar sebesar <strong>Rp ".$si.",00 </strong>";
                echo "<script> 
				window.print()
			</script>";
        ?>