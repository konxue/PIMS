<?php
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
    echo '
        <table class="data-table">
        <caption class="title"><center>Medical Report</center></caption>
        <thead>
                <tr>
                <th><center>Admission Log ID</center></th>
                <th><center>Admission Date</center></th>
                <th><center>Admission Time</center></th>
                <th><center>Admission Reason</center></th>
                <th><center>Discharge Date</center></th>
                <th><center>Discharge Time</center></th>
                <th><center>Selection</center></th>
                <th><center>Discharge</center></th>
                <th><center>Delete</center></th>
                </tr>
        </thead>';
    if ($count == 0)
    {
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>No visiting history found!</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
    }
    else
    {
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td><center>" . $row['log_id'] . "</center></td>";
        echo "<td><center>" . $row['AdmissionDate'] . "</center></td>";
        echo "<td><center>" . $row['AdmissionTime'] . "</center></td>";
        echo "<td><center>" . $row['ReasonForAdmission'] . "</center></td>";
        echo "<td><center>" . $row['DischargeDate'] . "</center></td>";
        echo "<td><center>" . $row['DischargeTime'] . "</center></td>";
        echo '<td><center><button id='.$row['log_id'].' onClick=callFunction1(this.id) >Select</button></center></td>';
        if ($row['DischargeDate'] !=null)
        {
        echo '<td><center>-</center></td>';
        }
        else
        {
        echo '<td><center><button id='.$row['log_id'].' onClick=callFunction2(this.id) >Discharge</button></center></td>';
        }
        echo '<td><center><button id='.$row['log_id'].' onClick=callFunction3(this.id) >Delete</button></center></td>';
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
  window.location.href = "serverScript4.php?logid="+clicked_id;
}
</script>