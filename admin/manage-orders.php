<?php 
    require('db/conn.php');
    if(isset($_POST['order_id'])){
        $sql = "UPDATE `orders` SET `status` = '$_POST[book_status]' WHERE `id` = $_POST[order_id];";
        $query = mysqli_query($db, $sql);
        if($query){
        $res['status'] = 1;
        $res['message'] = 'Order Status Changes Succussfully';
        echo json_encode($res);
        exit();
    } 
    else{
        $res['status'] = 0;
        $res['message'] = 'Some Error Occured';
        echo json_encode($res);
        exit();
    }} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | LibraryManagement</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>
            .select{
                cursor:pointer;
            }
        </style>
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
                            <a class="nav-link" href="index.php">
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
                                    <a class="nav-link" href="add-book.php">Add Book</a>
                                    <a class="nav-link" href="manage-books.php">Manage Books</a>
                                    <a class="nav-link active" href="manage-orders.php">Manage Book Orders</a>
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
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Book Orders</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol> -->
                        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Manage book orders
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>User</th>
                                            <th>Book Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    require('db/conn.php');
                                    $sql = "select * from orders;";
                                    $query2 = mysqli_query($db, $sql);
                                    $query = mysqli_query($db, $sql);
                                    $row2 = mysqli_fetch_assoc($query2);
                                    if(!$row2){ ?>
                                        <div class="col-md-12">Oops!No Orders Found</div>
                                    <?php }
                                    else{
                                        while ($row = mysqli_fetch_assoc($query)){ ?>
                                        <tr>
                                            <td><?=$row['id']?></td>
                                            <?php 
                                            $result = mysqli_query($db,"select email_address from users where user_id = $row[user_id];");
                                            $username = $result->fetch_row()[0]; ?>
                                            <td><?=$username?></td>
                                            <?php 
                                            $result = mysqli_query($db,"select book_name from books where id = $row[book_id];");
                                            $book_name = $result->fetch_row()[0]; ?>
                                            <td><?=$book_name?></td>
                                            <td><?=$row['from_date']?></td>
                                            <td><?=$row['to_date']?></td>
                                            <td>

                                            <select data-id="<?=$row['id']?>" class="form-select select" id="book_status">
                                                <?php if($row['status'] == 0){ ?>
                                                    <option selected value="0" class="text-warning">Pending</option>
                                                    <option  value="1" class="text-success">Approve</option>
                                                    <option  value="2" class="text-danger">Deline</option>
                                                <?php } else if($row['status'] == 1){ ?>
                                                    <option selected value="1" class="text-success">Approved</option>
                                                    <option  value="2" class="text-danger">Deline</option>
                                                    <option  value="3" class="text-primary">complete</option>
                                                <?php } else if($row['status'] == 2){ ?>
                                                    <option selected value="2" class="text-danger">Delined</option>
                                                    <option  value="1" class="text-success">Approve</option>
                                                <?php } else if($row['status'] == 3){ ?>
                                                    <option selected value="3" class="text-primary">completed</option>
                                                <?php } ?>
                                            </select>
                                            </td>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Library Management 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                const select_box = document.querySelectorAll(".select");
                select_box.forEach(element => {
                    element.addEventListener("change",async function(e){
                        let order_id = this.getAttribute("data-id")
                        let data = new FormData();
                        let book_status_val = this;
                        data.append("order_id",order_id)
                        data.append("book_status",book_status_val.value)
                        let response = await fetch("manage-orders.php",{
                            method:'post',
                            body:data
                        })
                        let json_res = await response.json();
                        if(json_res.status){
                            swal('Success!',json_res.message,'success').then(()=>{
                                location.reload();
                            })
                        }
                        else{
                            swal('Error!',json_res.message,'error')
                        }
                    })
                });
            }, 0);
        })
    </script>
</html>
