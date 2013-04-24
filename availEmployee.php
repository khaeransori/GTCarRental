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

?>

<html>
<head>
<title>GT Car Rental: Car Availability   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Car Availability </b></p>        


<!-- ************************************************************* -->  

<!-- ************************************************************* -->  

<form action="verifyAvailEmployee.php" method ="post">

<table border = "1">
	<tr>
<th> </th>
<th><font color="#ffffff">Model</font></th>
<th><font color="#ffffff">Type</font></th>
<th><font color="#ffffff">Location</font></th>
<th><font color="#ffffff">Color</font></th>
<th><font color="#ffffff">Hourly Rate (Occasional Driving Plan)</font></th>
<th><font color="#ffffff">Discounted Rate (Frequent Driving Plan)</font></th>
<th><font color="#ffffff">Discounted Rate (Daily Driving Plan)</font></th>
<th><font color="#ffffff">Daily Rate</font></th>
<th><font color="#ffffff">Seating Capacity</font></th>
<th><font color="#ffffff">Transmission Type</font></th>
<th><font color="#ffffff">Bluetooth Connectivity</font></th>
<th><font color="#ffffff">Auxiliary Cable</font></th>
<th><font color="#ffffff">Available Until</font></th>
<th><font color="#ffffff">Estimated Cost</font></th>
</tr>
<tr>
<td> <input type="radio" name="cars" value="none" checked></td>
<td> <font color="#ffffff"> <-- CANCEL RESERVATION </td>
</tr>
	<?php

		$affect = $_SESSION['affect'];//get global affect var (coming from verifyAffected.php)
		$getTypeSql = mysql_query("SELECT Type FROM CAR WHERE Serial_Number='". $affect['Serial_Number'] ."'");
		$getModelSql = mysql_query("SELECT Model FROM CAR WHERE Serial_Number='". $affect['Serial_Number'] ."'");
		$user= $affect['Username'];
		$loc = $affect['Location_Name'];
		$model = $getModelSql; //need to query model
		$type = $getTypeSql; //need to query type
		$pickup = $affect['Pick_Up_Date_Time'];
		$return = $affect['Return_Date_Time'];
		$serial = $affect['Serial_Number'];

	//IMPORTANT CODE
	//Lists the locations from the SQL table in the option list
	$getCars = mysql_query("SELECT * 
		FROM Car AS c 
		WHERE (
		c.Location_Name ='". $loc ."' 
		AND 
		c.Under_Maintenence_Flag = 0 AND
		c.Serial_Number NOT IN ( 
			SELECT Serial_Number
			FROM Reservation AS r 
			WHERE(
			(r.Pick_Up_Date_Time >='". $pickup."' AND r.Pick_Up_Date_Time<'". $return."') OR 
			(r.Return_Date_Time >'".$pickup."' AND r.Return_Date_Time<='". $return."') OR 
			(r.Pick_Up_Date_Time <='".$pickup."' AND r.Return_Date_Time>='". $return."')
		)
		)
		)");
	$getOtherCars = mysql_query("SELECT * 
		FROM Car AS c 
		WHERE (
		c.Location_Name <>'". $loc ."'
		AND 
		c.Under_Maintenence_Flag = 0 AND
		c.Serial_Number NOT IN ( 
			SELECT Serial_Number
			FROM Reservation AS r 
			WHERE(
			(r.Pick_Up_Date_Time >='". $pickup."' AND r.Pick_Up_Date_Time<'". $return."') OR 
			(r.Return_Date_Time >'".$pickup."' AND r.Return_Date_Time<='". $return."') OR 
			(r.Pick_Up_Date_Time <='".$pickup."' AND r.Return_Date_Time>='". $return."')
		)
		)
		)");
	$discountRateFreq = mysql_result(mysql_query("SELECT Discount FROM Driving_Plan WHERE Type ='frequentDriving'"),0);
	$discountRateDaily = mysql_result(mysql_query("SELECT Discount FROM Driving_Plan WHERE Type = 'dailyDriving'"),0);
	$userPlan = mysql_result(mysql_query("Select Plan FROM Member WHERE Username = '$user'"),0);
	$discountMult = 1.0;
	if ($userPlan == "frequentDriving")
		$discountMult = (100-$discountRateFreq)/100;
	else if($userPlan == "dailyDriving")
		$discountMult = (100-$discountRateDaily)/100;

	while ($temp = mysql_fetch_assoc($getCars)) {
		
		$availableUntil = mysql_result(mysql_query("SELECT Pick_Up_Date_Time FROM Reservation Where Serial_Number = '".$temp['Serial_Number']."' AND Pick_Up_Date_Time>'".$pickup."' Order By (Pick_Up_Date_Time) ASC"),0);

		if ($availableUntil == FALSE){
			$availableUntil = "N/A";
		}
	
		if ((strtotime($availableUntil)-strtotime($return))/3600>12){
			$availableUntil = "N/A";
		}

		$date1 = $pickup;
		$date2 = $return;

		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$seconds_diff = $ts2 - $ts1;

		$hours_diff = $seconds_diff/(60*60);
		$estCost = $hours_diff * $temp['Hourly_Rate'];
		if($hours_diff>=24){
			$days = $hours_diff/24;
			$estCost = $days * $temp['Daily_Rate'];
		}
		else{
			$estCost = $estCost*$discountMult;
		}

		echo '<tr bgcolor="#008000">';
		echo '<td> <input type="radio" name="cars" value="'.$temp['Serial_Number'].'^^'.$estCost.'"></td>';
		echo '<td> <font color="#ffffff">'.$temp['Model'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Type'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Location_Name'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Color'].'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format($temp['Hourly_Rate'],2).'</td>';
		echo '<td> <font color="#ffffff">$'.number_format((((100 - $discountRateFreq)/100)*$temp['Hourly_Rate']),2) .'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format((((100 - $discountRateDaily)/100)*$temp['Hourly_Rate']),2) .'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format($temp['Daily_Rate'],2).'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Capacity'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Transmission_Type'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Bluetooth'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Aux_Cable'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$availableUntil.'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format($estCost,2).'</font></td>';
		echo '</tr>';
		
	}

	while ($temp = mysql_fetch_assoc($getOtherCars)) {
		
		$availableUntil = mysql_result(mysql_query("SELECT Pick_Up_Date_Time FROM Reservation Where Serial_Number = '".$temp['Serial_Number']."' AND Pick_Up_Date_Time>'".$pickup."' Order By (Pick_Up_Date_Time) ASC"),0);

		if ($availableUntil == FALSE){
			$availableUntil = "N/A";
		}
		if ((strtotime($availableUntil)-strtotime($return))/3600>12){
			$availableUntil = "N/A";
		}
		$date1 = $pickup;
		$date2 = $return;

		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$seconds_diff = $ts2 - $ts1;

		$hours_diff = $seconds_diff/(60*60);
		$estCost = $hours_diff * $temp['Hourly_Rate'];
		
		if($hours_diff>=24){
			$days = $hours_diff/24;
			$estCost = $days * $temp['Daily_Rate'];
		}
		else{
			$estCost = $estCost*$discountMult;
		}
		echo '<tr>';
		echo '<td> <input type="radio" name="cars" value="'.$temp['Serial_Number'].'^^'.$estCost.'"></td>';
		echo '<td> <font color="#ffffff">'.$temp['Model'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Type'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Location_Name'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Color'].'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format($temp['Hourly_Rate'],2).'</td>';
		echo '<td> <font color="#ffffff">$'.number_format((((100 - $discountRateFreq)/100)*$temp['Hourly_Rate']),2) .'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format((((100 - $discountRateDaily)/100)*$temp['Hourly_Rate']),2) .'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format($temp['Daily_Rate'],2).'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Capacity'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Transmission_Type'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Bluetooth'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Aux_Cable'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$availableUntil.'</font></td>';
		echo '<td> <font color="#ffffff">$'.number_format($estCost,2).'</font></td>';
		echo '</tr>';
		
	
	}
	?>
	</table>
<input type="submit" value="Overwrite/Cancel" name="reserve">
</form>
