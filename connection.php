<?php
// connection.php

$host   = "localhost";
$dbname = "u699891582_login";   // your Hostinger DB name
$dbuser = "u699891582_login";   // your Hostinger DB username
$dbpass = "Q8!vR3#tM7@pL2$zN9xK6%hF4";  // your Hostinger DB password

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
