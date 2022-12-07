<?php
include 'config.php';
session_start();
$user_id= $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:./login.php');
}

if (isset($_POST['update_profile'])) {
    $update_name= mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email= mysqli_real_escape_string($conn, $_POST['update_email']);

    mysqli_query($conn, "UPDATE `user_form` SET name='$update_name', email='$update_email' WHERE id='$user_id'") or die('query failed');

    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));
 
    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
       if ($update_pass != $old_pass) {
            $error_message[]='Old password not matched!';
        }elseif ($update_pass==$new_pass) {
            $error_message[]='This is your old password please use another password';
        }elseif ($confirm_pass != $new_pass) {
            $error_message[]='Your new Password does not matched!';
        }elseif ($confirm_pass > 3 ) {
            $error_message[]='Password too short';
        }else {
        mysqli_query($conn, "UPDATE `user_form` SET password='$confirm_pass' WHERE id='$user_id'") or die('query failed');
            $message[]='Password updated succesfully!';
        }
    }
    $update_image= $_FILES['update_image']['name'];
    $update_image_size= $_FILES['update_image']['size'];
    $update_image_tmp_name= $_FILES['update_image']['tmp_name'];
    $update_image_folder= 'uploaded_img/'.$update_image;

    if (!empty($update_image)) {
        if($update_image_size > 2000000){
            $error_message[]='Image size is too large!';
        }else{
            $update_image_query= mysqli_query($conn, "UPDATE `user_form` SET image='$update_image' WHERE id='$user_id'") or die('query failed');
            if ($update_image_query) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
            $message[]='Uploaded succesfully!';
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
  <title>Update profile</title>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body style="background-image: url('./images/temple.gif'); background-repeat: no-repeat;background-attachment: fixed; background-size: 100% 100%;">
    <div class="update_profile">
    <?php
        $user_id= $_SESSION['user_id'];
        $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
        if(mysqli_num_rows($select)>0){
            $fetch=mysqli_fetch_assoc($select);
        }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
            if($fetch['image']==''){
                echo '<img src="images/default-avatar.png">';
            }else{
                echo '<img src="uploaded_img/'.$fetch['image'].'">';
            }
            if (isset($error_message)) {
                foreach ($error_message as $error_message) {
                    echo '<div class="error_message">'.$error_message.'</div>';
                }
            }
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?><div id="player">
                <audio controls autoplay hidden>
                    <source src="music.ogg" type="audio/ogg">
                    <source src="./music/update_profile.mp3" type="audio/mpeg">
                </audio>
            </div>
        <div class="flex">
            <div class="inputBox">
                <span>Username :</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
                <span>Email :</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
                <span>Update profile picture :</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                <span>Current password :</span>
                <input type="password"  name="update_pass"  class="box" >
                <span>Enter New password :</span>
                <input type="password"  name="new_pass" class="box" >
                <span>Confirm New password :</span>
                <input type="password"  name="confirm_pass" class="box" >
            </div>
        </div>
        <input type="submit" name="update_profile" value="Update now" class="btn">
        <a href="home.php" class="back-btn">Back</a>
    </form>
    </div>
</body>
</html>