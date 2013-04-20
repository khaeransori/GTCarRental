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
<title>GT Car Rental: Maintenance Requests   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Maintenance Requests </b></p>        


<!-- ************************************************************* -->  


<!-- ************************************************************* -->  

<form action = "verifyMaintenance.php" method = "post">     
Choose car:
	<br>
	<select name="car">
	<?php
	//IMPORTANT CODE
	//Lists the locations from the SQL table in the option list
	$loc = $_POST['location'];
	$getCars = mysql_query("SELECT Serial_Number FROM Car WHERE Location_Name = '$loc'");
	while ($temp = mysql_fetch_assoc($getCars)) {
		echo "<option value='".$temp['Serial_Number']."'>".$temp['Serial_Number']."</option>";
	}
	?>
	</select>
	<br>

Description
<br>
<textarea rows="10" cols="30" name="description">
</textarea>
	
	<input type="submit" value="Submit">
</form>
