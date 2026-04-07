<?php
require_once 'config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input
    if (empty(trim($_POST['entry']))) {
        echo "<script>alert('Journal entry cannot be empty.'); window.history.back();</script>";
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $entry = mysqli_real_escape_string($conn, $_POST['entry']);
    $current_time = date('Y-m-d H:i:s');
    
    // Insert journal entry with created_at timestamp
    $query = "INSERT INTO journal (user_id, entry, created_at) VALUES ('$user_id', '$entry', '$current_time')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect back to index
        header("Location: index.php#journal");
        exit();
    } else {
        echo "<script>alert('Error saving journal entry: " . mysqli_error($conn) . "'); window.history.back();</script>";
        exit();
    }
} else {
    // If not a POST request, redirect to index
    header("Location: index.php");
    exit();
}
?>