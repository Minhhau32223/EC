<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $current_date = date("Y-m-d");
    $status = $_POST['status'];
    $response = array();
    if (!preg_match('/^0\d{9}$/', $phone)) {
        $response = array(
            'status' => 'PHONE',
            'message' => 'Số điện thoại phải chứa đúng 10 chữ số!'
        );
        echo json_encode($response);
        exit;
    }



    if (!preg_match('/^.{4,}$/', $id)) {
        $response = array(
            'status' => 'ID',
            'message' => 'Tên đăng nhập ít nhất 4 ký tự!'
        );
        echo json_encode($response);
        exit;
    }

    if (!preg_match('/^[\w\.-]+@[\w\.-]+\.\w+$/', $email)) {
        $response = array(
            'status' => 'EMAIL',
            'message' => 'Email phải đúng định dạng!'
        );
        echo json_encode($response);
        exit;
    }


    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/', $password)) {
        $response = array(
            'status' => 'PASSWORD',
            'message' => 'Mật khẩu phải đủ 8 ký tự, có kí tự in hoa,in thường,ký tự đặc biệt và số '
        );
        echo json_encode($response);
        exit;
    }

    // Kết nối đến cơ sở dữ liệu
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'bolashop';
    $db = new mysqli($server, $user, $pass, $database);

    if ($db) {
        mysqli_query($db, "SET NAMES 'utf8' ");

        // Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu hay không
        $check_query = "SELECT * FROM nguoidung WHERE Manguoidung='$id' OR Sodienthoai='$phone' OR Email='$email'";
        $check_result = mysqli_query($db, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $response = array(
                'status' => 'error',
                'message' => 'Tên đăng nhập, số điện thoại hoặc email đã tồn tại!'
            );
            echo json_encode($response);
            exit;
        } else {
            // Thực hiện insert dữ liệu vào cơ sở dữ liệu
            $upload_dir = '../../img/';
            $img_name = '';
            if (isset($_FILES['txtHinhAnh']) && $_FILES['txtHinhAnh']['error'] == 0) {
                $img_name = basename($_FILES['txtHinhAnh']['name']);
                $target_file = $upload_dir . $img_name;
                move_uploaded_file($_FILES['txtHinhAnh']['tmp_name'], $target_file);
            } else {
                // Không có ảnh mới, sử dụng ảnh cũ
                $img_query = "SELECT img FROM nguoidung WHERE Manguoidung='$id'";
                $img_result = mysqli_query($db, $img_query);
                $img_row = mysqli_fetch_assoc($img_result);
                $img_name = "";
            }
            $sql = "INSERT INTO nguoidung (Manguoidung, Matkhau, Ten, Email, Sodienthoai, Diachi, Ngaytao, Loainguoidung, img) VALUES ('$id', '$password','$name', '$email', '$phone', '$address','$current_date','$status','$img_name')";

            if (mysqli_query($db, $sql)) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Đăng ký thành công!'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Có lỗi trong quá trình xử lý: ' . mysqli_error($db)
                );
            }
        }

        echo json_encode($response);
        // exit;
        $db->close();
    } else {
        echo 'Kết nối đến cơ sở dữ liệu thất bại';
    }
}
?>