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
  <link rel="stylesheet" href="./css/feed.css">
  <title>Notesfeed</title>
</head>
<body style="background-image: url('./images/temple.gif'); background-repeat: no-repeat;background-attachment: fixed; background-size: 100% 100%;">
<div class="main_nav_container">
    <div class="nav_container">
    <div class="logo">
      <div><img src="./images/mylogo1.png" class="logo"></div>
      </div>
      <div id="player">
                <audio controls autoplay hidden>
                    <source src="music.ogg" type="audio/ogg">
                    <source src="./music/notesfeed.mp3" type="audio/mpeg">
                </audio>
            </div>
      </div>
     <input type="checkbox" id="click" />
     <div class="top_navbar" >
        <div><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"> HOME&nbsp;&nbsp;&nbsp;&nbsp; </i></a></div>
        <div><a href="notes.php"><i class="fa fa-book" aria-hidden="true"> ADD NOTES&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
        <div><a href="tinda_display.php"><i class="fa fa-shopping-cart" aria-hidden="true"> BUY PRODUCT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
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
                <?php
                       include 'config.php';
                       $select = "SELECT * from `notes`";                      
                       $query = mysqli_query($conn, $select);                        
                       while($res = mysqli_fetch_array($query)){
                    ?>
                            <tr>
                                <td>
                                    <div class="scroll">
                                      <p>Posted by <?php echo $res['user_id'];  ?> on <?php echo date("Y-m-d")." ".date("l"); ?>
                                    <br><br><i class="fa-solid fa-arrow-right"></i> <?php echo $res['note'];  ?></p> <br>
                                      </p>
                                    </div>
                                </td>
                            </tr>
                            <?php
                       }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>