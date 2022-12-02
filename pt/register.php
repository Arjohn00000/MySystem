<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name= mysqli_real_escape_string($conn, $_POST['name']);
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $pass= mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass= mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $image= $_FILES['image']['name'];
    $image_size= $_FILES['image']['size'];
    $image_tmp_name= $_FILES['image']['tmp_name'];
    $image_folder= 'uploaded_img/'.$image;
    
    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE email='$email' AND password='$pass'")or die('query failed');

    if (mysqli_num_rows($select)>0) {
        $error_message[]='User already exist';
    }else {
        if ($pass > 3) {
            $error_message[]='Pasword is too weak!';
        }else if ($pass!=$cpass) {
            $error_message[]='Pasword not matched!';
        }else if ($image_size>2000000) {
            $error_message[]='Image size is too large!';
        }else{
            $insert=mysqli_query($conn, "INSERT INTO `user_form`(name,email,password,image)VALUES('$name','$email','$pass','$image')") or die('query failed!');
                if ($insert) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[]='You are sucessfully registered!';
                    header('location:login.php');
                }else {
                    $error_message[]='Failed to register!';
                }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="form-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Register</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            if (isset($error_message)) {
                foreach ($error_message as $error_message) {
                    echo '<div class="error_message">'.$error_message.'</div>';
                }
            }
            ?>
            <input type="text" name="name" placeholder="Username" class="box" required>
            <input type="email" name="email" placeholder="Email" class="box" required>
            <input type="password" name="password" placeholder="Password" class="box" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" class="box" required>
            <input type="file" class="box" name="image" accept="image/jpg, image/jpeg, image/png">
            <input type="submit" name="submit" value="Register" class="btn">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>