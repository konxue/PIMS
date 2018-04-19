<!--
    Purpose: This PHP page is for the billing information tab that shows on the main page
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->
<?php
session_start();
if(($_SESSION["usertype"] != 'Volunteer')) //hidden for volunteer
{
if ($_SESSION['p_id'] == null) //if patient not been selected
    {
        echo "<br><br><center><strong>Please select a patient from the search result!</center></strong><br><br>";
    }
    else //patient is selected
    {
        require("db_connect.php");
        //Table for payment submit
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
                            <option value="ICHECK">Insurance Check</option>
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
        //table for adding items to the bill based on the admission #
        echo '
            <center><br>
            <form id="search-form" method="post">
            <table border="0.5" class="data-table">
            <strong><center><label for="Billcenter">Add item to bill</label></center></strong></td>
                    <tr>
                    <td><strong><label for="text"><center>Visit #</label></strong></td>
                    <td><input type="p_text" name="anum" id="anum"></center></td>
                    <td><strong><label for="text"><center>Item/Charge Name</label></strong></td>
                    <td><input type="p_text" name="itext" id="itext"></center></td>
                    <td><strong><label for="text"><center>Cost</label></strong></td>
                    <td><input type="p_text" name="ctext" id="ctext"></center></td>
                    <td><strong><label for="text"><center>Date of Service (yyyy-mm-dd)</label></strong></td>
                    <td><input type="p_text" name="ddate" id="ddate"></center></td>
                    <td><input type="submit" name="submit_25" value="Add" /></td>
                    </tr>
                    </table>
            </center><br>';
            if($_POST['submit_25'])//when submit_25 button is click, it will add information to the database
            {
                        $input = $_SESSION['p_id'];
                        $logid = $_POST['anum'];
                        $sql = "SELECT * FROM ItemizedList order by `pk` DESC";
                        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $rowforpk = mysqli_fetch_array($result);
                        $newpk = $rowforpk['pk'] + 1;
                        $item = (string) addslashes($_POST['itext']);
                        $cost = (double) $_POST['ctext'];
                        $newdate = $_POST['ddate'];
                        if( (!is_numeric($cost)) || !isset($item) || !isset($logid) || (!is_numeric($logid))|| !isset($newdate))
                        {

                            pAlert("Detect incorrect input, please try again!");
                        }
                        else
                        {
                            $sql = "INSERT INTO `ItemizedList` (`PatientID`, `log_id`, `pk`, `Item`, `Cost`, `DateofService`) VALUES ('$input', '$logid', '$newpk', '$item', '$cost', '$newdate')";
                            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                            echo "<meta http-equiv='refresh' content='0'>"; 
                        }
            }
        if($_POST['submit_1']) //when submit_1 button is click, it will add information to the database
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
                    else
                    {
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
                               pAlert("Paid off! Change: $".$change);
                           }
                           else
                           {
                                $sql = "UPDATE `Payment` SET `CoPay` = '$amtpaid' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
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
                               pAlert("Paid off!\\nChange: $".$change);
                           }
                           else
                           {
                               $sql = "UPDATE `Payment` SET `AmtPaid` = '$money' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                               $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                           }
                       }
                    }
                }
                elseif ($selection == 'REGULAR') //PAY FOR REGULAR BALANCE
                {
                     // CASE 0: NO Balance
                    if($row[2] == 0)
                    {
                       pAlert("No balance on this visit!");
                    }
                    else
                    {
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
                            pAlert("Paid in full!\\nChange: $".$change);
                        }
                        else
                        {
                            $sql = "UPDATE `Payment` SET `AmtPaid` = '$money' , `Balance` = '$balance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$vid'"; 
                            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        }
                    }
                }
                elseif ($selection == 'ICHECK') // When insurance company mailed a check, we use this option to pay patient account
                {
                    $amtpaid = $_POST['payment'];
                    $input = $_SESSION['p_id'];
                    $vid = $_POST['vnum'];
                    //getting current amount on the database
                    $sql = "SELECT * FROM `Payment` WHERE `log_id` = '$vid' AND `PatientID` = '$input'";
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                    $rowforInsurance = mysqli_fetch_array($result);
                    $current= $rowforInsurance['AmtPaidByInsurance'];
                    $current += $amtpaid;
                    $sql = "Update `Payment` SET `AmtPaidByInsurance` = '$current' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id` = '$vid'";
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                    echo "<meta http-equiv='refresh' content='0'>"; 
                }
            }

        }

        //getting log_id from the database
        $input = $_SESSION['p_id'];
        $mysql = "Select `log_id` From `MedicalInfo` Where `PatientID` = '$input' ORDER BY `log_id` DESC";
        $results = mysqli_query($connection, $mysql) or die(mysqli_error($connection));
        $index=0;
        while($thisrow = mysqli_fetch_array($results))
        {
            $output3[$index] = '';
            $total = 0;
            $no = $thisrow['log_id'];
            echo '<center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo'.$no.'">Visit #'.$thisrow['log_id'].'</button></center>
                  <div id="demo'.$no.'" class="collapse">
                  <br>'; //this will output collapse tab to output table of billing information
            $output3[$index] .='<table class="data-table" height="500" width="800">
                    <thead>
                    <tr>
                    <th><center>Item</center></th>
                    <th><center>Cost</center></th>
                    <th><center>Date of Service</center></th>
                    <th><center>Remove</center></th>
                    </tr>
                   </thead>';
            $sqli = "Select * From `ItemizedList` Where `PatientID` = '$_SESSION[p_id]' and `log_id` = '$no'";
            $res = mysqli_query($connection, $sqli) or die(mysqli_error($connection));
            $output3[$index] .='<tbody>';
            while ($newrow = mysqli_fetch_array($res)) //query for database, and fetch data into array
            {
                $output3[$index] .= "<tr><td><center>".$newrow['Item']."</center></td>";
                $output3[$index] .= "<td><center>" . number_format($newrow['Cost'],2) . "</center></td>";
                $output3[$index] .= "<td><center>". $newrow['DateofService']."</center></td>";
                $output3[$index] .= '<form id="search-form" method="post">';
                $output3[$index] .= '<td><center><input type="hidden" name="pk_id" value="'.$newrow['pk'].'"/>
                    <input type="submit" name="submit_remove" value="Remove" /></center></td>		
                    </form></tr>';
                $total = $total + $newrow['Cost'];  
            }
           $newsql = "Select `AmtPaidByInsurance`,`CoPay`,`AmtPaid`,`log_id` From `Payment` Where `PatientID` = '$_SESSION[p_id]' and `log_id` = '$no'";
           $result1 = mysqli_query($connection, $newsql) or die(mysqli_error($connection));
           $row1=mysqli_fetch_array($result1);
           $output3[$index] .= '</tbody><tfoot>
                  <tr>
                  <th colspan="2"><left>Total amount due:</left></th> 
                  <th colspan="2"><left>$'.number_format($total,2).'</left></th>
                  </tr>
                  <tr><th colspan="2"><left>Insurance Paid:</left></th>
                  <th colspan="2"><left>$'.number_format($row1[0],2).'</left></th></tr>
                  <tr><th colspan="2"><left>Copay:</left></th>
                  <th colspan="2"><left>$'.number_format($row1[1],2).'</left></th></tr>
                  <tr><th colspan="2"><left>Amount Paid:</left></th>
                  <th colspan="2"><left>$'.number_format($row1[2],2).'</left></th></tr>
                  <tr><th colspan="2"><left>Balance Due:</left></th>';
            $newbalance = $total-$row1[0]-$row1[1]-$row1[2];
            $newbalance = round($newbalance, 2);
            if($newbalance == '-0')
            {
                $newbalance = 0;
            }
           $output3[$index] .= '
                  <th colspan="2"><left>$'.number_format($newbalance,2).'</left></th>    ';
                   if($newbalance < 0) // display refund button
            {
                $output3[$index] .= '<form id="search-form" method="post">';
                $output3[$index] .= '<td><center><input type="hidden" name="logid" value="'.$row1['log_id'].'"/>
                     <input type="hidden" name="amtdue" value="'.$total.'"/>
                    <input type="submit" name="submit_refund" value="Refund" /></center></td>		
                    </form>';
            }
            $output3[$index] .='
                </tr></tfoot></table>';
                 $sql = "UPDATE `Payment` SET `Balance` = '$newbalance' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id` = '$no'"; 
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            echo $output3[$index];
            
            echo '<br><table class="data-table">';
            echo '<form id="search-form" method="post">';
            echo '<td><center>
                <input type="hidden" name="opt" value="'.$index.'"/>
                <input type="submit" name="submit_print1" value="Print" /></center></td>		
                </form></tr></table>';
            if($_POST["submit_print1"])
            {
                $_SESSION['printOut'] = $output3[$_POST['opt']];
                echo '<meta http-equiv="refresh" content="0; url=printreport.php" />'; 
            }   
            $index++;
         echo '</div><br>';      


            
            
               
        }

        if ($no == null)
        {
            echo '<table class="data-table">
                    <thead><th><center>No billing records!</center></th></thead></table>';
        }
        echo '<br><br>';
        if($_POST['submit_remove'])
        {
            require("db_connect.php");
            $pknum = $_POST["pk_id"];
            $query = "DELETE FROM `ItemizedList` WHERE `pk` = '$pknum'";
            $rest = mysqli_query($connection, $query) or die(mysqli_error($connection));
            echo "<meta http-equiv='refresh' content='0'>"; 
        }
        if($_POST['submit_refund'])
        {
            require("db_connect.php");
            $totalamt = $_POST['amtdue'];
            $log_id = $_POST['logid'];
            $sql = "SELECT * From `Payment` where `PatientID` = '$_SESSION[p_id]' and `log_id` = '$log_id'";
            $rest = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $row = mysqli_fetch_array($rest);
            $refundbalance = 0-$row[Balance];
            $diff = 0-$row[Balance];
            $amtpaid = $row[AmtPaid];
            $cop = $row[CoPay];
            $ppay = $amtpaid + $cop;
            $inpay = $row[AmtPaidByInsurance];
            if($amtpaid > 0)// case to refund amtpaid, when exsit patient amt paid
            {
                if ($amtpaid - $refundbalance >= 0) //refund amtpaid
                {
                    $amtpaid = $amtpaid - $refundbalance;
                    $refundbalance = 0;
                    pAlert("Refund patient paid!\\nAmount: $ ".$diff);
                }
                else //refund copay if no more amtpaid can be refund
                {
                    $amtpaid = 0;
                    $refundbalance -= $amtpaid;
                    if ($cop - $refundbalance >= 0) //refund copay
                    {
                        $cop -= $refundbalance;
                        $refundbalance = 0;
                        pAlert("Refund patient paid from insurance copay!\\nAmount: $ ".$diff);
                    }
                    else //no where to refund, then refund check to insurance company
                    {
                        $refundbalance -= $cop;
                        $cop = 0;
                        $inpay -= $refundbalance;
                        $diff -=$ppay;
                        pAlert("Refund patient paid! Amount: $ ".$ppay."\\nRefund payment to insurance company! Amount: $".$diff);
                    }
                }
            }
            else //case to refund copay
            {
                if($cop - $refundbalance >= 0) //refund copay
                {
                     $cop -= $refundbalance;
                     $refundbalance = 0;
                     pAlert("Refund patient paid from insurance copay!\\nAmount: $ ".$diff);
                }
                else //case to refund all copay, and refund money to insurance company
                {
                        $refundbalance -= $cop;
                        $ppay = $cop;
                        $cop = 0;
                        $inpay -= $refundbalance;
                        pAlert("Refund patient paid from insurance copay!\\nAmount: $ ".$ppay."\\nRefund insurance check back to insurance company:\\nAmount: $".$refundbalance);
                    }
            }
            //update database
                $sql = "UPDATE `Payment` SET `AmtPaid` = '$amtpaid' , `AmtPaidByInsurance` = '$inpay', `CoPay` = '$cop' WHERE `PatientId` = '$_SESSION[p_id]' and `log_id`='$log_id'"; 
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                echo "<meta http-equiv='refresh' content='0'>"; 
        }        
        mysqli_close($connection); 
    }
    
}
?>


    


