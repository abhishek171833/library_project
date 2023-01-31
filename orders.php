<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Grayscale - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            // $( function() {
            //     $("#datepicker" ).datepicker({ minDate: 0});
            //     $("#datepicker2" ).datepicker({ minDate:0 });
            //     // $("#datepicker2" ).datepicker({ minDate:'+4d' });
            //     // $("#datepicker" ).datepicker();
            // } );
        </script>
    </head>
    <?php 
    session_start();
    if(isset($_SESSION['login_user'])){ ?>
    <body>
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./orders.php" method="post" id="cancel_order_form">
                    <input type="hidden" id="order_id" name="order_id">
                    <div class="mb-3">
                        <label for="book" class="form-label">Book Name</label>
                        <input type="text" class="form-control" id="book" disabled>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="input-group-prepend mb-1">
                                <span class="input-group-text" id="basic-addon1">From</span>
                            </div>
                            <input class="form-control" id="datepicker" disabled>
                        </div>
    
                        <div class="col-md-6 mb-2">
                            <div class="input-group-prepend mb-1">
                                <span class="input-group-text" id="basic-addon1">To</span>
                            </div>
                            <input class="form-control" id="datepicker2" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Order Status</label>
                        <input type="text" class="form-control" id="book_status" disabled>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="order-book" class="btn btn-primary">Cancel Order</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-secondary">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand text-warning" href="index.php">Library Management</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php
                        if(isset($_SESSION['login_user'])){?>
                    
                    <li class="nav-item d-flex align-items-center">
                            Welcome <?php echo $_SESSION['login_user']; ?>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><svg class="svg-inline--fa fa-user fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <i class="fas fa-user fa-fw"></i> Font Awesome fontawesome.com --></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="px-2"><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="album py-5 bg-light">
            <div class="container">
                <a href="welcome.php" class="btn btn-primary m-4">&#x2190; Back</a>
                <a href="books.php" class="btn btn-warning m-4">Order Books</a>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 m-4">


                    <?php 
                    require('db/conn.php');
                    $user_email = $_SESSION['login_user'];
                    $result = mysqli_query($db,"select user_id from users");
                    $user_id = $result->fetch_row()[0];
                    $sql = "select * from orders where user_id = $user_id and status != '2';";
                    $query2 = mysqli_query($db, $sql);
                    $query = mysqli_query($db, $sql);
                    $row2 = mysqli_fetch_assoc($query2);
                    if(!$row2){ ?>
                        <div class="col-md-12">Oops!No Orders Found <a href="books.php">click here to order book </a> </div>
                    <?php }
                    else{
                        while ($row = mysqli_fetch_assoc($query)){
                            $result = mysqli_query($db,"select book_name from books where id = $row[book_id];");
                            $book_name = $result->fetch_row()[0];?>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Thumbnail</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">Book Name : <?= $book_name ?></p>
                                <p class="card-text">Status : <?php if($row['status'] == 0){echo "Pending";}else if($row['status'] == 1){echo "Approved";}else{echo "Declined";} ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button data-id="<?= $row['id'] ?>" data-status="<?php if($row['status'] == 0){echo "Pending";}else if($row['status'] == 1){echo "Approved";}else{echo "Declined";}  ?>" data-to="<?= $row['to_date']?>" data-from="<?= $row['from_date'];?>" data-name="<?= $book_name ?>" data-bs-toggle="modal" data-bs-target="#bookModal" data-id="" type="button" class="p-3 text-light bg-success btn btn-sm btn-outline-secondary order-button">View Order Details</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </main>
</body>

<?php } else{?>
<script>
    setTimeout(() => {
        swal("Error!", "Please Login!", "error")
        .then(()=>{
            window.location.href = "index.php";
        })
    }, 500);
      
</script>
<?php }?>
<script>
     document.addEventListener("DOMContentLoaded", () => {
        let order_button = document.querySelectorAll(".order-button")
        order_button.forEach(element => {
            element.addEventListener("click",function(){
                let book_name = this.getAttribute('data-name')
                let from_date = this.getAttribute('data-from')
                let to_date = this.getAttribute('data-to')
                let book_status_val = this.getAttribute('data-status')
                let book_id_val = this.getAttribute('data-id')
                book.value = book_name
                datepicker.value = from_date
                datepicker2.value = to_date
                book_status.value = book_status_val
                order_id.value = book_id_val

                let order_but = document.getElementById("order-book")
                order_but.addEventListener("click",function(e){
                    e.preventDefault();
                    cancel_order_form.submit();
                })
            })
        });
    });
</script>
<?php if(isset($_POST['order_id'])){
            require('./db/conn.php');
            $res = mysqli_query($db,"UPDATE `orders` SET `status` = '2' WHERE `id` = '$_POST[order_id]'");
            if($res){?>
            <script>
                setTimeout(() => {
                    swal("Success!", "Your Order Has Been Cancelled Successfully", "success")
                })
            </script>
            <?php } ?>
        <?php } ?>
<?php ?>
