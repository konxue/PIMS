<?php
    session_start();
    
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
        echo '
            <center>
        <form id="search-form" method="post">';
        echo "
        <table border='0.5' class='data-table'>
        <caption class='title'><center>Visitors Setting</center></caption>";
        if($row[0] == 'Y')
        {
            echo'<tr><td><center>Allowed</center></td>';
        }
        elseif ($row[0] == 'N')
        {
            echo'<tr><td><center>Restricted</center></td>';
        }
        echo"<th><input type='submit' name='submit_99' value='Update' />
        </th></tr></table></form></center><br>";
        
    if ($_POST['submit_99'])
    {
    
        if($row[0] == 'N')
        {
            $query = "Update `PatientInfo` SET `VisitorType` = 'Y' WHERE `PatientID` = '$input'";
            $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }
        elseif ($row[0] == 'Y')
        {
            $query = "Update `PatientInfo` SET `VisitorType` = 'N' WHERE `PatientID` = '$input'";
            $result2 = mysqli_query($connection, $query) or die(mysqli_error($connection));
        }
        echo '<script type="text/javascript">alert("Updated patient visitor type setting!")</script>';
        echo("<meta http-equiv='refresh' content='0'>");  
    }
    if ($row[0] == 'Y')
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
                <thead>
                <tr>
                <th><center>#</center></th>
                <th><center>FIRST NAME</center></th>
                <th><center>LAST NAME</center></th>
                <th><center>Delete</center></th>
                </tr>
                </thead>
        </center>
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
            echo '<th><center>'.$newrow[1].'</center></th>';
            echo '<th><center>'.$newrow[2].'</center></th>';
            echo '<th><center><button id='.$newrow['num'].' onClick=callFunction7(this.id)>Delete</button></center></th></tr>';
        }
        echo '</tbody></table>';
        if ($_POST['submit_77'])//when button was clicked for add visitor to the list to the database
        {
        $sqli = "Select `num` From `ApprovedVisitor` Where `PatientID` = '$_SESSION[p_id]' ORDER BY `num` DESC";
        $res = mysqli_query($connection, $sqli) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($res);
        $newnum = $row[0] + 1;
        $fn = $_POST['ftext'];
        $ln = $_POST['ltext'];
        $input = $_SESSION['p_id'];
        $mysql = "Insert INTO `ApprovedVisitor` (`PatientID`,`num`,`FirstName`,`LastName`) VALUES ('$input', '$newnum','$fn','$ln')";
        $result = mysqli_query($connection, $mysql) or die(mysqli_error($connection));   
        newphpAlert("Approved visitor has been added to the list!");
        echo("<meta http-equiv='refresh' content='0'>");  
        }
    }
     echo "<br><br>";
    }
 function newphpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
    ?>
<script type="text/javascript">
function callFunction7(clicked_id){
  window.location.href = "serverScript8.php?vnum="+clicked_id;
}
</script>