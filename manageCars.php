<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Manage Cars   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Manage Cars </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
       

<form>
Vehicle Sno: <input type="text" name="username"><br>
Car Model: <input type="text" name="carModel"><br>
Car Type:
<select name="carType">
<option value="hybrid">Hybrid</option>
<option value="gasoline">Gasoline</option>
</select><br>

Location:
<select name="location">
<option value="studentCenter">Student Center</option>
<option value="klaus">Klaus</option>
</select><br>

Color: <input type="text" name="color"><br>
Hourly Rate: <input type="text" name="hourlyRate"><br>
Daily Rate: <input type="text" name="dailyRate"><br>
Seating Capacity: <input type="text" name="seatingCapacity"><br>

Transmission Type:
<select name="transType">
<option value="manual">Manual</option>
<option value="auto">Automatic</option>
</select><br>

Bluetooth Connectivity:
<select name="bluetooth">
<option value="yesBluetooth">Yes</option>
<option value="noBluetooth">No</option>
</select><br>

Auxilary Cable:
<select name="auxCable">
<option value="yesAux">Yes</option>
<option value="noAux">No</option>
</select><br>


<input type="submit" value="Add">
</form>

<hr>

<p><b>Change Car Location </b></p> 

<form>

Choose current location:
<select name="currentLocation">
<option value="klaus">Klaus</option>
<option value="howey">Howey</option>
</select><br>

Choose car:
<select name="chooseCar">
<option value="civic">Honda Accord</option>
<option value="camery">Toyota Camery</option>
</select><br>
</form>

<p><b>Brief Description </b></p>

<form>
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
<option value="howey">Howey</option>
<option value="klaus">Klaus</option>
</select><br>

<input type="submit" value="Submit Changes">

</form>



