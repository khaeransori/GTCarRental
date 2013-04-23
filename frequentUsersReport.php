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
<title>GT Car Rental: Freqeuent Users Report  </title>

<body bgcolor="#000000">
<center>
<font color="#ffffff">
<p><b>Frequent Users Report</b></p>        

</head>
<body>    

 <table>
        <thead>
            <tr>
                <td><font color="#ffffff">Username</font></td>
                <td><font color="#ffffff">Driving Plan</font></td>
                <td><font color="#ffffff">#Reservations/Month</font></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $report = mysql_query("SELECT R.Username, (COUNT( * ) /3) AS NUM, Plan AS PLAN
									FROM (
									Reservation AS R
									JOIN Member AS M ON R.Username = M.Username
									)
									WHERE R.Return_Date_Time BETWEEN DATE_SUB(now(), INTERVAL 3 MONTH) AND now()
									GROUP BY R.Username
									ORDER BY NUM DESC
									LIMIT 5;
									");
            while($row = mysql_fetch_array($report)) {
            ?>
                <tr>
                    <td><font color="#ffffff"><?php echo $row['Username']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['PLAN']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['NUM']?></font></td>
                </tr>

            <?php
            }
            ?>
        </tbody>
</table>
</body>
</html>
