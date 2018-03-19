<!--This PHP code is for the billing tab on the main page, it includes the HTML and CSS-->
<!--CSS for my code -->

<link rel="stylesheet" href="css/tablestyle.css">
<table style="display: inline-block;">

<!--HTML & PHP Code for my tab-->

<!-- Adding payment -->

<title>Amount being paid:</title>
<link rel="stylesheet" href="css/tablestyle.css">
<link rel="stylesheet" type="text/css" href="mainpage.css"/>
</head> 
<br>
<br>
<center>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
            <tr>
                <!--<td><strong><label for="user_id"><center>Payment Method</label></strong></td>
                <td><select name="searchType">
                <option value="DEBIT">Debit Card</option>
                <option value="CHECK">Check</option>
                <option value="CASH">Cash</option>
                 </select>
                </td>-->
                <td><input type="p_text" name="payment" id="payment"></center></td>
                <td><input type="submit" value="Submit Payment" />		
            </tr>
           </table>
    </form>
</center>
<?php
session_start();
require("db_connect.php");
    
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $amtpaid = $_POST['payment'];
    $query = "Select AmtPaid From InsuranceInfo where PatientID = '$_SESSION[p_id]'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    
    $row = mysqli_fetch_array($result);
    $money = $row[0];
    $totalmoney = $money+$amtpaid;
    $sql = "UPDATE InsuranceInfo SET AmtPaid = $totalmoney WHERE PatientId = '$_SESSION[p_id]'";
    
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}
?>
<script type="text/javascript">
function callFunction(clicked_id){
  window.location.href = "serverScript.php?pid="+clicked_id;
}
</script>
   

<table class="data-table" style="display: inline-block; float: left;">
<caption class="title">Itemized List</caption>
<thead>
        <tr>
            <th>Items</th>
            <th>Cost</th>        
        </tr>
</thead>


<?php
    
    $no = 1;
    $total = 0;
    
    $res = mysqli_query($connection, "Select * FROM ItemizedList WHERE PatientID = '$_SESSION[p_id]'"); 
    while($row = mysqli_fetch_array($res))
    {
        $amount  = $row['Cost'] == 0 ? '' : number_format($row['Cost']);
        
        echo "<tr>";
        echo "<td>" . $row['Item'] . "</td>";
        echo "<td>" . $row['Cost'] . "</td>";
        echo "</tr>";
        $total += $row['Cost'];
        $no++;      
    }
 ?>
        </tbody>
        <tfoot>
            <tr>
                    <th colspan="1">TOTAL</th>
                    <th><?=number_format($total)?></th>
            </tr>
        </tfoot>
<tbody>

<table class="data-table" style="display: inline-block;">
<caption class="title">Payment</caption>
<thead>
        <tr>
            <th>Amount Paid by Insurance:</th>
            <th>Amount due after Insurance:</th> 
        </tr>
</thead>
 <?php
    $payment=0;
    $res1 = mysqli_query($connection, "Select * FROM InsuranceInfo  WHERE PatientID = '$_SESSION[p_id]'");
    
    $query2 = "Select AmtPaidByInsurace From InsuranceInfo where PatientID = '$_SESSION[p_id]'";
    $res2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
    $row2 = mysqli_fetch_array($res2);
    $amtmoney = $row2[0];
    
    while($row = mysqli_fetch_array($res1))
    {     
        echo "<tr>";
        echo "<td>" . $row['AmtPaidByInsurance'] . "</td>";
        
        echo "<td>" . $row['AmtDueAfterInsurance'] . "</td>";
        echo "</tr>";
        $query = "SELECT `AmtPaid` FROM `InsuranceInfo` WHERE PatientID = '$_SESSION[p_id]'";
        
        $payment=$payment + $row['AmtPaidByInsurance'] + $row['AmtPaid'];
        $amtdue = $total - $payment;
    }
    
    mysqli_close($connection);
?>
</tbody>
    <tfoot>
    <tr>
        <th colspan="1">Amount Paid:</th>
        <th><?php echo $totalmoney?></th>
    </tr>
    <tr>
        <th colspan="1">Amount Due:</th>
        <th><?php echo $amtdue?></th>
    </tr>    
    </tfoot>
<tbody>


    


