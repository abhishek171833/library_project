<?php 
// Admin login functionality
if(isset($_POST['email'])){
	require('./db/db.php');
	$res=mysqli_query($db,"SELECT * FROM `users` WHERE email='$_POST[email]' && password='$_POST[password]' && type = '1';");
	$count=mysqli_num_rows($res);
	if($count){
		session_start();
		$_SESSION['login_admin'] = $_POST['email'];
		$message['status'] = 1;
		$message['message'] = "You Logged In Successfully!";
		echo json_encode($message);
		exit();
	}
	else{
		$message['status'] = 0;
		$message['message'] = "Email Or Password Does Not Match!!";
		echo json_encode($message);
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LibraryManagement | Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
	<style>
		.password-eye{
            float: right;
            margin-right: 8px;
            margin-top: -35px;
            position: relative;
            /* z-index: 2; */
        }
	</style>
</head>
<body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
	$(document).ready(function() {
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
    });

	let admin_login_btn = document.getElementById("admin_login")
	admin_login_btn.addEventListener("click",async function(e){
		e.preventDefault();

		let formData = new FormData(admin_login_form);
		if(email.value == ""){
			swal("Warning!","Please Enter Email!","warning")
			email.focus();
		}
		else if(password.value == ""){
			swal("Warning!","Please Enter Password!","warning")
			password.focus();
		}
		else{
			formData.append('email',email.value)
			formData.append('password',password.value)
			let fetch_res = await fetch("login.php",{
				method:"POST",
				body:formData
			})
			let json_res = await fetch_res.json();
			if(json_res.status){
				swal("Success!",json_res.message,"success").
				then(()=>{
					window.location.href = "./index.php";
				})
				document.getElementById("contactForm").reset();
			}
			else{
				swal("Error!",json_res.message,"error")
			}
		}
	})
</script>
</html>