<?php

session_start();

$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'bolashop';

$db = new mysqli($server, $user, $pass, $database);

if ($db) {
    mysqli_query($db, "SET NAMES 'utf8' ");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $password = $_POST['password'];



        $query = "SELECT * FROM nguoidung WHERE Manguoidung='$id'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['Matkhau'] === $password) {
                $_SESSION['user_id'] = $id;
                if ($user_data['Loainguoidung'] != 'Q0') {
                    $_SESSION['userdata'] = [
                        'id' => $user_data['Manguoidung'],
                        'maquyen' => $user_data['Loainguoidung']
                    ];
    
                    $response = array(
                        "status" => "success",
                        "message" => "Đăng nhập thành công!"
                    );
                }else {
                    $response = array(
                        "status" => "Duyet",
                        "message" => "Tài khoản chưa được duyệt! Vui lòng chờ admin duyệt tài khoản!"
                    );
                    echo json_encode($response);
                    exit;
                }
                
            } else {
                $response = array(
                    "status" => "MK",
                    "message" => "Sai mật khẩu!"
                );
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array(
                "status" => "error",
                "message" => "Không tồn tại tài khoản với ID này!"
            );
        }
        // Trả về kết quả dưới dạng JSON
        echo json_encode($response);
    }
    $db->close();
} else {
    echo 'Kết nối thất bại';
}
