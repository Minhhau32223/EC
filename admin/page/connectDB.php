<?php
$conn=mysqli_connect("localhost","root",null,"bolashop");
if($conn->connect_error)
{
    die("connect error: " . $conn->connect_error);
}

?>