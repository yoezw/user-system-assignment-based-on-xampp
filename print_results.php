<?php
require_once("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>打印查询结果</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printableTable, #printableTable * {
                visibility: visible;
            }
            #printableTable {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            padding: 20px;
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
        <h2 class="text-center mb-4">会员检索列表</h2>
        <table id="printableTable" class="table table-bordered">
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
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['search_by']) && isset($_GET['search_term'])) {
                    $search_by = $_GET['search_by'];
                    $search_term = $_GET['search_term'];

                    // 根据选择的标签构建查询语句
                    $sql = "SELECT * FROM user WHERE $search_by LIKE ?";
                    $stmt = $conn->prepare($sql);
                    $searchTerm = "%" . $search_term . "%";
                    $stmt->bind_param("s", $searchTerm);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['username'] . "</td>
                                    <td>" . $row['age'] . "</td>
                                    <td>" . $row['sex'] . "</td>
                                    <td>" . $row['addr'] . "</td>
                                    <td>" . $row['salary'] . "</td>
                                    <td>" . $row['married'] . "</td>
                                    <td>" . $row['userDesc'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>没有找到相关用户。</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
