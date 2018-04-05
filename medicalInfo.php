<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="css/tablestyle.css">
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Medical Information System - Patient Information Management System</title>
<link rel="stylesheet" type="text/css" href="mainpage.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
include 'checkStatus.php';
if($_SESSION['usertype'] == 'OfficeStaff' || $_SESSION['usertype'] == 'Volunteer' ||  $_SESSION['usertype'] == null)
{
    pAlert("Unauthorized access! Return to mainpage!");
    header("Refresh: 1; url=mainpage.php");
}
?>
<br><br>
<a href="mainpage.php" class="btn btn-info btn-small">
          <span class="glyphicon glyphicon glyphicon-arrow-left"></span> Main Page
        </a>
<center><img src="images/doctor.png" height="200" width="200"/></center>
</head>
<footer>
    <link rel="stylesheet" type="text/css" href="mainpage.css"/>
    <div class="footer"><center>Patient Information Management System V 1.0  © All rights reserved 2018</center></div>
</footer>
<br>

<body>
    <?php include 'patientTable.php'?>
    <br><center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchtab">Find Patient</button></center>
        <div id="searchtab" class="collapse">
            <?php include 'FindPatient.php' ?>
        </div></center>
    <?php include 'currentSelection.php'?>;
    <br><center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#ad1">Show Admission Record</button></center>
    <div id="ad1" class="collapse">
    <?php include 'medicalRecord.php'?>
    </div></center>
<br>
<div class="tab">
  <button class="tablinks" onclick="openItem(event, 'DoctorNotes')">Treatment Notes</button>
  <button class="tablinks" onclick="openItem(event, 'Procedures')">Procedures</button>
  <button class="tablinks" onclick="openItem(event, 'Prescriptions')">Prescriptions</button>
  <button class="tablinks">|</button>
  <button class="tablinks" onclick="openItem(event, 'PatientInfo')">Patient Information</button>
  <button class="tablinks" onclick="openItem(event, 'InsuranceInfo')">Insurance Information</button>
</div>

<div id="DoctorNotes" class="tabcontent">
    <?php
    session_start();
    if($_SESSION['p_logid'] == null)
    {
        echo "<strong><center>Please select a visit id from the admission record!</center></strong>";
    }
 else {//when logid has passed from pervious page
    require("db_connect.php");
    
    echo '
        <br><center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tab">Add Notes</button></center>
        <div id="tab" class="collapse">
        <br>
        <form id="form" method="post">
          <table border="0.5" class="data-table" width="800" height="200">
            <tr>
                <td><strong><label for="text"><center>Note:</label></strong></td>
                <td><center><textarea name="notetext" id="notetext" rows="8" cols="50"></textarea></center></td>
                <td><input type="submit" name="submit_8" value="Add" />
            </tr>
           </table>
        </form>
        </div>
        <br>';
    
    $input = $_SESSION['p_id'];
    $logid = $_SESSION['p_logid'];
    if ($_POST["submit_8"])
    {
        date_default_timezone_set("America/Chicago");//time zone
        $newdate = date("Y/m/d");
        $newtime = date("h:i:s A");
        $note = (string) addslashes($_POST['notetext']);
        $input = $_SESSION['p_id'];
        $logid = $_SESSION['p_logid'];
        $sql = "Select `note_id` From `DoctorsNote` ORDER BY `note_id` DESC"; //primary key
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($result);
        $noteid = $row[0] + 1; //new primary key for note id
        $drid = $_SESSION['username'];
        $sql = "INSERT INTO `onlinepims`.`DoctorsNote` (`PatientID`, `log_id`, `note_id`, `Date`, `Time`, `Note`, `UserID`) VALUES ('$input', '$logid', '$noteid', '$newdate', '$newtime', '$note','$drid')";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        pAlert("New note has been added into the system!");
    }
    $sql = "Select * FROM `DoctorsNote` WHERE `PatientID` = '$input' AND `log_id` = '$logid' ORDER BY `note_id` DESC";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
            echo '<br><table class="data-table">
                 <caption class="title"><center>Notes Displayer</center></caption>
        <thead>
                <tr>
                <th><center>Note #</center></th>
                <th><center>Visit #</center></th>
                <th><center>Doctor/Nurse Name</center></th>
                <th><center>Note</center></th>
                <th><center>Note Date</center></th>
                <th><center>Note Time</center></th>
                <th><center>Delete</center></th>
                </tr>
        </thead>';
            if ($count == 0) // when empty record in the database
            {
                  echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>Not notes exist!</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
            }
 else {
     while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td><center>" . $row['note_id'] . "</center></td>";
        echo "<td><center>" . $row['log_id'] . "</center></td>";
        $n1 = $row['UserID'];
        $query = "SELECT `LastName`,`FirstName`,`UserType` FROM `Users` WHERE UserID='$n1'";
        $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $newrow=mysqli_fetch_array($result1);
        $doctorLN = $newrow[0];
        $doctorFN = $newrow[1];
        $uType = $newrow[2];
        if ($uType == "Doctor")
        {
        echo "<td><center>Dr. ".$doctorFN." " .$doctorLN."</center></td>";
        }
        else
        {
        echo "<td><center>Nurse ".$doctorFN." " .$doctorLN."</center></td>";    
        }
        echo "<td><center>" . $row['Note'] . "</center></td>";
        echo "<td><center>" . $row['Date'] . "</center></td>";
        echo "<td><center>" . $row['Time'] . "</center></td>";
        if ($_SESSION['usertype'] == $uType || $_SESSION['usertype'] == 'Doctor')
        {
        echo '<td><center><button id='.$row['note_id'].' onClick=callFunction4(this.id) name=grr>Delete</button></center></td>';
        }
        else
        {
            echo "<td><center></center></td>";
        }
        echo "</tr>";
    }
    }
    echo "</table><br><br><br>";
    mysqli_close($connection);
 }
         function pAlert($msg) {
         echo '<script type="text/javascript">alert("' . $msg . '")</script>';}
