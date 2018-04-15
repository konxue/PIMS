<?php
/* 
    Purpose: print patient summary report for printAllreport.php under the medicalInfo page
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
*/
session_start();
require('db_connect.php'); //database connector
if(isset($_SESSION["printOut"])) //when session printout has value
{     
    $output6 =''; //output string
    date_default_timezone_set("America/Chicago");
    $newdate = date("Y/m/d");
    $newtime = date("h:i:s A"); // get current time
    $info = "SELECT `FirstName`,`LastName` FROM Users WHERE UserID = '$_SESSION[username]'"; //database query on user's first and last name
    $result1 = mysqli_query($connection, $info) or die(mysqli_error($connection));
    $row=mysqli_fetch_array($result1);
    $output6.= '************************ Patient Information Management System ************************';
    $output6.='<br><br><table class="data-table">
            <tr>
                <td></td><td></td><th>Printed by: </th><td></td><td>'.$row['FirstName'].' '. $row['LastName'] .'</td>
            </tr></table>';
    $output6.= '<br>************************ Patient Information Management System ************************<br><br>'; 
    $output6 .= $_SESSION['printOut'];//add output of table to output6
    $output6 .= '<br><br>************************ Patient Information Management System ************************';
    $output6.='<br>Current patient summary report is generated on: '.$newdate.' '.$newtime;
    header('Content-type: application/ms-excel');
    header("Content-Disposition:attachment;filename='report.xls'");//download file
    echo $output6;
    $_SESSION['printOut'] = null;//reset printout in the session
}
else
{
    echo "Print Error";
}
?>