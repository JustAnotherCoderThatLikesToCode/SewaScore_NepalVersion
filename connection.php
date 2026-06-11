<?php
$host   = "localhost";
$dbname = "u699891582_login";
$dbuser = "u699891582_login";
$dbpass = "A23x$%6^vC";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
