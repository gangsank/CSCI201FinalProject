<?php

session_start();
require 'config/db.php';

$errors = array();
$Username = "";
$Status = true;
$Course = "hello";

if(isset($_POST['signup_btn'])){

	//setting variable names as assigned in the register_form.php
	$Username = $_POST['email'];
	$Password = $_POST['password'];
	if(isset($_POST['status'])) {
    	$status = $_POST['status'];
    	foreach ($status as $name) {
    		$Status = $name;
    	}
	}
	$options = array('-- Select One --', 'csci201', 'csci270', 'math225', 'phys151');
	foreach ($options as $name) {
		if($_POST['course'] == $name){
			$Course = $name;
		}
	}	
	

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

		$sql = "INSERT INTO `users`(`Username`, `Password`, `Status`, `CourseEnrolled`) VALUES (?, ?, ?, ?)";
		$stmtt = $conn->prepare($sql);
		$stmtt->bind_param('ssss', $Username, $Password, $Status, $Course);
		if($stmtt->execute()){
			header('Location: register_confirmation.html');
		}
		else{
			$errors['db_error'] = "Database error: Failed to add information";
		}

}

}

// if user clicks login button

if(isset($_POST['login_btn'])){

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
	
	if(count($errors)===0){
		$usernameQuery = "SELECT * FROM users WHERE Username =? LIMIT 1";
		$stmt = $conn->prepare($usernameQuery);
		$stmt->bind_param('s', $Username);
		$stmt->execute();
		$result = $stmt->get_result();
		$user = $result->fetch_assoc();
		
		if(password_verify($Password, $user['Password'])) {
			//login user
			$_SESSION['Username'] = $user['Username'];
			$_SESSION['Status'] = $user['Status'];
			$_SESSION['CourseEnrolled'] = $user['Course'];
			$_SESSION['message'] = "You are now logged in";
			header('Location: righthalf.html');
			exit();

		} 
		else {
			$errors['login_error'] = "Could not login successfully";
		}
	}
}







