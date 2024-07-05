<?php
$id = $_GET['id'];

require_once "conn.php";

//执行sql
$sql = "DELETE FROM `user` WHERE `user`.`id` = $id";
$conn->query($sql);

//返回首页
echo '<script>alert("删除成功！"); window.location.href="index.php";</script>';
?>