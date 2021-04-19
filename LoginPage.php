<?php
require 'server.php';
global $errorsLogin;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Login</title>
    <meta name="author" content="Null Pointer">
    <meta name="description" content="Employee Login for the Covid Trace and Trace System">

    <link rel="stylesheet" href="logindesign.css" />
</head>

<body>
<h1>Covid Track and Trace System</h1><br>
<h2>Employee Login</h2>

<form method="post" action="LoginPage.php">
    <?php
    require 'errors.php';
    displayErrors($errorsLogin);
    ?>
    <div>
        <label for="empID">Employee ID:</label>
        <input type="text" id="empID" name="empID"><br><br>
    </div>
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
    </div>
    <div>
        <button type="submit" class="loginBtn" name="login_staff">Login</button>
    </div>
</form>

<a href="Homepage.php">Back to Home Page --> </a>

</body>
</html>
