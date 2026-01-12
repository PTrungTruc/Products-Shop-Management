<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
require_once('../db.php');

// if(isset($_POST['action'])&&isset($_POST['product-id'])){
//     $action = $_POST['action'];
//     $pid = $_POST['product-id'];

//     if($action == "delete-product"){
//         $result = delete_product($pid);
//         $error = $result['error'];
//         echo "<script>alert('$error')</script>";
//     }
//     elseif($action == "update-product"){
//         if(isset($_POST['name'])&&isset($_POST['price'])&&isset($_POST['desc']))
//         {
//             $name = $_POST['name'];
//             $price = $_POST['price'];
//             $desc = $_POST['desc'];
//             $result = change_product($pid, $name, $price, $desc);
//             $error = $result['error'];
//             echo "<script>alert('$error')</script>";
//         }
//         else{
//             echo "<script>alert('Invalid information.')</script>";
//         }
//     }
// }
?>
<style type="text/css">
    <?php include '../style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        td {
            vertical-align: middle;
        }

        img {
            max-height: 100px;
        }

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

        tr:nth-child(even) {
            background-color: #88accf;
        }

        tr:nth-child(odd) {
            background-color: #2b3f96;
            color: white;

        }

        .title {
            background-color: #2e2eb0;
            color: white;
        }
        .add-btn{
            background-color: lightskyblue;
            color: black;
            font-weight: 500;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <?php include 'menu/header-admin.php'; ?>
    <div id="overloading"></div>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col col-md-10">
                <h1 style="font-weight: 1000; margin-top:150px" class="text-center">Menu</h1>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-sm btn-secondary mb-4 add-btn">Add Product</button>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-search"></span>
                        </span>
                    </div>
                    <input id="search-box" type="text" class="form-control" placeholder="Search">
                </div>
                <div id="display-product">
                    <table class="table-bordered table table-hover text-center">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>

                        <?php
                        $product = getProduct();
                        foreach ($product as $p) {
                        ?>
                            <tr>
                                <td class="align-middle"><img src="images/<?= $p['image'] ?>"></td>
                                <td class="align-middle"><?= $p['name'] ?></td>
                                <td class="align-middle"><?= $p['type'] ?></td>
                                <td class="align-middle"><?= number_format($p['price']) ?> $</td>
                                <td class="align-middle"><?= $p['description'] ?></td>
                                <td class="align-middle">
                                    <button onclick="updateP('<?= $p['id'] ?>', '<?= $p['name'] ?>','<?= $p['type'] ?>', '<?= $p['price'] ?>', '<?= $p['description'] ?>')" class="btn btn-sm btn-primary mr-1 edit-btn"><i class="fas fa-pen"></i></button>
                                    <button onclick="deleteP('<?= $p['id'] ?>', '<?= $p['name'] ?>')" class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                </div>
                <p class="text-right">Total products: <strong id="count-product"><?= count($product) ?></strong></p>
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="action.php" id="form-delete-product" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <hp class="modal-title">Delete a Product</hp>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong id="delete-product">iPhone XS MAX</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="product-id" value="" id="delete-input">
                        <input type="hidden" name="action" value="delete-product">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- Edit Confirm Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">Update product <strong id="edit-product">iPhone XS MAX</strong></hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="action.php" id="form-update-product">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input name="name" id="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Type</label>
                            <input name="type" id="type" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input name="price" id="price" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input name="desc" id="desc" type="text" class="form-control">
                        </div>
                        <input type="hidden" name="product-id" value="" id="update-input">
                        <input type="hidden" name="action" value="update-product">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Add Confirm Modal -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">Add new food</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" id='form-add-product' action="action.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Food Name</label>
                            <input name="name" id="name" type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input name="type" id="type" type="text" class="form-control" placeholder="Type">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea id="desc" name="desc" rows="4" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input name="price" id="price" type="number" class="form-control" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="customFile" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose the image</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id='error-add-product'></div>
                            <input type="hidden" name="action" value="add-product">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        function deleteP(id, product) {
            let label = $('#delete-product');

            label.html(product);
            $('#delete-input').val(id);
            $('#deleteModal').modal({
                backdrop: 'static',
                keyboard: false
            });

        }

        function updateP(id, product, price, des) {
            let label = $('#edit-product');


            label.html(product);
            $('#name').val(product);
            $('#type').val(type);
            $('#price').val(price);
            $('#desc').val(des);
            $('#update-input').val(id);


            $('#editModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        $(document).ready(function() {

            $("#search-box").on("keyup", function() {
                var value = $(this).val().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/đ/g, 'd').replace(/Đ/g, 'D');

                $.ajax({
                    type: 'post',
                    url: 'action.php',
                    data: {
                        action: 'search',
                        value: value
                    },
                    dataType: "json",
                    success: function(response) {

                        display_input(response);
                        // $('#display-product').append('</table>');
                    }
                })
            });

            function display_input(array) {
                // console.log(value['name']);
                var display = $('#display-product');
                var string = `<table class="table-bordered table table-hover text-center">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>`;
                array.forEach(function(value) {
                    string = string + `
                        <tr>
                            <td class="align-middle"><img src="images/${value['image']}"></td>
                            <td class="align-middle">${value['name']}</td>
                            <td class="align-middle">${value['type']}</td>
                            <td class="align-middle">${value['price'].toLocaleString(window.document.documentElement.lang)} $</td>
                            <td class="align-middle">${value['description']}</td>
                            <td class="align-middle">
                                <button onclick="updateP('${value['id']}', '${value['name']}','${value['type']}', '${value['price']}', '${value['description']}')" class="btn btn-sm btn-primary mr-1 edit-btn"><i class="fas fa-pen"></i></button>
                                <button onclick="deleteP('${value['id']}', '${value['name']}')" class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    `;
                });
                string = string + '</table>';
                display.html(string);
                $('#count-product').html(array.length);
            }
            // show add confirm
            $(".add-btn").click(function() {
                $('#addModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
            $('#addModal').on('hidden.bs.modal', function() {
                $('#form-add-product')[0].reset();
                $(".custom-file-input").siblings(".custom-file-label").removeClass("selected").html('Choose the image');
                $('#error-add-product').html('');
            })
            // $('#myModal').modal('hide');

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });


            $('#form-add-product').submit(function(form) {
                var url = $('#form-add-product').attr('action');
                $('#overloading').show();
                var formData = new FormData($("#form-add-product")[0]);
                $.ajax({
                    type: 'post',
                    url: url,
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        $('#overloading').hide();
                        if (jQuery.type(response) != "array") {
                            $('#error-add-product').html(`<div class='alert alert-danger'>${response}</div>`);
                        } else {
                            $('#form-add-product').trigger('reset');
                            $(".custom-file-input").siblings(".custom-file-label").removeClass("selected").html('Choose the image');
                            display_input(response);
                            $('#addModal').modal('hide');
                        }
                    }
                })
                return false;
            });

            $('#form-update-product').submit(function(form) {
                var url = $('#form-update-product').attr('action');
                $('#overloading').show();
                var formData = new FormData($("#form-update-product")[0]);
                $.ajax({
                    type: 'post',
                    url: url,
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        $('#overloading').hide();
                        if (jQuery.type(response) != "array") {
                            // $('#error-add-product').html(`<div class='alert alert-danger'>${response}</div>`);
                            // alert(response);
                            Swal.fire({
                                title: 'Error!',
                                text: response,
                                icon: 'error',
                                confirmButtonText: 'Cancel'
                            }).then((result) => {

                            });
                        } else {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Update successfully',
                                icon: 'success',
                                confirmButtonText: 'Cancel'
                            }).then((result) => {
                                display_input(response);
                                $('#editModal').modal('hide');
                            });

                        }
                    }
                })
                return false;
            });

            $('#form-delete-product').submit(function(form) {
                var url = $('#form-delete-product').attr('action');
                $('#overloading').show();
                var formData = new FormData($("#form-delete-product")[0]);
                $.ajax({
                    type: 'post',
                    url: url,
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        $('#overloading').hide();
                        if (jQuery.type(response) != "array") {
                            // $('#error-add-product').html(`<div class='alert alert-danger'>${response}</div>`);
                            Swal.fire({
                                title: 'Error!',
                                text: response,
                                icon: 'error',
                                confirmButtonText: 'Cancel'
                            })
                        } else {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Delete successfully',
                                icon: 'success',
                                confirmButtonText: 'Cancel'
                            }).then((result) => {
                                display_input(response);
                                $('#deleteModal').modal('hide');
                            });
                        }
                    }
                })
                return false;
            });

        });
    </script>

</body>

</html>