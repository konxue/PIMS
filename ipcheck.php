<!--
    Purpose: This PHP page handles the IP blockist to only allow certain IP's access to application
    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)
-->

<?php
session_start();
//following code perform as blocking the unauthorized user to login out side of network
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
    if (($ip < $iphigh && $ip > $iplow)) // add || $ip == $ip1 for exception
    {
        if(!isset($_SESSION['username']))
        {
            header("Refresh: 0; url=index.html");
        }
        else
        {
            header("Refresh: 0; url=mainpage.php");
        }
    }
    else
    {
        session_destroy();   // function that Destroys Session ;
        header("Refresh: 0; url=401.html");
    }
?>
