<?php
 session_start(); 
 if(isset($_POST['planDetail'])){
	 header('Location: planDetails.php');
	 exit;
 }
 $username = $_SESSION['username'];

 $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
 $dbUser = "cs4400_Group_59";            //Database User Name 
 $dbPass = "sg44Hlvd";            //Database Password 
 $dbDatabase = "cs4400_Group_59";    //Database Name 
     
 $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
 //Connect to the databasse 
 mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
 //Selects the database 
//Take personal info and set it up into the database

$First_Name = $_POST['firstName'];
$Middle_Initial = $_POST['middleInitial'];
$Last_Name = $_POST['lastName'];
$Email = $_POST['email'];
$Phone_Number = $_POST['phone'];
$Address = $_POST['address'];
$Plan = $_POST['planSelect'];
$Name_On_Card = $_POST['cardName'];
$Card_Number = $_POST['cardNum'];
$CVV = $_POST['cardCVV'];
$Expiry_Date = $_POST['cardExpiry'];
$Billing_Address = $_POST['cardBillingAddress'];

mysql_query("UPDATE Member SET Address = '$Address', Email = '$Email', First_Name = '$First_Name', Middle_Initial = '$Middle_Initial', Last_Name = '$Last_Name', Phone_Number = '$Phone_Number', Card_Number = '$Card_Number', Name_On_Card = '$Name_On_Card', CVV='$CVV', Expiry_Date = '$Expiry_Date', Billing_Address = '$Billing_Address', Plan = '$Plan'
WHERE Username = '$username';
");

header('Location: home.php');
?>
