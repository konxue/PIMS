<!--    Purpose: This PHP page connects page to database    Author : UAH CS499 TEAM 12 (Leon Xue, Cristina Ramos, Nick Klauke, Michael Foust)--><?php$connection = mysqli_connect("localhost", "pimsonline","Rootroot123!"); //database connectionif (!$connection){    die("Database Connection Failed" . mysqli_error($connection));}$select_db = mysqli_select_db($connection, 'onlinepims');if (!$select_db){    die("Database Selection Failed" . mysqli_error($connection));}?>