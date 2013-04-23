<?php
 session_start(); 
 $Username = $_SESSION['username'];

 $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
 $dbUser = "cs4400_Group_59";            //Database User Name 
 $dbPass = "sg44Hlvd";            //Database Password 
 $dbDatabase = "cs4400_Group_59";    //Database Name 
     
 $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
 //Connect to the database 
 mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
 //Selects the database 
//Take personal info and set it up into the database

$Sno = $_POST['car'];
$DTime = date('Y-m-d H:i:s');
$Problem = $_POST['description'];

mysql_query("INSERT INTO Maintenence_Request VALUES ('$Sno', '$DTime', '$Username');
");

mysql_query("UPDATE Car SET Under_Maintenence_Flag = 1 WHERE Serial_Number = '$Sno';");

mysql_query("INSERT INTO Problem VALUES ('$Problem', '$Sno', '$DTime');
");

header('Location: employeeHome.php');
?>

