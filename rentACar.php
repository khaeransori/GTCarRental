<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Rent a Car  </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Rent a Car </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
       

<form>
Pick up time:
<select name="pickupDate">
<option value="jan1">1/1/2013</option>
<option value="jan2">1/2/2013</option>
</select>
<select name="pickupTime">
<option value="900">9:00 AM</option>
<option value="930">9:30 AM</option>
</select><br>

Return time:
<select name="returnDate">
<option value="jan1">1/1/2013</option>
<option value="jan2">1/2/2013</option>
</select>
<select name="returnTime">
<option value="900">9:00 AM</option>
<option value="930">9:30 AM</option>
</select><br>

Location:
<select name="location">
<option value="klaus">Klaus</option>
<option value="howey">Howey</option>
</select><br>

Cars:
<select name="carType">
<option value="klaus">Honda</option>
<option value="howey">Toyota</option>
</select>
<select name="subCarType">
<option value="SUV">SUV</option>
<option value="sedan">Sedan</option>
<option value="coupe">Coupe</option>
</select><br>



<input type="submit" value="Search">
</form>
