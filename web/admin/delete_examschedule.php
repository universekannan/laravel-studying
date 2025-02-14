<?php
session_start();
include "timeout.php";
include "config.php";
$id=$_GET['id'];
$sql = "SELECT * FROM exam_schedule where id=$id";
$result = mysqli_query($conn, $sql);
if($_SESSION['user_type'] != "staff"){
    header("location: index.php");
} else{
    $sql = "delete from exam_schedule where id=$id";
    mysqli_query($conn, $sql);
    header("location: view_examschedule.php");
}
