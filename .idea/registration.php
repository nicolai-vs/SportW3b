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
            <a class="navbar-brand" href="home.html">TakeTheStep</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#" onclick="document.getElementById(1).style.display='block'"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>

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
</nav>
</body>
</html>