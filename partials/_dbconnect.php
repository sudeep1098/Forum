<?php

// $server = "sql300.infinityfree.com";
// $username = "if0_35114806";
// $password = "9WS0qgEurM";
// $database = "if0_35114806_idiscuss";
$server = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("failed to connect to db");
}
