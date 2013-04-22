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

Select Location:
<select name="location">
	<?php
	//Lists the locations from the SQL table in the option list
	$getLocations = mysql_query("SELECT Location_Name FROM Location");
	while ($temp = mysql_fetch_assoc($getLocations)) {
		echo "<option value='".$temp['Location_Name']."'>".$temp['Location_Name']."</option>";
	}
	?>
</select><br>


Cars Type:
<select name="carType">
	<?php
	//Lists the car types from the SQL table in the option list
	$getCarTypes = mysql_query("SELECT DISTINCT Type FROM Car");
	while ($temp = mysql_fetch_assoc($getCarTypes)) {
		echo "<option value='".$temp['Type']."'>".$temp['Type']."</option>";
	}
	?>
</select>


Car Model: 
<select name="carType">
	<?php
	//Lists the car types from the SQL table in the option list
	$getCarModels = mysql_query("SELECT DISTINCT Model FROM Car");
	while ($temp = mysql_fetch_assoc($getCarModels)) {
		echo "<option value='".$temp['Model']."'>".$temp['Model']."</option>";
	}
	?>
</select><br>
</form>


<form action="carAvailability.php" method="post">
    <input type="submit" name="search" value="Search">
</form>
