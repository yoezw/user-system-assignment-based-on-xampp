<?php
// 数据库连接信息
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usys";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 处理登录请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_adminuser = $_POST['adminuser'];
    $input_password = $_POST['password'];

    // 查询数据库
    $sql = "SELECT * FROM admin WHERE adminuser = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_adminuser, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 登录成功，跳转到index.php
        echo '<script type="text/javascript">alert("登录成功");window.location.href="index.php";</script>';
        session_start();
        $_SESSION['adminuser'] = $input_adminuser;
        
    } else {
        // 登录失败，显示错误信息
        echo '<script type="text/javascript">alert("账号或密码错误");</script>';
        session_start();
        unset($_SESSION['adminuser']);
        
    }
}
session_start();

// 检查是否是登出请求
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['adminuser']);
    header("location: login.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            padding: 20px;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #000;
            background-color: #f4f4f4;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container .form-control {
            margin-bottom: 15px;
            border-color: #000;
            flex: 1;
        }
        .login-container .btn {
            background-color: #fff;
            border-color: #000;
            color: #000;
            width: 48%;
        }
        .login-container .btn-primary:hover,
        .login-container .btn-primary:focus {
            background-color: #f4f4f4;
        }
        .login-container .btn-secondary:hover,
        .login-container .btn-secondary:focus {
            background-color: #f4f4f4;
        }
        .login-container .form-group {
            display: flex;
            align-items: center;
        }
        .login-container .form-group label {
            margin-right: 10px;
            width: 80px;
        }
        .login-container .btn-group {
            display: flex;
            justify-content: space-between;
        }
        .login-container .btn-group .btn:first-child {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>登录</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="adminuser">账号:</label>
                    <input type="text" class="form-control" id="adminuser" name="adminuser">
                </div>
                <div class="form-group">
                    <label for="password">密码:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="btn-group">
                    <input type="submit" class="btn btn-primary" value="登录">
                    <input type="reset" class="btn btn-secondary" value="重置">
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
