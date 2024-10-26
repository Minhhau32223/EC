<?php
function connectDB() {
    $server ='localhost';
    $user ='root';
    $pass = '';
    $database = 'bolashop';

    $db = new mysqli($server, $user, $pass, $database);

    if($db) {
        mysqli_query($db,"SET NAMES 'utf8' ");
        // echo 'Da ket noi database thanh cong';
        echo '<br>';
    } else {
        echo 'ket noi that bai';
    }

    return $db;
}
//     $server ='localhost';
//     $user ='root';
//     $pass = '';
//     $database = 'bolashop';

//     $db = new mysqli($server, $user, $pass,$database);

//     if($db)
//     {
//         mysqli_query($db,"SET NAMES 'utf8' ");
//         echo 'Da ket noi database thanh cong';
//         echo '<br>';
//     }
//     else
//     {
//         echo 'ket noi that bai';
//     }

    // $sql = "SELECT *FROM nguoidung";

    // $ressult = mysqli_query($db, $sql);

    // if (mysqLi_num_rows($ressult) > 0)
    // {
    //     while($row = mysqli_fetch_array($ressult))
    //     {
    //         echo "".$row["Matheloai"]."".$row["Tentl"];
    //         echo '<br>';
    //     }
    // }
?>