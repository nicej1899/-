<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mirse</title>
    <link rel="stylesheet" href="static/layui/css/layui.css">
</head>
<body>
    <?php
        // 查询留言列表
        $sql = "SELECT * FROM message";
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

        $sql = "SELECT * FROM message limit $start,$pageSize";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sOut = '';
            // 循环输出留言表格
            while($row = $result->fetch_assoc()) {
                $sOut .= '<tr> <td>'.$row['user_name'].'</td> <td>'.$row['content'].'</td> <td>'.$row['message_time'].'</td>';

                if ($row['status'] == 1) {
                    $status = '<span class="text-info">未审核</span>';
                    $operate = '<button type="button" class="layui-btn layui-btn-xs" id="pass" data-id="'.$row['id'].'">通过</button> <button type="button" class="layui-btn layui-btn-danger layui-btn-xs" id="ban" data-id="'.$row['id'].'">驳回</button>';
                } else if ($row['status'] == 2) {
                    $status = '<span class="text-success">已通过</span>';
                    $operate = '/';
                } else {
                    $status = '<span class="text-danger">已驳回</span>';
                    $operate = '/';
                }

                $sOut .= '<td>'.$status.'</td>';
                $sOut .= '<td>'.$operate.'</td>';
                $sOut .= '</tr>';
            }
        }
    ?>
    <table class="layui-table">
        <colgroup>
            <col>
            <col>
            <col>
            <col width="80">
            <col width="115">
          </colgroup>
        <thead>
            <tr>
                <th>姓名</th>
                <th>留言内容</th>
                <th>留言时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $sOut; ?>
        </tbody>
    </table>
    <!-- 分页 -->
    <?php
        $url = $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];
        page($total, $pageSize, $pageCurrent, $url, '');
    ?>

    <script src="js/jquery.min.js"></script>
    <script src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('layer', function(){
            var layer = layui.layer;
            // 通过
            $('.layui-table').on('click', '#pass', function() {
                var id = $(this).attr('data-id')

                $.ajax({
                    type: "POST",
                    url: "api/pass_message.php",
                    data: {
                        id: id
                    },
                    dataType:"text",
                    success: function(result) {
                        if (result == 'success') {
                            layer.msg('通过留言成功', {icon: 1})
                            location.reload()
                        } else {
                            layer.msg(result, {icon: 2})
                        }
                    }
                });
            })
            // 驳回
            $('.layui-table').on('click', '#ban', function() {
                var id = $(this).attr('data-id')

                $.ajax({
                    type: "POST",
                    url: "api/ban_message.php",
                    data: {
                        id: id
                    },
                    dataType:"text",
                    success: function(result) {
                        if (result == 'success') {
                            layer.msg('驳回留言成功', {icon: 1})
                            location.reload()
                        } else {
                            layer.msg(result, {icon: 2})
                        }
                    }
                });
            })
        });
    </script>
</body>
</html>
