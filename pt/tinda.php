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

  <title>HTML</title>



  <!-- Custom Styles -->
  <link rel="stylesheet" href="./css/tinda.css">
</head>

<body>
  <div class="main_nav_container">
    <div class="nav_container">
      <div class="logo">
      <div><img src="./images/mylogo1.png" class="logo"></div>
      </div>
      </div>
     <input type="checkbox" id="click" />
      
      <div class="top_navbar" >
      <div><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"> HOME&nbsp;&nbsp;&nbsp;&nbsp; </i></a></div>
        <div><a href="notes.php"><i class="fa fa-book" aria-hidden="true"> ADD NOTES&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>
        <div><a href="feed.php"><i class="fa fa-rss" aria-hidden="true"> NOTESFEED&nbsp;&nbsp;&nbsp;&nbsp; </i></a></div>
        <div><a href="home.php"><i class="fa fa-user" aria-hidden="true"> ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;  </i></a></div>

      </div>
    <label for="click" class="menu_btn">
      <i class="fas fa-bars"></i>
    </label>
  </div>
  <div class="sec_nav_container">
      <div class="top_secnavbar" >
        <div><p>PRODUCT</p></div>
        <div><p>PRICE</p></div>
        <div><p>STOCKS</p></div>
        <div><p>ACTION STAR</p></div>
      </div>
  </div>
  <div class="container">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <th></th>
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
                                <button class="btn-primary btn"> 
                                    <a href="deletepro.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="logout-btn"><i class="fa-solid fa-trash"></i></a>
                                    <a href="update.php?id=<?php $user_id= $_SESSION['user_id']; echo $res['id']; ?>" class="up_btn"><i class="fa-solid fa-pen-to-square"></i></a> 
                                </button> 
								</td>
                            </tr>
                            <?php
                            }
                        ?>
                </tbody>
            </table>
            <table class="tble">
                <thead>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td> <a href="dashboard.php" class="back-to"><i class="fa-solid fa-backward"></i> Back</a></td>
                        <td> <a href="add.php" class="add-to"><i class="fa-sharp fa-solid fa-plus"></i> Add</a></td>
                    </tr>                      
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>