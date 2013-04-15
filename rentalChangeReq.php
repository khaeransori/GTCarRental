<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
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


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
       

<form>
	Enter username: <input type="text" name="userName"><br>
	<p><b>Rental Information </b></p> 

	Car Model: <input type="text" name="carModel"><br>
	Location: <input type="text" name="location"><br>
	Original return time:
	<select name="returnTimeStartDate">
	<option value="117">1/17/2013</option>
	<option value="118">1/18/2013</option>
	</select>

	<select name="returnTimeStartTime">
	<option value="1200">12:00PM</option>
	<option value="1230">12:30PM</option>
	</select><br>

	New arrival time:
	<select name="returnTimeStartDate">
	<option value="117">1/17/2013</option>
	<option value="118">1/18/2013</option>
	</select>

	<select name="returnTimeStartTime">
	<option value="1200">12:00PM</option>
	<option value="1230">12:30PM</option>
	</select><br>

	<input type="submit" value="Update">
</form>

<p><b>User Affected </b></p> 

<form>
	Username: <input type="text" name="userAffectedUsername"><br>

	Original pick up time:
	<select name="returnTimeStartDate">
	<option value="117">1/17/2013</option>
	<option value="118">1/18/2013</option>
	</select>

	<select name="returnTimeStartTime">
	<option value="1200">12:00PM</option>
	<option value="1230">12:30PM</option>
	</select><br>

	Original return time:
	<select name="returnTimeStartDate">
	<option value="117">1/17/2013</option>
	<option value="118">1/18/2013</option>
	</select>

	<select name="returnTimeStartTime">
	<option value="1200">12:00PM</option>
	<option value="1230">12:30PM</option>
	</select><br>

	Email Address: <input type="text" name="email"><br>
	Phone Number: <input type="text" name="phoneNumber"><br>
	<input type="submit" value="Cancel Reservation">
	<input type="submit" value="Show car availability">
</form>
