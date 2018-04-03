<?php
/*Use for alerting user on removing the approved visitor from the list by patientid and visitor num#*/
if (isset($_GET["v_num"])) {
    require("db_connect.php");
    session_start();
    echo '<script type="text/javascript">alert("'.$_GET["vnum"].'")</script>';  
    $p_id = $_SESSION["p_id"];
    $vnum = $_GET["v_num"];
    $query = "DELETE FROM `ApprovedVisitor` WHERE `PatientID` = '$p_id' AND `num` = '$vnum'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    echo '<script type="text/javascript">alert("Approved visitor has been removed from the list!")</script>';  
    header("Refresh: 0; url=mainpage.php");
}
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }

?>