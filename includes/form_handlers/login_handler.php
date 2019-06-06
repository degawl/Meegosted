<?php

if (isset($_POST['login_button'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

    $_SESSION['login_email'] = $email;
    $password = md5($_POST['log_password']);

    $database_check_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $database_check = mysqli_query($con, $database_check_query);
    $check_login = mysqli_num_rows($database_check);

    if ($check_login == 1) {
        $row = mysqli_fetch_array($database_check);
        $username = $row['username'];

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        array_push($error_array, "Email or password was incorrect<br>");
    }
}

?>