<?php
    session_start();
    if ($_SESSION['p_id'] == null && ($_SESSION["usertype"] != 'Volunteer'))
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
    $output = '';
    $output .= '
        <table class="data-table">
        <caption class="title"><center>Patient Report</center></caption>
        <thead>
                <tr>
                <th><center>Patient ID</center></th>
                <th><center>Sex</center></th>
                <th><center>Last Name</center></th>
                <th><center>Middle Name</center></th>
                <th><center>First Name</center></th>
                <th><center>Date of Birth</center></th>
                <th><center>Assigned Doctor</center></th>
                <th><center>Family Doctor</center></th>
                </tr>
        </thead>
        ';
    
    while($row = mysqli_fetch_array($res))
    {
        $output .= "<tr>";
        $output .= "<td><center>" . $row['PatientID'] . "</center></td>";
        $output .= "<td><center>" . $row['SEX'] . "</center></td>";
        $output .= "<td><center>" . $row['LastName'] . "</center></td>";
        $output .= "<td><center>" . $row['MiddleName'] . "</center></td>";
        $output .= "<td><center>" . $row['FirstName'] . "</center></td>";
        $output .= "<td><center>" . $row['DOB'] . "</center></td>";
         /*Following code for getting name for the doctor by searching the userID*/
       $n1 = $row['UserID'];
       $query = "SELECT `LastName`,`FirstName` FROM `Users` WHERE UserID='$n1'";
       $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
       $newrow=mysqli_fetch_array($result1);
       $doctorLN = $newrow[0];
       $doctorFN = $newrow[1];
        $output .= "<td><center>Dr. ".$doctorFN." " .$doctorLN."</center></td>";
        $output .= "<td><center>" . $row['FamilyDoctor'] . "</center></td>";
        $output .= "</tr>";
    }
   $output .= '
        <thead>
                <tr>
                
                <th><center>Street</center></th>
                <th><center>City</center></th>
                <th><center>State</center></th>
                <th><center>Zip</center></th>
                <th><center>Country</center></th>
                <th><center>Home Phone</center></th>
                <th><center>Mobile Phone</center></th>
                <th><center>Work Phone</center></th>
                </tr>
        </thead>';
 $result = mysqli_query($connection, "Select * FROM PatientInfo WHERE PatientID = '$input'");
   while($row1 = mysqli_fetch_array($result))
    {
        $output .= "<tr>";
        $output .= "<td><center>" . $row1['Street'] . "</center></td>";
        $output .= "<td><center>" . $row1['City'] . "</center></td>";
        $output .= "<td><center>" . $row1['State'] . "</center></td>";
        $output .= "<td><center>" . $row1['Zip'] . "</center></td>";
        $output .= "<td><center>" . $row1['Country'] . "</center></td>";
        $output .= "<td><center>" . $row1['HomePhone'] . "</center></td>";
        $output .= "<td><center>" . $row1['MobilePhone'] . "</center></td>";
        $output .= "<td><center>" . $row1['WorkPhone'] . "</center></td>";
        $output .= "</tr>";
    }
    $output .= "</table>";
 $patientID = $_SESSION['p_id'];   
 $ecRes = mysqli_query($connection, "Select * FROM PatientInfo WHERE PatientID = '$patientID'");
 $count = mysqli_num_rows($ecRes);
  if($count>0)
 {
 $output .= '
        <table class="data-table">
        <caption class="title"><center>Emergency Contacts</center></caption>
        <thead>
                <tr>
                <th><center>LAST NAME</center></th>
                <th><center>FIRST NAME</center></th>
                <th><center>MOBILE NUMBER</center></th>
                <th><center>HOME NUMBER</center></th>
                </tr>
        </thead><tbody>
        ';

        $ecRow = mysqli_fetch_array($ecRes);

        $output .= "<tr>";
        $output .= "<td><center>" . $ecRow['E1_LastName'] . "</center></td>";
        $output .= "<td><center>" . $ecRow['E1_FirstName'] . "</center></td>";
        $output .= "<td><center>" . $ecRow['E1_MobileNum'] . "</center></td>";
        $output .= "<td><center>" . $ecRow['E1_HomeNum'] . "</center></td>";
        $output .= "</tr>";
        $output .= "<tr>";
        $output .= "<td><center>" . $ecRow['E2_LastName'] . "</center></td>";
        $output .= "<td><center>" . $ecRow['E2_FirstName'] . "</center></td>";
        $output .= "<td><center>" . $ecRow['E2_MobileNum'] . "</center></td>";
        $output .= "<td><center>" . $ecRow['E2_HomeNum'] . "</center></td>";
        $output .= "</tr></tbody>";

 }
 else
 {
     $output .= '<table class="data-table">
        <caption class="title"><center>Emergency Contacts</center></caption>
        <thead>
                <tr>
                <th><center>No Records</center></th>
                </tr>
        </thead>';
 }
 $output .= "</table>";
echo $output;
         echo '<br><table class="data-table">';
            echo '<form id="search-form" method="post">';
            echo '<td><center>
                <input type="submit" name="submit_print" value="Print" /></center></td>		
                </form></tr></table>';

        if($_POST["submit_print"])
        {
            $_SESSION['printOut'] = $output;
            echo '<meta http-equiv="refresh" content="0; url=printreport.php" />'; 
        }
    mysqli_close($connection);
    }
?>