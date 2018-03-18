
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
            <td></td>
            <td></td>
            <td><center>Record is not found!</center></td>
            <td></td>
            <td></td>
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