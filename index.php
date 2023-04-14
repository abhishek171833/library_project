
 <?php 
 session_start();
    if(isset($_SESSION['login_user'])){
        header('Location: welcome.php');
    }?>
  <?php
        if(isset($_POST['lemail'])){
            require('./db/conn.php');
            $res=mysqli_query($db,"SELECT * FROM `users` WHERE email_address='$_POST[lemail]' && Password='$_POST[lpassword]';");
            $count=mysqli_num_rows($res);
            if($count){
                $_SESSION['login_user'] = $_POST['lemail'];
                $message['status'] = 1;
                $message['message'] = "You Logged In Successfully!";
                echo json_encode($message);
                exit();
            }
            else{
                $message['status'] = 0;
                $message['message'] = "Email Or Password Does Not Match!";
                echo json_encode($message);
                exit();

            }
        }

        if(isset($_POST['first_name'])){
            require('./db/conn.php');

            $res=mysqli_query($db,"SELECT email_address FROM `users` WHERE email_address='$_POST[email]';");
            $email=mysqli_num_rows($res);

            $res=mysqli_query($db,"SELECT phone_no FROM `users` WHERE phone_no='$_POST[phone]';");
            $phone=mysqli_num_rows($res);

            if($_POST['password'] != $_POST['cpassword']){
                $message['status'] = 0;
                $message['message'] = "Password And Confirm Password Does Not Match!";
                echo json_encode($message);
                exit();
            }
            if($email){
                $message['status'] = 0;
                $message['message'] = "User With This Email Already Exists!";
                echo json_encode($message);
                exit();
            }
            if($phone){
                $message['status'] = 0;
                $message['message'] = "User With This Phone Number Already Exists!";
                echo json_encode($message);
                exit();
            }
            else{
                mysqli_query($db,"INSERT INTO `USERS` (`first_name`, `last_name`,`username`,`password`,`address`,`phone_no`,`email_address`) VALUES('$_POST[first_name]', '$_POST[last_name]', '$_POST[username]', '$_POST[password]', '$_POST[address]', '$_POST[phone]', '$_POST[email]');");

                $message['status'] = 1;
                $message['message'] = "Sign Up Successfully Now You Can Log In!";
                echo json_encode($message);
                exit();
            }
        }
