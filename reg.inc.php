<?php

function get_value_post($var) {
    return isset($_POST[$var]) ? $_POST[$var] : "";
}

function display_form($username = "", $password = "" , $email = "", $age = "", $gender = "", $level = "", $terms = "", $errors = array()){
    //displaying all errors
    if (count($errors)> 0){
        echo '<div class= "error small"><ul>';
        foreach ($errors as $field => $val){
            echo "<li>" . $val . "</li>";
        }
        echo '</ul></div>';
    }

    //displaying where the user will put info
    echo '<form name="reg" action"' . $_SERVER['PHP_SELF'] . '"method="POST">';

    $error_username = array_key_exists("username", $errors) ? 'class="error"' : '';
    echo '<div' . $error_username . '><label> Username <input type="text" name="username" value="' . $username . '" size="20"/></label></div>';

    //password will be changed upon release hopefully with an hash
    $error_password = array_key_exists("password", $errors) ? 'class="error"' : '';
    echo '<div' . $error_password . '><label> Password <input type="password" name="password" value="' . $password . '" size="20" /></label></div>';

    $error_email = array_key_exists("username", $errors) ? 'class="error"' : '';
    echo '<div' . $error_email . '><label> Email <input type="text" name="email" value="' . $email . '" size="20"/></label></div>';

    echo '<div>
        <label> Age
        <select name="age">
        <option value="0">--</option>';
    //generate select options for age
    for ($a = 10; $a <= 99; $a++){
        echo '<option value="' . $a . '"';
        if ($a == $age){
            echo 'selected';
        }
        echo '>' . $a . '</option>';
    }
    echo '</select></label></div>';

    $error_gender = array_key_exists("gender", $errors) ? 'class="error"' : '';
    echo '<div' . $error_gender . '><label> Gender';
    $male_sel = ($gender == 'male') ? 'checked' : '';
    $female_sel = ($gender == 'female') ? 'checked' : '';
    echo '<input type="radio" name="gender" value="male" ' . $male_sel . '/> Male';
    echo '<input type="radio" name="gender" value="female" ' . $female_sel . '/> Female';
    echo '</label></div>';

    echo '<div>
        <label> Level
        <select name="level">
        <option value="0">--</option>';
    //generate select options for level
    for ($l = 1; $l <= 3; $l++){
        echo '<option value="' . $l . '"';
        if ($l == $level){
            echo 'selected';
        }
        echo '>' . $l . '</option>';
    }
    echo '</select></label></div>';

    $error_terms = array_key_exists("terms", $errors) ? 'class="error"' : '';
    $terms_sel = ($terms == 1) ? ' checked' : '';
    echo '<div ' . $error_terms . '><input type="checkbox" name="terms" value="1" ' . $terms_sel . ' /> I accept the terms and conditions. </div>';

    echo '<input type="submit" name="submit" value="Register"></form>';
}

function confirm($username, $email, $age, $gender, $level){
    echo '<h1> Successful registration </h1>';
    echo 'Username: ' . $username . '<br>';
    echo 'Email: ' . $email . '<br>';
    echo 'Age: ' . $age . '<br>';
    echo 'Gender: ' . $gender . '<br>';
    echo 'Level: ' . $level . ' (The level will be possible to change after) <br>';
}
//This function will add errors to the array to be displayed in function display form
//Errors will be added by checking the inputs, and they will be indexed with the name of the input
function input_check($username , $password , $email , $age , $gender , $level , $terms){
    $errors = array(); //this array will hold all the errors

    //username
    if (strlen($username) == 0) {
        $errors['username'] = "Username is missing";
    }
    elseif(strlen($username) < 3){
        $errors['username'] = "Invalid username";
    }
    // might be needing to add a check for if the username is taken, but that can also be checked with email
    // whitch is more prefrable

    //password
    if (strlen($password) == 0) {
        $errors['password'] = "Password is missing";
    }
    elseif(strlen($username) < 6){
        $errors['password'] = "Password must be atleast 6 characters long";
    }
    //TODO check if numbers are included and upper and lowercase is used

    //email
    if (strlen($email) == 0) {
        $errors['email'] = "Email is missing";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Invalid email address";
    }
    //TODO check if email is already in use

    //age
    if (strlen($age) == 0) {
        $errors['age'] = "Age is missing";
    }

    //gender
    if (strlen($gender) == 0) {
        $errors['gender'] = "Gender is missing";
    }

    //level
    if (strlen($level) == 0) {
        $errors['level'] = "Level is missing";
    }

    //terms
    if( $terms != 1) {
        $errors['terms'] = "Terms and conditions must be accepted";
    }

    return $errors;
}