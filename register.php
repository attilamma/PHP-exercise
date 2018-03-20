<?php
require 'core.inc.php';
require 'connect.inc.php';
global $con;

if(!loggedin()) {
//check if data was sent
if (isset($_POST['username'])&&
    isset($_POST['password'])&&
    isset($_POST['password_again'])&&
    isset($_POST['firstname'])&&
    isset($_POST['lastname']) ) {
    //declare form variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];
    /*encrypt password*/ $password_hash = md5($password);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    //check if any form is not empty
    if(!empty($username)&&
       !empty($password)&&
       !empty($password_again)&&
       !empty($firstname)&&
       !empty($lastname) ) {
        //check if input is greater than maximum length
        if (strlen($username)>30||strlen($firstname)>40||strlen($lastname)>40) {
            echo 'Exceeded maximum length of input values!';
        } else {
            //check if password inputs match
            if ($password!=$password_again) {
                echo 'Passwords do not match!';
            } else {
                //check if username exists in database
                $query = "SELECT `username` FROM `users` WHERE `username` ='$username'";
                $query_run = mysqli_query($con,$query);

                if (mysqli_num_rows($query_run)==1) {
                    echo 'The username "'.$username.'" already exists.';
                } else {
                    //register user (prevent sql injection)
                    $query = "INSERT INTO `users` VALUES ('','".mysqli_real_escape_string($con,$username)."',
                                                            '".mysqli_real_escape_string($con,$password_hash)."',
                                                            '".mysqli_real_escape_string($con,$firstname)."',
                                                            '".mysqli_real_escape_string($con,$lastname)."')";
                    if ($query_run = mysqli_query($con,$query)) {
                        //redirect user to another page
                        header('Location: register_success.php');
                    } else {
                        echo 'Failed to register, try again!';
                    }
                }
            }
        }
       } else {
           echo 'All fields are required!';
       }

    }


?>

<form action="register.php" method="POST">
Username:<br>
<input type="text" name="username" maxlength="30" value="<?php if(isset($username)) {echo $username;}?>"><br><br>
Password:<br>
<input type="password" name="password" value="<?php if(isset($password)) {echo $password;}?>"><br><br>
Password again:<br>
<input type="password" name="password_again" value="<?php if(isset($password_again)) {echo $password_again;}?>"><br><br>
Firstname:<br> 
<input type="text" name="firstname" maxlength="40" value="<?php if(isset($firstname)) {echo $firstname;}?>"><br><br>
Lastname:<br>
<input type="text" name="lastname" maxlength="40" value="<?php if(isset($lastname)) {echo $lastname;}?>"><br><br>
<input type="submit" value="Register"><br>
</form>

<?php
} else if (loggedin()) {
    echo 'You are already registered and logged in.';
}
?>