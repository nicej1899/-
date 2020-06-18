<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mirse</title>
    <link rel="stylesheet" type="text/css" href="static/layui/css/layui.css">
    <style type="text/css">
        .layui-form {
            width: 400px;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;
            padding: 15px;
            border-radius: 5px;
            background-color: #EBA39E;
        }
        .info {
            border-radius: 5px;
            border: 2px dashed #F7EEEE;
            padding: 15px 15px 0 0;
        }
        .layui-input {
            border-radius: 5px;
            border-color: #F7EEEE;
            background: none;
        }
        .layui-form-label {
            width: 100px;
            margin-bottom: 0;
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
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>学</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="sno" value="<?php echo $row['sno']; ?>" lay-verify="required|sno" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>手</span><span>机</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" lay-verify="required|phone" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>出</span><span>生</span><span>日</span><span>期：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="birthday" value="<?php echo $row['birthday']; ?>" readonly lay-verify="required" autocomplete="off" class="layui-input date-picker">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>专</span><span>业：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="speciality" value="<?php echo $row['speciality']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>邮</span><span>箱：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="mail" value="<?php echo $row['mail']; ?>" lay-verify="required|email" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>爱</span><span>好：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="hobby" value="<?php echo $row['hobby']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-danger" lay-submit lay-filter="submit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        </div>
    </form>

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['form','laydate'], function(){
            var form = layui.form,
                laydate = layui.laydate;

            laydate.render({
                elem: '.date-picker'
            });

            form.verify({
                sno: [
                    /^1[0-9]{9}$/
                    ,'学号格式不对'
                ]
            });
            // 修改学生信息
            form.on('submit(submit)', function(data){
                $.ajax({
                    type: "POST",
                    url: "api/edit_user.php",
                    data: data.field,
                    dataType:"text",
                    success: function(result) {
                        console.log(result)
                        if (result == 'success') {
                            layer.msg('修改资料成功', {icon: 1, time: 1500}, function(){
                                location.reload()
                            })
                        } else {
                            layer.msg(result, {icon: 2})
                        }
                    }
                });
                return false;
            });
        });
    </script>
</body>
</html>
