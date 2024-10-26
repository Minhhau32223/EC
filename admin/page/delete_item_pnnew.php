<?php
include 'connectDB.php';
session_start();

if(isset($_POST['data'])){
    $masp=$_POST['data'];

    $data=$_SESSION['item_add'];
    foreach($data as $key=>$value){
        if($value['Masp']===$masp)
        {
            unset($data[$key]);
            break;
        }
    }
    $data=array_values($data);
    $_SESSION['item_add']=$data;
}


?>