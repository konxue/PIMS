<%@taglib prefix="sql" uri="http://java.sun.com/jsp/jstl/sql"%>
<link rel="stylesheet" type="text/css" href="loginpg.css">

<form action="action_page.php">
  <div class="imgcontainer">
    <img src="http://onlinepims.com/images/3.png" alt="PIMS">
    <img src="http://onlinepims.com/images/1.png" alt="PIMS">
    <img src="http://onlinepims.com/images/2.png" alt="PIMS">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    
    /*Database query */
    <sql:query var="Username" dataSource="PIMSDB">
        SELECT Username FROM Users
    </sql:query>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">If you have technical difficulties contact 1-800-654-4879</button>
  </div>
</form>
