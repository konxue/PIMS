<?php
    function pAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
   session_start();
    if ($_SESSION['p_id'] == null && ($_SESSION["usertype"] != 'Volunteer'))
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else {
    $connection = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }
    $select_db = mysqli_select_db($connection, 'onlinepims');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($connection));
    }
    $input = $_SESSION['p_id'];
    $res = mysqli_query($connection, "Select * FROM InsuranceInfo WHERE PatientID = '$input'");
    $count = mysqli_num_rows($res);

    echo '
        <center><br>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
          <caption class="title"><center>Update Insurance Information</center></caption>
            <tr>
                <td><strong><label for="Carrier"><center>Carrier:</label></strong></td>
                <td><input type="p_text" name="Carrier" id="Carrier"></center></td>
                <td><strong><label for="AcctNum"><center>Account #:</label></strong></td>
                <td><input type="p_text" name="AcctNum" id="AcctNum"></center></td>
                <td><strong><label for="GrpNum"><center>Group #:</label></strong></td>
                <td><input type="p_text" name="GrpNum" id="GrpNum"></center></td>
                <td><input type="submit" name = "submit_5" value="Update" />		
            </tr>
           </table>
          
    </form>
    </center>
    <br>
    <br>
        ';
    if($_POST['submit_5']) //get button click event
    {
        $carrier = $_POST['Carrier']; // for all variable
        $acctnum = $_POST['AcctNum'];
        $grpnum = $_POST['GrpNum'];
        if ($carrier == null || $acctnum == null || $grpnum == null)
        {
            pAlert("Please fill all boxes!");
       
        }elseif(is_numeric ($grpnum) && is_numeric ($acctnum)) {
            $sql = "UPDATE `InsuranceInfo` SET `Carrier` = '$carrier' , `AccntNum` = '$acctnum' , `GrpNum` = '$grpnum' WHERE `PatientId` = '$_SESSION[p_id]'"; 
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));  
            pAlert("Insurance has been updated!");
            echo("<meta http-equiv='refresh' content='0'>"); 
        }else{
            pAlert("Invalid Group or Account Numbers!");
        }

    }
    if ($count==0)
{
    echo '<table class="data-table">
        <thead><thead><tr>
            <th><center>No insurance record!</center></th>
            </tr></tbody></table>' ;
}
else{
    $row = mysqli_fetch_array($res);
        echo'<table class="data-table">
        <thead>
                <tr>
                <th><center>Insurance Carrier</center></th>
                <th><center>Account Number</center></th>
                <th><center>Group Number</center></th>
                </tr>
        </thead>';
        echo "<tbody><tr>";
        echo "<td><center>" . $row['Carrier'] . "</center></td>";
        echo "<td><center>" . $row['AccntNum'] . "</center></td>";
        echo "<td><center>" . $row['GrpNum'] . "</center></td>";
        echo "</tr></tbody>";
        echo "</table>";
    }
    echo '<br><br>';
    mysqli_close($connection);
}
    ?>

