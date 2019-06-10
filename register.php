<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to Meegosted!</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
</head>
<body>

    <?php
        if (isset($_POST['register_button'])) {
            echo "
                <script>
                document.addEventListener('DOMContentLoaded', function(){ 
                    document.querySelector('.cont').classList.toggle('s--signup');
                }, false);
                </script>
            ";
        }
    ?>

    <div class="cont">
        <div class="form sign-in">
        <h2>Welcome back,</h2>
        <div class="error_container">
            <br>
            <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect<br>";?>
        </div>
            <form action="register.php" method="POST">
                <label>
                    <span>Email</span>
                    <input type="email" name="log_email" value="<?php 
                        if(isset($_SESSION['log_email'])) {
                        echo $_SESSION['log_email'];
                    } 
                    ?>" required>
                </label>

                <label>
                    <span>Password</span>
                    <input type="password" name="log_password">
                </label>
                <p class="forgot-pass">Forgot password?</p>
                
                <button class="submit">
                    <input type="submit" name="login_button" value="Login">
                </button>
            </form>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h2>New here?</h2>
                    <p>Sign up and explore the oppurtunities Meegosted has to offer!</p>
                </div>
                <div class="img__text m--in">
                    <h2>One of us?</h2>
                    <p>If you already has an account, just sign in. We've missed you!</p>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up">
                <h2>Let's get you signed up,</h2>
                <div class="error_container">
                    <br>
                    <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
                    <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>
                    <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
                        else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";?>
                    <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
                        else if(in_array("Your password can only contain latin alphabet characters or numbers<br>", $error_array)) echo "Your password can only contain latin alphabet characters or numbers<br>";
                        else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>
                        <?php if(in_array("<span style='color: #14C800;'>Your account has been created!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Your account has been created!</span><br>"; ?>
                    <br>
                </div>
                
                <form action="register.php" method="POST">
                <label>
                    <span>First Name</span>
                    <input type="text" name="reg_fname" value="<?php 
                        if(isset($_SESSION['reg_fname'])) {
                           echo $_SESSION['reg_fname'];
                        } 
                    ?>" required>
                </label>
                
                <label>
                    <span>Last Name</span>
                    <input type="text" name="reg_lname" value="<?php 
                        if(isset($_SESSION['reg_lname'])) {
                            echo $_SESSION['reg_lname'];
                        } 
                    ?>" required>
                </label>            

                <label>
                    <span>Email</span>
                    <input type="email" name="reg_email" value="<?php 
                        if(isset($_SESSION['reg_email'])) {
                            echo $_SESSION['reg_email'];
                        } 
                    ?>" required>
                </label>

                <label>
                    <span>Password</span>
                    <input type="password" name="reg_password" required>
                </label>

                <label>
                    <span>Confirm Password</span>
                    <input type="password" name="reg_password2" required>
                </label>

                <button class="submit">
                    <input type="submit" name="register_button" value="Register">
                </button>
	            </form>
            </div>
        </div> 
    </div>
    
    
    <script src="assets/js/register.js"></script>
</body>
</html>