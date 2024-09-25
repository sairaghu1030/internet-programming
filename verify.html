<?php
session_start();
include 'process.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to check for the username
    $sql = "SELECT * FROM travelers WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, verify the password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Successful login, set session and redirect to the explore page
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'user'; // Set a default role or based on the database
            header("Location: explore.html"); // Redirect to the explore page
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Invalid password. Please try again.'); window.location.href = 'login.html';</script>";
        }
    } else {
        // No user found
        echo "<script>alert('No account found with that username. Please register.'); window.location.href = 'register.html';</script>";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
