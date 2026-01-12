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


	$orderId = $_GET['orderId'];
    $sql = "SELECT * FROM `order` WHERE `id` = '$orderId' AND `userId` = '$uid'";

	$check = mysqli_query($conn, $sql);

    if($check == true){
        $data = mysqli_fetch_assoc($check);
        if($data['status'] === "Delivering" || $data['status'] === "Delivered"){
            ?>

		    <script type="text/javascript">
			    alert("Order cannot be cancelled because it is delivered.");
			    window.open('order.php','_self');
		    </script>

		    <?php
			exit();
        }
    }
    else{
        echo "ERROR: $sql. " . mysqli_error($conn);
        die();
    }

	$query = "UPDATE `order` SET `status` = 'Cancelled' WHERE `id` = '$orderId' AND `userId` = '$uid'";

	$run = mysqli_query($conn, $query);

	if($run == true)
	{
		?>

		<script type="text/javascript">
			alert("Order is cancelled Successfully!");
			window.open('order.php','_self');
		</script>

		<?php
	}

?>