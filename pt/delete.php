<?php
include 'config.php';
session_start();
$user_id= $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};
if(isset($_GET['delete'])){
    $del= mysqli_real_escape_string($conn);
    $delete = " DELETE FROM `user_form` WHERE id = $user_id ";
    mysqli_query($conn, $delete);
    header('location:login.php');
};
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
            ?>
            <?php?>
            <a href="home.php?delete=<?php echo $user_id; ?>" class="delete-btn" name="delete">delete</a>
        </div>

    </div>
</body>
</html>