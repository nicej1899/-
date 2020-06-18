<?php
require_once('../config/database.php');

$id = $_POST['id'];
$mathematics = $_POST['mathematics'];
$computer = $_POST['computer'];
$physics = $_POST['physics'];

$sql = "UPDATE performance SET mathematics = '$mathematics', computer = '$computer', physics = '$physics' WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "修改成绩失败";
}
