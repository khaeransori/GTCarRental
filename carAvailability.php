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
<th>Location</th>
<th>Car Type</th>
</tr>
	<?php
	//IMPORTANT CODE
	//Lists the locations from the SQL table in the option list
	$getCars = mysql_query("SELECT * FROM Car");
	while ($temp = mysql_fetch_assoc($getCars)) {
		echo '<tr>';
		echo '<td> <input type="radio" name="cars" value="'.$temp['Serial_Number'].'"></td>';
		echo '<td> '.$temp['Serial_Number'].'</td>';
		echo '<td> '.$temp['Model'].'</td>';
		echo '</tr>';
	}
	?>
	</table>

<input type="submit" value="Reserve">
</form>
