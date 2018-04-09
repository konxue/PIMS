<?php
session_start();
require('db_connect.php'); 
if(isset($_SESSION["printOut"]))
{     
    $output6 ='';
    
    $info = "SELECT  `LastName` FROM Users WHERE UserID = '$_SESSION[username]'";
    $p_info = "SELECT `FirstName`, `LastName` FROM PatientInfo WHERE PatientID = '$_SESSION[p_id]'";
    $result1 = mysqli_query($connection, $info) or die(mysqli_error($connection));  
    $result2 = mysqli_query($connection, $p_info) or die(mysqli_error($connection)); 
    $output6.= '=================================PIMS===========================================<br>
        <table class="data-table">
            <tr>
                <th>Doctors Name</th>
                <th>Patient Last Name</th> 
                <th>Patient First Name</th>
            </tr>';
                   
        $row = mysqli_fetch_array($result1);
        $output6 .= "<td><center>Dr. ". $row['LastName'] ."</center></td>";
        $row = mysqli_fetch_array($result2);
        $output6 .= "<td><center>". $row['LastName'] ."</center></td>";
        $output6 .= "<td><center>". $row['FirstName'] ."</center></td>";
        $output6.= '</table>================================================================================<br><br>'; 
    
    $output6 .= $_SESSION['printOut'];
        
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=report.xls');
    echo $output6;
    $_SESSION['printOut'] = null;
   // header("Refresh: 1; url=".$_SERVER['HTTP_REFERER']);;
}
else
{
    echo "1";
}
?>