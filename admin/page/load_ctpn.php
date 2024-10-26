<?php
include 'connectDB.php';

  $Mapn = $_POST['data'];

  // Xử lý dữ liệu ở đây (ví dụ: lưu vào cơ sở dữ liệu, xử lý logic, v.v.)
  // ...

  // Trả về giá trị cho JavaScript
 $thanhtien=0;
$result_pn=mysqli_query($conn,"SELECT * FROM phieunhap WHERE Mapn=$Mapn");
$result_thanhtien=mysqli_query($conn,"SELECT SUM(soluong*Gianhap) AS thanh_tien FROM chitietphieunhap  ,sanpham WHERE maPhieunhap=$Mapn AND chitietphieunhap.Masp=sanpham.Masp");
if(mysqli_num_rows($result_thanhtien)>0){
    while($row=mysqli_fetch_array($result_thanhtien)){$thanhtien=$row['thanh_tien'];}
}
if(mysqli_num_rows($result_pn)> 0){
   while($row=mysqli_fetch_array($result_pn))
   {
    echo '   <div class="top-left">
        <div class="top-items">Mã phiếu nhập</div>
        <input type="text" class="top-items" name="txtMaPN" value="'.$row['Mapn'].'">
    </div>
    <div class="top-left">
        <div class="top-items">Mã nhà cung cấp</div>
        <input type="text" class="top-items" name="txtMaNCC" value="'.$row['Manhacungcap'].'">
        <button class="btn-Xem">Xem thông tin</button>
    </div>
    <div class="top-left">
        <div class="top-items">Mã nhân viên nhập hàng</div>
        <input type="text" class="top-items" name="txtMaNV" value="'.$row['Manhanvien'].'">
        <button class="btn-Xem">Xem thông tin</button>
    </div>
    <div class="top-left">
        <div class="top-items">Ngày tạo</div>
        <input type="text" class="top-items" name="txtNgaytao" value="'.$row['Ngaynhap'].'">
    </div>
    <div class="top-left">
        <div class="top-items">Tổng tiền</div>
        <input type="text" class="top-items" name="txtMaNV" value="'.$thanhtien.'">
    </div>';
   }
}

?>