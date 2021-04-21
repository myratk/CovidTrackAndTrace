<?php

$fname = "";
$lname = "";
$NHSnum = "";
$dob = date("");
$address = "";
$city = "";
$postcode = "";
$telephone = "";
$reason = "";

$username = "";
$password = "";

$nhsNumberRecovered = "";

$nhsNumberVaccine = "";
$firstDose = date("");
$secondDose = date("");

$nhsNumberVaccineRemoved = "";

$errorsLogin = array();
$errorsNHSNum = array();
$errorsVac = array();
$errorsRemoveVac = array();
$errorsReg = array();

global $connection;
require 'connect.php';


if (isset($_POST['login_staff'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    if (empty($username) && empty($password)) { array_push($errorsLogin,"Username and Password are required"); }
    else if (empty($username)) { array_push($errorsLogin, "Username is required"); }
    else if (empty($password)) { array_push($errorsLogin, "Password is required"); }

    if (count($errorsLogin) == 0) {
        $queryLogin = "SELECT * FROM employee INNER JOIN login USING(loginID) WHERE username=\"" . $username . "\"";
        $login = $connection -> query($queryLogin) -> fetch(PDO::FETCH_ASSOC);

        if ($login['username']==$username && $login['password']==$password) {
            $queryName = "SELECT title, firstName, lastName FROM (login INNER JOIN employee USING (loginID)) INNER JOIN person USING (NHSnumber) WHERE loginID=\"" . $login['loginID'] . "\"";
            $name = $connection -> query($queryName) -> fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['firstName'] = $name['firstName'];
            $_SESSION['lastName'] = $name['lastName'];
            $_SESSION['title'] = $name['title'];
            $_SESSION['success'] = "You are now logged in";
            header('location: StaffPage.php');
        }
        else {
            array_push($errorsLogin, "Incorrect username or password");
        }
    }
}

if (isset($_POST['NHS_Number'])) {
    $nhsNumberRecovered = $_REQUEST['NHSnum'];
    if (empty($nhsNumberRecovered)) { array_push($errorsNHSNum, "NHS number is required"); }

    if (count($errorsNHSNum) == 0){
        $queryNHSNumExists = "SELECT * FROM activecase WHERE NHSnumber=\"" . $nhsNumberRecovered . "\"";
        $NHSNumExists = $connection -> query($queryNHSNumExists) -> fetch(PDO::FETCH_ASSOC);
        if (!$NHSNumExists) {
            array_push($errorsNHSNum, "No active case registered with this NHS number");
        }
        else {
            $queryAddRecovered = "INSERT INTO recovered(caseID, NHSnumber, reasonID, registrationDate) ";
            $queryAddRecovered .= "VALUES(\"" . $NHSNumExists['caseID'] . "\", \"" . $NHSNumExists['NHSnumber'] . "\", \"" . $NHSNumExists['reasonID'] . "\", \"" . $NHSNumExists['RegistrationDate'] . "\")";
            $connection -> query($queryAddRecovered);
            $queryRemoveCase = "DELETE FROM activecase WHERE NHSnumber=\"" . $nhsNumberRecovered . "\"";
            $connection -> query($queryRemoveCase);
        }
    }
}

if  (isset($_POST['register_vaccine'])) {
    $nhsNumberVaccine = $_REQUEST['NHSNumVac'];
    $firstDose = $_REQUEST['firstDate'];
    $secondDose = $_REQUEST['secondDate'];

    if (empty($nhsNumberVaccine)) { array_push($errorsVac, "NHS number is required"); }
    if (empty($firstDose)) { array_push($errorsVac, "First dose date is required"); }
    if (empty($secondDose)) { array_push($errorsVac, "Second dose date is required"); }

    if (count($errorsVac) == 0) {
        $queryVaccineExists = "SELECT * FROM vaccination WHERE NHSnumber=\"" . $nhsNumberVaccine . "\"";
        $vaccineExists = $connection -> query($queryVaccineExists) -> fetch(PDO::FETCH_ASSOC);
        if ($vaccineExists) {
            array_push($errorsVac, "This person is already registered for a vaccine");
        }
        else {
            $vaccinationID = "VAC" . substr($nhsNumberVaccine, 7, 3);
            $queryRegisterVaccine = "INSERT INTO vaccination(vaccinationID, NHSnumber, firstDose, secondDose) ";
            $queryRegisterVaccine .= "VALUES(\"" . $vaccinationID . "\", \"" . $nhsNumberVaccine . "\", \"" . $firstDose . "\", \"" . $secondDose . "\")";
            $connection -> query($queryRegisterVaccine);
        }

    }

}

if (isset($_POST['remove_vaccination'])) {
    $nhsNumberVaccine = $_REQUEST['NHSnumVacRemove'];
    if (empty($nhsNumberVaccine)) { array_push($errorsRemoveVac, "NHS number is required"); }

    if (count($errorsRemoveVac)==0) {
        $queryVaccineExists = "SELECT * FROM vaccination WHERE NHSnumber=\"" . $nhsNumberVaccine . "\"";
        $vaccineExists = $connection -> query($queryVaccineExists) -> fetch(PDO::FETCH_ASSOC);
        if (!$vaccineExists) {
            array_push($errorsRemoveVac, "No vaccine appointment registered with this NHS number");
        }
        else {
            $queryRemoveVaccine = "DELETE FROM vaccination WHERE NHSnumber=\"" . $nhsNumberVaccine . "\"";
            $connection -> query($queryRemoveVaccine);
        }
    }
}
if (isset($_POST['reg_case'])) {
    $fname =  $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $NHSnum = $_REQUEST['NHSnum'];
    $dob = $_REQUEST['DOB'];
    $address = $_REQUEST['streetAdd'];
    $city = $_REQUEST['city'];
    $postcode = $_REQUEST['postcode'];
    $telephone = $_REQUEST['telephone'];
    $reason = $_REQUEST['reason'];

    if (empty($fname)) { array_push($errorsReg, "First name is required"); }
    if (empty($lname)) { array_push($errorsReg, "Last name is required"); }
    if (empty($NHSnum)) { array_push($errorsReg, "NHS number is required"); }
    if (empty($dob)) { array_push($errorsReg, "Date of birth is required"); }
    if (empty($address)) { array_push($errorsReg, "Address is required"); }
    if (empty($city)) { array_push($errorsReg, "City is required"); }
    if (empty($postcode)) { array_push($errorsReg, "Post code is required"); }
    if (empty($telephone)) { array_push($errorsReg, "Telephone number is required"); }

    if (count($errorsReg) == 0) {
        $queryNHSnum = "SELECT * FROM person WHERE NHSnumber=\"" . $NHSnum . "\"";
        $person = $connection -> query($queryNHSnum) -> fetch(PDO::FETCH_ASSOC);

        if (is_null($person)) {
            array_push($errorsReg, "No NHS record found. Check your NHS number");
        } else {
            $queryCaseExists = "SELECT * FROM activecase WHERE NHSnumber=\"" . $NHSnum . "\"";
            $caseExists = $connection -> query($queryCaseExists) ->fetch(PDO::FETCH_ASSOC);
            if ($caseExists) {
                array_push($errorsReg, "Your case has already been registered with NHS");
            }
            if ($person['firstName']!=$fname or $person['lastName']!=$lname or $person['dateOfBirth']!=$dob or $person['postalCode']!=$postcode or $person['phoneNumber']!=$telephone) {
                array_push($errorsReg, "The details you entered don't match your NHS record");
            }
        }
    }


    if (count($errorsReg) == 0) {
        $queryReasonID = "SELECT reasonID FROM reason WHERE description=\"" . $reason . "\"";
        $reasonID = $connection -> query($queryReasonID) -> fetchColumn();

        $caseID = "AC" . substr($fname, 0, 1) . substr($lname, 0, 1) . substr($NHSnum, 7, 3);

        $queryCaseEntry = "INSERT INTO activecase(caseID, NHSnumber, reasonID, RegistrationDate) ";
        $queryCaseEntry .= "VALUES(\"" . $caseID . "\", \"" . $NHSnum . "\", \"" . $reasonID . "\", \"" . date("Y-m-d") . "\")";
        $connection -> query($queryCaseEntry);

        header('location: Registered.php');
    }

}

?>