<?php
//connect to DB
require 'connect.inc.php';
//current file
require 'core.inc.php';


if (loggedin()) {
    echo 'You are logged in. <a href="logout.php">Log out</a><br>';
    $firstname = getuserfield('firstname');
    $lastname = getuserfield('lastname');
    echo '<br>Firstname: '.$firstname.'<br> Lastname: '.$lastname.'<br>';
} else {
    //Login Form
    include 'loginform.inc.php';
}





?>

