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
<title>GT Car Rental: Change Car Location</title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Change Car Location</b></p>        


<form action="verifyChangeCarLoc.php" method="post">

Choose car:
<select name="chooseCar">
<?php
$loc = $_POST['currentLocation'];
$getCars = mysql_query("SELECT Serial_Number FROM Car WHERE Location_Name = '$loc'");
while ($temp2 = mysql_fetch_assoc($getCars)) {
    echo "<option value='".$temp2['Serial_Number']."'>".$temp2['Serial_Number']."</option>";
}
?>
</select><br>

<p><b>Brief Description </b></p>

Car Type: <input type="text" name="carDescType"><br>
Color: <input type="text" name="carDescColor"><br>
Seating Capacity: <input type="text" name="seatingDescCap"><br>

Transmission Type:
<select name="transDescType">
<option value="manual">Manual</option>
<option value="auto">Automatic</option>
</select><br>

Choose new location:
<select name="chooseNewLocation">
<?php
//IMPORTANT CODE
//Lists the locations from the SQL table in the option list
$getLocations = mysql_query("SELECT Location_Name FROM Location");
while ($temp = mysql_fetch_assoc($getLocations)) {
    echo "<option value='".$temp['Location_Name']."'>".$temp['Location_Name']."</option>";
}
?>
</select><br>

<input type="submit" value="Submit Changes">

</form>
</body>
</html>
