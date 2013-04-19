<?php
//retrieve session data
  session_start();
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


<!-- ************************************************************* -->  
       

<form action="createAccountProcess.php" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
Confirm password: <input type="password" name="passwordConfirm"><br>
<select name="userType">
<option value="gtStudentFaculty">Georgia Tech Student/Faculty</option>
<option value="gtcrEmployee">GTCR Employee</option>
</select><br>
<input type="submit" name="submit" value="Submit">
</form>
