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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="./css/dashboard.css">
  <title>Dasboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
    <div class="hero">
        <nav>
          <img src="./images/mylogo1.png" class="logo">
          <ul>
          <li><a href="#"><i class="fa fa-home" aria-hidden="true"> HOME</i></a></li>
          <li><a href="details.php"><i class="fa-solid fa-address-card"> ABOUT US</i></i></a></li>
          <li><a href="tinda.php"><i class="fa-brands fa-product-hunt"> PRODUCT</i></i></a></li>
          </ul>
          <a href="home.php">
            <img src="./images/opawulo.png" id="icon">
          </a>
        </nav>
        <div class="info"> <?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
            ?>
          <h1>Wow <i class="fa-solid fa-face-surprise"></i>! <span><?php echo $fetch['name']; ?></span>,<br> That's an awesome <br> profile of yours</h1>
          <p><i class="fa-solid fa-music"></i>Yeah, I woke up in the middle of the night
              And I noticed my girl wasn't by my side <br>
              Coulda sworn I was dreamin' for her
              I was feenin' so I had to take a little ride<i class="fa-solid fa-music"></i></p>
          <a href="tinda.php"><i class="fa-brands fa-product-hunt"></i> Go to Bussiness</a>
        </div>
        <div class="image-box">
          <img src="./images/mylogo1.png" class="back-img">
          <h3><?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
                if($fetch['image']==''){
                    echo '<img src="images/default-avatar.png">';
                }else{
                    echo '<img src="uploaded_img/'.$fetch['image'].'">';
                }
            ?></h3>
        </div>
        <div class="my-links">
          <a href="home.php"><i class="fa-solid fa-link"></i></a>
          <a href="https://web.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.google.com/"><i class="fa-solid fa-globe"></i></a>
        </div>
    </div>
</body>
</html>