<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM usertable WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['name'];
		header("Location: index.php");
	} else {
		$errormsg = "E-mail address/password incorrect. <br>";
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
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				
					<div class="form-group">
						<input type="text" name="email" placeholder="Input your e-mail address" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="password" name="password" placeholder="Input your password" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Login" />
					</div>
				
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		
	
	
		
        <span class="link"><a href="register.php">OR SIGN UP HERE FOR FREE!</a></span>
		
</div></div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
