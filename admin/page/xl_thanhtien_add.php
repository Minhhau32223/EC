<?php 
include 'connectDB.php';
$masp=$_POST['data'];
$soluong=$_POST['sl'];
$thanhtien=0;
$reulst_new_item=mysqli_query($conn,"SELECT * FROM sanpham WHERE Masp=$masp");
if(mysqli_num_rows($reulst_new_item)>0){
    while($row=mysqli_fetch_array($reulst_new_item)){
        $thanhtien=$soluong*$row['Gianhap'];
    }
    
}
echo $thanhtien;
?>