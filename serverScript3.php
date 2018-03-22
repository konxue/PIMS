<?php
/*Use for alerting user on discharging the patient by log id*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$input = $_GET["logid"];
date_default_timezone_set('America/Chicago');
$newdate = date("Y/m/d");
$newtime = date("h:i:s A");
$query = "UPDATE `MedicalInfo` SET `DischargeDate` = '$newdate' , `DischargeTime` = '$newtime' Where `log_id`='$input'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
phpAlert("This patient has been discharged at ".$newdate." ".$newtime);    
header("Refresh: 0; url=mainpage.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
  function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>