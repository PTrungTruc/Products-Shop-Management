<?php
include 'dbcon.php';
$stmt = $conn->prepare("SELECT * FROM menu");
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    if (!is_numeric($search)) {
        $query = "SELECT * FROM menu WHERE name LIKE '%$search%' OR type =  '$search'";
    } else {
        $query = "SELECT * FROM menu WHERE name LIKE '%$search%' OR type =  '$search' OR (ABS(price - $search) < 2)";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<section id="menu" style="background-image: url(assets/images/menu-bg.png);" class="our-menu section bg-light repeat-img">
    <div class="sec-wp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title text-center mb-5">
                        <p class="sec-sub-title mb-3">Our menu</p>
                        <h2 class="h2-title">Rolling Freshness, <span>Savor the Sea: Dive into Our Sushi Delights</span></h2>
                        <div class="sec-title-shape mb-4">
                            <img src="assets/images/title-shape.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-tab-wp">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="menu-tab text-center">
                            <ul class="filters">
                                <div class="filter-active"></div>
                                <li class="filter" data-filter=".all, .tempura, .maki, .nigiri">
                                    <img class="menu-icon" src="assets\images\menu-icon1.png" alt="">
                                    All
                                </li>
                                <li class="filter" data-filter=".tempura">
                                    <img class="menu-icon" src="assets/images/menu-icon3.png" alt="">
                                    Tempuras
                                </li>
                                <li class="filter" data-filter=".maki">
                                    <img class="menu-icon" src="assets/images/menu-icon4.png" alt="">
                                    Maki Rolls
                                </li>
                                <li class="filter" data-filter=".nigiri">
                                    <img class="menu-icon" src="assets/images/menu-icon2.png" alt="">
                                    Sashimi & Nigiri
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-list-row">
                <div id="successBox" class="success-box">
                    <i class="fas fa-check"></i> Item added to cart successfully!
                </div>
                <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div style="margin-right: 10px;" class="col-lg-4 col-sm-6 dish-box-wp card <?= $row['type'] ?>" data-cat="<?= $row['type'] ?>">
                            <div class="dish-box text-center">
                                <div class="dist-img">
                                    <img class="dish-img" src="assets/images/dish/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                                </div>
                                <div class="dish-title">
                                    <h3 class="h3-title"><?= $row['name'] ?></h3>
                                </div>
                                <div class="dish-bottom-row">
                                    <div class="dish-price">
                                        <h2>$ <?= $row['price'] ?></h2>
                                    </div>
                                    <form action="" class="form-submit">

                                        <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                        <input type="hidden" class="pname" value="<?= $row['name'] ?>">
                                        <input type="hidden" class="pprice" value="<?= $row['price'] ?>">
                                        <input type="hidden" class="pimage" value="<?= $row['image'] ?>">
                                        <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                                            cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
    $(document).ready(function() {
        var cartnumber = document.getElementById('add-to-cart');
        // Send product details to the server when Add to Cart button is clicked
        $(".addItemBtn").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var pname = $form.find(".pname").val();
            var pprice = $form.find(".pprice").val();


            var pqty = 1;
            var uid = <?php echo isset($_SESSION['uid']) ? $_SESSION['uid'] : 'null'; ?>; // Retrieve user ID from session
            // Check if the user ID is null
            if (uid === null) {
                // Redirect to login page
                window.location.href = 'components/login.php';
                return; // Stop further execution
            }

            // Send AJAX request to insert item into cart table
            $.ajax({
                url: 'menu/addToCart.php', // Specify the URL of your PHP script to handle the insertion
                method: 'POST',
                data: {
                    uid: uid, // Include user ID in the data
                    pid: pid,
                    pname: pname,
                    pprice: pprice,
                    pqty: pqty
                },
                success: function(response) {
                    // Handle success response if needed
                    console.log(response);
                    // Display the success box
                    var $successBox = $("#successBox");
                    $successBox.fadeIn(0);
                    // Move the success box upwards and fade out after 2 seconds
                    $successBox.animate({
                        top: "-=500px", // Move the box upwards by 50 pixels
                        opacity: 0 // Fade out the box
                    }, 2000, function() {
                        // Animation complete, hide the box and reset its position and opacity
                        $successBox.hide().css({
                            top: "+=500px",
                            opacity: 1
                        });
                    });

                }
            });

            function load_cart_item_number() {
                $.ajax({
                    url: 'menu/addToCart.php',
                    method: 'GET',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#add-to-cart").html(response);
                    }
                });
            }

            load_cart_item_number();
        });


    });


    // load_cart_item_number();
</script>