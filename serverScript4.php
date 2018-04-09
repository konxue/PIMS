<?php
/*Use for alerting user on deleting the admission id by log id*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$input = $_GET["logid"];
if($input == $_SESSION['p_logid'])
{
    $_SESSION['p_logid']=null;
}
//delete medical info for visit id
$me = $_SESSION['p_id'];
$query = "DELETE FROM `onlinepims`.`MedicalInfo` WHERE `MedicalInfo`.`log_id` = '$input'AND `MedicalInfo`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
//delete bill info for the visit id
$query = "DELETE FROM `onlinepims`.`Payment` WHERE `Payment`.`log_id` = '$input' AND `Payment`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
//delete doctor note for the visit id
$query = "DELETE FROM `onlinepims`.`DoctorsNote` WHERE `DoctorsNote`.`log_id` = '$input' AND `DoctorsNote`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
//delete prescription for the visit id
$query = "DELETE FROM `onlinepims`.`Prescription` WHERE `Prescription`.`log_id` = '$input' AND `DoctorsNote`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
//delete procedures for the visit id
$query = "DELETE FROM `onlinepims`.`Procedures` WHERE `Procedures`.`log_id` = '$input' AND `Procedures`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
//delete billing items for the visit id
$query = "DELETE FROM `onlinepims`.`ItemizedList` WHERE `ItemizedList`.`log_id` = '$input' AND `ItemizedList`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
php3Alert("You have deleted the Admission ID: ".$input);
header("Refresh: 0; url=mainpage.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
 
 function php3Alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>