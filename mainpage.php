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
include 'checkStatus.php'; //inseart heaedr
if($_SESSION['usertype'] == 'Doctor' || $_SESSION['usertype'] == 'Nurse')
{
header("Refresh: 0; url=medicalInfo.php"); //direct doctor or nurse to medicalinfo page
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
    include 'searchPatient.php'; //search patient module
    include 'currentSelection.php'; //list current selected patient
?>
<br>
<?php
 if ($_SESSION["usertype"] != 'Volunteer') //hidden all information to the volunteer
       {
       echo"
           <div class='tab'>
          <button class='tablinks' id='Admission1' onclick='openCity(event, `Admission`)'>Admission</button>
          <button class='tablinks' id='PatientInfo1' onclick='openCity(event, `PatientInfo`)'>Patient Information</button>
          <button class='tablinks' id='Visitor1' onclick='openCity(event, `Visitor`)'>Visitors Setting</button>
          <button class='tablinks' id='InsuranceInfo1' onclick='openCity(event, `InsuranceInfo`)'>Insurance Information</button>
          <button class='tablinks' id='BillingInfo1'onclick='openCity(event, `BillingInfo`)'>Billing Information</button>
        </div>
           ";
       }
  else
  {
      echo"
          <div class='tab'>
          <button class='tablinks' onclick='openCity(event, `Visitor`)'>Visitors Setting</button>
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
<br><br><br><br>
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
    document.cookie = "cityName="+cityName+"1; expires=Thu, 18 Dec 2090 12:00:00 UTC; path=/";
}


document.addEventListener("DOMContentLoaded", function(){
  // Handler when the DOM is fully loaded
  var selectedCity = getCookie("cityName");
  if (selectedCity != ""){
    document.getElementById(selectedCity).click();
  }
});

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

</script>
</body>
</html> 