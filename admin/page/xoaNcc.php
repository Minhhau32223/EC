<?php
$con = mysqli_connect('localhost', 'root', '', 'bolashop');
if(isset($_GET['idncc'])){
    $mancc = $_GET['idncc'];
    $sql="DELETE FROM nhacungcap WHERE Mancc ='$mancc'";
    $query = mysqli_query($con, $sql);
    header('Location: AHome.php?chon=t&id=nhacungcap');
}
mysqli_close($con);
?>