<!DOCTYPE html>
<html>
<head>
	<title> </title>
</head>
<body >
<!-- semnagt nando frontendnya, gausah disamain dulu sama backendnya yaa, itu cuma buat garis haluan urg -->


<?php
	
	if (isset($_POST['login'])) {
		session_start();
		include  'koneksi.php';

		$user=$_POST['username'];
		$pass=md5($_POST['password']);

		$sql= "SELECT id_akun,username,password FROM akun WHERE username='".$user."'";
		$query= mysqli_query($conn,$sql);
		$result= mysqli_fetch_array($query);

		if (!empty($user || $pass)) {
			if ($user==$result[1]) {
				if ($pass==$result[2]) {
					$_SESSION["sukses"]=1;
					$_SESSION["username"]=$result[1];
					$_SESSION["password"]=$result[2];
					$_SESSION["id_akun"]=$result[0];
					header("location: rumah.php");
				}else{
					echo "Password Salah";
					}
			}else{
				echo "Username Salah";
				}
		}else{
			echo "tidak boleh kosong";
			}
	}
?>
</body>
</html>