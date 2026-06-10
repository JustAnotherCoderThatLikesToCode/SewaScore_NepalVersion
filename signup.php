<?php
// CONNECT TO DATABASE
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "sewascore"; // <-- make sure this matches your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET FORM DATA
$user = $_POST['username'];
$pass = $_POST['password'];
$phone = $_POST['phone'];
$proxy = $_POST['proxy'];

// PREVENT EMPTY VALUES
if (empty($user) || empty($pass) || empty($phone) || empty($proxy)) {
    die("All fields are required.");
}

// INSERT INTO DATABASE
$sql = "INSERT INTO users (username, password, phone, proxy) 
        VALUES ('$user', '$pass', '$phone', '$proxy')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful!";
} else {
    echo "Error: " . $conn->error;
}
header("Location: pm.html");
exit();
$conn->close();
?>
