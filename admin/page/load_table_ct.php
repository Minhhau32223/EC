<?php
include 'connectDB.php';
$Mapn = $_POST['data'];
$result_ctpn=mysqli_query($conn,"SELECT * FROM chitietphieunhap, sanpham WHERE maPhieunhap=$Mapn AND chitietphieunhap.Masp=sanpham.Masp");
if(mysqli_num_rows($result_ctpn)>0)
{
    while($row=mysqli_fetch_array($result_ctpn)){
        echo '      <div class="table-items-details">
        <div class="staff">
            <div class="avt-sp"> <img src="../../img/' . $row['Img'] . '" alt=""></div>
            <div>'.$row['Tensp'].'n</div>
        </div>
        <div style="width: 20%;">'.$row['Masp'].'</div>
        <div style="width: 30%;">'.$row['Gianhap'].'VND
        </div>
        <div style="width: 20%;">
            <input type="text" value="'.$row['soluong'].'" readonly style="text-align: center;width: 90%;">
        </div>
    </div>';
    }
}


?>