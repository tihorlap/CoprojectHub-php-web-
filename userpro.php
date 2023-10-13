<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS by linking to a CDN (Content Delivery Network) -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Co_rojectHub</title>
    <style>
        /* Custom CSS for the page */
        body {
            background-color: #f0f0f0;
        }
        .navbar {
            background-color: #333;
            color: white;
        }
        .navbar-brand {
            font-size: 24px;
        }
        .search-bar {
            margin-top: 15px;
        }
        .profile-section {
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            text-align: center;
        }
        .profile-image {
            max-width: 100px;
            border-radius: 50%;
        }
        .profile-logo {
            background-color: #007bff;
            color: white;
            font-size: 24px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
        }
        .profile-options {
            margin-top: 10px;
        }
        .my-projects {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .create-project-btn {
            margin-top: 10px;
        }
        table {
            background-color: white;
        }
        th, td {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.html">Co_projectHub</a>
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-section">
                    <div>  
                        <a href="userpro.html">_rohitpal</a>
                    </div>
                    <img src="img/rohit.png" alt="User Profile" class="profile-image">
                    <div class="profile-options">
                        <button class="btn btn-primary">Change Photo</button>
                        <button class="btn btn-secondary mt-2">Change Username</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h2 class="my-projects">My Projects</h2>
                <button class="btn btn-success mb-3">Create New Project</button>
                <!-- Add this PHP code to fetch and display dynamic project data -->
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
        <?php
        <!--  Replace with your database connection code-->
        $conn = mysqli_connect("localhost", "username", "password", "your_database");

         <!-- Check connection -->
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

         <!-- Query to fetch user's projects (replace 'user_id' with the actual user's ID) -->
        $sql = "SELECT project_name, project_date FROM projects WHERE user_id = 'user_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['project_name'] . "</td>";
                echo "<td>" . $row['project_date'] . "</td>";
                echo '<td><button class="btn btn-danger">Delete</button></td>';
                echo '<td><button class="btn btn-warning">Edit</button></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No projects found</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </tbody>
</table>

            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html> 
