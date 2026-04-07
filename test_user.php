<?php
// test_user.php
require_once 'config.php';

// Add a test user directly
$name = "Test User";
$email = "test@test.com";
$password = "test123";
$avatar_initial = "T";

// Check if user exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

if (mysqli_num_rows($check) == 0) {
    // Insert test user
    $sql = "INSERT INTO users (name, email, password, avatar_initial, is_active) 
            VALUES ('$name', '$email', '$password', '$avatar_initial', 1)";
    
    if (mysqli_query($conn, $sql)) {
        echo "Test user created successfully!<br>";
        echo "Email: test@test.com<br>";
        echo "Password: test123<br>";
        echo '<a href="index.php">Click here to login</a>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Test user already exists!<br>";
    echo "Try logging in with:<br>";
    echo "Email: test@test.com<br>";
    echo "Password: test123<br>";
    echo '<a href="index.php">Click here to login</a>';
}

// Show all users
echo "<hr><h3>All users in database:</h3>";
$result = mysqli_query($conn, "SELECT id, name, email FROM users");
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Email: {$row['email']}<br>";
}
?>