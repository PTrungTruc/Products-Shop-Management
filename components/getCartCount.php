<?php
session_start();

include('../dbcon.php');

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $query = "SELECT COUNT(*) AS count FROM cart WHERE userId = '$uid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['count'];
} else {
    echo 0; // If user is not logged in, cart count is 0
}
