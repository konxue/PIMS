<?php
    session_start();
    if (isset($_SESSION['username'])) {
    $_SESSION['p_selected']= null;
    echo "Welcome!<br/> ".$_SESSION['usertype']." : ".$_SESSION['firstname'].", ".$_SESSION['lastname'];
} else {
    header("Refresh: 1; url=index.html");
    echo 'Please Log in before you access this page!';
}
?> 