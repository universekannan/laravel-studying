<?php
session_start();
include "timeout.php";
include "config.php";
$id=$_GET['id'];
$sql = "SELECT * FROM exam where id=$id";
$result = mysqli_query($conn, $sql);
if(($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal")){
    header("location: index.php");
} else{
    $sql = "delete from exam where id=$id";
    mysqli_query($conn, $sql);
    header("location: view-examname.php");
}
