<?php
/*Use for alerting user on discharging the patient by log id*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$input = $_GET["logid"];
$p_id = $_SESSION["p_id"];
date_default_timezone_set('America/Chicago'); //timezone
$newdate = date("Y/m/d");
$newtime = date("h:i:s A");
$query = "UPDATE `MedicalInfo` SET `DischargeDate` = '$newdate' , `DischargeTime` = '$newtime' Where `log_id`='$input'"; //put discharge time to the database
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$query = "DELETE FROM `Inpatient` Where `PatientID` = '$p_id'"; //remove patient from the room
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
phpAlert("This patient has been discharged at ".$newdate." ".$newtime);    
header("Refresh: 0; url=mainpage.php"); //go back to the page
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