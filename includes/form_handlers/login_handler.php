<?php

if (isset($_POST['login_button'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

    $_SESSION['log_email'] = $email;
    $password = md5($_POST['log_password']);

    $database_check_query_string = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $database_check_query = mysqli_query($con, $database_check_query_string);
    $check_login_query = mysqli_num_rows($database_check_query);

    if($check_login_query == 1) {
        $row = mysqli_fetch_array($database_check_query);
        $username = $row['username'];
        
        $user_closed = $row['user_closed'];
        echo $user_closed;
        if ($user_closed == 'yes'){
            $reopen_account = mysqli_query($con,"UPDATE users SET user_closed='no' WHERE email='$email'");   
        }
        $_SESSION['username'] = $username;
        
        header("Location: index.php");
        exit();
    } else {
        array_push($error_array, "Email or password was incorrect<br>");
    }
}

?>