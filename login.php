<?php
session_start();
require "connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Plain text password check (because signup stores plain text)
    if ($password === $user['password']) {

        // Store user ID in session
        $_SESSION['user'] = $user['id'];

        // ALSO store login in localStorage so pm.html allows rating
        echo "<script>
            localStorage.setItem('loggedInUser', '$email');
            window.location.href = 'pm.html';
        </script>";
        exit();
    }
}

// If login fails
echo "<script>
    alert('Invalid email or password.');
    window.location.href = 'login.html?error=1';
</script>";
exit();
?>
