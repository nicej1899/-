<?php require_once('config/database.php'); require_once('function/auth.php'); require_once('function/page.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生信息管理系统</title>
    <link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <ul class="layui-nav layui-bg-cyan">
        <li class="layui-nav-item">
            <a href="">欢迎使用学生信息管理系统</a>
        </li>
        <li class="layui-nav-item">
            <a href="">个人中心</a>
        </li>
    </ul>

    <nav class="top-nav">
        <h3 class="admin-title">下午好，<?php if($_SESSION['user']['type'] == 1) echo "教师"; else echo "学生"; ?></h3>
        <p class="admin-desc"><span>账号名：<?php echo $_SESSION['user']['username']; ?></span> <span>用户：<?php echo $_SESSION['user']['name']; ?></span></p>
    </nav>

    <div class="main">
        <div class="side-nav">
            <ul class="layui-nav layui-nav-tree">
                <?php
                    // 页面选中状态
                    if (isset($_GET['m'])) {
                        $m = $_GET['m'];
                    } else {
                        if ($_SESSION['user']['type'] == 1) {
                            $m = 'classes';
                        } else {
                            $m = 'info';
                        }
                    }

                    // 侧边导航
                    if ($_SESSION['user']['type'] == 1) {
                        require_once('nav_teacher.php');
                    } else {
                        require_once('nav_student.php');
                    }
                ?>
                <li class="layui-nav-item <?php if($m == 'password_edit') echo 'layui-nav-itemed'; ?>"><a href="index.php?m=password_edit"><span class="glyphicon glyphicon-refresh"></span> 修改密码</a></li>
                <li class="layui-nav-item"><a href="api/logout.php"><span class="glyphicon glyphicon-log-out"></span> 退出登录</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        <?php
                            switch ($m) {
                                case 'classes':
                                    $title = '班级成员';
                                    break;
                                case 'classes_add':
                                    $title = '录入成员';
                                    break;
                                case 'performance_add':
                                    $title = '录入成绩';
                                    break;
                                case 'performance_edit':
                                    $title = '编辑成绩';
                                    break;
                                case 'performance_list':
                                    $title = '成绩管理';
                                    break;
                                case 'message_edit':
                                    $title = '留言管理';
                                    break;
                                case 'info':
                                    $title = '个人资料';
                                    break;
                                case 'info_edit':
                                    $title = '修改资料';
                                    break;
                                case 'performance':
                                    $title = '成绩';
                                    break;
                                case 'message':
                                    $title = '留言';
                                    break;
                                case 'password_edit':
                                    $title = '修改密码';
                                    break;

                                default:
                                    break;
                            }
                            echo $title;
                        ?>
                    </li>
                </ul>
                <div class="layui-tab-content">
                    <?php
                        include_once($m.'.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
