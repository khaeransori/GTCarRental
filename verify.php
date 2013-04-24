<?php 
session_start(); 
if(isset($_POST['submit'])){ 

    $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
    $dbUser = "cs4400_Group_59";            //Database User Name 
    $dbPass = "sg44Hlvd";            //Database Password 
    $dbDatabase = "cs4400_Group_59";    //Database Name 
     
    $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); 
    //Connect to the databasse 
    mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
    //Selects the database 

    $user = $_POST['username'];
    $pas = $_POST['password'];
    $_SESSION['loginFail'] = 0;

	//Get User from the user table
    $sql = mysql_query("SELECT * FROM User WHERE (Username = '$user') and (Password = '$pas')");

	//Check to see if user exists
    if(mysql_num_rows($sql) == 1){ 
        $row = mysql_fetch_array($sql);
        $_SESSION['username'] = $row['Username'];
	   $_SESSION['rentingSuccess'] = 0;
    }else{ 
        $_SESSION['loginFail'] = 1;
        header('Location: index.php'); 
        exit;
    } 
    
    //Check to see if user is an employee or just a member
    $memberCheck = mysql_query("SELECT * FROM Member WHERE (Username = '$user')");
    $employeeCheck = mysql_query("SELECT * FROM Employee WHERE (Username = '$user')");
    $adminCheck = mysql_query("SELECT * FROM Administrator WHERE (Username = '$user')");
    if(mysql_num_rows($memberCheck) == 1){
		header('Location: home.php');
	}
	else if(mysql_num_rows($employeeCheck) == 1){
		header('Location: employeeHome.php');
	}
	else if(mysql_num_rows($adminCheck) == 1){
		header('Location: adminHome.php');
	}
	else
		header('Location: index.php');
} 
?>
