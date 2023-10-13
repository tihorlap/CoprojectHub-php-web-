<?php
// Include your database connection code here
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $message = $_POST["message"];

    // Validate and sanitize data (e.g., using mysqli_real_escape_string)
    // Insert data into the database
    $sql = "INSERT INTO contact_submissions (name, phone, address, message) VALUES ('$name', '$phone', '$address', '$message')";

    // Execute the SQL query (assuming you have a database connection)
    if (mysqli_query($conn, $sql)) {
        echo "Submission successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
