<?php
require_once '../../dbcon.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE `order` SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();

        header("Location: view_orders.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT status FROM `order` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $current_status = $row['status'];
}
?>
<style type="text/css">
    <?php include '../../style.css'; ?>
</style>
<!DOCTYPE html>
<html>

<head>
    <title>Update Orders</title>
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
            background-image: url('../../assets/images/table-leaves-shape.png');
        }

        .site-header {
            padding: 60px;
            margin-left: 0;
        }

        .header-menu,
        .logo-img {
            margin-right: 100px;
        }

        .update-sec {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php include '../order/header-admin.php'; ?>
    <h1 style="font-weight: 1000; margin-top:200px; color:blue" class="text-center">Update order status #<?php echo $id; ?></h1>
    <div style="margin-top: 0; margin-bottom: 200px;" class="update-sec">
        <form method="post">
            <label for="status">
                <h3>Current status: <?php echo $current_status; ?></h3>
            </label><br>
            <label for="status">
                <h3>New status:</h3>
            </label>
            <select class="mt-3 p-3 form-select" id="status" name="status">
                <option value="Pending">Pending</option>
                <option value="Delivering">Delivering</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
            </select><br>
            <input style="font-size:20px;font-weight: 500; border-radius:20px; padding:20px 60px" class="btn-success mt-3" type="submit" value="Update">
        </form>
    </div>
</body>

</html>