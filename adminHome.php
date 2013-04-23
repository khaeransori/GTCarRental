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
<title>GT Car Rental: Admin Home   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>
Reports

<br><br>

<form action="verifyAdminHome.php" method="get">
<select name="reportType">
<option value="adminReport">Administrative Report</option>
<option value="locPrefReport">Location Preference Report</option>
<option value="maintReport">Maintenance History Report</option>
<option value="freqUsersReport">Frequent Users Report</option>
</select><br>
<input type="submit" value="Next >>">
</form>
</body>
</html>
