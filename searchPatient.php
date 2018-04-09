<?php
session_start();
echo '
    <body>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
           <center>  <caption class="title"><center>Patient Search</caption> </center>
            <tr>
                <td><strong><label for="user_id"><center>Patient Search (by):</label></strong></td>
                <td><select name="searchType">
                <option value="LAST">Last Name</option>
                <option value="FIRST">First Name</option>
                <option value="ID">ID</option>
                 </select>
                </td>
                <td><input type="p_text" name="p_last" id="p_last"></center></td>
                <td><input type="submit" name="submit_0" value="Submit" /></td>';
                if ($_SESSION['usertype'] == 'OfficeStaff')
                {
                    echo '<td><center><input type="submit" name="addPclick" value="Add New Patient" /></center></td>';
                }
            echo'
            </tr>
           </table>
    </form>
    </center>
</body>
    ';
if($_POST['addPclick'])
{
     echo '<script type="text/javascript">window.open("http://onlinepims.com/addPatient.php");</script>';
}
if($_POST['submit_0'])
{
require("db_connect.php");
$selection = $_POST['searchType'];
if ($selection == 'LAST')
{
    if(trim($_POST['p_last']) == '' or trim($_POST['p_last']) == null)
    {
        $input = '';
        echo '<script type="text/javascript">alert("Please enter a valid name!")</script>';
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
         echo '<script type="text/javascript">alert("Please enter a valid name!")</script>';
     }
     else
     {
     $input = "%".$_POST['p_last']."%";
     }
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE FirstName LIKE '$input'";
}
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);      
if ($count==0)
{
    echo '<table class="data-table"><thead>
    <th><center>Record is not found!</center></th></table></table>';
}
elseif ($count>0)
{
    echo '
<table class="data-table">
<caption class="title"><center>Search Result</center></caption>
<thead>
        <tr>
        <th>#</th>
        <th>Patient ID</th>
        <th>Last Name</th>
        <th>Middle Initial</th>
        <th>First Name</th>';
       if ($_SESSION["usertype"] != 'Volunteer')
       {
        echo '<th>Date of Birth</th>';
       }
        echo '<th>Selection</th>';
       
        echo'
        </tr>
</thead>';
    $no = 1;
    while ($row = mysqli_fetch_array($result))
    {
        echo '<tbody><tr>
             <td><center>'.$no.'</center></td>
             <td><center>'.$row['PatientID'].'</center></td>
             <td><center>'.$row['LastName'].'</center></td>
             <td><center>'.$row['MiddleName'].'</center></td> 
             <td><center>'.$row['FirstName'].'</center></td> ';
        if ($_SESSION["usertype"] != 'Volunteer')
       {
            echo' <td><center>'.$row['DOB'].'</center></td> ';
       }
            echo'<td><center><button id='.$row['PatientID'].' onClick=callFunction(this.id) name=grr>Select</button></center></td>';
            echo'</tr></tbody>';
            $no++;
    }
    echo '</table>';
}
}
?>

<script type="text/javascript">
function callFunction(clicked_id){
  window.location.href = "serverScript.php?pid="+clicked_id;
}
</script>

