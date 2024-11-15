<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .login-container {
            background-color: aqua;
            margin-top: 175px;
            margin-left: 37.5%;
            width: 450px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 4px 4px 3px 7px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
        .login-container form {
            width: 80%;
            display: flex;
            flex-direction: column;
            padding: 40px;
        }
        .login-container h1 {
            text-align: center;
            color: gold;
            font-size: 50px;
            text-shadow: 1px 2px #959595;
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
            font-size: 20px;
        }
        .register{
            margin-top: 15px;
            margin-bottom: 15px;
            width: 110%;
            /* background-color: red; */
            text-align: right;
            font-size: 23px;
            padding: 0px;
        }
        .register a{
            color: #0D706E;
            font-size: 23px;
            font-weight: bold;
            text-decoration: none;
            text-shadow: 0px 0.5px gray;
        }
        .login-container form .login-button {
            margin-top: 10px;
            background-color: #0D706E;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            width: 50%;
            padding: 15px 0;
            font-size: 20px;
            text-transform: uppercase;
            align-self: center;
        }
        .login-container form .login-button:hover{
            -ms-transform: scale(0.925); 
            -webkit-transform: scale(0.925); 
            transform: scale(0.925); 
            /* font-weight: bold; */
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
            <div class="register"> Nếu bạn chưa có tài khoản, <a class="register-link" href="dangky.php">Đăng ký</a></div>
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
    </script>
    </div>
</body>

</html>