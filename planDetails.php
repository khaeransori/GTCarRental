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
<title>GT Car Rental: Maintenance History Report  </title>

<body bgcolor="#000000">
<center>


</head>
<body>
<font color="#ffffff">
<p><b>Maintenance History Report</b></p>        

 <table>
        <thead>
            <tr>
                <td><font color="#ffffff">Type</font></td>
                <td><font color="#ffffff">Discount</font></td>
                <td><font color="#ffffff">Annual Fees</font></td>
                <td><font color="#ffffff">Monthly Payment</font></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $report = mysql_query("SELECT * FROM Driving_Plan;");
            while($row = mysql_fetch_array($report)) {
            ?>
                <tr>
                    <td><font color="#ffffff"><?php echo $row['Type']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Discount']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Annual_Fees']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Monthly_Payment']?></font></td>
                </tr>

            <?php
            }
            ?>
        </tbody>
</table>
</body>
<form action = "personalInfo.php">
<input type="submit" value="Back">
</form>
</html>

