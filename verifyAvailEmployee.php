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
if(isset($_POST['reserve'])){
$estCost = substr($_POST['cars'],(2+strpos($_POST['cars'],'^^')));
$serial = substr($_POST['cars'],0,strpos($_POST['cars'],'^^'));
$pickup = $_SESSION['pickup'];
$return = $_SESSION['return'];
$loc = $_SESSION['loc'];
$affect = $_SESSION['affect']
$user = $affect['username'];

$checkUser = mysql_result(mysql_query("SELECT Username 
		FROM User AS c
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

	$date1 = $pickup;
	$date2 = $return;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$seconds_diff = $ts2 - $ts1;
	$hours_diff = $seconds_diff/(60*60);
	if ( $hours_diff > 48 ){
		$_SESSION['rentingSuccess'] = 36;
		header('Location: employeeHome.php');
	}

	$_SESSION['rentingSuccess'] = 1;
	mysql_query("INSERT INTO Reservation (Username, Pick_Up_Date_Time, Return_Date_Time, Late_Fees, Return_Status, Late_By, Estimated_Cost, Serial_Number, 	Location_Name) Values ('$user','$pickup','$return','0','On Time','0','$estCost','$serial','$loc')");

	header('Location: employeeHome.php');
}
else{
	$_SESSION['rentingSuccess'] = -1;
	header('Location: employeeHome.php');
}
}
else{
	mysql_query("Delete from Reservation 
	WHERE Username = '$user' AND Pick_Up_Date_Time = '$pickup' 
	AND Serial_Number = '$serial'");
	header('Location: employeeHome.php');
}

?>
