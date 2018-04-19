<?php
/*Use for alerting user on removing the patient from the room by patientid*/
if (isset($_GET["p_id"])) {
require("db_connect.php");
session_start();
$input = $_GET["p_id"];
date_default_timezone_set('America/Chicago');
$newdate = date("Y/m/d");
$newtime = date("h:i:s A");
$query = "DELETE FROM `Inpatient` Where `PatientID` = '$input'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));  
header("Refresh: 0; url=mainpage.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }

?>