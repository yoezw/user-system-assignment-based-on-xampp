<?php
// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $addr = $_POST['addr'];
    $salary = $_POST['salary'];
    $married = $_POST['married'];
    $userDesc = $_POST['userDesc'];

    // 连接数据库
    require_once('conn.php');

    // 插入数据
    $sql = "INSERT INTO user (username, age, sex, addr, salary, married, userDesc) VALUES ('$username', '$age', '$sex', '$addr', '$salary', '$married', '$userDesc')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('添加成功！');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('添加失败！');window.location.href='add_user.php';</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加用户信息</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #000;
            background-color: #f4f4f4;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container .form-control {
            margin-bottom: 15px;
            border-color: #000;
        }
        .form-container .btn {
            background-color: #fff;
            border-color: #000;
            color: #000;
        }
        .form-container .btn:hover {
            background-color: #f4f4f4;
            border-color: #000;
            color: #000;
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
        <div class="form-container">
            <h2>添加用户信息</h2>
            <form id="userForm" action="add_user.php" method="POST">
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">用户名:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="username" name="username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-3 col-form-label">年龄:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" id="age" name="age" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="col-sm-3 col-form-label">性别:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="gender" name="sex" required>
                            <option value="女">女</option>
                            <option value="男">男</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">地址:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="address" name="addr" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="salary" class="col-sm-3 col-form-label">薪水:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" id="salary" name="salary" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="maritalStatus" class="col-sm-3 col-form-label">婚姻状况:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="maritalStatus" name="married" required>
                            <option value="0">未婚</option>
                            <option value="1">已婚</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="notes" class="col-sm-3 col-form-label">备注:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="notes" name="userDesc" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary btn-block">添加</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="reset" class="btn btn-secondary btn-block">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
