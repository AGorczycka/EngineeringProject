<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>AIRLIGHT - polish airlines</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet"> 
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    
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
    
<div id="header">
    <br><br>
     <img src="logo.png"><br><br>
    <div class="blog">

  				<?php if (isset($_SESSION['usr_id'])) { ?>
                <m><b>Welcome back, <?php echo $_SESSION['usr_name']; ?>!</b></m><hr>
                <span class="link"><a href="search.php">SEARCH FOR FLIGHTS!</a></span><hr>
                <span class="link"><a href="user.php">MY FLIGHTS</a></span><hr>
                <span class="link"><a href="logout.php">LOG OUT</a></span><hr>
				<?php } else { ?>
                <b>New here?</b><br>
                <span class="link"><a href="register.php">SIGN UP</a></span><br><hr>
                <b>Already a member?</b><br>
                <span class="link"><a href="login.php">LOG IN</a></span>
				<?php } ?>    
    </div>
    </div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>