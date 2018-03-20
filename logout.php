<?php
require 'core.inc.php';
session_destroy();
//redirect user to last page the user was on (Loginpage)
header('Location: '.$http_referer);
?>