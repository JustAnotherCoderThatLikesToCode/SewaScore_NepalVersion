<?php

header("Content-Type: application/json");

$conn = new mysqli(
    "localhost",
    "u699891582_login",
    "A23x$%6^vC",
    "u699891582_login"
);

if ($conn->connect_error) {
    die(json_encode([
        "success" => false,
        "message" => "Database connection failed"
    ]));
}

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"];
$rating = intval($data["rating"]);
$comment = $data["comment"];

/* Find user id */
$stmt = $conn->prepare(
    "SELECT id FROM users WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "User not found"
    ]);
    exit;
}

$user = $result->fetch_assoc();

$userId = $user["id"];

/* Prime Minister */
$bureaucratId = 1;

/* Save rating */
$stmt = $conn->prepare(
    "INSERT INTO ratings
    (user_id, bureaucrat_id, rating, comment)
    VALUES (?, ?, ?, ?)"
);

$stmt->bind_param(
    "iiis",
    $userId,
    $bureaucratId,
    $rating,
    $comment
);

$success = $stmt->execute();

echo json_encode([
    "success" => $success
]);
?>