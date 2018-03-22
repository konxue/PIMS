<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="css/tablestyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Medical Information System - Patient Information Management System</title>
<link rel="stylesheet" type="text/css" href="mainpage.css"/>
<?php 
include 'checkStatus.php'
?>
<footer>
    <link rel="stylesheet" type="text/css" href="mainpage.css"/>
    <div class="footer"><center>Patient Information Management System V 1.0  © All rights reserved 2018</center></div>
</footer>
<br>
<right>
<a href="mainpage.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon glyphicon-arrow-left"></span> Main Page
        </a>
</right>
</head>
<body>
    <?php include 'medicalRecord.php'?>
<br>
<div class="tab">
  <button class="tablinks" onclick="openItem(event, 'DoctorNotes')">Doctor's Notes</button>
  <button class="tablinks" onclick="openItem(event, 'NurseNotes')">Nurse's Notes</button>
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
    $input = $_SESSION['p_id'];
    $logid = $_SESSION['p_logid'];
    $sql = "Select * FROM `DoctorsNote` WHERE `PatientID` = '$input' AND `log_id` = '$logid' ORDER BY `note_id` DESC";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
            echo '<br><br><table class="data-table">
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
    echo "</table>";
    mysqli_close($connection);
 }
        
?>
</div>

<div id="NurseNotes" class="tabcontent">
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