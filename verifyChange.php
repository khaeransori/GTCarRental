<?php 
session_start(); 


    $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
    $dbUser = "cs4400_Group_59";            //Database User Name 
    $dbPass = "sg44Hlvd";            //Database Password 
    $dbDatabase = "cs4400_Group_59";    //Database Name 
     
    $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
    //Connect to the databasse 
    mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
    //Selects the database 
	$username = $_POST['username'];
    $carModel = $_POST['model'];
    $location = $_POST['location'];
	$origReturn= $_POST['original'];
	$newReturn = $_POST['new'];
	//$lateFees = 120;
	//Update table
    $sqlUpdate = mysql_query("UPDATE Reservation 
	SET Return_Date_Time = '$newReturn'
	WHERE Username = '$username' AND Return_Date_Time = '$origReturn' AND Location = '$location'");

	header('Location: employeeHome.php');


?>
