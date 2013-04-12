<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Personal Information   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Personal Information </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
    
<hr>   

<p><b>General Information </b></p> 

<form>
First Name: <input type="text" name="firstName"><br>
Middle Initial: <input type="text" name="middleInitial"><br>
Last Name: <input type="text" name="lastName"><br>
Email Address: <input type="text" name="email"><br>
Phone Number: <input type="text" name="phone"><br>
Address: <input type="text" name="phone"><br>

<hr>

<p><b>Membership Information </b></p> 

Choose a plan:<br>

<input type="radio" name="homeSelection" value="occasionalDriving">Occasional Driving
<input type="radio" name="homeSelection" value="frequentDriving">Frequent Driving
<input type="radio" name="homeSelection" value="dailyDriving">Daily Driving<br>


<hr>

<p><b>Payment Information </b></p> 
Name on card: <input type="text" name="cardName"><br>
Card number: <input type="text" name="cardNum"><br>
CVV: <input type="text" name="cardCVV"><br>
Expiry Date: <input type="text" name="cardExpiry"><br>
Billing Address: <input type="text" name="cardBillingAddress"><br>
<input type="submit" value="Done">
</form>
