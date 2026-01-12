<?php
session_start();
?>
<style type="text/css">
    <?php include '../style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resigter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <!-- jquery  -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <!-- fontawesome  -->
    <script src="assets/js/font-awesome.min.js"></script>
    <!-- swiper slider  -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- mixitup -- filter  -->
    <script src="assets/js/jquery.mixitup.min.js"></script>
    <!-- fancy box  -->
    <script src="assets/js/jquery.fancybox.min.js"></script>
    <!-- parallax  -->
    <script src="assets/js/parallax.min.js"></script>
    <!-- gsap  -->
    <script src="assets/js/gsap.min.js"></script>
    <!-- scroll trigger  -->
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <!-- scroll to plugin  -->
    <script src="assets/js/ScrollToPlugin.min.js"></script>
    <!-- custom js  -->
    <script src="main.js"></script>
    <style>
        #register-part {
            padding-top: 150px;
        }

        .site-header {
            padding: 60px;
            margin-left: 0;
        }

        body {
            background-image: url('../assets/images/table-leaves-shape.png');
        }

        .header-menu,
        .logo-img {
            margin-right: 100px;
        }

        .site-header {
            padding: 60px;
            margin-left: 0;
        }

        .header-menu {
            margin-right: 200px;
        }
    </style>
</head>

<body>

    <?php include 'header-login-register.php'; ?>


    <div id="register-part" class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-10 p-4 border rounded">
                <h3 style="font-weight: 1000;" class="text-center text-primary"> Resigter </h3>
                <form class="login-form " action="" method="post">

                    <div class="form-group mb-3">
                        <label for="user">Your Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="username" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="phone" placeholder="Enter your phone, at least 9 numbers" name="phone" required>
                        </div>
                        <div id="check-phone" class="m-3 ms-auto"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <!-- <button style="float: right;" id="show" class="bg-white text-primary border-0" type="button"> <i class="bi bi-eye"></i> Show</button> -->
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Create your password" name="password" required>
                        </div>
                        <div id="check-pass" class="m-3 ms-auto"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="check-password">Confirm password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="check-password" placeholder="Enter password again" name="check-password" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <div class="input-group">
                            <textarea class="form-control" id="address" placeholder="Your address" name="address" required></textarea>
                        </div>
                    </div>

                    <h6 style="font-weight: 1000;" class="py-1">Have an Acccount? <a href="login.php">Sign in</a></h6> <!-- register.php -->

                    <input name="resigter" class="btn btn-success px-5 text-center " type="submit" value="Resigter" id="resigter"></input>
                    <input name="reset" class="btn btn-danger px-5 text-center " style="float: right;" type="reset" value="Reset" id="reset"></input>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        const user = $('#email');
        const pass = $('#password');
        const regex = /[~`!@#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/;

        // $('form').submit(ev =>{
        //     ev.preventDefault();
        // });
        $('#show').click(() => {
            if (pass.attr("type") === 'password') {
                pass.attr("type", "text");
                $('#show').html('<i class="bi bi-eye-slash"></i> Hide');
            } else if (pass.attr("type") === "text") {
                pass.attr("type", 'password');
                $('#show').html('<i class="bi bi-eye"></i> Show');
            }
        });
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

        $('#reset').click(ev => {
            $('#check-pass').html("");
            $('#check-phone').html("");
        });
    });
</script>

</html>

<?php

if (isset($_POST['resigter'])) {
    include('../dbcon.php');

    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['check-password'];
    $address = $_POST['address'];

    if ($password != $cpassword) {
?>
        <script>
            alert("Password and Confirm password don't match");
        </script>
    <?php
        die();
    }

    $esql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $erun = mysqli_query($conn, $esql);

    if (mysqli_num_rows($erun) > 0) {
    ?>
        <script>
            alert("This email already exist!");
        </script>
    <?php
        die();
    }

    $sql = "INSERT INTO `user`(`name`, `phone`, `address`, `email`, `password`) VALUES ('$name', '$phone', '$address', '$email', '$password')";
    $run = mysqli_query($conn, $sql);

    if ($run == true) {
    ?>

        <script>
            alert("User Registration Successfully !");
            window.open('login.php', '_self')
        </script>

<?php
    } else {
        echo "ERROR: $sql. " . mysqli_error($conn);
    }
}
?>