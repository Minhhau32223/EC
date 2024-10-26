<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../css/formthemKM.css?version=1.0" rel="stylesheet"/>
        <title>Form vận chuyển</title>
    </head>
    <body>
    <?php 
       $con = mysqli_connect('localhost', 'root', '', 'bolashop');

       if(isset($_POST['submitBtn'])){
           $ma_vc = $_POST['Mavc'];
           $ten_vc = $_POST['Ten'];
           $phivc = $_POST['Gia'];
       
           // Sử dụng prepared statements để bảo vệ dữ liệu và tránh lỗi SQL injection
           $sql = "INSERT INTO vanchuyen (Mavc, Ten, Gia) VALUES (?, ?, ?)";
           $stmt = mysqli_prepare($con, $sql);
           
           // Kiểm tra lỗi khi chuẩn bị truy vấn
           if ($stmt) {
               mysqli_stmt_bind_param($stmt, "sss", $ma_vc, $ten_vc, $phivc);
               mysqli_stmt_execute($stmt);
               
               // Kiểm tra xem có hàng được thêm vào hay không
               if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo '<script>window.location.href = "AHome.php?chon=t&id=vanchuyen";</script>';
                //    header('Location: AHome.php?chon=t&id=vanchuyen');
                //    exit(); // Kết thúc kịch bản sau khi chuyển hướng
               } else {
                   echo "Không thể thêm phương thức vận chuyển.";
               }
               mysqli_stmt_close($stmt);
           } else {
               echo "Lỗi trong quá trình chuẩn bị truy vấn.";
           }
       } 
       
       mysqli_close($con);
       
        ?>
        <h2><a href="AHome.php">Trang chủ >> </a><a href="AHome.php?chon=t&id=vanchuyen">Vận chuyển >> </a>Thêm vận chuyển</h2>

        <div class="form-km">
            <form class="formkhuyenmai" id="formvanchuyen" method="post" action="">
                <h3>Vận chuyển</h3>
                <label for="txtMakh">Mã vận chuyển</label>
                <input type="text" name="Mavc" value="" required/>

                <label for="txtTenkh">Tên vận chuyển</label>
                <input type="text" name="Ten" value="" required/>

                <label for="txtSale">Phí vận chuyển</label>
                <input type="text" name="Gia" value="" required/>

                <div class="group-btn">
                    <button type="button" id="delBtn" class="delBtn" onclick="history.back();">Hủy</button>
                    <button type="reset" id="resetBtn" class="resetBtn">Đặt lại</button>
                    <button type="Submit" id="submitBtn" name="submitBtn" class="submitBtn">Lưu</button>
                </div>
            </form>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.getElementById("formvanchuyen").addEventListener("submit", function(event){
                var inputIvc = document.getElementsByName("Mavc")[0].value;

                if (!/^VC/.test(inputIvc)) {
                    alert("Mã nhà cung cấp phải bắt đầu bằng VC");
                    event.preventDefault();
                    return;            
                } 
            });
        });
    </script>
</html>