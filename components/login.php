<?php
session_start();
if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    header("location: ../home.php?uid=$id");
} else {
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
    <title>Login</title>
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

        #login {
            padding-top: 200px;
        }

        .site-header {
            padding: 60px;
            margin-left: 0;
        }

        .header-menu{
            margin-right: 200px;
        }
    </style>
</head>

<body class="body-fixed">
    <?php include 'header-login-register.php'; ?>

    <div id="login" class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-10 p-4 border rounded">
                <h3 style="font-weight: 1000;" class="text-center text-primary"> Login </h3>
                <form class="login-form " action="" method="post">
                    <div id="check-req" class="m-3 ms-auto"></div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0 rounded-left"><i class="bi bi-person-circle"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <button style="float: right;" id="show" class="bg-white text-primary border-0" type="button"> <i class="bi bi-eye"></i> Show</button>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0 rounded-left"><i class="bi bi-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                        </div>
                    </div>
                    <h6 class="py-1">Don't have an Acccount? <a href="register.php">Register</a></h6> <!-- register.php -->

                    <input name="login" class="btn btn-success px-5 text-center " type="submit" value="Login"></input>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        const user = $('#email');
        const pass = $('#password');

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
    });
</script>

</html>

<?php

if (isset($_POST['login'])) {
    include('../dbcon.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
    $run = mysqli_query($conn, $query);

    $row = mysqli_num_rows($run);

    if ($row < 1) {
?>

        <script>
            const letter = `<div class="alert-danger rounded px-3 py-1">
                    <strong><i class="bi bi-x-lg"></i> Email & Password not match! </strong>
                </div>`;
            $('#check-req').html(letter);
            // window.open('login.php','_self');
        </script>

    <?php
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['id'];

        $_SESSION['uid'] = $id;

    ?>
        <script>
            const letter = `<div class="alert-success rounded px-3 py-1">
                            <strong><i class="bi bi-check-lg"></i> You successfully log-in <br> Redirected in 2s </strong>
                        </div>`;
            $('#check-req').html(letter);
            setTimeout(function() {
                window.open('../home.php?uid=<?php echo $id ?>', '_self');
            }, 2000);
        </script>
<?php

    }
}

?>