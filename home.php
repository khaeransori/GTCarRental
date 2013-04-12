<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Home   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Home </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
       

<form>
	<input type="radio" name="homeSelection" value="rentCar">Rent a car<br>
	<input type="radio" name="homeSelection" value="viewPersonalInfo">Enter/View personal information<br>
	<input type="radio" name="homeSelection" value="viewRentalInfo">View Rental information<br>
	<input type="submit" value="Next >>">
</form>
