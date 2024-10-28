<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .login-container {
            width: 500px;
            /* Chiều rộng */
            /* height: 400px; Chiều cao */
            margin: auto;
            /* Canh giữa trên trình duyệt */
            padding: 20px;
            /* background-color: #f4f4f4; */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .login-container form {
            width: 80%;
            display: flex;
            flex-direction: column;
        }

        .login-container h1 {
            text-align: center;
            color: #D61EAD;
        }

        .login-container form p {
            font-weight: bold;
            /* Làm cho chữ trong thẻ p đậm */
            color: #333;
            /* Chọn màu sắc khác */
            font-size: 20px;
            text-align: left;
        }

        .login-container form input[type="text"],
        .login-container form input[type="password"] {
            width: 80%;
            /* Đặt chiều rộng của các trường nhập */
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container form .login-button {
            background-color: #D61EAD;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            width: 40%;
            padding: 15px 0;
            font-size: 16px;
            text-transform: uppercase;
            align-self: center;
        }

        /* CSS khi nút được hover */
        .login-container form .login-button:hover {
            background-color: #A70087;
        }

        .login-container form .register {
            text-align: right;
            text-decoration: none;
            font-size: 15px;
        }

        .login-container form .register-link {
            color: #D61EAD;
            text-decoration: none;
        }
        body {
    background-image: url("../../img/vintage_y2k_hdbg.jpg");
    background-size: cover; 
    background-repeat: no-repeat;
    background-position: 0 0; 
    animation: moveBackground 15s linear infinite; 
}

@keyframes moveBackground {
    from {
        background-position: 0 0;
    }
    to {
        background-position: 100% 0;
    }
}
    </style>
</head>

<body>
    <div class="login-container">
        <form id="DN" action="xulyDN.php" method="post">
            <h1>Đăng nhập</h1>
            <p>Tên đăng nhập:</p>
            <input type="text" id="id" name="id" placeholder="Tên đăng nhập" required>
            <p>Mật khẩu:</p>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
            <p class="register">Nếu bạn chưa có tài khoản, <a class="register-link" href="dangky.php">đăng ký</a></p>
            <input type="submit" class="login-button" value="Đăng nhập">
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $("#DN").submit(function(event) {
                event.preventDefault();

                var id = $("#id").val();
                var password = $("#password").val();

                $.ajax({
                    type: 'POST',
                    url: 'xulyDN.php',
                    data: {
                        id: id,
                        password: password
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // alert(response.message);
                            window.location.href = "../../user/php/home.php?idtl";
                        } else if (response.status === 'MK') {
                            alert(response.message);
                            document.getElementsByName("password")[0].focus();
                        } else if (response.status === 'Duyet') {
                            alert(response.message);
                            // document.getElementsByName("password")[0].focus();
                        }else {
                            alert(response.message);
                            document.getElementsByName("id")[0].focus();
                        }
                    }
                });
            });
        });


        //     $(document).ready(function() {
        //         $('#loginForm').submit(function(event) {
        //             event.preventDefault(); // Ngăn chặn form submit mặc định

        //             var tenDN = $('#tenDN').val();
        //             var matKhau = $('#matKhau').val();

        //             if (!tenDN) {
        //                 $('#tbTenDN').html('Không được để trống tên đăng nhập!');
        //                 $('#tenDN').focus();
        //                 return false;
        //             }
        //             if (!matKhau) {
        //                 $('#tbMatKhau').html('Không được để trống mật khẩu!');
        //                 $('#matKhau').focus();
        //                 return false;
        //             }

        //             // Thực hiện AJAX request
        //             $.ajax({
        //                 url: 'xulyDN.php',
        //                 type: 'POST',
        //                 data: {
        //                     tenDN: tenDN,
        //                     matKhau: matKhau
        //                 },
        //                 dataType: 'json',
        //                 success: function(response) {
        //                     // Kiểm tra kết quả từ server và chuyển hướng nếu cần
        //                     if (response.status === 'success') {
        //                         window.location.href = 'home.php'; // Chuyển hướng đến trang home.php
        //                     } else {
        //                         console.log('Đăng nhập không thành công.');
        //                     }
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.log(xhr.responseText);
        //                 }
        //             });
        //         });
        //     });
        // 
    </script>
    </div>
</body>

</html>