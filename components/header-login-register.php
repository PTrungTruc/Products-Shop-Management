<style>
    .site-header {
        padding: 60px;
        margin-left: 0;
    }

    .header-menu {
        margin-right: 200px;
    }

    /* .header-right {
        float: right;
        margin-left: 40px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    } */
</style>
<script>
    $(document).ready(function($) {
        jQuery(".menu-toggle").click(function() {
            jQuery(".main-navigation").toggleClass("toggled");
        });
    });
</script>
<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="header-section">
                <div class="main-navigation">
                    <div class="header-logo">
                        <a href="..\home.php">
                            <img class="logo-img" src="..\assets\images\logo.png" alt="Logo">
                        </a>
                    </div>
                    <button class="menu-toggle"><span></span><span></span></button>
                    <nav class="header-menu">
                        <ul class="menu food-nav-menu">
                            <li><a href="..\home.php">Home</a></li>
                            <li><a href="..\about.php">About</a></li>
                            <li><a href="..\home.php">Menu</a></li>
                            <li><a href="..\menu\order.php">Order</a></li>
                            <li><a href="..\home.php#contact">Contact</a></li>
                            <?php
                            if (isset($_SESSION['uid'])) {
                                echo "<li><a href='logout.php'>Log Out</a></li>";
                            }
                            ?>
                            <!-- <li><a href="logout.php">Log Out</a></li> -->
                        </ul>
                    </nav>
                    <div class="header-right">

                        <a href="../menu/cart.php" class="header-btn header-cart">
                            <i class="uil uil-shopping-bag"></i>
                            <span class="cart-number">
                                <?php
                                if (isset($_SESSION['cartId'])) {
                                    echo (count($_SESSION['cartId']));
                                } else {
                                }
                                ?>
                            </span>
                        </a>
                        <a href="../account/account.php" class="header-btn" id="user-btn">
                            <i class="uil uil-user-md"></i>
                        </a>

                        <!-- <div class="user-box">
                            <?php
                            if (isset($_SESSION['uid'])) {
                            ?>
                                <p>Username : <span> <?php echo $name;
                                                        ?></span></p>
                                <p>Email : <span> <?php echo $email;
                                                    ?></span></p>
                                <a href="account/account.php" class="btn">Acccount</a>
                                <a href="components\logout.php" class="logout-btn">Log out</a>
                            <?php
                            } else {
                            ?>
                                <a href="components\login.php" class="btn">login</a>
                                <a href="components\register.php" class="btn">register</a>
                            <?php
                            }
                            ?>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>