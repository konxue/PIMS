<?php
session_start();
require('db_connect.php'); 
if(isset($_SESSION["printOut"]))
{     
    $output6 ='';
    date_default_timezone_set("America/Chicago");
   
    $newdate = date("Y/m/d");
    $newtime = date("h:i:s A");
    $info = "SELECT `FirstName`,`LastName` FROM Users WHERE UserID = '$_SESSION[username]'";
    $p_info = "SELECT `FirstName`, `LastName`,`UserID` FROM PatientInfo WHERE PatientID = '$_SESSION[p_id]'";
    $result1 = mysqli_query($connection, $info) or die(mysqli_error($connection));  
    $result2 = mysqli_query($connection, $p_info) or die(mysqli_error($connection));   
     $output6.= '---------------------------------------- Patient Information Management System ----------------------------------------';
     $output6.='<br><br><table class="data-table">
            <tr>
                <th>Printed by</th><td></td>
                <th>Doctor Name</th><td></td>
                <th>Patient Last Name</th><td></td>
                <th>Patient First Name</th>
            </tr>';
        $row=mysqli_fetch_array($result1);
        $newrow=mysqli_fetch_array($result2);
        $n1 = $newrow['UserID'];
        $query = "SELECT `LastName`,`FirstName` FROM `Users` WHERE UserID='$n1'";
        $result3 = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $newrow11=mysqli_fetch_array($result3);
        $doctorLN = $newrow11[0];
        $doctorFN = $newrow11[1];           
        $output6 .= "<td><center>".$row['FirstName']." ". $row['LastName'] ."</center></td><td></td>";
        $output6 .= "<td><center>Dr. ".$doctorFN." ".$doctorLN."</center></td><td></td>";
        $output6 .= "<td><center>". $newrow['LastName'] ."</center></td><td></td>";
        $output6 .= "<td><center>". $newrow['FirstName'] ."</center></td>";
        $output6.= '</table><br>---------------------------------------- Patient Information Management System ----------------------------------------<br><br>'; 
    
    $output6 .= $_SESSION['printOut'];
    $output6 .= '<br><br><br>---------------------------------------- Patient Information Management System ----------------------------------------';
    $output6.='<br>Reported Generated on: '.$newdate.' '.$newtime;
    header('Content-type: application/ms-excel');
    header("Content-Disposition:attachment;filename='report.xls'");
    echo $output6;
    $_SESSION['printOut'] = null;
   // header("Refresh: 1; url=".$_SERVER['HTTP_REFERER']);;
}
else
{
    echo "1";
}
?>