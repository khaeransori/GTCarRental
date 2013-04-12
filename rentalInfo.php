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

Choose a return time:
<select name="returnDate">
<option value="jan1">1/1/2013</option>
<option value="jan2">1/2/2013</option>
</select>
<select name="returnTime">
<option value="900">9:00 AM</option>
<option value="930">9:30 AM</option>
</select><br>

<form>
<input type="submit" value="Update">
</form>

<hr>

<p><b>Previous Reservations </b></p> 
