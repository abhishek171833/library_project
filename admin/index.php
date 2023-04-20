<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
            <!-- Navbar Brand-->
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
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Books
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add-book.php">Add Book</a>
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
                            <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <b>Admin</b></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <h2 class="container my-5 text-center">Library Management - Dashboard</h2>
                <div class="row mx-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4>Total Books</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `books`");
                                    $total_books=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_books?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h4>Available Books</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `books` where quantity != 0 ");
                                    $total_books=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_books?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><h4>Total Users</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `users`");
                                    $total_users=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_users?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h4>Total Orders</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `orders`");
                                    $total_orders=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_orders?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><h4>Total Pending Orders</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `orders` where status = '0'");
                                    $total_pending_orders=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_pending_orders?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4>Total Approved Orders</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `orders` where status = '1'");
                                    $total_approved_orders=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_approved_orders?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><h4>Total Declined Orders</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `orders` where status = '2'");
                                    $total_declined_orders=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_declined_orders?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h4>Total Completed Orders</h4>
                                </div>
                                <?php 
                                    require('db/conn.php');
                                    $res=mysqli_query($db,"SELECT count(*) FROM `orders` where status = '3'");
                                    $total_completed_orders=$res->fetch_row()[0];
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_completed_orders?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Library Management 2023</div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
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
</html>
