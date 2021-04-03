<!--This file is public page -- Register(Only contain heading)-->
<!--@Date 03/07/2021-->
<?php require 'server.php'; ?>
<!DOCTYPE html>
<html lang="en">
<br>
<meta charset="UTF-8">
<title>Covid-19 Search System | Public</title>
<h1>COVID Track and Trace System</h1><br>
<h2>Register a Case | Public</h2>
</head>
<body>

<form method="post" action="PublicPage.php">
    <?php require 'errors.php'; ?>
    <div>
        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname"><br><br>
    </div>
    <div>
        <label for="lname">Last Name: </label>
        <input type="text" id="lname" name="lname"><br><br>
    </div>
    <div>
        <label for="NHSnum">NHS number: </label>
        <input type="text" id="NHSnum" name="NHSnum"><br><br>
    </div>
    <div>
        <label for="DOB">Date Of Birth: </label>
        <input type="date" id="DOB" name="DOB"><br><br>
    </div>
    <div>
        <label for="streetAdd">Street Address: </label>
        <input type="text" id="streetAdd" name="streetAdd"><br><br>
    </div>
    <div>
        <label for="city">City: </label>
        <input type="text" id="city" name="city"><br><br>
    </div>
    <div>
        <label for="postcode">Post Code: </label>
        <input type="text" id="postcode" name="postcode"><br><br>
    </div>
    <div>
        <label for="telephone">Telephone Number: </label>
        <input type="tel" id="telephone" name="telephone"><br><br>
    </div>
    <div>
        <label for="reason">Reason for Registering</label>
        <select id="reason" name="reason">
            <option value="positive test result">positive test result</option>
            <option value="contact with a confirmed case">contact with a confirmed case</option>
            <option value="covid symptoms">covid symptoms</option>
        </select>
    </div>
    <div>
        <button type="submit" class="registerBtn" name="reg_case">Register Case</button>
    </div>


</form>

<a href="Homepage.php">Back to Home Page --> </a>

</body>
</html>

