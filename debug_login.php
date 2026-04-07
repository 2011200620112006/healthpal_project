<?php
// debug_login.php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'healthpal';

$conn = mysqli_connect($host, $username, $password, $database);

echo "<h1>Debug Login</h1>";

// Test connection
if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}
echo "Database connected successfully!<br><br>";

// Test query
$test_email = "test@test.com";
$test_password = "test123";

$query = "SELECT * FROM users WHERE email = '$test_email' AND password = '$test_password'";
echo "Query: $query<br>";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Query error: " . mysqli_error($conn) . "<br>";
} else {
    echo "Rows found: " . mysqli_num_rows($result) . "<br>";
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        echo "<pre>";
        print_r($user);
        echo "</pre>";
    } else {
        echo "No user found with those credentials.<br>";
        
        // Show all users
        echo "<h3>All users in database:</h3>";
        $all_users = mysqli_query($conn, "SELECT id, name, email FROM users");
        while ($row = mysqli_fetch_assoc($all_users)) {
            echo "ID: {$row['id']}, Name: {$row['name']}, Email: {$row['email']}<br>";
        }
    }
}
?>