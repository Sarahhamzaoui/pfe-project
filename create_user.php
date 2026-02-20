<?php
require "db.php";

$first = "Sarah";
$last = "HAMZAOUI";
$email = "sarahhamz1233d@gmail.com";
$phone = "0699500960";
$role = "Admin";

$password = password_hash("123456", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", $first, $last, $email, $phone, $role, $password);

if ($stmt->execute()) {
    echo "User created successfully";
} else {
    echo "Error: " . $stmt->error;
}
?>
