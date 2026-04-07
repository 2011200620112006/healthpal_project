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
    // Validate required fields
    if (empty(trim($_POST['contact_name'])) || empty(trim($_POST['contact_phone']))) {
        echo "<script>alert('Contact name and phone are required.'); window.history.back();</script>";
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $contact_name = trim($_POST['contact_name']);
    $contact_phone = trim($_POST['contact_phone']);
    $current_time = date('Y-m-d H:i:s');
    
    // Phone number validation (basic)
    if (!preg_match('/^[0-9+\-\s]+$/', $contact_phone)) {
        echo "<script>alert('Please enter a valid phone number.'); window.history.back();</script>";
        exit();
    }
    
    // Insert contact with created_at timestamp
    $query = "INSERT INTO emergency_contacts (user_id, contact_name, contact_phone, created_at) 
              VALUES ('$user_id', '$contact_name', '$contact_phone', '$current_time')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect back to index
        header("Location: index.php#emergency");
        exit();
    } else {
        $error = mysqli_error($conn);
        echo "<script>alert('Error adding contact: " . addslashes($error) . "'); window.history.back();</script>";
        exit();
    }
} else {
    // If not a POST request, redirect to index
    header("Location: index.php");
    exit();
}
?>