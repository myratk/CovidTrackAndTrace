<!--Employee Dummy page, at the end of code has already provided a link to Public_page.php-->
<!--(Contains Heading, table name, introduction sentence, a link in the end)-->


<!--This file is employee page: Some heading-->
<!--@Date 03/07/2021-->
<!--@Author Meishan Liu-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Covid-19 Search System | Staff</title><br>
    <h1>Track and Trace -- Employee Page</h1>
    <meta name="author" content="Null Pointer">
    <meta name="description" content="Staff Page Login">
</head>

<body>

<!--Implement database link here-->
<!-- This part haven't completed, use it anytime required.-->

<!--    --><?php
//        $server = "localhost";
//        $username = "root";
//        $password = "";
//        $database = "";       --> // Implement the database here.
//
//        try {
//            $connection = new PDO("mysql:host=$server; dbname=$database;",$username,$password);
//        }
//
//        catch (PDOException $exception){
//            echo "Our site is maintenance, Sorry about that..";
//            http_response_code(503);
//            die();
//        }
//        ?>

<p>
    Welcome to Covid-19 Track and Trace System
</p>

<!-- The page general introductions here !-->
<!-- This part haven't completed, use it anytime required.-->
<?php
?>

<!-- Implement database related code here !-->
<!-- This part haven't completed, use it anytime required.-->
<?php
?>

<!-- There are some heading displayed below !-->
<table>
    <thead>
    <tr>
        <h2><b>Your personal information:</b><br><br></h2>
        <!--This part is applied for employee individual details-->
    </tr>

    <tr>
        <h2><p1><b>People Management shown below:</b></p1><br><br></h2>
        <th>Patient Name</th><th>Gender</th><th>Status(P/N)</th><th>Contact email</th><th>Telephone</th><th>Address</th><th>Vaccination status</th><th>Appointment status</th>
    </tr>
    </thead>
    <tbody>

    <!-- * Implement the details information of patient function here * -->
    <!-- This part haven't completed, use it anytime required.-->

    <!--            --><?php
    //                foreach ($patient_name as $pn){
    //                    echo "<tr>";
    //                    echo "<td>" . $pn['Patient Name'] . "</td>";
    //                    echo "<td>" . $pn['Gender'] . "</td>";
    //                    echo "<td>" . $pn['Status(P/N)'] . "</td>";
    //                    echo "<td>" . $pn['Contact email'] . "</td>";
    //                    echo "<td>" . $pn['Telephone'] . "</td>";
    //                    echo "<td>" . $pn['Address'] . "</td>";
    //                    echo "<td>" . $pn['Vaccination status'] . "</td>";
    //                    echo "<td>" . $pn['Appointment status'] . "</td>";
    //                    echo "<td><a href=\"public_page.php?id=". $pn['id']. "\"> .</a></td>";
    //                    echo "<td xmlns=\"http://www.w3.org/1999/html\"><a href=''</a></td>"
    //                    echo "</tr>";
    //                }
    //            ?>
    </tbody>
</table>


<!-- Link to public page here-->
<br><a href="Homepage.php">Back to Home Page --> </a>

</body>

</html>

