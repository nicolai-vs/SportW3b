<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TakeTheStep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="felles.css">
    <link rel="stylesheet" href="registration.css">

</head>
<body>
<nav class="navbar navbar-custom ">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home.php">TakeTheStep</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#" onclick="document.getElementById(1).style.display='block'"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>

<?php

require("reg.inc.php");

$db_server = "localhost";
$db_username = "root";
$db_password = "jl2ktm";
$db_database = "sportweb";

function save_to_mysql($username, $password, $email, $age, $gender, $level){
    global $db_server, $db_username, $db_password, $db_database;

    //create connection
    $mysqli = new mysqli($db_server, $db_username, $db_password, $db_database);

    //check connection
    if ($mysqli->connect_error){
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Inserting them to the server
    $stmt = $mysqli->prepare("INSERT INTO userinfo(username, password, email, age, gender, level) VALUES (?,?,?,?,?,?)");
    // Since I've been using them as strings in reg.inc i convert them here to ints.
    if ($gender == "male"){
        $genderint = 1;
    }else{
        $genderint = 0;
    }
    // Bind parameters
    $stmt->bind_param('sssiii', $username, $password, $email, $age, $genderint, $level);
    $stmt->execute();
    $res = $stmt->affected_rows;
    if($res != 1){
        die("MySQL error");
    }
    $stmt->close();

    //Disconnect
    $mysqli->close();
}
// Read in form values
$username = get_value_post("username");
$password = get_value_post("password");
$email    = get_value_post("email");
$age      = get_value_post("age");
$gender   = get_value_post("gender");
$level    = get_value_post("level");
$terms    = get_value_post("terms");

//Check if the form has been submitted -- any of the input values is set
$submitted = isset($_GET['username']); //TODO when POST is okay change to POST
if($submitted){
    // check for errors
    $errors = input_check($username, $password, $email, $age, $gender, $level, $terms);

    if(count($errors) > 0){
        display_form($username, $password, $email, $age, $gender, $level, $terms, $errors);
    }else {
        confirm($username, $email, $age,$gender, $level);
        //save_to_mysql($username, $password, $email, $age, $gender, $level);  // this function is working
    }
}else{
    // display form for the first time
    display_form();
}


?>

<div class=" front" align="center">

    <!-- http://www.w3schools.com/howto/howto_css_login_form.asp for nice login page -->
    <div id="1" class="modal">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <span onclick="document.getElementById('1').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="avatar.png" alt="avatar" class="avatar">
            </div>

            <div class="container">
                <label><b>Username</b></label>
                <input type="text" class="login-info" placeholder="Enter Username" name="uname" required>

                <label><b>Password</b></label>
                <input type="password" class="login-info" placeholder="Enter Password" name="psw" required>

                <button class="btn btn-danger" onclick="document.getElementById('1').style.display='none'"  style="float: left" type="submit">Cancel</button>
                <button class="btn btn-success" style="margin-left: 3%" type="submit">Login</button>
                <div style="float: right">
                    <input type="checkbox" > Remember me
                </div>
            </div>
            <div class="container">
                <div style="float: right">
                    Forgott <a href="#" > Password?</a>
                </div>
            </div>
        </form>

    </div>

</div>
<!-- foreløpig måte siden jeg ikke har laget en egen script fil enda -->
<script>
    // Get the modal
    var modal = document.getElementById('1');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>