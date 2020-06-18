<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生信息管理系统</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="static/layui/css/layui.css">
</head>
<body>
    <h1 class="title">学生信息管理系统</h1>
    <form class="form" id="loginForm">
        <h2 class="form-title">请登录</h2>
        <div class="form-group">
            <label>用户</label>
            <input type="text" name="username" value="admin" id="username" placeholder="请输入用户名...">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" value="123456" id="password" placeholder="请输入密码...">
        </div>
        <div class="form-group">
            <label>权限</label>
            <select name="type" id="type">
                <option value="1">教师</option>
                <option value="2">学生</option>
            </select>
        </div>
        <div class="btn-group">
            <button type="button" class="btn" id="login">登录</button>
        </div>
    </form>

    <script src="js/jquery.min.js"></script>
    <script src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('layer', function(){
            var layer = layui.layer;
            // 登录
            $('#login').on('click', function() {
                var username = $('[name="username"]').val()
                var password = $('[name="password"]').val()
                var type = $('[name="type"]').val()
                if (!username) {
                    layer.msg('请输入用户名')
                    return
                }
                if (!password) {
                    layer.msg('请输入密码')
                    return
                }

                $.ajax({
                    type: "POST",
                    url: "api/login.php",
                    data: {
                        username: username,
                        password: password,
                        type: type
                    },
                    dataType:"text",
                    success: function(result) {
                        console.log(result)
                        if (result == 'success') {
                            layer.msg('登录成功', {icon: 1})
                            location.href = 'index.php'
                        } else {
                            layer.msg(result, {icon: 2})
                        }
                    }
                });
            })
        });
        // 切换身份
        $('#type').on('change', function(){
            var value = $(this).val()
            if (value == 1) {
                $('#username').val('admin')
                $('#password').val('123456')
            } else {
                $('#username').val('m1')
                $('#password').val('123456')
            }
        })
    </script>
</body>
</html>
