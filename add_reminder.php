<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_SESSION['user_id'];
    $medication = mysqli_real_escape_string($conn, $_POST['medication']);
    $reminder_time = mysqli_real_escape_string($conn, $_POST['reminder_time']);

    // Correct column names
    $query = "INSERT INTO reminders (user_id, medication, reminder_time)
              VALUES ('$user_id', '$medication', '$reminder_time')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php#medication");
        exit();
    } else {
        echo "<script>alert('Error adding reminder: " . mysqli_error($conn) . "'); window.history.back();</script>";
        exit();
    }
}
header("Location: index.php");
exit();
?>
