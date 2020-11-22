<<<<<<< HEAD:login.php
<?php require_once 'controllers/authenticate.php'; ?>

=======
>>>>>>> 7b55b1553d84dbb74c189ac20dd7ec43b0dc1791:login.html
<!DOCTYPE html>
<html>
<head>
	<title>Piazza 2.0</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link
      href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Yeseva+One&family=Work+Sans:ital,wght@0,300;0,400;1,300;1,400&display=swap"
      rel="stylesheet"
    />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light thistle">
    <a class="navbar-brand" href="#">Piazza 2.0</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

<<<<<<< HEAD:login.php
	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="container">
=======
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#"
            >Home <span class="sr-only">(current)</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.html">Login / Logout</a>
        </li>
      
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
      </form>
    </div>
  </nav>
	<div class="container-fluid" style = "margin-top: 5%;">
>>>>>>> 7b55b1553d84dbb74c189ac20dd7ec43b0dc1791:login.html

		<div class="row chatheader">
			<h1 class="col-sm-12 col-lg-8 col-md-8 col-12" >Welcome to Piazza 2.0!</h1>
		</div> 

		<form action="index.html" method="POST">
			<div class="form-group row" style = "margin-top: 5%;">
				<label for="username-id" class="col-sm-3 col-lg-5 col-md-3 col-4 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label>
				<div class="col-sm-5 col-lg-3 col-md-3 col-5">
					<input type="email" class="form-control" id="username-id" name="username" placeholder="ttrojan@usc.edu">
					<small id="email-error" class="invalid-feedback">Username is required.</small>
				</div>
			</div> <!--form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-lg-5 col-md-3 col-4 col-form-label text-sm-right">Password: <span class="text-danger">*</span></label>
				<div class="col-sm-5 col-lg-3 col-md-3 col-5">
					<input type="password" class="form-control" id="password-id" name="password" placeholder="password">
					<small id="password-error" class="invalid-feedback">Password is required.</small>
				</div>
			</div> <!--form-group -->

			<div class="row chatheader">
				<div class="col-sm-9">
					<span class="text-danger font-italic" >* Required</span>
				</div>
			</div> <!--form-group -->

<<<<<<< HEAD:login.php
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-3">
					<button type="submit" name = "login_btn" class="btn btn-primary">Log In</button>
				</div>
			</div> <!--form-group -->

			<div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="register_form.php">Create an account</a>
=======
			<div class="form-group row chatheader">
			
					<button type="submit" class="btn btn-primary seagreen" style = "margin-top: 5%;">Log In</button>
		
			</div> <!--form-group -->

			<div class="row chatheader">
				<div class="col-sm-9">
					<a href="register_form.php" style = "color:SEAGREEN;">Create an account</a>
>>>>>>> 7b55b1553d84dbb74c189ac20dd7ec43b0dc1791:login.html
				</div>
			</div> <!--row -->
		</form>
	</div>


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