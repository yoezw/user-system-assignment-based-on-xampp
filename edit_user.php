<?php
require_once("conn.php");

// 检查是否有id参数传递
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 查询数据库以获取用户信息
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // 处理表单提交
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $addr = $_POST['addr'];
        $salary = $_POST['salary'];
        $married = $_POST['married'];
        $userDesc = $_POST['userDesc'];

        // 更新数据库
        $update_sql = "UPDATE user SET username = ?, age = ?, sex = ?, addr = ?, salary = ?, married = ?, userDesc = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sisssisi", $username, $age, $sex, $addr, $salary, $married, $userDesc, $id);

        if ($stmt->execute()) {
            // 更新成功，重定向到用户列表页面
            header("Location: index.php");
            exit();
        } else {
            // 更新失败，显示错误信息
            echo "<script>alert('更新失败，请检查输入是否正确');</script>" . $stmt->error;
        }
    }
} else {
    // 如果没有id参数，重定向到用户列表页面
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑用户</title>
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
            <h2>编辑用户</h2>
            <form method="post" action="">
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">用户名:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-3 col-form-label">年龄:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sex" class="col-sm-3 col-form-label">性别:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="sex" name="sex" required>
                            <option value="女" <?php echo $user['sex'] == '女' ? 'selected' : ''; ?>>女</option>
                            <option value="男" <?php echo $user['sex'] == '男' ? 'selected' : ''; ?>>男</option>
                            <option value="其他" <?php echo $user['sex'] == '其他' ? 'selected' : ''; ?>>其他</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="addr" class="col-sm-3 col-form-label">地址:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="addr" name="addr" value="<?php echo $user['addr']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="salary" class="col-sm-3 col-form-label">薪水:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="salary" name="salary" value="<?php echo $user['salary']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="married" class="col-sm-3 col-form-label">婚姻状况:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="married" name="married" required>
                            <option value="0" <?php echo $user['married'] == '0' ? 'selected' : ''; ?>>未婚</option>
                            <option value="1" <?php echo $user['married'] == '1' ? 'selected' : ''; ?>>已婚</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="userDesc" class="col-sm-3 col-form-label">备注:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="userDesc" name="userDesc"><?php echo $user['userDesc']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary btn-block">保存</button>
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
