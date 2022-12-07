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
  <link rel="stylesheet" href="./css/details.css">
  <title>ABOUT</title>
    <link rel="stylesheet" href="./css/details.css">
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
        <div><a href="tinda.php"><i class="fa fa-eye" aria-hidden="true"> SEE PRODUCT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
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
        <div class="info"> <?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
            ?>
          <h1>Hellow! <span><?php echo $fetch['name']; ?></span></h1>
            <p>How are you? Are crazy?</p>
            <a href="dashboard.php"><i class="fa-solid fa-list"></i> Go to Dashboard</a>
            <h3><a href="rest.php"><i class="fa-solid fa-bed"></i> Click here</a> If you want to rest!</h3>
        </div>
        </div>
        <div class="image-box">
          <img src="./images/mylogo1.png" class="back-img">
        </div>
        <div class="my-links">
          <a href="home.php"><i class="fa-solid fa-link"></i></a>
          <a href="https://web.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.google.com/"><i class="fa-solid fa-globe"></i></a>
        </div>
    </div>
</body>
</html>