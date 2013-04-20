<?php
 session_start(); 
 $username = $_SESSION['username'];

 $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
 $dbUser = "cs4400_Group_59";            //Database User Name 
 $dbPass = "sg44Hlvd";            //Database Password 
 $dbDatabase = "cs4400_Group_59";    //Database Name 
     
 $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
 //Connect to the databasse 
 mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
 //Selects the database 
//Take personal info and set it up into the database

$Serial_Number = $_POST['serialNumber'];
$Model = $_POST['carModel'];
$Type = $_POST['carType'];
$Location_Name = $_POST['location'];
$Color = $_POST['color'];
$Hourly_Rate = $_POST['hourlyRate'];
$Daily_Rate = $_POST['dailyRate'];
$Capacity = $_POST['seatingCapacity'];
$Transmission_Type = $_POST['transType'];

if($_POST['bluetooth'] == 'yesBluetooth')
	$Bluetooth = 1;
else
	$Bluetooth = 0;
	
if($_POST['auxCable'] == 'yesAux')
	$AUX_Cable = 1;
else
	$AUX_Cable = 0;

//TODO: Don't add a car if capacity is full
//$checkCapacity = mysql_query("SELECT Capacity FROM Location WHERE (Location = '$Location_Name')");

mysql_query("INSERT INTO Car
VALUES('$Serial_Number', '$AUX_Cable', 0, '$Model', '$Type', '$Color', '$Hourly_Rate', 
'$Daily_Rate', '$Bluetooth', '$Capacity', '$Transmission_Type', '$Location_Name')
");

header('Location: employeeHome.php');
?>
