<?php
require_once('../../db_connect.php');
require_once("../../role_check.php");

$conn = new Database();

$userAuth = new userAuth($conn);
$isDelete = $userAuth->checkDeletePermission("7");

if (!$isDelete) {
  header("Location: ../page/Aquyen.php");
  exit();
}

$idToDelete = $_POST['id'];
$sql_xctq = "DELETE FROM chitietquyen WHERE Maquyen ='$idToDelete'";
$result_xoa_ctq=$conn->query($sql_xctq);

$sql_up_ngd="UPDATE nguoidung set Maquyen ='Q2' WHERE  Maquyen = '$idToDelete'";

$result_doi_quyen=$conn->query($sql_up_ngd);

$sql = "DELETE FROM quyen WHERE Maquyen = '$idToDelete'";

$result_xoa_q=$conn->query($sql);
if($result_doi_quyen && $result_xoa_ctq && $result_xoa_q)
{
  echo 1;

}
else{
  echo 0;
}
$conn->close();

session_start();
$_SESSION["role_msg"] = "Xóa quyền thành công";
header("Location: ../page/Aquyen.php");
exit();
