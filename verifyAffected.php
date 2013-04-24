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
	$affect = $_SESSION['affect'];
	$username = $affect['Username'];
	$serialnum = $affect['Serial_Number'];
	$pickup= $affect['Pick_Up_Date_Time'];
	$dropoff = $affect['Return_Date_Time'];
if ( isset( $_POST['cancel'] ) ) { 
	mysql_query("Delete from Reservation 
	WHERE Username = '$username' AND Pick_Up_Date_Time = '$pickup' 
	AND Serial_Number = '$serialnum'");
	header('Location: employeeHome.php');
}
else{
	header('Location: availEmployee.php');
}

?>
