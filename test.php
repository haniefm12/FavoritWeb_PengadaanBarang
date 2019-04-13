<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<table class="table">				
				<thead class="thead-dark">
					<tr>
						<th scope="col">Nama Supplier</th>
						<th scope="col">e-Mail</th>
						<th scope="col">Alamat</th>
						<th scope="col">Nomor Telepon</th>
						<th scope="col">Sisa Tagihan</th>
					</tr>
				</thead>
<?php
    include 'koneksi_model.php';
   
    $sql= "SELECT * FROM suppliers";
	$query= mysqli_query($conn,$sql);
   
	while ($hsl= mysqli_fetch_assoc($query)){
?>
			
	<tr>
	    <th scope ="row"><?php echo $hsl['nama_supplier'];?></th>
			<td><?php echo $hsl['email'];?></td>
			<td><?php echo $hsl['alamat'];?></td>
			<td><?php echo $hsl['no_hp'];?></td>
			<td><?php echo $hsl['sisa_tagihan'];?></td>
		</tr>
<?php		
		}
?>
</table>	
    
</body>
</html>