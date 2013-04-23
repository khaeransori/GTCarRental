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
<title>GT Car Rental: Location Preference Report  </title>

<body bgcolor="#000000">
<center>


</head>
<body>
<font color="#ffffff">
<p><b>Report for last 3 months</b></p>        

 <table>
        <thead>
            <tr>
                <td><font color="#ffffff">Month</font></td>
                <td><font color="#ffffff">Location</font></td>
                <td><font color="#ffffff">#Reservations</font></td>
                <td><font color="#ffffff">Hours</font></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $report = mysql_query("SELECT MONTHNAME(now()), Location_Name, MAX(M), SUM FROM(SELECT Location_Name, COUNT(Location_Name) AS M,  SUM( TIMESTAMPDIFF( HOUR , Pick_Up_Date_Time, Return_Date_Time ) ) AS Sum FROM Reservation
									WHERE Return_Date_Time BETWEEN DATE_SUB(now(), INTERVAL 1 MONTH) AND now()
									Group By Location_Name) As N
									UNION ALL
									SELECT  MONTHNAME(now()-INTERVAL 1 Month),Location_Name, MAX(M), SUM FROM(SELECT Location_Name, COUNT(Location_Name) AS M, SUM( TIMESTAMPDIFF( HOUR , Pick_Up_Date_Time, Return_Date_Time ) ) AS Sum FROM Reservation
									WHERE Return_Date_Time BETWEEN DATE_SUB(NOW( ) , INTERVAL 2 MONTH )  AND Date_Sub(Now(),Interval 1 Month)
									Group By Location_Name) As N
									UNION ALL 
									SELECT  MONTHNAME(now()-INTERVAL 2 Month),Location_Name, MAX( M ), SUM 
									FROM (
									SELECT Location_Name, COUNT( Location_Name ) AS M, SUM( TIMESTAMPDIFF( HOUR , Pick_Up_Date_Time, Return_Date_Time ) ) AS Sum 
									FROM Reservation
									WHERE Return_Date_Time
									BETWEEN DATE_SUB( NOW( ) , INTERVAL 3 MONTH ) 
									AND DATE_SUB( NOW( ) , INTERVAL 2 MONTH ) 
									GROUP BY Location_Name
									) AS N;");
            while($row = mysql_fetch_array($report)) {
            ?>
                <tr>
                    <td><font color="#ffffff"><?php echo $row['MONTHNAME(now())']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['Location_Name']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['MAX(M)']?></font></td>
                    <td><font color="#ffffff"><?php echo $row['SUM']?></font></td>
                </tr>

            <?php
            }
            ?>
        </tbody>
</table>
</body>
</html>




