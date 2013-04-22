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

$serial = $_POST["cars"];
$pickup = $_POST["pickup"];
$return = $_POST["return"];

mysql_query("INSERT INTO Reservation
VALUES (Username = '".$_Session["username"]."',Pick_Up_Date_Time= '".$pickup."', Return_Date_Time = '".$return."', Late_Fees = 0, Return_Status = '0', Late_By = '0', Estimated_Cost = '8', Serial_Number = '".$serial."', Location_Name = 'Klaus');
?>
