<!--This PHP code is for the billing tab on the main page, it includes the HTML and CSS-->

<?php
session_start();
if(($_SESSION["usertype"] != 'Volunteer'))
{
if ($_SESSION['p_id'] == null)
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else {
require("db_connect.php");
//Payment submit
echo '
<br>
<center>
        <form id="search-form" method="post">
          <table border="0.5" class="data-table">
                <strong><center><label for="paycenter">Patient Payment Center</label></center></strong></td>
                <tr><td><strong><label for="vname"><center>Visit #</label></strong></td>
                <td><input type="p_text" name="vnum" id="vnum"></td>
                <td><strong><label for="pchoice"><center>Pay Type</label></strong></td>
                <td><select name="paytype">
                    <option value="REGULAR">Balance</option>
                    <option value="COPAY">Insurance Co-Pay</option>
                    </select></td>
                <td><strong><label for="pname"><center>Payment Method</label></strong></td>
                <td><select name="cardType">
                    <option value="CARD">Debit/Credit Card</option>
                    <option value="CHECK">Check</option>
                    <option value="CASH">Cash</option>
                    </select></td>
                <td><input type="p_text" name="payment" id="payment"></td>
                <td><input type="submit" name="submit_1" value="Submit Payment" />		
            </tr>
           </table>
    </form>
</center><br>';

if($_POST['submit_1'])
{
    $amtpaid = $_POST['payment'];
    $vid = $_POST['vnum'];
    $selection = $_POST['paytype'];
    $query = "Select `CoPay`,`AmtPaid`,`Balance` From Payment where PatientID = '$_SESSION[p_id]'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    //compare to see if visit id is valid
    if ($vid > $count || $vid <=0)
    {
        echo '<script language="javascript">';
        echo 'alert("Invalid Visit #, please try again")';
        echo '</script>';
    }
    elseif ($amtpaid == 0)
    {
        echo '<script language="javascript">';
        echo 'alert("Please enter an amount!")';
        echo '</script>';
    }
    else
    {
        $query = "Select `CoPay`,`AmtPaid`,`Balance` From Payment where PatientID = '$_SESSION[p_id]' and log_id='$vid'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $row = mysqli_fetch_array($result);
        if ($selection == 'COPAY') //paying for copay
        {
         // CASE 0: NO Balance
            if($row[2] == 0)
            {
               phpAlert("This patient has no balance on this visit!");
            }
            else{
         // CASE 1: COPAY = 0, copay is accept
            if ($row[0] == 0)
            {
                $balance = $row[2] - $amtpaid;
                if ($balance<0) //when balance got paid off will ask to give change
                {
                    $change = 0 - $balance;
                    $balance = 0;
                    $sql = "UPDATE `Payment` SET `CoPay` = '$amtpaid' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                    phpAlert("Balance has been paid off! Change: $".$change);
                }
                else
                {
                $sql = "UPDATE `Payment` SET `CoPay` = '$amtpaid' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                 phpAlert("Copay is accepted!");
                }
            }
         // CASE 2: COPAY ALREADY EXIST, copay amount becomes amt pay
            elseif ( $row[0] > 0 )
            {
                $balance = $row[2] - $amtpaid;
                $money = $amtpaid + $row[1]; //current money paid
                if ($balance<0) //when balance got paid off will ask to give change
                {
                    $change = 0 - $balance;
                    $balance = 0;
                    $money = $money - $change;
                    $sql = "UPDATE `Payment` SET `AmtPaid` = '$money' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                    phpAlert("Copay exsited!\\nPayment will deposit to the patient account!\\nBalance has been paid off!\\nChange: $".$change);
                }
                else
                {
                    $sql = "UPDATE `Payment` SET `AmtPaid` = '$money' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                    phpAlert("Copay exsited!\\nPayment will deposit to the patient account!");
                }
            }
         }
        }
        elseif ($selection == 'REGULAR') //PAY FOR REGULAR BALANCE
        {
             // CASE 0: NO Balance
            if($row[2] == 0)
            {
               phpAlert("This patient has no balance on this visit! \\nFull refund!");
            }
            else{
            $balance = $row[2] - $amtpaid;
            $money = $row[1] + $amtpaid;
            // CASE 1: Pay off balance
            if ($balance<0) //when balance got paid off will ask to give change
                {
                    $change = 0 - $balance;
                    $balance = 0;
                    $money = $money - $change;
                    $sql = "UPDATE `Payment` SET `AmtPaid` = '$money' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id` = '$vid'"; 
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                    phpAlert("Payment accepted!\\nBalance has been paid in full!\\nChange: $".$change);
                }
            else
            {
                $sql = "UPDATE `Payment` SET `AmtPaid` = '$money' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                phpAlert("Payment accepted!");
            }
            }
        }
        
    }
}
    
    $total = 0;
    $input = $_SESSION['p_id'];
    $mysql = "Select `log_id` From `MedicalInfo` Where `PatientID` = '$input' ORDER BY `log_id` DESC";
    $results = mysqli_query($connection, $mysql) or die(mysqli_error($connection));
    while($thisrow = mysqli_fetch_array($results))
    {
        $no = $thisrow['log_id'];
        echo '<center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo'.$no.'">Visit #'.$thisrow['log_id'].'</button></center>
              <div id="demo'.$no.'" class="collapse">
              <br>
              <table class="data-table">
                <thead>
                <tr>
                <th><center>Item</center></th>
                <th><center>Cost</center></th>
                <th><center>Date of Service</center></th>
                </tr>
               </thead>';
        $sqli = "Select * From `ItemizedList` Where `PatientID` = '$_SESSION[p_id]' and `log_id` = '$no'";
        $res = mysqli_query($connection, $sqli) or die(mysqli_error($connection));
        echo '<tbody>';
        while ($newrow = mysqli_fetch_array($res))
        {
            echo "<tr><td><center>" . $newrow['Item'] . "</center></td>";
            echo "<td><center>" . $newrow['Cost'] . "</center></td>";
            echo "<td><center>". $newrow['DateofService']."</center></td><tr>";
            $total = $total + $newrow['Cost'];  
        }
       $newsql = "Select `AmtPaidByInsurance`,`CoPay`,`AmtPaid` From `Payment` Where `PatientID` = '$_SESSION[p_id]' and `log_id` = '$no'";
       $result1 = mysqli_query($connection, $newsql) or die(mysqli_error($connection));
       $row1=mysqli_fetch_array($result1);
        echo '</tbody><tfoot>
              <tr>
              <th></th><th><left>Total amount due:</left></th> 
              <th></th><th><left>$'.$total.'</left></th>
              </tr>
              <tr><th></th><th><left>Insurance Paid:</left></th>
              <th></th><th><left>$'.$row1[0].'</left></th></tr>
              <tr><th></th><th><left>Copay:</left></th>
              <th></th><th><left>$'.$row1[1].'</left></th></tr>
              <tr><th></th><th><left>Amount Paid:</left></th>
              <th></th><th><left>$'.$row1[2].'</left></th></tr>
              <tr><th></th><th><left>Balance Due:</left></th>';
        $newbalance = $total-$row1[0]-$row1[1]-$row1[2];
        if($newbalance < 0)
        {
            $newbalance = 0;
        }
        echo '
              <th></th><th><left>'.$newbalance.'</left></th></tr>    
              </tfoot></table>
  </div><br>';
               
               $sql = "UPDATE `Payment` SET `Balance` = '$newbalance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id` = '$no'"; 
               $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if ($no == null)
    {
        echo '<table class="data-table">
                <thead><th><center>No billing records!</center></th></thead></table>';
    }
    echo '<br><br>';
    mysqli_close($connection); 
    }
    
    function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
}
?>


    


