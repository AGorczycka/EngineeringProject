<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>AIRLIGHT - polish airlines</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
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
<?php
$sql = "SELECT * FROM about";  
$r_query = mysqli_query($con, $sql); 
    
while ($row = mysqli_fetch_array($r_query)){   
echo '<br><m> ' .$row['year'];  
echo '</m><br><br> ' .$row['purpose'];  
echo '<br><br>' .$row['quantity'];  
echo '<br><br>';   
}

?>
    
    </div></div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>