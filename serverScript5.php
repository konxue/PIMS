<?php
/*Use for alerting user on deleting the doctor notes by note id*/
if (isset($_GET["noteid"])) {
require("db_connect.php");
session_start();
$input = $_GET["noteid"];

//delete doctor note for note id
$me = $_SESSION['p_id'];
$query = "DELETE FROM `onlinepims`.`DoctorsNote` WHERE `DoctorsNote`.`note_id` = '$input'AND `DoctorsNote`.`PatientID` = '$me'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
php5Alert("You have deleted the medical note!\\nNote id: ".$input);
header("Refresh: 0; url=medicalInfo.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
 
 function php5Alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>