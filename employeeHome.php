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

<?php
//Check to see if they are an admin
$user = $_SESSION['username'];
$adminCheck = mysql_query("SELECT * FROM Administrator WHERE (Username = '$user')");
if(mysql_num_rows($adminCheck) == 1)
	//Give them admin access
	echo '<option value="adminReport">Administrative Report</option>';
?>
<option value="maintReport">Maintenance History Report</option>
<option value="freqUsersReport">Frequent Users Report</option>
</select><br>

<input type="submit" value="Next >>">
</form>
