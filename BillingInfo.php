<!--This PHP code is for the billing tab on the main page, it includes the HTML and CSS-->
<style>
   .inlinetable
   {
       display: inline-block;
   }
    /* Table */
    .inlinetable {
            border-collapse: collapse;
            font-size: 14px;
            min-width: 537px;
    }

    .inlinetable th, 
    .inlinetable td {
            border: 1px solid #e1edff;
            padding: 7px 17px;
    }
    .inlinetable caption {
            margin: 7px;
    }
    /* Table Header */
    .inlinetable thead th {
            background-color: #508abb;
            color: #FFFFFF;
            border-color: #6ea1cc !important;
            text-transform: uppercase;
    }

    /* Table Body */
    .inlinetable tbody td {
            color: #353535;
    }
    .inlinetable tbody td:first-child,
    .inlinetable tbody td:nth-child(4),
    .inlinetable tbody td:last-child {
            text-align: right;
    }

    .inlinetable tbody tr:nth-child(odd) td {
            background-color: #f4fbff;
    }
    .inlinetable tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f;
    }

    /* Table Footer */
    .inlinetable tfoot th {
            background-color: #e5f5ff;
            text-align: right;
    }
    .inlinetable tfoot th:first-child {
            text-align: left;
    }
    .inlinetable tbody td:empty
    {
            background-color: #ffcccc;
    }
</style>

<!--HTML Code for my tab-->

<table class="inlineTable">
<caption class="title">Itemized List</caption>
<thead>
        <tr>
            <th>Amount Paid by Insurance</th>
            <th>Amount Paid by Patient</th>        
        </tr>"
</thead>
<tbody>

<table class="inlineTable">
<caption class="title">Itemized List</caption>
<thead>
        <tr>
            <th>Items</th>
            <th>Cost</th>        
        </tr>"
</thead>
<tbody>
 <?php
    require("db_connect.php");
    $res = mysqli_query($connection, "Select * FROM ItemizedList WHERE PatientID = '$_SESSION[p_id]'"); 
    while($row = mysqli_fetch_array($res))
    {
        echo "<tr>";
        echo "<td>" . $row['Item'] . "</td>";
        echo "<td>" . $row['Cost'] . "</td>";
        echo "</tr>";
    }
       
    $res = mysqli_query($connection, "Select * FROM InsuranceInfo  WHERE PatientID = '$_SESSION[p_id]'");    
    while($row = mysqli_fetch_array($res))
    {
        echo '<tr>
            <td>' . $row['AmtPaidByInsurance'] . '</td>
            <td>' . $row['AmtPaidByPatient'] . '</td>"
        </tr>';
    }
    
    mysqli_close($connection);
    
?>

