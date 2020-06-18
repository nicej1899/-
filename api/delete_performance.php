<?php
require_once('../config/database.php');

$id = $_POST['id'];

$sql = "DELETE FROM performance WHERE id='$id'";
$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "删除成绩失败";
}
