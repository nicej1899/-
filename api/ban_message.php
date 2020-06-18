<?php
require_once('../config/database.php');

$id = $_POST['id'];

$sql = "UPDATE message SET status = 3 WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "驳回留言失败";
}
