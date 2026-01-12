<?php
    include('../dbcon.php');
    if (isset($_GET['uid'])){
        $uid = $_GET['uid'];

        $sql = "SELECT * FROM `order` WHERE `userId` = '$uid' and `status` LIKE 'Delivering'";
        $run = mysqli_query($conn, $sql);
        
        if($run == true){
            if(mysqli_num_rows($run) < 1)
            {
                $sql = "DELETE FROM `cart` WHERE `userId` = '$uid'";
                $run = mysqli_query($conn, $sql);
                if($run == true)
                {
                    $sql = "DELETE FROM `order` WHERE `userId` = '$uid'";
                    $run = mysqli_query($conn, $sql);
                    if($run == true)
                    {
                        $sql = "DELETE FROM `user` WHERE `userId` = '$uid'";
                        $run = mysqli_query($conn, $sql);
                        if($run == true)
                        {
                            ?>
                                <script type="text/javascript">
                                    alert("Account is deleted!");

                                    window.open('../components/logout.php','_self');
                                </script>
                            <?php
                        }
                        else{
                            echo "ERROR: $sql. " . mysqli_error($conn);
                            die();
                        }
                    }
                    else{
                        echo "ERROR: $sql. " . mysqli_error($conn);
                        die();
                    }
                }
                else{
                    echo "ERROR: $sql. " . mysqli_error($conn);
                    die();
                }
            }
            else{
                echo "<script> alert('There exists order(s) that be delivered!'); window.open('account.php','_self');</script>";
                die();
            }
        }
        else{
            echo "ERROR: $sql. " . mysqli_error($conn);
            die();
        }
    }
    else{
        die();
    }
    
?>