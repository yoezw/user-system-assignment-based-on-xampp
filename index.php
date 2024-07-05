<?php
require_once("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员信息</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            padding: 20px;
        }
        .button-container {
            margin-bottom: 20px;
        }
        .table {
            background-color: #fff;
            border-color: #000;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
            border-color: #000;
        }
        .table thead {
            background-color: #f4f4f4;
            color: #000;
        }
        .btn-custom {
            background-color: #fff;
            border-color: #000;
            color: #000;
        }
        .btn-custom:hover {
            background-color: #f4f4f4;
            border-color: #000;
            color: #000;
        }
        .button-container .btn {
            margin-right: 10px;
        }
        .button-container .btn:last-child {
            margin-right: 0;
        }
        h2 {
            font-weight: bold;
        }
    </style>
    <?php 
    session_start();
    if(!isset($_SESSION['adminuser'])){
        header("location:login.php");
        exit();
    }
    ?>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">会员列表</h2>
        <div class="button-container d-flex justify-content-center">
            <a href="add_user.php" class="btn btn-custom">添加用户</a>
            <a href="search_user.php" class="btn btn-custom">查询用户</a>
            <a href="login.php?logout=1" class="btn btn-custom">登出</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>年龄</th>
                    <th>性别</th>
                    <th>地址</th>
                    <th>薪水</th>
                    <th>婚姻状况</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //查询数据库
                $sql = "SELECT * FROM user";
                //执行查询
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo $row['addr']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td><?php echo $row['married']; ?></td>
                    <td><?php echo $row['userDesc']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-custom">编辑</a>
                        <a href="del_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-custom">删除</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
