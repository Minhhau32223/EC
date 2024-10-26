<?php
include 'connectDB.php';
session_start();
$_SESSION['item_add']=null;
  $sql="SELECT Mapn FROM phieunhap ORDER BY Mapn DESC";
  $result=mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)<1){
    echo 1;
    return;
  }else{
    while($row=mysqli_fetch_array($result)){
        echo $row['Mapn']+1;
        break;
      }
  }
  


?>