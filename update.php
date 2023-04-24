<?php
// update.php

$servername = "localhost";
$username = "root";
$userpassword = "07084802023";
$dbname = "db";

$conn = new mysqli($servername, $username, $userpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// Perform validation and sanitization on $name and $email as needed

// Update the user record in the database
$stmt = $conn->prepare("UPDATE usersdb SET name=?, email=? WHERE id=?");
$stmt->bind_param("ssi", $name, $email, $id);

if ($stmt->execute()) {
    // Return success status and message
    $response = array('status' => 'success', 'message' => 'User record updated successfully');
} else {
    // Return error status and message
    $response = array('status' => 'error', 'message' => 'Failed to update user record');
}

$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
