<?php  
require("db_connect.php");

if (isset($_POST['user_id']) and isset($_POST['user_pass'])){
// Assigning POST values to variables.
$username = $_POST['user_id'];
$password = $_POST['user_pass'];


// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `Users` WHERE UserID='$username' and password='$password'";

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){
session_start();
$_SESSION['username'] = $username;
$newquery = "SELECT `Usertype` FROM `Users` WHERE UserID='$username'";
$result1 = mysqli_query($connection, $newquery) or die(mysqli_error($connection));
$row=mysqli_fetch_array($result1);
$value = $row[0];
$_SESSION['usertype'] = $value;
header("Refresh: 1; url=mainpage.php");
echo 'Logged in successfully.<br/><br/>Redirecting in 1 seconds...';
}
else{
header("Refresh: 1; url=index.html");
echo 'Username/Password does not match!<br/>Redirecting in 1 seconds...';
}
}
?>