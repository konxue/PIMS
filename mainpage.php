<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="css/tablestyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Main Page - Patient Information Management System</title>
<link rel="stylesheet" type="text/css" href="mainpage.css"/>

</head>
<body>


<?php 
include 'searchPatient.php';
?>
<br>
<br>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'PatientInfo')">Patient Information</button>
  <button class="tablinks" onclick="openCity(event, 'MedicalInfo')">Medical Information</button>
  <button class="tablinks" onclick="openCity(event, 'InsuranceInfo')">Insurance Information</button>
  <button class="tablinks" onclick="openCity(event, 'BillingInfo')">Billing Information</button>
  <button class="tablinks" onclick="openCity(event, 'ContactInfo')">Contact Information</button>
</div>

<div id="PatientInfo" class="tabcontent">
<?php include 'patientinfo.php';?>
</div>

<div id="MedicalInfo" class="tabcontent">
  <?php include 'medicalHistory.php'?>
    <br>
    <br>
     <form id="search-form" method="post" action="medicalInfo.php" >
          <table border="0.5" class="data-table">
            <tr>
                <td><strong><label for="text"><center>Admission Reason: </label></strong></td>
                <td><input type="p_text" name="p_atime" id="p_atime"></center></td>
                <td><input type="submit" value="Submit" />
            </tr>
           </table>
    </form>
    </center>
</div>

<!--Insurance Tab-->
<div id="InsuranceInfo" class="tabcontent">
 <center>
 <h3>Insurance Information</h3>
 </center>
  <!--<p>Nick has got this.</p>-->
<?php include 'insuranceinfo.php';?>
</div>

<div id="BillingInfo" class="tabcontent">
    <?php include 'BillingInfo.php';?>  
    <!--CSS Code for my tab-->
       

</div>

<div id="ContactInfo" class="tabcontent">

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
