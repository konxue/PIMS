<?php
    session_start();
    require("db_connect.php");
       $sqlx = "SELECT `FloorNum`,`RoomNum`,`BedNum` FROM `Inpatient` WHERE `PatientID` = '$_SESSION[p_id]'";
       $result1 = mysqli_query($connection, $sqlx) or die(mysqli_error($connection));
       $count = mysqli_num_rows($result1);
        if ($count > 0)
        {
         $_SESSION['inPatient_status'] = 888; // where patient has inpatient record
           echo '
            <table border="0.5" class="data-table">
            <caption class="title"><center>Inpatient Record</center></caption>
            <thead>
                    <tr>
                    <th><center>Facility</center></th>
                    <th><center>Floor #</center></th>
                    <th><center>Room #</center></th>
                    <th><center>Bed #</center></th>';
             if ($_SESSION["usertype"] != 'Volunteer')
       {
           echo'<th><center>Remove</center></th>';
       }
           echo'</tr></thead><tbody><tr>';
           $row = mysqli_fetch_array($result1);
           if ($row[0] == 2)
           {
               echo '<td><center>Emergency Care</center></td>';
           }
           elseif ($row[0] == 3)
           {
               echo '<td><center>Gynaecology</center></td>';
           }
           elseif ($row[0] == 4)
           {
               echo '<td><center>General Care</center></td>';
           }
           elseif ($row[0] == 5)
           {
               echo '<td><center>Pediatrics</center></td>';
           }
           elseif ($row[0] == 6)
           {
               echo '<td><center>Oncology</center></td>';
           }
           echo'<td><center>'.$row[0].'</center></td>
             <td><center>'.$row[1].'</center></td>
             <td><center>'.$row[2].'</center></td>';
             if ($_SESSION["usertype"] != 'Volunteer')
       {
           echo'<td><center><button id='.$_SESSION['p_id'].' onClick=callFunction6(this.id) >Remove</button></center></td>';
       }
           echo'</tr></tbody></table>';
       }
       elseif ($count == 0)
       {
           $_SESSION['inPatient_status'] = 999; // represent that this patient is not inpatient
            echo '
            <table border="0.5" class="data-table">
            <caption class="title"><center>Inpatient Record</center></caption>
            <thead>
                    <tr>
                    <th><center>No Records</center></th>
                    </tr>
            </thead></table>';
       }
?>

<script type="text/javascript">
function callFunction6(clicked_id){
  window.location.href = "serverScript7.php?p_id="+clicked_id;
}
</script>