<?php
include 'connectDB.php';
session_start();
$masp=$_POST['data'];
$soluong=$_POST['sl'];
$data=[];
$reulst_new_item=mysqli_query($conn,"SELECT * FROM sanpham WHERE Masp=$masp");
if(mysqli_num_rows($reulst_new_item)>0){
    while($row=mysqli_fetch_array($reulst_new_item)){
        $data=[
            'Img'=>$row['Img'],
            'Masp'=>$row['Masp'],
            'Tensp'=>$row['Tensp'],
            'Gianhap'=>$row['Gianhap'],
           'Soluong'=>$soluong

        ];
        





        echo '<div class="table-items" id="'.$row['Masp'].'">' .
        '<div style="width: 20%;">'.$row['Masp'].'</div>' .
        '<div class="staff">' .
        '<div class="avt-sp"><img src="../../img/' . $row['Img'] . '" alt=""></div>' .
        '<div>'.$row['Tensp'].'</div>' .
        '</div>' .
        '<div style="width: 30%;">'.$row['Gianhap'].'  VND</div>' .
        '<div class="soluong">' .
        '<input type="text" class="soluong_in" value="'.$soluong.'" style="text-align: center;width: 60%;">' .
        '<button type="button" class="btn-X" >X</button>' .
        '</div>' .
        '</div>';
    
    }
}
if($_SESSION['item_add']==null||empty($_SESSION['item_add']))
{
    $_SESSION['item_add']=[$data];
}
else{
    $_SESSION['item_add'][]=$data;
}
?>