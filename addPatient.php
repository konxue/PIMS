<!DOCTYPE HTML>
<link rel="stylesheet" href="css/addPatient.css">
<html>
    <head>
        <title>Add New Patient</title>
    </head>
    <body>
        <h1 class="pageTitle">Add Patient Form</h1>
        <h3 class="sectionDesc">Please enter all available information.</h3>
        <form name ="AddPatientForm" method="POST" action="addPatient.php" class="addPatientText">
            <div class="inlineinput">
                <label for="p_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="p_FirstName" class="inputField" size="20">
                <label for ="p_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="p_MiddleName" class="inputField" size="20">
                <label for ="p_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="p_LastName" class="inputField" size="20">
                <br><br>
                <label for ="p_homePhone" class="fieldName">Home Phone Number:</label>
                (<input type="text" name ="homePhone1" class="phoneField" size="3" maxlength="3">) -
                <input type="text" name ="homePhone2" class="phoneField" size="3" maxlength="3"> -
                <input type="text" name ="homePhone3" class="lastPhoneField" size="4" maxlength="4">
                <label for ="p_cellPhone" class="fieldName">Cell Phone Number:</label>
                (<input type="text" name ="cellPhone1" class="phoneField" size="3" maxlength="3">) -
                <input type="text" name ="cellPhone2" class="phoneField" size="3" maxlength="3"> -
                <input type="text" name ="cellPhone3" class="inputField" size="4" maxlength="4">
                <label for ="p_workPhone" class="fieldName">Work Phone Number:</label>
                (<input type="text" name ="workPhone1" class="inputField" size="3" maxlength="3">) -
                <input type="text" name ="workPhone2" class="inputField" size="3" maxlength="3"> -
                <input type="text" name ="workPhone3" class="lastPhoneField" size="4" maxlength="4">
                <br><br>
                <label for ="p_DOB" class="fieldName">Date of Birth(MMDDYYYY)</label>
                <input type="text" name ="p_DOB" class="inputField" size="10" maxlength="8">
                <label for="p_Sex" class="radioType"> Sex: </label>
                <input type="radio" name ="p_Sex" class="radioBtn" value="male">Male
                <input type="radio" name ="p_Sex" class="RadioBtn" value="female">Female
                <label for="p_VisitorType" class="radioType"> Visitor Status: </label>
                <input type="radio" name ="p_VisitorType" class="radioBtn" value="R">Restricted
                <input type="radio" name ="p_VisitorType" class="RadioBtn" value="U">Unrestricted
                <h3 class="sectionDesc">Address Information.</h3>
                <label for="p_Street" class="fieldName">Street:</label>
                <input type="text" name ="p_Street" class="inputField" size="113">
                <br><br>
                <label for="p_City" class="fieldName">City:</label >
                <input type="text" name ="p_City" class="inputField" size="30">
                <label for="p_State" class="fieldName">State:</label>
                <input type="text" name ="p_State" class="inputField" size="2" maxlength="2">
                <label for="p_Zip" class="fieldName">Zip Code:</label>
                <input type="text" name ="p_Zip" class="inputField" size="12" maxlength="12">
                <label for="p_Country" class="fieldName">Country:</label>
                <input type="text" name ="p_Country" class="inputField" size="30">
                <h3 class="sectionDesc">Family Doctor Information.</h3>
                <label for="FD_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="FD_FirstName" class="inputField" size="30">
                <label for="FD_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="FD_LastName" class="inputField" size="30">
                <h3 class="sectionDesc">Hospital Location Information.</h3>
                <label for="p_Facility" class="fieldName">Facility:</label>
                <input type="text" name ="p_Facility" class="inputField" size="30">
                <label for="p_FloorNum" class="fieldName">Floor Number:</label>
                <input type="text" name ="p_FloorNum" class="inputField" size="3" maxlength="3">
                <label for="p_RoomNum" class="fieldName">Room Number:</label>
                <input type="text" name ="p_RoomNum" class="inputField" size="4"maxlength="4">
                <label for="p_BedNumb" class="fieldName">Bed Number:</label>
                <input type="text" name ="p_BedNum" class="inputField" size="5" maxlength="5">
                <h3 class="sectionDesc">Admission Date and Time</h3>
                <label for="p_AdmissionDate" class="fieldName">Admission Date(MMDDYYYY):</label>
                <input type="text" name ="p_AdmissionDate" class="inputField" size="8" maxlength="8">
                <label for="p_AdmissionTime" class="fieldName">Admission Time(24 Hour Format):</label>
                <input type="text" name ="p_AdmissionTime" class="inputField" size="4" maxlength="4">
                <br><br>
                <label for="p_AdmissionReason" class="textArea">Reason for Admission:</label>
                <textarea name="p_AdmissionReason" rows="4" cols="30">Briefly describe why the patient was admitted...
                </textarea>
                <h3 class="sectionDesc">Insurance Information</h3>
                <label for="p_Carrier" class="fieldName">Insurance Carrier:</label>
                <input type="text" name ="p_Carrier" class="inputField" size="30" maxlength="8">                
                <label for="p_AccountNumber" class="fieldName">Account Number:</label>
                <input type="text" name ="p_AccountNumber" class="inputField" size="15" maxlength="15">      
                <label for="p_GroupNumber" class="fieldName">Group Number:</label>
                <input type="text" name ="p_GroupNumber" class="inputField" size="3" maxlength="3">
                <h3 class="sectionDesc">Emergency Contact 1</h3>
                <label for="EC_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="EC1_FirstName" class="inputField" size="20">
                <label for="EC_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="EC1_MiddleName" class="inputField" size="20">
                <label for="EC_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="EC1_LastName" class="inputField" size="20">
                <br><br>
                <label for ="EC1_homePhone" class="fieldName">Home Phone Number:</label>
                (<input type="text" name ="EC1_homePhone1" class="phoneField" size="3" maxlength="3">) -
                <input type="text" name ="EC1_homePhone2" class="phoneField" size="3" maxlength="3"> -
                <input type="text" name ="EC1_homePhone3" class="lastPhoneField" size="4" maxlength="4">
                <label for ="EC1_cellPhone" class="fieldName">Cell Phone Number:</label>
                (<input type="text" name ="EC1_cellPhone1" class="phoneField" size="3" maxlength="3">) -
                <input type="text" name ="EC1_cellPhone2" class="phoneField" size="3" maxlength="3"> -
                <input type="text" name ="EC1_cellPhone3" class="lastPhoneField" size="4" maxlength="4">
                 <h3 class="sectionDesc">Emergency Contact 2</h3>
                <label for="EC2_FirstName" class="fieldName">First Name:</label>
                <input type="text" name ="EC12_FirstName" class="inputField" size="20">
                <label for="EC2_MiddleName" class="fieldName">Middle Name:</label>
                <input type="text" name ="EC2_MiddleName" class="inputField" size="20">
                <label for="EC2_LastName" class="fieldName">Last Name:</label>
                <input type="text" name ="EC2_LastName" class="inputField" size="20">
                <br><br>
                <label for ="EC2_homePhone" class="fieldName">Home Phone Number:</label>
                (<input type="text" name ="EC2_homePhone1" class="phoneField" size="3" maxlength="3">) -
                <input type="text" name ="EC2_homePhone2" class="phoneField" size="3" maxlength="3"> -
                <input type="text" name ="EC2_homePhone3" class="lastPhoneField" size="4" maxlength="4">
                <label for ="EC_cellPhone" class="fieldName">Cell Phone Number:</label>
                (<input type="text" name ="EC2_cellPhone1" class="phoneField" size="3" maxlength="3">) -
                <input type="text" name ="EC2_cellPhone2" class="phoneField" size="3" maxlength="3"> -
                <input type="text" name ="EC2_cellPhone3" class="lastPhoneField" size="4" maxlength="4">     
                
            </div>
            
        </form>
    </body>
