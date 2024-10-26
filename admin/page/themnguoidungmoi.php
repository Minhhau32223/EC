<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
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
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
        }

        .ThongTinKhachHang-data1,
        .ThongTinKhachHang-data2 {
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
        }

        .ThongTinKhachHang input[type="text"],
        .ThongTinKhachHang input[type="password"] {
            width: 80%;
            /* Đặt chiều rộng của các trường nhập */
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
            /* border-collapse: collapse; */
            border-collapse: separate;
            border-spacing: 0 40px;
        }

        tbody td {
            width: 50%;
            padding: 10px;
            border: 1px solid black;
        }

        .TaoND {
            background-color: #D61EAD;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            width: 40%;
            padding: 15px 0;
            font-size: 16px;
            float: right;
            /* text-transform: uppercase; */
            /* align-self: center; */
        }

        /* CSS khi nút được hover */
        .TaoND:hover {
            background-color: #A70087;
        }
    </style>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <?php
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
    $status="";
    $sql_roles = "SELECT * FROM quyen WHERE Maquyen!='Q0'";
    $result_roles = $db->query($sql_roles);
    $roles = [];
    if ($result_roles->num_rows > 0) {
        while ($row_role = $result_roles->fetch_assoc()) {
            $roles[] = $row_role;
        }
    }
    ?>
    <div class="form_TTKhachHang">
        <form id="TND" action="XLthemnguoidung.php" method="post">
            <h1>Thêm người dùng mới</h1>
            <p><a href="AHome.php">Trang chủ >> </a><span class="chuXam"><a href="AHome.php?chon=t&id=nguoidung">Người dùng >></a></span><span> Thêm người dùng mới</span></p>
            <div class="ThongTinKhachHang">
                <div class="ThongTinKhachHang-data1">
                    <div class="photo">
                        <img id="hinhAnh" src="../img/<?php echo $img; ?>" alt="ảnh" style="width: 80%; height: 80%;background-position: center;
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
                    <input type="text" name="id" id="id">
                    <p>Địa chỉ:</p>
                    <input type="text" name="address" id="address">
                    <p>Mật khẩu:</p>
                    <input type="password" name="password" id="password">
                    <p>Quyền:</p>
                    <select name="status" id="status">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?php echo $role['Maquyen']; ?>" <?php echo ($role['Maquyen'] == $status) ? 'selected' : ''; ?>><?php echo $role['Tenquyen']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="ThongTinKhachHang-data2">
                    <p>Họ tên:</p>
                    <input type="text" name="name" id="name">
                    <p>Số điện thoại:</p>
                    <input type="text" name="phone" id="phone">
                    <p>Email:</p>
                    <input type="text" name="email" id="email">
                    <input type="submit" class="TaoND" value="Tạo">
                </div>
            </div>

        </form>
    </div>
</body>

</html>
<script>
    function hienThiAnh(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var img = document.getElementById("hinhAnh");
            img.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    }
    $(document).ready(function() {
        $("#TND").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);




            $.ajax({
                type: 'POST',
                url: 'XLthemnguoidung.php',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.href = "AHome.php?chon=t&id=nguoidung";
                    } else if (response.status === 'PASSWORD') {
                        alert(response.message);
                        document.getElementsByName("password")[0].focus();
                    } else if (response.status === 'EMAIL') {
                        alert(response.message);
                        document.getElementsByName("email")[0].focus();
                    } else if (response.status === 'ID') {
                        alert(response.message);
                        document.getElementsByName("id")[0].focus();
                    } else if (response.status === 'PHONE') {
                        alert(response.message);
                        document.getElementsByName("phone")[0].focus();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                                        console.log(xhr.responseText);
                                    }
            });
        });
    });
</script>