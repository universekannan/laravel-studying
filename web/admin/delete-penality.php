<?php
session_start();
include "timeout.php";
include "config.php";
$id=$_GET['id'];
$sql = "SELECT * FROM penality where id=$id";
$result = mysqli_query($conn, $sql);
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "library")) header("location: index.php");
else{
    $sql = "delete from penality where id=$id";
    mysqli_query($conn, $sql);
    header("location: penality.php");
}
