<?php

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', ''); //123456
define('DB', 'demo');

function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connect error: ' .  $conn->connect_error);
    }
    return $conn;
}

function login($user, $pass)
{
    $sql = "SELECT * FROM account WHERE username = ? "; //AND password = ?
    $conn = open_database();

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $user);
    if (!$stmt->execute()) {
        return array('code' => 1, 'error' => 'Can not execute the command.'); //Chạy sql thất bại
    }
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return array('code' => 1, 'error' => 'User does not exists'); //Chạy sql và ko có user này trong db.
    }

    $data = $result->fetch_assoc();

    $hashed_password = $data['password'];

    if (!password_verify($pass, $hashed_password)) {
        return array('code' => 2, 'error' => 'Invalid password'); //Có user này nhưng sai mk.
    } else
        return array('code' => 0, 'error' => '', 'data' => $data);
}

function is_email_exist($email)
{
    $sql = "SELECT username FROM account WHERE email = ? "; //AND password = ?
    $conn = open_database();

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);

    if (!$stmt->execute()) {
        die('Query error: ' .  $stmt->error); //Chạy sql thất bại
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true; //Tồn tại email trong db.
    } else {
        return false;
    }
}

function register($user, $pass, $first, $last, $email)
{

    if (is_email_exist($email)) {
        return array('code' => 1, 'error' => 'Email exists');
    }

    $_SESSION['password'] = $pass;

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $rand = random_int(0, 1000);
    $token = ($user . "+" . $pass);

    $sql = "Insert into account(username, firstname, lastname, email, password, activate_token) values(?, ?, ?, ?, ?, ?)"; //AND password = ?
    $conn = open_database();

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $user, $first, $last, $email, $hash, $token);

    if (!$stmt->execute()) {
        return array('code' => 2, 'error' => 'Can not execute the command.');
    }
    return array('code' => 0, 'error' => 'Create account successful.');
}

function getProduct()
{
    $sql = "SELECT * FROM menu"; //AND password = ?
    $conn = open_database();

    $stmt = $conn->prepare($sql);

    if (!$stmt->execute()) {
        die('Query error: ' .  $stmt->error); //Chạy sql thất bại
    }
    $result = $stmt->get_result();

    $data = array();
    while ($d = $result->fetch_assoc()) {
        $data[] = $d;
    }
    return $data;
}
function getProducts($value)
{
    $sql = "SELECT * FROM menu WHERE name LIKE '%$value%' or description LIKE '%$value%'";
    $conn = open_database();

    $stmt = $conn->prepare($sql);

    if (!$stmt->execute()) {
        die('Query error: ' .  $stmt->error); //Chạy sql thất bại
    }
    $result = $stmt->get_result();

    $data = array();
    while ($d = $result->fetch_assoc()) {
        $data[] = $d;
    }
    return $data;
}

function change_password($email, $pass)
{
    $_SESSION['password'] = $pass;

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $rand = random_int(0, 1000);
    $token = md5($email . "+" . $rand);


    $sql = "UPDATE account Set activate_token = ?, password = ? WHERE email = ?";
    $conn = open_database();

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $pass, $hash, $email);

    if (!$stmt->execute()) {
        return array('code' => 2, 'error' => 'Can not execute the command.');
    }
    return array('code' => 0, 'error' => 'Change successfully.');
}

function change_product($pid, $name, $type, $price, $desc)
{

    $sql = "UPDATE menu Set name = ?,type = ?, price = ?, description = ? WHERE id = ?";
    $conn = open_database();

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssiss', $name, $type, $price, $desc, $pid);

    if (!$stmt->execute()) {
        return array('code' => 1, 'error' => 'Can not execute the command.');
    }
    return array('code' => 0, 'error' => ''); //Change successfully.
}

function add_product($name, $type, $price, $desc, $image)
{

    $img = $image['name'];
    $image_tmp = $image['tmp_name'];
    $target_dir = "images/";
    $target_file = $target_dir . $img;
    if (move_uploaded_file($image_tmp, $target_file)) {
        $sql = "INSERT into menu(name,type,price, description, image) values(?, ?, ?, ?, ?)";
        $conn = open_database();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiss', $name, $type, $price, $desc, $img);

        if (!$stmt->execute()) {
            return array('code' => 1, 'error' => 'Can not execute the command.');
        }
        return array('code' => 0, 'error' => ''); // Add product successfully.
    }
    return array('code' => 2, 'error' => "An error occurred while uploading the image file.");
}

function delete_product($pid)
{
    $sql = "DELETE FROM menu WHERE id = ?";
    $conn = open_database();

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $pid);

    if (!$stmt->execute()) {
        return array('code' => 1, 'error' => 'Can not execute the command.');
    }
    return array('code' => 0, 'error' => ''); //Delete successfully.
}
