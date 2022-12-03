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
<title>R.I.P</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="./css/rest.css">
<body>
    <div class="hero">
        <div class="image-box">
          <img src="./images/rest.jpg" class="back-img">
          <a href="details.php" class="back-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
        </div>
    </div>
</body>
</html>
</body>
</html>