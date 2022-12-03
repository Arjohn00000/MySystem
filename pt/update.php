<?php
    include 'config.php';
    session_start();
    $user_id= $_SESSION['user_id'];
 
    $id = $_GET['id'];

    $select = "SELECT * from market where id = $id AND user_id= $user_id ";                      
    $query = mysqli_query($conn,$select);                        
    while($res = mysqli_fetch_array($query)){     
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/tindaUpdate.css">
    <title>Baligya</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <img src="./images/bg1.jpg" class="bg">
        <h3><i><a href="home.php"><?php
                $user_id= $_SESSION['user_id'];
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
                <h2>Update</h2>
                <div class="mb-3">
                    <label for="p_name" class="form-label">Goods</label>
                    <input type="text" class="form-control" id="p_name" placeholder="Tinda" name="p_name" value="<?php echo $res['p_name'];  ?>" required>
                </div>
                <div class="mb-3">
                    <label for="p_price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="p_price" placeholder="Price" name="p_price" value="<?php echo $res['p_price'];  ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" placeholder="Stocks" name="stock" value="<?php echo $res['stock'];  ?>" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </form>
        </div>
        <?php
    }
        if (isset($_POST['update']))
        {
            $p_name = isset($_POST['p_name'])?$_POST['p_name']:'';
            $p_price = isset($_POST['p_price'])?$_POST['p_price']:'';
            $stock = isset($_POST['stock'])?$_POST['stock']:'';
    
            $update = "UPDATE market set p_name='$p_name', p_price='$p_price', stock='$stock' where id = $id";
            $query = mysqli_query($conn, $update);
            if($query) {
                header('location:tinda.php');
            }
            else {
                echo "error";
            }
            
        }
?>
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
