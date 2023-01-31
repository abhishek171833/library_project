
 <?php 
 session_start();
    if(isset($_SESSION['login_user'])){
        header('Location: welcome.php');
    }?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Library Management</title>
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
    </head>
    <?php
        if(isset($_POST['lemail'])){
        require('./db/conn.php');
        $res=mysqli_query($db,"SELECT * FROM `users` WHERE email_address='$_POST[lemail]' && Password='$_POST[lpassword]';");
        $count=mysqli_num_rows($res);
        if($count):
            $_SESSION['login_user'] = $_POST['lemail']; ?>

            <script>
                setTimeout(() => {
                    swal("Success!", "You Logged In Successfully!", "success")
                    .then(()=>{
                        window.location.href = "welcome.php";
                    })
                }, 1000);
            </script>
            
            <?php else:?>
            <script>
                setTimeout(() => {
                    swal("Error!", "Email Or Password Does Not Match!", "error");
                }, 1000);
            </script>
        <?php  endif;
        }

        if(isset($_POST['name'])){
            require('./db/conn.php');
            $res=mysqli_query($db,"SELECT email_address FROM `users` WHERE email_address='$_POST[email]';");
            $email=mysqli_num_rows($res);

            
            $res=mysqli_query($db,"SELECT phone_no FROM `users` WHERE phone_no='$_POST[phone]';");
            $phone=mysqli_num_rows($res);

            if($_POST['password'] != $_POST['cpassword']):?>
                <script>
                    setTimeout(() => {
                        swal("Warning!", "Password And Confirm Password Does Not Match!", "warning");
                    }, 1000);
                </script>

            <?php 

            elseif ($email): ?>
                <script>
                    setTimeout(() => {
                        swal("Warning!", "User With This Email Already Exists!", "warning");
                    }, 1000);
                </script>
            <?php 


            elseif($phone): ?>
                <script>
                    setTimeout(() => {
                        swal("Warning!", "User With This Phone Number Already Exists!", "warning");
                    }, 1000);
                </script>

            <?php else:
                    mysqli_query($db,"INSERT INTO `USERS` VALUES('$_POST[name]', '$_POST[last_name]', '$_POST[username]', '$_POST[password]', '$_POST[roll_no]', '$_POST[phone]', '$_POST[email]');");?>
                    <script>
                        setTimeout(() => {
                            swal("Success!", "Sign Up Successfully Now You Can Log In!", "success");
                        }, 1000);
                    </script>
                <?php
              endif;
            }
        ?>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Library Management</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
                        <?php if(isset($_SESSION['login_user'])){?>
                        <a class="nav-link" style="cursor:pointer;" href="logout.php">Logout</a>
                        <?php } else { ?>
                            <a class="nav-link" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</a>
                        <a class="nav-link" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./index.php" method="post">
                        <div class="mb-3">
                            <label for="lemail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="lemail" aria-describedby="emailHelp" name="lemail" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="lpassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="lpassword" name="lpassword" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Log In</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" action="./index.php" method="post">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="last_name" name="username" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="email" name="phone" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="roll_no" class="form-label">Roll No.</label>
                            <input type="number" class="form-control" id="roll_no" name="roll_no" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <!-- Masthead-->
        <header class="masthead" id="home">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Library</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">I have always imagined that Paradise will be a kind of a Library</h2>
                        <a class="btn btn-success" href="#about">Learn More</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="about-section text-center py-3" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Library Management</h2>
                        <p class="text-white-50">
                        Library Management is the adaptation of the principles and techniques of management to the library situation. It includes decision making and getting the work done by others. The five fundamental management functions are: Planning, Organizing, Staffing, Leading and Controlling
                        </p>
                    </div>
                </div>
                <img class="img-fluid" src="assets/img/main_library.png" alt="..." />
            </div>
        </section>
        <!-- Contact-->
        <!-- Footer -->
       <!-- Footer -->
<footer class="text-center text-lg-start bg-dark text-muted" id="footer">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a class="footer-icon p-2" href="youtube.com">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a class="footer-icon p-2" href="youtube.com">
        <i class="fab fa-twitter"></i>
      </a>
      <a class="footer-icon p-2" href="youtube.com">
        <i class="fab fa-instagram"></i>
      </a>
      <a class="footer-icon p-2" href="youtube.com">
        <i class="fab fa-linkedin"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-6 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3 text-secondary"></i>Library Management
          </h6>
          <p>
          Library Management is the adaptation of the principles and techniques of management to the library situation. It includes decision making and getting the work done by others. The five fundamental management functions are: Planning, Organizing, Staffing, Leading and Controlling
          </p>
        </div>
        <div class="col-md-6 mx-auto mb-md-0 mb-4 text-center">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3 text-secondary"></i> New York, NY 10012, US</p>
          <p>
            <i class="fas fa-envelope me-3 text-secondary"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" >Library Management</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
<!-- Footer -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
