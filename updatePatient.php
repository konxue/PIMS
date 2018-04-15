<!--
    Purpose: This PHP page will update a Patient to the PatientInfo table
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<!DOCTYPE HTML>
<?php //Initializing variables
$errors = array(); //Creating array, if error[0] = 1 then errors where present in the form
$errors[0] = 0; //Initializing errors[0] = 0, representing no errors are present
$isProcessed = 0; //This variable used to flag whether or not information has been entered into
//the html form for add patient. Fixes the issue of submitting blank information into database
//when the page is loaded
require("db_connect.php"); //database connector
session_start();


//initializing error messages and php variables that will later hold values
//to be added to the database
$fNameError = $mNameError = $lNameError = $homeNumError = $cellNumError = $workNumError = "";

$doctorError = $fdError = "";

$dobError = $sexError = $visitorError = $streetError = $EC2PhoneError = $EC2HomeError = "";

$EC2LastError = $EC2FirstError = $EC1CellError = $EC1HomeError = "";

$EC1LastError = $EC1FirstError = $countryError = $zipError = $stateError = "";

$cityError ="";
//passing database value to the input field
$input = $_SESSION['p_id'];
$sql = "Select * from `PatientInfo` where `PatientID` = '$input'";
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
$row = mysqli_fetch_array($result);
$p_FirstName = $row['FirstName'];
$p_MiddleName = $row['MiddleName'];
$p_LastName = $row['LastName'];
$homePhone = $row ['HomePhone'];
$cellPhone = $row ['MobilePhone'];
$workPhone = $row ['WorkPhone'];
$p_DOB = $row['DOB'];
$p_Sex = $row['SEX'];
$p_VisitorType = $row['VisitorType'];
$p_Street = $row['Street'];
$p_City = $row['City'];
$p_State = $row['State'];
$p_Country = $row['Country'];
$p_Zip = $row['Zip'];
$p_fdName = $row['FamilyDoctor'];
$p_doctorName = $row['UserID'];
$EC1_FirstName = $row['E1_FirstName'];
$EC1_LastName = $row['E1_LastName'];
$EC1_homePhone = $row['E1_HomeNum'];
$EC1_cellPhone = $row['E1_MobileNum'];
$EC2_FirstName = $row['E2_FirstName'];
$EC2_LastName = $row['E2_LastName'];
$EC2_homePhone = $row['E2_HomeNum'];
$EC2_cellPhone = $row['E2_MobileNum'];


