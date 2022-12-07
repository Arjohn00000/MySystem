<?php
include 'config.php';
session_start();
$user_id= $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

$id = $_GET['id'];

$select = "SELECT * from notes where id = $id AND user_id= $user_id ";                      
$query = mysqli_query($conn,$select);                        
while($res = mysqli_fetch_array($query)){     
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="./css/dashboard.css">
  <title>updt Notes</title>
    <link rel="stylesheet" href="./css/updt_notes.css">
</head>
<body>
<div class="container">
        <div class="row">
            <form action="" method="POST">
            <div class="txt">
                <label for="note">You Okay?,<br>Why are updating?</label><br>
                <textarea name="note" placeholder="Write something...(character limit is 255)" id="note" value="<?php echo $res['note']; ?>" cols="50" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="sub" name="update">Update</button>
                <a href="notes.php" class="b-btn">Back</a>
            </div>
        </form> 
        </div>
        <?php
    }
        $user_id= $_SESSION['user_id'];
        if (isset($_POST['update']))
        {
            $note = isset($_POST['note'])?$_POST['note']:'';
            if($note==""){
                echo "<script>alert('Please write something')</script>";
            }else{
            $update = "UPDATE notes set note='$note' where id = $id";
            $query = mysqli_query($conn, $update);
                if($query) {
                    header('location:notes.php');
                }
                else {
                    echo "error";
                }
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