<?php
require_once '../../dbcon.php';

$stmt = $conn->prepare("SELECT o.id, u.name, o.total, o.status, o.detail, o.note, o.address, o.phone FROM `order` o JOIN user u ON o.userId = u.id");
$stmt->execute();
$result = $stmt->get_result();
?>
<style type="text/css">
    <?php include '../../style.css'; ?>
</style>
<!DOCTYPE html>
<html>

<head>
    <title>View Orders</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <style>
        body {
            background-color: #e4f1ff;
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
            /* border-collapse: collapse; */
            width: 90%;
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

        tr:nth-child(even) {
            background-color: #b3d0ee;
        }

        tr:nth-child(odd) {
            background-color: #2b3f96;
            color: white;

        }

        .title {
            background-color: #2e2eb0;
            color: white;
        }
    </style>

</head>

<body>
    <?php include '../order/header-admin.php'; ?>

    <div style="margin-top: 200px;" class="contain">
        <h1 style="font-weight: 1000;" class="text-center">Order Lists</h1>
        <div style="overflow-x:auto;">
            <table align="center">
                <tr>
                    <th class="title">ID</th>
                    <th class="title">Customer</th>
                    <th class="title">Total</th>
                    <th class="title">Status</th>
                    <th class="title">Detail</th>
                    <th class="title">Note</th>
                    <th class="title">Address</th>
                    <th class="title">Phone number</th>
                    <th class="title">Update status</th>
                    <th class="title">Delete</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : 
                    $color_btn = "btn-warning";
                    if ($row['status'] == "Delivering") {
                        $color_btn = "btn-info";
                    } elseif ($row['status'] == "Cancelled") {
                        $color_btn = "btn-danger";
                    } elseif ($row['status'] == "Delivered") {
                        $color_btn = "btn-success";
                    }
                ?>
                    <tr>
                        
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['total'] ?></td>
                        <td > 
                            <div class="rounded-3 <?php echo $color_btn ?>"><?= $row['status'] ?></div>
                        </td>
                        <td><?= $row['detail'] ?></td>
                        <td><?= $row['note'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><a class="btn-success p-2 rounded" href="update_order_status.php?id=<?= $row['id'] ?>">Update</a></td>
                        <td><?php if ($row['status'] == 'Cancelled' || $row['status'] == 'Delivered') : ?>
                                <a class="btn-danger p-2 rounded" href="delete_order.php?id=<?= $row['id'] ?>">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>

</html>