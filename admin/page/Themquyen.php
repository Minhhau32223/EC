<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">>
    <link rel="stylesheet" href="style.css?version=1.0">
    <title>Phân quyền</title>
    <style>
.permission-group {
  font-family: Arial, sans-serif;
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.permission-group__input input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.permission-group__table {
  margin-top: 20px;
}

.table-header {
  background-color: #f2f2f2;
  font-weight: bold;
}

.table-row {
  display: flex;
  border-bottom: 1px solid #ccc;
}

.table-cell {
  flex: 1;
  padding: 8px;
}

.permission-group__actions {
  margin-top: 20px;
  text-align: right;
}

.btn {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left: 8px;
}

.btn--primary {
  background-color: #007bff;
  color: #fff;
}

.btn--danger {
  background-color: #dc3545;
  color: #fff;
}
    </style>
</head>
<body>
    <div class="permission-group">
        <h2>Chỉnh sửa nhóm quyền</h2>
        <div class="permission-group__input">
          <input type="text" placeholder="Quán lý kho" />
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
            <div class="table-row">
              <div class="table-cell">Quản lý khách hàng</div>
              <div class="table-cell"><input type="checkbox" checked /></div>
              <div class="table-cell"><input type="checkbox" checked /></div>
              <div class="table-cell"><input type="checkbox" checked /></div>
              <div class="table-cell"><input type="checkbox" checked /></div>
            </div>
            <!-- Các dòng khác tương tự -->
          </div>
        </div>
        <div class="permission-group__actions">
          <button class="btn btn--primary">Cập nhật nhóm...</button>
          <button class="btn btn--danger">Hủy bỏ</button>
        </div>
      </div>
</body>

</html>