<?php 
session_start(); 
if(isset($_POST['Update'])){ 

    $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
    $dbUser = "cs4400_Group_59";            //Database User Name 
    $dbPass = "sg44Hlvd";            //Database Password 
    $dbDatabase = "cs4400_Group_59";    //Database Name 
     
    $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
    //Connect to the databasse 
    mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
    //Selects the database 
	$username = $_POST['username'];
    $carModel = $_POST['carModel'];
    $location = $_POST['location'];
	$origReturn= $_POST['orignal'];
	$newReturn = $_POST['new'];
	$lateFees = 120;
	//Update table
    $sqlUpdate = mysql_query("SET Return_Date_Time = $newReturn,Late_Fees = $lateFees
    WHERE (Username = $username) AND (Return_Date_Time= $origReturn);");

	header('Location: employeeHome.php');

} 
?>
