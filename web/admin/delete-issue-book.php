<?php
session_start();
include "timeout.php";
include "config.php";
$id=$_GET['id'];
$sql = "SELECT * FROM issue_book where id=$id";
$result = mysqli_query($conn, $sql);
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "library")) header("location: index.php");
else{
    $sql = "delete from issue_book where id=$id";
    mysqli_query($conn, $sql);
    header("location: issue-book.php");
}
