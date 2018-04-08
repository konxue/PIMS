<?php
    require('db_connect.php'); 
    session_start(); 
    //print buttons
    //print all patients assigned to User    
    echo '<form id="search-form" method="post">
                <table border="0.5" class="data-table">
                    <center>  <caption class="title"><center>Print Options</caption> </center>
                        <tr>
                            <td><input type="submit" name="export" value="Print Summary Report on all patients" /></td>                                       
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
    
?>