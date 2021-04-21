<?php
require 'server.php';
global $errorsLogin;
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Staff Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/logindesign.css?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>

</head>


<h1>Covid 19 Track and Trace System</h1>

<div class="main">
    <p class="sign" align="center">Staff Login</p>
    <form class="form1" method="post" action="LoginPage.php">
        <?php
        require 'errors.php';
        displayErrors($errorsLogin);
        ?>
        <input class="un " type="text" align="center" placeholder="Username" id="username" name="username" required>
        <input class="pass" type="password" align="center" placeholder="Password" id="password" name="password" required><br><br><br>
        <button type="submit" class="submit" name="login_staff" align="center">Login</button>
    </form>
</div>

<p><center><a href="Homepage.php"class="homepage">Back to Home Page</a></center></p>

</body>    
</html>    