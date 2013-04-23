<?php 
//This file is used to direct user to the appropriate page from the home screen

//Change page to appropriate selection
if($_GET['homeSelection'] == 'viewPersonalInfo'){
	header('Location: personalInfo.php');
}

else if($_GET['homeSelection'] == 'rentCar'){
	$_SESSION['rentingSuccess'] = 0;
	header('Location: rentACar.php');
}

else if($_GET['homeSelection'] == 'viewRentalInfo'){
	header('Location: rentalInfo.php');
}
?>


