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
    <link rel="stylesheet" href="./css/details.css">
</head>
<body>
    <div class="hero">
        <nav>
          <img src="./images/mylogo1.png" class="logo">
          <ul>
            <li><a href="notes.php" class="not"><i class="fa-solid fa-envelope"> Notes</i></a></li>
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
            <h1>Hellow! <span><?php echo $fetch['name']; ?></span></h1>
            <p>How are you? Are crazy?</p>
            <a href="dashboard.php"><i class="fa-solid fa-list"></i> Go to Dashboard</a>
            <h3><a href="rest.php"><i class="fa-solid fa-bed"></i> Click here</a> If you want to rest!</h3>
        </div>
        <div class="image-box">
          <img src="./images/mylogo1.png" class="back-img">
        </div>
    </div>
</body>
</html>