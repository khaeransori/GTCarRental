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

<form>

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
	<?php
	$loc = $_POST['location'];
	$model = $_POST['carModel'];
	$type = $_POST['carType'];
	$pickup = $_POST['pickup'];
	$return = $_POST['return'];
	//IMPORTANT CODE
	//Lists the locations from the SQL table in the option list
	$getCars = mysql_query("SELECT * 
		FROM Car AS c 
		WHERE (
		c.Location_Name ='". $loc ."' AND 
		((c.Type ='".$type ."') OR (c.Model = '". $model ."')) AND 
		c.Under_Maintenence_Flag = 0 AND
		NOT EXISTS ( 
			SELECT Serial_Number
			FROM Reservation AS r 
			WHERE(
			(r.Pick_Up_Date_Time >='". $pickup."' AND r.Pick_Up_Date_Time<'". $return."') OR 
			(r.Return_Date_Time >'".$pickup."' AND r.Return_Date_Time<='". $return."') OR 
			(r.Pick_Up_Date_Time <='".$pickup."' AND r.Return_Date_Time>='". $return."')
		)
		)
		)");
	while ($temp = mysql_fetch_assoc($getCars)) {
		if ($temp["Under_Maintenence_Flag"]=="0"){
		echo '<tr>';
		echo '<td> <input type="radio" name="cars" value="'.$temp['Serial_Number'].'"></td>';
		echo '<td> <font color="#ffffff">'.$temp['Model'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Type'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Location_Name'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Color'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Hourly_Rate'].'</td>';
		echo '<td> <font color="#ffffff"> FREQUENT </font></td>';
		echo '<td> <font color="#ffffff"> Daily Discount Rate or some shit </font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Daily_Rate'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Capacity'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Transmission_Type'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Bluetooth'].'</font></td>';
		echo '<td> <font color="#ffffff">'.$temp['Aux_Cable'].'</font></td>';
		echo '<td> <font color="#ffffff">AVAILABLE UNTIL GOES HERE!!!!!!!!!!!</font></td>';
		echo '<td> <font color="#ffffff">ESTIMATED COST!!!!!!!!!</font></td>';
		echo '</tr>';
		}
	}
	?>
	</table>

<input type="submit" value="Reserve">
</form>
