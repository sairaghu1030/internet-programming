<?php
include 'process.php';
if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $address = $_POST['address'];
    $country = $_POST['country'];

    $query = "INSERT INTO travelers (fullname, email, phone, username, password, address, country) VALUES ('$fullname', '$email', '$phone', '$username', '$password', '$address', '$country')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect to login page after successful registration
        header("Location: index.html");
        exit(); // Make sure to call exit after header
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
