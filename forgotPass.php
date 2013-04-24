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
<title>Password Retreival </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Get your Password</b></p>        


<!-- ************************************************************* -->  




<!-- ************************************************************* -->       

<form action="pwVerify.php" method="post">
	Username:
	<input type="text" name="un"/><br />

	First Name:
	<input type="text" name="fn"/><br />

	Last Name:
	<input type="text" name="ln"/><br />

	<input type="submit" name="search" value="Give me my password!" />
</form>
</body>
</html>