//all values read in from the forms are passed into this function
function testInput($field) {
    $field = trim($field); // removes whitespace from string
    $field = stripslashes($field); //unquotes a quoted string
    $field = htmlspecialchars($field);//converts any special characters to HTML characters
    return $field; //return the variable after it has been altered by the above functions
}
//If the form is of the type "POST", then read in the values submitted into the form
//and error check them
if($_SERVER["REQUEST_METHOD"]== "POST"){
    //All values read in from the form are evaluated in this manner
    //First check to see if the value is empty, meaning the user did not input
    //a value into the form
    if(empty($_POST["p_FirstName"])){ //POST retrieves information from an HTML field, with the string passed in to the POST function being the name of the field
        $fNameError = 'Please enter a name.'; //If empty, then save an error msg
        $errors[0] = 1; //Flag that an error is present
    }
    else {
        $p_FirstName = testInput($_POST["p_FirstName"]); //Else send the value to testInput function
    // Using regex to check only for allowed characters (only letters in this case)
        if (!preg_match("/^[a-zA-Z ]*$/",$p_FirstName)) {
            $fNameError = "Only letters allowed"; 
            $errors[0] = 1; //Flag that an error is present
        }
    }
    //All of the following checks function similarly to the first
    if(empty($_POST["p_MiddleName"])){
        $mNameError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_MiddleName = testInput($_POST["p_MiddleName"]);
    // Using regex to check only for allowed characters (only letters in this case)
        if (!preg_match("/^[a-zA-Z ]*$/",$p_MiddleName)) {
            $mNameError = "Only letters allowed"; 
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_LastName"])){
        $lNameError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_LastName = testInput($_POST["p_LastName"]);
    // Using regex to check only for allowed characters (only letters and dashes in this case)
        if (!preg_match("/^[a-zA-Z\- ]*$/",$p_LastName)) {
            $lNameError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    }
    if(empty($_POST["p_dName"])){
        $doctorError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_doctorName = testInput($_POST["p_dName"]);
    // Using regex to check only for allowed characters (letters,numbers, and dash)
        if (!preg_match("/^[0-9a-zA-Z\- ]*$/",$p_doctorName)) {
            $doctorError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    } 
    
    if(empty($_POST["p_familydName"])){
        $fdError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_fdName = testInput($_POST["p_familydName"]);
    // Using regex to check only for allowed characters (letters, numbers, and dashes)
        if (!preg_match("/^[0-9a-zA-Z\- ]*$/",$p_fdName)) {
            $doctorError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    } 
    
    
    
    if(empty($_POST["homePhone"])){
        $homeNumError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $homePhone = testInput($_POST["homePhone"]);
    // Using regex to check only for allowed characters (only numbers in this case)
    //Checking inputs for all the input fields related to the homephone number
        if (!preg_match("/^[0-9\-\(\) ]*$/",$homePhone)) {
            $homeNumError = "Invalid input"; 
            $errors[0] = 1;
        }
    }
    if(empty($_POST["cellPhone"])){
        $cellNumError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $cellPhone = testInput($_POST["cellPhone"]);
    // Using regex to check only for allowed characters (only numbers in this case)
    //Checking inputs for all the input fields related to the cellphone number
        if (!preg_match("/^[0-9\-\(\) ]*$/",$cellPhone)) {
            $cellNumError = "Invalid input";
            $errors[0] = 1;
        }
    }
    if(empty($_POST["workPhone"])){
        $workNumError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $workPhone = testInput($_POST["workPhone"]);
    // Using regex to check only for allowed characters (only numbers in this case)
    //Checking inputs for all the input fields related to the workphone number
        if (!preg_match("/^[0-9\-\(\) ]*$/",$workPhone)) {
            $workNumError = "Invalid input"; 
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_DOB"])){
        $dobError = 'Please enter the date of birth.';
        $errors[0] = 1;
    }
    else {
        $p_DOB = testInput($_POST["p_DOB"]);
    }
    
    if (empty($_POST["p_Sex"])) {
        $sexError = "Please select an option";
        $errors[0] = 1;
    } 
    else {
        $p_Sex = testInput($_POST["p_Sex"]);
        
    }
    
    if (empty($_POST["p_VisitorType"])) {
        $visitorError = "Please select an option";
        $errors[0] = 1;
    } 
    else {
        $p_VisitorType = testInput($_POST["p_VisitorType"]);
    }
    
    if(empty($_POST["p_Street"])){
        $streetError = 'Please enter a street name.';
        $errors[0] = 1;
    }
    else {
        $p_Street = testInput($_POST["p_Street"]);
    }
    
    if(empty($_POST["p_City"])){
        $cityError = 'Please enter a city.';
        $errors[0] = 1;
    }
    else {
        $p_City = testInput($_POST["p_City"]);
    // check if name only contains letters and '
        if (!preg_match("/^[a-zA-Z' ]*$/",$p_City)) {
            $cityError = "Unrecognized characters";
            $errors[0] = 1;;
        }
    }
    
    if(empty($_POST["p_State"])){
        $stateError = 'Please enter a state.';
       $errors[0] = 1;
    }
    else {
        $p_State = testInput($_POST["p_State"]);
    // check if name only contains letters 
        if (!preg_match("/^[a-zA-Z ]*$/",$p_State)) {
            $stateError = "Only letters allowed"; 
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_Zip"])){
        $zipError = 'Please enter the zip code.';
        $errors[0] = 1;
    }
    else {
        $p_Zip = testInput($_POST["p_Zip"]);
    }
    
    if(empty($_POST["p_Country"])){
        $countryError = 'Please enter a country.';
        $errors[0] = 1;
    }
    else {
        $p_Country = testInput($_POST["p_Country"]);
    // check if name only contains letters and '
        if (!preg_match("/^[a-zA-Z' ]*$/",$p_City)) {
            $countryError = "Unrecognized characters";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC1_FirstName"])){
        $EC1FirstError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC1_FirstName = testInput($_POST["EC1_FirstName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$EC1_FirstName)) {
            $EC1FirstError = "Only letters allowed";
            $errors[0] = 1;
        }
    }
    
    
    if(empty($_POST["EC1_LastName"])){
        $EC1LastError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC1_LastName = testInput($_POST["EC1_LastName"]);
    // check if name only contains letters and dashes
        if (!preg_match("/^[a-zA-Z\- ]*$/",$EC1_LastName)) {
            $EC1LastError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC1_homePhone"])){
        $EC1HomeError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC1_homePhone = testInput($_POST["EC1_homePhone"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9\-\(\) ]*$/",$EC1_homePhone)) {
            $EC1HomeError = "Invalid input"; 
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC1_cellPhone"])){
        $EC1CellError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC1_cellPhone = testInput($_POST["EC1_cellPhone"]);
    // check if name only contains letters and whitespace
        $isProcessed = 1;
        if (!preg_match("/^[0-9\-\(\) ]*$/",$EC1_cellPhone)) {
            $EC1CellError = "Invalid input";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC2_FirstName"])){
        $EC2FirstError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC2_FirstName = testInput($_POST["EC2_FirstName"]);
        
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$EC2_FirstName)) {
            $EC2FirstError = "Only letters allowed";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC2_LastName"])){
        $EC2LastError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC2_LastName = testInput($_POST["EC2_LastName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\- ]*$/",$EC2_LastName)) {
            $EC2LastError = "Unrecognized Characters"; 
            $errors[0] = 1;
        }
    }

    if(empty($_POST["EC2_homePhone"])){
        $EC2HomeError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC2_homePhone = testInput($_POST["EC2_homePhone"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9\-\(\) ]*$/",$EC2_homePhone)) {
            $EC2HomeError = "Invalid input";
            $errors[0] = 1;
        }
    }

    if(empty($_POST["EC2_cellPhone"])){
        $EC2CellError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC2_cellPhone = testInput($_POST["EC2_cellPhone"]);
    // check if name only contains letters and whitespace
        
        if (!preg_match("/^[0-9\-\(\) ]*$/",$EC2_cellPhone)) {
            $EC2CellError = "Invalid input";
            $errors[0] = 1;
        }
    }    
}
?>
<!---HTML for the add new patient form -->
<html>
    <head>
        <title>Edit Patient Information - Patient Information Management System</title>
        <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
        <link rel="stylesheet" href="css/addPatient.css">
        <style type ="text/css">
            .error{color:red;} 
            .success{color:green;}
        </style>
        <?php
            include 'checkStatus.php';
    if($_SESSION['usertype'] == 'Doctor' || $_SESSION['usertype'] == 'Nurse')
    {
    header("Refresh: 0; url=medicalInfo.php");
    }
        ?>
    </head>
    <footer>
    <div class="footer"><center>Patient Information Management System V 1.0  © All rights reserved 2018</center></div>
    </footer>
    <body>
        <br>
        <center><h1 class="pageTitle">Edit Patient Form</h1></center>
        <a href="mainpage.php" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon glyphicon-arrow-left"></span> Main Page
        </a>
        <h3 class="sectionDesc">Please enter all available information.</h3>
        <!---Beginning the form for adding a patient -->
        <!---Information from the form is submitted back to this page -->
        <form name ="AddPatientForm" method="POST" action="updatePatient.php" class="addPatientText">
            <div class="inlineinput">
                <label for="p_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="p_FirstName" class="inputField" size="20" value="<?php echo $p_FirstName; ?>">
                <span class="error"><?php echo $fNameError; ?></span><!---Output error msg corresponding the field (error msg is blank if no error present) -->
                <label for ="p_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="p_MiddleName" class="inputField" size="20" value="<?php echo $p_MiddleName; ?>">
                <span class="error"><?php echo $mNameError; ?></span>
                <label for ="p_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="p_LastName" class="inputField" size="20" value="<?php echo $p_LastName; ?>">
                <span class="error"><?php echo $lNameError; ?></span>
                <br>
                <label for ="p_homePhone" class="fieldName">Home Phone Number:</label>
                <input type="text" name ="homePhone" class="phoneField" size="14" maxlength="14" value="<?php echo $homePhone; ?>">
                <span class="error"><?php echo $homeNumError; ?></span>
      
                <label for ="p_cellPhone" class="fieldName">Cell Phone Number:</label>
                <input type="text" name ="cellPhone" class="phoneField" size="14" maxlength="14" value="<?php echo $cellPhone; ?>"> 
                <span class="error"><?php echo $cellNumError; ?></span>
                
                <label for ="p_workPhone" class="fieldName">Work Phone Number:</label>
                <input type="text" name ="workPhone" class="inputField" size="14" maxlength="14" value="<?php echo $workPhone; ?>">
                <span class="error"><?php echo $workNumError; ?></span>
                
                <br>
                <label for ="p_DOB" class="fieldName">Date of Birth(MM/DD/YYYY)</label>
                <input type="text" name ="p_DOB" class="inputField" size="12" maxlength="10" value="<?php echo $p_DOB; ?>">
                <span class="error"><?php echo $dobError; ?></span><br>
                <label for ="p_Sex" class="fieldName">Gender:</label>
                <label for="p_Sex" class="radioType"> Male:
                <input type="radio" name ="p_Sex" <?php if (isset($p_Sex) && $p_Sex=="M") echo "checked";?>
                       value="M">
                <span class="RadioBtn"></span>
                </label>
                <label for="p_Sex" class="radioType"> Female:
                <input type="radio" name ="p_Sex" <?php if (isset($p_Sex) && $p_Sex=="F") echo "checked";?>
                       value="F">
                <span class="RadioBtn"></span>
                </label>
                <span class="error"><?php echo $sexError; ?></span>
                
                <label for ="p_VisitorType" class="fieldName">Visitor Status:</label>
                <label for="p_VisitorType" class="radioType"> Restricted
                <input type="radio" name ="p_VisitorType" checked="checked" <?php if (isset($p_VisitorType) && $p_VisitorType=="Y") echo "checked";?>
                       value="Y">
                <span class="RadioBtn"></span>
                </label>
                <label for="p_VisitorType" class="radioType"> Unrestricted
                <input type="radio" name ="p_VisitorType" checked="checked" <?php if (isset($p_VisitorType) && $p_VisitorType=="N") echo "checked";?>
                       value="N">
                <span class="RadioBtn"></span>
                </label>
                <span class="error"><?php echo $visitorError; ?></span>
                <label for="p_FirstName" class="fieldName">Family Doctor (Full name): </label>
                <input type="text" name ="p_familydName" class="inputField" size="20" value="<?php echo $p_fdName; ?>">
                <span class="error"><?php echo $fdError; ?></span>
                <label for="p_FirstName" class="fieldName">Assign Doctor (username):</label>
                <input type="text" name ="p_dName" class="inputField" size="10" value="<?php echo $p_doctorName; ?>">
                <span class="error"><?php echo $doctorError; ?></span>
                <h3 class="sectionDesc">Address Information.</h3>
                <label for="p_Street" class="fieldName">Street:</label>
                <input type="text" name ="p_Street" class="inputField" size="113" value="<?php echo $p_Street; ?>">
                <span class="error"><?php echo $streetError; ?></span>
                <br>
                <label for="p_City" class="fieldName">City:</label >
                <input type="text" name ="p_City" class="inputField" size="30" value="<?php echo $p_City; ?>">
                <span class="error"><?php echo $cityError; ?></span>
                <label for="p_State" class="fieldName">State:</label>
                <input type="text" name ="p_State" class="inputField" size="2" maxlength="2" value="<?php echo $p_State; ?>">
                <span class="error"><?php echo $stateError; ?></span>
                <label for="p_Zip" class="fieldName">Zip Code:</label>
                <input type="text" name ="p_Zip" class="inputField" size="12" maxlength="12" value="<?php echo $p_Zip; ?>">
                <span class="error"><?php echo $zipError; ?></span>
                <label for="p_Country" class="fieldName">Country:</label>
                <input type="text" name ="p_Country" class="inputField" size="30" value="<?php echo $p_Country; ?>">
                <span class="error"><?php echo $countryError; ?></span>
                <h3 class="sectionDesc">Emergency Contact 1</h3>
                <label for="EC_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="EC1_FirstName" class="inputField" size="20" value="<?php echo $EC1_FirstName; ?>">
                <span class="error"><?php echo $EC1FirstError; ?></span>
                <label for="EC_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="EC1_LastName" class="inputField" size="20" value="<?php echo $EC1_LastName; ?>">
                <span class="error"><?php echo $EC1LastError; ?></span>
                <br>
                <label for ="EC1_homePhone" class="fieldName">Home Phone Number:</label>
                <input type="text" name ="EC1_homePhone" class="phoneField" size="14" maxlength="14" value="<?php echo $EC1_homePhone; ?>">
                <span class="error"><?php echo $EC1HomeError; ?></span>
                <label for ="EC1_cellPhone" class="fieldName">Cell Phone Number:</label>
                <input type="text" name ="EC1_cellPhone" class="phoneField" size="14" maxlength="14" value="<?php echo $EC1_cellPhone; ?>">
                <span class="error"><?php echo $EC1CellError; ?></span>
                 <h3 class="sectionDesc">Emergency Contact 2</h3>
                <label for="EC2_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="EC2_FirstName" class="inputField" size="20" value="<?php echo $EC2_FirstName; ?>">
                <span class="error"><?php echo $EC2FirstError; ?></span>
                <label for="EC2_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="EC2_LastName" class="inputField" size="20" value="<?php echo $EC2_LastName; ?>">
                <span class="error"><?php echo $EC2LastError; ?></span>
                <br>
                <label for ="EC2_homePhone" class="fieldName">Home Phone Number:</label>
                <input type="text" name ="EC2_homePhone" class="phoneField" size="14" maxlength="14" value="<?php echo $EC2_homePhone; ?>">
                <span class="error"><?php echo $EC2HomeError; ?></span>
                <label for ="EC_cellPhone" class="fieldName">Cell Phone Number:</label>
                <input type="text" name ="EC2_cellPhone" class="phoneField" size="14" maxlength="14" value="<?php echo $EC2_cellPhone; ?>">
                <span class="error"><?php echo $EC2CellError; ?></span>
            </div>
            <br>
            <center><input type ="submit" class="submitbutton" vale="Send"></center>
        </form>
    </body>
</html>
<br><br>
<?php
// This php file will add the patient information to the database based on the user input
    // Create connection
    $addConn = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    if (!$addConn){
        die("Database Connection Failed" . mysqli_error($addConn));
    }
    $select_db = mysqli_select_db($addConn, 'onlinepims');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($addConn));
    }

    //First make sure there are no errors and that information has actually been provided
    //This prevents erroneous and blank informtion being added to the database
    if (($errors[0] == 0) && ($isProcessed ==1)) {
        //Concatenate all of the number fields into their respective variable to be added to the database
        //Update the information from the form to the database
        $sqlQuery = "UPDATE `PatientInfo` SET `FirstName` = '$p_FirstName', `MiddleName` = '$p_MiddleName', `LastName` = '$p_LastName', `HomePhone` = '$homePhone', `MobilePhone` = '$cellPhone', `WorkPhone` = '$workPhone', `DOB` = '$p_DOB', `SEX` = '$p_Sex', `VisitorType` = '$p_VisitorType', `Street` = '$p_Street', `City` = '$p_City', `State` = '$p_State', `Country` = '$p_Country', `Zip` = '$p_Zip', `Familydoctor` = '$p_fdName', `UserID` = '$p_doctorName', `E1_FirstName` = '$EC1_FirstName', `E1_MobileNum` = '$EC1_MiddleName', `E1_LastName` = '$EC1_LastName',`E1_HomeNum` = '$EC1_homePhone',`E1_MobileNum` = '$EC1_cellPhone',`E2_FirstName` = '$EC2_FirstName',`E2_MobileNum` = '$EC2_MiddleName',`E2_LastName` = '$EC2_LastName',`E2_HomeNum` = '$EC2_homePhone',`E2_MobileNum` = '$EC2_cellPhone' where `PatientID` = '$input'";

     //add patient query   
        if( mysqli_query($addConn, $sqlQuery)){
            echo '<script type="text/javascript">alert("Information updated successfully!")</script>';
            echo '<script> window.setTimeout("window.close()",1000);</script>';
        } 
        else{
            echo "ERROR: Could not execute $sqlQuery. " . mysqli_error($addConn);
        }

        mysqli_close($addConn);
        
        
    }
       
?>        
       


    
    
    







