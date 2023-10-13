<?php
// Include database connection code here

session_start();

require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Query the database to find the user
    $sql = "SELECT user_id, user_name, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $username, $hashedPassword);
            $stmt->fetch();
            
            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct; set session variables and redirect
                session_start();
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username;
                header("Location: blog.php"); // Redirect to a protected page
            } else {
                // Password is incorrect
                echo "Invalid email or password.";
            }
        } else {
            // User not found
            echo "User not found.";
        }
    } else {
        // Query execution failed
        echo "Error: " . $stmt->error;
    }
    
    // Close database connection
    $stmt->close();
    $conn->close();
}
?>
 