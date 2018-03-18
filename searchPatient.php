<!DOCTYPE html>
<?php 
include 'checkStatus.php';
?>
<html>
<head>
<title>Search Result - Patient Information Management System</title>
<link rel="stylesheet" href="css/tablestyle.css">
<link rel="stylesheet" type="text/css" href="mainpage.css"/>
</head> 
<br>
<br>
<center>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
            <tr>
                <td><strong><label for="user_id"><center>Patient Search (by):</label></strong></td>
                <td><select name="searchType">
                <option value="LAST">Last Name</option>
                <option value="FIRST">First Name</option>
                <option value="ID">ID</option>
                 </select>
                </td>
                <td><input type="p_text" name="p_last" id="p_last"></center></td>
                <td><input type="submit" value="Submit" />		
            </tr>
           </table>
    </form>
    </center>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
require("db_connect.php");
session_start();
$selection = $_POST['searchType'];
if ($selection == 'LAST')
{
    if(trim($_POST['p_last']) == '' or trim($_POST['p_last']) == null)
    {
        $input = '';
    }
    else
    {
    $input = "%".$_POST['p_last']."%";
    }
$query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE LastName LIKE '$input'";
}
elseif ($selection == 'ID')
{
    $input = $_POST['p_last'];
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE PatientID = '$input'";
}
elseif ($selection == 'FIRST')
{
        if(trim($_POST['p_last']) == '' or trim($_POST['p_last']) == null)
     {
         $input = '';
     }
     else
     {
     $input = "%".$_POST['p_last']."%";
     }
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE FirstName LIKE '$input'";
}
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

echo '
<table class="data-table">
<caption class="title"><center>Search Result</center></caption>
<thead>
        <tr>
        <th>#</th>
        <th>Patient ID</th>
        <th>Last Name</th>
        <th>Middle Initial</th>
        <th>First Name</th>
        <th>Date of Birth</th>
        <th>Selection</th>
        </tr>
</thead>';

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
elseif ($count>0)
{
    $no = 1;
    while ($row = mysqli_fetch_array($result))
    {
        echo '<tbody><tr>
             <td><center>'.$no.'</center></td>
             <td><center>'.$row['PatientID'].'</center></td>
             <td><center>'.$row['LastName'].'</center></td>
             <td><center>'.$row['MiddleName'].'</center></td> 
             <td><center>'.$row['FirstName'].'</center></td> 
             <td><center>'.$row['DOB'].'</center></td> 
             <td><center><button id='.$row['PatientID'].' onClick=callFunction(this.id) >Select</button></center></td>
                </tr></tbody>';
            $no++;   
    }
    echo '</table>';
}
}
?>
</html>

<script type="text/javascript">
function callFunction(clicked_id){
  window.location.href = "serverScript.php?pid="+clicked_id;
}
</script>

