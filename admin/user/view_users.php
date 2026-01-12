<?php
require_once '../../dbcon.php';

$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
$result = $stmt->get_result();
?>
<style type="text/css">
    <?php include '../../style.css'; ?>
</style>
<!DOCTYPE html>
<html>

<head>
    <title>View Users</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>


    <script src="main.js"></script>
    <style>
        body {
            background-image: url('../../assets/images/table-leaves-shape.png');
        }

        .site-header {
            padding: 60px;
            margin-left: 0;
        }

        .header-menu,
        .logo-img {
            margin-right: 100px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #bfd9f4
        }

        .title {
            background-color: #2e2eb0;
            color: white;
        }
    </style>
</head>

<body>
    <?php include '../user/header-admin.php'; ?>

    <div style="margin-top: 300px;" class="container">
        <h1 style="font-weight: 1000;" class="text-center">User Lists</h1>
        <div style="overflow-x:auto;">
            <table>
                <tr>
                    <th class="title">ID</th>
                    <th class="title">Tên</th>
                    <th class="title">Số điện thoại</th>
                    <th class="title">Địa chỉ</th>
                    <th class="title">Email</th>
                    <th class="title">Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><a class="btn-danger p-2 rounded deleteUser" href="delete_user.php?id=<?= $row['id'] ?>">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.deleteUser').click(ev => {
            const alert = confirm('Are you sure you want to delete user ?');
            return alert;
        });
    });
</script>

</html>