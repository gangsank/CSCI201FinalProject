<?php 
session_start();
require 'config/db.php';
$errors = array();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Posts</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<form action="addposts.php" method="POST">
			<h1 class="col-12 mt-4 mb-4">Add Posts</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</div>
<?php endif; ?>

	<div class="container">

			<div class="form-group row">
				<label for="title" class="col-sm-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="title" class="form-control" id="title" name="title" >
					<small id="email-error" class="invalid-feedback">Title is required.</small>
				</div>
			</div> <!--form-group -->	

			<div class="form-group row">
				<label for="content" class="col-sm-3 col-form-label text-sm-right">Content: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="content" class="form-control" id="content" name="content" >
					<small id="password-error" class="invalid-feedback">Content is required.</small>
				</div>
			</div> <!--form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-3">
					<button type="submit" name = "post_btn" class="btn btn-primary">Post</button>
				</div>
			</div>
		</div>

</div>
</form>
</div>
</div>
</body>
</html>

<?php

if(isset($_POST['post_btn'])){
	//setting variable names as assigned in the above
	$Title = $_POST['title'];
	$Content = $_POST['content'];
	if(empty($Title)){
		$errors['Title'] = "Title required";
	}
	if(empty($Content)){
		$errors['Content'] = "Content required";
	}
	if(count($errors) === 0){

		$sql = "INSERT INTO `posts`(`Title`, `Content`) VALUES (?, ?)";
		$stmtt = $conn->prepare($sql);
		$stmtt->bind_param('ss', $Title, $Content);
		if($stmtt->execute()){
			header('Location: main.php');
		}
		else{
			$errors['db_error'] = "Database error: Failed to add information";
		}

	}
	else{
	?>	
		<div class="alert alert-danger">
			<?php foreach($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</div>
	<?php
	}
}

?>






