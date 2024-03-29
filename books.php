<?php 
    session_start();
    if(isset($_POST['book_id'])){
            require('./db/conn.php');
            $user_email = $_SESSION['login_user'];
            $result = mysqli_query($db,"select user_id from users");
            $user_id = $result->fetch_row()[0];

            mysqli_query($db,"INSERT INTO `orders` (`user_id`, `book_id`,`from_date`,`to_date`,`datetime`) VALUES ('$user_id', '$_POST[book_id]','$_POST[from_date]','$_POST[to_date]', current_timestamp());");

            $count = mysqli_query($db,"UPDATE `books` SET `quantity` = `quantity` - 1 WHERE `id` = '$_POST[book_id]' AND `quantity` > 0;");


            if($count){
                $message['status'] = 1;
                $message['message'] = "Book Orderd Successfully!";
                echo json_encode($message);
                exit();
            }
            else{
                $message['status'] = 0;
                $message['message'] = "Something Went Wrong!";
                echo json_encode($message);
                exit();

            }
     } ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Library | Books</title>
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
    </head>
    <?php 
    if(isset($_SESSION['login_user'])){ ?>
    <body>
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order This Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="order_form">
                    <input type="hidden" id="book_id" name="book_id">
                    <div class="mb-3">
                        <label for="book_name" class="form-label">Book Name</label>
                        <input type="text" class="form-control" id="book_name" aria-describedby="emailHelp" name="book_name" disabled>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="input-group-prepend mb-1">
                                <span class="input-group-text" id="basic-addon1">From</span>
                            </div>
                            <input type="date" class="form-control" id="datepicker" name="from_date" onchange="setMinDate();">
                        </div>
    
                        <div class="col-md-6 mb-2">
                            <div class="input-group-prepend mb-1">
                                <span class="input-group-text" id="basic-addon1">To</span>
                            </div>
                            <input type="date" class="form-control" id="datepicker2" name="to_date">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="order-book" class="btn btn-primary">Order Book</button>
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
                <a href="orders.php" class="btn btn-warning m-4">View Your Orders</a>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 m-4">
                <?php 
                    require('db/conn.php');
                    $sql = "select * from books;";
                    $query = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_assoc($query)){?>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img class="w-100" src="./admin/<?=$row['image_path']?>" alt="book image" style="height:250px;">
                            <div class="card-body">
                                <p class="card-text"><b>Book Name :</b> <?= $row['book_name'] ?></p>
                                <div class="card-text"><b>Book Description :</b> <p><?=  substr($row['description'], 0, 100)."...";?></p></div>
                                <div class="d-flex justify-content-between align-items-center">
                                <?php if($row['quantity'] < 1){?>
                                    <div class="btn-group">
                                        <button data-id="<?= $row['id']?>" type="button" class="p-3 btn btn-sm btn-outline-secondary bg-danger text-light" disabled>Book Is Unavailable</button>
                                    </div>
                                <?php } else { ?>
                                    <div class="btn-group">
                                        <button data-name="<?= $row['book_name']?>" data-bs-toggle="modal" data-bs-target="#bookModal" data-id="<?= $row['id']?>" type="button" class="p-3 text-light bg-success btn btn-sm btn-outline-secondary order-button">Oder book</button>
                                    </div>
                                <?php } ?>
                                    <!-- <small class="text-muted">9 mins</small> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
        setMinDateOnFirstDate();
        let order_button = document.querySelectorAll(".order-button")
        order_button.forEach(element => {
            element.addEventListener("click",function(){
                let id = this.getAttribute('data-id')
                let book = this.getAttribute('data-name')
                let book_id = this.getAttribute('data-id')
                let book_name = document.getElementById("book_name")
                let book_id_el = document.getElementById("book_id")
                book_name.value = book
                book_id_el.value = book_id
                let order_but = document.getElementById("order-book")
                order_but.addEventListener("click",async function(e){
                    e.preventDefault();
                    let book_order_form = document.getElementById("order_form");
                    let formData = new FormData(book_order_form);
                    let from_date = document.getElementById("datepicker")
                    let to_date = document.getElementById("datepicker2")
                    if(from_date.value == ""){
                        swal("Error!", "Please Choose Order Date", "error")
                    }
                    else if(to_date.value == ""){
                        swal("Error!", "Please Choose Return Date", "error")
                    }
                    else{
                        formData.append('book_id',book_id)
                        formData.append('from_date',from_date.value)
                        formData.append('to_date',to_date.value)

                        let fetch_res = await fetch("books.php",{
                            method:"POST",
                            body:formData
                        })
                        let json_res = await fetch_res.json();
                        if(json_res.status){
                            book_order_form.reset();
                            swal("Success!",json_res.message,"success").
                            then(()=>{
                                location.reload();
                            })
                        }
                        else{
                            swal("Error!",json_res.message,"error")
                        }
                    }
                })
            })
        });
    });

    // Set the to date from the from date on user selection 
    function setMinDate() {
        // Get the value of the first input field
        const date1 = document.getElementById("datepicker").value;
        
        // Set the minimum date for the second input field to the selected date in the first input field
        document.getElementById("datepicker2").setAttribute("min", date1);

    }
    function setMinDateOnFirstDate(){
        // Get today's date and format it as a string
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        const yyyy = today.getFullYear();
        const todayString = yyyy + '-' + mm + '-' + dd;
        // Set the minimum date for the first input field to today's date
        document.getElementById("datepicker").setAttribute("min", todayString);
    }

</script>