<?php
include 'config.php';
session_start();
if (isset($_POST['forgot_password'])) {
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    
    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE email='$email' ")or die('query failed');

    if (mysqli_num_rows($select)>0) {
        $row=mysqli_fetch_assoc($select);
        $_SESSION['user_id']= $row['id'];
        header('location:verify.php');
    }else {
        $error_message[]="Email doesn't exixt";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="form-container">

    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Forgot Password</h3>
        <?php
        if (isset($error_message)) {
            foreach ($error_message as $error_message) {
                echo '<div class="error_message">'.$error_message.'</div>';
            }
        }
        ?>
        <p>Verify with email</p>
        <input type="email" name="email" placeholder="Email" class="box" required><br>
        <input type="submit" name="forgot_password" value="Verify" class="btn"><a href="login.php" class="back-btn">Back</a>
    </form>
</body>
</html>