?>
</div>


<div id="Procedures" class="tabcontent">
     <?php
    session_start();
    if($_SESSION['p_logid'] == null)
    {
        echo "<strong><center>Please select a visit id from the admission record!</center></strong>";
    }
    else
    {
        
    }   
    ?>
</div>


<div id="Prescriptions" class="tabcontent">
 <?php
    session_start();
    if($_SESSION['p_logid'] == null)
    {
        echo "<strong><center>Please select a visit id from the admission record!</center></strong>";
    }
    else
    {
        require("db_connect.php");
         echo '
        <center><br>
        <form id="search-form" method="post">
        <table border="0.5" class="data-table">
        <caption class="title"><center>Add Prescription</center></caption>
                <thead>
                <tr>
                <td><strong><label for="text"><center>Medicine Name</label></strong></td>
                <td><input type="p_text" name="mtext" id="mtext"></center></td>
                <td><strong><label for="text"><center>Dosage</label></strong></td>
                <td><input type="p_text" name="dtext" id="dtext"></center></td>
                <td><strong><label for="text"><center>Quantity</label></strong></td>
                <td><input type="p_text" name="qtext" id="qtext"></center></td>
                <td><strong><label for="text"><center>Direction</label></strong></td>
                <td><textarea name="diretext" id="diretext" rows="2" cols="35"></textarea></td>
                <td><input type="submit" name="submit_23" value="Add" /></td>
                </tr>
                </thead>
                </table>
        </center>';
        if ($_POST['submit_23'])
        {
            $input = $_SESSION['p_id'];
            $logid = $_SESSION['p_logid'];
            $user = $_SESSION['username'];
            $sql = "SELECT * FROM Prescription order by `pk` DESC";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $rowforpk = mysqli_fetch_array($result);
            $newpk = $rowforpk['pk'] + 1;
            $mname = (string) addslashes($_POST['mtext']);
            $dos = (string) addslashes($_POST['dtext']);
            $quantity = $_POST['qtext'];
            $direction = (string) addslashes($_POST['diretext']);
            if( (!is_numeric($quantity)) || !isset($mname) || !isset($dos) || !isset($direction))
            {
                
                pAlert("Detect incorrect input, please try again!");
            }
            else
            {
                $sql = "INSERT INTO `onlinepims`.`Prescription` (`PatientID`, `UserID`, `log_id`, `pk`, `PrescripName`, `Dosage`, `Quantity`, `Directions`) VALUES ('$input', '$user','$logid', '$newpk', '$mname', '$dos', '$quantity','$direction')";
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                pAlert("New prescription has been added into the system!");
            }
        }
        $input = $_SESSION['p_id'];
        $logid = $_SESSION['p_logid'];
        $sql = "SELECT * FROM Prescription Where PatientID = '$input' and log_id = '$logid' order by `pk`";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $count = mysqli_num_rows($result);
        if($count == 0)
        {
            echo '<br><table class="data-table">
            <thead>';
        echo "<tr>";
        echo "<th><center>No prescription is found!</center></td>";
        echo "</tr></thead></table><br><br>";
        }
        else
        {
            echo '<br><table class="data-table">
                <center><caption class="title"><center>Prescription Record</caption></center>
        <thead>';
        echo "<tr>";
        echo "<th><center>Prescription #</center></td>";
        //echo "<th><center>Doctor</center></td>";
        echo "<th><center>Medicine Name</center></th>";
        echo "<th><center>Dosage</center></th>";
        echo "<th><center>Quantity</center></th>";
        echo "<th><center>Direction</center></th>";
        echo "<th><center>Delete</center></th>";
        echo "</tr></thead><tbody>";
        while($row=mysqli_fetch_array($result))
        {
            echo"<tr><td><center>".$row['pk']."</center></td>";
            //where this fetch doctor name based on userid
            $n1 = $row['UserID'];
            $query = "SELECT `LastName`,`FirstName` FROM `Users` WHERE UserID='$n1'";
            $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $newrow=mysqli_fetch_array($result1);
            $doctorLN = $newrow[0];
            $doctorFN = $newrow[1];
            //echo"<td><center>Dr. ".$doctorFN." ".$doctorLN."</center></td>";
            echo"<td><center>".$row['PrescripName']."</center></td>";
            echo"<td><center>".$row['Dosage']."</center></td>";
            echo"<td><center>".$row['Quantity']."</center></td>";
            echo"<td><center>".$row['Directions']."</center></td>";
            echo '<form id="search-form" method="post">';
            echo '<td><center><input type="hidden" name="pk_id" value="'.$row['pk'].'"/>
                <input type="submit" name="submit_delete" value="Delete" /></center></td>		
                </form></tr>';
        }
        echo "</tbody></table><br><br>";
        }
        if(isset($_POST["submit_delete"])) // when delete button is click
{
    require("db_connect.php");
    $pknum = $_POST["pk_id"];
    $query = "DELETE FROM `Prescription` WHERE `pk` = '$pknum'";
    $rest = mysqli_query($connection, $query) or die(mysqli_error($connection));
    pAlert("Selected prescription has been removed!");
    echo "<meta http-equiv='refresh' content='0'>"; 
 }
    }   
