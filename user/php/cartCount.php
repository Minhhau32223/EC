<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "bolashop");
mysqli_query($con, "set names 'utf8'");

$user_id = $_SESSION['user_id'];
$query = "SELECT COUNT(*) AS total_products FROM giohang WHERE Manguoidung = '$user_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

echo $row['total_products'];
?>
