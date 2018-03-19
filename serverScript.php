<?php
/*Use for alerting user on selecting the patient in the search tab*/
if (isset($_GET["pid"])) {
require("db_connect.php");
session_start();
$_SESSION["p_id"] = $_GET["pid"];
$input = $_GET["pid"];
$query = "SELECT `FirstName`,`DOB`,`LastName` FROM `PatientInfo` WHERE PatientID = '$input'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$newrow=mysqli_fetch_array($result);
$_SESSION["p_fn"] = newrow[0];
$_SESSION["p_dob"] = newrow[1];
$_SESSION["p_ln"] = newrow[2];
header("Refresh: 0; url=mainpage.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
?>

<script>
alert("You have selected:ID:"+<?php echo $_SESSION['p_id']?>);
</script>