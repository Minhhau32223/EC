<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .register-container {
            width: 500px;
            /* Chiều rộng */
            /* height: 400px; Chiều cao */
            margin: auto;
            /* Canh giữa trên trình duyệt */
            padding: 20px;
            /* background-color: #f4f4f4; */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .register-container form {
            width: 80%;
            display: flex;
            flex-direction: column;
        }

        .register-container h1 {
            text-align: center;
            color: #88C273;
        }

        .register-container form p {
            font-weight: bold;
            /* Làm cho chữ trong thẻ p đậm */
            color: #333;
            /* Chọn màu sắc khác */
            font-size: 20px;
            text-align: left;
        }

        .register-container form input[type="text"],
        .register-container form input[type="password"] {
            width: 80%;
            /* Đặt chiều rộng của các trường nhập */
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-container form .register-button {
            background-color: #88C273;
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
        .register-container form .register-button:hover {
            background-color: #88DF73;
        }

        .register-container form .login {
            text-align: right;
            text-decoration: none;
            font-size: 15px;
        }

        .register-container form .login-link {
            color: #88C273;
            text-decoration: none;
        }

        .wn {
            display: none;
            font-size: 18px;
            color: red;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <form id="DK" action="xulyDK.php" method="post">
            <h1>Đăng ký</h1>
            <p>Họ và tên:</p>
            <input type="text" name="name" id="name" placeholder="Họ và tên" required>


            <p>Số điện thoại:</p>
            <input type="text" name="phone" id="phone" placeholder="số điện thoại" required>
            <div id="wnphone" class="wn">Số điện thoại phải đủ 10 số </div>

            <p>Địa chỉ:</p>
            <input type="text" name="address" id="address" placeholder="địa chỉ" required>
            <div id="wnaddress" class="wn">Địa chỉ phải tồn tại </div>

            <p>Tên đăng nhập:</p>
            <input type="text" name="id" id="id" placeholder="Tên đăng nhập" required>
            <div id="wnid" class="wn">Tên đăng nhập phải đủ 4 ký tự</div>

            <p>Email:</p>
            <input type="text" name="email" id="email" placeholder="email" required>
            <div id="wnemail" class="wn">email phải đúng định dạng </div>

            <p>Mật khẩu:</p>
            <input type="password" name="password" id="password" placeholder="Mật khẩu" required>
            <div id="wnpassword" class="wn">Mật khẩu phải bao gồm ít nhất 8 ký tự, bao gồm ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt </div>

            <p>Xác nhận mật khẩu:</p>
            <input type="password" name="checkPW" id="checkPW" placeholder="Mật khẩu" required>
            <div id="wncheckpass" class="wn">xác nhận mật khẩu phải trùng với mật khẩu </div>

            <p class="login">Bạn đã có tài khoản, <a class="login-link" href="dangnhap.php">đăng nhập</a></p>
            <input type="submit" class="register-button" value="Đăng ký">

            <div id="message">
        </form>
    </div>


    <script>
        function showWarning(elementId) {
            var element = document.getElementById(elementId);
            if (element) {
                element.style.display = "block";
            }
        }


        function hideWarning(elementId) {
            var element = document.getElementById(elementId);
            if (element) {
                element.style.display = "none";
            }
        }

        $(document).ready(function() {
            $("#DK").submit(function(event) {
                event.preventDefault();
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = currentDate.getMonth() + 1; // Lưu ý: tháng bắt đầu từ 0, vì vậy cần cộng thêm 1
                var day = currentDate.getDate();
                var ngay = (year.toString() + "-" + month.toString() + "-" + day.toString());
                var name = $("#name").val();
                var phone = $("#phone").val();
                var address = $("#address").val();
                var id = $("#id").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var checkPW = $("#checkPW").val();
                $.ajax({
                    type: 'POST',
                    url: 'xulyDK.php',
                    data: {
                        name: name,
                        phone: phone,
                        address: address,
                        id: id,
                        email: email,
                        password: password,
                        checkPW: checkPW,
                        ngay: ngay
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            window.location.href = "dangnhap.php";
                        } else if (response.status === 'PASSWORD') {
                            alert(response.message);
                            document.getElementsByName("password")[0].focus();
                        } else if (response.status === 'CPW') {
                            alert(response.message);
                            document.getElementsByName("checkPW")[0].focus();
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
                        console.log('bbbb');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>