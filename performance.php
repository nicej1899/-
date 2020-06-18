<?php require_once('config/database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mirse</title>
    <style type="text/css">
        .layui-form {
            width: 400px;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;
            padding: 15px;
            border-radius: 5px;
            background-color: #EDE89A;
        }
        .info {
            border-radius: 5px;
            border: 2px dashed #F7EEEE;
            padding-top: 15px;
        }
        .layui-input {
            border: none;
            background: none;
        }
        .layui-form-label {
            width: 100px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <?php
        // 根据id查询成绩信息
        $userId = $_SESSION['user']['id'];
        $sql = "select * from performance where user_id = '$userId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>

    <form class="layui-form" action="">
        <div class="info">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>学</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['sno']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>姓</span><span>名：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['name']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>高</span><span>数：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['mathematics']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>计</span><span>算</span><span>机：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['computer']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>大</span><span>学</span><span>物</span><span>理：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['physics']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>平</span><span>均</span><span>分：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo number_format(($row['mathematics'] + $row['computer'] + $row['physics'])/3,2); ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>总</span><span>分：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['mathematics'] + $row['computer'] + $row['physics']; ?>" disabled class="layui-input">
                </div>
            </div>
        </div>
    </form>
</body>
</html>
