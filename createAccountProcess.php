<?php 
session_start(); 
if(isset($_POST['submit'])){ 

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

    $male_status = 'unchecked';
    $female_status = 'unchecked';

    
   if(mysql_num_rows($userExistsSql) == 0){ //if user doesn't already exist
        if ($pass == $passConfirm) { //if passwords match
            //SQL Statements to insert user to databases
            //TODO Ensure that the 2 sql statements below are "running"
            $insertUserSql = mysql_query("INSERT INTO User (Username, Password) VALUES ('$user', '$pass')") or die(mysql_error());
            $insertUserTypeSql = mysql_query("INSERT INTO $Type_Of_User VALUES ('$user');") or die(mysql_error());
            
            $row = mysql_fetch_array($userExistsSql);
            $_SESSION['username'] = $row['Username'];
            header('Location: home.php');
            exit; 
        } else {
             //TODO print something that says passwords don't match
            exit;
    } else {
        //TODO print something that says user already exists
        exit;
    }
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header('Location: createAccount.php'); //TODO verify that this is correct   
    exit; 
} 
?>
