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
if($_SESSION['rentingSuccess'] == 2) {
	echo "Reservation successfully updated.<br><br>";
	$_SESSION['rentingSuccess'] = 0;
} else if ($_SESSION['rentingSuccess'] == -2) {
	echo "Reservation update failed.<br><br>";
	$_SESSION['rentingSuccess'] = 0;
} else if ($_SESSION['rentingSuccess'] == -3) {
	echo "Reservation update failed, user can not extend duration beyond 2 days.<br><br>";
	$_SESSION['rentingSuccess'] = 0;
}

 ?>


<!-- ************************************************************* -->  
       

<form name="homeVerify" action="verifyHome.php" method="get">
	<input type="radio" name="homeSelection" value="rentCar" checked>Rent a car<br>
	<input type="radio" name="homeSelection" value="viewPersonalInfo">Enter/View personal information<br>
	<input type="radio" name="homeSelection" value="viewRentalInfo">View Rental information<br>
	<input type="submit" value="Next >>">
</form>
