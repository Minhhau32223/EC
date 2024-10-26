<?php
require_once('../../db_connect.php');
require_once('../../role_check.php');
$conn = new Database();
// $userAuth = new userAuth($conn);
// $isCreate = $userAuth->checkCreatePermission("7");

// if (!$isCreate) {
//   header("Location: ../pages/role.php");
//   exit();
// }
$features_list = $conn->query("SELECT * FROM chucnang");
$conn->close();

if (isset($_POST['submit'])) {
  // Connect to your database
  $conn = new Database();

  // Retrieve the role name from the $_POST array
  $role_name = $_POST['txtNhomquyen'];
  $role_id=$_POST['txtIdquyen'];
  // Insert the new role into the roles table
  $sql = "INSERT INTO  quyen (Maquyen,Tenquyen) VALUES ('$role_id','$role_name')";

  $role_insert = $conn->insert($sql);

  // Retrieve the selected actions for each feature from the $_POST['features'] array
  $features = $_POST['features'];

  // Loop through the selected actions for each feature
  foreach ($features as $feature_id => $actions) {
    // For each action, insert a new row into the role-feature-action relationship table
    foreach ($actions as $action) {
      $sql = "INSERT INTO chitietquyen (Maquyen, Machucnang, Thaotac) VALUES ('$role_id', '$feature_id', '$action')";
      $conn->insert($sql);
    }
  }
  $conn->close();
  echo'
  <script>window.location.href = "AHome.php?chon=t&id=quyen";</script>
  ';
  // // session_start();
  // header("Location: ./AQuyen.php");
  // exit();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">>
    <!-- <link rel="stylesheet" href="./css/style.css?version=1.0"> -->
    <link rel="stylesheet" href="../css/phanquyen.css">
    <title>Phân quyền</title>
    
</head>
<body>
  
    <div class="permission-group">
        <h2>Thêm/sửa nhóm quyền</h2>
      <form action="./phanquyen.php" method="POST">
      <div class="permission-group__input">
          <p>Tên nhóm quyền</p>
          <input type="text" id="txtNhomquyen" name="txtNhomquyen"/>
          <p>Mã quyền</p>
          <input type="text" id="txtIdquyen" name="txtIdquyen"/>
        </div>
        <div class="permission-group__table">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Danh mục chức năng</div>
              <div class="table-cell">Xem</div>
              <div class="table-cell">Tạo mới</div>
              <div class="table-cell">Cập nhật</div>
              <div class="table-cell">Xóa</div>
            </div>
          </div>
          
          <div class="table-body">
          <?php
            $con = mysqli_connect("localhost", "root", "", "bolashop");
            $sql="SELECT *  from chucnang";
            $rs = mysqli_query($con,$sql);
            mysqli_close($con);
            while ($row = mysqli_fetch_array($rs)) {
              echo '<div class="table-row" '.$row['Machucnang'].'>
              <div class="table-cell">'.$row["Tenchucnang"].'</div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'v"  name="features[' . $row['Machucnang'] . '][]" value="view"/></div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'a" name="features[' . $row['Machucnang'] . '][]" value="add" /></div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'u" name="features[' . $row['Machucnang'] . '][]" value="update"/></div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'d" name="features[' . $row['Machucnang'] . '][]" value="delete" /></div>
            </div>';
            }
            ?>
            <!-- <div class="table-row">
              <div class="table-cell">Quản lý khách hàng</div>
              <div class="table-cell"><input type="checkbox" checked /></div>
              <div class="table-cell"><input type="checkbox" checked /></div>
              <div class="table-cell"><input type="checkbox" checked /></div>
              <div class="table-cell"><input type="checkbox" checked /></div>
            </div> -->
            <!-- Các dòng khác tương tự -->
          </div>
        </div>
        <div class="permission-group__actions">
          <button type="submit" name="submit" class="btn btn--primary">Cập nhật</button>
          <button class="btn btn--danger"><a href="AHome.php?chon=t&id=quyen">Hủy bỏ</a></button>
        </div>
      </form>
      </div>
</body>
<!-- <a href="AHome.php?chon=t&id=quyen"> -->
</html>