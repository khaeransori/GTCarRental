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

$Sno = $_POST['chooseCar'];
$Type = $_POST['carDescType'];
$Color = $_POST['carDescColor'];
$Seating = $_POST['seatingDescCap'];
$Trans = $_POST['transDescType'];
$Loc = $_POST['chooseNewLocation'];

mysql_query("UPDATE Car SET Type = '$Type', Color = '$Color', Capacity = '$Seating', Transmission_Type = '$Trans', Location_Name = '$Loc'
WHERE Serial_Number = '$Sno';
");

header('Location: employeeHome.php');
?>
