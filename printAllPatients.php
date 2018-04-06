  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  


<form id="search-form" method="post">
                <table border="0.5" class="data-table">
                    <center>  <caption class="title"><center>Print Options</caption> </center>
                        <tr>
                            <td><input type="submit" name="export" value="Print All Patients" /></td>
                            <td><input type="submit" name="export2" value="Print Patient Summary"/></td>             
                        </tr>
                    </table>
                </form>

<?php
    require('db_connect.php'); 
    session_start(); 
    //print buttons
    //print all patients assigned to User    
    $output = '';
    if(isset($_POST["export"]))
    {
        $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE UserID = '$_SESSION[username]'";
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
                        <th>Date of Birth</th>       
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
                        <td><center>'.$row['DOB'].'</center></td>                             
                    </tr>
            ';
            }
            $output .= '</table>';
            $_SESSION['printOut'] = $output;
            header("Refresh: 0; url=printreport.php");
        }
    }
    
    //print current patients summary
    $p_id = $_SESSION['p_id'];
    
    $output2 = '';
    if(isset($_POST["export2"]))
    {
        $query = "SELECT * FROM `PatientInfo` WHERE `PatientID` = '$p_id'";
        $query1 = "SELECT `Name`, `Date`, `Time` FROM Procedures WHERE PatientID = '$p_id'";
        $query2 = "SELECT `PrescripName`, `Dosage`, `Quantity`, `Directions` FROM Prescription WHERE `PatientID` = '$p_id'";
        $query3 = "SELECT `AdmissionDate`, `AdmissionTime`, `ReasonForAdmission`, `DischargeTime` FROM MedicalInfo WHERE `PatientID` = '$p_id'";
        $query4 = "SELECT `Note` FROM DoctorsNote WHERE `PatientID` = '$p_id'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));  
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
                    </tr>
            ';
            }
            $output2 .= '</table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=download1.xls');
            echo $output2;
        }
    }
    
    
?>

<script type="text/javascript">
function printfunction(output){
    alert(1);
  //window.location.href = "printreport.php?output="+output;
}
</script>
  
    

