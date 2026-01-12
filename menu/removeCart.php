<?php
	session_start();
    
	include('../dbcon.php');
    if (isset($_SESSION['uid'])) 
	{
		$uid = $_SESSION['uid'];
	}
	else{
        header('location: ../home.php');
	}
	$cartId = $_GET['cartId'];
    $sql = "DELETE FROM `cart` WHERE `menuId` = '$cartId' AND `userId` = '$uid'";

	$run = mysqli_query($conn, $sql);

	if($run == true)
	{
		?>

		<script type="text/javascript">
			alert("Item is removed from cart Successfully!");
			window.open('cart.php','_self');
		</script>

		<?php
	}

?>