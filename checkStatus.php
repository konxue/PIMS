<style>
.heading{
		background: skyblue;
		color: rgba(255, 255, 255, 0.75);
		cursor: default;
		height: 2.25em;
		line-height: 2.25em;
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
    echo "<div class='heading'><strong><center>Welcome to PIMS!  ".$_SESSION['usertype'].": ".$_SESSION['firstname'].", ".$_SESSION['lastname']."</center></strong></div>";
    echo "<strong><a href='logout.php' class='sslogout btn btn-default btn-large'>  <span class='glyphicon glyphicon-log-out'> LOGOUT</span></a></strong>";
    echo "<br><br>";
} else {
    header("Refresh: 1; url=index.html");
    echo '<div class="heading"><strong><center>Please Log in before you access this page!</center></strong></div>';
}
?> 