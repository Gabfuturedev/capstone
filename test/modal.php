<?php
include 'conn.php';

$file_paths = array();

// Check if $_GET['id'] is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID from $_GET
    $id = $_GET['id'];
    
    // Prepare SQL query to fetch image file paths
    $sql_files = "SELECT appLetter, cv, picture, valId FROM contbl WHERE id = ?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql_files);
    
    // Bind the parameter
    $stmt->bind_param("i", $id);
    
    // Execute SQL query
    $stmt->execute();
    
    // Get the result
    $result_files = $stmt->get_result();
    
    // Check if any rows were returnedA
    if ($result_files->num_rows > 0) {
        // Fetch the row
        $row = $result_files->fetch_assoc();
        // Store image file paths in the $file_paths array
        $file_paths['appLetter'] = $row['appLetter'];
        $file_paths['cv'] = $row['cv'];
        $file_paths['picture'] = $row['picture'];
        $file_paths['valId'] = $row['valId'];
    } else {
        // No records found for the given ID
        echo "No records found for ID: $id";
    }

    // Close the statement
    $stmt->close();
} else {
    // ID is not set or empty
    echo "ID is not set or empty.";
}
?>