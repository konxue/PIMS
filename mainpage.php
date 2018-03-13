<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

    <!-- CSS Code -->
<style type="text/css" scoped>
table.GeneratedTable {
width:50%;
background-color:#FFFFFF;
border-collapse:collapse;border-width:1px;
border-color:#000000;
border-style:solid;
color:#FFFFFF;
}
input[type=button] {
    width: 15%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
table.GeneratedTable td, table.GeneratedTable th {
border-width:1px;
border-color:#000000;
border-style:solid;
padding:3px;
}

table.GeneratedTable thead {
background-color:#4CAF50;
}
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Main Page - Patient Information Management System</title>
<link rel="stylesheet" type="text/css" href="mainpage.css"/>

</head>
<body>

<?php 
include 'checkStatus.php';
?>
<<<<<<< HEAD
    <center>
   <form id="search-form" method="post" action="searchPatient.php" >
          <table border="0.5" >
            
            <tr>
                <td><strong><label for="user_id"><center>Patient Search (by):</label></strong></td>
                <td><select name="searchType"><option value="LAST">Last Name</option>
                <option value="ID">ID</option>
                <option value="DOB">DOB</option>
                 </select>
                </td>
                <td><input type="p_text" name="p_last" id="p_last"></center></td>
                <td><input type="submit" value="Submit" />		
            </tr>
           </table>
    </form>
    </center>
        <center>
 
=======
<table class="GeneratedTable">
<thead>
<tr>
<th>Last Name</th>
<th>First Name</th>
<th>Middle Initial</th>
<th>Facility</th>
<th>Floor</th>
<th>Room No.</th>
<th>Bed No.</th>
</tr>
</thead>
<tbody>
<tr>
<td>Row 1, Cell 1</td>
<td>Row 1, Cell 2</td>
<td>Row 1, Cell 3</td>
<td>Row 1, Cell 4</td>
<td>Row 1, Cell 5</td>
<td>Row 1, Cell 6</td>
<td>Row 1, Cell 7</td>
</tr>
<tr>
<td>Row 2, Cell 1</td>
<td>Row 2, Cell 2</td>
<td>Row 2, Cell 3</td>
<td>Row 2, Cell 4</td>
<td>Row 2, Cell 5</td>
<td>Row 2, Cell 6</td>
<td>Row 2, Cell 7</td>
</tr>
<tr>
<td>Row 3, Cell 1</td>
<td>Row 3, Cell 2</td>
<td>Row 3, Cell 3</td>
<td>Row 3, Cell 4</td>
<td>Row 3, Cell 5</td>
<td>Row 3, Cell 6</td>
<td>Row 3, Cell 7</td>
</tr>

</tbody>
</table>
<p>Click on the buttons inside the tabbed menu:</p>
>>>>>>> 683074dc3055834d4edc42b792d226e393ea052a

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
  <p>Leon is working on this tab.</p>
     <form id="search-form" method="post" action="findMedical.php" >
          <table border="0.5" >
            <tr>
                <td><strong><label for="user_id"><center>Medical History Search (by ID): </label></strong></td>
                <td><input type="p_text" name="p_id" id="p_id"></center></td>
                <td><input type="submit" value="Submit" />		
            </tr>
           </table>
    </form>
    </center>
</div>

<!--Insurance Tab-->
<div id="InsuranceInfo" class="tabcontent">
  <h3>Insurance Information</h3>
  <!--<p>Nick has got this.</p>-->
  <!-- Codes by HTML.am -->

<!-- HTML Code -->
<table class="GeneratedTable">
<thead>
<tr>
<th>Insurance Carrier</th>
<th>Account Number</th>
<th>Group Number</th>
</tr>
</thead>
<tbody>
<tr>
<td>Row 1, Cell 1</td>
<td>Row 1, Cell 2</td>
<td>Row 1, Cell 3</td>
</tr>
<tr>
<td>Row 2, Cell 1</td>
<td>Row 2, Cell 2</td>
<td>Row 2, Cell 3</td>
</tr>
<tr>
<td>Row 3, Cell 1</td>
<td>Row 3, Cell 2</td>
<td>Row 3, Cell 3</td>
</tr>
</tbody>
</table>
<h2><input name="addCarrier" type="button" value="Add Carrier" /> <input name="addGpNum" type="button" value="Add Account Number" />  <input name="addAccNum" type="button" value="Add Group Number" /></h2>
</div>

<div id="BillingInfo" class="tabcontent">
  <h3>Billing Information</h3>
  <p>Cristina is working on this tab</p>
  

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
