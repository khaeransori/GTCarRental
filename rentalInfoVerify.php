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
if(isset($_POST['update'])&& $_POST['return']!=""){
$returnTime = $_POST['return'];
$oldReturnTime = mysql_query("SELECT Return_Date_Time FROM Reservation
	WHERE CONCAT(Username, Pick_Up_Date_Time, Return_Date_Time) = '$reservationKey'");
$pickupTime = mysql_query("SELECT Pick_Up_Date_Time FROM Reservation
	WHERE CONCAT(Username, Pick_Up_Date_Time, Return_Date_Time) = '$reservationKey'");
$currentSno = mysql_query("SELECT Serial_Number FROM Reservation
	WHERE CONCAT(Username, Pick_Up_Date_Time, Return_Date_Time) = '$reservationKey'");
//$formattedDate = date('Y-m-d H:i:s',strtotime($returnTime));
$reservationKey = $_POST['resPKey'];

$checkUser = mysql_result(mysql_query("SELECT Username 
		FROM User AS u
		WHERE (
		u.Username IN ( 
			SELECT Username
			FROM Reservation AS r
			WHERE(
			r.Serial_Number = '". $currentSno."' AND
			((r.Pick_Up_Date_Time >='". $pickupTime."' AND r.Pick_Up_Date_Time<'". $returnTime."') OR 
			(r.Return_Date_Time >'".$pickupTime."' AND r.Return_Date_Time<='". $returnTime."') OR 
			(r.Pick_Up_Date_Time <='".$pickupTime."' AND r.Return_Date_Time>='". $returnTime."'))
		)
		)
		)"),0);

if ($checkUser == FALSE) { //CHECK TEST CHECK 

	$times = mysql_query("SELECT Pick_Up_Date_Time, Return_Date_Time FROM Reservation
	WHERE CONCAT(Username, Pick_Up_Date_Time, Return_Date_Time) = '$reservationKey'");
	$timesArray = mysql_fetch_array($times);
	$oldReturn = $timesArray['Return_Date_Time'];
	$pickupTimeNew = $timesArray['Pick_Up_Date_Time'];

	$diff = (strtotime($returnTime) - strtotime($oldReturn))/3600;

	if ($diff > 48) { 
		//user is trying to extend reservation duration beyond 2 days
		$_SESSION['rentingSuccess'] = -3;
		header('Location: home.php');
	} else if ($diff >= 0){
		mysql_query("UPDATE Reservation SET Return_Date_Time = '$returnTime'
		WHERE CONCAT(Username, Pick_Up_Date_Time, Return_Date_Time) = '$reservationKey'");
		
		if($diff != 0){
			
			mysql_query("INSERT INTO Extended_Time VALUES ('$diff','$username','$pickupTimeNew','$returnTime');");
		}

		$_SESSION['rentingSuccess'] = 2;
	}
	
	
} else {
	$_SESSION['rentingSuccess'] = -2;
}

header('Location: home.php');
}
else
{
	header('Location: home.php');
}
?>
