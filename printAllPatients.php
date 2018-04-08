<?php
    require('db_connect.php'); 
    session_start(); 
    //print buttons
    //print all patients assigned to User    
    echo '<form id="search-form" method="post">
                <table border="0.5" class="data-table">
                    <center>  <caption class="title"><center>Print Options</caption> </center>
                        <tr>
                            <td><input type="submit" name="export" value="Print All Patients" /></td>
                            <td><input type="submit" name="export2" value="Print Patient Summary"/></td>             
                        </tr>
                    </table>
                </form>';
    $output = '';
    if(isset($_POST["export"]))
    {
        $query = "SELECT * FROM `PatientInfo` order by `PatientID`";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));  
        if(mysqli_num_rows($result) > 0)
        {
            $output .= '
                <table class="table" bordered="1">  
                    <tr>  
                        <th>Patient ID</th>
                        <th>Last Name</th>
                        <th>Middle Initial</th>
                        <th>First Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Current Doctor</th>
                        <th>Last Visit</th>
                    </tr>
            ';
            while($row = mysqli_fetch_array($result))
            {
                $output .= '
                    <tr>  
                        <td><center>'.$row['PatientID'].'</center></td>
                        <td><center>'.$row['LastName'].'</center></td>
                        <td><center>'.$row['MiddleName'].'</center></td> 
                        <td><center>'.$row['FirstName'].'</center></td>
                        <td><center>'.$row['SEX'].'</center></td>
                        <td><center>'.$row['DOB'].'</center></td>';
                        $n1 = $row['UserID'];
                        $query = "SELECT `LastName`,`FirstName` FROM `Users` WHERE UserID='$n1'";
                        $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
                        $newrow=mysqli_fetch_array($result1);
                        $doctorLN = $newrow[0];
                        $doctorFN = $newrow[1];
                        $output .= "<td><center>Dr. ".$doctorFN." " .$doctorLN."</center></td>";
                        $input = $row['PatientID'];
                        $sql = "Select * FROM MedicalInfo WHERE PatientID = '$input' ORDER BY `log_id` DESC";
                        $resulty = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        if(mysqli_num_rows($resulty) > 0)
                        {
                            $newrow = mysqli_fetch_array($resulty);
                            $output .= '<td><center>'.$newrow['AdmissionDate'].'</center></td>';
                        }
                        else
                        {
                            $output .= '<td><center>Never</center></td>';    
                        }
                
                }
            $output .= '</tr></table>';
            $_SESSION['printOut'] = $output;
            echo '<meta http-equiv="refresh" content="0; url=printreport.php" />'; 
        }
    }
    
    //print current patients summary
    $p_id = $_SESSION['p_id'];
    
    $output2 = '';
    if(isset($_POST["export2"]))
    {
        $sql = "SELECT * FROM `PatientInfo` INNER JOIN Procedures INNER JOIN Prescriptions INNER JOIN MedicalInfo INNER JOIN DoctorsNote ON brand.brand_id = product.brand_id"; 
        $query = "SELECT * FROM `PatientInfo` WHERE `PatientID` = '$p_id'";
        $query1 = "SELECT `Name`, `Date`, `Time` FROM Procedures WHERE PatientID = '$p_id'";
        $query2 = "SELECT `PrescripName`, `Dosage`, `Quantity`, `Directions` FROM Prescription WHERE `PatientID` = '$p_id'";
        $query3 = "SELECT `AdmissionDate`, `AdmissionTime`, `ReasonForAdmission`, `DischargeTime` FROM MedicalInfo WHERE `PatientID` = '$p_id'";
        $query4 = "SELECT `Note` FROM DoctorsNote WHERE `PatientID` = '$p_id'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
        $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
        $result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
        $result4 = mysqli_query($connection, $query4) or die(mysqli_error($connection));
        if(mysqli_num_rows($result) > 0)
        {
            $output2 .= '
                <table class="table" bordered="1">  
                    <tr>  
                        <th>Patient ID</th>
                        <th>Last Name</th>
                        <th>Middle Initial</th>
                        <th>First Name</th>
                        <th>Date of Birth</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>ZIP</th>
                        <th>Home Phone</th>
                        <th>Mobile Phone</th>
                        <th>Sex</th>                    
                        <th>AdmissionDate</th>
                        <th>AdmissionTime</th>
                        <th>Reason for Admission</th>
                        <th>Discharge Time</th>
                        <th>Notes</th>
                    </tr>
            ';
            while($row = mysqli_fetch_array($result))
            {
                $output2 .= '
                    <tr>  
                        <td><center>'.$row['PatientID'].'</center></td>
                        <td><center>'.$row['LastName'].'</center></td>
                        <td><center>'.$row['MiddleName'].'</center></td> 
                        <td><center>'.$row['FirstName'].'</center></td> 
                        <td><center>'.$row['DOB'].'</center></td>
                        <td><center>'.$row['Street'].'</center></td>
                        <td><center>'.$row['City'].'</center></td>
                        <td><center>'.$row['State'].'</center></td>
                        <td><center>'.$row['ZIP'].'</center></td>
                        <td><center>'.$row['HomePhone'].'</center></td>
                        <td><center>'.$row['MobilePhone'].'</center></td>
                        <td><center>'.$row['Sex'].'</center></td>
                        <td><center>'.$row['AdmissionDate'].'</center></td>
                        <td><center>'.$row['AdmissionTime'].'</center></td>
                        <td><center>'.$row['ReasonforAdmission'].'</center></td>
                        <td><center>'.$row['DischargeTime'].'</center></td>                        
                        <td><center>'.$row['Notes'].'</center></td>
                    </tr>';
            }
            $output2 .= '</table>';
            $_SESSION['printOut'] = $output2;
            echo '<meta http-equiv="refresh" content="0; url=printreport.php" />'; 
        }
    }   
?>