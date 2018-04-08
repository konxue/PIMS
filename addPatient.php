<!DOCTYPE HTML>
<?php
$errors = array();
$errors[0] = 0;
$isProcessed = 0;

session_start();
$fNameError = $mNameError = $lNameError = $homeNumError = $cellNumError = $workNumError = "";

$$doctorError = "";

$dobError = $sexError = $visitorError = $streetError = $EC2PhoneError = $EC2HomeError = "";

$EC2LastError = $EC2MiddleError = $EC2FirstError = $EC1CellError = $EC1HomeError = "";

$EC1LastError = $EC1MiddleError = $EC1FirstError = $countryError = $zipError = $stateError = "";

$cityError ="";

$p_FirstName = $p_MiddleName = $p_LastName = $homePhone1 = $homePhone2 = $homePhone3 ="";

$cellPhone1 = $cellPhone2 = $cellPhone3 = $workPhone1 = $workPhone2 = $workPhone3 = "";
$p_DOB = $p_Sex = $p_VisitorType = $p_Street = $p_City = $p_State = $p_Country = $p_Zip = "";

$p_Country = $EC1_FirstName = $EC1_MiddleName = $EC1_LastName = $EC1_homePhone1 = "";

$EC1_homePhone2 = $EC1_homePhone3 = $EC1_cellPhone1 = $EC1_cellPhone2 = $EC1_cellPhone3 = "";

$EC2_FirstName = $EC2_MiddleName = $EC2_LastName = $EC2_homePhone1 = $EC2_homePhone2 = "";

$EC2_homePhone3 = $EC2_cellPhone1 = $EC2_cellPhone2 = $EC2_cellPhone3 = "";

