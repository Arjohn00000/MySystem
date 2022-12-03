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
<body>
    <div class="hero">
        <nav>
        <h3 class="logo"><?php
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
        </nav>
        <div class="info"> <?php
                $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select)>0){
                    $fetch=mysqli_fetch_assoc($select);
                }
            ?>
          <h1>Hello! <span><?php echo $fetch['name']; ?></span></h1>
        </div>
        <div class="image-box">
            <table>
                <thead>
                    <th>NOTES</th>
                </thead>
                <tbody>
                    <?php
                       include 'config.php';
                       $user_id= $_SESSION['user_id'];
                       $select = "SELECT * from `notes` WHERE user_id= '$user_id' ";                      
                       $query = mysqli_query($conn, $select);                        
                       while($res = mysqli_fetch_array($query)){
                    ?>
                            <tr>
                                <td><p>Updated on <?php echo date("Y-m-d")." ".date("l"); ?></p>
                                <br><?php echo $res['note'];  ?> <br>
                                <br> <a href="updt_notes.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="up-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="del_notes.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="e-btn"><i class="fa-solid fa-trash"></i></a></td>
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
        $insert = "INSERT INTO notes (user_id, note, created) VALUE('$user_id', '$note', '$created')";
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
            <textarea name="note" id="note" placeholder="Write something..." cols="50" rows="5"></textarea><br>
            <input type="submit" value="Post" class="done " name="done" id="done">
            <a href="dashboard.php" class="dash"><i class="fa-solid fa-list"></i> Go to Dashboard</a>
       <form>
</body>
</html>