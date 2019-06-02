<?php
$con = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_errno();
}

$fname = "";
$lname = "";
$email = "";
$password = "";
$password2 = "";
$date = "";
$error_array = "";

if(isset($_POST['reg_button'])) {

}

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome to Meegosted</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

        <form action="register.php" method="POST">
            <input type="text" name="reg_fname" placeholder="First Name" required>
            <br>
            <input type="text" name="reg_lname" placeholder="Last Name" required>
            <br>
            <input type="email" name="reg_email" placeholder="Email" required>
            <br>
            <input type="password" name="reg_password" placeholder="Password" required>
            <br>
            <input type="password" name="reg_password2" placeholder="Confirm Password" required>
            <br>
            <input type="submit" name="reg_button" value="Register">
            <br>
        </form>

    </body>
</html>