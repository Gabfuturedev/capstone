<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the ID and status from POST request
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    // Prepare the SQL query to update the status in the database
    $sql = "UPDATE contbl SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $status, $id);
    
    // Execute the query and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
