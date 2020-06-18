<?php require_once('config/database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mirse</title>
    <link rel="stylesheet" type="text/css" href="static/layui/css/layui.css">
    <style type="text/css">
        .layui-form {
            width: 100%;
            height: 350px;
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
        .layui-input-block {
            margin-left: 15px;
        }
        .layui-textarea {
            height: 235px;
            border-radius: 5px;
            border-color: #F7EEEE;
            background: none;
        }
    </style>
</head>
<body>
    <?php
        // 查询留言信息
        $sql = "SELECT * FROM message WHERE status = 2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sOut = '';
            while($row = $result->fetch_assoc()) {
                $sOut .= '<blockquote class="layui-elem-quote layui-quote-nm">'.$row['user_name'].' ['.$row['message_time'].']：'.$row['content'].'</blockquote>';
            }
            echo $sOut;
        }
    ?>

    <form class="layui-form" action="">
        <div class="info">
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <textarea name="content" placeholder="请输入留言内容..." class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-danger" lay-submit lay-filter="submit">留言</button>
                </div>
            </div>

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>" >
            <input type="hidden" name="user_name" value="<?php echo $_SESSION['user']['name']; ?>" >
        </div>
    </form>

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('form', function(){
            var form = layui.form;
            // 留言
            form.on('submit(submit)', function(data){
                $.ajax({
                    type: "POST",
                    url: "api/message.php",
                    data: data.field,
                    dataType:"text",
                    success: function(result) {
                        console.log(result)
                        if (result == 'success') {
                            layer.msg('留言成功', {icon: 1, time: 1500}, function(){
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
