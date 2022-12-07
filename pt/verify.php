<?php
include 'config.php';
session_start();
$user_id= $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Verify Password</title>
</head>
<body>
<div class="form-container">

<form action="home.php" method="POST" enctype="multipart/form-data">
    <h3>Email</h3>
    <?php
        $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
        if(mysqli_num_rows($select)>0){
            $fetch=mysqli_fetch_assoc($select);
        }
    ?>
    <p>This is your encrypt password</p><br>
    <?php echo $fetch['password']; ?><br><br>
    <p>Do you want to login?</p><br>
    <a href="home.php" class="up_btn">Yes</a> <a href="login.php" class="back-btn">No</a>
</body>
</html>