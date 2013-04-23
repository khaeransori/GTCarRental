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

$checkUser = mysql_result(mysql_query("SELECT Username 
		FROM User AS u
		WHERE (
		u.Username ='". $user ."' AND
		u.Username IN ( 
			SELECT Username
			FROM Reservation AS r 
			WHERE(
			(r.Pick_Up_Date_Time >='". $pickup."' AND r.Pick_Up_Date_Time<'". $return."') OR 
			(r.Return_Date_Time >'".$pickup."' AND r.Return_Date_Time<='". $return."') OR 
			(r.Pick_Up_Date_Time <='".$pickup."' AND r.Return_Date_Time>='". $return."')
		)
		)
		)"),0);
if ($checkUser== FALSE){
	echo "<script type='text/javascript'>alert('Reservation Confirmed!');</script>";
	mysql_query("INSERT INTO Reservation (Username, Pick_Up_Date_Time, Return_Date_Time, Late_Fees, Return_Status, Late_By, Estimated_Cost, Serial_Number, 	Location_Name) Values ('$user','$pickup','$return','0','0','0','$estCost','$serial','$loc')");

	header('Location: rentalInfo.php');
}
else{
	echo "<script type='text/javascript'>alert('You already have a reservation during that time, dummy!');</script>";
	header('Location: rentACar.php');
}


?>
