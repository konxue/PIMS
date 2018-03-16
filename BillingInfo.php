<!--This PHP code is for the billing tab on the main page, it includes the HTML and CSS-->
<style>
   .inlinetable
   {
       display: inline-block;
      /* font-family: arial, sans-serif;
       border-collapse: collapse;
       width: 100%;*/
   }
   //when I add this extra css code it does not do the inline-block
   /*td, th {
       display: inline-block;
       border: 1px solid #dddddd;
       text-align: left;
       padding: 8px;
   }*/

   /*tr:nth-child(even) {
       background-color: #dddddd;
   } */ 
</style>

<!--HTML Code for my tab-->
<table border=1 class="inlineTable">
   <tr>
       <td>Items</td>
       <td>Cost</td>        
   </tr>
</table>

<table border=1 class="inlineTable">
   <tr>
       <th>Total Amount:</th>
   </tr>
   <tr>
       <th>Amount paid by Insurance:</th>
   </tr>
   <tr>
       <th>Amount due after Insurance:</th>
   </tr>
   <tr>
       <th>Amount Paid:</th>
   </tr>
   <tr>
       <th>Amount Due:</th>
   </tr>
</table>


 <?php
    $servername = "localhost";
    $username = "pimsonline";
    $password = "Rootroot123";
    $dbname = "onlinepims";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    session_start();
    $pFirst = $_POST['p_firstname'];
    $pLast = $_POST['p_lastname'];
    $pUserID = $_SESSION['username'] ;
    $pID = $_POST['p_id'];
    
    $pMiddle = $_POST['p_middlename'];
    $pStreet = $_POST['p_street'];
    $pState = $_POST['p_state'];
    $p_ZIP = $_POST['p_ZIP'];
    
    $p_Item = $_POST['Item'];
    $p_Cost = $_POST['Cost'];
    $p_TotalCost = $_POST['TotalCost'];
    $p_AmtDue = $_POST['AmtDue'];
    
    $p_Carrier= $_POST['Carrier'];
    $p_AmtPaidByInsurance = $_POST['AmtPaidByInsurance'];
    $p_AmtPaidByPatient = $_POST['AmtPaidByPatient'];
    
    
?>

