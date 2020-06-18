<?php
require_once('../config/database.php');

$id = $_POST['id'];

$sql = "UPDATE message SET status = 2 WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "通过留言失败";
}
