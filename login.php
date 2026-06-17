<?php
session_start();
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Fetch user from DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Compare plain password (since you're not hashing yet)
        if ($password === $user["password"]) {

            // SUCCESS — send JS to browser
            echo "<script>
                localStorage.setItem('loggedInUser', '$email');
                window.location.href = 'pm.html';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Invalid email or password.');
                window.location.href = 'login.html';
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('User not found.');
            window.location.href = 'login.html';
        </script>";
        exit;
    }
}
?>
