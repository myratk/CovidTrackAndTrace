<!--This file is applied for creating database link-->
<!--Haven't completed, just a reference-->
<!--@Date 03/07/2021-->
<!--@Author Meishan Liu-->



<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "";  // Please change database name here

try {
    $connection = new PDO("mysql:host=$server; dbname=$database;",$username,$password);
}

catch (PDOException $exception){
    echo "Our site is maintenance, Sorry about that..";
    http_response_code(503);
    die();
}