<!DOCTYPE html>
<html>
<head>
	<title> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
	<link href="assets/css/styleLogin.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>

<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Welcome</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post">
					<input class="text" type="text" name="Username" placeholder="Username" required=""><br>
					<input class="text" type="password" name="password" placeholder="Password" required=""><br>
					<input type="submit" name="login" value="LOGIN">
				</form>
			</div>
		</div>
	</div>
	<!-- //main -->

<?php
	
	if (isset($_POST['login'])) {
		session_start();
		include  'koneksi_model.php';

		$user=$_POST['Username'];
		$pass=($_POST['password']);

		$sql= "SELECT id_user,username,password FROM user WHERE username='".$user."'";
		$query= mysqli_query($conn,$sql);
		#if (!$query) {
		#	printf("Error: %s\n", mysqli_error($conn));
		#	exit();
		#}
		$result= mysqli_fetch_array($query);

		if (!empty($user || $pass)) {
			if ($user==$result[1]) {
				if ($pass==$result[2]) {
					$_SESSION["sukses"]=1;
					$_SESSION["username"]=$result[1];
					$_SESSION["password"]=$result[2];
					$_SESSION["id_user"]=$result[0];
					header("location: mainMenu.php");
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