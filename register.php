<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "Invalid name. Can contain only letters and spaces.";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Email is invalid.";
	}
	if(strlen($password) < 5) {
		$error = true;
		$password_error = "Minimum 5 characters requried,";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Passwords do not match.";
	}
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO usertable(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
			$successmsg = "Registering successfull! <br>";
		} else {
			$errormsg = "An error occured. Please try again later.";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>AIRLIGHT</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet"> 
</head>
<body class="homepage">
<div id="header"><br><br>
<img src="logo.png" height="100"><br><br>
<a href="index.php">return</a><br><br>

	<div class="blog">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				

					<div class="form-group">
						<input type="text" name="name" placeholder="Provide full name" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
					</div>
					
					<div class="form-group">
						<input type="text" name="email" placeholder="Provie e-mail address" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<input type="password" name="password" placeholder="Enter password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<input type="password" name="cpassword" placeholder="Confirm password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up"  />
					</div>
				
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		
	
		
    Registered? <span class="link"><a href="login.php">LOGIN HERE</a></span>
		
                
	</div></div>


<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



