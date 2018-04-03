<?php
/*Use for alerting user on removing the approved visitor from the list by patientid and visitor num#*/
  function php41Alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
if (isset($_GET["vnum"])) {
require("db_connect.php");
session_start();
$input = $_SESSION["p_id"];
$v_num = $_GET["vum"];
$query2 = "DELETE FROM `ApprovedVisitor` WHERE `PatientID` = '$input' AND `num` = '$v_num'";
$result = mysqli_query($connection, $query2) or die(mysqli_error($connection));
php41Alert("Approved visitor has been removed from the list!");    
header("Refresh: 0; url=mainpage.php");
}
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }

?>