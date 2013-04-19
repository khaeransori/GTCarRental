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


    $sql = mysql_query("SELECT * FROM User WHERE (Username = '$user') and (Password = '$pas')");

    get_defined_vars();

    if(mysql_num_rows($sql) == 1){ 
        $row = mysql_fetch_array($sql);
        $_SESSION['username'] = $row['Username'];
        $_SESSION['logged'] = TRUE;
        header('Location: home.php');
        exit; 
    }else{ 
        header('Location: index.php'); 

        exit; 
    } 
} 
?>
