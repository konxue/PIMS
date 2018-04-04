<?php
/*Use for alerting user on removing the approved visitor from the list by patientid and visitor num#*/
if (isset($_GET["vnum"])) 
{
    require("db_connect.php");
    session_start();
    $p_id = $_SESSION["p_id"];
    $vnum = $_GET["vnum"];
    $query = "DELETE FROM `ApprovedVisitor` WHERE `PatientID` = '$p_id'AND `num` = '$vnum'";
    $res = mysqli_query($connection, $query) or die(mysqli_error($connection));
    php3Alert("Approved visitor has been removed from the list!");
    header("Refresh: 0; url=mainpage.php");
 }
 
 
 function php3Alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>