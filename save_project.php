<?php
// Include your database connection file
include 'db_connection.php';

// Start or resume the session
session_start();

if (isset($_SESSION['user_id'])) {
    // User is logged in, proceed to save the project
    $data = json_decode(file_get_contents("php://input"));

    if ($data) {
        $projectName = $data->projectName; // Include project name
        $htmlCode = $data->html;
        $cssCode = $data->css;
        $jsCode = $data->js;

        // Get the user's ID from the session
        $userId = $_SESSION['user_id'];

        // Insert the project data into the database, associating it with the user
        $sql = "INSERT INTO projects (project_name, html_code, css_code, js_code, user_id_fk) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssi", $projectName, $htmlCode, $cssCode, $jsCode, $userId);
            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Project data is successfully saved.'];
            } else {
                $response = ['success' => false, 'message' => 'Error saving project data: ' . $stmt->error];
            }
            $stmt->close();
        } else {
            $response = ['success' => false, 'message' => 'Error preparing statement: ' . $conn->error];
        }
    } else {
        $response = ['success' => false, 'message' => 'No data received from the client.'];
    }
} else {
    $response = ['success' => false, 'message' => 'You are not logged in. Please log in to save a project.'];
}

echo json_encode($response);
?>
