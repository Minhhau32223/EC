<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link href="../css/formthemKM.css?version=1.0" rel="stylesheet" />
    <title>Form danh mục</title>
</head>

<body>
<h2><a href="AHome.php">Trang chủ >> </a><a href="AHome.php?chon=t&id=danhmuc">danh mục >> </a>Thêm danh mục</h2>
    
<div class="form-km">
        <form class="formkhuyenmai" id="formkhuyenmai" method="post" action="">
            <h3>danh mục</h3>
            <label for="txtMakh">Mã danh mục</label>
            <input type="text" name="txtMakh" value="" placeholder="Nhập vào mã " />

            <label for="txtTenkh">Tên danh mục</label>
            <input type="text" name="txtTenkh" value="" placeholder="Nhập vào tên" />

            <div class="group-btn">
                <button type="button" id="delBtn" class="delBtn">Hủy</button>
                <button type="reset" id="resetBtn" class="resetBtn">Đặt lại</button>
                <button type="submit" id="submitBtn" class="submitBtn">Lưu</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Nút "Hủy"
            $('#delBtn').click(function() {
                window.location.href = 'AHome.php?chon=t&id=danhmuc';
            });

            // Nút "Đặt lại" tự động thực hiện reset form

            // Nút "Lưu"
            $('#formkhuyenmai').submit(function(event) {
                event.preventDefault(); // Ngăn chặn form gửi thông tin mặc định

                var formData = $(this).serialize(); // Lấy dữ liệu từ form

                $.ajax({
                    type: 'POST',
                    url: 'luudanhmuc.php',
                    data: formData,
                    success: function(response) {
                        if (response === 'success') {
                            alert('Đã lưu thành công');
                            window.location.href = 'AHome.php?chon=t&id=danhmuc';
                        } else {
                            alert('Có lỗi xảy ra: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>