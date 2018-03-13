<?php
// This php file will adding the patient information to the database based on ther user input

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
    //initialize a table of form that contains following variable 
    // for reference: <td><label for="user_id">Patient's First Name:</label></td>
    //              <td><input type="text" name="p_firstname" id="'p_firstname"></td>
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
