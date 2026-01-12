<style>
    .site-header {
        padding: 60px;
        margin-left: 0;
    }

    .header-menu,
    .logo-img {
        margin-right: 300px;
    }
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
            <div class="col-lg-12">
                <div class="main-navigation">
                    <div class="header-logo">
                        <a href="index.php">
                            <img src="..\assets\images\logo.png" width="100" height="200" alt="Logo">
                        </a>
                    </div>
                    <button class="menu-toggle"><span></span><span></span></button>
                    <nav class="header-menu">
                        <ul class="menu food-nav-menu">
                            <li><a href="user/view_users.php">View Users</a></li>
                            <li><a href="menu.php">View Menu</a></li>
                            <li><a href="order/view_orders.php">View Orders</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </nav>
                    <div class="header-right">
                        <!-- <form action="#" class="header-search-form for-des">
                            <input type="search" class="form-input" placeholder="Search Here...">
                            <button type="submit">
                                <i class="uil uil-search"></i>
                            </button>
                        </form>

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
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>