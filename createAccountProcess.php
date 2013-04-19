<?php 
session_start(); 
if(isset($_POST['Submit'])){ 

    $dbHost = "academic-mysql.cc.gatech.edu";         //Location Of Database usually its localhost 
    $dbUser = "cs4400_Group_59";            //Database User Name 
    $dbPass = "sg44Hlvd";            //Database Password 
    $dbDatabase = "cs4400_Group_59";    //Database Name 
     
    $db = mysql_connect($dbHost,$dbUser,$dbPass)or die("Error connecting to database."); //Connect to the databasse 
    
    mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); //Selects the database 
  
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $passConfirm = $_POST['passwordConfirm'];
    $userType = $_POST['userType'];

    $userExistsSql = mysql_query("SELECT * FROM User WHERE (Username = '$user')") or die(mysql_error());

    
    if(mysql_num_rows($userExistsSql) == 0){ //if user doesn't already exist
        if ($pass == $passConfirm) { //if passwords match
            //SQL Statements to insert user to databases
            //TODO Ensure that the 2 sql statements below are "running"
            $insertUserSql = mysql_query("INSERT INTO User (Username, Password) VALUES ('$user', '$pass')") or die(mysql_error());
            
	    if($userType == 'gtStudentFaculty'){
            	mysql_query("INSERT INTO Member (Username) VALUES ('$user')");
		$_SESSION['username'] = $user;
	    	header('Location: personalInfo.php');
	    }
            else{
		mysql_query("INSERT INTO Employee (Username) VALUES ('$user')");
		$_SESSION['username'] = $user;
		header('Location: employeeHome.php');
	    }

            exit; 
        } else {
             echo "Passwords didn't match";
            exit;
    } 
    else {
        echo "User already exists";
        exit;
    }
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header('Location: createAccount.php'); //TODO verify that this is correct   
    exit; 
} 
?>
