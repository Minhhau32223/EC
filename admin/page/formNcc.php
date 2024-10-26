<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../css/formthemKM.css?version=1.0" rel="stylesheet"/>
        <title>Form Nhà cung cấp</title>
    </head>
    <body>
        <?php 
  $con = mysqli_connect('localhost', 'root', '', 'bolashop');
  mysqli_query($con, "set names 'utf8'");


  if (!$con) {
      die("Lỗi kết nối: " . mysqli_connect_error());
  }
  if(isset($_POST['submitBtn'])){
      $ma_ncc = $_POST['Mancc'];
      $ten_ncc = $_POST['Ten'];
      $dc_ncc = $_POST['Diachi'];
      $sdt_ncc = $_POST['Sdt'];
      
      $sql_check = "SELECT * FROM nhacungcap WHERE Mancc = '$ma_ncc'";
      $result_check = mysqli_query($con, $sql_check);
      
      if(mysqli_num_rows($result_check) > 0){
          echo "<script>alert('Mã nhà cung cấp đã tồn tại!'); document.getElementsByName('Mancc')[0].focus(); history.back();</script>";
      } else {
          $sql = "INSERT INTO nhacungcap (Mancc, Ten, Diachi, Sdt) VALUES (?, ?, ?, ?)";
          $stmt = mysqli_prepare($con, $sql);

          if ($stmt) {
              mysqli_stmt_bind_param($stmt, "ssss", $ma_ncc, $ten_ncc, $dc_ncc, $sdt_ncc);
              mysqli_stmt_execute($stmt);
              if (mysqli_stmt_affected_rows($stmt) > 0) {
                //   header('Location: AHome.php?chon=t&id=nhacungcap');
                echo "<script> window.location.href=' AHome.php?chon=t&id=nhacungcap'</script>";
                  exit();
              } else {
                  echo "Không thể thêm nhà cung cấp.";
              }
              mysqli_stmt_close($stmt);
          } else {
              echo "Lỗi trong quá trình chuẩn bị truy vấn.";
          }
      }
  } 
  mysqli_close($con);

        ?> 
        <h2><a href="AHome.php">Trang chủ >> </a><a href="AHome.php?chon=t&id=nhacungcap">Nhà cung cấp >> </a>Thêm nhà cung cấp</h2>
        <div class="form-km">
            <form class="formkhuyenmai" id="formncc" method="post" action="">
                <h3>Nhà cung cấp</h3>
                <label for="txtMakh">Mã nhà cung cấp</label>
                <input type="text" name="Mancc" value=""  required/>

                <label for="txtTenkh">Tên nhà cung cấp</label>
                <input type="text" name="Ten" value="" required/>

                <label for="txtDiachi">Địa chỉ</label>
                <input type="text" name="Diachi" value="" required/>

                <label for="txtSdt">Số điện thoại</label>
                <input type="text" name="Sdt" value="" required/>

                <div class="group-btn">
                    <button type="button" id="delBtn" class="delBtn" onclick="history.back();">Hủy</button>
                    <button type="reset" id="resetBtn" class="resetBtn">Đặt lại</button>
                    <button type="Submit" name="submitBtn" id="submitBtn" class="submitBtn">Lưu</button>
                </div>
            </form>
        </div>
    </body>
    <script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("formncc").addEventListener("submit", function(event){
            var inputIdncc = document.getElementsByName("Mancc")[0].value;
            var inputSdt = document.getElementsByName("Sdt")[0].value;

            // Kiểm tra Mã nhà cung cấp
            if (!/^NCC/.test(inputIdncc)) {
                alert("Mã nhà cung cấp phải bắt đầu bằng NCC");
                event.preventDefault();
                return;            
            } 

            // Kiểm tra Số điện thoại
            var vnf_regex = /^(0[3|7|8|5])+([0-9]{8})$/;
            if (!vnf_regex.test(inputSdt)) {
                alert('Vui lòng nhập số điện thoại hợp lệ.');
                event.preventDefault();
                return;
            }

           

        //     var xhr = new XMLHttpRequest();
        //     xhr.open("POST", "xulythemNcc.php", true);
        //     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //     xhr.onreadystatechange = function() {
        //         if (xhr.readyState == 4 && xhr.status == 200) {
        //             if (xhr.responseText.trim() == "exists") {
        //                 alert("Mã nhà cung cấp đã tồn tại.");
        //                 document.getElementsByName("Mancc")[0].focus();
        //             } else {
                        
        //                 document.getElementById("formncc").submit();
        //             }
        //         }
        //     };
        //     xhr.send("Mancc=" + inputIdncc);

        // 
        });
    });
</script>

</html>

