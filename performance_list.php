<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mirse</title>
</head>
<body>
    <?php
        // 查询成绩列表
        $sql = "SELECT * FROM performance";
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
        // 分页查询成绩
        $sql = "SELECT * FROM performance limit $start,$pageSize";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sOut = '';
            // 循环输出成绩表格
            while($row = $result->fetch_assoc()) {
                $sOut .= '<tr> <td>'.$row['sno'].'</td>';
                $sOut .= '<td>'.$row['name'].'</td>';
                $sOut .= '<td class="text-right">'.$row['mathematics'].'</td>';
                $sOut .= '<td class="text-right">'.$row['computer'].'</td>';
                $sOut .= '<td class="text-right">'.$row['physics'].'</td>';
                $sOut .= '<td class="text-right">'.number_format(($row['mathematics'] + $row['computer'] + $row['physics'])/3,2).'</td>';
                $sOut .= '<td class="text-right">'.($row['mathematics'] + $row['computer'] + $row['physics']).'</td>';
                $sOut .= '<td><button type="button" class="layui-btn layui-btn-xs" id="edit" data-id="'.$row['id'].'">编辑</button> <button type="button" class="layui-btn layui-btn-primary layui-btn-xs" id="delete" data-id="'.$row['id'].'">删除</button></td>';
                $sOut .= '</tr>';
            }
        }
    ?>

    <button type="button" class="layui-btn" id="add"><a href="?type=performance_add">录入成绩</a></button>

    <table class="layui-table">
        <colgroup>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col width="120">
        </colgroup>
        <thead>
            <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>高数</th>
                <th>计算机</th>
                <th>物理</th>
                <th>平均分</th>
                <th>总分</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $sOut; ?>
        </tbody>
    </table>
    <?php
        $url = $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];
        page($total, $pageSize, $pageCurrent, $url, '');
    ?>

    <script src="js/jquery.min.js"></script>
    <script src="static/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('layer', function(){
            var layer = layui.layer;
            // 编辑
            $('.layui-table').on('click', '#edit', function() {
                var id = $(this).attr('data-id')
                location.href = '?m=performance_edit&id=' + id
            })
            // 删除
            $('.layui-table').on('click', '#delete', function() {
                var id = $(this).attr('data-id')
                layer.confirm('确认删除?', {icon: 3, title:'删除'}, function(index){
                    $.ajax({
                        type: "POST",
                        url: "api/delete_performance.php",
                        data: {
                            id: id
                        },
                        dataType:"text",
                        success: function(result) {
                            if (result == 'success') {
                                layer.msg('删除成绩成功', {icon: 1})
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
