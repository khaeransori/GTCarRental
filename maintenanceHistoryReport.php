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
                <td><font color="#ffffff">Car</font></td>
                <td><font color="#ffffff">Date-Time</font></td>
                <td><font color="#ffffff">Employee</font></td>
                <td><font color="#ffffff">Problem</font></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $report = mysql_query("SELECT Q.Model, Q.Date_Time, Q.Username, Q.Problem
									FROM (
									(

									SELECT c.Model, c.Serial_Number, m.Date_Time, m.Username, p.Problem
									FROM Car c
									INNER JOIN Maintenence_Request m ON c.Serial_Number = m.Serial_Number
									INNER JOIN Problem p ON p.Serial_Number = m.Serial_Number
									AND p.Date_Time = m.Date_Time
									) AS Q
									JOIN (

									SELECT c.Serial_Number, COUNT( * ) AS Total
									FROM Car c
									INNER JOIN Maintenence_Request m ON c.Serial_Number = m.Serial_Number
									INNER JOIN Problem p ON p.Serial_Number = m.Serial_Number
									AND p.Date_Time = m.Date_Time
									GROUP BY c.Model
									ORDER BY  `Total` DESC
									) AS T ON Q.Serial_Number = T.Serial_Number
									)
									ORDER BY T.Total DESC
									;");
            while($row = mysql_fetch_array($report)) {
            ?>
                <tr>
                    <td><font color="#ffffff"><?php echo $row['Model']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Date_Time']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Username']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Problem']?></font></td>
                </tr>

            <?php
            }
            ?>
        </tbody>
</table>
</body>
</html>
