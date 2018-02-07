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
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    
</head>

<body class="homepage">
<div id="header"><br><br>
<img src="logo.png" height="100"><br><br>
<a href="index.php">return</a><br>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script> 

    <div class="blog">
    
<?php
    

echo 'Your flights, ' .$_SESSION['usr_name'];      
echo ', are shown below: <hr>';
$sql = "SELECT * FROM userstickets WHERE userid = ".$_SESSION['usr_id'];  
$r_query = mysqli_query($con, $sql); 
    
    //If there is no result, show user that he has no flights booked:
if (mysqli_num_rows($r_query)==0) { 
    echo 'You booked no flights yet.'; 
}
    
while ($row = mysqli_fetch_array($r_query)){   
echo '<br>Departure from: ' .$row['cityOfDeparture'];  
echo '<br>Destination: ' .$row['Destination'];   
echo '<br>On: ' .$row['dateOfFlight'];   
echo '<br>Flight at: ' .$row['timeOfDeparture'];   
echo '<br>Landing at: ' .$row['timeOfLanding']; 
echo '<br>Flight ID: ' .$row['flightid']; 
echo '<br><br>';   
    
if(isset($_REQUEST['id'])){
if ($_REQUEST['type']==0) 
    
    {
        $sql1 = "UPDATE tickets SET businessTicketNumber=businessTicketNumber+1 WHERE id = ".$row['flightid'];
        $sql2 = "DELETE FROM userstickets WHERE id = ".$_REQUEST['id'];
        header("Location: user.php");
        
    } 
    
        else
        
    {
        $sql1 = "UPDATE tickets SET economicTicketNumber=economicTicketNumber+1 WHERE id = ".$row['flightid'];
        $sql2 = "DELETE FROM userstickets WHERE id = ".$_REQUEST['id'];
        header("Location: user.php");
    }
    
    
mysqli_query($con, $sql1);
mysqli_query($con, $sql2);}
 
    
 if ($row['whatClassTicket'] == 'business'){
	      	echo '<form action="user.php?type=0&id='.$row['id'].'" method="POST">';
       		echo '<input type="submit" name="submit" value="RETURN BUSINESS CLASS TICKET" />';
        		echo '</form>';
      echo '<hr>'; 
	}else{
		echo '<form action="user.php?type=1&id='.$row['id'].'" method="POST">';
       		echo '<input type="submit" name="submit" value="RETURN ECONOMIC CLASS TICKET" />';
        		echo '</form>';
      echo '<hr>'; 
	}
     
} 

 echo '<hr>';        
?></div><br>
    </div>
</body>
</html>

