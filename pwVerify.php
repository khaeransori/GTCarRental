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
<title>Password Retreival </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">


</head>
<body>

<p><b>Your Password</b></p>        

    
<form action="index.php">
<?php



$user = $_POST['un'];

$fn = $_POST['fn'];

$ln = $_POST['ln'];

$pw = mysql_result(mysql_query("SELECT Password from User where Username = '".$user."' AND Username IN( Select Username FROM Member where Username = '".$user."' AND First_Name = '".$fn."' AND Last_Name = '".$ln."')"),0);

if($pw==FALSE){
	echo "Invalid Input.";
}
else{
	echo "Your Password is: ".$pw;
}
?>

<br>

<input type="submit" name="search" value="Back to Login">

</form>

</body>
</html>
