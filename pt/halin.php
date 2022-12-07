<?php
    include 'config.php';
    session_start();
    $id = $_GET['id'];

    $select = "SELECT * FROM `market` WHERE id=$id";                      
    $query = mysqli_query($conn, $select);                        
    while($res = mysqli_fetch_array($query)){


            $stock = isset($_POST['stock'])?$_POST['stock']:'';
            $stock_sold = isset($_POST['stock_sold'])?$_POST['stock_sold']:'';
    
            $update = "UPDATE market SET stock='$stock', stock_sold='$stock_sold' where id = $id";
            $query = mysqli_query($conn, $update);
            if($query) {
                $stock_left = $query['stock'] - $query['stock_sold'];
                echo $stock_left;
            }
            else {
                echo "error";
            }
        }
?>