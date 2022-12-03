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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./css/tinda.css">
    <title>TINDA</title>
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
            <table class="table table-striped">
                <thead>
                    <th>Tinda</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions star</th>
                </thead>
                <tbody>
                    <?php
                       include 'config.php';
                       $user_id= $_SESSION['user_id'];
                       $select = "SELECT * from `market` WHERE user_id= '$user_id' ";                      
                       $query = mysqli_query($conn, $select);                        
                       while($res = mysqli_fetch_array($query)){
                    ?>
                            <tr>
                                <td> <?php echo $res['p_name'];  ?> </td>
                                <td> <?php echo $res['p_price'];  ?> </td>
                                <td> <?php echo $res['stock'];  ?> </td>
								<td>
                                    <div> 
										<a href="deletepro.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="logout-btn"><i class="fa-solid fa-trash"></i></a>
										<a href="update.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="up_btn"><i class="fa-solid fa-pen-to-square"></i></a> 
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                </tbody>
            </table>
			<div class="add">
                <a href="dashboard.php" class="back-to"><i class="fa-solid fa-backward"></i> Back</a>
                <a href="add.php" class="add-to"><i class="fa-sharp fa-solid fa-plus"></i> Add</a>
			</div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>