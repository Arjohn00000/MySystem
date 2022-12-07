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
  <title>ABOUT</title>
    <link rel="stylesheet" href="./css/notes.css">
</head>
<body style="background-image: url('./images/temple.gif'); background-repeat: no-repeat;background-attachment: fixed; background-size: 100% 100%;">
<div class="main_nav_container">
<div id="player">
      <audio controls autoplay hidden>
          <source src="music.ogg" type="audio/ogg">
          <source src="./music/musta.mp3" type="audio/mpeg">
      </audio>
  </div>

    <div class="nav_container">
      <div class="logo">
      <div><img src="./images/mylogo1.png" class="logo"></div>
      </div>
      </div>
     <input type="checkbox" id="click" />
     <div class="top_navbar" >
        <div><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"> HOME&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
        <div><a href="feed.php"><i class="fa fa-rss" aria-hidden="true"> NOTESFEED&nbsp;&nbsp;&nbsp;&nbsp; </i></a></div>
        <div><a href="tinda.php"><i class="fa-brands fa-product-hunt"> PRODUCT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
        <div><a href="home.php"><i class="fa fa-user" aria-hidden="true"> ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
      </div>
      <label for="click" class="menu_btn">
      <i class="fas fa-bars"></i>
    </label>
  </div>
  <div class="title">
    </div>
    <div class="scroll">
        <div class="info"> <?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
            ?>
          <h1>Hello <span><?php echo $fetch['name']; ?></span></h1>
        </div>
        <div class="image-box">
            <table>
                <tbody>
                    <?php
                       include 'config.php';
                       $user_id= $_SESSION['user_id'];
                       $select = "SELECT * from `notes` WHERE user_id= '$user_id' ";                      
                       $query = mysqli_query($conn, $select);                        
                       while($res = mysqli_fetch_array($query)){
                    ?>
                            <tr>
                                <td><p>Posted on <?php echo date("Y-m-d")." ".date("l"); ?></p>
                                <br><?php echo $res['note'];  ?> <br>
                                <br> <a href="updt_notes.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="up-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="del_notes.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="e-btn"><i class="fa-solid fa-trash"></i></a><br><br> end of post
                            </td>
                            </tr>
                            <?php
                            }
                        ?>
                </tbody>
            </table>
        </div>
        <div class="input-msg">
            <?php
                include 'config.php'; 
                $user_id= $_SESSION['user_id'];
                if (isset($_POST['done']))
                {
                    $note = isset($_POST['note'])?$_POST['note']:'';

                    if ($note=="") {
                        echo "<script>alert('Please write something')</script>";
                    }else{
                    $insert = "INSERT INTO `notes` (user_id, note) VALUE('$user_id', '$note')";
                    $query = mysqli_query($conn, $insert);
                        if($query) {
                            header('location:notes.php');
                        }
                        else {
                            echo "error";
                        }
                    }        
                }
            ?>
        <form action="" method="POST">
        <label for="note">How's your day?</label><br>
            <textarea name="note" id="note" placeholder="Write something...(character limit is 255)" cols="50" rows="5"></textarea><br>
            <input type="submit" value="Post" class="done " name="done" id="done">
            <a href="dashboard.php" class="dash"><i class="fa-solid fa-list"></i> Go to Dashboard</a>
        </form>
    </div>
</body>
</html>