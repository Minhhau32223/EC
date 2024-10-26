<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");
$conn = new Database();

// $userAuth = new userAuth($conn);
// $isUpdate = $userAuth->checkUpdatePermission("7");

// if (!$isUpdate) {
//   header("Location: ../pages/role.php");
//   exit();
// }
$features_list = $conn->query("SELECT * FROM chucnang");

if (isset($_POST['submit'])) {
  // Connect to your database
  $conn = new Database();

  $role_id = $_GET['idquyen'];

  // Retrieve the role name from the $_POST array
  $role_name = $_POST['txtNhomquyen'];

  // Update the role name in the roles table
  $sql = "UPDATE quyen SET Tenquyen = '$role_name' WHERE Maquyen = '$role_id'";
  $conn->query($sql);

  // Retrieve the selected actions for each feature from the $_POST['features'] array
  $features = $_POST['features'];

  // Delete all existing role-feature-action relationships for the current role
  $sql = "DELETE FROM chitietquyen WHERE Maquyen = '$role_id'";
  $conn->query($sql);

  // Loop through the selected actions for each feature
  foreach ($features as $feature_id => $actions) {
    // For each action, insert a new row into the role-feature-action relationship table
    foreach ($actions as $action) {
      $sql = "INSERT INTO chitietquyen (Maquyen, Machucnang, Thaotac) VALUES ('$role_id', '$feature_id', '$action')";
      $conn->insert($sql);
    }
  }
  $conn->close();

//   session_start();
//   $_SESSION["role_msg"] = "Chỉnh sửa quyền thành công";
  echo'
  <script>window.location.href = "AHome.php?chon=t&id=quyen";</script>
  ';
}

$role_id = $_GET['idquyen'];
$role = $conn->query("SELECT * FROM quyen WHERE Maquyen = '$role_id'")->fetch_assoc();
$role_name=$role['Tenquyen'];
if (!$role) {
  echo 'Role not found';
  exit();
}

$sql = "SELECT Machucnang, Thaotac FROM chitietquyen WHERE Maquyen = '$role_id'";
$role_features_actions = $conn->query($sql);

// Convert the result to an associative array
$role_features_actions_assoc = [];
while ($row = $role_features_actions->fetch_assoc()) {
  $role_features_actions_assoc[$row['Machucnang']][] = $row['Thaotac'];
}
$conn->close();

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
      <form action="../page/updatequyen.php?idquyen=<?php echo $role_id ?>" method="POST">
      <div class="permission-group__input">
          <p>Tên nhóm quyền</p>
          <input type="text" id="txtNhomquyen" name="txtNhomquyen" value="<?php echo $role_name ?> " required/>
          <p>Mã quyền</p>
          <input type="text" id="txtIdquyen" name="txtIdquyen" value="<?php echo $role_id ?>" readonly/>
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
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'v"  name="features[' . $row['Machucnang'] . '][]" value="view" ' . (isset($role_features_actions_assoc[$row['Machucnang']]) && in_array('view', $role_features_actions_assoc[$row['Machucnang']]) ? ' checked' : '') . '/></div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'a" name="features[' . $row['Machucnang'] . '][]" value="add" ' . (isset($role_features_actions_assoc[$row['Machucnang']]) && in_array('add', $role_features_actions_assoc[$row['Machucnang']]) ? ' checked' : '') . '/></div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'u" name="features[' . $row['Machucnang'] . '][]" value="update" ' . (isset($role_features_actions_assoc[$row['Machucnang']]) && in_array('update', $role_features_actions_assoc[$row['Machucnang']]) ? ' checked' : '') . '/></div>
              <div class="table-cell"><input type="checkbox" id="chucnang'.$row['Machucnang'].'d" name="features[' . $row['Machucnang'] . '][]" value="delete" ' . (isset($role_features_actions_assoc[$row['Machucnang']]) && in_array('delete', $role_features_actions_assoc[$row['Machucnang']]) ? ' checked' : '') . '/></div>
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
          <button class="btn btn--danger" ><a href="AHome.php?chon=t&id=quyen">Hủy bỏ</a></button>
        </div>
      </form>
      </div>
</body>

</html>