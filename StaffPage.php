<?php
require 'server.php';
include 'errors.php';

global $errorsVac;
global $errorsNHSNum;
global $errorsRemoveVac;
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
    <title>Staff System</title>
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/Staff_page_design.css?v=<?php echo time(); ?>">
</head>

<body>
<h1>Track and Trace -- Staff Page</h1>

<?php if (isset($_SESSION['username'])) :?>
    <center><h2>Welcome <?php echo $_SESSION['title'] . " " . $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></h2></center>

    <h3>These are the current active cases</h3>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>NHS number</th>
            <th>Address</th>
            <th>Post code</th>
            <th>Phone number</th>
            <th>Email</th>
            <th>Registration Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
            global $connection;
            require 'connect.php';
            $queryCases = "SELECT * FROM activecase INNER JOIN person USING (NHSnumber) ORDER BY RegistrationDate DESC";
            $cases = $connection -> query($queryCases);

            foreach ($cases as $case) {
                echo "<tr>";
                echo "<td>" . $case['title'] . " " . $case['firstName'] . " " . $case['lastName'] . "</td>";
                echo "<td>" . $case['NHSnumber'] . "</td>";
                echo "<td>" . $case['street'] . ", " . $case['city'] . "</td>";
                echo "<td>" . $case['postalCode'] . "</td>";
                echo "<td>" . $case['phoneNumber'] . "</td>";
                echo "<td>" . $case['email'] . "</td>";
                echo "<td>" . $case['RegistrationDate'] . "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>

    <form method="post" action="StaffPage.php">
        <?php
        displayErrors($errorsNHSNum);
        ?>

        <center><h2>To mark a patient as recovered enter their NHS number below</h2></center><br>
        <div class="cont1">
        <div>
            <label for="NHSnum">NHS Number: </label><br>
            <input type="text" id="NHSnum" name="NHSnum"><br>
        </div>
        <div>
            <button type="submit" class="submitBtn" name="NHS_Number" onclick="return confirm('Are you sure you want to mark patient as recovered?')">Submit</button>
        </div>
        <br>
        </div>
    </form>

    <center><h2>Upcoming vaccine appointments</h2></center>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>NHS number</th>
            <th>Phone number</th>
            <th>Email</th>
            <th>First Dose Date</th>
            <th>Second Dose Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        global $connection;
        require 'connect.php';
        $queryVaccinations = "SELECT * FROM vaccination INNER JOIN person USING (NHSnumber) WHERE (firstDose>CURRENT_DATE) OR (secondDose>CURRENT_DATE)";
        $vaccinations = $connection -> query($queryVaccinations);

        foreach ($vaccinations as $vaccination) {
            $currentDate = Date("Y-m-d");
            echo "<tr>";
            echo "<td>" . $vaccination['title'] . " " . $vaccination['firstName'] . " " . $vaccination['lastName'] . "</td>";
            echo "<td>" . $vaccination['NHSnumber'] . "</td>";
            echo "<td>" . $vaccination['phoneNumber'] . "</td>";
            echo "<td>" . $vaccination['email'] . "</td>";
            if ($vaccination['firstDose'] > $currentDate) { echo "<td><b>" . $vaccination['firstDose'] . "</b></td>"; }
            else { echo "<td>" . $vaccination['firstDose'] . "</td>"; }

            if ($vaccination['secondDose'] > $currentDate) { echo "<td><b>" . $vaccination['secondDose'] . "</b></td>"; }
            else { echo "<td>" . $vaccination['secondDose'] . "</td>"; }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>


    <center><h2>To register a patient for the vaccine enter their details below</h2></center><br>
    <div class="cont2">
    <form method="post" action="StaffPage.php">
        <?php
        displayErrors($errorsVac);
        ?>

        <div>
            <label for="NHSNumVac">NHS Number: </label><br>
            <input type="text" id="NHSNumVac" name="NHSNumVac"><br><br>
        </div>
        <div>
            <label for="firstDate">First Dose: </label><br>
            <input type="date" id="firstDate" name="firstDate"><br><br>
        </div>
        <div>
            <label for="secondDate">Second Dose: </label><br>
            <input type="date" id="secondDate" name="secondDate"><br><br>
        </div>
        <div>
            <button type="submit" class="submitBtn" name="register_vaccine" onclick="return confirm('Are you sure you want to register this patient for a vaccine?')">Submit</button>
        </div>
    </form>
    </div>
<br>

    <h2>To remove a vaccination appointment, enter the NHS number</h2><br>
    <div class="cont3">
    <form method="post" action="StaffPage.php">
        <?php
        displayErrors($errorsRemoveVac);
        ?>

        <div>
            <label for="NHSnum">NHS Number: </label><br>
            <input type="text" id="NHSnumVacRemove" name="NHSnumVacRemove"><br>
        </div>
        <div>
            <button type="submit" class="submitBtn" name="remove_vaccination" onclick="return confirm('Are you sure you want to remove this vaccination appointment?')">Submit</button>
        </div>
    </form>
    </div>
    <br>
    <div class="EOP">
        <center>
    <br><pre><a href="Homepage.php">Back to Home Page <-- </a></pre>	  <!--&#9; is for spacing-->
        <pre><a href="StaffPage.php?logout=1">Logout</a></pre>
        </center>
<?php endif ?>
    </div>

</body>
</html>

