<?php
    session_start();
    if (isset($_SESSION['username'])) {
    
   // $usertype = mysqli_query($connection, $query) or die(mysqli_error($connection));
    echo "Welcome to the main page, : " .$_SESSION['username'];
} else {
    header("Refresh: 2; url=index.html");
    echo 'Please Log in before you access this page!';
}
?> 