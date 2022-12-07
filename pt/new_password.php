<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
</head>
<body>
<div class="form-container">

<form action="login.php" method="POST" enctype="multipart/form-data">
    <h3>Forgot Password</h3>
    <?php
    if (isset($error_message)) {
        foreach ($error_message as $error_message) {
            echo '<div class="error_message">'.$error_message.'</div>';
        }
    }
    ?>
    <p>Verify with email</p>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
    <input type="submit" name="change_password" value="Save">
</body>
</html>