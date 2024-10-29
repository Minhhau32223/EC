<?php
$conn=mysqli_connect("localhost","root","","bolashop");
if($conn->connect_error)
{
    die("connect error: " . $conn->connect_error);
}

?>