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
$errors = array();

global $connection;
require 'connect.php';

error_reporting(E_ALL);

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

    if (empty($fname)) { array_push($errors, "First name is required"); }
    if (empty($lname)) { array_push($errors, "Last name is required"); }
    if (empty($NHSnum)) { array_push($errors, "NHS number is required"); }
    if (empty($dob)) { array_push($errors, "Date of birth is required"); }
    if (empty($address)) { array_push($errors, "Address is required"); }
    if (empty($city)) { array_push($errors, "City is required"); }
    if (empty($postcode)) { array_push($errors, "Post code is required"); }
    if (empty($telephone)) { array_push($errors, "Telephone number is required"); }

    if (count($errors) == 0) {
        $queryNHSnum = "SELECT * FROM person WHERE NHSnumber=\"" . $NHSnum . "\"";
        $person = $connection -> query($queryNHSnum) -> fetch(PDO::FETCH_ASSOC);

        if (is_null($person)) {
            array_push($errors, "No NHS record found. Check your NHS number");
        } else {
            $queryCaseExists = "SELECT * FROM activecase WHERE NHSnumber=\"" . $NHSnum . "\"";
            $caseExists = $connection -> query($queryCaseExists) ->fetch(PDO::FETCH_ASSOC);
            if ($caseExists) {
                array_push($errors, "Your case has already been registered with NHS");
            }
            if ($person['firstName']!=$fname or $person['lastName']!=$lname or $person['dateOfBirth']!=$dob or $person['postalCode']!=$postcode or $person['phoneNumber']!=$telephone) {
                array_push($errors, "The details you entered don't match your NHS record");
            }
        }
    }


    if (count($errors) == 0) {
        $queryReasonID = "SELECT reasonID FROM reason WHERE description=\"" . $reason . "\"";
        $reasonID = $connection -> query($queryReasonID) -> fetchColumn();

        $queryTotalCases = "SELECT COUNT(*) FROM activecase";
        $totalCases = ($connection -> query($queryTotalCases) -> fetchColumn()) + 1;
        $caseID = "AC" . substr($fname, 0, 1) . substr($lname, 0, 1) . $totalCases;

        $queryCaseEntry = "INSERT INTO activecase(caseID, NHSnumber, reasonID, RegistrationDate) ";
        $queryCaseEntry .= "VALUES(\"" . $caseID . "\", \"" . $NHSnum . "\", \"" . $reasonID . "\", \"" . date("Y-m-d") . "\")";
        $connection -> query($queryCaseEntry);

        header('location: Registered.php');
    }

}

?>