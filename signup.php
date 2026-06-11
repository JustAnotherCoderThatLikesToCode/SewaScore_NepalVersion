<?php
require "connection.php";

$proxy = $_POST['proxy'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "INSERT INTO users (proxy, phone, email, password)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $proxy, $phone, $email, $password);

if ($stmt->execute()) {
    header("Location: pm.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
