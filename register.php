<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_errno();
}

$fname= "";
$lname       = "";
$email       = "";
$password    = "";
$password2   = "";
$date        = "";
$error_array = array();

if(isset($_POST['reg_button'])) {
    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ', '', $fname);
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname; // Storing first name into session varaible

    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname; // Storing last name into session varaible


    $email = strip_tags($_POST['reg_email']);
    $email = str_replace(' ', '', $email);
    $email = ucfirst(strtolower($email));
    $_SESSION['reg_email'] = $email; // Storing email into session varaible


    $password  = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);
    
    $date = date("Y-m-d");

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Manual email "foo@bar.com" check
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        // Checking if email is already in database
        $email_check_query = "SELECT email FROM users WHERE email='$email'";
        $email_check = mysqli_query($con, $email_check_query);

        // Count number of row returned
        $num_rows = mysqli_num_rows($email_check);

        // Determine based on num of rows if email was in database
        if ($num_rows > 0) {
            array_push($error_array, "Email already in use<br>");
        } else {
            array_push($error_array, "No rows found<br>");
        }

    } else {
        array_push($error_array, "Incorrect email format<br>");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name should be between 2 and 25 characters<br>");
    }

    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name should be between 2 and 25 characters<br>");
    }

    if ($password == $password2) {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your password can only contain Latin characters and numbers<br>");
        }
    } else {
        array_push($error_array, "Passwords dont match<br>");
    }

    if (strlen($password) > 30 || (strlen($password) < 5)) {
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
    }
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
            <input type="text" name="reg_fname" placeholder="First Name" 
            value="
                <?php 
                if (isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                }
                ?>"
            required>
            <br>
            <input type="text" name="reg_lname" placeholder="Last Name"             
            value="
                <?php 
                if (isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                }
                ?>"
            required>
            <br>
            <input type="email" name="reg_email" placeholder="Email"             
            value="
                <?php 
                if (isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }
                ?>"
            required>
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