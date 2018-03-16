<?php
    session_start();
    if ($_SESSION['p_id'] == null)
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else {
    $connection = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }
    $select_db = mysqli_select_db($connection, 'onlinepims');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($connection));
    }
    $input = $_SESSION['p_id'];
    $res = mysqli_query($connection, "Select * FROM PatientInfo WHERE PatientID = '$input'");
    echo '
        <table class="data-table">
        <caption class="title"><center>Patient Report</center></caption>
        <thead>
                <tr>
                <th>Patient ID</th>
                <th>Sex</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>First Name</th>
                <th>Date of Birth</th>
                <th>Floor Number</th>
                <th>Room Number</th>
                <th>Visitor Type</th>
                </tr>
        </thead>
        ';
    
    while($row = mysqli_fetch_array($res))
    {
        echo "<tr>";
        echo "<td><center>" . $row['PatientID'] . "</center></td>";
        echo "<td><center>" . $row['SEX'] . "</center></td>";
        echo "<td><center>" . $row['LastName'] . "</center></td>";
        echo "<td><center>" . $row['MiddleName'] . "</center></td>";
        echo "<td><center>" . $row['FirstName'] . "</center></td>";
        echo "<td><center>" . $row['DOB'] . "</center></td>";
        echo "<td><center>" . $row['FloorNum'] . "</center></td>";
        echo "<td><center>" . $row['RoomNum'] . "</center></td>";
        echo "<td><center>" . $row['VisitorType'] . "</center></td>";
        echo "</tr>";
    }
   echo '
        <thead>
                <tr>
                <th>Primary Doctor</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Country</th>
                <th>Home Phone</th>
                <th>Mobile Phone</th>
                <th>Work Phone</th>
                </tr>
        </thead>';
 $result = mysqli_query($connection, "Select * FROM PatientInfo WHERE PatientID = '$input'");
   while($row1 = mysqli_fetch_array($result))
    {
       /*Following code for getting name for the doctor by searching the userID*/
       $n1 = $row1['UserID'];
       $query = "SELECT `LastName`,`FirstName` FROM `Users` WHERE UserID='$n1'";
       $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
       $newrow=mysqli_fetch_array($result1);
       $doctorLN = $newrow[0];
       $doctorFN = $newrow[1];
        echo "<tr>";
        echo "<td><center>Dr. ".$doctorFN." " .$doctorLN."</center></td>";
        echo "<td><center>" . $row1['Street'] . "</center></td>";
        echo "<td><center>" . $row1['City'] . "</center></td>";
        echo "<td><center>" . $row1['State'] . "</center></td>";
        echo "<td><center>" . $row1['Zip'] . "</center></td>";
        echo "<td><center>" . $row1['Country'] . "</center></td>";
        echo "<td><center>" . $row1['HomePhone'] . "</center></td>";
        echo "<td><center>" . $row1['MobilePhone'] . "</center></td>";
        echo "<td><center>" . $row1['WorkPhone'] . "</center></td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    }
?>