
<?php
// header('Content-Type: application/json');    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ngay = $_POST['ngay'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $checkPW = $_POST['checkPW'];
        // echo var_dump($_POST);
        // $phone = intval($phone);// khi gửi dữ liệu qua ajax bị chuyển thành chuỗi phải ép trở về int
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
        else{
            $response = array(
                'status' => 'IDOK',
                'message' => '' 
            );
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
        
        if ($password !== $checkPW) {
            $response = array(
                'status' => 'CPW',
                'message' => 'Mật khẩu xác nhận không trùng khớp!' 
            );
            echo json_encode($response);
            exit;
        }
       
        
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'bolashop';

        $db = new mysqli($server, $user, $pass, $database);

        if ($db) {
            mysqli_query($db, "SET NAMES 'utf8' ");

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
            $sql = "INSERT INTO nguoidung (Manguoidung, Matkhau, Ten, Email, Sodienthoai, Diachi, Ngaytao, Loainguoidung) VALUES ('$id', '$password','$name', '$email', '$phone', '$address','$ngay','Q0')";
            
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
               
            echo json_encode($response);//để hiện thông báo đk thành công
            $db->close();
        } 
        else {
            echo 'Kết nối đến cơ sở dữ liệu thất bại';
        }
    }
?>
