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
        // 根据id查询学生信息
        $userId = $_SESSION['user']['id'];
        $sql = "select * from user where id = '$userId' and status = 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>

    <form class="layui-form" action="">
        <div class="info">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>姓</span><span>名：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['name']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>学</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['sno']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>手</span><span>机</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['phone']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>出</span><span>生</span><span>日</span><span>期：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['birthday']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>专</span><span>业：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['speciality']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>邮</span><span>箱：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['mail']; ?>" disabled class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>爱</span><span>好：</span></label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo $row['hobby']; ?>" disabled class="layui-input">
                </div>
            </div>
        </div>
    </form>
</body>
</html>
