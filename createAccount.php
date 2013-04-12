<?php
//retrieve session data
  session_start();
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $mgrssn = $_SESSION['manager'];  
?>
 
<html>
<head>
<title>GT Car Rental: Create Account   </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Create Account </b></p>        


<!-- ************************************************************* -->  

<?php


 ?>


<!-- ************************************************************* -->  
       

<form>
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
Confirm password: <input type="password" name="passwordConfirm"><br>
<select name="userType">
<option value="gtStudentFaculty">Georgia Tech Student/Faculty</option>
<option value="gtcrEmployee">GTCR Employee</option>
</select><br>
<input type="submit" value="Submit">
</form>
