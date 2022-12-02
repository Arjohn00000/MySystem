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
  <title>Details</title>
  <link rel="stylesheet" href="./css/details.css">
</head>
<body>
    <div class="container">

        <div class="profile">
        <h3><i><a href="home.php"><?php
                $user_id= $_SESSION['user_id'];
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
                if($fetch['image']==''){
                    echo '<img src="images/default-avatar.png">';
                }else{
                    echo '<img src="uploaded_img/'.$fetch['image'].'">';
                }
            ?></a></i></h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>See <a href="tinda.php?delete=<?php $user_id= $_SESSION['user_id']; echo $user_id; ?>">Business</a></p>
        </div>
    </div>
</body>
</html>