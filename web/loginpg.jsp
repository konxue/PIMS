<%@taglib prefix="sql" uri="http://java.sun.com/jsp/jstl/sql"%>
<link rel="stylesheet" type="text/css" href="loginpg.css">
<sql:setDataSource  var="co"   driver="com.mysql.jdbc.Driver" 
                        url="jdbc:mysql://onlinepims.com:3306/onlinepims"
                        user="onlinepimsroot"
                        password="rootroot"
                        />

    <sql:query var="dbpassword" dataSource="${co}">
        SELECT PassWord FROM Users
    </sql:query>
        
     <sql:query var="dbuser" dataSource="${co}">
        SELECT Username  FROM Users
    </sql:query>
<form action="user.jsp">
  <div class="imgcontainer">
    <img src="http://onlinepims.com/images/3.png" alt="PIMS">
    <img src="http://onlinepims.com/images/1.png" alt="PIMS">
    <img src="http://onlinepims.com/images/2.png" alt="PIMS">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" id='userfield' placeholder="Enter Username" name="uname" required>
    
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button onclick="checkLogin()">Login</button>
    <p id = "demo"> Text field </p>

    <script>
           var a = document.getElementById("userfield").value;
           document.getElementById("demo").onclick = function() {checkLogin()()};

            function checkLogin() {
             document.getElementById("demo") = a;
         }
    </script>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">If you have technical difficulties contact 1-800-654-4879</button>
  </div>
 </form>