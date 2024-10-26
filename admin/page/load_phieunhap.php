<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN007");



$isDelete = $userAuth->checkDeletePermission("CN007");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>


<?php
include 'connectDB.php';

  $sql="SELECT * FROM phieunhap ORDER BY Mapn ASC";
  $result=mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)<1){
    echo "Không có dữ liệu";
    return;
  }else{
    while($row=mysqli_fetch_array($result)){
      $textdel="";
      if(!$isDelete)
      {
        $textdel="hidden";
      }

        echo '<div class="table-items" id="'.$row['Mapn'].'"> ';
      echo  '<div style="width: 20%;">'.$row['Mapn'] .'</div>';
    echo '<div style="width: 20%;">'.$row['Manhanvien'].'</div>';
    echo '<div style="width: 20%;">'.$row['Manhacungcap'].'</div>';
    echo    '<div style="width: 20%;">'.$row['Ngaynhap'].'</div>';
    echo    '<div class="status-phieunhap">';
    echo      ' <!-- <div>Bình thường</div> -->';
    echo      ' <button type="button" class="btn-X-PN  '.$textdel.'">X</button>';
    echo      ' <button type="button" class="btn-xemct" onmousedown="showChiTiet(this)" id="'.$row['Mapn'].'">Xem</button>';
    echo   ' </div>';
    echo   ' </div>';
      }
  }
    


?>