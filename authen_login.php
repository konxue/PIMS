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

header("Refresh: 2; url=mainpage.html");
echo 'Logged in successfully.';

}else{
    
header("Refresh: 2; url=loginpage.html");
echo 'Username/Password does not match!';
}
}
?>

<script>
    function fun1() {
    alert("Login Successfully");
    }
    function fun2()
    {
    alert("Username/Password does not match!");
    }
</script>