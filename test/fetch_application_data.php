<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Query to get data based on ID
        $stmt = $conn->prepare("SELECT firstName, lastName, email, conNum, date, status, appLetter, cv, picture, valId FROM contbl WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            // Format the response as JSON
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'No data found'
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid ID'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}

$conn->close();
?>
