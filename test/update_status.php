<?php
session_start();
include 'conn.php';

// Check if ID and status are set and not empty
if (isset($_POST['id'], $_POST['status'])) {
    // Sanitize input to prevent SQL injection
    $id = intval($_POST['id']);
    $status = intval($_POST['status']); // Assuming status is either 0 or 1

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE contbl SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $id);
    if ($stmt->execute()) {
        // Update successful
        $response = array("success" => true);
    } else {
        // Error occurred
        $response = array("success" => false, "error" => "Error updating status: " . $conn->error);
    }
} else {
    // If ID or status is not set or empty, return an error message
    $response = array("success" => false, "error" => "Invalid request");
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>