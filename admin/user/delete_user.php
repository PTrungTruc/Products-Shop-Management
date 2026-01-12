<?php
require_once '../../dbcon.php';
session_start();
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
//     $stmt->bind_param("i", $id);
//     $stmt->execute();

//     header("Location: view_users.php");
//     exit();
// }
if (isset($_GET['id'])) {
    $uid = $_GET['id'];

    $sql = "SELECT * FROM `order` WHERE `userId` = '$uid' and `status` LIKE 'Delivering'";
    $run = mysqli_query($conn, $sql);

    if ($run == true) {
        if (mysqli_num_rows($run) < 1) {
            $sql = "DELETE FROM `cart` WHERE `userId` = '$uid'";
            $run = mysqli_query($conn, $sql);
            if ($run == true) {
                $sql = "DELETE FROM `order` WHERE `userId` = '$uid'";
                $run = mysqli_query($conn, $sql);
                if ($run == true) {
                    $sql = "DELETE FROM `user` WHERE `id` = '$uid'";
                    $run = mysqli_query($conn, $sql);
                    if ($run == true) {
?>
                        <script type="text/javascript">
                            alert("This user is deleted!");
                            <?php
                            foreach ($_SESSION as $key => $val) {

                                if ($key !== 'admin') {

                                    unset($_SESSION[$key]);
                                }
                            }
                            ?>
                            window.open('../menu/menu.php', '_self');
                        </script>
<?php
                    } else {
                        echo "ERROR: $sql. " . mysqli_error($conn);
                        die();
                    }
                } else {
                    echo "ERROR: $sql. " . mysqli_error($conn);
                    die();
                }
            } else {
                echo "ERROR: $sql. " . mysqli_error($conn);
                die();
            }
        } else {
            echo "<script> alert('There exists order(s) of this user that be still delivered!'); window.open('menu.php','_self');</script>";
            die();
        }
    } else {
        echo "ERROR: $sql. " . mysqli_error($conn);
        die();
    }
} else {
    die();
}
?>