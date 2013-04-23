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
 session_start(); 
 $username = $_SESSION['username'];

 $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
 $dbUser = "cs4400_Group_59";            //Database User Name 
 $dbPass = "sg44Hlvd";            //Database Password 
 $dbDatabase = "cs4400_Group_59";    //Database Name 
     
 $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
 //Connect to the databasse 
 mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
 //Selects the database 

 $sql = mysql_query("SELECT * FROM Member WHERE (Username = '$username')");
 $sqlrows = mysql_fetch_array($sql);  
?>


<!-- ************************************************************* -->  
    
<hr>   

<p><b>General Information </b></p> 

<form action="verifyPersonalInfo.php" method="post">
First Name: <input type="text" name="firstName" value="<?php echo $sqlrows['First_Name']; ?>"><br>
Middle Initial: <input type="text" name="middleInitial" value="<?php echo $sqlrows['Middle_Initial']; ?>"><br>
Last Name: <input type="text" name="lastName" value="<?php echo $sqlrows['Last_Name']; ?>"><br>
Email Address: <input type="text" name="email" value="<?php echo $sqlrows['Email']; ?>"><br>
Phone Number: <input type="text" name="phone" value="<?php echo $sqlrows['Phone_Number']; ?>"><br>
Address: <input type="text" name="address" value="<?php echo $sqlrows['Address']; ?>"><br>

<hr>

<p><b>Membership Information </b></p> 

Choose a plan:<br>

<?php
//Check the proper radio button
if($sqlrows['Plan'] == 'occasionalDriving')
	$checkOD = "checked";
else if($sqlrows['Plan'] == 'frequentDriving')
	$checkFD = "checked";
else
	$checkDD = "checked";

?>

<input type="radio" name="planSelect" value="occasionalDriving" <?php echo $checkOD?>>Occasional Driving
<input type="radio" name="planSelect" value="frequentDriving" <?php echo $checkFD?>>Frequent Driving
<input type="radio" name="planSelect" value="dailyDriving" <?php echo $checkDD?>>Daily Driving<br>

<input type="submit" name="planDetail" value="View Plan Details">
<hr>

<p><b>Payment Information </b></p> 
Name on card: <input type="text" name="cardName" value="<?php echo $sqlrows['Name_On_Card']; ?>"><br>
Card number: <input type="text" name="cardNum" value="<?php echo $sqlrows['Card_Number']; ?>"><br>
CVV: <input type="text" name="cardCVV" value="<?php echo $sqlrows['CVV']; ?>"><br>
Expiry Date: <input type="text" name="cardExpiry" value="<?php echo $sqlrows['Expiry_Date']; ?>"><br>
Billing Address: <input type="text" name="cardBillingAddress" value="<?php echo $sqlrows['Billing_Address']; ?>"><br>
<input type="submit" value="Done">
</form>
