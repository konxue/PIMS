<!--
    Purpose: This PHP page handles the logout button
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<title>Logging out... - Patient Information Management System</title>
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<?php
  session_start();
  session_destroy();   // function that Destroys Session 
  header("Refresh: 1; url=index.html");
  echo "Logout Successfully...<br> Redirecting in 1 second!";
?>

