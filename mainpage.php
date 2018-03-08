<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Main Page - Patient Information Management System</title>
<link rel="stylesheet" type="text/css" href="mainpage.css"/>

</head>
<body>
  
<?php include 'checkStatus.php';?>

<p>Click on the buttons inside the tabbed menu:</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'PatientInfo')">Patient Information</button>
  <button class="tablinks" onclick="openCity(event, 'MedicalInfo')">Medical Information</button>
  <button class="tablinks" onclick="openCity(event, 'InsuranceInfo')">Insurance Information</button>
  <button class="tablinks" onclick="openCity(event, 'BillingInfo')">Billing Information</button>
</div>

<div id="PatientInfo" class="tabcontent">
  <h3>Patient Information</h3>
  <p>Joey is sick af.</p>
</div>

<div id="MedicalInfo" class="tabcontent">
  <h3>Medical Information</h3>
  <p>Joes has hoofinmouth.</p> 
</div>

<div id="InsuranceInfo" class="tabcontent">
  <h3>Insurance Information</h3>
  <p>Joey has to pay a lot.</p>
</div>

<div id="BillingInfo" class="tabcontent">
  <h3>Billing Information</h3>
  <p>Joey broke as hell.</p>
</div>

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
     
</body>
</html> 
