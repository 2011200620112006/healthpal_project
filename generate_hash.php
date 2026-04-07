<?php
$password = "admin123";  // Change this to your desired password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
echo "Your hashed password is: <br><br>";
echo "<strong>" . $hashed_password . "</strong>";
?>