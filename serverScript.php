<?php
 if (isset($_GET["pid"])) {

session_start();
$_SESSION["p_id"] = $_GET["pid"];
header("Refresh: 0; url=mainpage.php");

 }
 else
 {
     echo "404 Invalid request";
     header("Refresh: 1; url=index.html");
 }
?>

<script>
alert("ID selected: "+<?php echo $_SESSION['p_id'] ?>);    
</script>