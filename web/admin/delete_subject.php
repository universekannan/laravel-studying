<?php
session_start();
include "timeout.php";
include "config.php";
$id=$_GET['id'];
$sql = "SELECT * FROM subject where id=$id";
$result = mysqli_query($conn, $sql);
if($_SESSION['user_type'] != "admin"){
    header("location: index.php");
} else{
    $sql = "delete from subject where id=$id";
    mysqli_query($conn, $sql);
    header("location: view_subject.php");
}