?>
</div>
<div id="PatientInfo" class="tabcontent">
<?php include 'patientinfo.php'?>
</div>
<div id="InsuranceInfo" class="tabcontent">
<?php 
    session_start();
    if($_SESSION['p_id'] == null)
    {
        echo "<strong><center>Please select a patient from the search result!</center></strong>";
    }
    else
    {
    require("db_connect.php");
    $input = $_SESSION['p_id'];
    $sql = "Select * FROM InsuranceInfo WHERE PatientID = '$input'";
    $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $count = mysqli_num_rows($res);
    $row= mysqli_fetch_array($res);
    echo '<br>';
    if ($count==0)
{
    echo '<table class="data-table">
        <caption class="title"><center>Insurance Record</caption>
        <thead><thead><tr>
            <th><center>No insurance record!</center></th>
            </tr></tbody></table>';
}
else{
        echo '<table class="data-table">
            <caption class="title"><center>Insurance Record</caption>
        <thead>
                <tr>
                <th><center>Insurance Carrier</center></th>
                <th><center>Account Number</center></th>
                <th><center>Group Number</center></th>
                </tr>
        </thead>';
        echo "<tbody><tr>";
        echo "<td><center>" . $row['Carrier'] . "</center></td>";
        echo "<td><center>" . $row['AccntNum'] . "</center></td>";
        echo "<td><center>" . $row['GrpNum'] . "</center></td>";
        echo "</tr></tbody>";
        echo "</table>";
    }
    echo '<br><br>';
    }
?>
</div>
<script>
function openItem(evt, item) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(item).style.display = "block";
    evt.currentTarget.className += " active";
}

function callFunction4(clicked_id){
  window.location.href = "serverScript5.php?noteid="+clicked_id;
}
</script>
<br><br><br><br><br>
</body>
</html> 