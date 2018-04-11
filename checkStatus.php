<!--
    Purpose: This PHP page checks the IP status and who is logged into the system
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<style>
.heading{
		background: skyblue;
		color: rgba(255, 255, 255, 0.75);
		cursor: default;
		height: 2em;
		line-height: 2em;
		position: fixed;
                background-attachment: scroll;
		top: 0;
		width: 100%;
		color: #fff;
                font-size: 1.0em;
		text-decoration: none;
		}
.sslogout{
                position: fixed;
                background-attachment: scroll;
}

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
    session_start();
    if (isset($_SESSION['username'])) {
    echo "<div class='heading'><strong><center>".$_SESSION['usertype'].": ".$_SESSION['lastname'].", ".$_SESSION['firstname'].". Welcome to Patient Information Management System!</center></strong></div>";
    echo'<a href="logout.php" class="sslogout btn btn-info btn-sm"> <span class="glyphicon glyphicon-log-out"> Logout</span>  
        </a>';
    //IP Check
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    $ip = ip2long($ipaddress);
    $iplow = ip2long('146.229.0.0');
    $iphigh = ip2long('146.229.255.255');
    //$ip1 = ip2long('146.229.0.0'); to add more exception...
    if (!($ip < $iphigh && $ip > $iplow)) // add || $ip == $ip1 for exception
    {
        session_destroy();   // function that Destroys Session ;
        header("Refresh: 0; url=401.html");
    }
} else {
    header("Refresh: 0; url=ipcheck.php");
    echo '<script type="text/javascript">alert("Error 440.\\nPlease log in and try again!")</script>';
}
?> 