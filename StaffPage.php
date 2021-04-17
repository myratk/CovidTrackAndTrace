<?php
session_start();

if(!(isset($_SESSION['username']))) {
    $_SESSION['msg'] = "You must log in first";
    header('location: LoginPage.php');
}
if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: Homepage.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Covid-19 Search System | Staff</title>
    <meta name="author" content="Null Pointer">
    <meta name="description" content="Staff Page Login">
</head>

<body>
<h1>Track and Trace -- Employee Page</h1><br>

<p>
    Welcome to Covid-19 Track and Trace System
</p>

<?php if (isset($_SESSION['username'])) :?>
    <h1>Welcome <?php echo $_SESSION['title'] . " " . $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></h1>
    <table>
        <thead>
        </thead>
        <tbody>
        </tbody>
    </table>


    <br><a href="Homepage.php">Back to Home Page --> </a>
    <br><a href="StaffPage.php?logout=1">Logout</a>
<?php endif ?>

</body>
</html>

