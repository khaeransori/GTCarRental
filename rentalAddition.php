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

$estCost = substr($_POST['cars'],(2+strpos($_POST['cars'],'^^')));
$serial = substr($_POST['cars'],0,strpos($_POST['cars'],'^^'));
$pickup = $_SESSION['pickup'];
$return = $_SESSION['return'];
$user = $_SESSION['username'];
$loc = $_SESSION['loc'];
//$r = new DateTime($return);

mysql_query("INSERT INTO Reservation (Username, Pick_Up_Date_Time, Return_Date_Time, Late_Fees, Return_Status, Late_By, Estimated_Cost, Serial_Number, Location_Name) Values ('$user','$pickup','$return','0','0','0','$estCost','$serial','$loc')");

header('Location: rentalInfo.php');
?>
