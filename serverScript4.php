<?php
/*Use for alerting user on deleting the patient by log id*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$input = $_GET["logid"];
$query = "DELETE FROM `onlinepims`.`MedicalInfo` WHERE `MedicalInfo`.`log_id` = '$input'";
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
alert("You have deleted the Admission Log ID: "+<?php echo $_SESSION['p_logid'] ?>);    
</script>