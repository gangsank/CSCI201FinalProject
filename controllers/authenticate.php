<?php

require 'config/db.php';

$errors = array();
$Username = "";

if(isset($_POST['signup_btn'])){

	//setting variable names as assigned in the database
	$Username = $_POST['email'];
	$Password = $_POST['password'];
	$Status = true;
	$Course = "CSCI 201";
	// $Status = $_POST['status[]'];
	// $Course = $_POST['course'];

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
	if(empty($Status)){
		$errors['Status'] = "Status required";
	}
	if(empty($Course)){
		$errors['Course'] = "Course required";
	}

	$usernameQuery = "SELECT * FROM users WHERE Username =? LIMIT 1";
	$stmt = $conn->prepare($usernameQuery);
	$stmt->bind_param('s', $Username);
	$stmt->execute();
	$result = $stmt->get_result();
	$userCount = $result->num_rows;

	if($userCount > 0){
		$errors['Username'] = "Username already exists";
	}

	$stmt->close();

	if(count($errors) === 0){
		//$Password = password_hash($Password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users (Username, Password, Status, CourseEnrolled) VALUES (?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ssbs', $Username, $Password, $Status, $Course);
		if($stmt->execute()){

		}
		else{
			$errors['db_error'] = "Database error: Failed to add information";
		}

}

}