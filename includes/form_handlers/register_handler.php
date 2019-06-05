<?php

//Declaring variables to prevent errors
$fname        = ""; //First name
$lname        = ""; //Last name
$email        = ""; //email
$password     = ""; //password
$password2    = ""; //password 2
$date         = ""; //Sign up date 
$error_array  = array(); //Holds error messages

if(isset($_POST['register_button'])){

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//email
	$email = strip_tags($_POST['reg_email']); //Remove html tags
	$email = str_replace(' ', '', $email); //remove spaces
	$email = ucfirst(strtolower($email)); //Uppercase first letter
	$_SESSION['reg_email'] = $email; //Stores email into session variable

	//Password
	$password  = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); //Current date

	//Check if email is in valid format 
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        //Check if email already exists 
        $email_check_query_string = "SELECT email FROM users WHERE email='$email'";
		$email_check_query        = mysqli_query($con, $email_check_query_string);

		//Count the number of rows returned
		$num_rows = mysqli_num_rows($email_check_query);

		if($num_rows > 0) {
			array_push($error_array, "Email already in use<br>");
		}
	}
	else {
			array_push($error_array, "Invalid email format<br>");
	}


	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain latin alphabet characters or numbers<br>");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Your password must be betwen 5 and 30 characters<br>");
	}


	if(empty($error_array)) {
		$password = md5($password); // Encrypt password before sending to database

		// Generate unique username
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

		$i = 0; 
		// If username exists increment and add num to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		// Profile picture assignment
		$rand = rand(1, 10);
        switch ($rand) {
            case 1:
                $profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
                break;
            case 2:
                $profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
                break;
            case 3:
                $profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";
                break;
            case 4:
                $profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
                break;
            case 5:
                $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
                break;  
            case 6:
                $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
                break;  
            case 7:
                $profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
                break; 
            case 8:
                $profile_pic = "assets/images/profile_pics/defaults/head_nephritis.png";
                break;   
            case 9:
                $profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
                break; 
            case 10:
                $profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
                break;   
            default:
                $profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
        }

        $query_string = "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')";
		$query = mysqli_query($con, $query_string);

		array_push($error_array, "<span style='color: #14C800;'>Your account has been created!</span><br>");

		// Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}

}

?>