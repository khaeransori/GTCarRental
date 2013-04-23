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

//Don't add a car if capacity is full
$countQuery = mysql_query("SELECT COUNT(*) AS Count FROM Car WHERE Location_Name = '$Loc';");
$row = mysql_fetch_array($countQuery);
$carCount = $row['Count'];
$capacityQ = mysql_query("SELECT Capacity FROM Location WHERE Location_Name = '$Loc';");
$row2 = mysql_fetch_array($capacityQ);
$capacity = $row2['Capacity'];

$getModel = mysql_query("SELECT Model FROM Car WHERE Serial_Number = '$Sno';");
$row3 = mysql_fetch_array($getModel);
$Model = $row3['Model'];
//Don't add car if same model exists at location
$modelQuery = mysql_query("SELECT Model FROM Car WHERE Location_Name = '$Loc AND Model = '$Model';");

if($carCount < $capacity){
	if(mysql_num_rows($modelQuery) == 0){
		mysql_query("UPDATE Car SET Type = '$Type', Color = '$Color', Capacity = '$Seating', Transmission_Type = '$Trans', Location_Name = '$Loc'
		WHERE Serial_Number = '$Sno';
		");

	}
}

header('Location: employeeHome.php');
?>
