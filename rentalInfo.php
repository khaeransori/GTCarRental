<?php
//retrieve session data
 session_start();
 $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
 $dbUser = "cs4400_Group_59";            //Database User Name 
 $dbPass = "sg44Hlvd";            //Database Password 
 $dbDatabase = "cs4400_Group_59";    //Database Name 
 
 $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
 //Connect to the databasse 
 mysql_select_db($dbDatabase, $db)or die("Couldn't select the database.");   
?>
 
<html>
<head>
<title>GT Car Rental: Rental Information    </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Rental Information </b></p>    




<!-- ************************************************************* -->  

<?php

if ($_SESSION['rentingSuccess'] == 1) {
	echo "Reservation Successful<br>";
	$_SESSION['rentingSuccess'] = 0;
}
	   
 ?>


<!-- ************************************************************* -->  

<p><b>Current Reservations </b></p> 

<form action="rentalInfoVerify.php" method="post">
<table border = "1">
	<tr>
		<th><font color="#ffffff">Reservation Date/Time</font></th>
		<th><font color="#ffffff">Car</font></th>
		<th><font color="#ffffff">Location</font></th>
		<th><font color="#ffffff">Amount</font></th>
		<th><font color="#ffffff">Extend?</font></th>
	</tr>



	<?php
	$user = $_SESSION['username'];
	$getFutureReservations = mysql_query("SELECT Reservation.Username, Reservation.Pick_Up_Date_Time, Reservation.Return_Date_Time, Reservation.Estimated_Cost, Reservation.Return_Status, Car.Model, Car.Location_Name FROM Reservation
		INNER JOIN Car
		ON Reservation.Serial_Number = Car.Serial_Number
		WHERE Reservation.Username = '$user' AND Reservation.Return_Date_Time > CURDATE()");

	while ($temp = mysql_fetch_assoc($getFutureReservations)) {
		echo '<tr>';
		echo '<td> <font color="#ffffff">'.$temp['Pick_Up_Date_Time'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Model'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Location_Name'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Estimated_Cost'].'</font></td>';
		echo '<td> <input type="radio" name="resPKey" value="'.$temp['Username'].$temp['Pick_Up_Date_Time'].$temp['Return_Date_Time'].'"></td>';
		echo '</tr>';
	}
	?>
</table>


	Chose a return time (YYYY-MM-DD HH:MM:SS format):
	<input type="text" name="return"><br>
	<input type="submit" value="Update" name = "update">
	<input type = "submit" value = "Home" name = "home">
</form>

<hr>

<p><b>Previous Reservations </b></p> 

<table border = "1">
	<tr>
		<th><font color="#ffffff">Reservation Date/Time</font></th>
		<th><font color="#ffffff">Car</font></th>
		<th><font color="#ffffff">Location</font></th>
		<th><font color="#ffffff">Amount</font></th>
		<th><font color="#ffffff">Return Status</font></th>
	</tr>



	<?php
	$user = $_SESSION['username'];
	$getHistory = mysql_query("SELECT Reservation.Username, Reservation.Pick_Up_Date_Time, Reservation.Estimated_Cost, Reservation.Return_Status, Car.Model, Car.Location_Name FROM Reservation
		INNER JOIN Car
		ON Reservation.Serial_Number = Car.Serial_Number
		WHERE Reservation.Username = '$user' AND Reservation.Return_Date_Time < CURDATE()");

	while ($temp = mysql_fetch_assoc($getHistory)) {
		echo '<tr>';
		echo '<td> <font color="#ffffff">'.$temp['Pick_Up_Date_Time'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Model'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Location_Name'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Estimated_Cost'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Return_Status'].'</font></td>';
		echo '</tr>';
	}
	?>
</table>
<br>




