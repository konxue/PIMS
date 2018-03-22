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
</script>
     
</body>
</html> 