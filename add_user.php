<?php
// add_user.php - Add your specific user
require_once 'config.php';

// Your user data
$name = "Riya";
$email = "raneriya06@gmail.com";
$password = "yourpassword123"; // Change this to your desired password
$avatar_initial = "R";

// Check if user exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

if (mysqli_num_rows($check) == 0) {
    // Insert your user
    $sql = "INSERT INTO users (name, email, password, avatar_initial, is_active) 
            VALUES ('$name', '$email', '$password', '$avatar_initial', 1)";
    
    if (mysqli_query($conn, $sql)) {
        echo "User created successfully!<br>";
        echo "Email: $email<br>";
        echo "Password: $password<br>";
        echo '<a href="index.php">Click here to login</a>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "User already exists!<br>";
    echo '<a href="index.php">Click here to login</a>';
}
?>