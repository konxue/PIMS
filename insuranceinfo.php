
<link rel="stylesheet" href="css/tablestyle.css">
<link rel="stylesheet" type="text/css" href="mainpage.css"/>

<?php
   session_start();
    if ($_SESSION['p_id'] == null)
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
    $count = mysqli_num_rows($result);

    echo '
        <center>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
            <tr>
                <td><strong><label for="Carrier"><center>Carrier:</label></strong></td>
                <td><input type="p_text" name="Carrier" id="Carrier"></center></td>
                <td><strong><label for="AcctNum"><center>Account #:</label></strong></td>
                <td><input type="p_text" name="AcctNum" id="AcctNum"></center></td>
                <td><strong><label for="GrpNum"><center>Group #:</label></strong></td>
                <td><input type="p_text" name="GrpNum" id="GrpNum"></center></td>
                <td><input type="submit" value="Update" />		
            </tr>
           </table>
          
    </form>
    </center>
    <br>
    <br>
        <table class="data-table">
        <thead>
                <tr>
                <th><center>Insurance Carrier</center></th>
                <th><center>Account Number</center></th>
                <th><center>Group Number</center></th>
                </tr>
        </thead>
        ';
    if ($count==0)
{
    echo '<tbody><tr>
            <td></td>
            <td><center>Insurance not found!</center></td>
            <td></td>
            </tr></tbody></table>'
         ;
}
    while($row = mysqli_fetch_array($res))
    {
        echo "<tr>";
        echo "<td><center>" . $row['Carrier'] . "</center></td>";
        echo "<td><center>" . $row['AccntNum'] . "</center></td>";
        echo "<td><center>" . $row['GrpNum'] . "</center></td>";
        echo "</tr>";
    }
        echo "</table>";
    mysqli_close($connection);
    }
?>

