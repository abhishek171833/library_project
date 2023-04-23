<?php 
if(isset($_POST['book_name'])){
    require('db/conn.php');
    if(isset($_POST["image_file_input"])){
        $file_name = $_FILES['image_file_input']['name'];
        $file_size =$_FILES['image_file_input']['size'];
        $file_tmp =$_FILES['image_file_input']['tmp_name'];
        $file_type=$_FILES['image_file_input']['type'];
        
        $path = "./assets/img/books";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        move_uploaded_file($file_tmp,"assets/img/books/".$file_name);
        $file_path_name = "assets/img/books/".$file_name;

        if(!empty($_POST['book_id'])){
            $res = mysqli_query($db,"UPDATE `books` SET `image_path` = '$file_path_name'  WHERE `books`.`id` = $_POST[book_id];");
        }
    }
    if(!empty($_POST['book_id'])){
        $res = mysqli_query($db,"UPDATE `books` SET `book_name` = '$_POST[book_name]', `author` = '$_POST[author]', `edition` = '$_POST[edition]' , `quantity` = '$_POST[quantity]', `department` = '$_POST[department]', `description` = '$_POST[description]' WHERE `books`.`id` = $_POST[book_id];");
        $message['message'] = "Book Updated Successfully";
    }
    else{
        if(isset($_POST["image_file_input"])){
            $res = mysqli_query($db,"INSERT INTO `books` (`book_name`, `author`,`edition`,`quantity`,`department`,`description`,`image_path`) VALUES ('$_POST[book_name]', '$_POST[author]','$_POST[edition]','$_POST[quantity]','$_POST[department]','$_POST[description]','$file_path_name')");
        }
        else{
            $res = mysqli_query($db,"INSERT INTO `books` (`book_name`, `author`,`edition`,`quantity`,`department`,`description`,`image_path`) VALUES ('$_POST[book_name]', '$_POST[author]','$_POST[edition]','$_POST[quantity]','$_POST[department]','$_POST[description]','assets/img/books/home.jpg')");

        }
        $message['message'] = "Book Added Successfully";
    }
    if($res){
        $message['status'] = 1;
        echo json_encode($message);
        exit();
    }
    else{
        $message['status'] = 0;
        $message['message'] = "Something Went Wrong";
        echo json_encode($message);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | LibraryManagement</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
            <div class="d-flex">
                <a class="navbar-brand ps-3" href="index.html">Library Management</a>
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            </div>
            <div class="d-flex">
                <!-- Navbar Search-->
                <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form> -->
                <!-- Navbar-->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="px-2"><a class="dropdown-item" href="#!">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link active" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Admin Settings</div>
                            <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Books
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link active" href="add-book.php">Add Book</a>
                                    <a class="nav-link" href="manage-books.php">Manage Books</a>
                                    <a class="nav-link" href="manage-orders.php">Manage Book Orders</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="manage-users.php">Manage Users</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <b>Admin</b></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="container p-4 w-75">
                    <?php if(!isset($book['book'])){?>
                    <h2>Add book</h2>
                    <?php } else{?>
                    <h2>Edit book</h2>
                    <?php }?>
                    <form id="book_form">
                        <div class="row">
                            <?php
                                if(isset($_GET['book_id'])){
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT * FROM `books` WHERE id='$_GET[book_id]';");
                                    $book=$res->fetch_row();
                                }
                            ?>    
                            <div class="form-group mb-3 mt-2 col-md-6">
                                <label for="book_name">Book Name</label>
                                <input value="<?php if(isset($book[1])){echo $book[1];}?>" type="text" class="form-control" id="book_name" name="book_name" placeholder="Enter book name">
                            </div>
                            <div class="form-group mb-3 mt-2 col-md-6">
                                <label for="author">Author</label>
                                <input name="author" value="<?php if(isset($book[2])){echo $book[2];}?>" type="text" class="form-control" id="author" placeholder="Enter book author">
                            </div>
                            <div class="form-group mb-3 mt-2 col-md-6">
                                <label for="edition">Edition</label>
                                <input name="edition" value="<?php if(isset($book[4])){echo $book[4];}?>" type="text" class="form-control" id="edition" placeholder="Enter book edition">
                            </div>
                            <div class="form-group mb-3 mt-2 col-md-6">
                                <label for="quantity">Quantity</label>
                                <input name="quantity" value="<?php if(isset($book[5])){echo $book[5];}?>" type="number" class="form-control" id="quantity" placeholder="Enter book quantity name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="formFile" class="form-label">Book Image File</label>
                                <input class="form-control" type="file" id="image_file_input" style="height:unset;"  accept="image/*" name="image_file_input">
                            </div>
                            <div class="form-group mb-3 mt-2 col-md-6">
                                <label for="department">Department</label>
                                <input name="department" value="<?php if(isset($book[6])){echo $book[6];}?>" type="text" class="form-control" id="department" placeholder="Enter book department">
                            </div>
                            <div class="mb-3 col-md-6">
                                <img class="w-75" id="book_img" src="<?php if(isset($book[3])){echo "./".$book[3];}else{echo "../assets/img/home.jpg";}?>" alt="book image" style="width:250px;">
                            </div>
                            <div class="form-group mb-3 mt-2 col-md-6">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="7"><?php if(isset($book[7])){echo $book[7];}else{echo "";}?></textarea>
                            </div>
                        </div>
                        
                        <button data-id="<?php if(isset($book[0])){echo $book[0];}else{echo "";}?>" id="book_btn" type="submit" class="btn btn-success"><?php if(isset($book[0])){echo "Update Book";}else{echo "Add Book";}?></button>
                    </form>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <script>
        $('document').ready(function () {
            $("#image_file_input").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#book_img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        document.getElementById("book_btn").addEventListener("click",async function(e){
            e.preventDefault();
            let formData = new FormData(book_form);
            let id = this.getAttribute("data-id");
            if(book_name.value == ""){
                swal("Warning!","Please Enter Book Name!","warning")
            }
            else if(author.value == ""){
                swal("Warning!","Please Enter Book Author Name!","warning")
            }
            else if(edition.value == ""){
                swal("Warning!","Please Enter Book Edition!","warning")
            }
            else if(quantity.value == ""){
                swal("Warning!","Please Enter Book Quantity!","warning")
            }
            else if(department.value == ""){
                swal("Warning!","Please Enter Book Department!","warning")
            }
            else if(description.value == ""){
                swal("Warning!","Please Enter Book Description!","warning")
            }
            else{
                formData.append('book_id',id)
                formData.append('book_name',book_name.value)
                formData.append('author',author.value)
                formData.append('edition',edition.value)
                formData.append('quantity',quantity.value)
                formData.append('department',department.value)
                formData.append('description',description.value.trim())

                if(image_file_input.value != ""){
                    formData.append('image_file_input',image_file_input.value)
                }
                let fetch_res = await fetch("add-book.php",{
                    method:"POST",
                    body:formData
                })
                let json_res = await fetch_res.json();
                if(json_res.status){
                    swal("Success!",json_res.message,"success")
                    document.getElementById("book_form").reset();
                    setTimeout(() => {
                        window.location.href = 'manage-books.php';
                    }, 2000);
                }
                else{
                    swal("Error!",json_res.message,"error")
                    document.getElementById("book_form").reset();
                }
            }
        })
    </script>
</html>
