<?php
session_start();
if (isset($_SESSION['uid'])) {
	include('../dbcon.php');
	$uid = $_SESSION['uid'];
	$query = "SELECT * FROM `user` WHERE `id` = '$uid'";
	$run = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($run);
} else {
	header('location: ../home.php');
}

$query1 = "SELECT * FROM `cart` WHERE `userId` = '$uid'";
$run1 = mysqli_query($conn, $query1);
$cartId = array();
while ($data1 = mysqli_fetch_assoc($run1)) {
	$cartId[] = $data1['menuId'];
}

$_SESSION['cartId'] = $cartId;
sort($_SESSION['cartId']);
?>
<style type="text/css">
	<?php include '..\style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ACCOUNT INFORMATION</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
	<link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="main.js"></script>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/font-awesome.min.js"></script>
	<script src="assets/js/swiper-bundle.min.js"></script>
	<script src="assets/js/jquery.mixitup.min.js"></script>
	<script src="assets/js/jquery.fancybox.min.js"></script>
	<script src="assets/js/parallax.min.js"></script>
	<script src="assets/js/gsap.min.js"></script>
	<script src="assets/js/ScrollTrigger.min.js"></script>
	<script src="assets/js/ScrollToPlugin.min.js"></script>
	<script src="main.js"></script>
	<style>
		body {
			background-image: url('../assets/images/leaf2.jpg');
		}

		table {
			margin-top: 20px;
			margin-bottom: 20px;
		}

		table,
		tr,
		td {
			border: 1px solid rgb(0, 0, 0);
		}

		th,
		td {
			padding: 10px;
			text-align: left;
		}

		#login {
			padding-top: 200px;
		}

		.site-header {
			padding: 60px;
			margin-left: 0;
		}

		.header-menu,
		.logo-img {
			margin-right: 100px;
		}

		.account-inf {
			margin-top: 100px;
		}
	</style>
</head>

<body>
	<?php include '..\components\header-login-register.php'; ?>

	<div class="account-inf">
		<div style="margin-top: 150px;" class="container">
			<div class="text-center pt-5">
				<h1>ACCOUNT INFORMATION</h1>
			</div>
			<h2 class="justify-content-center text-center"><?php echo "Welcome " . $data['name'] ?></h2>
			<div style="overflow-x:auto;">
				<table align="center" class="border">
					<tr>
						<td class="tag">Name</td>
						<td class="data"><?php echo $data['name'] ?></td>
					</tr>
					<tr>
						<td class="tag">Phone No.</td>
						<td class="data"><?php echo $data['phone'] ?></td>
					</tr>
					<tr>
						<td class="tag">Address</td>
						<td class="data" width="300"><?php echo $data['address'] ?></td>
					</tr>
					<tr>
						<td class="tag">Email</td>
						<td class="data"><?php echo $data['email'] ?></td>
					</tr>
					<tr>
						<th><a href="editAccount.php"><button class="btn btn-success">Edit Information</button></a>
						<a href="changePwd.php"><button class="btn btn-primary">Change Password</button></a></td>
						<th style="float: right;"><a href="deleteAccount.php?uid=<?= $uid ?>"><button  class="btn btn-danger deleteUser">Delete This Acccount</button></a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
<script>
    $(document).ready(function() {
        $('.deleteUser').click(ev => {
            const alert = confirm('Are you sure you want to delete this account ?');
            return alert;
        });
    });
</script>
</html>