<?php
include 'connectDB.php';
session_start();

if(isset($_SESSION['item_add']))
{
    $data=$_SESSION['item_add'];
    $Mapn=$_POST["data"];
    $Mancc=$_POST["mancc"];
    $Ngaynhap=$_POST["ngaynhap"];

    $sql="INSERT INTO phieunhap(Mapn,Manhacungcap,Manhanvien,Ngaynhap) VALUES('$Mapn','$Mancc','admin','$Ngaynhap')";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        foreach($data as $item){
            $Masp=$item['Masp'];
            $Soluong=$item['Soluong'];

            $sql="INSERT INTO chitietphieunhap(maPhieunhap,Masp,soluong) VALUES('$Mapn','$Masp','$Soluong')";
            $result_ctpn=mysqli_query($conn,$sql);
            if($result_ctpn)
            {   
                $sql_check_product = mysqli_query($conn, "SELECT * FROM sanpham WHERE Masp = '$Masp'");
        $num_rows = mysqli_num_rows($sql_check_product);

        if ($num_rows > 0) {
            // Sản phẩm đã tồn tại, tăng số lượng sản phẩm
            $row = mysqli_fetch_assoc($sql_check_product);
            $soluongconlai = $row['Soluongconlai'] + $Soluong;

            $sql_update_product = mysqli_query($conn, "UPDATE sanpham SET Soluongconlai = '$soluongconlai' WHERE Masp = '$Masp'");
        }
                echo "Thêm thành công";

            }
            else
            {
                echo "Thêm thất bại";
            }
        }

       
    }
    else
    {
        echo "Thêm thất bại";
    }
 
}


?>