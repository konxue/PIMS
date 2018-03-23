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
include 'checkStatus.php'
?>
<left>
<a href="mainpage.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon glyphicon-arrow-left"></span> Main Page
        </a>
</left>
<center><img src="images/doctor.png" height="250" width="250"/></center>
</head>
<footer>
    <link rel="stylesheet" type="text/css" href="mainpage.css"/>
    <div class="footer"><center>Patient Information Management System V 1.0  © All rights reserved 2018</center></div>
</footer>
<br>

<body>
    
    <?php include 'medicalRecord.php'?>
<br>
<div class="tab">
  <button class="tablinks" onclick="openItem(event, 'DoctorNotes')">Doctor's Notes</button>
  <button class="tablinks" onclick="openItem(event, 'NurseNotes')">Nurse's Notes</button>
  <button class="tablinks" onclick="openItem(event, 'Procedures')">Procedures</button>
  <button class="tablinks" onclick="openItem(event, 'Prescriptions')">Prescriptions</button>
</div>

<div id="DoctorNotes" class="tabcontent">
    <?php
    session_start();
    if($_SESSION['p_logid'] == null)
    {
        echo "Error! No visit id has been selected! Try again.";
    }
 else {//when logid has passed from pervious page
    require("db_connect.php");
    
    echo '
        <br><center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tab">Add Notes</button></center>
        <div id="tab" class="collapse">
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
        $note = $_POST['notetext'];
        $sql = "Select `note_id` From `DoctorsNote` ORDER BY `note_id` DESC"; //primary key
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($result);
        $noteid = $row[0] + 1; //new primary key for note id
        $drid = $_SESSION['username'];
        $sql = "INSERT INTO `DoctorsNote` (`PatientID`, `log_id`, `note_id`, `Date`, `Time`, `Note`, `UserID`) VALUES ('$input', '$logid', '$noteid', '$newdate', '$newtime', '$note', '$drid')";
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
                <th><center>Doctor Name</center></th>
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
        $query = "SELECT `LastName`,`FirstName` FROM `Users` WHERE UserID='$n1'";
        $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $newrow=mysqli_fetch_array($result1);
        $doctorLN = $newrow[0];
        $doctorFN = $newrow[1];
        echo "<td><center>Dr. ".$doctorFN." " .$doctorLN."</center></td>";
        echo "<td><center>" . $row['Note'] . "</center></td>";
        echo "<td><center>" . $row['Date'] . "</center></td>";
        echo "<td><center>" . $row['Time'] . "</center></td>";
        echo '<td><center><button id='.$row['note_id'].' onClick=callFunction4(this.id)>Delete</button></center></td>';
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

<div id="NurseNotes" class="tabcontent">
</div>

<div id="Procedures" class="tabcontent">
</div>


<div id="Prescriptions" class="tabcontent">
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
     
</body>
</html> 