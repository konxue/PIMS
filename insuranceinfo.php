<!--
    Purpose: This PHP page handle the insurance information tab
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->


<?php
    function pAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    } //php alert function
   session_start();
   if(($_SESSION["usertype"] != 'Volunteer')) //hidden for volunteer
{
    if ($_SESSION['p_id'] == null) // when patient is not selected
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else {
    require("db_connect.php"); //database connector
    $input = $_SESSION['p_id'];

   
    echo '
        <center><br>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
          <caption class="title"><center>Add / Update Insurance Information</center></caption>
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
        $carrier = (string) addslashes($_POST['Carrier']); // for carrier variable
        $acctnum = $_POST['AcctNum']; // for account number variable
        $grpnum = $_POST['GrpNum']; // for group number variable
        if ($carrier == null || $acctnum == null || $grpnum == null) //handle empty input
        {
            pAlert("Please fill all boxes!");
       
        }elseif(is_numeric ($grpnum) && is_numeric ($acctnum)) { 
            $sql = "Select * From `InsuranceInfo` where `PatientId` = '$_SESSION[p_id]'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));  
            $c = mysqli_num_rows($result);
            if($c>0) //when record on the database with selected patient exist, update value
            {
            $sql = "UPDATE `InsuranceInfo` SET `Carrier` = '$carrier' , `AccntNum` = '$acctnum' , `GrpNum` = '$grpnum' WHERE `PatientId` = '$_SESSION[p_id]'"; 
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));  
            }
            else //add new insurance information to the database
            {
            $sql = "INSERT INTO `InsuranceInfo` (`PatientID`,`Carrier`,`AccntNum`,`GrpNum`) VALUES ('$_SESSION[p_id]','$carrier','$acctnum','$grpnum')"; 
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));    
            }
            echo("<meta http-equiv='refresh' content='0'>"); //refresh page
        }else{
            pAlert("Invalid Group or Account Numbers!"); //handle non numeric input
        }

    }
    $res = mysqli_query($connection, "Select * FROM InsuranceInfo WHERE PatientID = '$input'"); //database query for insurance information
    $count = mysqli_num_rows($res);    
     //output table for insurance information
    if ($count==0)
{
    echo '<table class="data-table">
        <thead><thead><tr>
            <th><center>No insurance record!</center></th>
            </tr></tbody></table>' ;
}
else{
    $row = mysqli_fetch_array($res); //output table
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
}
    ?>

