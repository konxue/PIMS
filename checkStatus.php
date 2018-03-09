<?php
    session_start();
    if (isset($_SESSION['username'])) {
    //.$_SESSION['usertype']."
    echo "Welcome!<br/>\n".$_SESSION['usertype'].": ".$_SESSION['username'];
} else {
    header("Refresh: 2; url=index.html");
    echo 'Please Log in before you access this page!';
}
?> 