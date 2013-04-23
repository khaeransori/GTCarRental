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
    
	$username = $_SESSION['userChange'];
	$origReturn= $_POST['resPKey'];
	$newReturn = $_POST['return'];
	$lateby = (strtotime($newReturn) - strtotime($origReturn)) /3600;
	$latefee = 50 * $lateby; 

	$sqlSerial = mysql_fetch_array(mysql_query("Select Reservation.Serial_Number 
	From Reservation Join Car 
	on Reservation.Serial_Number = Car.Serial_Number
	WHERE Username = '$username' AND  Return_Date_Time = '$origReturn';"));
	$serialNum = $sqlSerial['Serial_Number'];
	//Update table    
    $sqlUpdate = mysql_query("UPDATE Reservation
	SET Return_Date_Time = '$newReturn', Late_Fees = '$latefee', Late_By='lateby'
	WHERE Username = '$username' AND Return_Date_Time = '$origReturn';");
	
	//Enter Into Extension Table
	mysql_query("INSERT INTO Extension VALUES ('$lateby')");
	
	
	//find others affected
	$sqlAffected = mysql_query("Select * From Reservation 
	WHERE Pick_Up_Date_Time <= '$newReturn' AND 
	Pick_Up_Date_Time >= '$origReturn' AND
	Serial_Number = '$serialNum' AND Username <>'$username';");
	$_SESSION['affect'] = mysql_fetch_array($sqlAffected);
	

	
	if(mysql_num_rows($sqlAffected) >= 1){ 
		header('Location: affectedUser.php');
	}
	else{
		header('Location: employeeHome.php');
	}

?>
