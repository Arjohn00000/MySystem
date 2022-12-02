<?php
include 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $pass= mysqli_real_escape_string($conn, md5($_POST['password']));
    
    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE email='$email' AND password='$pass'")or die('query failed');

    if (mysqli_num_rows($select)>0) {
        $row=mysqli_fetch_assoc($select);
        $_SESSION['user_id']= $row['id'];
        header('location:home.php');
    }else {
        $error_message[]="Invalid Password or Email or Both";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="form-container">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Login</h3>
            <?php
            if (isset($error_message)) {
                foreach ($error_message as $error_message) {
                    echo '<div class="error_message">'.$error_message.'</div>';
                }
            }
            ?>
            <p>Login with your email and password</p>
            <input type="email" name="email" placeholder="Email" class="box" required>
            <input type="password" name="password" placeholder="Password" class="box" required>
            <p><a href="recover_password.php">Forgot password?</a></p>
            <input type="submit" name="submit" value="Login" class="btn">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>

    </div>

</body>
</html>