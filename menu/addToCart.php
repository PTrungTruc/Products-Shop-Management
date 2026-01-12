
<?php
session_start(); // Start the session

// Include the database connection
include '../dbcon.php';
if (!isset($_SESSION['uid'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../components/login.php");
    exit(); // Stop further execution
}

if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $uid = $_SESSION['uid'];
    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE `userId` = '$uid'");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

// Check if the user ID is set in the session
if (isset($_POST['pid'], $_POST['pname'], $_POST['pprice'], $_POST['pqty'])) {
    // Retrieve user ID and product details from the POST request
    $uid = $_SESSION['uid'];
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pqty = $_POST['pqty'];

    // Calculate the total
    $total = ($pprice) * ($pqty);

    // Check if the item already exists in the cart for the current user
    $stmt_check = $conn->prepare("SELECT menuId, qty, total FROM cart WHERE userId = ? AND menuId = ?");
    if ($stmt_check) {
        $stmt_check->bind_param("ii", $uid, $pid);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Item already exists, so update the quantity and total
            $row = $result_check->fetch_assoc();
            $existing_id = $row['menuId'];
            $existing_qty = $row['qty'];
            $existing_total = $row['total'];

            // Calculate new total quantity and total
            $new_qty = $existing_qty + $pqty;
            $new_total = ($existing_total + $total);

            // Update the quantity and total in the cart
            $stmt_update = $conn->prepare("UPDATE cart SET qty = ?, total = ? WHERE menuId = ?");
            if ($stmt_update) {
                $stmt_update->bind_param("idi", $new_qty, $new_total, $existing_id);
                $stmt_update->execute();
                $stmt_update->close();
            } else {
                echo "Error preparing update SQL statement: " . $conn->error;
            }
        } else {
            // Item does not exist, so insert a new row
            $stmt_insert = $conn->prepare("INSERT INTO cart (userId, menuId, itemName, price, qty, total) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt_insert) {
                $stmt_insert->bind_param("iissii", $uid, $pid, $pname, $pprice, $pqty, $total);
                $stmt_insert->execute();
                $stmt_insert->close();
                // Output a success message (optional)
                echo "Item added to cart successfully!";
            } else {
                echo "Error preparing insert SQL statement: " . $conn->error;
            }
        }
        $stmt_check->close(); // Close the check statement
    } else {
        echo "Error preparing check SQL statement: " . $conn->error;
    }
} else {
    // Redirect to login page if user is not logged in
    // header("Location: ../components/login.php");
    // exit(); // Stop further execution
}
