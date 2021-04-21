<!--This file is public page -- Register(Only contain heading)-->
<!--@Date 03/07/2021-->
<?php
require 'server.php';
global $errorsReg;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Register your Case</title>
    <link rel="stylesheet" type="text/css" href="Register_design.css?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
</head>

<body>
<h1>COVID 19 Track and Trace System</h1>

<form method="post" action="PublicPage.php">
    <?php
    require 'errors.php';
    displayErrors($errorsReg);
    ?>

    <div class="title_of_regis">
        <center>  <h2>Register a Case | Public</h2> </center>
    </div>
    <hr>
    <br>
    <center>
    <div class="container">
    <div>
        <label for="fname">First Name: </label><br>
        <input type="text" id="fname" name="fname" placeholder="Firstname" size="30" required><br><br>
    </div>
    <div>
        <label for="lname">Last Name: </label><br>
        <input type="text" id="lname" name="lname" placeholder="Lastname" size="30" required><br><br>
    </div>
    <div>
        <label for="NHSnum">NHS number: </label><br>
        <input type="text" id="NHSnum" name="NHSnum" placeholder="NHS Number" size="10" required><br><br>
    </div>
    <div>
        <label for="DOB">Date Of Birth: </label><br>
        <input type="date" id="DOB" name="DOB" required><br><br>
    </div>
    <div>
        <label for="streetAdd">Street Address: </label><br>
        <input type="text" id="streetAdd" name="streetAdd" placeholder="Address" size="50" required><br><br>
    </div>
    <div>
        <label for="city">City: </label><br>
        <input type="text" id="city" name="city" placeholder="City" size="30" required><br><br>
    </div>
    <div>
        <label for="postcode">Post Code: </label><br>
        <input type="text" id="postcode" name="postcode" placeholder="Postcode" size="10" required><br><br>
    </div>
    <div>
        <label for="telephone">Telephone Number: </label><br>
        <input type="tel" id="telephone" name="telephone" placeholder="Phone" value="07" size="11" required><br><br>
    </div>
    <div>
        <label for="reason">Reason for Registering</label><br>
        <select id="reason" name="reason">
            <option value="positive test result">positive test result</option>
            <option value="contact with a confirmed case">contact with a confirmed case</option>
            <option value="covid symptoms">covid symptoms</option>
        </select>
    </div>
    <div>
        <button type="submit" class="registerBtn" name="reg_case">Register Case</button>
    </div>
    </div>
    </center>
</form>

<a href="Homepage.php">Back to Home Page <-- </a>

</body>
</html>

