<?php
require_once '../../dbcon.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM `order` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: view_orders.php");
    exit();
}
?>