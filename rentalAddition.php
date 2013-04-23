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

//user cannot rent if personal info is NULL
$checkPersonalInfo = mysql_query("SELECT * FROM Member WHERE Username = '".$user."'");
$checkArr = mysql_fetch_assoc($checkPersonalInfo);
if (empty($checkArr['Username']) OR
	empty($checkArr['Address']) OR
	empty($checkArr['Email']) OR
	empty($checkArr['First_Name']) OR
	empty($checkArr['Middle_Initial']) OR
	empty($checkArr['Last_Name']) OR
	empty($checkArr['Phone_Number']) OR
	empty($checkArr['Card_Number']) OR
	empty($checkArr['Name_On_Card']) OR
	empty($checkArr['CVV']) OR
	empty($checkArr['Expiry_Date']) OR
	empty($checkArr['Billing_Address'])) {
		//SOMETHING IN PERSONAL INFO IS NULL FOR THIS USER - GIVE ERROR
		$_SESSION['rentingSuccess'] = -13;
		header('Location: rentACar.php');
} else {
	if ($checkUser== FALSE){

		$date1 = $pickup;
		$date2 = $return;

		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$seconds_diff = $ts2 - $ts1;
		$hours_diff = $seconds_diff/(60*60);
		
		if ( $hours_diff > 48 ){
			$_SESSION['rentingSuccess'] = 36;
			header('Location: rentACar.php');
		}

		$_SESSION['rentingSuccess'] = 1;
		mysql_query("INSERT INTO Reservation (Username, Pick_Up_Date_Time, Return_Date_Time, Late_Fees, Return_Status, Late_By, Estimated_Cost, Serial_Number, 	Location_Name) Values ('$user','$pickup','$return','0','On Time','0','$estCost','$serial','$loc')");

		header('Location: rentalInfo.php');
	}
	else{
		$_SESSION['rentingSuccess'] = -1;
		header('Location: rentACar.php');
	}
}


?>
