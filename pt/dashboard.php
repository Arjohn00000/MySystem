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
</head>
<body style="background-image: url('./images/temple.gif'); background-repeat: no-repeat;background-attachment: fixed; background-size: 100% 100%;">
    <div class="main_nav_container">
    <div class="nav_container">
      <div class="logo">
      <div><img src="./images/mylogo1.png" class="logo"></div>
      </div>
      </div>
     <input type="checkbox" id="click" />
     <div class="top_navbar" >
        <div><a href="feed.php"><i class="fa fa-rss" aria-hidden="true"> NOTESFEED&nbsp;&nbsp;&nbsp;&nbsp; </i></a></div>
        <div><a href="notes.php"><i class="fa fa-book" aria-hidden="true"> ADD NOTES&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
        <div><a href="tinda.php"><i class="fa-brands fa-product-hunt"> PRODUCT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
        <div><a href="home.php"><i class="fa fa-user" aria-hidden="true"> ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
      </div>
      <label for="click" class="menu_btn">
      <i class="fas fa-bars"></i>
    </label>
  </div>
  <div class="title">
            <table>
                <thead>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="scroll">
    <div id="player">
                <audio controls autoplay hidden>
                    <source src="music.ogg" type="audio/ogg">
                    <source src="./music/hello.mp3" type="audio/mpeg">
                </audio>
            </div>
        <div class="info"> <?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
            ?>
          <h1>Wow <i class="fa-solid fa-face-surprise"></i>! <span><?php echo $fetch['name']; ?></span>,<br> That's an awesome <br> profile of yours</h1>
          <p>Hello guys, hehe <i class="fa-solid fa-face-grin-tears"></i></p>
          <a href="details.php"><i class="fa fa-info-circle" aria-hidden="true"></i> Other Details</a>
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