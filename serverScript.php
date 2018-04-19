<?php
/*Use for alerting user on selecting the patient in the search tab*/
if (isset($_GET["pid"])) {
require("db_connect.php");
session_start();
$_SESSION["p_id"] = $_GET["pid"];
$input = $_GET["pid"];
$query = "SELECT `FirstName`,`DOB`,`LastName`,`SEX`,`UserID`,`MiddleName` FROM `PatientInfo` WHERE `PatientID` = '$input'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$newrow = mysqli_fetch_array($result);
//passing data to session variable (global)
$_SESSION["p_logid"] = null;
$_SESSION["p_fn"] = $newrow[0];
$_SESSION["p_dob"] = $newrow[1];
$_SESSION["p_ln"] = $newrow[2];
$_SESSION["p_sex"] = $newrow[3];
$_SESSION["p_pd"] = $newrow[4]; //getting family doctor for current patient
$_SESSION["p_mn"]=$newrow[5];
if ($_SESSION['usertype'] == 'Doctor' || $_SESSION['usertype'] == 'Nurse' ) //go back to the page
{
    header("Refresh: 0; url=medicalInfo.php");
}
elseif ($_SESSION['usertype'] == 'Volunteer' || $_SESSION['usertype'] == 'OfficeStaff')
{
    header("Refresh: 0; url=mainpage.php");
}
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
?>