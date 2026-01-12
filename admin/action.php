<?php
    session_start();
    // if (!isset($_SESSION['user'])) {
    //     header('Location: login.php');
    //     exit();
    // }
    require_once('../db.php');

    $error = '';

    if(isset($_POST['action'])&&isset($_POST['product-id'])){
        $action = $_POST['action'];
        $pid = $_POST['product-id'];
        $error = '';

        if($action == "delete-product"){
            $result = delete_product($pid);
            $error = $result['error'];
            if($error == ''){
                $data = getProduct();
                echo json_encode($data);
                exit();
            }
        }
        elseif($action == "update-product"){
            if(isset($_POST['name'])&&isset($_POST['type'])&&isset($_POST['price'])&&isset($_POST['desc']))
            {
                $name = $_POST['name'];
                $type = $_POST['type'];
                $price = $_POST['price'];
                $desc = $_POST['desc'];
                $result = change_product($pid, $name,$type, $price, $desc);
                $error = $result['error'];
                if($error == ''){
                    $data = getProduct();
                    echo json_encode($data);
                    exit();
                }
            }
            else{
                $error = "Invalid information";
            }
        }
        echo json_encode($error);
        exit();
    }

    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $error = '';

        if($action == "login"){
            $user = '';
            $pass = '';

            if (isset($_POST['user']) && isset($_POST['pass'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                if (empty($user)) {
                    $error = 'Please enter your username';
                }
                else if (empty($pass)) {
                    $error = 'Please enter your password';
                }
                else if (strlen($pass) < 6) {
                    $error = 'Password must have at least 6 characters';
                }
                else{
                    $result = login($user, $pass);

                    if($result['code'] == 0){
                        $data = $result['data'];
                        $_SESSION['user'] = $user;
                        $_SESSION['name'] = $data['firstname'] . " " . $data['lastname'];

                        // header('Location: index.php');
                        // exit();
                    }
                    else{
                        $error = $result['error'];
                    }
                }
            }
            else{
                $error = 'Invalid value';
            }
            echo $error;
            exit();
        }
        if($action == "register"){
            if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
            && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pass-confirm']))
            {
                $first_name = $_POST['first'];
                $last_name = $_POST['last'];
                $email = $_POST['email'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $pass_confirm = $_POST['pass-confirm'];

                if (empty($first_name)) {
                    $error = 'Please enter your first name';
                }
                else if (empty($last_name)) {
                    $error = 'Please enter your last name';
                }
                else if (empty($email)) {
                    $error = 'Please enter your email';
                }
                else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                    $error = 'This is not a valid email address';
                }
                else if (empty($user)) {
                    $error = 'Please enter your username';
                }
                else if (empty($pass)) {
                    $error = 'Please enter your password';
                }
                else if (strlen($pass) < 6) {
                    $error = 'Password must have at least 6 characters';
                }
                else if ($pass != $pass_confirm) {
                    $error = 'Password does not match';
                }
                else {
                    // register a new account
                    $result = register($user, $pass, $first_name, $last_name, $email);
                    if($result['code'] == 0){
                        // Success

                        // header('Location: login.php');
                        
                        //die("Success");
                    }
                    else if($result['code'] == 1){
                        $error = "This email is already exists.";
                    }
                    else{
                        $error = "An error occured. Try again.";
                    }
                }
            }
            echo ($error);
            exit();
        }
        if($action == 'search'){
            $data = array();
            if (isset($_POST['value'])){
                $value = $_POST['value'];
                if (empty($value)) {
                    $data = getProduct();
                }
                else{
                    $data = getProducts($value);
                }
            }  
            echo json_encode($data);
            exit();
        }
        if($action == 'add-product'){
            if (isset($_POST['name'])&& isset($_POST['type']) && isset($_POST['price']) && isset($_POST['desc']))
            {
                $name = $_POST['name'];
                $type = $_POST['type'];
                $price = $_POST['price'];
                $desc = $_POST['desc'];

                if(!empty($_FILES['image'])){
                    $image = $_FILES['image'];
                }

                if (empty($name)) {
                    $error = 'Please enter the product name';
                }
                else if (empty($type)) {
                    $error = 'The product type is invalid';
                }
                else if (intval($price) <= 0) {
                    $error = 'The price is invalid';
                }
                else if (empty($desc)) {
                    $error = 'Please enter the product description';
                }
                else if(empty($_FILES['image'])){
                    $error = 'Please upload photos of the product';
                }
                else if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
                    $error = 'Please upload photos of the product';
                }
                else {
                    $result = add_product($name,$type, $price, $desc, $image);
                    if($result['code'] == 0){
                        $message = $result['error'];
                        $data = getProduct();
                        echo json_encode($data);
                        exit();
                    }
                    else{
                        $error = $result['error'];
                    }
                }
            }
        }
        echo json_encode($error);
        exit();
    }

    echo $error;
?>