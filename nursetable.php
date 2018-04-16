<!--
    Purpose: This PHP page handles the nurse table thats gets displayed
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<?php
    require("db_connect.php"); //database connector
    session_start();
    $query = 'SELECT * FROM `Inpatient`';
    $info2 = mysqli_query($connection, $query) or die(mysqli_error($connection));
    echo '
    <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tab1">Current Patients List</button></center>
        <div id="tab1" class="collapse"><br>
        <table border="0.5" class="data-table">
        <thead>
            <tr>
            <th>#</th>
            <th>Patient ID</th>
            <th>Last Name</th>
            <th>Middle Initial</th>
            <th>First Name</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Selection</th>
            </tr>
        </thead><tbody>';

    $no = 0;
    while ($row2 = mysqli_fetch_array($info2))
    {
    $p_id = $row2['PatientID'];
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB`,`SEX` FROM `PatientInfo` WHERE PatientID = '$p_id'";
    $info = mysqli_query($connection, $query) or die(mysqli_error($connection));
    //collapse button for current patient
    $row = mysqli_fetch_array($info);
            $no++;
            echo '<tr>
                 <td><center>'.$no.'</center></td>
                 <td><center>'.$row['PatientID'].'</center></td>
                 <td><center>'.$row['LastName'].'</center></td>
                 <td><center>'.$row['MiddleName'].'</center></td> 
                 <td><center>'.$row['FirstName'].'</center></td>
                 <td><center>'.$row['SEX'].'</center></td> 
                 <td><center>'.$row['DOB'].'</center></td>
                 <td><center><button id='.$row['PatientID'].' onClick=callFunction(this.id) name=grr>Select</button></center></td>
                    </tr>';        //select button
        
    }
    if ($no == 0) //no records
        {
            echo '<tr><td colspan="8"><center>No patient is in the hospital!</center></td></tr>';
        }
        echo '</tbody></table></div>';  
?>


<script type="text/javascript">
function callFunction(clicked_id){
  window.location.href = "serverScript1.php?pid="+clicked_id;
}
</script>