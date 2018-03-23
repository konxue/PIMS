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
      echo '
        <form id="form" method="post">
          <table border="0.5" class="data-table">
          <caption class="title"><center>Patient Check In</center></caption>
            <tr>
                <td><strong><label for="text"><center>Admission Reason: </label></strong></td>
                <td><input type="p_text" name="atext" id="atext"></center></td>
                <td><input type="submit" name="submit_3" value="Check in" />
            </tr>
           </table>
        </form>
        <br>';
   if($_POST["submit_3"]) //when button got clicked
    {
        date_default_timezone_set("America/Chicago");
        $input = $_SESSION['p_id'];
        $newdate = date("Y/m/d");
        $newtime = date("h:i:s A");
        $text = $_POST['atext'];
        $sql = "Select `log_id` From `MedicalInfo` where `PatientID` = '$input' ORDER BY `log_id` DESC";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($result);
        $logid = $row[0] + 1;
        
        //getting the primary key for the table.. duplicate error on nonunique pk
        $sql = "Select `pk` From `MedicalInfo` ORDER BY `pk` DESC";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($result);
        $pk = $row[0] + 1;
        
        //create new visit log_id
        $sql = "INSERT INTO `MedicalInfo` (`PatientID`, `log_id`, `AdmissionDate`, `AdmissionTime`, `ReasonForAdmission`, `pk`) VALUES ('$input', '$logid', '$newdate', '$newtime', '$text', '$pk')";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        
        //getting the primary key for the table.. duplicate error on nonunique pk
        $sql = "Select `pk` From `Payment` ORDER BY `pk` DESC";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($result);
        $pk = $row[0] + 1;
        
        //create bill info for new visit log_id
        $sql = "INSERT INTO `Payment` (`PatientID`, `log_id`, `AmtPaidByInsurance`, `CoPay`, `AmtPaid`, `Balance`, `pk`) VALUES ('$input','$logid','0','0','0','0','$pk')";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        php1Alert("Patient has checked in on ".$newdate." ".$newtime);
    }
    $input = $_SESSION['p_id'];
    $sql = "Select * FROM MedicalInfo WHERE PatientID = '$input' ORDER BY `log_id` DESC";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    echo '
        <table class="data-table">
        <caption class="title"><center>Admission Report</center></caption>
        <thead>
                <tr>
                <th><center>Visit ID</center></th>
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
    echo "</table><br><br>";
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