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
    <hr>
<form action="search.php" method="POST">
    <select name="term" id="term" style="height:30px; width:150px">
        <option value="" selected disabled hidden>STARTING POINT</option>
        <option value="Cracow">Cracow</option>
        <option value="Warsaw">Warsaw</option>
        <option value="London">London</option>
        <option value="Rome">Rome</option>
    </select><br>
    <select name="term2" id="term2" style="height:30px; width:150px">
        <option value="" selected disabled hidden>DESTINATION</option>
        <option value="Cracow">Cracow</option>
        <option value="Warsaw">Warsaw</option>
        <option value="London">London</option>
        <option value="Rome">Rome</option>
    </select><br>
    <input type="date" name="term3" id="term3" style="width:150px" 
        min="<?php echo date('Y-m-d'); ?>" 
        max="2018-02-28">
    <br><br>
    <input type="submit" name="Search" value="Search" style="height:30px; width:150px"/><hr>
</form>  
        
<?php
        
if(isset($_REQUEST['id'])){
if ($_REQUEST['type']==0) 
    
    {
        $sql1 = "UPDATE tickets SET businessTicketNumber=businessTicketNumber-1 WHERE id = ".$_REQUEST['id'];
        $sql2 = "INSERT INTO userstickets (userid, flightid, cityOfDeparture, Destination, timeOfDeparture, timeOfLanding, whatClassTicket, ticketCost, dateOfFlight) SELECT (SELECT A.id FROM usertable A WHERE A.id = ".$_SESSION['usr_id']."), B.id, B.cityOfDeparture, B.Destination, B.timeOfDeparture, B.timeOfLanding, B.businessClass, B.businessClassCost, B.dateOfFlight FROM tickets B WHERE B.id = ".$_REQUEST['id'];
        
    } 
    
        else
        
    {
        $sql1 = "UPDATE tickets SET economicTicketNumber=economicTicketNumber-1 WHERE id = ".$_REQUEST['id'];
        $sql2 = "INSERT INTO userstickets (userid, flightid, cityOfDeparture, Destination, timeOfDeparture, timeOfLanding, whatClassTicket, ticketCost, dateOfFlight) SELECT (SELECT A.id FROM usertable A WHERE A.id = ".$_SESSION['usr_id']."), B.id, B.cityOfDeparture, B.Destination, B.timeOfDeparture, B.timeOfLanding, B.economicClass, B.economicClassCost, B.dateOfFlight FROM tickets B WHERE B.id = ".$_REQUEST['id'];
    }
    
    
mysqli_query($con, $sql1);
mysqli_query($con, $sql2);
echo 'TICKET BOOKED!';}
        
if (!empty($_REQUEST['term'])&!empty($_REQUEST['term2'])&!empty($_REQUEST['term3'])) {

//User inputs:
$term = mysqli_real_escape_string($con, $_REQUEST['term']); 
$term2 = mysqli_real_escape_string($con, $_REQUEST['term2']); 
$term3 = mysqli_real_escape_string($con, $_REQUEST['term3']); 

    
    
    
//Search in TICKETS database using user inputs:    
$sql = "SELECT * FROM tickets WHERE cityOfDeparture LIKE '%".$term."%' AND Destination LIKE '%".$term2."%' AND dateOfFlight LIKE '%".$term3."%'";  
$r_query = mysqli_query($con, $sql);  	

//If there is no result, give information to try again:
if (mysqli_num_rows($r_query)==0) { 
    echo 'No results for such an entry. Please try again.'; 
}
    
while ($row = mysqli_fetch_array($r_query)){   
echo '<br>Departure from: ' .$row['cityOfDeparture'];  
echo '<br>Destination: ' .$row['Destination'];   
echo '<br>On: ' .$row['dateOfFlight'];   
echo '<br>Flight at: ' .$row['timeOfDeparture'];   
echo '<br>Landing at: ' .$row['timeOfLanding']; 
echo '<br>';
     
     //Loop to not give an option to book a flight if no business class tickets are available.
     if ($row['businessTicketNumber'] > 0){
        echo '<br><b>BUSINESS CLASS:</b><br> Cost: ' .$row['businessClassCost'];   
        echo '&euro;';
        echo '  Tickets left: ' .$row['businessTicketNumber'];
        //form action gets me to given page after completing query
        echo '<form action="search.php?type=0&id='.$row['id'].'" method="POST">';
        echo '<input type="submit" name="submit" value="BOOK BUSINESS CLASS TICKET" />';
        echo '</form>';
     }else{
         echo '<br>Sorry. No BUSINESS CLASS tickes available for this flight.';
     }

    
    //Loop to not give an option to book a flight if no economic class tickets are available.
      if ($row['economicTicketNumber'] > 0){ 
          echo '<br><b>ECONOMIC CLASS:</b><br> Cost: ' .$row['economicClassCost'];   
          echo '&euro;';
          echo '  Tickets left: ' .$row['economicTicketNumber'];    	
          echo '<form action="search.php?type=1&id='.$row['id'].'" method="POST">';
          echo '<input type="submit" name="submit" value="BOOK ECONOMIC CLASS TICKET" />';
          echo '</form>';
     }else{
          echo '<br>Sorry. No ECONOMIC CLASS tickes available for this flight.';
     }
 echo '<hr>';   
}  
}else{
    echo 'Please fill in all fields!';
}
         
    ?></div><br>
    </div>
</body>
</html>

