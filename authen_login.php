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

//echo "Login Credentials verified";
echo "<script type='text/javascript'>alert('Login Successfully!')</script>";
sleep(3);
 header('Location: mainpage.html' );
}else{
echo "<script type='text/javascript'>alert('Username/Password does not match!')</script>";
sleep(3);
header('Location: loginpage.html');
//echo "Invalid Login Credentials";
}
}
?>