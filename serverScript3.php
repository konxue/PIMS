<?php
/*Use for alerting user on discharging the patient by log id*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$input = $_GET["logid"];
$newdate = date("Y/m/d");
$newtime = date("h:i:sa");
$query = "UPDATE MedicalInfo SET DischargeDate = '$newdate', DischargeTime = '$newtime' Where log_id='$input'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
header("Refresh: 0; url=mainpage.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
?>

<script>
alert("This patient has been discharged!");    
</script>