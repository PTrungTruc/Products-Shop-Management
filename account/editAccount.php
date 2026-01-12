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

?>
<style type="text/css">
    <?php include '..\style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Information</title>
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

<body>

    <?php include '..\components\header-login-register.php'; ?>
    <div style="margin-top: 200px;" class="container">
        <div class="text-center pt-5">
            <h1>EDIT ACCOUNT</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-10 p-4 border rounded m-5">
                <h3 class="justify-content-center text-center"><?php echo "Welcome " . $data['name'] ?></h3>
                <form class="login-form " action="" method="post">

                    <div class="form-group mb-3">
                        <label for="user">Your Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="username" value="<?php echo $data['name'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" value="<?php echo $data['email'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="phone" placeholder="Enter your phone, at least 9 numbers" name="phone" value="<?php echo $data['phone'] ?>" required>
                        </div>
                        <div id="check-phone" class="m-3 ms-auto"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <div class="input-group">
                            <textarea class="form-control" id="address" placeholder="Your address" name="address" required><?php echo $data['address'] ?></textarea>
                        </div>
                    </div>

                    <input name="editAcc" class="btn btn-success px-5 text-center " type="submit" value="Edit" id="editAcc"></input>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        const user = $('#email');

        $('form').submit(ev => {
            const con = "       Are you sure you want to change the information?\n      (This will log you out of the website.)";
            return confirm(con);
        });
        $('#editAcc').click(e => {

            $('#check-phone').html("");
            if (pass.val().length < 8) {
                const check = '<div class="alert-danger mt-2 rounded px-3"><strong> <i class="bi bi-x-lg"></i> Need 9 numbers</strong></div>';
                $('#check-phone').append(check);
                e.preventDefault();
            }
        });
    });
</script>

</html>

<?php

if (isset($_POST['editAcc'])) {
    include('../dbcon.php');

    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE `user` SET `name` = '$name', `phone` = '$phone', `address` = '$address', `email` = '$email' WHERE `id` = '$uid'";
    $run = mysqli_query($conn, $sql);
    if ($run == true) {
?>

        <script>
            alert("User Update Successfully !");
            <?php
            session_destroy();
            ?>
            window.open('../home.php', '_self');
        </script>

<?php
    } else {
        echo "ERROR: $sql. " . mysqli_error($conn);
    }
}
?>