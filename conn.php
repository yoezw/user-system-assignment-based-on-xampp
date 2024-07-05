<?php
$conn = new mysqli("localhost","root","","usys");

if($conn->connect_error){
    echo "连接失败";
}

mysqli_set_charset($conn,"utf8");
/*  else{
    echo "成功";
 }  */
?>