function testInput($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field;
}
if($_SERVER["REQUEST_METHOD"]== "POST"){
    if(empty($_POST["p_FirstName"])){
        $fNameError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_FirstName = testInput($_POST["p_FirstName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$p_FirstName)) {
            $fNameError = "Only letters allowed"; 
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_MiddleName"])){
        $mNameError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_MiddleName = testInput($_POST["p_MiddleName"]);
    // check if name only contains letters and whitespace
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
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\- ]*$/",$p_LastName)) {
            $lNameError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    }
    if(empty($_POST["p_dName"])){
        $lNameError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $p_doctorName = testInput($_POST["p_dName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9a-zA-Z\- ]*$/",$p_doctorName)) {
            $doctorError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    } 
    
    
    if(empty($_POST["homePhone1"]) || empty($_POST["homePhone2"]) || empty($_POST["homePhone3"])){
        $homeNumError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $homePhone1 = testInput($_POST["homePhone1"]);
        $homePhone2 = testInput($_POST["homePhone2"]);
        $homePhone3 = testInput($_POST["homePhone3"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$homePhone1)) {
            $cellNumError = "Only numbers allowed"; 
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$homePhone2)) {
            $cellNumError = "Only numbers allowed"; 
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$homePhone3)) {
            $cellNumError = "Only numbers allowed";
            $errors[0] = 1;
        }
    }
    if(empty($_POST["cellPhone1"]) || empty($_POST["cellPhone2"]) || empty($_POST["cellPhone3"])){
        $cellNumError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $cellPhone1 = testInput($_POST["cellPhone1"]);
        $cellPhone2 = testInput($_POST["cellPhone2"]);
        $cellPhone3 = testInput($_POST["cellPhone3"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$cellPhone1)) {
            $homeNumError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$cellPhone2)) {
            $homeNumError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$cellPhone3)) {
            $homeNumError = "Only numbers allowed";
            $errors[0] = 1;
        }
    }
    if(empty($_POST["workPhone1"]) || empty($_POST["workPhone2"]) || empty($_POST["workPhone3"])){
        $workNumError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $workPhone1 = testInput($_POST["workPhone1"]);
        $workPhone2 = testInput($_POST["workPhone2"]);
        $workPhone3 = testInput($_POST["workPhone3"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$workPhone1)) {
            $workNumError = "Only numbers allowed"; 
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$workPhone2)) {
            $workNumError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$workPhone3)) {
            $workNumError = "Only numbers allowed";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_DOB"])){
        $dobError = 'Please enter the date of birth.';
        $errors[0] = 1;
    }
    else {
        $p_DOB = testInput($_POST["p_DOB"]);
    // check if name only contains letters and whitespace
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
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9'\- ]*$/",$p_Street)) {
            $streetError = "Unrecognized characters";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_City"])){
        $cityError = 'Please enter a city.';
        $errors[0] = 1;
    }
    else {
        $p_City = testInput($_POST["p_City"]);
    // check if name only contains letters and whitespace
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
    // check if name only contains letters and whitespace
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
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9\-]*$/",$p_Zip)) {
            $zipError = "Unrecognized characters";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["p_Country"])){
        $countryError = 'Please enter a country.';
        $errors[0] = 1;
    }
    else {
        $p_Country = testInput($_POST["p_Country"]);
    // check if name only contains letters and whitespace
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
    
    if(empty($_POST["EC1_MiddleName"])){
        $EC1MiddleError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC1_MiddleName = testInput($_POST["EC1_MiddleName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$EC1_MiddleName)) {
            $EC1MiddleError = "Only letters allowed";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC1_LastName"])){
        $EC1LastError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC1_LastName = testInput($_POST["EC1_LastName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\- ]*$/",$EC1_LastName)) {
            $EC1LastError = "Unrecognized Characters";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC1_homePhone1"]) || empty($_POST["EC1_homePhone2"]) || empty($_POST["EC1_homePhone3"])){
        $EC1HomeError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC1_homePhone1 = testInput($_POST["EC1_homePhone1"]);
        $EC1_homePhone2 = testInput($_POST["EC1_homePhone2"]);
        $EC1_homePhone3 = testInput($_POST["EC1_homePhone3"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$EC1_homePhone1)) {
            $EC1HomeError = "Only numbers allowed"; 
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC1_homePhone2)) {
            $EC1HomeError = "Only numbers allowed"; 
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC1_homePhone3)) {
            $EC1HomeError = "Only numbers allowed";
            $errors[0] = 1;
        }
    }
    
    if(empty($_POST["EC1_cellPhone1"]) || empty($_POST["EC1_cellPhone2"]) || empty($_POST["EC1_cellPhone3"])){
        $EC1CellError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC1_cellPhone1 = testInput($_POST["EC1_cellPhone1"]);
        $EC1_cellPhone2 = testInput($_POST["EC1_cellPhone2"]);
        $EC1_cellPhone3 = testInput($_POST["EC1_cellPhone3"]);
    // check if name only contains letters and whitespace
        $isProcessed = 1;
        if (!preg_match("/^[0-9]*$/",$EC1_cellPhone1)) {
            $EC1CellError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC1_cellPhone2)) {
            $EC1CellError = "Only numbers allowed"; 
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC1_cellPhone3)) {
            $EC1CellError = "Only numbers allowed";
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
    
    if(empty($_POST["EC2_MiddleName"])){
        $EC2MiddleError = 'Please enter a name.';
        $errors[0] = 1;
    }
    else {
        $EC2_MiddleName = testInput($_POST["EC2_MiddleName"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$EC2_MiddleName)) {
            $EC2MiddleError = "Only letters allowed";
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

    if(empty($_POST["EC2_homePhone1"]) || empty($_POST["EC2_homePhone2"]) || empty($_POST["EC2_homePhone3"])){
        $EC2HomeError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC2_homePhone1 = testInput($_POST["EC2_homePhone1"]);
        $EC2_homePhone2 = testInput($_POST["EC2_homePhone2"]);
        $EC2_homePhone3 = testInput($_POST["EC2_homePhone3"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$EC2_homePhone1)) {
            $EC2HomeError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC2_homePhone2)) {
            $EC2HomeError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC2_homePhone3)) {
            $EC2HomeError = "Only numbers allowed";
            $errors[0] = 1;
        }
    }

    if(empty($_POST["EC2_cellPhone1"]) || empty($_POST["EC2_cellPhone2"]) || empty($_POST["EC2_cellPhone3"])){
        $EC2CellError = 'Please enter a number.';
        $errors[0] = 1;
    }
    else {
        $EC2_cellPhone1 = testInput($_POST["EC2_cellPhone1"]);
        $EC2_cellPhone2 = testInput($_POST["EC2_cellPhone2"]);
        $EC2_cellPhone3 = testInput($_POST["EC2_cellPhone3"]);
    // check if name only contains letters and whitespace
        
        if (!preg_match("/^[0-9]*$/",$EC2_cellPhone1)) {
            $EC2CellError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC2_cellPhone2)) {
            $EC2CellError = "Only numbers allowed";
            $errors[0] = 1;
        }
        if (!preg_match("/^[0-9]*$/",$EC2_cellPhone3)) {
            $EC2CellError = "Only numbers allowed";
            $errors[0] = 1;;
        }
    }    
}
?>
<html>
    <head>
        <title>Add New Patient</title>
        <link rel="stylesheet" href="css/addPatient.css">
        <style type ="text/css">
            .error{color:red;}
            .success{color:green;}
        </style>
    </head>
    <body>
        <h1 class="pageTitle">Add Patient Form</h1>
        <h3 class="sectionDesc">Please enter all available information.</h3>
        <form name ="AddPatientForm" method="POST" action="addPatient.php" class="addPatientText">
            <div class="inlineinput">
                <label for="p_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="p_FirstName" class="inputField" size="20" value="<?php echo $p_FirstName; ?>">
                <span class="error"><?php echo $fNameError; ?></span>
                <label for ="p_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="p_MiddleName" class="inputField" size="20" value="<?php echo $p_MiddleName; ?>">
                <span class="error"><?php echo $mNameError; ?></span>
                <label for ="p_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="p_LastName" class="inputField" size="20" value="<?php echo $p_LastName; ?>">
                <span class="error"><?php echo $lNameError; ?></span>
                <br><br>
                <label for ="p_homePhone" class="fieldName">Home Phone Number:</label>
                (<input type="text" name ="homePhone1" class="phoneField" size="3" maxlength="3" value="<?php echo $homePhone1; ?>">) -
                <input type="text" name ="homePhone2" class="phoneField" size="3" maxlength="3" value="<?php echo $homePhone2; ?>"> -
                <input type="text" name ="homePhone3" class="lastPhoneField" size="4" maxlength="4" value="<?php echo $homePhone3; ?>">
                <span class="error"><?php echo $homeNumError; ?></span>
                <label for ="p_cellPhone" class="fieldName">Cell Phone Number:</label>
                (<input type="text" name ="cellPhone1" class="phoneField" size="3" maxlength="3" value="<?php echo $cellPhone1; ?>">) -
                <input type="text" name ="cellPhone2" class="phoneField" size="3" maxlength="3" value="<?php echo $cellPhone2; ?>"> -
                <input type="text" name ="cellPhone3" class="inputField" size="4" maxlength="4" value="<?php echo $cellPhone3; ?>">
                <span class="error"><?php echo $cellNumError; ?></span>
                <label for ="p_workPhone" class="fieldName">Work Phone Number:</label>
                (<input type="text" name ="workPhone1" class="inputField" size="3" maxlength="3" value="<?php echo $workPhone1; ?>">) -
                <input type="text" name ="workPhone2" class="inputField" size="3" maxlength="3" value="<?php echo $workPhone2; ?>"> -
                <input type="text" name ="workPhone3" class="lastPhoneField" size="4" maxlength="4" value="<?php echo $workPhone3; ?>">
                <span class="error"><?php echo $workNumError; ?></span>
                <br><br>
                <label for ="p_DOB" class="fieldName">Date of Birth(MM/DD/YYYY)</label>
                <input type="text" name ="p_DOB" class="inputField" size="12" maxlength="10" value="<?php echo $p_DOB; ?>">
                <span class="error"><?php echo $dobError; ?></span>
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
                <br><br>
                <label for="p_FirstName" class="fieldName">Family Doctor: (username):</label>
                <input type="text" name ="p_dName" class="inputField" size="10" value="<?php echo $p_doctorName; ?>">
                <span class="error"><?php echo $doctorError; ?></span>
                
                <h3 class="sectionDesc">Address Information.</h3>
                <label for="p_Street" class="fieldName">Street:</label>
                <input type="text" name ="p_Street" class="inputField" size="113" value="<?php echo $p_Street; ?>">
                <span class="error"><?php echo $streetError; ?></span>
                <br><br>
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
                <label for="EC_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="EC1_MiddleName" class="inputField" size="20" value="<?php echo $EC1_MiddleName; ?>">
                <span class="error"><?php echo $EC1MiddleError; ?></span>
                <label for="EC_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="EC1_LastName" class="inputField" size="20" value="<?php echo $EC1_LastName; ?>">
                <span class="error"><?php echo $EC1LastError; ?></span>
                <br><br>
                <label for ="EC1_homePhone" class="fieldName">Home Phone Number:</label>
                (<input type="text" name ="EC1_homePhone1" class="phoneField" size="3" maxlength="3" value="<?php echo $EC1_homePhone1; ?>">) -
                <input type="text" name ="EC1_homePhone2" class="phoneField" size="3" maxlength="3" value="<?php echo $EC1_homePhone2; ?>"> -
                <input type="text" name ="EC1_homePhone3" class="lastPhoneField" size="4" maxlength="4" value="<?php echo $EC1_homePhone3; ?>">
                <span class="error"><?php echo $EC1HomeError; ?></span>
                <label for ="EC1_cellPhone" class="fieldName">Cell Phone Number:</label>
                (<input type="text" name ="EC1_cellPhone1" class="phoneField" size="3" maxlength="3" value="<?php echo $EC1_cellPhone1; ?>">) -
                <input type="text" name ="EC1_cellPhone2" class="phoneField" size="3" maxlength="3" value="<?php echo $EC1_cellPhone2; ?>"> -
                <input type="text" name ="EC1_cellPhone3" class="lastPhoneField" size="4" maxlength="4" value="<?php echo $EC1_cellPhone3; ?>">
                <span class="error"><?php echo $EC1CellError; ?></span>
                 <h3 class="sectionDesc">Emergency Contact 2</h3>
                <label for="EC2_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="EC2_FirstName" class="inputField" size="20" value="<?php echo $EC2_FirstName; ?>">
                <span class="error"><?php echo $EC2FirstError; ?></span>
                <label for="EC2_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="EC2_MiddleName" class="inputField" size="20" value="<?php echo $EC2_MiddleName; ?>">
                <span class="error"><?php echo $EC2MiddleError; ?></span>
                <label for="EC2_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="EC2_LastName" class="inputField" size="20" value="<?php echo $EC2_LastName; ?>">
                <span class="error"><?php echo $EC2LastError; ?></span>
                <br><br>
                <label for ="EC2_homePhone" class="fieldName">Home Phone Number:</label>
                (<input type="text" name ="EC2_homePhone1" class="phoneField" size="3" maxlength="3" value="<?php echo $EC2_homePhone1; ?>">) -
                <input type="text" name ="EC2_homePhone2" class="phoneField" size="3" maxlength="3" value="<?php echo $EC2_homePhone2; ?>"> -
                <input type="text" name ="EC2_homePhone3" class="lastPhoneField" size="4" maxlength="4" value="<?php echo $EC2_homePhone3; ?>">
                <span class="error"><?php echo $EC2HomeError; ?></span>
                <label for ="EC_cellPhone" class="fieldName">Cell Phone Number:</label>
                (<input type="text" name ="EC2_cellPhone1" class="phoneField" size="3" maxlength="3" value="<?php echo $EC2_cellPhone1; ?>">) -
                <input type="text" name ="EC2_cellPhone2" class="phoneField" size="3" maxlength="3" value="<?php echo $EC2_cellPhone2; ?>"> -
                <input type="text" name ="EC2_cellPhone3" class="lastPhoneField" size="4" maxlength="4" value="<?php echo $EC2_cellPhone3; ?>">
                <span class="error"><?php echo $EC2CellError; ?></span>
            </div>
            <br>
            <input type ="submit" class="submitbutton" vale="Send">
        </form>
    </body>
