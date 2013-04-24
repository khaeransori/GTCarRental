<?php
	session_start(); 
?>

<html>
<head>
<title>GT Car Rental: Login</title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">

</head>
<body>

<p><b>GT Car Rental Login </b></p>  


<?php
	if ($_SESSION['loginFail'] == 1) {
			echo "Incorrect username or password<br>";
			$_SESSION['loginFail'] = 0;
		}
?>


<form action="verify.php" method="post">
    User Name:<br>
    <input type="text" name="username"><br><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <input type="submit" name="submit" value="Login">
</form>

<form action="createAccount.php" method="post">
    <input type="submit" name="createAccount" value="Create Account">
</form>

<form action="forgotPass.php" method="post">
    <input type="submit" name="forgotPass" value="Forgot Password?">
</form>