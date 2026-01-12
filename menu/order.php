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
?>
<style type="text/css">
    <?php include '..\style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order</title>
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
            background-color: #f2f2f2;
        }

        table,
        th,
        td {
            border: 2px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: white;
        }

        .header-menu,
        .logo-img {
            margin-right: 100px;
        }

        h1 {
            font-size: 60px;
            font-weight: 1000;
        }

        tr:nth-child(even) {
            background-color: #9ebddc
        }

        .title {
            background-color: #2e2eb0;
            color: white;
        }
    </style>
</head>

<body>
    <?php include '../components/header-login-register.php'; ?>


    <div style="margin-top: 200px;" class="container">
        <div align="right" class="my-3 me-2">
            <div class="text-center pt-5">
                <h1>Your Order</h1>
            </div>
            <label class="h5 me-2">Filter</label>
            <select class="text-center" id="searchBox" oninput="searchStatus()">
                <option value="All">All</option>
                <option value="Pending">Pending</option>
                <option value="Delivering">Delivering</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div style="overflow-x:auto;">
            <table align="center" class="col-12">
                <thead>
                    <tr>
                        <th class="title">No.</th>
                        <th class="title">Detail</th>
                        <th class="title">Total</th>
                        <th class="title">Note</th>
                        <th class="title">Address</th>
                        <th class="title">Phone</th>
                        <th class="title">Status</th>
                        <th class="title">Action</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    <?php
                    include('../dbcon.php');

                    $query1 = "SELECT * FROM `order` WHERE `userId` = '$uid'";
                    $run1 = mysqli_query($conn, $query1);
                    if (mysqli_num_rows($run1) < 1) {
                        echo "<tr><td colspan='8' >No data found</td><tr>";
                    } else {
                        $count = 0;
                        while ($data1 = mysqli_fetch_assoc($run1)) {
                            $count++;
                            $active = "";
                            $color_btn = "btn-warning";
                            if ($data1['status'] == "Delivering") {
                                $color_btn = "btn-info";
                                $active = "disabled";
                            } elseif ($data1['status'] == "Cancelled") {
                                $color_btn = "btn-danger";
                                $active = "disabled";
                            } elseif ($data1['status'] == "Delivered") {
                                $color_btn = "btn-success";
                                $active = "disabled";
                            }
                    ?>
                            <tr>
                                <td> <?php echo $count ?> </td>
                                <td> <?php echo $data1['detail']; ?> </td>
                                <td> <?php echo $data1['total']; ?> </td>
                                <td> <?php echo $data1['note']; ?> </td>
                                <td> <?php echo $data1['address']; ?> </td>
                                <td> <?php echo $data1['phone']; ?> </td>
                                <td>
                                    <div class="rounded-3 <?php echo $color_btn ?>"> <?php echo $data1['status']; ?> </div>
                                </td>
                                <td>
                                    <a class="btn btn-danger <?php echo $active ?>" href="cancelOrder.php?orderId=<?php echo $data1['id']; ?>"> Cancelled </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

    });

    function searchStatus() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchBox");
        filter = input.value;
        table = document.getElementById("orderTable");
        tr = table.getElementsByTagName("tr");
        if (filter === "All") {
            for (i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
            }
            return true;
        }
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[6];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</html>