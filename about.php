<?php
session_start();
// include 'components/connection.php';
?>
<style type="text/css">
    <?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <!-- for icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- fancy box  -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
</head>

<body class="body-fixed">
    <?php include 'components/header.php'; ?>
    <section class="about-sec section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title text-center mb-5">
                        <p class="sec-sub-title mb-3">About Us</p>
                        <h2 class="h2-title">Discover our <span>restaurant story</span></h2>
                        <div class="sec-title-shape mb-4">
                            <img src="assets/images/title-shape.svg" alt="">
                        </div>
                        <p>Welcome to Tokyo Sushi Station, your go-to destination for exceptional sushi that's all about the taste! We take pride in delivering a sushi experience that's not just delicious but also uniquely crafted.

                            Enjoy the best sushi in Karachi & Islamabad delivered to your doorstep..</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="about-video">
                        <div class="about-video-img" style="background-image: url(assets/images/banner1.png);">
                        </div>
                        <div class="play-btn-wp">
                            <a href="assets/images/video.mp4" data-fancybox="video" class="play-btn">
                                <i class="uil uil-play"></i>

                            </a>
                            <span>Watch The Recipe</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/alert.php'; ?>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/font-awesome.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.mixitup.min.js"></script>
    <script src="assets/js/jquery.fancybox.min.js"></script>
    <script src="assets/js/parallax.min.js"></script>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <script src="assets/js/ScrollToPlugin.min.js"></script>
    <script src="main.js"></script>
    <script>
        document.getElementById('user-btn').addEventListener('click', function() {
            let userBox = document.querySelector('.user-box');
            userBox.classList.toggle('active');
        });
    </script>


</body>

</html>