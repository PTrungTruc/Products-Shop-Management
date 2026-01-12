<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<style type="text/css">
    <?php include '../style.css'; ?>
</style>
<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background-image: url('../assets/images/banner1.png');
        }

        .site-header {
            padding: 60px;
            margin-left: 0;
        }

        .header-menu,
        .logo-img {
            margin-right: 100px;
        }
    </style>
</head>

<body class="body-fixed">
    <?php
    // session_start();
    if (isset($_SESSION['uid'])) {
        include('../dbcon.php');
        $uid = $_SESSION['uid'];
        $query = "SELECT * FROM `user` WHERE `id` = '$uid'";
        $run = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($run);

        $name = $data['name'];
        $email = $data['email'];

        // lấy bảng cart menu id
        $query1 = "SELECT * FROM `cart` WHERE `userId` = '$uid'";
        $run1 = mysqli_query($conn, $query1);
        $cartId = array();
        while ($data1 = mysqli_fetch_assoc($run1)) {
            $cartId[] = $data1['menuId'];
        }
        $_SESSION['cartId'] = $cartId;
    } else {
    }
    ?>
    <?php include 'header-admin.php'; ?>
</body>

</html>