?>
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
        <style>
            .password-eye{
                float: right;
                margin-right: 8px;
                margin-top: -25px;
                position: relative;
                /* z-index: 2; */
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Library Management</a>
                <button id="menu_button" class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login_form">
                        <div class="mb-3">
                            <label for="lemail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="lemail" aria-describedby="emailHelp" name="lemail" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="lpassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="lpassword" name="lpassword" required>
                            <img toggle="#lpassword" src="./assets/img/eye-open.png" alt="" class="password-eye" style="width:25px;cursor:pointer;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="login_btn" type="button" class="btn btn-primary">Log In</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sign_up_form">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" aria-describedby="emailHelp" name="name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="roll_no" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <img toggle="#password" src="./assets/img/eye-open.png" alt="" class="password-eye" style="width:25px;cursor:pointer;">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="cpassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                                <img toggle="#cpassword" src="./assets/img/eye-open.png" alt="" class="password-eye" style="width:25px;cursor:pointer;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="sign_up_btn" type="button" class="btn btn-primary">Sign Up</button>
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
      <a class="footer-icon p-2" href="https://facebook.com" target="_blank">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a class="footer-icon p-2" href="https://twitter.com" target="_blank">
        <i class="fab fa-twitter"></i>
      </a>
      <a class="footer-icon p-2" href="https://instagram.com" target="_blank">
        <i class="fab fa-instagram"></i>
      </a>
      <a class="footer-icon p-2" href="https://linkedin.com" target="_blank">
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
          <p><i class="fas fa-home me-3 text-secondary"></i> Mumbai, NY 10012, IN</p>
          <p>
            <i class="fas fa-envelope me-3 text-secondary"></i>
            library@management.com
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
    © 2023 Copyright:
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </body>
    <script>
        window.addEventListener('DOMContentLoaded', event => {

            // password eye toggle 
            $(".password-eye").click(function () {
				let src = this.getAttribute("src");
                if(src == "./assets/img/eye-open.png"){
                    this.setAttribute("src","./assets/img/eye-close.png")
                }
                else{
                    this.setAttribute("src","./assets/img/eye-open.png")
                }
				let input = $($(this).attr("toggle"));
				if (input.attr("type") == "password") {
					input.attr("type", "text");
				} else {
					input.attr("type", "password");
				}
			});

            // sign form submission 
            let signUp_button = document.getElementById("sign_up_btn")
            signUp_button.addEventListener("click",async function(e){
                // e.preventDefault();

                let sign_up_form = document.getElementById("sign_up_form");
                let formData = new FormData(sign_up_form);

                if(first_name.value == ""){
                    swal("Warning!","Please Enter First Name!","warning")
                    first_name.focus();
                }
                else if(last_name.value == ""){
                    swal("Warning!","Please Enter Last Name!","warning")
                    last_name.focus();
                }
                else if(username.value == ""){
                    swal("Warning!","Please Enter Username!","warning")
                    username.focus();
                }
                else if(email.value == ""){
                    swal("Warning!","Please Enter Email!","warning")
                    email.focus();
                }
                else if(!validateEmail(email.value)){
                    swal("Warning!","Please Enter Valid Email!","warning")
                    email.focus();
                }
                else if(phone.value == ""){
                    swal("Warning!","Please Enter Phone Number!","warning")
                    phone.focus();
                }
                else if(!isValidPhone(phone.value)){
                    swal("Warning!","Please Enter Valid Phone Number!","warning")
                    phone.focus();
                }
                else if(address.value == ""){
                    swal("Warning!","Please Enter Address!","warning")
                    address.focus();
                }
                else if(password.value == ""){
                    swal("Warning!","Please Enter Password!","warning")
                    password.focus();
                }
                else if(password.value.length<8){
                    swal("Warning!","The Password Must Be at Least 8 Characters Long. Please Make Sure Your Password Meets This Requirement!","warning")
                    password.focus();
                }
                else if(!checkPassword(password.value)){
                    swal("Warning!","The Password Must Be at Least 8 Characters Long and Contain at Least One Lowercase Letter, One Uppercase Letter, One Digit, and One Special Character (!@#$%^&*). Please Make Sure Your Password Meets These Requirements!","warning")
                    password.focus();
                }
                else if(password.value != cpassword.value){
                    swal("Warning!","The Passwords Entered Do Not Match. Please Verify That You Have Entered the Same Password in Both Fields!","warning")
                    password.focus();
                }
                else if(cpassword.value == ""){
                    swal("Warning!","Please Enter Confirm Password!","warning")
                    cpassword.focus();
                }
                else{
                    formData.append('first_name',first_name.value)
                    formData.append('last_name',last_name.value)
                    formData.append('username',username.value)
                    formData.append('email',email.value)
                    formData.append('phone',phone.value)
                    formData.append('address',address.value)
                    formData.append('password',password.value)
                    formData.append('cpassword',cpassword.value)
                    let fetch_res = await fetch("index.php",{
                        method:"POST",
                        body:formData
                    })
                    let json_res = await fetch_res.json();
                    if(json_res.status){
                        sign_up_form.reset();
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

            // Login form submission
            let login_button = document.getElementById("login_btn")
            login_button.addEventListener("click",async function(e){
                // e.preventDefault();

                let login_form = document.getElementById("login_form");
                let formData = new FormData(sign_up_form);

                if(lemail.value == ""){
                    swal("Warning!","Please Enter Email!","warning")
                    lemail.focus();
                }
                else if(lpassword.value == ""){
                    swal("Warning!","Please Enter Password!","warning")
                    lpassword.focus();
                }
                else{
                    formData.append('lemail',lemail.value)
                    formData.append('lpassword',lpassword.value)
                    let fetch_res = await fetch("index.php",{
                        method:"POST",
                        body:formData
                    })
                    let json_res = await fetch_res.json();
                    if(json_res.status){
                        swal("Success!",json_res.message,"success").
                        then(()=>{
                            location.reload();
                        })
                        login_form.reset();
                    }
                    else{
                        swal("Error!",json_res.message,"error")
                        login_form.reset();
                    }
                }
            })
        })

        // Phone Number Expression 
        function isValidPhone(p_number) {
            var phoneRe = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
            var digits = p_number.replace(/\D/g, "");
            return phoneRe.test(digits);
        }

        // Email Address Expression
        const validateEmail = (email) => {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        };

        // Password Expression 
        function checkPassword(password){
            let pattern = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            return pattern.test(password);
        }
    </script>
</html>
