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
  <link rel="stylesheet" href="./css/tinda_display.css">
</head>
<body>
    <div id="player">
      <audio controls autoplay hidden>
          <source src="music.ogg" type="audio/ogg">
          <source src="./music/baligya.mp3" type="audio/mpeg">
      </audio>
  </div>
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
        <div><p>PURCHASE</p></div>
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
                        $select = "select * from market";                      
                        $query = mysqli_query($conn,$select);                        
                        while($res = mysqli_fetch_array($query)){     
                    ?>
                            <tr>
                                <td> <?php echo $res['p_name'];  ?> </td>
                                <td> <?php echo $res['p_price'];  ?> </td>
                                <td> <?php echo $res['stock'];  ?> </td>
								<td> 
                                <button class="btn-primary btn"> 
                                    <a href="palit.php?id=<?php echo $res['id']; ?>" class="text-white"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> 
                                </button> 
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