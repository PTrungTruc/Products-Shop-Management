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
    <title>Change password</title>
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

    <div style="margin-top: 200px;" class="container ">
        <div class="text-center pt-5">
            <h1>Change password</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-10 p-4 border rounded m-5">
                <h3 class="justify-content-center text-center"><?php echo "Welcome " . $data['name'] ?></h3>
                <form class="login-form " action="" method="post">
                    <div class="form-group mb-3">
                        <label for="password">Old-Password</label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="old-password" placeholder="Enter your old-password" name="old-password" required>
                        </div>
                        <div id="check-pass" class="m-3 ms-auto"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Create your new password" name="password" required>
                        </div>
                        <div id="check-pass" class="m-3 ms-auto"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="check-password">Confirm password</label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="check-password" placeholder="Enter password again" name="check-password" required>
                        </div>
                    </div>

                    <input name="changePwd" class="btn btn-success px-5 text-center " type="submit" value="Change password" id="changePwd"></input>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {

        $('form').submit(ev => {
            const con = "       Are you sure you want to change the password?\n     (This will log you out of the website.)";
            return confirm(con);
        });
        const pass = $('#password');
        const regex = /[~`!@#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/;

        $('#resigter').click(e => {
            $('#check-pass').html("");
            if (pass.val().length < 8) {
                const check = '<div class="alert-danger mt-2 rounded px-3"><strong> <i class="bi bi-x-lg"></i> 8 characters</strong></div>';
                $('#check-pass').append(check);
                e.preventDefault();
            }

            if (pass.val().match(".*\\d.*") === false) {
                const check = '<div class="alert-danger mt-2 rounded px-3"><strong> <i class="bi bi-x-lg"></i> 1 number</strong></div>';
                $('#check-pass').append(check);
                e.preventDefault();
            }

            if (regex.test(pass.val()) === false) {
                const check = '<div class="alert-danger mt-2 rounded px-3"><strong> <i class="bi bi-x-lg"></i> 1 special character e.g, $, !, @, &, %</strong></div>';
                $('#check-pass').append(check);
                e.preventDefault();
            }

            if (pass.val().match(" ") === false) {
                const check = '<div class="alert-danger mt-2 rounded px-3"><strong> <i class="bi bi-x-lg"></i> No leading or trailing whitespace</strong></div>';
                $('#check-pass').append(check);
                e.preventDefault();
            }

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

if (isset($_POST['changePwd'])) {
    include('../dbcon.php');

    $old = $_POST['old-password'];
    $password = $_POST['password'];
    $cpassword = $_POST['check-password'];

    if ($old != $data['password']) {
?>
        <script>
            alert("Old password is not correct.");
        </script>
    <?php
        die();
    }
    if ($password != $cpassword) {
    ?>
        <script>
            alert("Password and Confirm password don't match.");
        </script>
    <?php
        die();
    }
    if ($password === $data['password']) {
    ?>
        <script>
            alert("The new password needs to be different from the old one.");
        </script>
    <?php
        die();
    }

    $sql = "UPDATE `user` SET `password` = '$password' WHERE `id` = '$uid'";
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