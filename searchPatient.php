<!--
    Purpose: This PHP page handles the search bar for the application
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<?php
session_start();
//output search table
echo '
    <body>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
           <center>  <caption class="title"><center>Patient Search</caption> </center>
            <tr>
                <td><strong><label for="user_id"><center>Search by</label>   </strong>
                <select name="searchType">
                <option value="LAST">Last Name</option>
                <option value="FIRST">First Name</option>
                <option value="ID">ID</option>
                 </select>
                </td>
                <td><input type="p_text" name="p_last" id="p_last"></center></td>
                <td><input type="submit" name="submit_0" value="Search" /></td>';
                if ($_SESSION['usertype'] == 'OfficeStaff') //only office staff can add new patient
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
if($_POST['addPclick']) //when add patient is click
{
     echo '<script type="text/javascript">window.open("http://onlinepims.com/addPatient.php");</script>';
}
if($_POST['submit_0']) //when search button is click
{
require("db_connect.php");
$selection = $_POST['searchType'];
$count = -1;
if ($selection == 'LAST') // search by last name
{
    $plast = (string) addslashes($_POST['p_last']);
    if(trim($plast) == null) //catch empty input
    {
        echo '<script type="text/javascript">alert("Please enter a valid name!")</script>';
    }
    else
    {
    $input = "%".$plast."%"; //match missing characters for the name, help for bad spelling
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE LastName LIKE '$input'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    }
}
elseif ($selection == 'ID') // search by ID
{
    $input = $_POST['p_last'];
    if ($input == null || !(is_numeric($input)))
    {
        echo '<script type="text/javascript">alert("Please enter a valid ID, numbers only!")</script>';
    }
    else
    {
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE PatientID = '$input'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    }
}
elseif ($selection == 'FIRST') // search by first name
{
    $plast = (string) addslashes($_POST['p_last']);
        if(trim($plast) == null)
     {
         echo '<script type="text/javascript">alert("Please enter a valid name!")</script>';
     }
     else
     {
     $input = "%".$plast."%"; //match missing characters for the name, help for bad spelling
     $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE FirstName LIKE '$input'";
     $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
     $count = mysqli_num_rows($result);
     }
    
}      
if ($count==0) // no record
{
    echo '<table class="data-table"><thead>
    <th><center>Record is not found!</center></th></table></table>';
}
elseif ($count>0)
{
    //output table for the result
    echo '
<table class="data-table">
<caption class="title"><center>Search Result</center></caption>
<thead>
        <tr>
        <th>#</th>
        <th>Patient ID</th>
        <th>Last Name</th>
        <th>Middle Name</th>
        <th>First Name</th>';
       if ($_SESSION["usertype"] != 'Volunteer')
       {
        echo '<th>Date of Birth</th>';
       }
        echo '<th>Selection</th>'; // select button
        echo'
        </tr>
</thead>';
    $no = 1;
    while ($row = mysqli_fetch_array($result)) //output information in the $row array
    {
        echo '<tbody><tr>
             <td><center>'.$no.'</center></td>
             <td><center>'.$row['PatientID'].'</center></td>
             <td><center>'.$row['LastName'].'</center></td>
             <td><center>'.$row['MiddleName'].'</center></td> 
             <td><center>'.$row['FirstName'].'</center></td> ';
        if ($_SESSION["usertype"] != 'Volunteer') //hide dob for volunteer
       {
            echo' <td><center>'.$row['DOB'].'</center></td> ';
       }
            echo'<td><center><button id='.$row['PatientID'].' onClick=callFunction(this.id) name=grr>Select</button></center></td>'; // select button
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

