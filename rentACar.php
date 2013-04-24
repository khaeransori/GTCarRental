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
<title>GT Car Rental: Rent a Car  </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Rent a Car </b></p>        


<!-- ************************************************************* -->  




<!-- ************************************************************* -->       

<form action="carAvailability.php" method="post">
	<?php
	if ($_SESSION['rentingSuccess'] == -1){
		echo "Reservation Failed. You already have a car reserved at that time.<br><br>";
		$_SESSION['rentingSuccess'] = 0;
	} else if ($_SESSION['rentingSuccess'] == 36){
		echo "Reservation Failed. You cannot reserve a car for more than two days.<br><br>";
		$_SESSION['rentingSuccess'] = 0;
	} else if ($_SESSION['rentingSuccess'] == -13) {
		echo "Reservation Failed. User has null fields in personal info.<br><br>";
		$_SESSION['rentingSuccess'] = 0;
	}

 	?>
	Pick up date & time (YYYY-MM-DD HH:MM:SS format):
	<input type="text" name="pickup"><br>

	Return date & time (YYYY-MM-DD HH:MM:SS format):
	<input type="text" name="return"><br>

	Select Location:
	<select name="location">
		<?php
		//Lists the locations from the SQL table in the option list
		$getLocations = mysql_query("SELECT Location_Name FROM Location");
		while ($temp = mysql_fetch_assoc($getLocations)) {
			echo "<option value='".$temp['Location_Name']."'>".$temp['Location_Name']."</option>";
		}
		?>
	</select><br>


	Cars Type:
	<select name="carType">
		<?php
		//Lists the car types from the SQL table in the option list
		$getCarTypes = mysql_query("SELECT DISTINCT Type FROM Car");
		while ($temp = mysql_fetch_assoc($getCarTypes)) {
			echo "<option value='".$temp['Type']."'>".$temp['Type']."</option>";
		}
		?>
	</select>


	Car Model: 
	<select name="carModel">
		<?php
		//Lists the car types from the SQL table in the option list
		$getCarModels = mysql_query("SELECT DISTINCT Model FROM Car");
		while ($temp = mysql_fetch_assoc($getCarModels)) {
			echo "<option value='".$temp['Model']."'>".$temp['Model']."</option>";
		}
		?>
	</select><br>



	
	<input type="radio" name="searchSelection" value="searchByType">Search By Type
	<input type="radio" name="searchSelection" value="searchByModel" checked>Search By Model<br>

	<input type="submit" name="search" value="Search">
</form>
