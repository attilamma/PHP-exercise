<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_error = 'Could not connect to Database. <br>';

$mysql_db = 'a_database';
//Database connection
$con = @mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
//check if connection to database or database available
if(!$con||!@mysqli_select_db($con,$mysql_db)) {
    die($mysql_error);
} else {
    echo 'Connected!<br><br>';
}

?>





