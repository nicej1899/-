<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mirse</title>
</head>
<body>
    <?php
        // 查询学生列表
        $sql = "SELECT * FROM user WHERE status = 1 and type = 2";
        $result = $conn->query($sql);

        // 分页
        $total = $result->num_rows;
        $pageSize = 10;

        if(isset($_GET["p"])){
            $pageCurrent = $_GET["p"];
        }else{
            $pageCurrent = 1;
        }

        $start = ($pageCurrent - 1) * $pageSize;

        // 按分页查询学生
        $sql = "SELECT * FROM user WHERE status = 1 and type = 2 limit $start,$pageSize";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 循环输出学生表格
            $sOut = '';
            while($row = $result->fetch_assoc()) {
                $sOut .= '<tr> <td>'.$row['name'].'</td> <td>'.$row['sno'].'</td> <td>'.$row['phone'].'</td> <td>'.$row['birthday'].'</td> <td>'.$row['speciality'].'</td> <td>'.$row['mail'].'</td> <td>'.$row['hobby'].'</td> <td><button type="button" class="layui-btn layui-btn-primary layui-btn-xs" id="delete" data-id="'.$row['id'].'">删除</button></td> </tr>';
            }
        }
    ?>

    <button type="button" class="layui-btn" id="add"><a href="?m=classes_add">录入成员</a></button>

    <table class="layui-table">
        <colgroup>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col width="80">
        </colgroup>
        <thead>
            <tr>
                <th>姓名</th>
                <th>学号</th>
                <th>手机号</th>
                <th>出生日期</th>
                <th>专业</th>
                <th>邮箱</th>
                <th>爱好</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $sOut; ?>
        </tbody>
    </table>
    <!-- 显示分页 -->
    <?php
        $url = $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];
        page($total, $pageSize, $pageCurrent, $url, '');
    ?>

    <script src="js/jquery.min.js"></script>
    <script src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('layer', function(){
            var layer = layui.layer;
            // 删除学生
            $('.layui-table').on('click', '#delete', function() {
                var id = $(this).attr('data-id')
                layer.confirm('确认删除?', {icon: 3, title:'删除'}, function(index){
                    $.ajax({
                        type: "POST",
                        url: "api/delete_user.php",
                        data: {
                            id: id
                        },
                        dataType:"text",
                        success: function(result) {
                            if (result == 'success') {
                                layer.msg('删除成员成功', {icon: 1})
                                location.reload()
                            } else {
                                layer.msg(result, {icon: 2})
                            }
                        }
                    });
                });
            })
        });
    </script>
</body>
</html>
