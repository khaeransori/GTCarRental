<?php 
//This file is used to direct user to the appropriate page from the employee home screen

//Change page to appropriate selection
if($_GET['homeSelection'] == 'manageCars'){
	header('Location: manageCars.php');
}

else if($_GET['homeSelection'] == 'maintenanceReq'){
	header('Location: maintenanceRequests.php');
}

else if($_GET['homeSelection'] == 'rentalChangeReq'){
	header('Location: rentalChangeReq.php');
}
else if($_GET['homeSelection'] == 'viewReports'){
	if($_GET['reportType'] == 'locPrefReport')
		header('Location: locationPreferenceReport.php');
	else if($_GET['reportType'] == 'adminReport')
		header('Location: administrativeReport.php');
	else if($_GET['reportType'] == 'maintReport')
		header('Location: maintenanceHistoryReport.php');
	else if($_GET['reportType'] == 'freqUsersReport')
		header('Location: frequentUsersReport.php');
}
else
	header('Location: employeeHome.php');

?>

