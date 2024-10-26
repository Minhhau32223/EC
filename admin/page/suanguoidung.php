<!DOCTYPE html>
<html>
<head>
    <style>
        a {
            color: black;
            text-decoration: none;
        }
        .form_TTKhachHang {
            border: 2px solid black;
            padding: 20px;
        }
        .chuXam {
            color: #1f010193;
        }
        .ThongTinKhachHang {
            height: 400px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ThongTinKhachHang-data1, .ThongTinKhachHang-data2 {
            width: 30%;
        }
        .photo {
            width: 250px;
            height: 250px;
            background-color: #ddd;
            border-radius: 50%;
            overflow: hidden;
            position: relative;  
            margin: auto;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .ThongTinKhachHang input[type="text"],
        .ThongTinKhachHang input[type="password"] {
            width: 80%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .check-ThongTin {
            color: #D61EAD;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 40px;
        }
        tbody td {
            width: 50%;
            padding: 10px;
            border: 1px solid black;
        }
        .LuuND {
            background-color: #D61EAD;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            width: 70%;
            padding: 15px 0;
            font-size: 16px;
            margin-top: 30px;
        }
        select {
            width: 80%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .TaoND:hover {
            background-color: #A70087;
        }
    </style>
</head>
<body>
<?php
if (isset($_GET['maND'])) {
    $id = $_GET['maND'];

    $server ='localhost';
    $user ='root';
    $pass = '';
    $database = 'bolashop';

    $db = new mysqli($server, $user, $pass, $database);

    if ($db) {
        mysqli_query($db, "SET NAMES 'utf8'");
    } else {
        echo 'Kết nối database thất bại';
        exit;
    }

    $sql = "SELECT * FROM nguoidung WHERE Manguoidung = '$id'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ten = $row['Ten'];
            $sdt = $row['Sodienthoai'];
            $email = $row['Email'];
            $diachi = $row['Diachi'];
            $password = $row['Matkhau'];
            $status = $row['Loainguoidung'];
            $img = $row['img'];

            // Fetch all roles from the `quyen` table
            $sql_roles = "SELECT * FROM quyen";
            $result_roles = $db->query($sql_roles);
            $roles = [];
            if ($result_roles->num_rows > 0) {
                while ($row_role = $result_roles->fetch_assoc()) {
                    $roles[] = $row_role;
                }
            }
            ?>
            <form id="SND" action="XLsuanguoidung.php" method="post" enctype="multipart/form-data">
                <h1>Sửa thông tin người dùng</h1>
                <p><a href="AHome.php">Trang chủ >> </a><span class="chuXam"><a href="AHome.php?chon=t&id=nguoidung">Người dùng >> </a>Sửa thông tin người dùng</span></p>
                <div class="ThongTinKhachHang">
                    <div class="ThongTinKhachHang-data1">
                        <div class="photo">
                            <img id="hinhAnh" src="../../img/<?php echo $img; ?>" alt="ảnh" style="width: 80%; height: 80%;background-position: center;
                                width: 250px;
                                height: 250px;
                                background-color: #ddd;
                                border-radius: 50%;
                                overflow: hidden;
                                position: relative;  
                                margin: auto;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: center;
                                ">
                        </div>
                        <input type="file" id="uploadInput" name="txtHinhAnh" onchange="hienThiAnh(event)">
                    </div>
                    
                    <div class="ThongTinKhachHang-data1">
                        <p>Tên đăng nhập:</p>
                        <input type="text" name="id" id="id" value="<?php echo $id; ?>" readonly>
                        <p>Địa chỉ:</p>
                        <input type="text" name="address" id="address" value="<?php echo $diachi; ?>">
                        <p>Mật khẩu:</p>
                        <input type="text" name="password" id="password" value="<?php echo $password; ?>">
                        <p>Quyền:</p>
                        <select name="status" id="status">
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role['Maquyen']; ?>" <?php echo ($role['Maquyen'] == $status) ? 'selected' : ''; ?>><?php echo $role['Tenquyen']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="ThongTinKhachHang-data2">
                        <p>Họ tên:</p>
                        <input type="text" name="name" id="name" value="<?php echo $ten; ?>">
                        <p>Số điện thoại:</p>
                        <input type="text" name="phone" id="phone" value="<?php echo $sdt; ?>">
                        <p>Email:</p>
                        <input type="text" name="email" id="email" value="<?php echo $email; ?>">
                        <input type="submit" class="LuuND" value="Lưu">
                    </div>
                </div>
            </form>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            function hienThiAnh(event) {
                var input = event.target;
                var reader = new FileReader();
                reader.onload = function(){
                    var dataURL = reader.result;
                    var img = document.getElementById("hinhAnh");
                    img.src = dataURL;
                };
                reader.readAsDataURL(input.files[0]);
            }

            $(document).ready(function(){
                $("#SND").submit(function(event){
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: 'XLsuanguoidung.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response){
                            if (response.status === 'success') {
                                alert(response.message);
                                window.location.href = "AHome.php?chon=t&id=nguoidung";
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                });
            });
            </script>
            <?php
        }
    } else {
        echo "Không tìm thấy người dùng.";
    }
} else {
    echo "Không có id người dùng được cung cấp.";
}
?>
</body>
</html>