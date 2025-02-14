<?php
session_start();
include "timeout.php";
include "config.php";
$id=$_GET['id'];
$sql = "SELECT * FROM principal_record where id=$id";
$result = mysqli_query($conn, $sql);
if(($_SESSION['user_type'] != "admin")&&($_SESSION['user_type'] != "principal")){
    header("location: index.php");
} else{
    $sql = "delete from principal_record where id=$id";
    mysqli_query($conn, $sql);
    header("location: principal-record.php");
}
