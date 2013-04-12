<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Car Availability   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Car Availability </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  

<input type="radio" name="homeSelection" value="manageCars">Manage Cars<br>
<input type="radio" name="homeSelection" value="maintenanceReq">Maintenance requests<br>
<input type="radio" name="homeSelection" value="rentalChangeReq">Rental change request<br>
<input type="radio" name="homeSelection" value="viewReports">View Reports

<select name="reportType">
<option value="locPrefReport">Location Preference Report</option>
</select><br>


<form>
<input type="submit" value="Next >>">
</form>
