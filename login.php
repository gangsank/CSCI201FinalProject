<?php require_once 'controllers/authenticate.php'; ?>

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

	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="container">

		<form action="" method="POST">

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
				<div class="col-sm-9 mt-3">
					<button type="submit" name = "login_btn" class="btn btn-primary">Log In</button>
				</div>
			</div> <!--form-group -->

			<div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="register_form.php">Create an account</a>
				</div>
			</div> <!--row -->

			<script>

			// Client-Side Authentication
			document.querySelector('form').onsubmit = function(){
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
