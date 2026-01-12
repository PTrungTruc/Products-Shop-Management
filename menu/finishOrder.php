<?php
session_start();
include('../dbcon.php');
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $query = "SELECT * FROM `user` WHERE `id` = '$uid'";
    $run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($run);
} else {
    header('location: ../home.php');
}
if (isset($_POST['order'])) {
    $total = $_POST['total'];
    $detail = $_POST['detail'];
    $note = $_POST['note'];
    $address = $data['address'];
    $phone = $data['phone'];
    $status = "Pending";

    $sql = "INSERT INTO `order`(`userId`, `total`, `status`, `detail`, `note`, `address`, `phone`) VALUES ('$uid', '$total', '$status', '$detail', '$note', '$address', '$phone')";
    $run1 = mysqli_query($conn, $sql);

    if ($run1 == true) {
?>

        <script type="text/javascript">
            alert("Order Successfully !");
        </script>

<?php
    } else {
        echo "ERROR: $sql. " . mysqli_error($conn);
    }

    $cartId = ($_SESSION['order']);
    foreach ($cartId as $x) {
        $query1 = "DELETE FROM `cart` WHERE `userId` = '$uid' AND `menuId` = '$x'";
        $run1 = mysqli_query($conn, $query1);
        if ($run1 == true) {
        } else {
            echo "ERROR: $query1. " . mysqli_error($conn);
        }
    }
    unset($_SESSION['order']);
} else {
    header('location: ../home.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        body {
            background-image: url('../assets/images/table-leaves-shape.png');
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 px-3">
        <!-- <div class="container "> -->
        <a class="navbar-brand " href="../home.php"><h3>MENU</h3></a>
        <a class="navbar-brand mx-auto" href="../home.php"> <img src="..\assets\images\logo.png" width="200" height="200" alt="Logo">
        </a>
        <!-- <a href="#" class="navbar-brand ms-auto">Right</a> -->

        <div class="logout navbar-brand ">
            <?php
            if (isset($_SESSION['uid'])) {
            ?><a href="../components/logout.php" class="text-decoration-none"><i class="bi bi-door-closed" aria-hidden="true">&nbsp;</i>Logout</a><?php
                                                                                                                                                } else {
                                                                                                                                                }
                                                                                                                                                    ?>
        </div>
        <div class="navbar-brand">
            <a href="../account/account.php" class="text-decoration-none"><i class="bi bi-person" aria-hidden="true">&nbsp;</i><?php echo $data['name'] ?></a>
        </div>
        <!-- </div> -->
    </nav>

    <div class="container" style="margin-top: 200px;">
        <h1 class="text-center">Thanks you for using our services.</h1>
        <div align='center'>
            <a class="btn btn-success" href="cart.php"> Back to cart </a>
        </div>
    </div>
</body>

</html>