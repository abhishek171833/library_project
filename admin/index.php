<?php require("./header.php") ?>
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
<?php require("./footer.php") ?>
