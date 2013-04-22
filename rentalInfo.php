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

<form method="post">
	Chose a return time (YYYY-MM-DD HH:MM:SS format):
	<input type="text" name="return"><br>
	<input type="submit" value="Update">
</form>

<hr>

<p><b>Previous Reservations </b></p> 
