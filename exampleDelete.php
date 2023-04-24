<?php
$servername = "localhost";
$username = "root";
$userpassword = "07084802023";
$dbname = "db";

$conn = new mysqli($servername, $username, $userpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is provided in the AJAX request
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Prepare a delete statement with a parameterized query to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM example WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Success response
        $response = array(
            'status' => 'success',
            'message' => 'User record deleted successfully'
        );
    } else {
        // Error response
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting user record: ' . $stmt->error
        );
    }
    
    $stmt->close();
} else {
    // Error response if user ID is not provided
    $response = array(
        'status' => 'error',
        'message' => 'Error deleting user record: User ID not provided'
    );
}

$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>