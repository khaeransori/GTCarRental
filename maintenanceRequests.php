<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Maintenance Requests   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Maintennance Requests </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
       

<form>
	Choose location:
	<select name="chooseMaintenanceLoc">
	<option value="howey">Howey</option>
	<option value="klaus">Klaus</option>
	</select><br>

	Choose car:
	<select name="chooseMaintenanceCar">
	<option value="camery">Toyota Camery</option>
	<option value="accord">Honda Accord</option>
	</select><br>

	<textarea rows="10" cols="30">
	Insert description here
	</textarea>

	<input type="submit" value="Submit Request">
</form>
