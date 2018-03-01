<?php
    $connection = mysql_connect("onlinepimsroot", "rootroot123", ""); // Establishing connection with server..
    $db = mysql_select_db("onlinepims", $connection); // Selecting Database.
    $uname=$_POST['Username']; // Fetching Values from URL.
    $password= ($_POST['PassWord']); // Password Encryption, If you like you can also leave sha1.
    // Matching user input email and password with stored email and password in database.
    $result = mysql_query("SELECT * FROM Users WHERE Username='$email' AND PassWord='$password'");
    $data = mysql_num_rows($result);
    if($data==1)
    {
        echo "Successfully Logged in...";
    }
    else
    {
        echo "Email or Password is wrong...!!!!";
    }
    mysql_close ($connection); // Connection Closed.
?>


