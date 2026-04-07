<?php
require_once 'config.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
    if (empty($_POST['symptom'])) {
        echo "<script>alert('Symptom is required.'); window.history.back();</script>";
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $symptom = trim($_POST['symptom']);
    $severity = isset($_POST['severity']) ? trim($_POST['severity']) : '';
    $date = isset($_POST['symptom_date']) ? trim($_POST['symptom_date']) : '';
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
    
    // Validate user_id is a valid integer
    if (!is_numeric($user_id) || $user_id <= 0) {
        echo "<script>alert('Invalid user ID.'); window.history.back();</script>";
        exit();
    }
    
    // If date is empty, use current date
    if (empty($date)) {
        $date = date('Y-m-d');
    }
    
    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO symptoms (user_id, symptom, severity, symptom_date, notes, created_at) 
              VALUES (?, ?, ?, ?, ?, NOW())";
    
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "issss", $user_id, $symptom, $severity, $date, $notes);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php#symptoms");
            exit();
        } else {
            echo "<script>alert('Error adding symptom: " . mysqli_error($conn) . "'); window.history.back();</script>";
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Database error: " . mysqli_error($conn) . "'); window.history.back();</script>";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>