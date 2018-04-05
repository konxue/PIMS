<?php
// It output current selection of patient, and inpatient record
if( ($_SESSION["p_id"]) != null)
        {
            echo '<table border="0.5" class="data-table">
            <caption class="title"><center>Patient Selection:</center></caption>';
            echo '<tbody><td><center>Name:</td><th>'.$_SESSION["p_fn"].' '.$_SESSION["p_mn"].' '.$_SESSION["p_ln"].'</th></center></th>';
             if ($_SESSION["usertype"] != 'Volunteer')
       {
            echo '<td><center>Gender:</td><th>'.$_SESSION["p_sex"].'</center></th>';
            echo '<td><center>Date of Birth:</td><th>'.$_SESSION["p_dob"].'</center></th>';
       }
            echo '</tbody></table>';
            include('inpatientrecord.php');
        }
?>
