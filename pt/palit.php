<?php
    include 'config.php'; 
    $id = $_GET['id'];


    $select = "SELECT * from market where id = $id";                      
    $query = mysqli_query($conn,$select);                        
    while($res = mysqli_fetch_array($query)){     
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./css/tindaUpdate.css">
    <title>Palit</title>
</head>
<body>
    <div class="container">

        <div class="row">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="p_name" class="form-label">Goods</label>
                    <input type="name" class="form-control" id="p_name" placeholder="Tinda" name="p_name" value="<?php echo $res['p_name'];  ?>" required>
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
                    <label for="stock_sold" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="stock_sold" placeholder="Qty (by pc/s)" name="stock_sold" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="update">Purchase</button>
                </div>
            </form>
        </div>
        <?php
    }
        if (isset($_POST['update']))
        {
            $stock = isset($_POST['stock'])?$_POST['stock']:'';
            $stock_sold = isset($_POST['stock_sold'])?$_POST['stock_sold']:'';
    
            if ($stock>=$stock_sold){
                    $update = "UPDATE market SET stock='$stock' - '$stock_sold' where id = $id";
                    $query = mysqli_query($conn, $update);
                        if ($query) {
                            header('location:tinda_display.php');
                        }
            }else{
                echo "<script>alert('Out of Stock')</script>";;
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