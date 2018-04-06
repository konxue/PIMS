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
    $_SESSION['p_selected']= null;
    $_SESSION['ipcheck'] = 2;
    require('ipcheck.php');
    echo "<div class='heading'><strong><center>".$_SESSION['usertype'].": ".$_SESSION['firstname'].", ".$_SESSION['lastname']." Welcome to Patient Information Management System!</center></strong></div>";
    echo'<a href="logout.php" class="sslogout btn btn-info btn-small"> <span class="glyphicon glyphicon-log-out"> Logout</span>  
        </a>';
} else {
    header("Refresh: 0; url=index.html");
    echo '<script type="text/javascript">alert("Error 440.\\nPlease log in and try again!")</script>';
}
?> 