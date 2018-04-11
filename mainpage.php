<!--
    Purpose: This PHP page is the main page for the application
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="css/tablestyle.css">
<link rel="stylesheet" type="text/css" href="mainpage.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<title>Main Page - Patient Information Management System</title>
<?php 
include 'checkStatus.php';
if($_SESSION['usertype'] == 'Doctor' || $_SESSION['usertype'] == 'Nurse')
{
header("Refresh: 0; url=medicalInfo.php");
}
?>
<center><br><br><img src="images/hospital.png" height="200" width="200"/></center>
</head>
<footer>
    <link rel="stylesheet" type="text/css" href="mainpage.css"/>
    <div class="footer"><center>© All rights reserved 2018. Patient Information Management System beta 1.0</center></div>
</footer>
<body>

<?php
    include 'searchPatient.php';
    include 'currentSelection.php';
?>
<br>
<?php
 if ($_SESSION["usertype"] != 'Volunteer')
       {
       echo"
           <div class='tab'>
          <button class='tablinks' onclick='openCity(event, `Admission`)'>Admission</button>
          <button class='tablinks' onclick='openCity(event, `PatientInfo`)'>Patient Information</button>
          <button class='tablinks' onclick='openCity(event, `Visitor`)'>Visitors Setting</button>
          <button class='tablinks' onclick='openCity(event, `InsuranceInfo`)'>Insurance Information</button>
          <button class='tablinks' onclick='openCity(event, `BillingInfo`)'>Billing Information</button>
        </div>
           ";
       }
?>

<div id="Admission" class="tabcontent">
  <?php include 'admission.php' ?>
</div>

<div id="PatientInfo" class="tabcontent">
<?php include 'patientinfo.php'?>
</div>

<div id="Visitor" class="tabcontent">
<?php include 'visitorType.php' ?>
</div>

<!--Insurance Tab-->
<div id="InsuranceInfo" class="tabcontent">
<?php include 'insuranceinfo.php'?>
</div>

<div id="BillingInfo" class="tabcontent">
<?php include 'BillingInfo.php'?>  
</div>
<br><br><br><br><br>
</body>

</html> 

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>