<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<title>Logging... - Patient Information Management System</title>
<?php  
require("db_connect.php");
if (isset($_POST['user_id']) && isset($_POST['user_pass'])){
// Assigning POST values to variables.
$username = $_POST['user_id'];
$password = $_POST['user_pass'];


// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `Users` WHERE UserID='$username' and password='$password'";

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){
// Start the session for user to log on the different page
session_start();
// Getting data from database then store to PHP variable
$_SESSION['username'] = $username;
$query = "SELECT `Usertype`,`FirstName`,`LastName`  FROM `Users` WHERE UserID='$username'";
$result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row=mysqli_fetch_array($result1);
$_SESSION['usertype'] = $row[0];
$_SESSION['firstname'] = $row[1];
$_SESSION['lastname'] = $row[2];
if($_SESSION['usertype'] == 'Doctor' || $_SESSION['usertype'] == 'Nurse')
{
header("Refresh: 1; url=medicalInfo.php");
echo 'Logged in successfully.<br/><br/>Redirecting in 1 seconds...';
}
elseif ($_SESSION['usertype'] == 'OfficeStaff' || $_SESSION['usertype'] == 'Volunteer')
{
header("Refresh: 1; url=mainpage.php");
echo 'Logged in successfully.<br/><br/>Redirecting in 1 seconds...';   
}
}
elseif ($count == 0){
header("Refresh: 2; url=index.html");
echo 'Username/Password does not match!<br/><br/>Redirecting in 2 seconds...';
}
}
?>