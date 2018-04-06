<?php
session_start();
require('db_connect.php'); 
if(isset($_SESSION["printOut"]))
{           
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=report.xls');
            echo $_SESSION['printOut'];
            $_SESSION['printOut'] = null;
           // header("Refresh: 1; url=".$_SERVER['HTTP_REFERER']);;
}
else
{
    echo "1";
}
?>