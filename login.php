<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    echo "<h3>Debug Info:</h3>";
    echo "Email entered: <strong>$email</strong><br>";
    echo "Password entered: <strong>$password</strong><br><br>";

    if (empty($email) || empty($password)) {
        die("Email & password required");
    }

    // Check database
    $check_sql = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
    $result = $conn->query($check_sql);
    $row = $result->fetch_assoc();
    echo "Users with this email in DB: " . $row['count'] . "<br>";

    // Fetch user
    $stmt = $conn->prepare(
        "SELECT id, name, email, password, avatar_initial
         FROM users
         WHERE email = ?"
    );

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Rows found: " . $result->num_rows . "<br>";
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        echo "<h4>User found:</h4>";
        echo "ID: " . $user['id'] . "<br>";
        echo "Name: " . $user['name'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Password in DB: " . $user['password'] . "<br>";
        echo "Password entered: $password<br>";
        
        // Compare passwords
        if ($password === $user['password']) {
            echo "<span style='color:green;'>✅ Password matches!</span><br>";
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_avatar'] = $user['avatar_initial'];
            
            echo "Session variables set:<br>";
            echo "- user_id: " . $_SESSION['user_id'] . "<br>";
            echo "- user_name: " . $_SESSION['user_name'] . "<br>";
            
            echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
            echo "Redirecting to index.php in 2 seconds...";
            exit();
        } else {
            echo "<span style='color:red;'>❌ Password DOES NOT match!</span><br>";
            echo "DB password: '" . $user['password'] . "'<br>";
            echo "Entered password: '$password'<br>";
            echo "Are they equal? " . ($password === $user['password'] ? 'YES' : 'NO');
        }
    } else {
        echo "<span style='color:red;'>❌ No user found with that email!</span><br>";
        
        // Show all users
        echo "<h4>All users in database:</h4>";
        $all = $conn->query("SELECT id, name, email FROM users");
        while($row = $all->fetch_assoc()) {
            echo "- ID: " . $row['id'] . " | Name: " . $row['name'] . " | Email: " . $row['email'] . "<br>";
        }
    }

    echo "<br><a href='javascript:history.back()'>Go back</a>";
    exit();
}
?>