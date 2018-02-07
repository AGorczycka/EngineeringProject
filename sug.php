<?php
session_start();

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['sugg'])) {
	$sugg = mysqli_real_escape_string($con, $_POST['sugg']);
	if(mysqli_query($con, "INSERT INTO sug(suggestion) VALUES('" . $sugg . "')")) {
	$successmsg = "Thank you for your input! <br> ";
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
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet"> 
</head>
<body class="homepage">
    <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="aboutus.php">About Us</a>
    <a href="contact.php">Contact</a>
    <a href="crew.php">Our crew</a>
    <a href="faq.php">FAQ</a>
    <a href="sug.php">Your suggestions</a>
    </div>
    
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
    <script>
            function openNav() {
            document.getElementById("mySidenav").style.width = "100%";
            }

            function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            }
    </script>
<div id="header"><br><br>
<img src="logo.png" height="100"><br><br>
<a href="index.php">return</a><br><br>

	<div class="blog">
        <mu>Do you have any opinion about us? <br> Don't worry! It's completely anynomous!</mu> <hr>
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="sugg">
				

					<div class="form-group">
						<input type="text" name="sugg" placeholder="What is your opinion?" required value="<?php if($error) echo $sugg; ?>" class="form-control" />
						
					</div>
					
					<div class="form-group">
						<input type="submit" name="usinput" value="Add suggestion"  />
					</div>
				
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                
	</div></div>


<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