</html>

<?php
// This php file will adding the patient information to the database based on ther user input
    // Create connection
    $addConn = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    if (!$addConn){
        die("Database Connection Failed" . mysqli_error($addConn));
    }
    $select_db = mysqli_select_db($addConn, 'onlinepims');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($addConn));
    }

    
    if (($errors[0] == 0) && ($isProcessed ==1)) {
        $HomePhoneNumber = "(" . $homePhone1 . ") " . $homePhone2 .  "-" . $homePhone3;
        $CellPhoneNumber = "(" . $cellPhone1 . ") " . $cellPhone2 .  "-" . $cellPhone3;
        $WorkPhoneNumber = "(" . $workPhone1 . ") " . $workPhone2 .  "-" . $workPhone3;
        $EC1HomePhone = "(" . $EC1_homePhone1 . ") " . $EC1_homePhone2 . "-" . $EC1_homePhone3;
        $EC2HomePhone = "(" . $EC2_homePhone1 . ") " . $EC2_homePhone2 . "-" . $EC2_homePhone3;
        $EC1CellPhone = "(" . $EC1_cellPhone1 . ") " . $EC1_cellPhone2 . "-" . $EC1_cellPhone3;
        $EC2CellPhone = "(" . $EC2_cellPhone1 . ") " . $EC2_cellPhone2 . "-" . $EC2_cellPhone3;
        
        $sqlQuery = "INSERT INTO PatientInfo (UserID, City, DOB, E1_FirstName, E1_HomeNum, E1_LastName, E1_MobileNum, E2_FirstName, E2_HomeNum, E2_LastName, E2_MobileNum, FirstName, HomePhone, LastName, MiddleName, MobilePhone, SEX, State, Street, VisitorType, WorkPhone, Zip)
                    VALUES ('$p_doctorName','$p_City', '$p_DOB', '$EC1_FirstName', '$EC1HomePhone', '$EC1_LastName', '$EC1CellPhone', '$EC2_FirstName', '$EC2HomePhone', '$EC2_LastName', '$EC2CellPhone', '$p_FirstName', '$HomePhoneNumber', '$p_LastName', '$p_MiddleName', '$CellPhoneNumber', '$p_Sex', '$p_State', '$p_Street', '$p_VisitorType', '$WorkPhoneNumber', '$p_Zip')";
        
        
        
        
        if( mysqli_query($addConn, $sqlQuery)){
            echo "Information added successfully, page closing in 2 seconds";
            echo '<script> window.setTimeout("window.close()",2000);</script>';
        } 
        else{
            echo "ERROR: Could not execute $sqlQuery. " . mysqli_error($addConn);
        }

        mysqli_close($addConn);
        
        
    }
       
?>        
       


    
    
    







