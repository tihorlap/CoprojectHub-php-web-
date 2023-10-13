
 <!-- html page for posting the blogs -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co-projectHub</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">Co-projectHub</a>
            
            <!-- Mobile Toggle Button (Hamburger) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Search Bar (Right Aligned) -->
            <div class="d-none d-lg-flex ml-auto">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
    
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contectus.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="singin.html">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
   

<?php
// Database connection code here
require_once("db_connection.php");

// Check if the user is logged in
session_start(); // Start the session if not already started
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page or display a message
    header("Location: singin.html"); // Replace "login.php" with your login page
    exit();
}



// Handle blog post submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_SESSION["user_id"]; // Assuming the user is logged in

    // Insert the blog post into the database
    $sql = "INSERT INTO blog_posts (title, content, author, publication_date) VALUES (?, ?, ?, NOW())"; // Use NOW() to set the current date and time
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $content, $author);
    if ($stmt->execute()) {
        // Blog post successfully added
        header("Location: blog.php"); // Redirect to the blog page
        exit();
    } else {
        // Error handling
        echo "Error adding the blog post.";
    }
}

// Retrieve and display blog posts
$sql = "SELECT id, title, content, author, publication_date FROM blog_posts ORDER BY publication_date DESC"; // Retrieve posts in descending order
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>" . $row["content"] . "</p>";
        echo "<p>Author: " . $row["author"] . "</p>";
        echo "<p>Published on: " . $row["publication_date"] . "</p>";
        // Display comments here
    }
} else {
    echo "No blog posts found.";
}
?>
    
   <!-- HTML form to submit a blog post -->
   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Post a Blog</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Blog Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your blog title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Blog Content</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Write your blog content" rows="6" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit Blog Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <footer class="bg-dark text-light mt-5">
        <div class="container py-3">
            <p>&copy; 2023 Co-rojectHub</p>
            <p>1234 , kanpur, india</p>
            <p>Email: co-projectHub@gmail.com</p>
            <p>Phone: +738 058 6748</p>
            <p>Follow us on social media: <a href="https://www.linkedin.com/in/rohitpal21">linkdin</a>, <a href="https://twitter.com/rp3822035">Twitter</a>, <a href="https://www.instagram.com/rohitpal3855/">Instagram</a></p>
        </div>
    </footer>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 