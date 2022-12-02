<?php

    include 'config.php';
    session_start();
    $user_id= $_SESSION['user_id'];

    $id = $_GET['id'];
    $delete = " DELETE FROM `market` WHERE id = $id AND user_id= '$user_id' ";
    mysqli_query($conn, $delete);
    header('location:tinda.php');

?>