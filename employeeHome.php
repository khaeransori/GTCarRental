<?php
//retrieve session data
  session_start();
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


<!-- ************************************************************* -->  

<form action="verifyEmployeeHome.php" method="get">
<input type="radio" name="homeSelection" value="manageCars">Manage Cars<br>
<input type="radio" name="homeSelection" value="maintenanceReq">Maintenance requests<br>
<input type="radio" name="homeSelection" value="rentalChangeReq">Rental change request<br>
<input type="radio" name="homeSelection" value="viewReports">View Reports

<select name="reportType">
<option value="locPrefReport">Location Preference Report</option>
<option value="adminReport">Administrative Report</option>
<option value="maintReport">Maintenance History Report</option>
<option value="freqUsersReport">Frequent Users Report</option>
</select><br>

<input type="submit" value="Next >>">
</form>
