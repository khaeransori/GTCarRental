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
<title>GT Car Rental: Administrative Report  </title>

<body bgcolor="#000000">
<center>


</head>
<body>
<font color="#ffffff">
<p><b>Administrative Report for Last 3 Months</b></p>        

 <table>
        <thead>
            <tr>
                <td><font color="#ffffff">Vehicle Sno</font></td>
                <td><font color="#ffffff">Type</font></td>
                <td><font color="#ffffff">Car Model</font></td>
                <td><font color="#ffffff">Reservation Revenue</font></td>
                <td><font color="#ffffff">Late Fee Revenue</font></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $report = mysql_query('SELECT Car.Serial_Number, Model,Type,SUM(Estimated_Cost) 
            AS "Reservation Revenue",Sum(Late_Fees) AS "Revenue from Late Fees" FROM Car 
            JOIN  Reservation ON Car.Serial_Number = Reservation.Serial_Number 
			Group By (Serial_Number)
			Order By (SUM(Estimated_Cost)) Desc;');
            while($row = mysql_fetch_array($report)) {
            ?>
                <tr>
                    <td><font color="#ffffff"><?php echo $row['Serial_Number']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Type']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Model']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Reservation Revenue']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Revenue from Late Fees']?></font></td>
                </tr>

            <?php
            }
            ?>
        </tbody>
</table>
</body>
</html>
