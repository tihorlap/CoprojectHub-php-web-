<?php
// Include database connection code here
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Hash the password (use appropriate hashing method)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into the database
    $sql = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    
    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful!";
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }
    
    // Close database connection
    $stmt->close();
    $conn->close();
}
?>
