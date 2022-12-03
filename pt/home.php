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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">

        <div class="profile">
            <?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
                if($fetch['image']==''){
                    echo '<img src="images/default-avatar.png">';
                }else{
                    echo '<img src="uploaded_img/'.$fetch['image'].'">';
                }
            ?>
            <h3>Welcome <?php echo $fetch['name']; ?></h3>
            <a href="update_profile.php" class="up_btn">Update profile</a>
            <a href="home.php?logout=<?php echo $user_id; ?>" class="logout-btn">Logout</a>
            <p>See more <a href="dashboard.php?details=<?php echo $user_id; ?>">Details</a></p>
            <p>Do you want to delete your Account? <a href="delete.php?delete=<?php echo $user_id; ?>">Delete?</a></p>
        </div>
    </div>
</body>
</html>