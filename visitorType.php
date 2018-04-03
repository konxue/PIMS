<?php
    session_start();
    require("db_connect.php");
    $input = $_SESSION['p_id'];
    $query = "Select `VisitorType` FROM `PatientInfo` WHERE `PatientID` = '$input'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_array($result);
        echo "
            <center>
        <form id='search-form' method='post'>
        <table border='0.5' class='data-table'>
        <caption class='title'><center>Visitors Setting</center></caption>
                <tr>";
        if($row[0] == 'Y')
        {
            echo'<td><center>Allowed</center></td>';
        }
        elseif ($row[0] == 'N')
        {
            echo'<td><center>Restricted</center></td>';
        }
        echo"        
                <th><input type='submit' name='submit_99' value='Update' /></th>
                </tr>
       </table></form><br></center>
        ";
    if ($_POST[submit_99])
    {
        if($row[0] == 'N')
        {
            $query = "Update `PatientInfo` SET `VisitorType` = 'Y' WHERE `PatientID` = '$input'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }
        elseif ($row[0] == 'Y')
        {
            $query = "Update `PatientInfo` SET `VisitorType` = 'N' WHERE `PatientID` = '$input'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }
        php2Alert("Updated patient's visitor type setting!");
        header("Refresh:1");
    }
    if ($row[0] == 'Y')
    {
        echo '
        <center>
        <form id="search-form" method="post">
        <table border="0.5" class="data-table">
         <caption class="title"><center>Add Visitors</center></caption>
                <tr>
                <td><strong><label for="text"><center>First Name:</label></strong></td>
                <td><input type="p_text" name="ftext" id="ftext"></center></td>
                <td><strong><label for="text"><center>Last Name</label></strong></td>
                <td><input type="p_text" name="ltext" id="ltext"></center></td>
                <th><input type="submit" name="submit_77" value="Add" /></th>
                </tr>
        </table>
        <table border="0.5" class="data-table">
        <thead>
                <tr>
                <th><center>#</center></th>
                <th><center>FIRST NAME</center></th>
                <th><center>LAST NAME</center></th>
                <th><center>Delete</center></th>
                </tr>
        </thead></center>
        ';
        $sqli = "Select * From `ApprovedVisitor` Where `PatientID` = '$_SESSION[p_id]' ORDER BY `num`";
        $res = mysqli_query($connection, $sqli) or die(mysqli_error($connection));
        $count = mysqli_num_rows($res);
        echo '<tbody>';
        if($count == 0)
        {
            echo '<th><center></th></center>';
            echo '<th><center>No records</th></center>';
            echo '<th><center></th></center>';
            echo '<th><center></th></center></tr>';
        }
        while ($newrow = mysqli_fetch_array($res))
        {
            echo '<th><center>'.$newrow[3].'</center></th>';
            echo '<th><center>'.$newrow[2].'</center></th>';
            echo '<th><center>'.$newrow[1].'</center></th>';
            echo '<td><center><button id='.$newrow[3].' onClick=callFunction7(this.id) >Delete</button></center></td>';
        }
        echo '</tbody></table>';
    }
    ?>

<script type="text/javascript">
function callFunction8(clicked_id){
  window.location.href = "serverScript7.php?logid="+clicked_id;
}
</script>
