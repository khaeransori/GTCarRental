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
     
    /* 
    The Above code can be in a different file, then you can place include'filename.php'; instead. 
    */ 
     
    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
    //$usr = mysql_real_escape_string($_POST['username']); 
    //$pas = mysql_real_escape_string($_POST['password']); 
    $user = $_POST['username'];
    $pas = $_POST['password'];


    $sql = mysql_query("SELECT * FROM User WHERE (Username = '$user') and (Password = '$pas')");

    get_defined_vars();

    if(mysql_num_rows($sql) == 1){ 
        $row = mysql_fetch_array($sql);
        $_SESSION['username'] = $row['Username'];
        $_SESSION['logged'] = TRUE;
        header('Location: users_page.php'); // Modify to go to the page you would like
        exit; 
    }else{ 
        header('Location: login_page.php'); 

        exit; 
    } 
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header('Location: createAccount.php');     
    exit; 
} 
?>