<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "connection.php";

// ⭐ 1. Get POST data safely
$proxy    = trim($_POST['proxy'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// ⭐ 2. Basic validation (optional but recommended)
if ($proxy === '' || $phone === '' || $email === '' || $password === '') {
    die("All fields are required.");
}

// ⭐ 3. Prepare SQL insert
$sql = "INSERT INTO users (proxy, phone, email, password)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $proxy, $phone, $email, $password);

// ⭐ 4. Execute + redirect
if ($stmt->execute()) {
    header("Location: pm.html");
    exit();
} else {
    die("Signup failed: " . $stmt->error);
}

?>
