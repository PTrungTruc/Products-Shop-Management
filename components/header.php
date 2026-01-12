<?php
// session_start();
if (isset($_SESSION['uid'])) {
    include('dbcon.php');
    $uid = $_SESSION['uid'];
    $query = "SELECT * FROM `user` WHERE `id` = '$uid'";
    $run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($run);

    $name = $data['name'];
    $email = $data['email'];

    // lấy bảng cart menu id
    $query1 = "SELECT * FROM `cart` WHERE `userId` = '$uid'";
    $run1 = mysqli_query($conn, $query1);
    $cartId = array();
    while ($data1 = mysqli_fetch_assoc($run1)) {
        $cartId[] = $data1['menuId'];
    }
    $_SESSION['cartId'] = $cartId;
} else {
}

?>
<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-navigation">
                    <div class="header-logo">
                        <a href="home.php">
                            <img src="assets\images\logo.png" width="200" height="200" alt="Logo">
                        </a>
                    </div>
                    <button class="menu-toggle"><span></span><span></span></button>
                    <nav class="header-menu">
                        <ul class="menu food-nav-menu">
                            <li><a href="home.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li class="namer"><a href="#menu">Menu</a></li>
                            <li><a id="cartOnlyShowForRes" href="menu/cart.php">Cart</a></li>
                            <li><a href="menu\order.php">Order</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="header-right">
                        <form action="home.php" method="get" class="header-search-form for-des">
                            <input name="search" type="search" class="form-input" placeholder="Search Here...">
                            <button type="submit">
                                <i class="uil uil-search"></i>
                            </button>
                        </form>
                        <div class="icon-cart">
                            <a href="menu/cart.php" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span class="cart-number" id="add-to-cart">
                                    <?php
                                    if (isset($_SESSION['cartId'])) {
                                        echo (count($_SESSION['cartId']));
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </div>
                        <a href="javascript:void(0)" class="header-btn" id="user-btn">
                            <i class="uil uil-user-md"></i>
                        </a>

                        <div class="user-box">
                            <?php
                            if (isset($_SESSION['uid'])) {
                            ?>
                                <p>Username : <span> <?php echo $name;
                                                        ?></span></p>
                                <p>Email : <span> <?php echo $email;
                                                    ?></span></p>
                                <a href="account/account.php" class="btn">Acccount</a>
                                <a href="components\logout.php" class="btn logout-btn">Log out</a>
                            <?php
                            } else {
                            ?>
                                <a href="components\login.php" class="btn">login</a>
                                <a href="components\register.php" class="btn">register</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>