<?php
session_start();
include 'process.php'; // Database connection file

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit();
}

// Retrieve user data from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM travelers WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc(); // Fetch user data
} else {
    echo "User not found!";
    exit();
}

// Close the database connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | TrailWings</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #333;
            background-color: #f0f8ff; /* Light blue background */
        }

        header {
            background-color: #4CAF50;
            padding: 30px; /* Increased padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        .logo {
            color: white;
            font-size: 30px; /* Increased font size */
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px; /* Space between icon and text */
            font-size: 32px; /* Increase icon size */
        }

        .search-container {
            display: flex;
            align-items: center;
            flex-grow: 1;
            margin: 0 20px; /* Add space between logo and search bar */
        }

        .search-container input {
            padding: 10px;
            border-radius: 20px;
            border: none;
            outline: none;
            margin-right: 5px;
            border: 2px solid white;
            width: 100%; /* Full width for input */
            max-width: 300px; /* Limit width for input */
        }

        .search-container button {
            padding: 10px 15px;
            border: none;
            background-color: white;
            color: #4CAF50;
            border-radius: 20px;
            cursor: pointer;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 20px; /* Increased font size for links */
            display: flex;
            align-items: center;
            padding: 10px 15px; /* Add padding to prevent cutoff */
            transition: color 0.3s, transform 0.3s; /* Transition effect */
        }

        .nav-links a i {
            margin-right: 5px;
        }

        .nav-links a:hover {
            color: #f0f8ff; /* Change color on hover */
            transform: scale(1.1); /* Slightly enlarge on hover */
        }

        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header i {
            font-size: 50px; /* Size of the user icon */
            margin-right: 20px;
            color: #4CAF50; /* Icon color */
        }

        .profile-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .section {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .section h2 i {
            margin-right: 10px;
        }

        .info-item {
            width: 100%;
            margin-bottom: 15px;
        }

        .edit-button {
            text-align: right;
        }

        .edit-button button,
        .settings-button,
        .bookings-button,
        .logout-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            transition: background-color 0.3s, transform 0.2s;
        }

        .edit-button button:hover,
        .settings-button:hover,
        .bookings-button:hover,
        .logout-button:hover {
            background-color: #45a049; /* Darker green on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
        }

    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <i class='bx bxs-plane'></i> <!-- Logo icon -->
            TrailWings
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>
        <div class="nav-links">
            <a href="index.html">
                <i class='bx bxs-home'></i> Home
            </a>
            <a href="guide.html">
                <i class='bx bxs-compass'></i> Discover
            </a>
            <a href="wishlist.php">
                <i class='bx bxs-heart'></i> Wishlist
            </a>
            <a href="profile.php">
                <i class='bx bxs-user'></i> Profile
            </a>
        </div>
    </header>

    <!-- Profile Container -->
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <i class='bx bxs-user-circle'></i> <!-- User icon -->
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        </div>

        <!-- Personal Information Section -->
        <div class="section profile-info">
            <h2><i class='bx bxs-info-circle'></i> Personal Information</h2>
            <div class="info-item">
                <p><i class='bx bxs-envelope'></i>
                 <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><i class='bx bxs-phone'></i>
                <strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                <p><i class='bx bxs-map'></i>
                <strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            </div>
            <div class="edit-button">
                <button>Edit Profile</button>
            </div>
        </div>

        <!-- My Bookings Section as Button -->
        <div class="section profile-bookings">
            <a href="my_bookings.php" class="bookings-button">My Bookings</a>
        </div>

        <!-- Settings Section as Button -->
        <div class="section profile-settings">
            <a href="settings.php" class="settings-button">Settings</a>
        </div><br>
        
        <!-- Logout Section as Button -->
        <div class="section profile-logout">
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
        
    </div>

    <footer>
        <p>&copy; 2024 TrailWings. All Rights Reserved.</p>
    </footer>

</body>
</html>
