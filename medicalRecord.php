<?php
    function php1Alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
    session_start();
    if ($_SESSION['p_id'] == null)
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else {
    require("db_connect.php");
    $input = $_SESSION['p_id'];
    $sql = "Select * FROM MedicalInfo WHERE PatientID = '$input' ORDER BY `log_id` DESC";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    if ($count == 0)
    {
        echo '<br><table class="data-table">
        <thead>';
        echo "<tr>";
        echo "<th><center>No admission history has found!</center></td>";
        echo "</tr></thead>";
    }
    else
    {
        echo '
        <br><table class="data-table">
        <thead>
                <tr>
                <th><center>Visit ID</center></th>
                <th><center>Admission Date</center></th>
                <th><center>Admission Time</center></th>
                <th><center>Admission Reason</center></th>
                <th><center>Discharge Date</center></th>
                <th><center>Discharge Time</center></th>
                <th><center>Selection</center></th>
                <th><center>Delete</center></th>
                </tr>
        </thead>';
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td><center>" . $row['log_id'] . "</center></td>";
        echo "<td><center>" . $row['AdmissionDate'] . "</center></td>";
        echo "<td><center>" . $row['AdmissionTime'] . "</center></td>";
        echo "<td><center>" . $row['ReasonForAdmission'] . "</center></td>";
        echo "<td><center>" . $row['DischargeDate'] . "</center></td>";
        echo "<td><center>" . $row['DischargeTime'] . "</center></td>";
        if ($_SESSION["p_logid"] == $row['log_id'])
        {
            echo '<td><center>O</center></td>';
        }
        else{
        echo '<td><center><button id='.$row['log_id'].' onClick=callFunction1(this.id) name=grr>Select</button></center></td>';
        }
        echo '<td><center><button id='.$row['log_id'].' onClick=callFunction3(this.id) name=grr>Delete</button></center></td>';
        echo "</tr>";
    }
    }
    echo "</table>";
    mysqli_close($connection);
    }
?>

<script type="text/javascript">
function callFunction1(clicked_id){
  window.location.href = "serverScript2.php?logid="+clicked_id;
}
function callFunction2(clicked_id){
  window.location.href = "serverScript3.php?logid="+clicked_id;
}
function callFunction3(clicked_id){
  window.location.href = "serverScript6.php?logid="+clicked_id;
}
</script>