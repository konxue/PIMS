<?php  
require('db_connect.php');
if (isset($_POST['user_id']) and isset($_POST['user_pass'])){
// Assigning POST values to variables.
$username = $_POST['user_id'];
$password = $_POST['user_pass'];


// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `Users` WHERE UserID='$username' and password='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){

header("Refresh: 2; url=mainpage.php");
session_start();
$_SESSION['username'] = $username;
echo 'Logged in successfully. '.$_SESSION['username'];
}else{
    
header("Refresh: 2; url=index.html");
echo 'Username/Password does not match!';
}
}
?>