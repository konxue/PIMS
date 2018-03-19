<?php
/*Use for alerting user on selecting the admission ID*/
if (isset($_GET["logid"])) {
require("db_connect.php");
session_start();
$_SESSION["p_logid"] = $_GET["logid"];
header("Refresh: 0; url=mainpage.php");
 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
?>

<script>
alert("You have selected the Admission Log ID: "+<?php echo $_SESSION['p_logid'] ?>);    
</script>