<?php
ob_start();
session_start();

$current_file = $_SERVER['SCRIPT_NAME'];
if(isset($_SERVER['HTTP_REFERER'])){
$http_referer = $_SERVER['HTTP_REFERER']; //http_referer is the last page the user was on
}
function loggedin(){
 if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
  return true;
 } else {
  return false;
 }
}
function getuserfield($field){
 global $con;

$query = "SELECT `$field` FROM `users` WHERE `id` = '".$_SESSION['user_id']."'";
if ($query_run = mysqli_query($con, $query)){
 
 while($row = mysqli_fetch_assoc($query_run)){
 $count = $row[$field]; 
 return $count;
 }
 
 
  
}
}

?>