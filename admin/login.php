<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require_once('../db.php');



$error = '';

$user = '';
$pass = '';

// if (isset($_POST['user']) && isset($_POST['pass'])) {
//     $user = $_POST['user'];
//     $pass = $_POST['pass'];

//     if (empty($user)) {
//         $error = 'Please enter your username';
//     }
//     else if (empty($pass)) {
//         $error = 'Please enter your password';
//     }
//     else if (strlen($pass) < 6) {
//         $error = 'Password must have at least 6 characters';
//     }
//     else{
//         $result = login($user, $pass);

//         if($result['code'] == 0){
//             $data = $result['data'];
//             $_SESSION['user'] = $user;
//             $_SESSION['name'] = $data['firstname'] . " " . $data['lastname'];

//             header('Location: index.php');
//             exit();
//         }
//         else{
//             $error = $result['error'];
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    body {
        margin-top: 100px;
        background-color: lightblue;
        background-image: url('../assets/images/bg4.jpg');

    }

    .title {
        color: lightseagreen;
    }

    form {
        background-color: lightcyan;
        border-radius: 30px;
        padding: 20px;
    }

    label {
        font-weight: 500;
    }
</style>

<body>
    <div id="overloading"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h2 class="text-center mt-5 mb-3 title">User Login</h2>
                <form id="login-form" method="post" action="action.php" class="  w-100 mb-5 mx-auto px-3 pt-3 ">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="<?= $user ?>" name="user" id="user" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="pass" value="<?= $pass ?>" id="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group custom-control custom-checkbox">
                        <input <?= isset($_POST['remember']) ? 'checked' : '' ?> name="remember" type="checkbox" class="custom-control-input" id="remember">
                        <label class="custom-control-label" for="remember">Remember login</label>
                    </div>
                    <div class="form-group">
                        <!-- <?php
                                if (!empty($error)) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                                ?> -->
                        <div id='error'></div>
                        <input type="hidden" name="action" value="login">
                        <div class="form-group text-center">
                            <button class="btn btn-success px-5">Login</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Don't have an account yet? <a href="register.php">Register now</a>.</p>
                        <!-- <p>Forgot your password? <a href="forgot.php">Reset your password</a>.</p> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
    $().ready(function() {
        $('#login-form').validate({
            submitHandler: function(form) {

                // var form = $('#login-form').serialize;
                var x = $("#login-form").serializeArray();
                var url = $('#login-form').attr('action');
                $('#overloading').show();

                $.ajax({
                    type: 'post',
                    url: url,
                    data: $.param(x),
                    success: function(response) {
                        $('#overloading').hide();
                        $('#login-form').trigger('reset');
                        if (response == '') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Login successfully',
                                icon: 'success',
                                confirmButtonText: 'Cancel'
                            }).then((result) => {
                                window.location.href = 'index.php';
                            });

                        } else {
                            $('#error').html(`<div class='alert alert-danger'>${response}</div>`);
                        }
                    }
                })
                return false;
            }

        });

    });
</script>

</html>