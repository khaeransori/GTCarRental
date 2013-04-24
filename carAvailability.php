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

<form action="rentalAddition.php" method = "post">

	<?php
		if ( isset( $_POST['location'] ) ) {
			$loc = $_POST['location'];
			$model = $_POST['carModel'];
			$type = $_POST['carType'];
			$pickup = $_POST['pickup'];
			$return = $_POST['return'];
		}
				
		$_SESSION['pickup'] = $pickup;
		$_SESSION['return'] = $return;
		$_SESSION['loc'] = $loc;
		$user = $_SESSION['username'];

		$search = $type;

		if ($_POST['searchSelection']=="searchByModel"){
			$search = $model;
		}


		//IMPORTANT CODE
		//Lists the locations from the SQL table in the option list
		$getCars = mysql_query("SELECT * 
			FROM Car AS c 
			WHERE (
			c.Location_Name ='". $loc ."' AND 
			((c.Model = '". $search ."') OR (c.Type = '".$search."'))
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
			c.Location_Name <>'". $loc ."' AND 
			((c.Model = '". $search ."') OR (c.Type = '".$search."'))
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
		$ts1 = strtotime($pickup);
	$ts2 = strtotime($return);

	$seconds_diff = $ts2 - $ts1;
	$hours_diff = $seconds_diff/(60*60);

	//add pickup needs to be after now case
	$currDate = date('Y-m-d H:i:s');
	
	if ( ($hours_diff > 48) OR ($hours_diff < 0) OR ($ts1 < $currDate) ){
		//echo "YOU CAN NOT SEARCH FOR A RESERVATION THAT IS LONGER THAN 2 DAYS.<br>";
	} else {
		echo '<table border = "1">';
			echo '<tr>';
				echo '<th> </th>';
				echo '<th><font color="#ffffff">Model</font></th>';
				echo '<th><font color="#ffffff">Type</font></th>';
				echo '<th><font color="#ffffff">Location</font></th>';
				echo '<th><font color="#ffffff">Color</font></th>';
				echo '<th><font color="#ffffff">Hourly Rate (Occasional Driving Plan)</font></th>';
				echo '<th><font color="#ffffff">Discounted Rate (Frequent Driving Plan)</font></th>';
				echo '<th><font color="#ffffff">Discounted Rate (Daily Driving Plan)</font></th>';
				echo '<th><font color="#ffffff">Daily Rate</font></th>';
				echo '<th><font color="#ffffff">Seating Capacity</font></th>';
				echo '<th><font color="#ffffff">Transmission Type</font></th>';
				echo '<th><font color="#ffffff">Bluetooth Connectivity</font></th>';
				echo '<th><font color="#ffffff">Auxiliary Cable</font></th>';
				echo '<th><font color="#ffffff">Available Until</font></th>';
				echo '<th><font color="#ffffff">Estimated Cost</font></th>';
			echo '</tr>';
	}

	?>

	<?php
	
	if (($hours_diff > 48) OR ($hours_diff < 0) OR ($ts1 < $currDate)){
		//DO NOTHING
	} else {



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
	}
	?>
	</table>

<?php
if ($hours_diff > 48){
		echo 'You can not search for a reservation that has a duration of more than 2 days.<br>';
		echo '<a href="rentACar.php">Go Back</a>';
	} else if ($hours_diff < 0) {
		echo 'You can not create a reservation whose return time is before the pickup time.<br>';
		echo '<a href="rentACar.php">Go Back</a>';
	} else if (($ts1 - strtotime($currDate))<0) {
		echo 'You can not create a reservation whose pickup time is before the current time.<br>';
		echo '<a href="rentACar.php">Go Back</a>';
	} else if ((mysql_num_rows($getCars) + mysql_num_rows($getOtherCars)) == 0) {
 		echo 'There are no cars available based on your specification.<br>';
		echo '<a href="rentACar.php">Go Back</a>';
	} else {
		echo '<input type="submit" value="Reserve"><br>';
	}
?>
</form>
