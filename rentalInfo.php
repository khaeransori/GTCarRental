<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
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


 ?>


<!-- ************************************************************* -->  

<p><b>Current Reservations </b></p> 

<form method="post">
	Chose a return time (YYYY-MM-DD HH:MM:SS format):
	<input type="text" name="return"><br>
	<input type="submit" value="Update">
</form>

<hr>

<p><b>Previous Reservations </b></p> 
