<?php
/*Use for alerting user on selecting the admission ID*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$_SESSION["p_logid"] = $_GET["logid"];
header("Refresh: 0; url=medicalInfo.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
?>