<!DOCTYPE html>
<html>
<head>
<title>Search Result - Patient Information Management System</title>
<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
</style>
</head> 
<center>
        <form id="search-form" method="post">
          <table border="0.5" >
            
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
$input = "%".$_POST['p_last']."%";
$query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE LastName LIKE '$input'";
}
elseif ($selection == 'ID')
{
    $input = $_POST['p_last'];
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE PatientID = '$input'";
}
elseif ($selection == 'FIRST')
{
    $input = "%".$_POST['p_last']."%";
    $query = "SELECT `PatientID`,`FirstName`,`MiddleName`,`LastName`,`DOB` FROM `PatientInfo` WHERE PatientID LIKE '$input'";
}
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
}
?>

<table class="data-table">
<caption class="title">Search Result</caption>
<thead>
        <tr>
        <th>#</th>
        <th>Patient ID</th>
        <th>Last Name</th>
        <th>Middle Initial</th>
        <th>First Name</th>
        <th>Date of Birth</th>
        <th></th>
        </tr>
</thead>
<tbody>
<?php
$no = 1;
if ($count==0 && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    echo '<tr>
            <td></td>
            <td></td>
            <td></td>
            <td><center>Record isnot found!</center></td>
            <td></td>
            <td></td>
            <td></td>
            </tr>';
}
elseif ($count>0)
{
     function myfunction($var)
    {
        $_SESSION['p_selected'] = $var;
         if ($_SESSION['p_selected'] != null)
         {
        echo "Selected Patient Id: ".$_SESSION['p_selected'];
         }
        else
        {echo "Please select a patient before you check the medical information";}
    }
    while ($row = mysqli_fetch_array($result))
    {
        echo '<tr>
             <td><center>'.$no.'</center></td>
             <td><center>'.$row['PatientID'].'</center></td>
             <td><center>'.$row['LastName'].'</center></td>
             <td><center>'.$row['MiddleName'].'</center></td> 
             <td><center>'.$row['FirstName'].'</center></td> 
             <td><center>'.$row['DOB'].'</center></td> 
             <td><center><button onclick=\"myfunction('.$row['PatientID'].'); this.disabled=true;\">Select</button></form></fieldset></center></td>
                </tr>';
         $no++;   
    }
}
?>
</tbody>
</table>
</body>
</html>

