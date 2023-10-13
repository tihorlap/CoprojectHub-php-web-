<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in (you should implement this part)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: singin.html");
    exit();
}

// Include your database connection file
include 'db_connection.php';

// Fetch user's name based on user ID
$userID = $_SESSION['user_id'];
$sql = "SELECT user_name FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
}

// Fetch user's projects based on user ID
$sql = "SELECT project_name, created_at FROM projects WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$projects = [];

if ($stmt) {
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your HTML head content) ... -->
</head>
<body>
    <!-- ... (your navigation bar and other elements) ... -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class "profile-section">
                    <div>
                        <a href="userpro.html"><?php echo $username; ?></a>
                    </div>
                    <!-- ... (rest of your profile section) ... -->
                </div>
            </div>
            <div class="col-md-8">
                <h2 class="my-projects">My Projects</h2>
                <button class="btn btn-success mb-3">Create New Project</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Project Name</th>
                            <th scope="col">Project Date</th>
                            <th scope="col">Delete Project</th>
                            <th scope="col">Edit Project</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project) : ?>
                            <tr>
                                <td><?php echo $project['project_name']; ?></td>
                                <td><?php echo $project['created_at']; ?></td>
                                <td><button class="btn btn-danger">Delete</button></td>
                                <td><button class="btn btn-warning">Edit</button></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- ... (other dynamic content) ... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
