<?php
include 'connectDB.php';
if (isset($_POST['data'])) {
  $selectedValue = $_POST['data'];

  // Xử lý dữ liệu ở đây (ví dụ: lưu vào cơ sở dữ liệu, xử lý logic, v.v.)
  // ...

  // Trả về giá trị cho JavaScript
  $sql="SELECT gianhap FROM sanpham WHERE Masp=$selectedValue";
  $result=mysqli_query($conn, $sql);
  while($row=mysqli_fetch_array($result)){
    echo $row['gianhap'];
  }

}
?>