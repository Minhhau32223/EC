<?php
include 'connectDB.php';
$mapn=$_POST['data'];

$result_delete_ctpn=mysqli_query($conn,"DELETE FROM chitietphieunhap WHERE maPhieunhap = '$mapn'");
$result_delete_pn=mysqli_query($conn,"DELETE FROM phieunhap WHERE Mapn = '$mapn'");

?>