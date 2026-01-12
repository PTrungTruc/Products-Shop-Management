<?php
session_start();
if (isset($_SESSION['uid'])) {
	include('../dbcon.php');
	$uid = $_SESSION['uid'];
	$query = "SELECT * FROM `user` WHERE `id` = '$uid'";
	$run = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($run);
} else {
	header('location: ../components/login.php');
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
	<title>Cart</title>
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
			background-image: url('../assets/images/menu-bg.png');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-color: brown;

		}

		table {
			border-collapse: collapse;
			width: 100%;
			margin-bottom: 20px;
			background-color: white;
		}

		table,
		th,
		td {
			border: 1px solid #ccc;
		}

		th,
		td {
			padding: 10px;
			text-align: center;
		}

		th {
			background-color: #f2f2f2;
		}

		.cart-section {
			margin-top: 200px;
		}

		.cart-table {
			margin-top: 30px;
		}

		.header-menu,
		.logo-img {
			margin-right: 100px;
		}

		h1 {
			font-size: 60px;
			font-weight: 1000;
		}
	</style>
</head>

<body>
	<?php include '../components/header-login-register.php'; ?>


	<div class="cart-section">
		<div class="text-center pt-5">
			<h1>Your Cart</h1>
		</div>


		<div class="container cart-table">

			<form class="login-form " action="checkout.php" method="post">
				<div style="overflow-x:auto;">
					<table align="center" class="border">
						<thead>
							<tr>
								<th></th>
								<th>Your Menu Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="productTable">
							<?php
							include('../dbcon.php');

							$query1 = "SELECT * FROM `cart` WHERE `userId` = '$uid'";
							$run1 = mysqli_query($conn, $query1);
							if (mysqli_num_rows($run1) < 1) {
								echo "<tr><td colspan='6' >No data found</td><tr>";
							} else {
								while ($data1 = mysqli_fetch_assoc($run1)) {
							?>
									<tr>
										<td> <input type="checkbox" name="cartId[]" value='<?php echo $data1['menuId']; ?>'></input></td>
										<td> <?php echo $data1['itemName']; ?> </td>
										<td> <?php echo $data1['price']; ?> </td>
										<td class="total-info"><input oninput="changeValue(this, '<?php echo $data1['price']; ?>','total<?php echo $data1['menuId']; ?>', '<?php echo $data1['menuId']; ?>' )" style="width: 100%; text-align: center;" type="number" min=1 value="<?php echo $data1['qty']; ?>"> </input></td>
										<td> <span id="total<?php echo $data1['menuId']; ?>"><?php echo $data1['total']; ?></span></td>
										<td> <a class="btn btn-danger removeCart" href="removeCart.php?cartId=<?php echo $data1['menuId']; ?>"> Remove </a></td>

									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
				<div align='center'>
					<input class="btn btn-success " style=" margin-top: 20px" type="submit" name="checkOut" value="Check out"> </input>
				</div>
			</form>
		</div>
	</div>


	<!-- message dialog -->
	<div class="modal fade" id="message-dialog">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Opps</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body" id="message-text">
					<p>You need to choose at least 1 food.</p>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-bs-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	$(document).ready(function() {

		$('form').submit(ev => {
			checked = $("input[type=checkbox]:checked").length;

			if (!checked) {
				$('#message-text').html('You must choose at least one item to continue.');
				$('#message-dialog').modal('show');
				return false;
			}
			const date = new Date();
			if (date.getHours() >= 22) {
				$('#message-text').html('Sorry but we are closed.');
				$('#message-dialog').modal('show');
				ev.preventDefault();
				return false;
			}
			// If today is friday, saturday and sunday.
			else if ((date.getDay() >= 5 || date.getDay() == 0) && date.getHours() < 11) {
				$('#message-text').html('Sorry but we are closed.');
				$('#message-dialog').modal('show');
				ev.preventDefault();
				return false;
			}
			// other days.
			else if ((date.getDay() >= 1 || date.getDay() < 5) && date.getHours() < 9) {
				$('#message-text').html('Sorry but we are closed.');
				$('#message-dialog').modal('show');
				ev.preventDefault();
				return false;
			}

			var check = true;
			//Check if the device is not at HCM City, VN.
			$.ajax({
				url: "http://ipinfo.io/json",
				async: false,
				success: function(response) {
					if ((response.city).indexOf("Ho Chi Minh") >= 0 && (response.country).indexOf("VN") >= 0) {
						console.log(response.city, response.country);
						check = true;
					} else {
						check = false;
					}
				},
				dataType: 'json',
				statusCode: {
					429: function() {
						alert("Number of tries exceeded");
					}
				}
			});

			if (check == false) {
				$('#message-text').html('Sorry, but we do not serve this area.');
				$('#message-dialog').modal('show');
				ev.preventDefault();
				return false;
			}

		});
		$('.removeCart').click(ev => {
			const alert = confirm('Are you sure you want to remove this.');
			return alert;
		});
	});

	function changeValue(id, price, totalId, cartId) {
		if (id.value > 0) {
			const total = document.querySelector(`#${totalId}`);
			console.log(total.innerHTML);
			total.innerHTML = price * id.value;
			const totalVal = price * id.value;
			const qty = id.value;
			const uid = <?php echo $uid ?>;
			const xhttp = new XMLHttpRequest();
			xhttp.open("GET", `updateCart.php?uid=${uid}&cartId=${cartId}&qty=${qty}&total=${totalVal}`);
			xhttp.send();
			// window.open(`updateCart.php?uid=${uid}&cartId=${cartId}&qty=${qty}&total=${totalVal}`);
		} else {
			id.value = 1;
		}
	}
</script>

</html>