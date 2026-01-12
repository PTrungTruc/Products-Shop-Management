<?php
session_start();
include('../dbcon.php');
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $query = "SELECT * FROM `user` WHERE `id` = '$uid'";
    $run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($run);
} else {
    header('location: ../index.php');
}
if (isset($_POST['checkOut'])) {
    $cartId = ($_POST['cartId']);
    $total = 0;
    $description = "";
    $address = $data['address'];
    $phone = $data['phone'];
    $status = "Pending";
    foreach ($cartId as $x) {
        $query1 = "SELECT * FROM `cart` WHERE `userId` = '$uid' AND `menuId` = '$x'";
        $run1 = mysqli_query($conn, $query1);
        if ($data1 = mysqli_fetch_assoc($run1)) {
            $name = $data1['itemName'];
            $qty = $data1['qty'];
            $description .= " $name: x$qty;";
            $total += $data1['total'];
        } else {
            echo "ERROR: $query1. " . mysqli_error($conn);
        }
    }
    $description = trim($description, ';');
    $description = trim($description, ' ');

    unset($_SESSION['order']);
    $_SESSION['order'] = $cartId;
} else {
    header('location: ../home.php');
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
    <title>Check out</title>
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
            background-image: url('../assets/images/table-leaves-shape.png');
        }

        table {
            border-collapse: collapse;
            margin-bottom: 20px;
            /* border-radius: 25px; */
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

        td {
            background-color: white;
        }

        .data {
            width: 400px;
        }

        #checkout-section {
            margin: 50px;
            background-image: url('../assets/images/table-leaves-shape.png');

        }

        .title-td,
        .tag {
            background-color: #2e2eb0;
            color: white;
        }
    </style>
</head>

<body>
    <?php include '../components/header-login-register.php'; ?>


    <div class="text-center pt-5">
        <h1>Check Out</h1>
    </div>


    <div id="checkout" class="container alert-primary text-dark p-3 my-3 rounded border">
        <div id="checkout-section" class="row justify-content-center">
            <div class="text-center pt-5 p-5">
                <h1>YOUR ORDER</h1>
            </div>
            <div class="card pt-3 col-md-6 col-sm-10">
                <table align="center">
                    <thead>
                        <tr>
                            <td class="title-td" colspan='2'> Your Personal Info</td>
                        </tr>
                    </thead>
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
                </table>
            </div>

            <div class="card pt-3 col-md-6 col-sm-10">
                <table align="center">
                    <thead>
                        <tr>
                            <td class="title-td" colspan='2'> Your Order Info</td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="tag">Detail</td>
                        <td class="data"><?php echo $description ?></td>
                    </tr>
                    <tr>
                        <td class="tag">Total</td>
                        <td class="data">$<?php echo $total ?></td>
                    </tr>
                    <tr>
                        <td class="tag">Note</td>
                        <td class="data" width="300">
                            <textarea oninput="updateNote(this)" style="width: 100%;" placeholder="You can give your note in here."></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <form class="login-form col-12" action="finishOrder.php" method="post">
                <!-- style="display: none;" -->
                <div class="form-group mb-3" style="display: none;">
                    <label for="total">Total</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="total" name="total" value="<?php echo $total ?>">
                    </div>
                </div>
                <div class="form-group mb-3" style="display: none;">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $status ?>">
                    </div>
                </div>
                <div class="form-group mb-3" style="display: none;">
                    <label for="detail">Detail</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $description ?>">
                    </div>
                </div>
                <div class="form-group mb-3" style="display: none;">
                    <label for="note">Note</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="note" name="note" value="">
                    </div>
                </div>
                <div class="form-group mb-3" style="display: none;">
                    <label for="address">Address</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'] ?>">
                    </div>
                </div>
                <div class="form-group mb-3" style="display: none;">
                    <label for="phone">Phone</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['phone'] ?>">
                    </div>
                </div>
                <div align='center'>
                    <input class="btn btn-success " style="font-size:20px;font-weight:600; margin-top: 20px; padding:20px 100px" type="submit" name="order" id="order" value="Order"> </input>
                </div>
            </form>
        </div>
    </div>

    
</body>
<script>
    $(document).ready(function() {
        $('form').submit(ev => {
            const check = "Are you sure you want to order this one?";
            if (confirm(check)) {
                <?php echo "UPDATE" ?>
            } else {
                ev.preventDefault();
            }
        });
    });

    function updateNote(element) {
        // element.value
        const note = document.querySelector('#note');
        note.value = element.value;
    }
</script>

</html>