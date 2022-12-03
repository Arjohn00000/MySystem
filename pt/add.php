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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/tindaUpdate.css">
    <title>Add</title>
</head>
<body>
    <div class="container">
    <?php
    include 'config.php'; 
    $user_id= $_SESSION['user_id'];
    if (isset($_POST['done']))
    {
        $p_name = isset($_POST['p_name'])?$_POST['p_name']:'';
        $p_price = isset($_POST['p_price'])?$_POST['p_price']:'';
        $stock = isset($_POST['stock'])?$_POST['stock']:'';

        $insert = "INSERT INTO market(user_id, p_name,p_price,stock) VALUE('$user_id','$p_name','$p_price','$stock')";
        $query = mysqli_query($conn, $insert);
        if($query) {
            header('location:tinda.php');
        }
        else {
            echo "error";
        }
        
    }
?>
        <div class="row">
        <img src="./images/bg1.jpg" class="bg">
        <h3><i><a href="home.php"><?php
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
            <form action="" method="POST">
                <h2>Add</h2>
                <div class="mb-3">
                <label for="p_name" class="form-label">Goods</label>
                    <input type="text" class="form-control" id="p_name" placeholder="Goods" name="p_name" required>
                </div>
                <div class="mb-3">
                <label for="p_price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="p_price" placeholder="Price" name="p_price" required>
                <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Done" class="btn " name="done">
                    <a href="tinda.php" class="back-btn">Back</a>
                </div>
          </form>
        </div>
    </div>

    <!-- //prevent from resubmission -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>