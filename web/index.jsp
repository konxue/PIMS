<%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@taglib prefix="sql" uri="http://java.sun.com/jsp/jstl/sql"%>
<%-- 
    Document   : index
    Created on : Feb 6, 2018, 9:55:10 PM
    Author     : mandangles
--%><sql:query var="subject" dataSource="MyPIMS">
SELECT subject_id, name FROM Subject
</sql:query>
    
<table border="1">
<!-- column headers -->
<tr>
<c:forEach var="columnName" items="${subject.columnNames}">
<th><c:out value="${columnName}"/></th>
</c:forEach>
</tr>
<!-- column data -->
<c:forEach var="row" items="${subject.rowsByIndex}">
<tr>
    <c:forEach var="column" items="${row}">
<td><c:out value="${column}"/></td>
    </c:forEach>
</tr>
</c:forEach>
</table>
<sql:query var="subjects" dataSource="MyPIMS">
    SELECT subject_id, name FROM Subject
</sql:query>


<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
   <body>
    <h2>Welcome to <strong>IFPWAFCAD</strong>, the International Former
        Professional Wrestlers' Association for Counseling and Development!
    </h2>

    <table border="0">
        <thead>
            <tr>
                <th>IFPWAFCAD offers expert counseling in a wide range of fields.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>To view the contact details of an IFPWAFCAD certified former
                    professional wrestler in your area, select a subject below:</td>
            </tr>
            <tr>
                <td>
                    <form action="response.jsp">
                        <strong>Select a subject:</strong>
                        <select name="subject_id">
                            <option></option>
                        </select>
                        <input type="submit" value="submit" name="submit" />
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</head>
</html>