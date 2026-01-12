<?php
    include('../dbcon.php');
    $uid = $_GET['uid'];
    $cartId = $_GET['cartId'];
    $qty = (int) $_GET['qty'];
    $total = $_GET['total'];

    $sql = "UPDATE `cart` SET `qty` = $qty, `total` = $total WHERE `menuId` = '$cartId' AND `userId` = '$uid'";

    $run = mysqli_query($conn, $sql);

    if($run == true)
    {
        echo "<script>window.close();</script>";
    }
    else{
        echo "ERROR: $sql. " . mysqli_error($conn);
        die();
    }
?>				