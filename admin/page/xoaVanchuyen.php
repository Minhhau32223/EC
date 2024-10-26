<?php
$con = mysqli_connect('localhost', 'root', '', 'bolashop');
if(isset($_GET['idvcc'])){
    $mavc = $_GET['idvc'];
    $sql="DELETE FROM vanchuyen WHERE Mavc ='$mavc'";
    $query = mysqli_query($con, $sql);
    header('Location: AHome.php?chon=t&id=vanchuyen');
}
mysqli_close($con);
?>