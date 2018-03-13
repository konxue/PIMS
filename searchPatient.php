<title>Search Result - Patient Information Management System</title>

<?php
require("db_connect.php");
session_start();
$lastname = $_POST['p_last'];
$selection = $_POST['searchType'];
if ($selection == 'LAST')
{
$query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE LastName = '$lastname'";
}
elseif ($selection == 'ID')
{
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE PatientID = '$lastname'";
}
elseif ($section == 'DOB')
{
     $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE DOB = '$lastname'";
}
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
if ($count==0)
{
    header("Refresh: 2; url=mainpage.php");
    echo 'Unable to find this patient, please try again!<br /><br />Return to main page in 2 seconds...<br /><br />';
}
else
{
    echo "Patient ID |  First Name  |  M.I  |  Last Name  |  Date of Birth |<br />";
    while ($row = mysqli_fetch_array($result))
    {
        echo $row['PatientID']." | ".$row['FirstName']." | ".$row['MiddleName']." | ".$row['LastName']." | ".$row['DOB'];
        echo "<br />";
    }
    echo "<br /><br />";
}
?>

<button onclick="history.go(-1);"> Back </button>
