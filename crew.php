<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>AIRLIGHT - polish airlines</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet"> 
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
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
<a href="index.php">return</a><br>
<div class="blog">    
<?php
$sql = "SELECT * FROM crew WHERE job='stewardessa' ";  
$sql2 = "SELECT * FROM crew WHERE job='steward' ";  
$sql3 = "SELECT * FROM crew WHERE job='pilot' ";  
$r_query = mysqli_query($con, $sql); 
$r_query2 = mysqli_query($con, $sql2); 
$r_query3 = mysqli_query($con, $sql3); 
    
echo '<m>Our flight attendants:</m><br>';
    
while ($row = mysqli_fetch_array($r_query)){   
echo '<br> ' .$row['name'];  
echo ' ' .$row['surname']; 
}
    
echo '<m><hr>Our stewards:</m><br>';
    
while ($row = mysqli_fetch_array($r_query2)){   
echo '<br> ' .$row['name'];  
echo ' ' .$row['surname']; 
}
    
echo '<m><hr>Our pilots:</m><br>';
    
while ($row = mysqli_fetch_array($r_query3)){   
echo '<br> ' .$row['name'];  
echo ' ' .$row['surname']; 
}

?>
    
    </div></div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>