</html>

<?php
// This php file will adding the patient information to the database based on ther user input


    // Create connection
    $connection = mysqli_connect("localhost", "pimsonline","Rootroot123!");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    session_start();
?>
    <!-- initialize a table of form that contains following variable 
    // for reference: <td><label for="user_id">Patient's First Name:</label></td>
    //              <td><input type="text" name="p_firstname" id="'p_firstname"></td> 
    // emegency contact -->
<?php
    $pFirst = $_POST['p_firstname'];
    $pLast = $_POST['p_lastname'];
    $pUserID = $_SESSION['username'] ;
    $pID = $_POST['p_id'];
    $pMiddle = $_POST['p_middlename'];
    $pStreet = $_POST['p_street'];
    $pState = $_POST['p_state'];
    $p_ZIP = $_POST['p_ZIP'];
    //insert adding data to database method here, somthing like....
    //$sql = "INSERT INTO PatientInfo (PatientID, UserID, ....for rest of the columns) VALUES ('$pID', '$pUserID', ....for rest of variables)";
   
    if ($conn->query($sql) === TRUE) {
        header("Refresh: 1; url=mainpage.php");
        echo "New Patient record created successfully!<br/> Redirecting to main page in 1 second.";
    } else {
        header("Refresh: 1; url=mainpage.php");
        echo "Database Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
