<?php

if (isset($_POST['username'])&&isset($_POST['password'])) {
    global $con;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = md5($password);

    if(!empty($username)&&!empty($password)) {
        
        $query = "SELECT id FROM users WHERE username = '" .mysqli_real_escape_string($con,$username). "' AND password = '".mysqli_real_escape_string($con,$password_hash)."' ";
        if ($query_run = mysqli_query($con,$query)) {
            $query_num_rows = mysqli_num_rows($query_run);

            if($query_num_rows==0) {
                echo 'Invalid username/password combination.';
            } else if ($query_num_rows==1) {
                foreach($query_run as $query_row){
                    $user_id = $query_row['id'];
                    $_SESSION['user_id'] = $user_id;
                    header('Location: index.php');
                   }
            }
        } else {
            echo 'There is an error.';
        }

    } else {
        echo 'You must supply a username and password.<br>';
    }
}

?>

<form action="<?php echo $current_file;?>" method="POST">
Username: <input type="text" name="username"><br>
Password: <input type ="password" name="password"><br>
<input type="submit" value="Login">
</form>
<br>

<?php
echo 'Or create a <a href="register.php">New Account</a>';
?>

