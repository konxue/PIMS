<link rel="stylesheet" type="text/css" href="loginpg.css">

<html>
<head>
<title>PIMS Login Page</title>
</head>
<body>

  
  <div class="imgcontainer">
    <img src="http://onlinepims.com/images/3.png" alt="PIMS">
    <img src="http://onlinepims.com/images/1.png" alt="PIMS">
    <img src="http://onlinepims.com/images/2.png" alt="PIMS">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
<form action="user.jsp">
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
 </form>
  </div>
<ul>
    <?php for($i=1;$i<=5;$i++){ ?>
<li>Menu Item <?php echo $i; ?></li> 
<?php } ?>
</ul> 

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">If you have technical difficulties contact 1-800-654-4879</button>
  </div>

</body>
</html>