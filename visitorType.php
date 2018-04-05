<?php
    session_start();
    if($_SESSION["usertype"] != 'Volunteer')
    {
    if ($_SESSION['p_id'] == null)
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else{
    require("db_connect.php");
    $input = $_SESSION['p_id'];
    $query = "Select `VisitorType` FROM `PatientInfo` WHERE `PatientID` = '$input'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_array($result);
    $setting = $row[0];
        echo '
            <center>
        <form id="search-form" method="post">';
        echo "
        <table border='0.5' class='data-table'>
        <caption class='title'><center>Visitors Setting</center></caption>";
        if($setting == 'Y')
        {
            echo'<tr><td><center>Allow all visitors</center></td>';
        }
        elseif ($setting == 'N')
        {
            echo'<tr><td><center>Restricted, only approved visitors.</center></td>';
        }
        echo"<th><input type='submit' name='submit_99' value='Update' />
        </th></tr></table></form></center>";
        
    if ($_POST['submit_99'])
    {
    
        if($setting == 'N')
        {
            $query = "Update `PatientInfo` SET `VisitorType` = 'Y' WHERE `PatientID` = '$input'";
            $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $setting = 'Y';
        }
        elseif ($setting == 'Y')
        {
            $query = "Update `PatientInfo` SET `VisitorType` = 'N' WHERE `PatientID` = '$input'";
            $result2 = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $setting = 'N';
        }
        phpAlert25("Updated patient visitor type setting!");
        echo "<meta http-equiv='refresh' content='0'>";  
    }
    if ($setting == 'N')
    {
        echo '
        <center>
        <form id="search-form" method="post">
        <table border="0.5" class="data-table">
        <caption class="title"><center>Add Visitors</center></caption>
                <thead>
                <tr>
                <td><strong><label for="text"><center>First Name:</label></strong></td>
                <td><input type="p_text" name="ftext" id="ftext"></center></td>
                <td><strong><label for="text"><center>Last Name</label></strong></td>
                <td><input type="p_text" name="ltext" id="ltext"></center></td>
                <td><input type="submit" name="submit_77" value="Add" /></td>
                </tr>
                </thead>
                </table>
                <table border="0.5" class="data-table">
                <caption class="title"><center>Approved Visitors List</center></caption>
                <thead><tr>
                <th><center>#</center></th>
                <th><center>FIRST NAME</center></th>
                <th><center>LAST NAME</center></th>
                <th><center>Delete</center></th>
                </tr>
                </thead>
        </center>';
         if ($_POST['submit_77'])//when button was clicked for add visitor to the list to the database
        {
        $sqli = "Select `num` From `ApprovedVisitor` Where `PatientID` = '$_SESSION[p_id]' ORDER BY `num` DESC";
        $resee = mysqli_query($connection, $sqli) or die(mysqli_error($connection));
        $rowee = mysqli_fetch_array($resee);
        $newnum = $rowee[0] + 1;
        $fn = $_POST['ftext'];
        $ln = $_POST['ltext'];
        $input = $_SESSION['p_id'];
        $mysql = "Insert INTO `ApprovedVisitor` (`PatientID`,`num`,`FirstName`,`LastName`) VALUES ('$input', '$newnum','$fn','$ln')";
        $result = mysqli_query($connection, $mysql) or die(mysqli_error($connection));   
        phpAlert25("Approved visitor has been added to the list!");
        echo "<meta http-equiv='refresh' content='0'>";  
        }
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
            echo '<td><center>'.$newrow[3].'</center></td>';
            echo '<td><center>'.$newrow[1].'</center></td>';
            echo '<td><center>'.$newrow[2].'</center></td>';
            echo '<form id="search-form" method="post">';
            echo '<td><center><input type="hidden" name="ap_id" value="'.$newrow[3].'"/>
                <input type="submit" name="submit_d" value="Delete" /></center></td>		
                </form>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        
    }
     echo "<br><br>";
    }
    }
    function phpAlert25($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
if(isset($_POST["submit_d"]))
{
    require("db_connect.php");
    session_start();
    $input = $_SESSION["p_id"];
    $ap_num = $_POST["ap_id"];
    $query = "DELETE FROM `ApprovedVisitor` WHERE `PatientID` = '$input' AND `num` = '$ap_num'";
    $rest = mysqli_query($connection, $query) or die(mysqli_error($connection));
    phpAlert25("Approved visitor has been removed from the list!");
    echo "<meta http-equiv='refresh' content='0'>"; 
 }
?>