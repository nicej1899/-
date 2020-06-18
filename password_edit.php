<?php require_once('config/database.php'); ?>
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
        .layui-input:disabled {
            border: none;
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
    <form class="layui-form" action="">
        <div class="info">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>账</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo $_SESSION['user']['username']; ?>" disabled lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>初</span><span>始</span><span>密</span><span>码：</span></label>
                <div class="layui-input-block">
                    <input type="password" name="old_password" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>新</span><span>密</span><span>码：</span></label>
                <div class="layui-input-block">
                    <input type="password" name="new_password" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>确</span><span>认</span><span>密</span><span>码：</span></label>
                <div class="layui-input-block">
                    <input type="password" name="new_password_confirm" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-danger" lay-submit lay-filter="submit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']; ?>" >
        </div>
    </form>

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('form', function(){
            var form = layui.form;
            // 修改密码
            form.on('submit(submit)', function(data){
                var newPassword = data.field.new_password
                var newPasswordConfirm = data.field.new_password_confirm
                if (newPassword != newPasswordConfirm) {
                    layer.msg('2次密码不一致', {icon: 2})
                    return
                }
                $.ajax({
                    type: "POST",
                    url: "api/edit_password.php",
                    data: data.field,
                    dataType:"text",
                    success: function(result) {
                        console.log(result)
                        if (result == 'success') {
                            layer.msg('修改密码成功', {icon: 1, time: 1500}, function(){
                                location.href = 'login.php'
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
