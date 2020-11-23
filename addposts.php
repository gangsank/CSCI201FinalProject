<?php

session_start(); 
require "config/db.php";
$errors = array();

if(isset($_POST['guest_btn']))
{
	$_SESSION["guest"] = true;
	header("Location: main.php");
}

// if user clicks login button
else if(isset($_POST['login_btn'])){

	//setting variable names as assigned in the login.php
	$Username = $_POST['username'];
	$Password = $_POST['password'];

	//Client Authentication
	if(empty($Username)){
		$errors['Username'] = "Username required";
	}
	if(!filter_var($Username, FILTER_VALIDATE_EMAIL)){
		$errors['Username'] = "Invalid username";
	}
	if(empty($Password)){
		$errors['Password'] = "Password required";
	}
	
	$sql = "SELECT * FROM users
						WHERE Username = '" . $Username . "' AND Password = '" . $Password. "';";
			
	$results = $conn->query($sql);

	if(!$results) {
		echo $conn->error;
		exit();
	}

	if($results->num_rows == 1)
	{
		//login user
		$_SESSION['Username'] = $user['Username'];
		$_SESSION['Status'] = $user['Status'];
		$_SESSION['CourseEnrolled'] = $user['Course'];
		$_SESSION["logged_in"] = true;
		header("Location: main.php");
	}
	
	else {
		$errors['login_error'] = "Invalid username or password";
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Piazza 2.0</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Piazza 2.0</h1>
		</div> 
	</div> 

	<?php if( isset($errors) && count($errors) > 0): ?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="container">

		<form action="index.php" method="POST">

			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="username-id" name="username" placeholder="ttrojan@usc.edu">
					<small id="email-error" class="invalid-feedback">Username is required.</small>
				</div>
			</div> <!--form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password-id" name="password" placeholder="password">
					<small id="password-error" class="invalid-feedback">Password is required.</small>
				</div>
			</div> <!--form-group -->

			<div class="row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> <!--form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-4 mt-3">
					<button type="submit" name = "login_btn" class="btn btn-primary">Log In</button>
				</div>
			</div> <!--form-group -->

			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<button type="submit" name = "guest_btn" class="btn btn-info">Guest</button>
				</div>
			</div>
	

			<div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="register_form.php">Create an account</a>
				</div>
			</div> <!--row -->

		</form>

	</div>


			<script>

			// Client-Side Authentication
			document.querySelector('.btn-primary').onclick = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) 
			{
				document.querySelector('#username-id').classList.add('is-invalid');
			} 
			else 
			{
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) 
			{
				document.querySelector('#password-id').classList.add('is-invalid');
			} 
			else 
			{
				document.querySelector('#password-id').classList.remove('is-invalid');
			}
			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>
