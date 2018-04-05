<?php
    require("db_connect.php");
    session_start();
    
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE UserID = '$_SESSION[username]'";
    $info = mysqli_query($connection, $query) or die(mysqli_error($connection));
    
    echo '
    <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tab1">My Patients</button></center>
        <div id="tab1" class="collapse"><br>
        <table border="0.5" class="data-table">
        <thead>
            <tr>
            <th>#</th>
            <th>Patient ID</th>
            <th>Last Name</th>
            <th>Middle Initial</th>
            <th>First Name</th>
            <th>Date of Birth</th>
            <th>Selection</th>
            </tr>
        </thead><tbody>';

        $no = 1;
        while ($row = mysqli_fetch_array($info))
        {
            echo '<tr>
                 <td><center>'.$no.'</center></td>
                 <td><center>'.$row['PatientID'].'</center></td>
                 <td><center>'.$row['LastName'].'</center></td>
                 <td><center>'.$row['MiddleName'].'</center></td> 
                 <td><center>'.$row['FirstName'].'</center></td> 
                 <td><center>'.$row['DOB'].'</center></td> 
                 <td><center><button id='.$row['PatientID'].' onClick=callFunction(this.id) name=grr>Select</button></center></td>
                    </tr>';
                $no++;   
        }
        echo '</tbody></table></div>';  
?>


<script type="text/javascript">
function callFunction(clicked_id){
  window.location.href = "serverScript1.php?pid="+clicked_id;
}
</script>