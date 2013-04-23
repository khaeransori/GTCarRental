<?php 
//This file is used to direct user to the appropriate page from the admin home screen

if($_GET['reportType'] == 'locPrefReport')
	header('Location: locationPreferenceReport.php');
else if($_GET['reportType'] == 'adminReport')
	header('Location: administrativeReport.php');
else if($_GET['reportType'] == 'maintReport')
	header('Location: maintenanceHistoryReport.php');
else if($_GET['reportType'] == 'freqUsersReport')
	header('Location: frequentUsersReport.php');


?>
