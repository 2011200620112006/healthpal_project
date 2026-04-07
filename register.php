<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php';

echo "<h3>Registration Debug:</h3>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Password: $password<br>";
    echo "Confirm: $confirm_password<br><br>";
    
    // Check if user already exists
    $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
    echo "Users with this email: " . $check->num_rows . "<br>";
    
    if ($check->num_rows > 0) {
        die("❌ Email already exists!");
    }
    
    // Insert new user
    $avatar_initial = strtoupper(substr($name, 0, 1));
    $sql = "INSERT INTO users (name, email, password, avatar_initial) 
            VALUES ('$name', '$email', '$password', '$avatar_initial')";
    
    echo "SQL: $sql<br>";
    
    if ($conn->query($sql)) {
        echo "✅ SUCCESS! User created with ID: " . $conn->insert_id . "<br>";
        
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        
        echo "Session set. Redirecting...";
        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
    } else {
        echo "❌ ERROR: " . $conn->error;
    }
} else {
    echo "No POST data received!";
}
?>