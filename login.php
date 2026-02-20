<?php
session_start();
header("Content-Type: application/json");

// Show errors (REMOVE in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require "db.php";

// Check if connection exists
if (!isset($conn)) {
    echo json_encode(["message" => "Database connection error"]);
    exit;
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!$data || empty($data['email']) || empty($data['password'])) {
    echo json_encode(["message" => "Email and password required"]);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);

// Prepare statement
$stmt = $conn->prepare("SELECT userID, first_name, role, password FROM users WHERE email = ?");
if (!$stmt) {
    echo json_encode(["message" => "Query preparation failed"]);
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["message" => "User not found"]);
    exit;
}

$user = $result->fetch_assoc();

// Verify password
if (!password_verify($password, $user['password'])) {
    echo json_encode(["message" => "Invalid password"]);
    exit;
}

// Store session
$_SESSION["userID"] = $user["userID"];
$_SESSION["first_name"] = $user["first_name"];
$_SESSION["role"] = $user["role"];

// Success response
echo json_encode([
    "message" => "Login successful",
    "user" => [
        "userID" => $user["userID"],
        "first_name" => $user["first_name"],
        "role" => $user["role"]
    ]
]);

exit;
?>