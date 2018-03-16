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
include 'searchPatient.php';
?>
</tbody>
</table>
<p>Click on the buttons inside the tabbed menu:</p>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'PatientInfo')">Patient Information</button>
  <button class="tablinks" onclick="openCity(event, 'MedicalInfo')">Medical Information</button>
  <button class="tablinks" onclick="openCity(event, 'InsuranceInfo')">Insurance Information</button>
  <button class="tablinks" onclick="openCity(event, 'BillingInfo')">Billing Information</button>
  <button class="tablinks" onclick="openCity(event, 'ContactInfo')">Contact Information</button>
</div>

<div id="PatientInfo" class="tabcontent">
    <?php
    $connection = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }
    $select_db = mysqli_select_db($connection, 'onlinepims');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($connection));
    }
    $res = mysqli_query($connection, "Select * FROM PatientInfo WHERE PatientID = '$_SESSION[p_id]'");
    echo " 
        <table>
            <tr>
                <th>Patient ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Room Number</th>
                <th>Visitor Type</th>
             </tr>";
    
    while($row = mysqli_fetch_array($res))
    {
        echo "<tr>";
        echo "<td>" . $row['PatientID'] . "</td>";
        echo "<td>" . $row['LastName'] . "</td>";
        echo "<td>" . $row['FirstName'] . "</td>";
        echo "<td>" . $row['MiddleName'] . "</td>";
        echo "<td>" . $row['RoomNum'] . "</td>";
        echo "<td>" . $row['VisitorType'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
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
    
    <table>
    <h2>Itemized List</h2>
    <tr>
        <th>Item</th>
        <th>Cost</th>
    </tr>
    
    
    <head>
    <style>
    table 
    {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th 
    {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) 
    {
        background-color: #dddddd;
    }
    </style>
    </head>
    
    <table style="width:100%">
    <tr>
        <th>Total Amount:</th>
    </tr>
    <tr>
        <th>Amount paid by Insurance:</th>
    </tr>
    <tr>
        <th>Amount due after Insurance:</th>
    </tr>
    <tr>
        <th>Amount Paid:</th>
    </tr>
    <tr>
        <th>Amount Due:</th>
    </tr>
    </table>
    </table>
</div>

<div id="ContactInfo" class="tabcontent">
    <?php
    $connection = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }
    $select_db = mysqli_select_db($connection, 'onlinepims');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($connection));
    }
    $res = mysqli_query($connection, "Select * FROM PatientInfo WHERE PatientID = '$_SESSION[p_id]'");
    echo " 
        <table>
            <tr>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Home Phone</th>
                <th>Mobile Phone</th>
                <th>Work Phone</th>
             </tr>";
    
    while($row = mysqli_fetch_array($res))
    {
        echo "<tr>";
        echo "<td>" . $row['Street'] . "</td>";
        echo "<td>" . $row['City'] . "</td>";
        echo "<td>" . $row['State'] . "</td>";
        echo "<td>" . $row['Zip'] . "</td>";
        echo "<td>" . $row['HomePhone'] . "</td>";
        echo "<td>" . $row['MobilePhone'] . "</td>";
        echo "<td>" . $row['WorkPhone'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
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
