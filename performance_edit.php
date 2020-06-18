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

        .layui-input:disabled {
            border: none;
        }
    </style>
</head>
<body>

    <?php
        // 根据id查询成绩
        $id = $_GET['id'];
        $sql = "SELECT * FROM performance WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>

    <form class="layui-form" action="">
        <div class="info">
            <div class="layui-form-item">
                <label class="layui-form-label"><span>姓</span><span>名：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="name" disabled value="<?php echo $row['name']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>学</span><span>号：</span></label>
                <div class="layui-input-block">
                    <input type="text" name="sno" disabled value="<?php echo $row['sno']; ?>" lay-verify="required|sno" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>高</span><span>数：</span></label>
                <div class="layui-input-block">
                    <input type="number" name="mathematics" value="<?php echo $row['mathematics']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>计</span><span>算</span><span>机：</span></label>
                <div class="layui-input-block">
                    <input type="number" name="computer" value="<?php echo $row['computer']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span>物</span><span>理：</span></label>
                <div class="layui-input-block">
                    <input type="number" name="physics" value="<?php echo $row['physics']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
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
            // 修改信息
            form.on('submit(submit)', function(data){
                $.ajax({
                    type: "POST",
                    url: "api/edit_performance.php",
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
