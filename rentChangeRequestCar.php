<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
	$mgrssn = $_SESSION['manager'];  
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
<title>GT Car Rental: Rental Change Request   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">
</head>
<body>

<p><b>Rental Change Request </b></p>  

<br>
	<p><b>Rental Information </b></p> 

	Car Model:
	<select name="model">';
	<?php
		$username = $_POST['username'];
		//Lists the locations from the SQL table in the option list
		$getModel = mysql_query("Select DISTINCT Model FROM Car Join Reservation  
		on Car.Serial_Number= Reservation.Serial_Number WHERE Username = '$username'");
		while ($temp = mysql_fetch_assoc($getModel)) {
			echo "<option value='".$temp['Model']."'>".$temp['Model']."</option>";
		}
	?>
</select><br>
</form>
